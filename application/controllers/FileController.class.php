<?php

/**
 * Created by PhpStorm.
 * User: kuba
 * Date: 07.05.16
 * Time: 11:08
 */
class FileController
{
    public function indexAction()
    {

    }

    public function uploadImageAction()
    {
        $file = new File();

        // ~

        $uploadDirectory = 'uploads/';
        $message = 'Dodano pomyślnie';
        $uploadedFile = Request::getFile('upload');

        // ~

        $file->setDirectory($uploadDirectory);
        $file->setFile($uploadedFile);

        if (!$file->upload())
            $message = 'Wystąpił błąd podczas kopiowania pliku.';

        // ~

        $script = '<script type="text/javascript">
                    window.parent.CKEDITOR.tools.callFunction('. $_GET['CKEditorFuncNum'] .', "'. UPLOADS_URL . $file->getName() .'", "'. $message .'");
                </script>';

        echo $script;
    }
}