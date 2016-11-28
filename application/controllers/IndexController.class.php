<?php

class IndexController
{
    /**
     * Display page.
     *
     * @param $pageId
     * @param $pageTitle
     * @param $pageNumber
     */
    public function indexAction($pageId, $pageTitle, $pageNumber)
    {
        /* Models */
        $menuModel = new MenuModel();

        // ~

        /* Params */
        $pageNumber = intval($pageNumber) > 0 ? intval($pageNumber) : 1;

        // ~

        /* Entity */
        /** @var PageEntity $page */
        $page = $this->getPage($pageId, $pageTitle);
        /** @var TemplateEntity $template */
        $template = $page->getTemplate();

        /* Menu list */
        $menuList = $menuModel->findByParentId(0);

        // ~

        /* Prepare page template class */
        $pageClass =  $template->getClassName();

        $pageParams = array(
            'pageEntity' => $page,
            'templateEntity' => $template,
            'urlParams' => array(
                'pageId' => $pageId,
                'pageTitle' => $pageTitle,
                'pageNumber' => $pageNumber,
            ),
        );

        /** @var TemplateAbstract $pageObject */
        $pageObject = new $pageClass($pageParams);

        // Execute default method on page template.
        $pageObject->websiteAction();

        // ~

        /* Add default data to view */

        //Get the main parent page to select button as active in the top menu
        $mainParentPage = $this->getMainParent($page);

        $renderData = array(
            'page' => $page,
            'menu' => $menuList,
            'mainParentPage' => $mainParentPage,
        );

        // ~

        View::returnView("website/templates/" . $pageObject->getTemplateName(), $renderData);
    }

    /**
     * Get main parent for given page by recursive.
     *
     * @param PageEntity $page
     * @return PageEntity
     */
    private function getMainParent(PageEntity $page)
    {
        $pageModel = new PageModel();

        // ~

        /* Stop when page do not have a parent */
        if ($page->getParentId() == 0 ) {
            return $page;
        }

        // ~

        $nextPage = $pageModel->findById($page->getParentId());

        return $this->getMainParent($nextPage);
    }


    /**
     * Check if page exists.
     *
     * @param $pageId
     * @param $pageTitle
     */
    private function checkPage($pageId, $pageTitle)
    {
        $pageModel = new PageModel();

        // ~

        $page = $pageModel->findById(intval($pageId));

        if (
            false == $page ||
            $page->getSlug() != $pageTitle
        ) {
            Response::redirect(array('notFound'));
        }
    }

    /**
     * Get page entity.
     *
     * @param $pageId
     * @param $pageTitle
     * @return bool|PageEntity
     */
    private function getPage($pageId, $pageTitle)
    {
        $pageModel = new PageModel();

        // If no parameters take start/home page.
        if ($pageId == null && $pageTitle == null) {
            $page = $pageModel->findStartPage();
        } else {
            $this->checkPage($pageId, $pageTitle);
            $page = $pageModel->findById($pageId);
        }

        return $page;
    }
}