<?php

/**
 * Created by PhpStorm.
 * User: kuba
 * Date: 06.02.16
 * Time: 21:30
 */
class MenuModel
{
    public function findById($id) {
        $entity = new MenuEntity();
        $connect = Database::connect();

        $query = $connect->prepare('SELECT * FROM menu WHERE id = :id');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        $entity->dump($query->fetch(PDO::FETCH_ASSOC));

        return $entity;
    }

    public function findAll()
    {
        $connect = Database::connect();

        $query = $connect->prepare('SELECT * FROM menu');
        $query->execute();

        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        $returnData = array();
        foreach ($results as $item) {
            $entity = new MenuEntity();

            $entity->dump($item);
            $returnData[] = $entity;
        }

        return count($results) > 0 ? $returnData : null;
    }

    public function findByParentId($id)
    {
        $connect = Database::connect();

        $query = $connect->prepare('SELECT * FROM menu where parent_id = :parent_id');
        $query->bindParam(':parent_id', $id, PDO::PARAM_INT);

        $query->execute();

        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        $returnData = array();
        foreach ($results as $item) {
            $entity = new MenuEntity();

            $entity->dump($item);
            $returnData[] = $entity;
        }

        return count($results) > 0 ? $returnData : null;
    }

    public function insert(MenuEntity $menu)
    {
        $connect = Database::connect();


        $query = $connect->prepare('
            INSERT INTO `menu`
            (`name`,
            `page_id`,
            `parent_id`,
            `url`,
            `icon_name`
            )
            VALUES
             (:name, :pageId, :parentId, :url,:icon_name)
        ');
        $query->bindParam(':url', $menu->getUrl(), PDO::PARAM_STR);
        $query->bindParam(':name', $menu->getName(), PDO::PARAM_STR);
        $query->bindParam(':pageId', $menu->getPageId(), PDO::PARAM_INT);
        $query->bindParam(':parentId', $menu->getParentId(), PDO::PARAM_INT);
        $query->bindParam(':icon_name', $menu->getIconName(), PDO::PARAM_STR);

        $query->execute();

        return $connect->lastInsertId();
    }

    public function update(MenuEntity $entity)
    {
        $connect = Database::connect();

        $query = $connect->prepare("
            update menu set
              url = :url,
              `name` = :name,
              page_id = :pageId,
              parent_id = :parentId,
              icon_name = :icon_name
              where id = :id
        ");

        $query->bindParam(':id', $entity->getId(), PDO::PARAM_INT);
        $query->bindParam(':url', $entity->getUrl(), PDO::PARAM_STR);
        $query->bindParam(':name', $entity->getName(), PDO::PARAM_STR);
        $query->bindParam(':pageId', $entity->getPageId(), PDO::PARAM_INT);
        $query->bindParam(':parentId', $entity->getParentId(), PDO::PARAM_INT);
        $query->bindParam(':icon_name', $entity->getIconName(), PDO::PARAM_STR);

        $query->execute();
    }

    public function delete(MenuEntity $entity)
    {
        $connect = Database::connect();

        $query = $connect->prepare("
            delete from menu
            where id = :id
        ");

        $query->bindParam(':id', $entity->getId(), PDO::PARAM_INT);

        $query->execute();
    }
}