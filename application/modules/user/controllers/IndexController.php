<?php

class User_IndexController extends Zend_Controller_Action
{

    private $_model;
    
    public function init()
    {
        $ajaxContext = $this->_helper->getHelper('AjaxContext');
        $ajaxContext->addActionContext('simple-register', 'json');
        $ajaxContext->addActionContext('auth', 'json');
        $ajaxContext->addActionContext('restore-password', 'json');
        $ajaxContext->initContext('json');
        $this->_model = new User_Model_Users();
    }
    
    public function indexAction()
    {

    } 
    
    public function simpleRegisterAction()
    {
        $form = new Application_Form_SimpleRegister();
        $request = $this->getRequest();
        $params = $request->getParams();
        
        if ($request->isXmlHttpRequest() || $request->isPost()) {
            if ($form->isValid($params)) {
                $values = $form->getValues();
                if ($this->_model->registerSimple($values)) {
                    $this->view->formErrors = $form->getErrors();
                } else {
                    $this->view->formErrors = array('global' => 'error');
                }
            } else {
                $this->view->formErrors        = $form->getErrors();
    		$this->view->formErrorMessages = $form->getErrorMessages();
            }
        }
    }
    
    public function userActivateAction()
    {
        
        $request = $this->getRequest();
        $params = $request->getParams();
        
        $this->_model->userActivate($params['code']);
        $this->_helper->redirector('index', 'index', 'default');
    }
    
    public function authAction()
    {
        if (Zend_Auth::getInstance()->hasIdentity()) {
            return;
        }
        
        $form = new Application_Form_SimpleAuth();
        $request = $this->getRequest();
        $params = $request->getParams();
        if ($request->isXmlHttpRequest() || $request->isPost()) {
            if ($form->isValid($params)) {
                $values = $form->getValues();
                
                $authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter());
                $authAdapter->setTableName('z_users')
				->setIdentityColumn('email')
				->setCredentialColumn('password');
                
                $username = $this->getRequest()->getPost('email');
		$password = $this->_model->preparePasswordToCompare($this->getRequest()->getPost('password'));
                
                $authAdapter->setIdentity($username)
		            ->setCredential($password);
                
                $auth = Zend_Auth::getInstance();
                $result = $auth->authenticate($authAdapter);
                
                if ($result->isValid()) {
                    
                    if ($this->_model->isActive($username)) {
                        $identity = $authAdapter->getResultRowObject();

                        $authStorage = $auth->getStorage();

                        $authStorage->write($authAdapter->getResultRowObject(array(
                            'z_users_id',
                            'email',
                            'z_users_roles_id',
                        )));

                        $this->view->redirect =  true;

                    } else {
                        $this->view->formErrors        = array('activation' => 'error');
                    }
                    
		} else {
                    $this->view->formErrors        = array('global' => 'error');
		}
                
            } else {
                $this->view->formErrors        = $form->getErrors();
    		$this->view->formErrorMessages = $form->getErrorMessages();
            }
            
        }
    }
    
    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
	$this->_helper->redirector('index', 'index', 'default');
    }
    
    public function restorePassword()
    {
        
    }
	
}