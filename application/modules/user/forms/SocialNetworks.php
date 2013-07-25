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
            $this->setAttrib('class', 'main-form cf');

            foreach ($this->_list as $key=>$item) {
                $this->addElement('text', $key, array(
                    'label' => $item['title'],
                    'required' => false,
                    'attribs' => array(
                        'class' => $key
                    )
                ));
            }

            $this->addElement('submit', 'submit', array(
                'ignore' => true,
                'label' => 'Сохранить',
                'required' => false
            ));

            $this->getElement('submit')->setAttrib('class', 'form-save-button');
        }
    }


}

