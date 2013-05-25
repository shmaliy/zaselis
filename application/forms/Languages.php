<?php
class Application_Form_Languages extends Zend_Form
{

    public function init()
    {
    	
        $this->setMethod('post');
        $this->setAttrib('onsubmit', 'return false;'); // Force send only with ajax
        
        $this->addElement('select', 'langs', array(
        	'label' => '',
        	'onchange' => 'window.location.href = this.value;'
        ));
    }


}

