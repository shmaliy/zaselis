<?php
/** Zend_View_Helper_Abstract.php */
require_once 'Zend/View/Helper/Abstract.php';

class Core_View_Helper_Url extends Zend_View_Helper_Url
{

    public function url(array $urlOptions = array(), $name = null, $reset = false, $encode = true)
    {
        $router = Zend_Controller_Front::getInstance()->getRouter();
        if (Zend_Auth::getInstance()->hasIdentity()) {
	    $prefix = 'https://' . $_SERVER['HTTP_HOST'];
        } else {
            $prefix = 'http://' . $_SERVER['HTTP_HOST'];
        }

        return $prefix . $router->assemble($urlOptions, $name, $reset, $encode);
}
    
}