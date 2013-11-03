<?php
class User_Form_ProfileEdit extends Zend_Form
{

    public function init()
    {
    	$lang = Zend_Registry::get('lang');
        $this->setMethod('post');
        $this->setAttrib('id', 'ProfileEdit');
        $this->setAttrib('class', 'form-horizontal std-form');
        
        $this->addElement('text', 'firstname', array(
        	'label' => 'Фамилия',
                'required' => true
        ));
        $this->getElement('firstname')
                ->addValidator(new Zend_Validate_NotEmpty());
        
        
        $this->addElement('text', 'name', array(
        	'label' => 'Имя',
                'required' => true
        ));
        $this->getElement('name')
                ->addValidator(new Zend_Validate_NotEmpty());
        
        $this->addElement('text', 'birth', array(
        	'label' => 'Дата рождения',
                'required' => true
        ));
        $this->getElement('birth')
                ->addValidator(new Zend_Validate_NotEmpty());
        
        $this->addElement('text', 'geo', array(
        	'label' => 'Место жительства',
                'required' => true
        ));
        $this->getElement('geo')
                ->addValidator(new Zend_Validate_NotEmpty())
                ->setAttrib('id', 'searchTextField');
        
        $this->addElement('radio', 'gender', array(
        	'label' => 'Пол',
                'required' => true,
                'multiOptions' => array(
                    'Male' => 'Мужской',
                    'Female' => 'Женский'
                )
            
        ));
        
        $this->addElement('textarea', 'about', array(
        	'label' => 'О себе',
            'required' => true,
            'attribs' => array(
                'rows' => 5
            )
        ));
        
        $this->addElement('checkbox', 'documentation', array(
        	'label' => 'Предоставляете ли вы финансовые документы?',
                'required' => true
        ));
        
        $this->addElement('text', 'office_addr', array(
        	'label' => 'Адрес офиса',
                'required' => false
        ));
        $this->getElement('office_addr')->setAttrib('id', 'usersOfficeAddr');
        
        $this->addElement('radio', 'type_of_settle', array(
        	'label' => 'Тип поселения',
                'required' => true,
                'multiOptions' => array(
                    'Office' => 'Ключ выдается в офисе',
                    'OnPlace' => 'Ключ выдается по месту поселения',
                    'Both' => 'Возможны оба варианта'
                )
        ));

        $this->addElement( new Core_Form_Element_Submit(
            'submit',
            array(
                'formName' => $this->getAttrib('id'),
                'ignore' => true,
                'value' => 'Сохранить',
                'required' => false
            )
        ));


        $this->setElementDecorators(array(
            'ViewHelper',
            'Label',
            array(array('outside' => 'HtmlTag'), array('tag' => 'div', 'class' => 'control-group'))
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

