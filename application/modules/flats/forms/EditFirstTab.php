<?php
class Flats_Form_EditFirstTab extends Zend_Form
{

    public function init()
    {
    	$lang = Zend_Registry::get('lang');
        $this->setMethod('post');
        $this->setAttrib('id', 'EditFirstTab');
        $this->setAttrib('class', 'form-horizontal std-form');
        
        $this->addElement('hidden', 'z_flats_id');
        
        $this->addElement('text', 'district_description', array(
        	'label' => 'Название',
            'required' => true,
            'attribs' => array(
                'class' => 'span11'
            )
        ));
        $this->getElement('district_description')->addValidator(new Zend_Validate_NotEmpty());
        
        $this->addElement('text', 'adress', array(
        	'label' => 'Адрес',
                'required' => true,
                'attribs' => array(
                    'id' => 'flatAdress',
                    'class' => 'span11'
                )
        ));
        $this->getElement('adress')->addValidator(new Zend_Validate_NotEmpty());
        
        $this->addElement('select', 'z_flats_types_id', array(
        	'label' => 'Тип жилья',
            'required' => true,
            'attribs' => array(
                'class' => 'span11'
            )
        ));
        
        $this->addElement('select', 'z_flats_room_types_id', array(
        	'label' => 'Тип комнат',
            'required' => true,
            'attribs' => array(
                'class' => 'span11'
            )
        ));
        
        $this->addElement('text', 'rooms_count', array(
        	'label' => 'Колличество комнат',
            'required' => true,
            'attribs' => array(
                'class' => 'span11'
            )
        ));
        $this->getElement('rooms_count')->addValidator(new Zend_Validate_NotEmpty())
                                        ->addValidator(new Zend_Validate_Int());
        
        $this->addElement('textarea', 'main_description', array(
        	'label' => 'Описание',
            'required' => true,
            'attribs' => array(
                'class' => 'span8',
                'rows' => 6
            )
        ));
        $this->getElement('main_description')
            ->addValidator(new Zend_Validate_NotEmpty())
            -> setDescription('Напишите до 10 предложений о достоинствах вашей квартиры, преимуществах ее расположения и интерьера.');
        
        $this->addElement('textarea', 'route_description', array(
        	'label' => 'Описание проезда от вокзалов и аэропорта',
            'required' => true,
            'attribs' => array(
                'class' => 'span8',
                'rows' => 6
            )
        ));
        $this->getElement('route_description')
                ->addValidator(new Zend_Validate_NotEmpty())
                ->setDescription('Опишите маршруты и транспорт, с помощью которых гость может сам добраться до квартиры.');
        
        $this->addElement('textarea', 'house_rules', array(
        	'label' => 'Правила для жильцов',
            'required' => true,
            'attribs' => array(
                'class' => 'span8',
                'rows' => 6
            )
        ));
        $this->getElement('house_rules')->setDescription('Укажите что можно, а чего нельзя делать в вашем доме.');
        
        
        $this->addElement( new Core_Form_Element_Submit(
            'submit', 
            array(
                'formName' => $this->getAttrib('id'),
                'ignore' => true,
                'value' => 'Сохранить',
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

            if (
                    $element->getName() == 'main_description' ||
                    $element->getName() == 'route_description' ||
                    $element->getName() == 'house_rules'
            ) {
                $element->setDecorators(array(
                    'ViewHelper',
                    array('Description', array('tag' => 'div', 'placement' => 'append', 'class' => 'description')),
                    'Errors',
                    array('HtmlTag', array('tag' => 'div', 'class' => 'controls cf')),
                    array('Label', array('class' => 'control-label')),
                    array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'control-group'))

                ));
            }


        }
    }


}

