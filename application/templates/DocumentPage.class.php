<?php

/**
 * Created by PhpStorm.
 * User: kuba
 * Date: 06.05.16
 * Time: 22:04
 */
class DocumentPage extends TemplateAbstract
{
    public $templateName = 'documents';

    public $pluginType = LibraryEntity::TYPE_DOCUMENTS;

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
        $data['documentCategories'] = $documentCategories;

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

        $document = $libraryModel->findByParentAndType(0, LibraryEntity::TYPE_DOCUMENTS);

        // ~

        /* Set plugin in manage */
        $data['pluginList'] = $document;
        $data['pluginLabel'] = 'Dokumenty';
        $data['pluginEditRoute'] = '/manageDocuments/showSets/';

        // ~

        View::setData($data);
    }
}