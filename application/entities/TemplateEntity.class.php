<?php

class TemplateEntity
{
    private $id;
    private $name;
    private $fileName;
    private $className;

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

    public function setFileName($fileName) {
        $this->fileName = $fileName;
    }

    public function getFileName() {
        return $this->fileName;
    }

    public function getClassName() {
        return $this->className;
    }

    // ~

    /**
     * @param array $fields
     */
    public function dump($fields = array()) {
        $this->id = $fields['id'];
        $this->name = $fields['name'];
        $this->fileName = $fields['file_name'];
        $this->className = $fields['class_name'];
    }
}