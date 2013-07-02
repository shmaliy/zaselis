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
        $ajaxContext->addActionContext('profile', 'json');
        $ajaxContext->addActionContext('contacts', 'json');
        $ajaxContext->initContext('json');
        
    }
    
    public function indexAction()
    {
        $this->_model->isActiveSession();
        
        // z_countries country
        // z_states administrative_area_level_1
        // z_towns locality
        
//        $this->_model->codeCleaner();
        
    } 
    
    public function profileAction()
    {
        $request = $this->getRequest();
        $params = $request->getParams();
        
        $form = new User_Form_ProfileEdit();
        $form->setDefaults($this->_model->prepareUserProfileData());
        
        if ($request->isXmlHttpRequest() || $request->isPost()) {
            if ($form->isValid($params)) {
                $this->_model->saveUserProfileData($params);
            } else {
                $this->view->formErrors        = $form->getErrors();
    		$this->view->formErrorMessages = $form->getErrorMessages();
            }
        } else {
            $this->view->form = $form;
        }
    } 
    
    public function mailAction()
    {
        
    } 
    
    public function contactsAction()
    {
        $request = $this->getRequest();
        $params = $request->getParams();
        
        $data = $this->_model->getActiveUser();
//        echo '<pre>';
//        var_export($data['phones']);
//        echo '</pre>';
        
        if ($request->isXmlHttpRequest() || $request->isPost()) { 
            
            $insert = array();
            foreach ($params['phone'] as $key=>$num) {
                if(!empty($num)) {
                    $activate = md5($num);
                    $activate = str_split($activate);
                    array_splice($activate, 5);
                    $insert[] = array(
                        'z_countries_id' => $params['country'][$key],
                        'number'         => $num,
                        'activate'       => implode('', $activate)
                    );
                }
            }
            if (!empty($insert)) {
                $ins = array_merge($data['phones'], $insert);
                $this->_model->saveUserPhones($ins);
            }
            
        } else {
            $this->view->country = $data['session_country'];
            $this->view->codes = $this->_model->getPhoneCodes();
            
            foreach ($data['phones'] as $phone) {
                $code = $this->_model->getPhoneCode($phone->z_countries_id);
                $phone->z_countries_id = $code['code'];
            }
            
            $this->view->phones = $data['phones'];
        }
        
        
        
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