<?php
error_reporting(1);
//session_start();


/* Корневой каталог */
if (!defined('ROOT_PATH')) {
	define('ROOT_PATH', realpath(dirname(dirname(__FILE__))));
}

/* Каталог приложения */
if (!defined('APPLICATION_PATH')) {
	define('APPLICATION_PATH', ROOT_PATH . '/application');
}



/* Каталог библиотек ZEND */
if (!defined('LIBRARY_PATH')) {

    switch ($_SERVER['HTTP_HOST']) {
        case 'www.public.zaselis':
        case 'public.zaselis':
            if (file_exists(realpath(ROOT_PATH . '/../..') . '/home/phpLibs')) {
                $libraryPath[] = realpath(ROOT_PATH . '/../..' . '/home/phpLibs');
            }
            $libraryPath[] = ROOT_PATH . '/library';
            break;
        case 'new.zaselis.com':
            if (file_exists(realpath(ROOT_PATH . '/../..') . '/phpLibs')) {
                $libraryPath[] = realpath(ROOT_PATH . '/../..' . '/phpLibs');
            }
            $libraryPath[] = ROOT_PATH . '/library';
            break;
    }
    
    
	define('LIBRARY_PATH', implode(PATH_SEPARATOR, $libraryPath));
	unset($libraryPath);
}



/* Каталог публично доступных файлов */
if (!defined('PUBLIC_PATH')) {
	define('PUBLIC_PATH', ROOT_PATH . '/public');
}



/* Установка среды */
if (!defined('APPLICATION_ENV')) {
    define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));
}

// Подключение файла настроек
require_once APPLICATION_PATH . '/configs/config.php';

////Установка в include_path папки библиотек
set_include_path(implode(PATH_SEPARATOR, array(
    LIBRARY_PATH,
    get_include_path(), 
    APPLICATION_PATH . '/../public/classes'
)));

require_once('facebook/facebook.php');


/** Подключение Zend_Application */
require_once 'Zend/Application.php';


// Создание обьекта приложения и запуск
$application = new Zend_Application(
    APPLICATION_ENV,
    $config
);
$application->bootstrap()->run();