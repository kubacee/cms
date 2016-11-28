<?php

class Controller
{
    /**
     * Default controller action.
     */
    public function indexAction() {

    }

    /**
     * Check post method
     * If there is no request POST then redirect.
     */
    public function checkPostRequest() {
        if (!Request::isPost()) Response::redirect();
    }

    /**
     * Check user authorize.
     * If the user is not logged then redirect.
     */
    public function authorizeAction() {
        $auth = new Authorize();

        if (!$auth->isLogin()) {
            View::returnView('manage/login-form');
//            Response::redirect(['manage']);
        }
    }
}