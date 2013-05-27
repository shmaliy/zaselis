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
}
