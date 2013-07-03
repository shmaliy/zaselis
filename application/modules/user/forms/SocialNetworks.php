<?php
class User_Form_SocialNetworks extends Zend_Form
{

    public function init()
    {
    	$lang = Zend_Registry::get('lang');
        $this->setMethod('post');
        $this->setAttrib('id', 'SocialNetworks');
        $this->setAttrib('class', 'main-form cf');
        
        $this->addElement('text', 'vk', array(
        	'label' => 'VK.COM/id',
                'required' => false
        ));
        
        
        $this->addElement('text', 'fb', array(
        	'label' => 'Facebook/id',
                'required' => false
        ));
        
        
        
        $this->addElement('submit', 'submit', array(
            'ignore' => true,
            'label' => 'Сменить',
            'required' => false
        ));
    }


}

