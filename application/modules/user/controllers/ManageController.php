<?php

class User_ManageController extends Zend_Controller_Action
{

    private $_model;
    
    public function init()
    {
        $this->_model = new User_Model_Users();
        if (!Zend_Auth::getInstance()->hasIdentity() || !$this->_model->isActiveSession()) {
	    header ('Location: ' . $this->view->url(array(), 'logout'));
        }
        
        $this->_helper->_layout->setLayout('user-layout');
        $ajaxContext = $this->_helper->getHelper('AjaxContext');
//        $ajaxContext->addActionContext('restore-password', 'json');
        $ajaxContext->initContext('json');
        
    }
    
    public function indexAction()
    {
        $this->_model->isActiveSession();
    } 
    
    public function profileAction()
    {
        
    } 
    
    public function mailAction()
    {
        
    } 
    
    public function flatsAction()
    {
        
    } 
    
    public function travelsAction()
    {
        
    } 
    
    public function settingsAction()
    {
        
    } 
    
    public function friendsAction()
    {
        
    } 
    
    public function changePasswordAction()
    {
        
    } 
}