<?php
class Application_Form_SimpleAuth extends Zend_Form
{

    public function init()
    {
    	
        $this->setMethod('post');
        $this->setAttrib('id', 'SimpleAuth');
        $this->setAttrib('class', 'dialog-form');
        
        $this->addElement('text', 'email', array(
            'label'    => '',
            'required' => true    
        ));
        $this->getElement('email')->addValidator(new Zend_Validate_NotEmpty())
                                  ->addValidator(new Zend_Validate_EmailAddress())
                                  ->setAttrib('placeholder', 'Электронная почта');
        
        $this->addElement('password', 'password', array(
            'label'    => '',
            'required' => true    
        ));
        $this->getElement('password')->addValidator(new Zend_Validate_NotEmpty())
                                     ->setAttrib('placeholder', 'Пароль');
        
        
        $this->addElement('submit', 'submit', array(
            'ignore' => true,
            'label' => 'Войти'
        ));
    }


}

