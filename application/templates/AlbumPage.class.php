<?php

/**
 * Created by PhpStorm.
 * User: kuba
 * Date: 06.05.16
 * Time: 22:04
 */
class AlbumPage extends Page
{
    public $templateName = 'album';
    public $availablePlugin = 'AlbumPlugin'; // @todo remove

    public $pluginType = LibraryEntity::TYPE_GALLERY;

    // ~
    /**
     * @deprecated
     */
    public function startAction()
    {
        $this->websiteAction();
    }

    // ~

    public function websiteAction()
    {
        $libraryModel = new LibraryModel();

        // ~

        $plugId = $this->getPageEntity()->getPlugId();

        // ~

        $photosList = $plugId > 0 ? $libraryModel->findByParentAndType($plugId, $this->pluginType) : null;

        $data['photosList'] = $photosList;
        $data['pageType'] = 'gallery';

        // ~

        View::setData($data);
    }

    // ~

    /**
     * This method is start when you are in edit page at CMS.
     */
    public function manageAction()
    {
        $libraryModel = new LibraryModel();

        // ~

        $albumsList = $libraryModel->findByParentAndType(0, $this->pluginType);

        // ~

        /* Set plugin in manage */
        $data['pluginList'] = $albumsList;
        $data['pluginLabel'] = 'Przypisz album';
        $data['pluginEditRoute'] = '/manageGallery/editAlbum/';

        // ~

        View::setData($data);
    }
}