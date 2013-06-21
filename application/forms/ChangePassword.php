<?php
class Application_Form_ChangePassword extends Zend_Form
{

    public function init()
    {
    	$lang = Zend_Registry::get('lang');
        $this->setMethod('post');
        $this->setAttrib('id', 'ChangePassword');
        $this->setAttrib('class', 'dialog-form');
        
        $this->addElement('text', 'old_psw', array(
        	'label' => '',
                'required' => true
        ));
        
        $this->addElement('text', 'new_psw', array(
        	'label' => '',
                'required' => true
        ));
        
        $this->addElement('text', 'new_psw_rep', array(
        	'label' => '',
                'required' => true
        ));
        
        
        $this->getElement('old_psw')->addValidator(new Zend_Validate_NotEmpty())
                                    ->addValidator(new Core_Validate_PasswValid())
                                    ->setAttrib('placeholder', 'Текущий пароль');
        
        $this->getElement('new_psw')->addValidator(new Zend_Validate_NotEmpty())
                                    ->setAttrib('placeholder', 'Новый пароль');
                
        $this->getElement('new_psw_rep')->addValidator(new Zend_Validate_NotEmpty())
                                    ->setAttrib('placeholder', 'Новый пароль еще раз');
        
        $this->addElement('submit', 'submit', array(
            'ignore' => true,
            'label' => 'Сменить',
            'required' => false
        ));
    }


}

