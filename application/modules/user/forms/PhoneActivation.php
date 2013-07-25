<?php
class User_Form_PhoneActivation extends Zend_Form
{

    public function init()
    {
    	$lang = Zend_Registry::get('lang');
        $this->setMethod('post');
        $this->setAttrib('id', 'PhoneConfirm');
        $this->setAttrib('class', 'dialog-form cf');
        
        $this->addElement('hidden', 'line', array(
            'value' => -1
        ));
        $this->getElement('line')->setAttrib('class', 'line-number');
        
        $this->addElement('text', 'code', array(
        	'label' => '',
                'required' => true
        ));
        
        $this->getElement('code')
             ->addValidator(new Zend_Validate_NotEmpty())
             ->setAttrib('placeholder', 'Код подтверждения');
        
        $this->addElement('submit', 'submit', array(
            'ignore' => true,
            'label' => 'Активировать',
            'required' => false
        ));
        $this->getElement('submit')->setAttrib('class', 'form-save-button');
    }


}

