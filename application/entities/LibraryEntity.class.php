<?php

class LibraryEntity extends Entity
{
    private $id;
    private $name;
    private $date;
    private $type;
    private $value1;
    private $value2;
    private $value3;
    private $value4;
    private $parentId = 0;
    private $order;

    // ~

    /** Library types **/
    const TYPE_SLIDER = 1;
    const TYPE_GALLERY = 2;
    const TYPE_DOCUMENTS = 3;
    const TYPE_TEAM = 4;

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
        return $this->value2;
    }

    public function setValue3($val) {
        $this->value3 = $val;
    }

    public function getValue3() {
        return $this->value3;
    }

    public function setValue4($val) {
        $this->value4 = $val;
    }

    public function getValue4() {
        return $this->value4;
    }

    public function setParentId($id) {
        $this->parentId = $id;
    }

    public function getParentId() {
        return $this->parentId;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getOrder() {
        return $this->order;
    }

    public function setOrder($order) {
        $this->order = $order;
    }

    // ~

    public function getChildrenList()
    {
        $libraryModel = new LibraryModel();

        // ~

        $results = $libraryModel->findByParentAndType($this->id, LibraryEntity::TYPE_DOCUMENTS);

        // ~

        return $results;
    }

    // ~

    /**
     * @param array $fields
     */
    public function dump($fields = array()) {
        $this->id = isset($fields['id']) ? $fields['id'] : null ;
        $this->order = isset($fields['order']) ? $fields['order'] : null ;
        $this->type = isset($fields['type']) ? $fields['type'] : null ;
        $this->date = isset($fields['date']) ? $fields['date'] : null ;
        $this->name = isset($fields['name']) ? $fields['name'] : null ;
        $this->value1 = isset($fields['value_1']) ? $fields['value_1'] : null ;
        $this->value2 = isset($fields['value_2']) ? $fields['value_2'] : null ;
        $this->value3 = isset($fields['value_3']) ? $fields['value_3'] : null ;
        $this->value4 = isset($fields['value_4']) ? $fields['value_4'] : null ;
        $this->parentId = isset($fields['parent_id']) ? $fields['parent_id'] : 0 ;
    }
}