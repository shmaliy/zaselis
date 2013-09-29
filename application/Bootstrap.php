<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{	
    public function run()
    {
        try {
            $this->setConfig();	        
            $this->setLoader();	    	
            $this->setModules(); // merge config with modules config           
            $this->setView();
            $this->setPlugins();
            $this->setDbAdapter();	    	
            $this->setRouter();	    	
                      
            //$front->registerPlugin(new Ext_Controller_Plugin_ModuleBootstrap, 1);
            Zend_Registry::set('interface', $this->_options['interface']);
            
        } catch (Exception $e) {
        	echo $e->getMessage();
        }
        
    	parent::run();
    }
	
    public function setPlugins()
    {
        $front = Zend_Controller_Front::getInstance();
        $front->registerPlugin(new Custom_Controller_Plugin_IEStopper(array('ieversion' => 7)));

    }
	
    public function setConfig()
    {
        Zend_Registry::set('options', $this->_options);    	
    }
    
    /**
     * 
     */
    public function setLoader()
    {
        $autoLoader = Zend_Loader_Autoloader::getInstance();		
        $autoLoader->setFallbackAutoloader(true);
    }    
    
    /**
     * 
     */
    public function setView()
    {
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRenderer->setViewSuffix('php3');
        $view = $this->getResource('view');
        
        $layout = Zend_Layout::getMvcInstance();
        $url = parse_url($_SERVER['REQUEST_URI']);
        $url = $url['path'];
        $url = trim($url, '/');
        $url = explode('/', $url);

        if($url[0] == 'admin'){
                $layout->setLayout('admin');
        } else {
                $layout->setLayout('layout');
        }
        $view->addHelperPath('Core/View/Helper', 'Core_View_Helper');
    }    

    public function setDbAdapter()
    {
        $db = Zend_Db::factory(new Zend_Config($this->_options['resources']['db']));
        Zend_Db_Table_Abstract::setDefaultAdapter($db);
        Zend_Registry::set('db', $db);
        $db->getConnection();
    }
	
    public function setRouter()
    {
        $frontController = Zend_Controller_Front::getInstance();
        $router = new Zend_Controller_Router_Rewrite();
        
        $model = new Core_Model_Abstract();
        $place = $model->writePosition();
        
        $lang = Zend_Registry::get('lang');
        $l_alias = $lang['alias'];
        $currencie = Zend_Registry::get('currencie');
        $c_alias = strtolower($currencie['alias']);



//	    include('classes/interface_lang/' . $lang . '.php');

//	    Zend_Registry::set('cache', $cache['cache']);
//	    
        
        $route = new Zend_Controller_Router_Route(
            ':lang/:currencie',
            array(
                'module' => 'default',
                'controller' => 'index',
                'action'     => 'index',
                'lang' => $l_alias,
                'currencie' => $c_alias
            )
        );
        $router->addRoute('index', $route);
        
        $route = new Zend_Controller_Router_Route(
            ':lang/:currencie/map',
            array(
                'module' => 'default',
                'controller' => 'index',
                'action'     => 'map',
                'lang' => $l_alias,
                'currencie' => $c_alias
            )
        );
        $router->addRoute('map', $route);
        
        $route = new Zend_Controller_Router_Route(
            ':lang/:currencie/ajax-route',
            array(
                'module' => 'user',
                'controller' => 'index',
                'action'     => 'ajax-route',
                'lang' => $l_alias,
                'currencie' => $c_alias
            )
        );
        $router->addRoute('ajax-route', $route);
        
        $route = new Zend_Controller_Router_Route(
            ':lang/:currencie/change-password',
            array(
                'module' => 'user',
                'controller' => 'manage',
                'action'     => 'change-password',
                'lang' => $l_alias,
                'currencie' => $c_alias
            )
        );
        $router->addRoute('change-password', $route);
        
        $route = new Zend_Controller_Router_Route(
            ':lang/:currencie/ajax/remove-single-phone',
            array(
                'module' => 'user',
                'controller' => 'manage',
                'action'     => 'remove-single-phone',
                'lang' => $l_alias,
                'currencie' => $c_alias
            )
        );
        $router->addRoute('ajax-remove-single-phone', $route);
        
        $route = new Zend_Controller_Router_Route(
            ':lang/:currencie/ajax/change-avatar',
            array(
                'module' => 'user',
                'controller' => 'manage',
                'action'     => 'avatar',
                'lang' => $l_alias,
                'currencie' => $c_alias
            )
        );
        $router->addRoute('ajax-avatar', $route);
        
        $route = new Zend_Controller_Router_Route(
            ':lang/:currencie/ajax/phone-activate',
            array(
                'module' => 'user',
                'controller' => 'manage',
                'action'     => 'phone-activate',
                'lang' => $l_alias,
                'currencie' => $c_alias
            )
        );
        $router->addRoute('ajax-phone-activate', $route);
        
        $route = new Zend_Controller_Router_Route(
            ':lang/:currencie/ajax/remove-avatar',
            array(
                'module' => 'user',
                'controller' => 'manage',
                'action'     => 'remove-avatar',
                'lang' => $l_alias,
                'currencie' => $c_alias
            )
        );
        $router->addRoute('ajax-remove-avatar', $route);
        
        $route = new Zend_Controller_Router_Route(
            ':lang/:currencie/user',
            array(
                'module' => 'user',
                'controller' => 'manage',
                'action'     => 'index',
                'lang' => $l_alias,
                'currencie' => $c_alias
            )
        );
        $router->addRoute('user-index', $route);
        
        $route = new Zend_Controller_Router_Route(
            ':lang/:currencie/user/avatar/upload',
            array(
                'module' => 'files',
                'controller' => 'index',
                'action'     => 'upload-avatar',
                'lang' => $l_alias,
                'currencie' => $c_alias
            )
        );
        $router->addRoute('upload-avatar', $route);
        
        $route = new Zend_Controller_Router_Route(
            ':lang/:currencie/user/profile',
            array(
                'module' => 'user',
                'controller' => 'manage',
                'action'     => 'profile',
                'lang' => $l_alias,
                'currencie' => $c_alias
            )
        );
        $router->addRoute('user-profile', $route);
        
        $route = new Zend_Controller_Router_Route(
            ':lang/:currencie/user/profile/contacts',
            array(
                'module' => 'user',
                'controller' => 'manage',
                'action'     => 'contacts',
                'lang' => $l_alias,
                'currencie' => $c_alias
            )
        );
        $router->addRoute('user-contacts', $route);
        
        $route = new Zend_Controller_Router_Route(
            ':lang/:currencie/user/profile/social-networks',
            array(
                'module' => 'user',
                'controller' => 'manage',
                'action'     => 'social-networks',
                'lang' => $l_alias,
                'currencie' => $c_alias
            )
        );
        $router->addRoute('user-social-networks', $route);
        
        $route = new Zend_Controller_Router_Route(
            ':lang/:currencie/user/mail',
            array(
                'module' => 'user',
                'controller' => 'manage',
                'action'     => 'mail',
                'lang' => $l_alias,
                'currencie' => $c_alias
            )
        );
        $router->addRoute('user-mail', $route);
        
        $route = new Zend_Controller_Router_Route(
            ':lang/:currencie/user/flats',
            array(
                'module' => 'user',
                'controller' => 'manage',
                'action'     => 'flats',
                'lang' => $l_alias,
                'currencie' => $c_alias
            )
        );
        $router->addRoute('user-flats', $route);
        
        $route = new Zend_Controller_Router_Route(
            ':lang/:currencie/user/travels',
            array(
                'module' => 'user',
                'controller' => 'manage',
                'action'     => 'travels',
                'lang' => $l_alias,
                'currencie' => $c_alias
            )
        );
        $router->addRoute('user-travels', $route);
        
        $route = new Zend_Controller_Router_Route(
            ':lang/:currencie/user/settings',
            array(
                'module' => 'user',
                'controller' => 'manage',
                'action'     => 'settings',
                'lang' => $l_alias,
                'currencie' => $c_alias
            )
        );
        $router->addRoute('user-settings', $route);
        
        $route = new Zend_Controller_Router_Route(
            ':lang/:currencie/user/friends',
            array(
                'module' => 'user',
                'controller' => 'manage',
                'action'     => 'friends',
                'lang' => $l_alias,
                'currencie' => $c_alias
            )
        );
        $router->addRoute('user-friends', $route);

        $route = new Zend_Controller_Router_Route(
            ':lang/:currencie/user/simple-register',
            array(
                'module' => 'user',
                'controller' => 'index',
                'action'     => 'simple-register',
                'lang' => $l_alias,
                'currencie' => $c_alias
            )
        );
        $router->addRoute('simple-register', $route);
        
        
        $route = new Zend_Controller_Router_Route(
            ':lang/:currencie/user/activate/:code',
            array(
                'module' => 'user',
                'controller' => 'index',
                'action'     => 'user-activate',
                'lang' => $l_alias,
                'currencie' => $c_alias
            )
        );
        $router->addRoute('user-activate', $route);
        
        
        $route = new Zend_Controller_Router_Route(
            ':lang/:currencie/user/auth',
            array(
                'module' => 'user',
                'controller' => 'index',
                'action'     => 'auth',
                'lang' => $l_alias,
                'currencie' => $c_alias
            )
        );
        $router->addRoute('auth', $route);
        
        $route = new Zend_Controller_Router_Route(
            ':lang/:currencie/user/logout',
            array(
                'module' => 'user',
                'controller' => 'index',
                'action'     => 'logout',
                'lang' => $l_alias,
                'currencie' => $c_alias
            )
        );
        $router->addRoute('logout', $route);
        
        $route = new Zend_Controller_Router_Route(
            ':lang/:currencie/user/restore-password',
            array(
                'module' => 'user',
                'controller' => 'index',
                'action'     => 'restore-password',
                'lang' => $l_alias,
                'currencie' => $c_alias
            )
        );
        $router->addRoute('restore-password', $route);

        $route = new Zend_Controller_Router_Route(
            ':lang/:currencie/user/flats/',
            array(
                'module' => 'flats',
                'controller' => 'manage',
                'action'     => 'index',
                'lang' => $l_alias,
                'currencie' => $c_alias
            )
        );
        $router->addRoute('flat-list', $route);
        
        $route = new Zend_Controller_Router_Route(
            ':lang/:currencie/user/flats/edit/:id',
            array(
                'module' => 'flats',
                'controller' => 'manage',
                'action'     => 'edit',
                'lang' => $l_alias,
                'currencie' => $c_alias
            )
        );
        $router->addRoute('flat-edit', $route);
        
        $route = new Zend_Controller_Router_Route(
            ':lang/:currencie/user/flats/edit/:id/:tab',
            array(
                'module' => 'flats',
                'controller' => 'manage',
                'action'     => 'edit',
                'lang' => $l_alias,
                'currencie' => $c_alias
            )
        );
        $router->addRoute('flat-edit-tab', $route);
        
        $route = new Zend_Controller_Router_Route(
            ':lang/:currencie/user/flats/edit/:id/params-and-beds/save-params',
            array(
                'module' => 'flats',
                'controller' => 'manage',
                'action'     => 'save-flats-params-greed',
                'lang' => $l_alias,
                'currencie' => $c_alias
            )
        );
        $router->addRoute('save-flats-params-greed', $route);
        
        $route = new Zend_Controller_Router_Route(
            ':lang/:currencie/user/flats/edit/:id/params-and-beds/save-beds',
            array(
                'module' => 'flats',
                'controller' => 'manage',
                'action'     => 'save-flats-beds-greed',
                'lang' => $l_alias,
                'currencie' => $c_alias
            )
        );
        $router->addRoute('save-flats-beds-greed', $route);
        
        $route = new Zend_Controller_Router_Route(
            ':lang/:currencie/user/flats/edit/first-tab',
            array(
                'module' => 'flats',
                'controller' => 'manage',
                'action'     => 'edit-first-tab',
                'lang' => $l_alias,
                'currencie' => $c_alias
            )
        );
        $router->addRoute('edit-first-tab', $route);
        
        $route = new Zend_Controller_Router_Route(
            ':lang/:currencie/user/flats/edit/photos',
            array(
                'module' => 'flats',
                'controller' => 'manage',
                'action'     => 'edit-photos',
                'lang' => $l_alias,
                'currencie' => $c_alias
            )
        );
        $router->addRoute('edit-photos', $route);
        
        
        
        $route = new Zend_Controller_Router_Route(
            ':lang/:currencie/user/flats/parameters',
            array(
                'module' => 'flats',
                'controller' => 'manage',
                'action'     => 'parameters-edit',
                'lang' => $l_alias,
                'currencie' => $c_alias
            )
        );
        $router->addRoute('parameters-edit', $route);
        
        $route = new Zend_Controller_Router_Route(
            ':lang/:currencie/user/flats/parameters/create',
            array(
                'module' => 'flats',
                'controller' => 'manage',
                'action'     => 'create-parameter',
                'lang' => $l_alias,
                'currencie' => $c_alias
            )
        );
        $router->addRoute('create-parameter', $route);
        
        $route = new Zend_Controller_Router_Route(
            ':lang/:currencie/user/avatar',
            array(
                'module' => 'user',
                'controller' => 'manage',
                'action'     => 'manage-avatar',
                'lang' => $l_alias,
                'currencie' => $c_alias
            )
        );
        $router->addRoute('manage-avatar', $route);
        
        $route = new Zend_Controller_Router_Route(
            ':lang/:currencie/user/flats/parameter-icon',
            array(
                'module' => 'flats',
                'controller' => 'manage',
                'action'     => 'set-parameter-icon',
                'lang' => $l_alias,
                'currencie' => $c_alias
            )
        );
        $router->addRoute('set-parameter-icon', $route);
        
        $route = new Zend_Controller_Router_Route(
            ':lang/:currencie/user/flats/parameter-values-list',
            array(
                'module' => 'flats',
                'controller' => 'manage',
                'action'     => 'parameter-values-list',
                'lang' => $l_alias,
                'currencie' => $c_alias
            )
        );
        $router->addRoute('get-parameter-values-list', $route);
        
        $route = new Zend_Controller_Router_Route(
            ':lang/:currencie/user/flats/add-param-value',
            array(
                'module' => 'flats',
                'controller' => 'manage',
                'action'     => 'add-param-value',
                'lang' => $l_alias,
                'currencie' => $c_alias
            )
        );
        $router->addRoute('add-param-value', $route);
        
        $route = new Zend_Controller_Router_Route(
            ':lang/:currencie/user/flats/save-parameters-values',
            array(
                'module' => 'flats',
                'controller' => 'manage',
                'action'     => 'save-parameters-values',
                'lang' => $l_alias,
                'currencie' => $c_alias
            )
        );
        $router->addRoute('save-parameters-values', $route);
        
        $route = new Zend_Controller_Router_Route(
            ':lang/:currencie/user/flats/remove-parameters-value',
            array(
                'module' => 'flats',
                'controller' => 'manage',
                'action'     => 'remove-parameters-value',
                'lang' => $l_alias,
                'currencie' => $c_alias
            )
        );
        $router->addRoute('remove-parameters-value', $route);
        
        $route = new Zend_Controller_Router_Route(
            ':lang/:currencie/user/flats/remove-param',
            array(
                'module' => 'flats',
                'controller' => 'manage',
                'action'     => 'remove-param',
                'lang' => $l_alias,
                'currencie' => $c_alias
            )
        );
        $router->addRoute('remove-param', $route);
        
        $route = new Zend_Controller_Router_Route(
            ':lang/:currencie/user/flats/beds',
            array(
                'module' => 'flats',
                'controller' => 'manage',
                'action'     => 'beds-edit',
                'lang' => $l_alias,
                'currencie' => $c_alias
            )
        );
        $router->addRoute('beds', $route);
        
        $route = new Zend_Controller_Router_Route(
            ':lang/:currencie/user/flats/beds/set-bed-icon',
            array(
                'module' => 'flats',
                'controller' => 'manage',
                'action'     => 'set-bed-icon',
                'lang' => $l_alias,
                'currencie' => $c_alias
            )
        );
        $router->addRoute('set-bed-icon', $route);
        
        
        $route = new Zend_Controller_Router_Route(
            ':lang/:currencie/user/flats/beds/remove-bed',
            array(
                'module' => 'flats',
                'controller' => 'manage',
                'action'     => 'remove-bed',
                'lang' => $l_alias,
                'currencie' => $c_alias
            )
        );
        $router->addRoute('remove-bed', $route);
        
        $route = new Zend_Controller_Router_Route(
            ':lang/:currencie/user/flats/beds/save-beds-greed',
            array(
                'module' => 'flats',
                'controller' => 'manage',
                'action'     => 'save-beds-greed',
                'lang' => $l_alias,
                'currencie' => $c_alias
            )
        );
        $router->addRoute('save-beds-greed', $route);
        
        
        
        $frontController->setRouter($router);
    }
	
    public function setModules()
    {
        //$modules = new Ext_Modules_Load();
    //Zend_Registry::set('modules', $modules->getList());
    }
}

