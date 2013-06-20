<?php 

switch ($_SERVER['HTTP_HOST']) {
    case 'public.zaselis_new':
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
?>