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
        $ajaxContext->addActionContext('change-password', 'json');
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
        $request = $this->getRequest();
        $params = $request->getParams();
        
        $form = new Application_Form_ChangePassword();
        
        if ($request->isXmlHttpRequest() || $request->isPost()) {
            if ($form->isValid($params)) {
                if($params['new_psw'] == $params['new_psw_rep']) {
                    $this->_model->changePassword($params['new_psw']);
                } else {
                    $this->view->formErrors    = array('new_psw_rep' => array('passwordsNotMatch'));
                }
            } else {
                $this->view->formErrors        = $form->getErrors();
    		$this->view->formErrorMessages = $form->getErrorMessages();
            }
        }
       
    } 
}