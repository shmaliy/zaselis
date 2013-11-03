<?php

class User_Form_SocialNetworks extends Zend_Form
{

    private $_list = null;
    
    public function setlist($list) 
    {
        $this->_list = $list;
        $this->init();
    }
    
    public function init()
    {
    	if (!is_null($this->_list)) {
            $lang = Zend_Registry::get('lang');
            $this->setMethod('post');
            $this->setAttrib('id', 'SocialNetworks');
            $this->setAttrib('class', 'form-horizontal std-form');

            foreach ($this->_list as $key=>$item) {
                $this->addElement('text', $key, array(
                    'label' => $item['title'],
                    'required' => false,
                    'attribs' => array(
                        'class' => $key . ' span10'
                    )
                ));
            }



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

