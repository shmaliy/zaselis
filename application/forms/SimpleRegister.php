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

        $this->addElement( new Core_Form_Element_Submit(
            'submit',
            array(
                'formName' => $this->getAttrib('id'),
                'ignore' => true,
                'value' => 'Регистрация',
                'required' => false
            )
        ));
    }

    public function loadDefaultDecorators()
    {
        parent::loadDefaultDecorators();
        $this->setElementDecorators(array(
            'ViewHelper',
            'Description',
            'Errors',
            array('HtmlTag', array('tag' => 'div', 'class' => 'controls')),
            array('Label', array('class' => 'control-label')),
            array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'control-group'))
        ));

        foreach ($this->getElements() as $element) {

            if ('Zend_Form_Element_Hidden' == $element->getType()) {
                $element->setDecorators(array(
                    'ViewHelper'
                ));
            }


            if ('Core_Form_Element_Submit' == $element->getType()) {
                $element->setDecorators(array(
                    'ViewHelper',
                    array('Label', array('style' => 'display:none')),
                ));
            }

            if ('Zend_Form_Element_Radio' == $element->getType()) {
                $element->setDecorators(array(
                    'ViewHelper',
                    array(array('data' => 'HtmlTag'), array('class' => 'radio')),
                    array('HtmlTag', array('tag' => 'div', 'class' => 'controls')),
                    array('Label', array('class' => 'control-label')),
                    array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'control-group')),

                ));
                $element->setSeparator('');
            }


        }
    }


}

