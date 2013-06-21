<?php
class Application_Form_SimpleRegister extends Zend_Form
{

    public function init()
    {
    	$lang = Zend_Registry::get('lang');
        $this->setMethod('post');
        $this->setAttrib('id', 'SimpleRegister');
        $this->setAttrib('class', 'dialog-form');
        
        $this->addElement('text', 'name',
            array(
        	'label' => '',
                'required' => true
            )
        );
        $this->getElement('name')->addValidator(new Zend_Validate_NotEmpty())->setAttrib('placeholder', 'Имя');
        
        $this->addElement('text', 'firstname', array(
        	'label' => '',
                'required' => true
        ));
        $this->getElement('firstname')->addValidator(new Zend_Validate_NotEmpty())
                                      ->setAttrib('placeholder', 'Фамилия');
        
        $this->addElement('text', 'email', array(
        	'label' => '',
                'required' => true
        ));
        $this->getElement('email')->addValidator(new Zend_Validate_NotEmpty())
                                  ->addValidator(new Zend_Validate_EmailAddress())
                                  ->addValidator(new Core_Validate_EmailUnique())
                                  ->setAttrib('placeholder', 'Электронная почта');
        
        $this->addElement('password', 'password', array(
        	'label' => '',
                'required' => true
        ));
        $this->getElement('password')->addValidator(new Zend_Validate_NotEmpty())
                                     ->setAttrib('placeholder', 'Пароль');
        
        $this->addElement('password', 'password_p', array(
            'label'    => '',
            'required' => true    
        ));
        $this->getElement('password_p')->addValidator(new Zend_Validate_NotEmpty())
                                       ->setAttrib('placeholder', 'Пароль еще раз');
        
        $this->addElement('submit', 'submit', array(
            'ignore' => true,
            'label' => 'Регистрация'
        ));
    }


}

