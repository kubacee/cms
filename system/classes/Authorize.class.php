<?php

/**
 * Created by PhpStorm.
 * User: kuba
 * Date: 06.02.16
 * Time: 04:06
 */
class Authorize
{
    /**
     * Login user to system.
     * @param UserEntity $user
     */
    public function login(UserEntity $user)
    {
        if (!$this->isLogin()) {
            SessionManager::set('authorize_user', true);
            SessionManager::set('user_id', $user->getId());
        }
    }

    /**
     * Logout user from system.
     */
    public function logout()
    {
        if ($this->isLogin()) {
            SessionManager::clear();
        }
    }

    /**
     * Check if user is login.
     * @return bool
     */
    public function isLogin()
    {
        $userModel = new UserModel();

        $userId = SessionManager::get('user_id');
        $sessionName = SessionManager::get('authorize_user');

        $user = $userModel->findById($userId);

        return ($sessionName && $user->getId()) ? true : false;
    }

    public function checkAuthorize() {
    }

    /**
     * Get logged user.
     * @return bool|UserEntity
     */
    public function getLoggedUser()
    {
        if ($this->isLogin()) {
            $userModel = new UserModel();

            $userId = SessionManager::get('user_id');
            $user = $userModel->findById($userId);

            return $user;
        } else {
            return false;
        }
    }

    /**
     * Decode password
     * @param $password
     * @return string
     */
    public function decodePassword($password)
    {
        return md5($password);
    }

    /**
     * Authorize action.
     * @param null $userRole
     */
    public function authorizeAction($userRole = null)
    {
        if (!$this->isLogin()) {
//            if (!SessionManager::is('flash_message')) {
//                Response::flashMessage(['Odmowa dostępu','Aby przejść do tego adresu musisz być zalogowany'], 'error');
//            }
            View::returnView('manage/login-form');
            Response::redirectToPreviousPage();
        }

        if ($userRole && $this->getLoggedUser()->getRole() != $userRole) {
            Response::redirect();
            Response::redirectToPreviousPage();
        }

    }
}