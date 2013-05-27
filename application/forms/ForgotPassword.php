<?php
class Application_Form_ForgotPassword extends Zend_Form
{

    public function init()
    {
    	$lang = Zend_Registry::get('lang');
        $this->setMethod('post');
        $this->setAttrib('onsubmit', 'return sFSendData();'); // Force send only with ajax
        $this->setAttrib('id', 'ForgotPassword');
        $this->setAttrib('class', 'dialog-form');
        
        $this->addElement('text', 'email', array(
        	'label' => '',
                'required' => true
        ));
        $this->getElement('email')->addValidator(new Zend_Validate_NotEmpty())
                                  ->addValidator(new Zend_Validate_EmailAddress())
                                  ->addValidator(new Core_Validate_EmailExist())
                                  ->addValidator(new Core_Validate_EmailIsActive())
                                  ->setAttrib('placeholder', 'Электронная почта');
        
        $this->addElement('submit', 'submit', array(
            'ignore' => true,
            'label' => 'Напомнить'
        ));
    }


}

