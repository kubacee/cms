<?php

class ManagePluginController
{
    public function indexAction()
    {
        Response::redirect(array('managePlugin', 'list'));
    }

    /**
     *
     */
    public function listAction()
    {
        $renderData = array(
            'pluginAction' => true,
        );

        // ~

        View::returnView('manage/plugin-list', $renderData);
    }
}