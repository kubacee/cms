<?php

//define('SMARTY_DIR', SMARTY);

class View
{
    private static $template;
    private static $name;

    /**
     * Function create smarty object.
     */
    public static function create() {
        $smarty = new Smarty();
        $auth = new Authorize();

        // Check if there are flash messages.
        $flashMessages = self::checkFlashMessage();

        $smarty->caching = 0;
        $smarty->setCompileDir(SMARTY);
        $smarty->setTemplateDir(VIEWS);
        $smarty->assign(array(
            'jsUrl' => JS_URL,
            'cssUrl' => CSS_URL,
            'imagesUrl' => IMAGES_URL,
            'uploadsUrl' => UPLOADS_URL,
            'publicUrl' => PUBLIC_URL,
            'flash_message' => $flashMessages,
            'auth' => $auth,
        ));

        self::$template = $smarty;
    }

    /**
     * Function set template.
     * @param $template
     */
    public static function setTemplate($template) {
        self::$name = $template . '.tpl';
    }

    /**
     * Function add data to template.
     * @param array $array
     */
    public static function setData(array $array) {
        self::$template->assign($array);
    }

    /**
     * Function display template.
     */
    public static function display() {
        self::$template->display(self::$name);
        SessionManager::set('flash_message', null);
    }

    public static function returnView($template, $renderData = array())
    {
        self::setTemplate($template);
        self::setData($renderData);
        self::display();
        exit;
    }

    private function checkFlashMessage() {
        $flashMessage = false;

        if (SessionManager::is('flash_message')) {
            $flashMessage = SessionManager::get('flash_message');
        }

        return $flashMessage;
    }
}