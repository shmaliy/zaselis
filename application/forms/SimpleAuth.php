<?php
class Application_Form_SimpleAuth extends Zend_Form
{

    public function init()
    {
    	
        $this->setMethod('post');
        $this->setAttrib('onsubmit', 'return sASendData();'); // Force send only with ajax
        $this->setAttrib('id', 'SimpleAuth');
        
        $this->addElement('text', 'email', array(
            'label'    => 'Эл. почта',
            'required' => true    
        ));
        $this->getElement('email')->addValidator(new Zend_Validate_NotEmpty())
                                  ->addValidator(new Zend_Validate_EmailAddress());
        
        $this->addElement('password', 'password', array(
            'label'    => 'Пароль',
            'required' => true    
        ));
        $this->getElement('password')->addValidator(new Zend_Validate_NotEmpty());
        
        $this->addElement('submit', 'submit', array(
            'ignore' => true,
            'label' => 'Войти'
        ));
    }


}

