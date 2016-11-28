<?php

class ManageGalleryController
{

    public function __construct()
    {
        $auth = new Authorize();

        $auth->authorizeAction();
    }

    public function indexAction()
    {

    }

    /** DISPLAY VIEWS **/

    /**
     * Show albums list.
     */
    public function showAlbumsAction()
    {
        $libraryModel = new LibraryModel();

        // ~

        $albumsList = $libraryModel->findByParentAndType(0, LibraryEntity::TYPE_GALLERY);

        // ~

        $renderData = array(
            'pluginAction' => true,
            'list' => $albumsList,
        );

        // ~

        View::returnView('manage/gallery/album-list', $renderData);
    }

    /**
     * Show edit album form.
     *
     * @param $albumId
     */
    public function editAlbumAction($albumId)
    {
        $tool = new Tool();
        $libraryModel = new LibraryModel();

        // ~

        $renderData['pluginAction'] = true;
        $renderData['backButton'] = $tool->getPreviousRoute();

        // ~

        $editedAlbum = $libraryModel->findById(intval($albumId));

        if ($editedAlbum) {
            $renderData['albumEntity'] = $editedAlbum;
        }

        // ~

        View::returnView('manage/gallery/album-form', $renderData);
    }

    /**
     * Show photos list for given album.
     *
     * @param $albumId
     */
    public function showPhotosAction($albumId)
    {
        $libraryModel = new LibraryModel();

        // ~

        $albumEntity = $libraryModel->findById(intval($albumId));

        if (!$albumEntity)
            Response::redirect(array('managePlugin', 'list'));

        // ~

        $albumsList = $libraryModel->findByParentAndType(intval($albumId), LibraryEntity::TYPE_GALLERY);

        // ~

        $renderData = array(
            'pluginAction' => true,
            'list' => $albumsList,
            'albumEntity' => $albumEntity,
        );

        // ~

        View::returnView('manage/gallery/photos-list', $renderData);
    }

    /**
     * Show add photos form.
     *
     * @param $albumId
     */
    public function addPhotosAction($albumId)
    {
        $tool = new Tool();
        $libraryModel = new LibraryModel();

        // ~

        $albumEntity = $libraryModel->findById(intval($albumId));

        if (!$albumEntity)
            Response::redirect(array('managePlugin', 'list'));

        // ~

        $renderData = array(
            'pluginAction' => true,
            'albumEntity' => $albumEntity,
            'backButton' => $tool->getPreviousRoute(),
        );

        // ~

        View::returnView('manage/gallery/photos-form', $renderData);
    }

    /**
     * Display given photo.
     *
     * @param $photoId
     */
    public function previewPhotoAction($photoId)
    {
        $tool = new Tool();
        $libraryModel = new LibraryModel();

        // ~

        $photoEntity = $libraryModel->findById(intval($photoId));

        if (!$photoEntity)
            Response::redirect(array('manageGallery','list'));

        // ~

        $albumEntity = $libraryModel->findById($photoEntity->getParentId());

        if (!$albumEntity)
            Response::redirect(array('manageGallery','list'));

        // ~

        $renderData['pluginAction'] = true;
        $renderData['photoEntity'] = $photoEntity;
        $renderData['albumEntity'] = $albumEntity;
        $renderData['backButton'] = $tool->getPreviousRoute();

        // ~

        View::returnView('manage/gallery/preview-photo', $renderData);
    }

    /** SAVE FORMS **/

