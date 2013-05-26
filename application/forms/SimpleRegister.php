<?php
class Application_Form_SimpleRegister extends Zend_Form
{

    public function init()
    {
    	$lang = Zend_Registry::get('lang');
        $this->setMethod('post');
        $this->setAttrib('onsubmit', 'return sRSendData();'); // Force send only with ajax
        $this->setAttrib('id', 'SimpleRegister');
        
        $this->addElement('text', 'name',
            array(
        	'label' => '',
                'required' => true
            )
        );
        $this->getElement('name')->addValidator(new Zend_Validate_NotEmpty())->setAttrib('placeholder', 'Имя');
        
        $this->addElement('text', 'firstname', array(
        	'label' => 'Фамилия',
                'required' => true
        ));
        $this->getElement('firstname')->addValidator(new Zend_Validate_NotEmpty());
        
        $this->addElement('text', 'email', array(
        	'label' => 'Эл. почта',
                'required' => true
        ));
        $this->getElement('email')->addValidator(new Zend_Validate_NotEmpty())
                                  ->addValidator(new Zend_Validate_EmailAddress())
                                  ->addValidator(new Core_Validate_EmailUnique());
        
        $this->addElement('password', 'password', array(
        	'label' => 'Пароль',
                'required' => true
        ));
        $this->getElement('password')->addValidator(new Zend_Validate_NotEmpty());
        
        $this->addElement('submit', 'submit', array(
            'ignore' => true,
            'label' => 'Регистрация'
        ));
    }


}

