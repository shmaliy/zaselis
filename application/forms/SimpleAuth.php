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

