<?php

// Run auto loader.
spl_autoload_register('classLoader');
/**
 * Auto loader class.
 * @param $className
 */
function classLoader($className){
    $extension = '.class.php';

    $paths = array(
        MODELS . $className . $extension,
        CLASSES . $className . $extension,
        PLUGINS . $className . $extension,
        ENTITIES . $className . $extension,
        TEMPLATES . $className . $extension,
        SYSTEM_CLASS . $className . $extension,
    );

    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
        } else {
//            exit;
        }
    }
}




