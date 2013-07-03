<?php

require_once "Core/View/Helper/Abstract.php";

class Core_View_Helper_Common extends Core_View_Helper_Abstract
{
    public function common()
    {
        return $this;
    }
    
    public function langSelector()
    {
        $model = new Core_Model_Abstract();
        $this->view->current = Zend_Registry::get('lang');
        $this->view->languages = $model->getLanguagesList();
        return $this->view->render('lang-selector.php3');
    }
    
    public function currSelector()
    {
        $model = new Core_Model_Abstract();
        $this->view->current = Zend_Registry::get('currencie');
        $this->view->currencies = $model->getCurrenciesList();
        return $this->view->render('currencie-selector.php3');
    }
    
    public function loginForm()
    {
        $lang = Zend_Registry::get('lang');
        $form = new Application_Form_SimpleAuth();
        $this->view->form = $form;
        return $this->view->render('login-form.php3');
    }
    
    public function regForm()
    {
        $lang = Zend_Registry::get('lang');
        $form = new Application_Form_SimpleRegister();
        $this->view->form = $form;
        return $this->view->render('reg-form.php3');
    }
    
    public function restorePasswordForm()
    {
        $lang = Zend_Registry::get('lang');
        $form = new Application_Form_ForgotPassword();
        $this->view->form = $form;
        return $this->view->render('forgot-password.php3');
    }
    
    public function userDrop()
    {
        $model = new User_Model_Users();
        $user = $model->getActiveUser();
        $this->view->user = $user;
        return $this->view->render('user-drop.php3');
    }
    
    public function userMenu()
    {
        $model = new User_Model_Users();
        $user = $model->getActiveUser();
        $this->view->user = $user;
        return $this->view->render('user-menu.php3');
    }
    
    public function header()
    {
        $model = new User_Model_Users();
        
        if (!$model->isActiveSession()) {
            $this->view->active = 0;
        } else {
            $this->view->active = 1;
        }
        return $this->view->render('header.php3');
    }
    
    public function avatarManger() 
    {
        return $this->view->render('manage-avatar.php3');
    }
    
    public function changePassword()
    {
        $this->view->form = new Application_Form_ChangePassword();
        return $this->view->render('change-password.php3');
    }
    
    public function indexSlider()
    {
        return $this->view->render('index-slider.php3');
    }
}
