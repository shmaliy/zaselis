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
            $router = $this->setRouter();	    	
            $front = Zend_Controller_Front::getInstance();            
            $front->setRouter($router);            
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
        $router = new Zend_Controller_Router_Rewrite();
        //$router->removeDefaultRoutes();

        $model = new Core_Model_Abstract();

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



        return $router;
    }
	
    public function setModules()
    {
        //$modules = new Ext_Modules_Load();
    //Zend_Registry::set('modules', $modules->getList());
    }
}

