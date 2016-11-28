<?php

/**
 * Created by PhpStorm.
 * User: kuba
 * Date: 06.02.16
 * Time: 21:30
 */
class LibraryModel
{
    public function findById($id) {
        $entity = new LibraryEntity();
        $connect = Database::connect();

        $query = $connect->prepare('SELECT * FROM library WHERE id = :id');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        $result = $query->fetch(PDO::FETCH_ASSOC);

        $entity->dump($result);

        return $result ? $entity : false;
    }

    public function findAll()
    {
        $connect = Database::connect();

        $query = $connect->prepare('SELECT * FROM library');
        $query->execute();

        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        $returnData = array();
        foreach ($results as $item) {
            $entity = new LibraryEntity();

            $entity->dump($item);
            $returnData[] = $entity;
        }

        return count($results) > 0 ? $returnData : null;
    }


    public function findByParentAndType($parentId, $type = 0, array $criteria = array())
    {
        $connect = Database::connect();

        // ~

        $buildQuery = 'SELECT * FROM library where parent_id = :parent_id and `type` = :type';

        // ~

        /* Build query by criteria */

        // SORT
        if (
            array_key_exists('order', $criteria) &&
            array_key_exists('direction', $criteria)
        ) {
            $buildQuery .= ' ORDER BY ' . $criteria['order'] . ' ' . $criteria['direction'];
        }

        // PAGINATION
        if (
            array_key_exists('limit', $criteria) &&
            array_key_exists('offset', $criteria)
        ) {
            $buildQuery .= ' LIMIT '. $criteria['limit'] .' OFFSET '. $criteria['offset'];
        }

        // ~

        $query = $connect->prepare($buildQuery);

        $query->bindParam(':type', $type, PDO::PARAM_INT);
        $query->bindParam(':parent_id', $parentId, PDO::PARAM_INT);
        $query->execute();

        // ~

        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        $returnData = array();

        foreach ($results as $item) {
            $entity = new LibraryEntity();

            $entity->dump($item);
            $returnData[] = $entity;
        }

        // ~

        return count($results) > 0 ? $returnData : null;
    }

    public function insert(LibraryEntity $entity)
    {
        $connect = Database::connect();

        $query = $connect->prepare('
            INSERT INTO `library`
            (
            `name`,
            `value_1`,
            `value_2`,
            `value_3`,
            `value_4`,
            `date`,
            `parent_id`,
            `type`
            )
            VALUES
             (
            :name,
            :value_1,
            :value_2,
            :value_3,
            :value_4,
            :date,
            :parent_id,
            :type
             )
        ');

        $query->bindParam(':name', $entity->getName(), PDO::PARAM_STR);
        $query->bindParam(':date', $entity->getDate(), PDO::PARAM_STR);
        $query->bindParam(':type', $entity->getType(), PDO::PARAM_INT);
        $query->bindParam(':value_1', $entity->getValue1(), PDO::PARAM_INT);
        $query->bindParam(':value_2', $entity->getValue2(), PDO::PARAM_INT);
        $query->bindParam(':value_3', $entity->getValue3(), PDO::PARAM_INT);
        $query->bindParam(':value_4', $entity->getValue4(), PDO::PARAM_INT);
        $query->bindParam(':parent_id', $entity->getParentId(), PDO::PARAM_INT);

        $query->execute();

        return $connect->lastInsertId();
    }

    public function update(LibraryEntity $entity)
    {
        $connect = Database::connect();

        $query = $connect->prepare("
            update library set
            `name` = :name,
            `parent_id` = :parent_id,
            `date` = :date,
            `value_1` = :value_1,
            `value_2` = :value_2,
            `value_3` = :value_3,
            `value_4` = :value_4,
            `order_item` = :order_item,
            `type` = :type
              where id = :id
        ");

        $query->bindParam(':id', $entity->getId(), PDO::PARAM_INT);
        $query->bindParam(':type', $entity->getType(), PDO::PARAM_INT);
        $query->bindParam(':name', $entity->getName(), PDO::PARAM_STR);
        $query->bindParam(':date', $entity->getDate(), PDO::PARAM_STR);
        $query->bindParam(':value_1', $entity->getValue1(), PDO::PARAM_STR);
        $query->bindParam(':value_2', $entity->getValue2(), PDO::PARAM_STR);
        $query->bindParam(':value_3', $entity->getValue3(), PDO::PARAM_STR);
        $query->bindParam(':value_4', $entity->getValue4(), PDO::PARAM_STR);
        $query->bindParam(':order_item', $entity->getOrder(), PDO::PARAM_INT);
        $query->bindParam(':parent_id', $entity->getParentId(), PDO::PARAM_INT);

        $query->execute();
    }


    public function delete(LibraryEntity $entity)
    {
        $connect = Database::connect();

        $query = $connect->prepare("
            delete from library
            where id = :id
        ");

        $query->bindParam(':id', $entity->getId(), PDO::PARAM_INT);

        $query->execute();
    }
}