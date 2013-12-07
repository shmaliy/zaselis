<?php

class Flats_Form_MainPrice extends Zend_Form
{

    public function init()
    {
        $this->setAttrib('class', 'form-horizontal');
        $this->setAttrib('id', 'MainPrice');

        $this->addElement('hidden', 'z_flats_id');

        $this->addElement('text', 'main_1', array(
            'label' => 'Стоимость жилья',
            'required' => true,
            'attribs' => array(
                'class' => ' span10',
            ),
            'validators' => array(
                new Zend_Validate_Float(),
                new Zend_Validate_GreaterThan(0)
            )
        ));

        $this->addElement('text', 'main_2', array(
            'label' => 'Стоимость уборки',
            'required' => false,
            'attribs' => array(
                'class' => ' span10',
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

            if ('Zend_Form_Element_Text' == $element->getType()) {
                $element->setDecorators(array(
                    'ViewHelper',
                    'Description',
                    'Errors',
                    array('HtmlTag', array('tag' => 'div', 'class' => 'controls')),
                    array('Label', array('class' => 'control-label')),
                    array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'control-group'))
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

