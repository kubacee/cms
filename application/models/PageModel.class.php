<?php

/**
 * Created by PhpStorm.
 * User: kuba
 * Date: 06.02.16
 * Time: 21:30
 */
class PageModel
{
    public function findById($id) {
        $entity = new PageEntity();
        $connect = Database::connect();

        $query = $connect->prepare('SELECT * FROM page WHERE id = :id');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        $result = $query->fetch(PDO::FETCH_ASSOC);

        $entity->dump($result);

        return $result ? $entity : false;
    }

    public function findAll()
    {
        $connect = Database::connect();

        $query = $connect->prepare('SELECT * FROM page');
        $query->execute();

        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        $returnData = array();
        foreach ($results as $item) {
            $entity = new PageEntity();

            $entity->dump($item);
            $returnData[] = $entity;
        }

        return count($results) > 0 ? $returnData : null;
    }

    public function findByParentId($id, array $criteria = array())
    {
        $connect = Database::connect();

        // ~

        $buildQuery = 'SELECT * FROM page where parent_id = :parent_id';

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

        $query->bindParam(':parent_id', $id, PDO::PARAM_INT);
        $query->execute();

        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        $returnData = array();
        foreach ($results as $item) {
            $entity = new PageEntity();

            $entity->dump($item);
            $returnData[] = $entity;
        }

        return count($results) > 0 ? $returnData : null;
    }

    public function getNumberByParentId($id, array $criteria = array())
    {
        $connect = Database::connect();

        $query = $connect->prepare('SELECT COUNT(*) as number FROM page where parent_id = :parent_id');
        $query->bindParam(':parent_id', $id, PDO::PARAM_INT);

        $query->execute();

        $result = $query->fetch(PDO::FETCH_ASSOC);

        return $result['number'];
    }

    public function insert(PageEntity $entity)
    {
        $connect = Database::connect();

        $query = $connect->prepare('
            INSERT INTO `page`
            (`name`,
            `content`,

            `template_id`,
            `parent_id`,
            `plug_id`,
            `start_page`,
            `date`,
            `value_1`,
            `value_2`,
            `value_3`
            )
            VALUES
             (
             :name,
             :content,

             :template_id,
             :parent_id,
             :plug_id,
             :start_page,
             :date,
             :value_1,
             :value_2,
             :value_3
             )
        ');
//        $query->bindParam(':url_name', "", PDO::PARAM_INT);
        $query->bindParam(':name', $entity->getName(), PDO::PARAM_STR);
        $query->bindParam(':plug_id', $entity->getPlugId(), PDO::PARAM_INT);
        $query->bindParam(':parent_id', $entity->getParentId(), PDO::PARAM_INT);
        $query->bindParam(':content', $entity->getContent(), PDO::PARAM_STR);
        $query->bindParam(':start_page', $entity->getStartPage(), PDO::PARAM_INT);
        $query->bindParam(':value_1', $entity->getValue1(), PDO::PARAM_INT);
        $query->bindParam(':value_2', $entity->getValue2(), PDO::PARAM_INT);
        $query->bindParam(':value_3', $entity->getValue3(), PDO::PARAM_INT);
        $query->bindParam(':start_page', $entity->getStartPage(), PDO::PARAM_INT);
        $query->bindParam(':template_id', $entity->getTemplateId(), PDO::PARAM_INT);
        $query->bindParam(':date', $entity->getDate(), PDO::PARAM_STR);

        $query->execute();

        return $connect->lastInsertId();
    }

    public function update(PageEntity $entity)
    {
        $connect = Database::connect();

        $query = $connect->prepare("
            update page set
            `name` = :name,
            `content` = :content,

            `template_id` = :template_id,
            `parent_id` = :parent_id,
            `plug_id` = :plug_id,
            `start_page` = :start_page,
            `date` = :date,
            `value_1` = :value_1,
            `value_2` = :value_2,
            `value_3` = :value_3
              where id = :id
        ");

        $query->bindParam(':id', $entity->getId(), PDO::PARAM_INT);
        $query->bindParam(':name', $entity->getName(), PDO::PARAM_STR);
        $query->bindParam(':plug_id', $entity->getPlugId(), PDO::PARAM_INT);
        $query->bindParam(':parent_id', $entity->getParentId(), PDO::PARAM_INT);
        $query->bindParam(':content', $entity->getContent(), PDO::PARAM_STR);
        $query->bindParam(':value_1', $entity->getValue1(), PDO::PARAM_STR);
        $query->bindParam(':value_2', $entity->getValue2(), PDO::PARAM_STR);
        $query->bindParam(':value_3', $entity->getValue3(), PDO::PARAM_STR);
        $query->bindParam(':start_page', $entity->getStartPage(), PDO::PARAM_INT);
        $query->bindParam(':template_id', $entity->getTemplateId(), PDO::PARAM_INT);
        $query->bindParam(':date', $entity->getDate(), PDO::PARAM_STR);

        $query->execute();
    }

    public function delete(PageEntity $entity)
    {
        $connect = Database::connect();

        $query = $connect->prepare("
            delete from page
            where id = :id
        ");

        $query->bindParam(':id', $entity->getId(), PDO::PARAM_INT);

        $query->execute();
    }

    public function findStartPage()
    {
        $entity = new PageEntity();
        $connect = Database::connect();

        $query = $connect->prepare('SELECT * FROM page WHERE start_page = 1');
        $query->execute();

        $result = $query->fetch(PDO::FETCH_ASSOC);

        $entity->dump($result);

        return $result ? $entity : false;
    }
}