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
        
        $this->addElement('text', 'guests_count', array(
        	'label' => 'Колличество спальных мест',
                'required' => true
        ));
        $this->getElement('guests_count')->addValidator(new Zend_Validate_NotEmpty())
                                         ->addValidator(new Zend_Validate_Int());
        
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
        
        $this->addElement('text', 'price', array(
        	'label' => 'Цена (US Dollar)',
                'required' => true
        ));
        $this->getElement('price')->addValidator(new Zend_Validate_NotEmpty())
                                  ->addValidator(new Zend_Validate_Float());
        
        
        
        $this->addElement('submit', 'submit', array(
            'ignore' => true,
            'label' => 'Сохранить',
            'required' => false
        ));
        $this->getElement('submit')->setAttrib('class', 'form-save-button');
    }


}

