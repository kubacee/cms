<?php

class ManageController extends  Controller
{
    public function indexAction()
    {
        $template = "login-form";

        View::returnView("manage/" . $template);
    }

    // ~

    /**
     * Menu route.
     *
     * @param $action
     * @param $id
     */
    public function menuAction($action, $id)
    {
        $this->authorizeAction();

        // ~

        $breadCrumb = new BreadCrumb();

        // ~

        /* Set default params */
        View::setData(array(
            'pageId' => $id,
            'menuAction' => true,
            'breadCrumb' => $breadCrumb->get('menu', $id),
            'backButton' => isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '',
        ));


        // Add form
        if ($action == 'add') {
            $this->menuAddForm();
        }

        // Edit form
        if ($action == 'edit' && intval($id)) {
            $this->menuEditForm($id);
        }

        // List - default
        $this->menuList(intval($id));
    }

    /**
     * Display menu list.
     *
     * @param $parentId
     */
    private function menuList($parentId)
    {
        $menuModel = new MenuModel();

        $menus = $menuModel->findByParentId(intval($parentId));

        View::returnView("manage/menu-list", array(
            'list' => $menus,
        ));
    }

    /**
     * Display menu edit form.
     *
     * @param $id
     */
    private function menuEditForm($id)
    {
        $menuModel = new MenuModel();
        $model = new PageModel();

        $page = $model->findAll();
        $menu = $menuModel->findById(intval($id));

        if (!$menu) Response::redirect(array('manage', 'menu', 'list', 0));

        View::returnView("manage/edit-menu-form", array(
            'itemMenu' => $menu,
            'pageList' => $page,
        ));
    }

    /**
     * Display menu add form.
     */
    private function menuAddForm()
    {
        $model = new PageModel();

        $page = $model->findAll();

        View::returnView("manage/edit-menu-form", array(
            'pageList' => $page,
        ));
    }
}