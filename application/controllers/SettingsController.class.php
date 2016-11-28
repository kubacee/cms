<?php

class SettingsController
{
    public function indexAction()
    {

    }

    public function contrastAction()
    {
        if (
            SessionManager::is('contrast_design') &&
            SessionManager::get('contrast_design') === true
        ) {
            SessionManager::set('contrast_design', '');
        } else {
            SessionManager::set('contrast_design', true);
        }

        Response::redirectToPreviousPage();
    }

    public function fontAction($type)
    {
        $actionType = '';

        /* Check param */
        if ($type == 'medium') {
            $actionType = 'medium';
        } elseif ($type == 'large') {
            $actionType = 'large';
        }

        SessionManager::set('font_size', $actionType);

        Response::redirectToPreviousPage();
    }
}