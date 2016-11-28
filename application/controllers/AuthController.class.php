<?php

/**
 * Authorize Controller
 */
class AuthController
{
    private $authorizeRoutes = array();

    public function __construct()
    {
        // Access to controller for only post request.
        if (!Request::isPost()) Response::redirect();
    }

    /**
     * Login user.
     */
    public function loginAction()
    {
        $json = new Json();
        $auth = new Authorize();
        $userModel = new UserModel();

        // Get params.
        $login = Request::getStringPost('login');
        $actionType = Request::getPost('actionType');
        $password = $auth->decodePassword(Request::getStringPost('password'));

        // Get user.
        $user = $userModel->findByLoginAndPassword($login, $password);

        // Check correct parameters.
        $this->checkLoginParameters($user, $actionType);

        // Login user.
        $auth->login($user);

        // Message
        $message = array(
            'Pomyślnie zalogowano',
        );

        if ($actionType == 'async') {
            $json->success = true;
            $json->message = $message;

            Response::json($json);
        } else {
            Response::flashMessage($message, 'success');
            Response::redirect(array('manage', 'menu', 'list', 0));
        }
    }

    /**
     * Logout user
     */
    public function logoutAction()
    {
        $auth = new Authorize();
        $response = new Json();

        $actionType = Request::getPost('actionType');

        $auth->logout();

        $message = array(
            'Pomyślnie wylogowano',
        );

        if ($actionType == 'async') {
            $response->success = true;
            $response->message = $message;

            Response::json($response);
        } else {
            Response::flashMessage($message, 'success');

            Response::redirect(array('manage'));
        }
    }

    /**
     * Check if password and email is correct.
     * @param UserEntity $user
     * @param $actionType
     */
    private function checkLoginParameters(UserEntity $user, $actionType = null)
    {
        $response = new Json();

        if (!$user->getId()) {

            $message = 'Login lub hasło jest niepoprawne';

            if ($actionType == 'async') {
                $response->message = $message;

                Response::json($response);
            } else {
                Response::flashMessage(array($message), 'danger');
                Response::redirect(array('manage'));
            }
        }
    }
}