<?php

class Money_ManageController extends Zend_Controller_Action
{

    public $_model;
    public $_model_flats;

    public function init()
    {
        $this->_model = new User_Model_Users();
        $this->_model_flats = new Flats_Model_Flats();
        $this->_model_money = new Money_Model_Money();

        if (!Zend_Auth::getInstance()->hasIdentity() || !$this->_model->isActiveSession()) {
            header ('Location: ' . $this->view->url(array(), 'logout'));
        }
    }

    public function indexAction()
    {

    }
}