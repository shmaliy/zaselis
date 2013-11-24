<?php

class User_IndexController extends Zend_Controller_Action
{

    private $_model, $_fb_model;
    
    public function init()
    {
        $ajaxContext = $this->_helper->getHelper('AjaxContext');
        $ajaxContext->addActionContext('simple-register', 'json');
        $ajaxContext->addActionContext('auth', 'json');
        $ajaxContext->addActionContext('restore-password', 'json');
        $ajaxContext->addActionContext('ajax-route', 'json');
        $ajaxContext->initContext('json');
        $this->_model = new User_Model_Users();
        $this->fb = new User_Model_Fb();
    }
    
    public function indexAction()
    {

    }

    public function fbauthAction()
    {
        $request = $this->getRequest();
        $params = $request->getParams();

        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);

        $user = $this->fb->getUser();



        if (!empty($user['profile'])) {
            Zend_Registry::set('fb_profile', $user['profile']);
            $db_user = $this->_model->getUserByEmail($user['profile']['email']);

            $ob_user = new stdClass();
            $ob_user->z_users_id = $db_user['z_users_id'];
            $ob_user->email = $db_user['email'];
            $ob_user->z_users_roles_id = $db_user['z_users_roles_id'];

            if ($db_user) {
                $auth = Zend_Auth::getInstance();
                $authStorage = $auth->getStorage();

                $authStorage->write($ob_user);
                $user = Zend_Auth::getInstance()->getIdentity();
                $this->_model->writeRegisterSession($user->z_users_id);

                header('Location: https://' . $_SERVER['HTTP_HOST']);
            } else {

                $profile = Zend_Registry::get('fb_profile');

                $birth = explode('/', $profile['birthday']);

                $geo = $this->_model->googleGetAddress($profile['location']['name']);

                $z_users_insert = array(
                    'z_users_roles_id' => 3,
                    'email' => $profile['email'],
                    'name' => $profile['first_name'],
                    'firstname' => $profile['last_name'],
                    'birth' => mktime(0, 0, 0, $birth[0], $birth[1], $birth[2]),
                    'gender' => ($profile['gender'] == 'male') ? 'Male' : 'Female',
                    'avatar' => 'http://graph.facebook.com/' . $profile['username'] . '/picture',
                    'z_countries_id' => $this->_model->saveCountry($geo),
                    'z_states_id' => $this->_model->saveState($geo),
                    'z_towns_id' => $this->_model->saveTown($geo),
                    'created_ts' => time(),
                    'edited_ts' => time(),
                    'activate_code' => md5($profile['email']),
                    'social_networks' => array('fb' => $profile['username'])
                );

                $ins = $this->_model->registerFb($z_users_insert);

                if ($ins > 0) {
                    $ob_user = new stdClass();
                    $ob_user->z_users_id = $ins;
                    $ob_user->email = $z_users_insert['email'];
                    $ob_user->z_users_roles_id = $z_users_insert['z_users_roles_id'];

                    $auth = Zend_Auth::getInstance();
                    $authStorage = $auth->getStorage();

                    $authStorage->write($ob_user);
                    $user = Zend_Auth::getInstance()->getIdentity();

                    $this->_model->writeRegisterSession($user->z_users_id);

                    header('Location: https://' . $_SERVER['HTTP_HOST']);
                }

            }
        }






    }
    
    public function simpleRegisterAction()
    {
        $form = new Application_Form_SimpleRegister();
        $request = $this->getRequest();
        $params = $request->getParams();
        
        if ($request->isXmlHttpRequest() || $request->isPost()) {
            if ($form->isValid($params)) {
                if ($params['password'] == $params['password_p']) {
                    $values = $form->getValues();
                    unset($values['password_p']);
                    if ($this->_model->registerSimple($values)) {

                    } else {
                        $this->view->formErrors = array('global' => array('error'));
                    }
                } else {
                    $this->view->formErrors = array('password' => array('do_not_match'));
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
        $request = $this->getRequest();
        $params = $request->getParams();
        $form = new Application_Form_SimpleAuth();
        
        
        if ($request->isXmlHttpRequest() || $request->isPost()) {
            if ($form->isValid($params)) {
                
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
                    
                    $identity = $authAdapter->getResultRowObject();
                    $authStorage = $auth->getStorage();

                    $authStorage->write($authAdapter->getResultRowObject(array(
                        'z_users_id',
                        'email',
                        'z_users_roles_id',
                    )));
                    
                    $user = Zend_Auth::getInstance()->getIdentity();
                    
//                    $this->view->redirect =  $this->_model->getActiveUser();

//                    $active = $this->_model->getActiveUser();

                    $this->_model->writeRegisterSession($user->z_users_id);

                    $this->view->redirect =  true;

                    
		} else {
                    $this->view->formErrors        = array('global' => array('error'));
		}
                
            } else {
                $this->view->formErrors        = $form->getErrors();
    		$this->view->formErrorMessages = $form->getErrorMessages();
            }
            
        }
    }
    
    public function logoutAction()
    {
        $this->_model->closeActiveSession();
        Zend_Auth::getInstance()->clearIdentity();

        foreach ($_COOKIE as $name=>$value) {
            setcookie($name, '', -1);
        }

	    header('Location: ' . $this->view->url(array(), 'index'));
    }
    
    public function ajaxRouteAction()
    {
    	$request = $this->getRequest();
    	$params = $request->getParams();

        $this->view->route = $this->view->url($params['r_params'], $params['r_name']);

    }
    
    public function restorePasswordAction()
    {
        $form = new Application_Form_ForgotPassword();
        $request = $this->getRequest();
        $params = $request->getParams();
        
        if ($request->isXmlHttpRequest() || $request->isPost()) {
            if ($form->isValid($params)) {
                $this->_model->restorePassword($params['email']);
            } else {
                $this->view->formErrors        = $form->getErrors();
    		$this->view->formErrorMessages = $form->getErrorMessages();
            }
        }
    }
	
}