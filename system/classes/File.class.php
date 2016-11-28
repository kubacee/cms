<?php

/**
 * Created by PhpStorm.
 * User: kuba
 * Date: 15.02.16
 * Time: 11:14
 */
class File
{
    private $file;

    private $newName = '';
    private $extension = '';
    private $uploadDirectory = 'uploads/';

    public function __construct()
    {

    }

    public function upload()
    {
        $uploadedFile = $this->file;
        $tmpName = $uploadedFile['tmp_name'];

        return move_uploaded_file($tmpName, $this->uploadDirectory . $this->newName);
    }

    public function setFile($file)
    {
        $this->file = $file;

        $this->extension = $this->getExtension();
        $this->newName = $this->generateName($file);
    }

    public function getExtension()
    {
        $extension = false;

        $extensions = array(
            'application/zip' => 'zip',
            'image/png' => 'png',
            'image/jpg' => 'jpg',
            'image/gif' => 'gif',
            'image/jpeg' => 'jpg',
        );

        if (array_key_exists($this->file['type'], $extensions)) {
            $extension = $extensions[$this->file['type']];
        }

        return $extension;
    }

    public function getSize()
    {
        return $this->file['size'];
    }

    public function getName()
    {
        return $this->newName;
    }

    public function getOriginalName()
    {
        return $this->file['name'];
    }

    public function setDirectory($directory)
    {
        $this->uploadDirectory = $directory;
    }

    private function generateName($file)
    {
        $newName = time() . $file['name'];

        if ($this->extension) {
            $newName = md5(time() . rand(100, 999999) . $file['tmp_name'] . $file['name'])
                . '.' . $this->extension;
        }

        return $newName;
    }

    function deleteFiles($target)
    {
        if(!is_link($target) && is_dir($target))
        {
            // it's a directory; recursively delete everything in it
            $files = array_diff( scandir($target), array('.', '..') );
            foreach($files as $file) {
                $this->deleteFiles("$target/$file");
            }
            rmdir($target);
        }
        else
        {
            // probably a normal file or a symlink; either way, just unlink() it
            unlink($target);
        }
    }
}