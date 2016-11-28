<?php

/**
 * Created by PhpStorm.
 * User: kuba
 * Date: 06.05.16
 * Time: 22:04
 */
class SubPage extends Page
{
    public $templateName = 'page';

    public $pluginType = LibraryEntity::TYPE_DOCUMENTS;

    public function startAction()
    {
        $this->websiteAction();
    }

    public function websiteAction()
    {
        $libraryModel = new LibraryModel();

        // ~

        $plugId = $this->getPageEntity()->getPlugId();

        // ~

        $documentsList = $plugId > 0 ? $libraryModel->findByParentAndType($plugId, $this->pluginType) : null;

        // ~

        $data['documentsList'] = $documentsList;

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

        $documentSetsList = $libraryModel->findByParentAndType(0, $this->pluginType);

        // ~

        /* Set plugin in manage */
        $data['pluginList'] = $documentSetsList;
        $data['pluginLabel'] = 'Przypisz zestaw dokumentów';
        $data['pluginEditRoute'] = '/manageDocuments/editSet/';

        // ~

        View::setData($data);
    }
}