<?php

class ManageMenuController
{
    public function __construct()
    {
        $auth = new Authorize();

        $auth->authorizeAction();
    }

    public function indexAction()
    {
        exit;
    }

    public function addAction()
    {
        if (!Request::isPost()) Response::redirect();

        // ~

        $menuModel = new MenuModel();
        $menuEntity = new MenuEntity();

        /* Params */
        $url = Request::getPost('url');
        $pageId = Request::getPost('page', 'int');
        $parentId = Request::getPost('parent', 'int');
        $name = Request::getPost('name', 'escape string');
        $iconName = Request::getPost('icon_name', 'escape string');

        if ($pageId) {
            $url = "";
        }

        $menuEntity->setUrl($url);
        $menuEntity->setName($name);
        $menuEntity->setPageId($pageId);
        $menuEntity->setParentId($parentId);
        $menuEntity->setIconName($iconName);

        $menuModel->insert($menuEntity);

        // ~

        Response::flashMessage(array('Pomyślnie dodano'), 'success', true);
        Response::redirect(array('manage','menu', 'list', $parentId));
    }

    public function editAction($id)
    {
        if (!Request::isPost()) Response::redirect();

        // ~

        $menuModel = new MenuModel();

        /* Params */
        $url = Request::getPost('url');
        $pageId = Request::getPost('page', 'int');
        $parentId = Request::getPost('parent', 'int');
        $name = Request::getPost('name', 'escape string');
        $iconName = Request::getPost('icon_name', 'escape string');

        // ~

        $menu = $menuModel->findById(intval($id));
        if (!$menu) {
            exit;
        }

        // ~

        if ($pageId > -1) {
            $url = "";
        }

        $menu->setUrl($url);
        $menu->setName($name);
        $menu->setPageId(intval($pageId));
        $menu->setIconName($iconName);
//        $menu->setParentId(intval($parentId));

        $menuModel->update($menu);

        // ~

        Response::flashMessage(array('Pomyślnie zapisano'), 'success', true);
        Response::redirect(array('manage','menu', 'list', $menu->getParentId()));
    }

    /**
     * Delete menu.
     */
    public function deleteAction()
    {
        if (!Request::isPost()) Response::redirect();

        // ~

        $menuModel = new MenuModel();

        // ~

        $id = Request::getPost('id', 'int');

        // ~

        $menu = $menuModel->findById($id);

        $this->deleteChildMenus($id);
        $menuModel->delete($menu);

        Response::flashMessage(array('Pomyślnie usunięto'), 'success', true);
        Response::redirectToPreviousPage();
    }

    /**
     * Recursive delete all children.
     *
     * @param $id
     */
    private function deleteChildMenus($id)
    {
        $menuModel = new MenuModel();

        $menuChild = $menuModel->findByParentId($id);

        foreach ($menuChild as $item) {
            if ($item->getParentId() != 0) {
                $this->deleteChildMenus($item->getId());
            }
            $menuModel->delete($item);
        }
    }

}