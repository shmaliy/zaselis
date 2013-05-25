<?php

class IndexController extends Zend_Controller_Action
{
    private $_model;
    private $_image;
    
    public function init()
    {
        $this->_model = new Core_Model_Abstract();
        
        $ajaxContext = $this->_helper->getHelper('AjaxContext');
        $ajaxContext->addActionContext('support', 'json');
        $ajaxContext->initContext('json');
        $this->_image = new My_Image_Image();
    }

    public function indexAction()
    {
    	$request = $this->getRequest();
    	$params = $request->getParams();
        
        $this->_model->getLanguagesList();
        $this->_model->getCurrenciesList();
    }
    
    
}



