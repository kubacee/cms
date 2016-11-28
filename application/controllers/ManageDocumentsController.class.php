<?php

class ManageDocumentsController
{

    public function __construct()
    {
        $auth = new Authorize();

        $auth->authorizeAction();
    }

    public function indexAction()
    {

    }

    /** DISPLAY VIEWS  **/

    /**
     * Display documents sets list.
     */
    public function showSetsAction()
    {
        $libraryModel = new LibraryModel();

        // ~

        $list = $libraryModel->findByParentAndType(LibraryEntity::TYPE_DOCUMENTS, LibraryEntity::TYPE_DOCUMENTS);

        // ~

        $renderData = array(
            'pluginAction' => true,
            'list' => $list,
        );

        // ~

        View::returnView('manage/documents/sets-list', $renderData);
    }

    /**
     * Show document set form.
     *
     * @param $entityId
     */
    public function editSetAction($entityId)
    {
        $tool = new Tool();
        $libraryModel = new LibraryModel();

        // ~

        $renderData['pluginAction'] = true;
        $renderData['backButton'] = $tool->getPreviousRoute();

        // ~

        $editedEntity = intval($entityId) > 0 ? $libraryModel->findById(intval($entityId)) : false;

        if ($editedEntity) {
            $renderData['editedEntity'] = $editedEntity;
        }

        // ~

        View::returnView('manage/documents/set-form', $renderData);
    }

    // ~

    /**
     * Display documents list.
     *
     * @param $parentId
     */
    public function showDocumentsAction($parentId)
    {
        $libraryModel = new LibraryModel();

        // ~

        $parentEntity = $libraryModel->findById(intval($parentId));

        if (!$parentEntity)
            Response::redirect(array('manageDocuments','showSets'));

        // ~

        $list = intval($parentId) > 0 ? $libraryModel->findByParentAndType(intval($parentId), LibraryEntity::TYPE_DOCUMENTS) : false;

        // ~

        $renderData = array(
            'list' => $list,
            'pluginAction' => true,
            'parentEntity' => $parentEntity,
        );

        // ~

        View::returnView('manage/documents/documents-list', $renderData);
    }

    /**
     * Display edit document form.
     *
     * @param $parentId
     * @param $entityId
     */
    public function editDocumentAction($entityId, $parentId)
    {
        $tool = new Tool();
        $libraryModel = new LibraryModel();

        // ~

        $renderData['pluginAction'] = true;
        $renderData['backButton'] = $tool->getPreviousRoute();

        // ~

        $editedEntity = intval($entityId) > 0 ? $libraryModel->findById(intval($entityId)) : false;
        $parentEntity = intval($parentId) > 0 ? $libraryModel->findById(intval($parentId)) : false;

        // ~

        if ($editedEntity)
            $renderData['editedEntity'] = $editedEntity;

        if (!$parentEntity)
            Response::redirect(array('manageDocuments', 'showSets'));

        // ~

        $renderData['parentEntity'] = $parentEntity;

        // ~

        View::returnView('manage/documents/document-form', $renderData);
    }


    /** SAVE FORMS, ACTIONS **/

    /**
     * Save new or edit documents set.
     *
     * @param $entityId
     */
    public function saveSetAction($entityId)
    {
        $libraryModel = new LibraryModel();
        $libraryEntity = new LibraryEntity();

        // ~

        /* Params */
        $requestData = Request::getPosts();

        // ~

        /* Try get entity */
        $editedEntity = intval($entityId) > 0 ? $libraryModel->findById(intval($entityId)) : false;

        /* Check if we will add or update record */
        if ($editedEntity) {
            $libraryEntity = $editedEntity;

            $requestData['id'] = $editedEntity->getId();
        }

        // ~

        /* Prepare entity */
        $libraryEntity->dump($requestData);
        $libraryEntity->setType(LibraryEntity::TYPE_DOCUMENTS);
        $libraryEntity->setParentId(LibraryEntity::TYPE_DOCUMENTS);

        if ($editedEntity)
            $libraryModel->update($libraryEntity);
        else
            $libraryModel->insert($libraryEntity);

        // ~

        Response::flashMessage(array('Pomyślnie zapisano'), 'success', true);
        Response::redirect(array('manageDocuments', 'showSets'));
    }


