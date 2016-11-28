<?php

/**
 * Created by PhpStorm.
 * User: kuba
 * Date: 06.05.16
 * Time: 22:04
 */
class TeamPage extends Page
{
    public $templateName = 'team-page';
    public $pluginType = LibraryEntity::TYPE_TEAM;

    /**
     * Website action.
     */
    public function websiteAction()
    {
        $libraryModel = new LibraryModel();

        // ~

        $plugId = $this->getPageEntity()->getPlugId();

        // ~

        $documentCategories = $plugId > 0 ? $libraryModel->findByParentAndType($plugId, $this->pluginType) : null;

        // ~

        /* Add documents */
        $data['teamList'] = $documentCategories;

        // ~

        View::setData($data);
    }

    /**
     * CMS manage action.
     */
    public function manageAction()
    {
        $libraryModel = new LibraryModel();

        // ~

        $team = $libraryModel->findByParentAndType(0, LibraryEntity::TYPE_TEAM);

        // ~

        /* Set plugin in manage */
        $data['pluginList'] = $team;
        $data['pluginLabel'] = 'Zespół';
        $data['pluginEditRoute'] = '/manageTeam/showTeams/';

        // ~

        View::setData($data);
    }
}