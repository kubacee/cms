<?php

/**
 * Function to operation on response.
 * Date: 2015-12-08
 * Time: 22:39
 */
class Response
{
    /**
     *
     * @param null $message
     */
    public static function error($message = null) {

        if (debug) {
            $response = "<b>".$message."</b>";

            echo $response;
            exit();
        } else {
            self::redirect();
        }
    }

    /**
     * Redirect to url.
     * @param null $params
     */
    public static function redirect($params = null) {
        $url = '/';

        if (count($params) > 0) {
            $url = '';
            foreach ($params as $param) {
                $url .= '/' . $param;
            }
        }
//        var_dump($params, $url); exit;

//        header('Location: ' . $url);
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: ' . SERVER . $url);

        // Optional workaround for an IE bug
        header("Connection: close");
        exit();
    }

    /**
     * @param $params
     */
    public static function displayPage($params)
    {
        if (!isset($params[0])) {
            $params[0] = 'index';
        }

        if (!isset($params[1])) {
            $params[1] = 'index';
        }

        /* Params */
        $method = $params[1] . 'Action';
        $class = ucfirst($params[0]) . 'Controller';

        unset($params[0]);
        array_shift($params);

        call_user_func_array(array($class, $method), $params);
        exit;
    }

    /**
     * Redirect to previous page.
     */
    public static function redirectToPreviousPage() {
        $tool = new Tool();

        header('Location: ' . $tool->getPreviousRoute());
        die;
    }

    /**
     * Display flash message.
     * @param array $messages
     * @param $type
     * @param $delay
     */
    public static function flashMessage($messages = array(), $type = 'info', $delay = false) {
        $array = array(
            'message' => $messages,
            'type' => $type,
            'delay' => $delay,
        );

        SessionManager::set('flash_message', $array);
    }

    public static function json($json) {
        echo json_encode($json);
        exit;
    }
}