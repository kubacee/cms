<?php

class Page
{
    /** @var  $urlParams */
    private $urlParams;

    /** @var  PageEntity $pageEntity */
    private $pageEntity;

    /** @var  TemplateEntity $templateEntity */
    private $templateEntity;

    // ~

    public $limitPerPage = 3;
    private $paginationData = false;

    // ~

    public $templateName = '';

    // ~

    /**
     * Default start on website action.
     */
    public function websiteAction()
    {

    }

    /**
     * Default start in CMS action/
     */
    public function manageAction()
    {

    }

    // ~

    /**
     * Build template class.
     *
     * @param array $pageParams
     */
    public function __construct(array $pageParams = array())
    {
        if (count($pageParams) == 3) {
            $this->urlParams = $pageParams['urlParams'];
            $this->pageEntity = $pageParams['pageEntity'];
            $this->templateEntity = $pageParams['templateEntity'];
        }

        // ~

        $this->checkSettings();
    }

    // ~ Additional params to view.

    /**
     * Get page list.
     *
     * @return array|null
     */
    public function getPageList()
    {
        $pageModel = new PageModel();

        // ~

        $this->paginationData = $this->getPagination();

        // ~

        $criteria = array(
            'limit' => $this->limitPerPage,
            'offset' => $this->paginationData['offset'],
            'order' => 'date',
            'direction' => 'DESC'
        );

        $pageList = $pageModel->findByParentId($this->pageEntity->getId(), $criteria);

        // ~

        return $pageList;
    }

    /**
     * Calculate pagination info and return calculated params.
     *
     * @return array
     */
    private function getPagination()
    {
        $pageModel = new PageModel();

        /* Params */
        $urlParams = $this->getUrlParams();

        // ~

        $limit = $this->limitPerPage;
        $totalNumber = $pageModel->getNumberByParentId($this->pageEntity->getId());
        $maxPage = ceil($totalNumber / $limit);

        if ($maxPage  > 0 && $maxPage < $urlParams['pageNumber']) {
            $urlParams['pageNumber'] = $maxPage;
        }

        $offset = ($urlParams['pageNumber'] - 1)  * $limit;

        // Pagination data.
        $pagination = array(
            'max' => $maxPage,
            'offset' => $offset,
            'currentPage' => $urlParams['pageNumber'],
            'currentRoute' => $this->pageEntity->getPageUrl(),
        );

        return $pagination;
    }

    /**
     * Add plugin children list to view.
     */
    public function addPluginListData()
    {
        $pluginModel = new PluginModel();

        $page = $this->getPageEntity();

        if ($page->getPlugId()) {
            $plugin = $pluginModel->findById($page->getPlugId());

            $pluginList = $pluginModel->findByParentId($plugin->getId());

            View::setData(array(
                'pluginList' => $pluginList
            ));
        }
    }

    // ~ Getters and setters

    public function getUrlParams()
    {
        return $this->urlParams;
    }

    public function getPageEntity()
    {
        return $this->pageEntity;
    }

    public function getTemplateEntity()
    {
        return $this->templateEntity;
    }

    public function setLimitPerPage($limit)
    {
        $this->limitPerPage = $limit;
    }

    public function getPaginationData()
    {
        if (false == $this->paginationData) {
            die('You must first get page list');
        }

        return $this->paginationData;
    }

    public function getTemplateName()
    {
        return $this->templateName;
    }

    // ~

    /**
     * Check class settings.
     */
    private function checkSettings()
    {
        if ($this->templateName == '' || $this->templateName == null) {
            die('You must defined template name');
        }
    }
}