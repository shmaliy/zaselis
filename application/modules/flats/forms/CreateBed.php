<?php
class Flats_Form_CreateBed extends Zend_Form
{

    public function init()
    {
    	$lang = Zend_Registry::get('lang');
        $this->setMethod('post');
        $this->setAttrib('id', 'CreateBed');
        $this->setAttrib('class', 'dialog-form cf');
        
        $this->addElement('text', 'title', array(
        	'label' => 'Название',
                'required' => true,
                'attribs' => array(
                    'placeholder' => 'Название'
                )
        ));
        $this->getElement('title')->addValidator(new Zend_Validate_NotEmpty());
        
        $this->addElement('text', 'guests', array(
        	'label' => 'Вместимость',
                'required' => true,
                'attribs' => array(
                    'placeholder' => 'Вместимость'
                )
        ));
        $this->getElement('guests')->addValidator(new Zend_Validate_NotEmpty());
        
        $this->addElement( new Core_Form_Element_Submit(
            'submit', 
            array(
                'formName' => $this->getAttrib('id'),
                'ignore' => true,
                'value' => 'Добавить',
                'requored' => false
            )
        ));
    }


}