    /**
     * Save new or edited album.
     *
     * @param $albumId
     */
    public function saveAlbumAction($albumId)
    {
        $file = new File();
        $albumEntity = new LibraryEntity();
        $libraryModel = new LibraryModel();

        // ~

        /* Params */
        $requestData = Request::getPosts();
        $uploadedFile = Request::getFile('file');

        // ~

        /* Try get entity */
        $editedAlbum = intval($albumId) > 0 ? $libraryModel->findById(intval($albumId)) : false;

        /* Check if we will add or update record */
        if ($editedAlbum) {
            $albumEntity = $editedAlbum;

            // Complete data edited album.
            $requestData['id'] = $editedAlbum->getId();
            $requestData['value_1'] = $editedAlbum->getValue1();
            $requestData['value_2'] = $editedAlbum->getValue2();
        }

        // ~

        /* Prepare entity */
        $albumEntity->dump($requestData);
        $albumEntity->setType(LibraryEntity::TYPE_GALLERY);

        // ~

        /* Upload image */
        if ($uploadedFile['name']) {
            $file->setFile($uploadedFile);
            $file->upload();

            $albumEntity->setValue1($file->getName());
            $albumEntity->setValue2($file->getOriginalName());
        }

        // ~

        if ($editedAlbum)
            $libraryModel->update($albumEntity);
        else
            $libraryModel->insert($albumEntity);

        // ~

        Response::flashMessage(array('Pomyślnie zapisano'), 'success', true);
        Response::redirect(array('manageGallery', 'showAlbums'));
    }

    /**
     * Upload and save to db photos.
     */
    public function savePhotosAction()
    {
        $file = new File();
        $photoEntity = new LibraryEntity();
        $libraryModel = new LibraryModel();

        // ~

        /* Params */
        $uploadedFiles = Request::getFile('files');
        $albumId = Request::getPost('album_id', 'int');

        // ~

        $albumEntity = $libraryModel->findById($albumId);

        if (!$albumEntity)
            die();

        // ~

        /* If uploaded files */
        if ($uploadedFiles['tmp_name'][0]) {
            $count = count($uploadedFiles['tmp_name']);

            for ($i = 0; $i < $count; $i++) {

                /* Tmp solution ... */
                /* Build structure file */
                $tmpFile['size'] = $uploadedFiles['size'][$i];
                $tmpFile['name'] = $uploadedFiles['name'][$i];
                $tmpFile['type'] = $uploadedFiles['type'][$i];
                $tmpFile['error'] = $uploadedFiles['error'][$i];
                $tmpFile['tmp_name'] = $uploadedFiles['tmp_name'][$i];

                $file->setFile($tmpFile);
                $file->upload();

                $photoEntity->setParentId($albumId);
                $photoEntity->setValue1($file->getName());
                $photoEntity->setName($file->getOriginalName());
                $photoEntity->setType(LibraryEntity::TYPE_GALLERY);

                $libraryModel->insert($photoEntity);
            }
        }

        // ~

        Response::flashMessage(array('Pomyślnie dodano'), 'success', true);
        Response::redirect(array('manageGallery', 'showPhotos', $albumEntity->getId()));
    }

    /**
     * Delete album with all photos.
     */
    public function deleteAlbumAction()
    {
        $tool = new Tool();
        $libraryModel = new LibraryModel();

        // ~

        /* Params */
        $albumId = Request::getPost('id', 'int');

        // ~

        $albumEntity = $libraryModel->findById(intval($albumId));

        if (!$albumEntity)
            die();

        // ~

        /* Get photos list */
        $photos = $libraryModel->findByParentAndType($albumEntity->getId(), LibraryEntity::TYPE_GALLERY);

        /* Remove file */
        foreach ($photos as $photo) {
            $tool->deleteFiles('uploads/' . $photo->getValue1());
            $libraryModel->delete($photo);
        }

        /* Remove from database */
        $libraryModel->delete($albumEntity);

        // ~

        Response::flashMessage(array('Pomyślnie usunięto'), 'success', true);
        Response::redirect(array('manageGallery', 'showAlbums'));
    }

    /**
     * Delete single photo.
     */
    public function deletePhotoAction()
    {
        $tool = new Tool();
        $libraryModel = new LibraryModel();

        // ~

        /* Params */
        $photoId = Request::getPost('id', 'int');

        // ~

        $photoEntity = $libraryModel->findById(intval($photoId));

        if (!$photoEntity)
            die();

        // ~

        /* Remove file */
        $tool->deleteFiles('uploads/' . $photoEntity->getValue1());

        /* Remove from database */
        $libraryModel->delete($photoEntity);

        // ~

        Response::flashMessage(array('Pomyślnie usunięto'), 'success', true);
        Response::redirect(array('manageGallery', 'showPhotos', $photoEntity->getParentId()));
    }
}