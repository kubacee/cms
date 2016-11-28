<?php

/**
 * Created by PhpStorm.
 * User: kuba
 * Date: 06.05.16
 * Time: 22:04
 */
class NewsListPage extends Page
{
    public $templateName = 'list';
    public $limitPerPage = 3;

    /**
     *
     */
    public function websiteAction()
    {
        $renderData = array(
            'pageType' => 'news',
            'list' => $this->getPageList(),
            'pagination' => $this->getPaginationData(),
        );

        // ~

        View::setData($renderData);
    }
}