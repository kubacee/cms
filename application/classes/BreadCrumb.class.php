<?php

/**
 * Created by PhpStorm.
 * User: kuba
 * Date: 17.04.16
 * Time: 00:47
 */
class BreadCrumb
{
    public function get($name, $elementId)
    {
        switch ($name) {
            case 'menu':
                $model = new MenuModel();
                $startBread = array(
                    'id' => 0,
                    'name' => 'Lista menu',
                );
                break;
            case 'page':
                $model = new PageModel();
                $startBread = array(
                    'id' => 0,
                    'name' => 'Lista podstron',
                );
                break;
            case 'plugin':
                $model = new MenuModel();
                $startBread = array(
                    'id' => 0,
                    'name' => 'Wtyczki',
                );
                break;
            case 'settings':
                $model = new MenuModel();
                $startBread = '';
                break;
            default:
                return false;
        }

        $returnData = array();

        $item = $model->findById($elementId);

        while ($item && $item->getId()) {
            $data['id'] = $item->getId();
            $data['name'] = $item->getName();

            $returnData[] = $data;

            $item = $model->findById($item->getParentId());
        }

        // First bread crumb.
        $returnData[] = $startBread;

        return array_reverse($returnData);
    }

}