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
        $ajaxContext->addActionContext('edit-photos', 'json');
        $ajaxContext->initContext('json');
    }
    
    public function indexAction()
    {
        $list = $this->_model_flats->getFlatsForMap();
        $this->view->list = $list;
    }   
    
    public function editAction()
    {
        $request = $this->getRequest();
        $params = $request->getParams();
        
        $this->view->id = $params['id'];
        $this->view->tab = $request->getParam('tab', 'first');
        
    }  
    
    public function editFirstTabAction()
    {
        $request = $this->getRequest();
        $params = $request->getParams();
        
        $form = new Flats_Form_EditFirstTab();
        $types = $this->_model_flats->getFlatsTypesList();
        $roomTypes = $this->_model_flats->getFlatsRoomTypesList();
        $form->getElement('z_flats_types_id')->setMultiOptions($types);
        $form->getElement('z_flats_room_types_id')->setMultiOptions($roomTypes);
        
        
        if ($request->isXmlHttpRequest() || $request->isPost()) { 
            if ($form->isValid($params)) {
                $data = $form->getValues();
                
                $result = $this->_model_flats->saveFirstTab($data);
                $redirect = $this->view->url(array('id' => $result, 'tab' => 'first'), 'flat-edit-tab');
                $this->view->redirect = $redirect;
            } else {
                $this->view->formErrors        = $form->getErrors();
    		$this->view->formErrorMessages = $form->getErrorMessages();
            }
        } else {
            
            $form->getElement('z_flats_id')->setValue($params['id']);

            if ($params['id'] !== 'new') {
                $flat = $this->_model_flats->getFlat($params['id']);
                $form->setDefaults($flat);
            }
            $this->view->form = $form;
        }
        
    }
    
    public function editPhotosAction()
    {
        $request = $this->getRequest();
        $params = $request->getParams();
        
        if ($request->isXmlHttpRequest() || $request->isPost()) { 
//            var_export($params);
            foreach ($params['list'] as &$item) {
                $item = parse_url($item);
                $item = $item['path'];
            }
//            var_export($params['list']);
            
            $this->_model_flats->savePhotos($params['flatId'], $params['list']);
            
        } else {
            $flat = $this->_model_flats->getFlat($params['id']);
            $this->view->exist = $flat['photos'];
            $this->view->id = $params['id'];
        }
    }        
}