<?php
class User_Form_ProfileEdit extends Zend_Form
{

    public function init()
    {
    	$lang = Zend_Registry::get('lang');
        $this->setMethod('post');
        $this->setAttrib('id', 'ProfileEdit');
        $this->setAttrib('class', 'main-form cf');
        
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
                'required' => true
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
        
        $this->addElement('submit', 'submit', array(
            'ignore' => true,
            'label' => 'Coxpaнить',
            'required' => false
        ));
        $this->getElement('submit')->setAttrib('class', 'form-save-button');
    }


}

