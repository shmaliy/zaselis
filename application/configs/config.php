<?php
switch ($_SERVER['HTTP_HOST']) {
    case 'public.zaselis':
    case 'www.public.zaselis':
        $cms_config_host = 'localhost';
        $cms_config_user = 'root';
        $cms_config_password = '';
        $cms_config_db = 'zaselis';
        break;
    case 'new.zaselis.com':
        $cms_config_host = 'localhost';
        $cms_config_user = 'zaselisc_dev';
        $cms_config_password = '1q2w3e4r5t';
        $cms_config_db = 'zaselisc_dev';
        break;
}

$cms_config_dbprefix = 'cms';

/**
 * Конфигурационный файл
 */


// Физический путь к корню сайта
$root = dirname(dirname(dirname(__FILE__)));
$root .= '/';


error_reporting(1);
// Масив настроек
$config = array(
    /*'s_db' => array(
            'adapter' => 'PDO_SQLITE',
            'params' => array(
                'dbname'  => $root . 'data/db/ironsearch_db.db',
                
            )
        ),   
    */
    'phpSettings' => array(
            'display_startup_errors' => 1,
            'display_errors' => 1,
            'date.timezone' => "Europe/Kiev"
    ),
    'includePaths' => array(
            'library' => $root . 'library'
    ),
    'bootstrap' => array(
            'path' => $root . 'application/Bootstrap.php',
            'class' => 'Bootstrap'
    ),
    'appnamespace' => 'Application',
    'resources' => array(
        'frontController' => array(
            'controllerDirectory' => $root . 'application/controllers',
            'params' => array(
                'displayExceptions' => 1
            ),
            'moduleDirectory' => $root . 'application/modules',
        ),
        'modules' => array(),
        'layout' => array(
            'layoutPath' => $root . 'application/layouts/scripts/',
            'layout' => 'layout',
            'viewSuffix' => 'php3'
        ),
        'view' => array(
            'encoding' => 'utf-8',
        ),
        'db' => array(
            'adapter' => 'PDO_MYSQL',
            'params' => array(
                'dbname' => $cms_config_db,
			    'host'     => $cms_config_host,
			    'username' => $cms_config_user,
			    'password' => $cms_config_password,
			    'driver_options' => array(
					PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
				)
            )
        ),
        
    )
);
