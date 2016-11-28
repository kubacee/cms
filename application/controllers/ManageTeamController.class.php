<?php

class ManageTeamController
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
     * Display teams list.
     */
    public function showTeamsAction()
    {
        $libraryModel = new LibraryModel();

        // ~

        $list = $libraryModel->findByParentAndType(LibraryEntity::TYPE_TEAM, LibraryEntity::TYPE_TEAM);

        // ~

        $renderData = array(
            'pluginAction' => true,
            'list' => $list,
        );

        // ~

        View::returnView('manage/team/team-list', $renderData);
    }

    /**
     * Show person form.
     *
     * @param $entityId
     */
    public function editPersonAction($entityId)
    {
        $tool = new Tool();
        $libraryModel = new LibraryModel();

        // ~

        $renderData['pluginAction'] = true;
        $renderData['backButton'] = $tool->getPreviousRoute();

        // ~

        $editedEntity = intval($entityId) > 0 ? $libraryModel->findById(intval($entityId)) : false;

        if ($editedEntity)
            $renderData['editedEntity'] = $editedEntity;


        // ~

        View::returnView('manage/team/team-form', $renderData);
    }

    // ~

    /** SAVE FORMS, ACTIONS **/

    /**
     * Save new or edit documents set.
     *
     * @param $entityId
     */
    public function savePersonAction($entityId)
    {
        $libraryEntity = new LibraryEntity();
        $libraryModel = new LibraryModel();

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
        $libraryEntity->setType(LibraryEntity::TYPE_TEAM);
        $libraryEntity->setParentId(LibraryEntity::TYPE_TEAM);

        // ~

        if ($editedEntity)
            $libraryModel->update($libraryEntity);
        else
            $libraryModel->insert($libraryEntity);

        // ~

        Response::flashMessage(array('Pomyślnie zapisano'), 'success', true);
        Response::redirect(array('manageTeam', 'showTeams'));
    }


    /**
     * Delete person.
     */
    public function deletePersonAction()
    {
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

        /* Remove from database */
        $libraryModel->delete($deletedEntity);

        // ~

        Response::flashMessage(array('Pomyślnie usunięto'), 'success', true);
        Response::redirect(array('manageDocuments', 'showSets'));
    }
}