    /**
     * Delete documents set.
     */
    public function deleteSetAction()
    {
        $tool = new Tool();
        $libraryModel = new LibraryModel();

        // ~

        /* Params */
        $entityId = Request::getPost('id', 'int');

        // ~

        /** @var LibraryEntity $deletedEntity */
        $deletedEntity = $libraryModel->findById(intval($entityId));

        if (!$deletedEntity)
            die();

        // ~

        /* Get children list */
        $childrenEntities = $libraryModel->findByParentAndType($deletedEntity->getId(), LibraryEntity::TYPE_DOCUMENTS);

        /* Remove file */
        /** @var LibraryEntity $entity */
        foreach ($childrenEntities as $entity) {
            $libraryModel->delete($entity);
            $tool->deleteFiles('uploads/' . $entity->getValue1());
        }


        /* Remove from database */
        $libraryModel->delete($deletedEntity);

        // ~

        Response::flashMessage(array('Pomyślnie usunięto'), 'success', true);
        Response::redirect(array('manageDocuments', 'showSets'));
    }

    // ~

    /**
     * Save new or edit document.
     *
     * @param $entityId
     */
    public function saveDocumentAction($entityId)
    {
        $file = new File();
        $libraryEntity = new LibraryEntity();
        $libraryModel = new LibraryModel();

        // ~

        /* Params */
        $requestData = Request::getPosts();
        $uploadedFile = Request::getFile('file');

        // ~

        /* Try get entity */
        $editedEntity = intval($entityId) > 0 ? $libraryModel->findById(intval($entityId)) : false;

        /* Check if we will add or update record */
        if ($editedEntity) {
            $libraryEntity = $editedEntity;

            // Complete data edited photo.
            $requestData['id'] = $editedEntity->getId();
            $requestData['value_1'] = $editedEntity->getValue1();
            $requestData['value_2'] = $editedEntity->getValue2();
        }

        // ~

        /* Prepare entity */
        $libraryEntity->dump($requestData);
        $libraryEntity->setType(LibraryEntity::TYPE_DOCUMENTS);

        // ~

        /* Upload image */
        if ($uploadedFile['name']) {
            $file->setFile($uploadedFile);
            $file->upload();

            /* Prepare file size */
            $unit = ' KB';
            $newSize = $uploadedFile['size'] / 1024;

            if ($newSize > 1000) {
                $newSize = $newSize / 1024;
                $unit = ' MB';
            }

            $newSize = number_format($newSize, 2, ',', ' ');

            // ~

            $libraryEntity->setValue1($file->getName());
            $libraryEntity->setValue2($file->getOriginalName());
            $libraryEntity->setValue4($newSize. $unit);
        }

        // ~

        if ($editedEntity)
            $libraryModel->update($libraryEntity);
        else
            $libraryModel->insert($libraryEntity);

        // ~

        Response::flashMessage(array('Pomyślnie zapisano'), 'success', true);
        Response::redirect(array('manageDocuments', 'showDocuments', $libraryEntity->getParentId()));
    }

    /**
     * Delete document.
     */
    public function deleteDocumentAction()
    {
        $tool = new Tool();
        $libraryModel = new LibraryModel();

        // ~

        /* Params */
        $entityId = Request::getPost('id', 'int');

        // ~

        $deletedEntity = $libraryModel->findById(intval($entityId));

        if (!$deletedEntity)
            die();

        // ~

        /* Remove file */
        $tool->deleteFiles('uploads/' . $deletedEntity->getValue1());

        /* Remove from database */
        $libraryModel->delete($deletedEntity);

        // ~

        Response::flashMessage(array('Pomyślnie usunięto'), 'success', true);
        Response::redirect(array('manageDocuments', 'showDocuments', $deletedEntity->getParentId()));
    }
}