<?php
class User_Form_ProfileEdit extends Zend_Form
{

    public function init()
    {
    	$lang = Zend_Registry::get('lang');
        $this->setMethod('post');
        $this->setAttrib('id', 'ProfileEdit');
        $this->setAttrib('class', 'dialog-form');
        
        $this->addElement('text', 'name[ru]', array(
        	'label' => '',
                'required' => true
        ));
        
                $this->addElement('text', 'name[en]', array(
        	'label' => '',
                'required' => true
        ));
                
        
        
        $this->addElement('text', 'geo', array(
        	'label' => '',
                'required' => true
        ));
        
        $this->getElement('geo')->addValidator(new Zend_Validate_NotEmpty())
                                ->addValidator(new Core_Validate_PasswValid())
                                ->setAttrib('placeholder', 'Место жительства')
                                ->setAttrib('id', 'searchTextField');
        
        
//        $this->getElement('old_psw')->addValidator(new Zend_Validate_NotEmpty())
//                                    ->addValidator(new Core_Validate_PasswValid())
//                                    ->setAttrib('placeholder', 'Текущий пароль');
        
        
        $this->addElement('submit', 'submit', array(
            'ignore' => true,
            'label' => 'Сменить',
            'required' => false
        ));
    }


}

