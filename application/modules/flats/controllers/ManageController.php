<?php

class Flats_ManageController extends Zend_Controller_Action
{
    private $_model;
    private $_model_flats;
    private $_model_geo;
    private $_subdirs = array(
        'thumbnail', 'thumbnail-50-50', 'thumbnail-100-100', 'thumbnail-310-207', 'thumbnail-464-306'
    );
    
    public function init()
    {
        $this->_model = new User_Model_Users();
        $this->_model_flats = new Flats_Model_Flats();
        $this->_model_geo = new Application_Model_Geographic();
        
        if (!Zend_Auth::getInstance()->hasIdentity() || !$this->_model->isActiveSession()) {
	        header ('Location: ' . $this->view->url(array(), 'logout'));
        }


        
        $this->_helper->_layout->setLayout('user-layout');
        $ajaxContext = $this->_helper->getHelper('AjaxContext');
        $ajaxContext->addActionContext('edit', 'json');
        $ajaxContext->addActionContext('edit-first-tab', 'json');
        $ajaxContext->addActionContext('edit-photos', 'json');
        $ajaxContext->addActionContext('edit-params-and-beds', 'json');
        $ajaxContext->addActionContext('parameters-edit', 'json');
        $ajaxContext->addActionContext('create-parameter', 'json');
        $ajaxContext->addActionContext('set-parameter-icon', 'json');
        $ajaxContext->addActionContext('parameter-values-list', 'html');
        $ajaxContext->addActionContext('parameters-edit', 'json');
        $ajaxContext->addActionContext('add-param-value', 'json');
        $ajaxContext->addActionContext('save-parameters-values', 'json');
        $ajaxContext->addActionContext('remove-parameters-value', 'json');
        $ajaxContext->addActionContext('remove-param', 'json');
        $ajaxContext->addActionContext('beds-edit', 'json');
        $ajaxContext->addActionContext('set-bed-icon', 'json');
        $ajaxContext->addActionContext('save-beds-greed', 'json');
        $ajaxContext->addActionContext('remove-bed', 'json');
        $ajaxContext->addActionContext('save-flats-params-greed', 'json');
        $ajaxContext->addActionContext('save-flats-beds-greed', 'json');
        $ajaxContext->addActionContext('edit-prices', 'json');
        $ajaxContext->addActionContext('countries-manage', 'json');
        $ajaxContext->addActionContext('towns-manage', 'json');
        $ajaxContext->initContext('json');
    }

    public function adsInnerHtmlAction()
    {
        $this->view->user = $this->_model->getActiveUser();

    }
    
    public function indexAction()
    {
        $list = $this->_model_flats->getFlatsForManage();
        
        foreach ($list as &$flat) {
            $flat['avatar'] = '';
            if (is_array($flat['photos'])) {
                $avatar = reset($flat['photos']);
                $flat['avatar'] = str_replace('/flats/', '/flats/' . $this->_subdirs[3] . '/', $avatar);
            }
        }
        
//        echo '<pre>';
//        var_export($list);
//        echo '</pre>';

        $this->view->list = $list;
    }   
    
    public function countriesManageAction()
    {
        $request = $this->getRequest();
        $params = $request->getParams();
        $user = $this->_model->getActiveUser();
        if ($user['z_users_roles_id'] != 1) {
            header ('Location: ' . $this->view->url(array(), 'user-index'));
        }

        if ($request->isXmlHttpRequest() || $request->isPost()) {
            $this->_model_geo->saveCountriesGreed($params['greed']);
        } else {
            $this->view->list = $this->_model_geo->getCountriesForManage();
        }
    }

    public function townsManageAction()
    {
        $request = $this->getRequest();
        $params = $request->getParams();

        $user = $this->_model->getActiveUser();
        if ($user['z_users_roles_id'] != 1) {
            header ('Location: ' . $this->view->url(array(), 'user-index'));
        }

        if ($request->isXmlHttpRequest() || $request->isPost()) {
            $this->_model_geo->saveTownsGreed($params['greed']);
        } else {
            $this->view->country = $this->_model_geo->getCountryById($params['country']);
            $this->view->towns = $this->_model_geo->getTownsForManage($params['country']);
        }
    }

    public function bedsEditAction()
    {
        $request = $this->getRequest();
        $params = $request->getParams();
        
        $form = new Flats_Form_CreateBed();
        
        if ($request->isXmlHttpRequest() || $request->isPost()) { 
            if ($form->isValid($params)) {
                $this->_model_flats->createBed($form->getValues());
                
            } else {
                $this->view->formErrors        = $form->getErrors();
    		$this->view->formErrorMessages = $form->getErrorMessages();
            }
        } else {
            $this->view->list = $this->_model_flats->getManageBedsList();
            $this->view->form = $form;
        }
    }
    
