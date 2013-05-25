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
    }
}
