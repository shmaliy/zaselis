<?php

class IndexController extends Zend_Controller_Action
{
    private $_model;
    private $_image;
    private $_model_user;
    private $_model_flats;
    
    public function init()
    {
        $this->_model = new Core_Model_Abstract();
        $this->_model_user = new User_Model_Users();
        $this->_model_flats = new Flats_Model_Flats();
        $ajaxContext = $this->_helper->getHelper('AjaxContext');
        
        $ajaxContext->initContext('json');
        $this->_image = new My_Image_Image();
    }

    public function indexAction()
    {
    	$request = $this->getRequest();
    	$params = $request->getParams();
    }
    
    public function mapAction()
    {
        if (!Zend_Auth::getInstance()->hasIdentity() || !$this->_model_user->isActiveSession()) {
	    
        } else {
            $user = $this->_model_user->getActiveUser();
        }
        
        $this->_helper->_layout->setLayout('map-layout');
        
        $this->view->list = $this->_model_flats->getFlatsForMap();
        
    }
    
    public function sliderAction()
    {
        $list = $this->_model_flats->getFlatsForSlider();
        $this->view->items = json_encode($list);
    }
    
    public function searchFormAction()
    {
        
    }

    public function headerAction()
    {


        try {
            $userAuth = Zend_Auth::getInstance()->getIdentity();
            $user = $this->_model_user->getActiveUser();
        } catch (Exception $e) {
            $user = null;
        }

        $this->view->user = $user;

        $fb = new User_Model_Fb();
        $this->view->client_id = $fb->clientId;

//        echo '<pre>';
//        var_export($user);
//        echo '</pre>';
    }
    
    
    
    
}



