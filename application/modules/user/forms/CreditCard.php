<?php

class User_Form_CreditCard extends Zend_Form
{

    public function init()
    {
        $this->setAttrib('class', 'form-horizontal');
        $this->addElement('hidden', 'type', 'CREDITCARD');

        $this->addElement('text', 'firstname', array(
            'label' => 'Имя',
            'required' => false,
            'attribs' => array(
                'class' => ' span10'
            )
        ));

        $this->addElement('text', 'lastname', array(
            'label' => 'Фамилия',
            'required' => false,
            'attribs' => array(
                'class' => ' span10'
            )
        ));

        $this->addElement('text', 'adress', array(
            'label' => 'Адрес',
            'required' => false,
            'attribs' => array(
                'class' => ' span10'
            )
        ));

        $this->addElement('text', 'city', array(
            'label' => 'Город',
            'required' => false,
            'attribs' => array(
                'class' => ' span10'
            )
        ));

        $this->addElement('text', 'state', array(
            'label' => 'Область',
            'required' => false,
            'attribs' => array(
                'class' => ' span10'
            )
        ));

        $this->addElement('text', 'zip', array(
            'label' => 'Zip/Postal code',
            'required' => false,
            'attribs' => array(
                'class' => ' span10'
            )
        ));

        $this->addElement('select', 'country', array(
            'label' => 'Страна',
            'required' => false,
            'attribs' => array(
                'class' => ' span10'
            )
        ));

        $this->addElement('text', 'cardnumber', array(
            'label' => 'Номер карты',
            'required' => false,
            'attribs' => array(
                'class' => ' span10'
            )
        ));

        $this->addElement('text', 'expiration', array(
            'label' => 'Срок действия',
            'required' => false,
            'attribs' => array(
                'class' => ' span10'
            )
        ));

        $this->addElement('text', 'cvv2', array(
            'label' => 'CVV2',
            'required' => false,
            'attribs' => array(
                'class' => ' span10'
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

