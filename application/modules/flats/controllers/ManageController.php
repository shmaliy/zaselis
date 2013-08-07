<?php

class Flats_ManageController extends Zend_Controller_Action
{
    private $_model;
    private $_model_flats;
    private $_subdirs = array(
        'thumbnail', 'thumbnail-50-50', 'thumbnail-100-100', 'thumbnail-310-207', 'thumbnail-464-306'
    );
    
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
        $ajaxContext->addActionContext('parameters-edit', 'json');
        $ajaxContext->addActionContext('create-parameter', 'json');
        $ajaxContext->addActionContext('set-parameter-icon', 'json');
        $ajaxContext->addActionContext('parameter-values-list', 'html');
        $ajaxContext->addActionContext('parameters-edit', 'json');
        $ajaxContext->initContext('json');
    }
    
    public function indexAction()
    {
        $list = $this->_model_flats->getFlatsForMap();
        $this->view->list = $list;
    }   
    
    public function parametersEditAction()
    {
        $request = $this->getRequest();
        $params = $request->getParams();
        
        if ($request->isXmlHttpRequest() || $request->isPost()) { 
//            var_export($params);
            $this->_model_flats->saveParamsGreed($params['greed']);
            
        } else {
        
            $list = array();
            $list = $this->_model_flats->getManageParamsList();

            $this->view->list = $list;
        }
    }
    
    public function parameterValuesListAction()
    {
        $request = $this->getRequest();
        $params = $request->getParams();
        
        if ($request->isXmlHttpRequest() || $request->isPost()) { 
            $paramId = $params['paramId'];
            
            $form = new Flats_Form_ParamsValues();
            $this->view->form = $form;
            
            $new_values = $form->getValues();
            var_export($new_values);
            
            $this->view->list = $this->_model_flats->getParameterValuesList($paramId);
            
            if (is_array($params['greed'])) {
                
            }
            
            if (is_array($params['new'])) {
                
            }
        }
        
        $this->_helper->layout->disableLayout();
    }            
    
    public function setParameterIconAction()
    {
        $request = $this->getRequest();
        $params = $request->getParams();
        
        if ($request->isXmlHttpRequest() || $request->isPost()) { 
            $file = $request->getParam('file', null);
            if (!is_null($file)) {
                $file = parse_url($params['file']);
                $file = $file['path'];
            }
            
            $this->_model_flats->setParamIcon($params['paramId'], $file);
        }
    }
    
    public function createParameterAction()
    {
        $request = $this->getRequest();
        $params = $request->getParams();
        
//        var_export($params);
        
        if ($request->isXmlHttpRequest() || $request->isPost()) { 
            $errors = array();
            
            if (empty($params['title'])) {
                $errors['title'] = array('isEmpty');
            }
            
            if (empty($params['description'])) {
                $errors['description'] = array('isEmpty');
            }
            
            if (!empty($errors)) {
                $this->view->formErrors = $errors;
            } else {
                $type = $request->getParam('type', 'BOOLEAN');
                if ($type !== 'BOOLEAN') {
                    $type = 'TEXT';
                }
                
                $insert = array(
                    'title' => $params['title'],
                    'description' => $params['description'],
                    'type' => $type
                );
                
                $this->_model_flats->createParam($insert);
            }
        }
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
                $redirect = $this->view->url(array('id' => $result, 'tab' => 'photos'), 'flat-edit-tab');
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
            
            foreach ($params['remove'] as &$r) {
                $rem = array();
                $r = parse_url($r);
                $r = $r['path'];
                $rem[] = $r;
                
                foreach ($this->_subdirs as $dir) {
                    $rem[] = str_replace('/flats/', '/flats/' . $dir . '/', $r);
                }
                
                foreach ($rem as $file) {
                    unlink(ltrim($file, '/'));
                }
                
            }
            
            $this->_model_flats->savePhotos($params['flatId'], $params['list']);
            $redirect = $this->view->url(array('id' => $params['flatId'], 'tab' => 'photos'), 'flat-edit-tab');
            $this->view->redirect = $redirect;
            
        } else {
            $flat = $this->_model_flats->getFlat($params['id']);
            $this->view->exist = $flat['photos'];
            $this->view->id = $params['id'];
        }
    }        
}