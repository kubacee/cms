<?php

class ManageSettingsController
{
    public function __construct()
    {
        $auth = new Authorize();

        $auth->authorizeAction();
    }

    public function indexAction()
    {
        Response::redirect(array('manageSettings','list'));
    }

    public function listAction()
    {

        $renderData['settingsAction'] = true;

        // ~

        View::returnView('manage/settings/list', $renderData);
    }

    public function editUserAction()
    {
        $tool = new Tool();
        $auth = new Authorize();

        // ~

        /* Params */
        $loginUser = $auth->getLoggedUser();

        // ~

        $renderData['settingsAction'] = true;
        $renderData['loginUser'] = $loginUser;
        $renderData['backButton'] = $tool->getPreviousRoute();

        // ~

        View::returnView('manage/settings/user-form', $renderData);
    }

    public function saveEditedUserAction()
    {
        $auth = new Authorize();
        $userModel = new UserModel();

        // ~

        /* Params */
        $loginUser = $auth->getLoggedUser();
        $oldPassword = Request::getPost('old_password');
        $newPassword = Request::getPost('new_password');
        $newPasswordRepeated = Request::getPost('new_password_repeated');

        // ~

        // Check parameters
        if (
            $loginUser->getPassword() != $auth->decodePassword($oldPassword) ||
            $newPassword != $newPasswordRepeated
        ) {
            Response::flashMessage(array('Wprowadzone hasła są różne'), 'danger', true);
            Response::redirect(array('manageSettings','editUser'));
        } else if (
            strlen($newPassword) < 8
        ) {
            Response::flashMessage(array('Nowe hasło jest za krótkie, minimalna długość to 10 znaków'), 'danger', true);
            Response::redirect(array('manageSettings','editUser'));
        }

        // ~

        $loginUser->setPassword($auth->decodePassword($newPassword));

        $userModel->update($loginUser);

        // ~

        Response::flashMessage(array('Pomyślnie zapisano'), 'success', true);
        Response::redirect(array('manageSettings','list'));
    }
}