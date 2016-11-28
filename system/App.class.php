<?php

/**
 * User: KUBACEE
 * Date: 2015-11-19
 * Time: 21:10
 */


/**
 * Class App
 * Main application class.
 */
class App {
    /**
     * Start application.
     */
    public function run() {
        // Get url
        $url = $this->getCurrentUri();
        $urlParams = explode('/', $url);

        $decodeUrl = $this->getControllerNameActionName($urlParams);

        $shift = $decodeUrl['shift'];
        $action = $decodeUrl['actionName'];
//        $parameters = $decodeUrl['parameters']; // @TODO
        $controller = $decodeUrl['controllerName'];

        // Prepare controller class.
        $method = $action . "Action";
        $class = ucfirst($controller) . "Controller";

        /** TMP SOLUTION **/
        $this->loadController($class);
        View::create();

        // Create controller.
        $class = new $class();

        // Execute action.
        $this->executeAction($class, $method, $urlParams, $shift);
//        $this->executeAction($class, $method, $parameters); // @TODO
    }

    /**
     * Load controller class.
     * @param $className
     */
    private function loadController($className) {
        $path = CONTROLLERS . $className .'.class.php';

        if (preg_match('/^[a-z][0-9a-z]*(_[0-9a-z]+)*$/i', $className)) {
            if (file_exists($path)) {
                require_once $path;
                return;
            }
        }

        Response::error('class is not exists!');
    }

    /**
     * Get url.
     * @return string
     */
    private function getCurrentUri() {
        $basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
        $uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));

        if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
        $uri = trim($uri, '/');

        return $uri;
    }

    /**
     * @TODO poprawic te dekodowanie .
     * Decode url parameters and return controller with action name.
     * @param $routes
     * @return array
     */
    private function getControllerNameActionName($routes) {
        $i = 0;  // Shift url.

        /** Get controller name **/

        // If there is name for controller and is only string.
        if (isset($routes[0]) && $routes[0] != ''  && !intval($routes[0])) {
            $controller = $routes[0];

        // If there is integer then this parameter is for index action from index controller.
        } else if (isset($routes[0]) && intval($routes[0])) {
            $i = $i - 2; //@TODO
            $controller = 'index';
            $routes[0] = intval($routes[0]);

        } else {
            $controller = 'index';
        }

        /** Get action name **/

        // If there is string and first param (routes[0]) is integer.
        if (isset($routes[1]) && !intval($routes[1]) && intval($routes[0])) {
            $action = 'index';

            // If there is name for action and is only string.
        } else if (isset($routes[1]) && !intval($routes[1])) {
            $action = $routes[1];

            // If there is integer then this parameter is for index action.
        } else if (isset($routes[1]) && intval($routes[1])) {
            $i--;
            $action = 'index';

        } else {
            $action = 'index';
        }


        $decodeUrl = array(
            'controllerName' => $controller,
            'actionName' => $action,
            'shift' => $i,
//            'parameters' => $parameters, @TODO
        );

        return $decodeUrl;
    }

    /**
     * Get parameters for method.
     * @param $routes
     * @param $shift
     * @param ReflectionMethod $reflectionMethod
     * @return array
     */
    private function getMethodParameters($routes, $shift, ReflectionMethod $reflectionMethod) {
        $args = array();

        $numberOfParams = $reflectionMethod->getNumberOfParameters();

        // Add parameters to method. @TODO check this better.
        for ($j = $shift + 2; $j < $numberOfParams + $shift + 2; $j++) {
            $routes[$j] = isset($routes[$j]) ? $routes[$j] : null;
            array_push($args,$routes[$j]);
        }

        return $args;
    }

    /**
     * Check and execute method.
     * @param $class
     * @param $method
     * @param $routes
     * @param $shift
     */
    private function executeAction($class, $method, $routes, $shift)
    {
        if (method_exists($class, $method)) {
            $reflectionMethod = new ReflectionMethod($class, $method);

            $args = $this->getMethodParameters($routes, $shift, $reflectionMethod);

            // Execute method.
            if ($reflectionMethod->isPublic()) {
                call_user_func_array(array($class, $method), $args);
            } else {
                Response::error('method is private!');
            }
        } else {
            Response::error('method is not exists!');
        }
    }
}