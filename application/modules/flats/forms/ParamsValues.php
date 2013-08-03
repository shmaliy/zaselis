<?php
class Flats_Form_ParamsValues extends Zend_Form
{

    public function init()
    {
    	$lang = Zend_Registry::get('lang');
        $this->setMethod('post');
        $this->setAttrib('id', 'ParamsValues');
        $this->setAttrib('class', 'dialog-form cf');
        
        $this->addElement('hidden', 'z_flats_params_id');
        
        $this->addElement('text', 'text_value', array(
        	'label' => 'Значение',
                'required' => true,
                'attribs' => array(
                    'placeholder' => 'Значение параметра'
                )
        ));
        $this->getElement('text_value')->addValidator(new Zend_Validate_NotEmpty());
        
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

