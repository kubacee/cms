<?php

/**
 * Created by PhpStorm.
 * User: kuba
 * Date: 06.05.16
 * Time: 22:04
 */
class GalleryAlbumListPage extends Page
{
    public $limitPerPage = 6;
    public $templateName = 'album-list';

    /**
     *
     */
    public function websiteAction()
    {
        $renderData = array(
            'pageType' => 'training',
            'list' => $this->getPageList(),
            'pagination' => $this->getPaginationData(),
        );

        // ~

        View::setData($renderData);
    }


}