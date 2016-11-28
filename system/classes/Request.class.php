<?php

/**
 * Operation on request.
 * Date: 2015-12-08
 * Time: 22:39
 */
class Request
{
    public static function isPost() {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    public static function getGet($name, $parser = null) {
        $data = @$_GET[$name];

        switch ($parser){
            case 'int':
                $data = intval($data);
                break;
            case 'escape string':
                $data = trim(htmlspecialchars(addslashes($data)));
                break;
            case 'strip_tags':
                $data = strip_tags($data);
                break;
        }

        return $data;
    }

    /**
     * @deprecated
     */
    public static function getPost2($name) {
        return @$_POST[$name];
    }

    public static function getPost($name, $parser = null) {


        $postData = isset($_POST[$name]) ? $_POST[$name] : null;

        switch ($parser){
            case 'int':
                $postData = intval($postData);
                break;
            case 'escape string':
                $postData = trim(htmlspecialchars(addslashes($postData)));
                break;
            case 'strip_tags':
                $postData = strip_tags($postData);
                break;
        }

        return $postData;
    }

    public static function getStringPost($name) {
        $post = addslashes(htmlspecialchars(trim(@$_POST[$name])));

        return $post;
    }

    public static function getDigitPost($name) {
        $post = intval(@$_POST[$name]);

        return $post;
    }

    public static function getPosts() {
        return isset($_POST) ? $_POST : '';
    }

    public static function getFile($name) {
        return @$_FILES[$name];
    }

    public static function getFiles() {
        return @$_FILES;
    }

}