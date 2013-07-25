<?php

class Flats_ManageController extends Zend_Controller_Action
{
    private $_model;
    private $_model_flats;
    
    public function init()
    {
        $this->_model = new User_Model_Users();
        $this->_model_flats = new Flats_Model_Flats();
        
        if (!Zend_Auth::getInstance()->hasIdentity() || !$this->_model->isActiveSession()) {
	    header ('Location: ' . $this->view->url(array(), 'logout'));
        }
        
        $this->_helper->_layout->setLayout('user-layout');
        $ajaxContext = $this->_helper->getHelper('AjaxContext');
        $ajaxContext->addActionContext('edit', 'json');
        $ajaxContext->addActionContext('edit-first-tab', 'json');
        $ajaxContext->initContext('json');
    }
    
    public function indexAction()
    {
        
    }   
    
    public function editAction()
    {
        $request = $this->getRequest();
        $params = $request->getParams();
        
        $this->view->id = $params['id'];
        
    }  
    
    public function editFirstTabAction()
    {
        $request = $this->getRequest();
        $params = $request->getParams();
        $form = new Flats_Form_EditFirstTab();
        
        $types = $this->_model_flats->getFlatsTypesList();
        $form->getElement('z_flats_types_id')->setMultiOptions($types);
        $form->getElement('z_flats_id')->setValue($params['id']);
        
        if ($request->isXmlHttpRequest() || $request->isPost()) { 
            if ($form->isValid($params)) {
                $data = $form->getValues();
                
                if ($this->_model_flats->saveFirstTab($data)) {
                    
                } else {
                    
                }
            } else {
                $this->view->formErrors        = $form->getErrors();
    		$this->view->formErrorMessages = $form->getErrorMessages();
            }
        } else {
            $this->view->form = $form;
        }
        
    }
}