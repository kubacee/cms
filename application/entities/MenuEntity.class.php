<?php

class MenuEntity
{
    private $id;
    private $url;
    private $name;
    private $pageId;
    private $iconName;
    private $parentId;

    // ~

    public function getId() {
        return $this->id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function setPageId($id) {
        $this->pageId = $id;
    }

    public function getPageId() {
        return $this->pageId;
    }

    public function setParentId($id) {
        $this->parentId = $id;
    }

    public function getParentId() {
        return $this->parentId;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function getUrl() {
        return $this->url;
    }

    public function setIconName($iconName) {
        $this->iconName = $iconName;
    }

    public function getIconName() {
        return $this->iconName;
    }

    // ~

    public function getPageUrl()
    {
        $pageModel = new PageModel();

        $url = 'http://' .  $this->url;

        if (intval($this->pageId) > 0) {
            $page = $pageModel->findById($this->pageId);

            if ($page) {
                $url = $page->getPageUrl();
            }
        }

        return $url;
    }

    // ~

    /**
     * @param array $fields
     */
    public function dump($fields = array()) {
        $this->id = $fields['id'];
        $this->url = $fields['url'];
        $this->name = $fields['name'];
        $this->pageId = $fields['page_id'];
        $this->parentId = $fields['parent_id'];
        $this->iconName = $fields['icon_name'];
    }
}