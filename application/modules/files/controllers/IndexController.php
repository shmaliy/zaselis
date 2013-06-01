<?php

class Files_IndexController extends Zend_Controller_Action
{
	
    public function init()
    {
        $this->_helper->_layout->setLayout('file-layout');
        $ajaxContext = $this->_helper->getHelper('AjaxContext');
        $ajaxContext->addActionContext('upload-avatar', 'json');
        $ajaxContext->initContext('json');
    }
    
    public function indexAction()
    {

    } 
    
    public function uploadAvatarAction()
    {
        var_export($this->getRequest());
    }
	
}