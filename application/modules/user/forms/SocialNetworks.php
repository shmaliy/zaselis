<?php

class User_Form_SocialNetworks extends Zend_Form
{

    public function init()
    {
    	$networks = array(
            'vk' => array(
                'title' => 'VK.com',
                'url' => 'http://www.vk.com'
            ),
            'fb' => array(
                'title' => 'Facebook',
                'url' => 'http://www.facebook.com'
            ),
            'google' => array(
                'title' => 'g+',
                'url' => 'http://plus.google.com'
            ),
            'twitter' => array(
                'title' => 'Twitter',
                'url' => 'http://www.twitter.com'
            ),
            'linkedin' => array(
                'title' => 'LinkedIn',
                'url' => 'http://www.linkedin.com'
            ),
            'myspace' => array(
                'title' => 'MySpace',
                'url' => 'http://www.myspace.com'
            ),
            'pinterest' => array(
                'title' => 'Pinterest',
                'url' => 'http://www.pinterest.com/'
            ),
            'livejournal' => array(
                'title' => 'Livejournal',
                'url' => 'http://www.livejournal.com'
            ),
            'ask' => array(
                'title' => 'ask.fm',
                'url' => 'http://www.ask.fm/'
            ),
            'instagram' => array(
                'title' => 'Instagram',
                'url' => 'http://instagram.com'
            )
        );
        
        $lang = Zend_Registry::get('lang');
        $this->setMethod('post');
        $this->setAttrib('id', 'SocialNetworks');
        $this->setAttrib('class', 'main-form cf');
        
        foreach ($networks as $key=>$item) {
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

