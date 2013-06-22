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
        
        $this->addElement('text', 'name', array(
        	'label' => 'Имя',
                'required' => true
        ));
        
        $this->addElement('text', 'birth', array(
        	'label' => 'Дата рождения',
                'required' => true
        ));
        
        $this->addElement('text', 'geo', array(
        	'label' => 'Место жительства',
                'required' => true
        ));
        
        $this->addElement('radio', 'gender', array(
        	'label' => 'Пол',
                'required' => true
            
        ));
        $this->getElement('gender')->addMultiOptions(array(
            'male' => 'Male',
            'female' => 'Female'
        ));
        
        $this->addElement('textarea', 'about', array(
        	'label' => 'О себе',
                'required' => true
        ));
        
        $this->addElement('checkbox', 'documentation', array(
        	'label' => 'Предоставляете ли вы финансовые документы?',
                'required' => true
        ));
        
        $this->addElement('textarea', 'office_addr', array(
        	'label' => 'Адрес офиса',
                'required' => true
        ));
        
        $this->addElement('radio', 'type_of_settle', array(
        	'label' => 'Тип поселения',
                'required' => true
            
        ));
        $this->getElement('type_of_settle')->addMultiOptions(array(
            'male' => 'Male',
            'female' => 'Female'
        ));
                
        
        
        
        
        $this->addElement('text', 'phones', array(
        	'label' => 'Телефоны',
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

