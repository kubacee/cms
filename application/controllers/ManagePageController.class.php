<?php



class ManagePageController
{
    public function __construct()
    {
        $auth = new Authorize();

        $auth->authorizeAction();
    }

    public function indexAction()
    {
        /* Redirect to list */
        Response::redirect(array('managePage', 'list', 0));
    }

    /** DISPLAY VIEWS  */

    /**
     * Display page list.
     *
     * @param $parentId
     */
    public function listAction($parentId)
    {
        $tool = new Tool();
        $model = new PageModel();
        $breadCrumb = new BreadCrumb();

        // ~

        $defaultTemplateId = 1;
        $list = $model->findByParentId(intval($parentId));

        // ~

        $renderData = array(
            'list' => $list,
            'pageAction' => true,
            'parentId' => intval($parentId),
            'templateId' => $defaultTemplateId,
            'backButton' => $tool->getPreviousRoute(),
            'breadCrumb' => $breadCrumb->get('page', intval($parentId)),
        );

        // ~

        View::returnView("manage/page-list", $renderData);
    }

    /**
     * Display edit or add page form
     *
     * @param $id
     * @param $parentId
     * @param $templateId
     */
    public function editAction($id, $parentId, $templateId)
    {
        $tool = new Tool();
        $pageModel = new PageModel();
        $breadCrumb = new BreadCrumb();
        $templateModel = new TemplateModel();

        // ~

        $templateEntity = $templateModel->findById(intval($templateId));

        // ~

        if (!$templateEntity)
            Response::redirect(array('managePage', 'list', 0));

        // ~

        /* Params */
        $templates = $templateModel->findAll();
        $templateClass = $templateEntity->getClassName();
        $editedEntity = intval($id) > 0 ? $pageModel->findById(intval($id)) : false;
        $parentEntity = intval($parentId) > 0 ? $pageModel->findById(intval($parentId)) : false;

        // ~

        /* Check parent entity */
        if (!$parentEntity)
            $parentId = 0;

        /* Check if edited entity exists. */
        if ($editedEntity)
            View::setData(array('itemPage' => $editedEntity));

        // ~

        /** Create template object */
        /** @var Page $templateObject */
        $templateObject = new $templateClass();

        // ~

        /* Execute default method on template object */
        $templateObject->manageAction();

        // ~

        $renderData = array(
            'pageId' => intval($id),
            'parentId' => $parentId,
            'pageAction' => true,
            'templates' => $templates,
            'templateId' => $templateId,
            //'backButton' => $tool->getPreviousRoute(),
            'breadCrumb' => $breadCrumb->get('page', $id),
        );

        // ~

        View::returnView("manage/templates/" . $templateObject->getTemplateName(), $renderData);
    }

    /** SAVE FORMS, ACTIONS */

    /**
     * Update or add new page action.
     *
     * @param $id
     */
    public function savePageAction($id)
    {
        if (!Request::isPost()) Response::redirect();

        // ~

        $pageModel = new PageModel();
        $pageEntity = new PageEntity();

        // ~

        /* Request params */
        $content = Request::getPost('content');
        $plugId = Request::getPost('plug_id', 'int');
        $parentId = Request::getPost('parent', 'int');
        $template = Request::getPost('template', 'int');
        $name = Request::getPost('name', 'escape string');
        $date = Request::getPost('date', 'escape string');

        $value1 = Request::getPost('value_1', 'escape string');
        $value2 = Request::getPost('value_2', 'escape string');
        $value3 = Request::getPost('value_3', 'escape string');

        // ~

        $editedEntity = intval($id) > 0 ? $pageModel->findById(intval($id)) : false;

        if ($editedEntity) {
            $pageEntity = $editedEntity;
        } else {
            /* Check parent id */
            $parentId = intval($parentId) > 0 && $pageModel->findById($parentId) ? $parentId : 0;
            $pageEntity->setParentId($parentId);
        }

        // ~

        /* Fill entity */
        $pageEntity->setName($name);
        $pageEntity->setDate($date);
        $pageEntity->setPlugId($plugId);
        $pageEntity->setContent($content);
        $pageEntity->setTemplateId($template);

        $pageEntity->setValue1($value1);
        $pageEntity->setValue2($value2);
        $pageEntity->setValue3($value3);

        // ~

        /* Check if we will update or add new record */
        if ($editedEntity)
            $pageModel->update($pageEntity);
        else
            $pageModel->insert($pageEntity);

        // ~

        Response::flashMessage(array('Pomyślnie zapisano'), 'success', true);
        Response::redirect(array('managePage', 'list', $pageEntity->getParentId()));
    }

    /**
     * Delete page.
     */
    public function deleteAction()
    {
        if (!Request::isPost()) Response::redirect();

        // ~

        $model = new PageModel();

        // ~

        $id = Request::getPost('id', 'int');

        // ~

        $entity = $model->findById($id);

        $this->deleteChild($id);
        $model->delete($entity);

        // ~

        Response::flashMessage(array('Pomyślnie usunięto'), 'success', true);
        Response::redirectToPreviousPage();
    }

    /**
     * Recursive delete all children.
     *
     * @param $id
     */
    private function deleteChild($id)
    {
        $model = new PageModel();

        // ~

        $child = $model->findByParentId($id);

        // ~

        /** @var PageEntity $item */
        foreach ($child as $item) {
            if ($item->getParentId() != 0) {
                $this->deleteChild($item->getId());
            }

            $model->delete($item);
        }
    }


}