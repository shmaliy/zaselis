<?php
class Flats_Form_EditFirstTab extends Zend_Form
{

    public function init()
    {
    	$lang = Zend_Registry::get('lang');
        $this->setMethod('post');
        $this->setAttrib('id', 'EditFirstTab');
        $this->setAttrib('class', 'main-form cf');
        
        $this->addElement('hidden', 'z_flats_id');
        
        $this->addElement('text', 'district_description', array(
        	'label' => 'Название',
                'required' => true
        ));
        $this->getElement('district_description')->addValidator(new Zend_Validate_NotEmpty());
        
        $this->addElement('text', 'adress', array(
        	'label' => 'Адрес',
                'required' => true,
                'attribs' => array(
                    'id' => 'flatAdress'
                )
        ));
        $this->getElement('adress')->addValidator(new Zend_Validate_NotEmpty());
        
        $this->addElement('select', 'z_flats_types_id', array(
        	'label' => 'Тип жилья',
                'required' => true
        ));
        
        $this->addElement('select', 'z_flats_room_types_id', array(
        	'label' => 'Тип комнат',
                'required' => true
        ));
        
        $this->addElement('text', 'rooms_count', array(
        	'label' => 'Колличество комнат',
                'required' => true
        ));
        $this->getElement('rooms_count')->addValidator(new Zend_Validate_NotEmpty())
                                        ->addValidator(new Zend_Validate_Int());
        
        $this->addElement('textarea', 'main_description', array(
        	'label' => 'Описание',
                'required' => true
        ));
        $this->getElement('main_description')->addValidator(new Zend_Validate_NotEmpty());
        
        $this->addElement('textarea', 'route_description', array(
        	'label' => 'Описание проезда от вокзалов и аэропорта',
                'required' => true
        ));
        $this->getElement('route_description')->addValidator(new Zend_Validate_NotEmpty());
        
        $this->addElement('textarea', 'house_rules', array(
        	'label' => 'Правила для жильцов',
                'required' => true
        ));
//        $this->getElement('house_rules')->addValidator(new Zend_Validate_NotEmpty());
        
        
        $this->addElement( new Core_Form_Element_Submit(
            'submit', 
            array(
                'formName' => $this->getAttrib('id'),
                'ignore' => true,
                'value' => 'Сохранить',
                'requored' => false
            )
        ));
    }


}