    public function removeBedAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();
        
        $request = $this->getRequest();
        $params = $request->getParams();
        
        $this->_model_flats->removeBed($params['bedId']);
    }
    
    public function saveBedsGreedAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();
        
        $request = $this->getRequest();
        $params = $request->getParams();
        
        $this->_model_flats->saveBedsGreed($params['greed']);
        
    }
    
    public function setBedIconAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();
        
        $request = $this->getRequest();
        $params = $request->getParams();
        
        if ($request->isXmlHttpRequest() || $request->isPost()) { 
            $file = $request->getParam('file', null);
            if (!is_null($file)) {
                $file = parse_url($params['file']);
                $file = $file['path'];
            }
            
            $this->_model_flats->setBedIcon($params['bedId'], $file);
        }
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
    
    public function removeParamAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();
        
        $request = $this->getRequest();
        $params = $request->getParams();
        
        $this->_model_flats->removeParam($params['paramId']);
        
    }
    
    public function parameterValuesListAction()
    {
        $request = $this->getRequest();
        $params = $request->getParams();
        
        if ($request->isXmlHttpRequest() || $request->isPost()) { 
            $paramId = $params['paramId'];
            
            $form = new Flats_Form_ParamsValues();
            $form->getElement('z_flats_params_id')->setValue($paramId);
            $this->view->form = $form;
            
            $this->view->list = $this->_model_flats->getParameterValuesList($paramId);
        }
        
        $this->_helper->layout->disableLayout();
    } 
    
    public function addParamValueAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();
        $form = new Flats_Form_ParamsValues();
        
        $request = $this->getRequest();
        $params = $request->getParams();
        
        if ($request->isXmlHttpRequest() || $request->isPost()) { 
            if ($form->isValid($params)) {
                $this->_model_flats->createParametersValue($form->getValues());
                
            } else {
                $this->view->formErrors        = $form->getErrors();
    		$this->view->formErrorMessages = $form->getErrorMessages();
            }
        }
    }
    
    public function saveParametersValuesAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();
        $request = $this->getRequest();
        $params = $request->getParams();
        
        $this->_model_flats->saveParametersValues($params['greed']);
    }
    
    public function removeParametersValueAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();
        $request = $this->getRequest();
        $params = $request->getParams();
        
        $this->_model_flats->removeParametersValue($params['paramId']);
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
    
    public function editParamsAndBedsAction()
    {
        $request = $this->getRequest();
        $params = $request->getParams();
        
        
        if ($request->isXmlHttpRequest() || $request->isPost()) { 
            
        } else {
            $this->view->params = $this->_model_flats->getParamsList($params['id']);
            $this->view->params_values = $this->_model_flats->getParamsValuesList();
            $this->view->id = $params['id'];
            
            $this->view->beds = $this->_model_flats->getUserBedsList();
            $this->view->bCounts = $this->_model_flats->getFlatBedsRelations($params['id']);
        }
    }
    
    public function editPricesAction()
    {
        $request = $this->getRequest();
        $params = $request->getParams();

        $main_price_form = new Flats_Form_MainPrice();



        if ($request->isXmlHttpRequest() || $request->isPost()) {
            if ($main_price_form->isValid($params)) {
                $this->_model_flats->setFlatMainPrice($main_price_form->getValues());
            } else {
                $this->view->formErrors        = $main_price_form->getErrors();
                $this->view->formErrorMessages = $main_price_form->getErrorMessages();
            }
        } else {

            $main_exist = $this->_model_flats->getFlatMainPrice($params['id']);

            if ($main_exist) {
                $main_price_form->getElement('main_1')->setValue($main_exist['price']);
                $main_price_form->getElement('main_2')->setValue($main_exist['cleaning']);
            }

            $main_price_form->getElement('z_flats_id')->setValue($params['id']);
            $this->view->mpf = $main_price_form;
        }

    }
    
    public function saveFlatsBedsGreedAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();
        $request = $this->getRequest();
        $params = $request->getParams();
//        var_export($params);
        
        $this->_model_flats->saveFlatsBedsGreed($params['id'], $params['greed']);
    }
    
    public function saveFlatsParamsGreedAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();
        $request = $this->getRequest();
        $params = $request->getParams();
        
        $this->_model_flats->saveFlatsParamsGreed($params['id'], $params['greed']) ;
        
//        var_export($params);
    }
}