<?php

/**
 * Created by PhpStorm.
 * User: kuba
 * Date: 06.02.16
 * Time: 21:30
 */
class TemplateModel
{
    public function findById($id) {
        $entity = new TemplateEntity();
        $connect = Database::connect();

        $query = $connect->prepare('SELECT * FROM template WHERE id = :id');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        $results = $query->fetch(PDO::FETCH_ASSOC);

        $entity->dump($results);

        return $results ? $entity : false;
    }

    public function findAll()
    {
        $connect = Database::connect();

        $query = $connect->prepare('SELECT * FROM template');
        $query->execute();

        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        $returnData = array();
        foreach ($results as $item) {
            $entity = new TemplateEntity();

            $entity->dump($item);
            $returnData[] = $entity;
        }

        return count($results) > 0 ? $returnData : null;
    }
}