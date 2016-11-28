<?php

class PageEntity extends Entity
{
    private $id;
    private $name;
    private $value1;
    private $value2;
    private $value3;
    private $plugId;
    private $content;
    private $parentId;
    private $startPage;
    private $templateId;

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

    public function setTemplateId($id) {
        $this->templateId = $id;
    }

    public function getTemplateId() {
        return $this->templateId;
    }

    public function setPlugId($id) {
        $this->plugId = $id;
    }

    public function getPlugId() {
        return $this->plugId;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function getContent() {
        return stripslashes($this->content);
    }

    public function setStartPage($startPage) {
        $this->startPage = $startPage;
    }

    public function getStartPage() {
        return $this->startPage;
    }

    public function setParentId($id) {
        $this->parentId = $id;
    }

    public function getParentId() {
        return $this->parentId;
    }

    public function setValue1($val) {
        $this->value1 = $val;
    }

    public function getValue1() {
        return $this->value1;
    }

    public function setValue2($val) {
        $this->value2 = $val;
    }

    public function getValue2() {
        return stripslashes($this->value2);
    }

    public function setValue3($val) {
        $this->value3 = $val;
    }

    public function getValue3() {
        return $this->value3;
    }


    // ~


    public function getTemplate()
    {
        $templateModel = new TemplateModel();

        $template = $templateModel->findById($this->getTemplateId());

        return $template;
    }

    public function getPlugin()
    {
        $model = new LibraryModel();

        $entity = $model->findById($this->getPlugId());

        return $entity;
    }

    /**
     * Get plugin (Library entity)
     * If entity not exists then return empty entity.
     *
     * @return LibraryEntity
     */
    public function getPluginSilent()
    {
        $result = $this->getPlugin();

        if (!$result)
            $result = new LibraryEntity();

        return $result;
    }

    /**
     * Get parent page.
     *
     * @return bool|PageEntity
     */
    public function getParent()
    {
        $pageModel = new PageModel();
        $emptyEntity = new PageEntity();

        $pageEntity = $pageModel->findById($this->parentId);

        return $pageEntity ? $pageEntity : $emptyEntity;
    }

    /**
     * Get url name.
     *
     * @return string
     */
    public function getSlug()
    {
        $tool = new Tool();

        return $tool->generateSlug($this->name);
    }

    /**
     * Get page url.
     *
     * @return string
     */
    public function getPageUrl()
    {
        $url = "/";

        if ($this->startPage != 1) {
            $url = "/" . $this->id . "/" . $this->getSlug();
        }

//        $url .= debug ? '?env=dev' : '';

        return $url;
    }

    // ~

    /**
     * @param array $fields
     */
    public function dump($fields = array()) {
        $this->id = $fields['id'];
        $this->name = $fields['name'];
        $this->setDate($fields['date']);
        $this->value1 = $fields['value_1'];
        $this->value2 = $fields['value_2'];
        $this->value3 = $fields['value_3'];
        $this->plugId = $fields['plug_id'];
        $this->content = $fields['content'];
        $this->parentId = $fields['parent_id'];
        $this->startPage = $fields['start_page'];
        $this->templateId = $fields['template_id'];
    }
}