<?php

class User_Model_Fb extends Core_Model_Abstract
{
    public $lib, $clientId, $clientSecret, $scope;

    public function __construct()
    {
        $this->clientId = '247150188777185';
        $this->clientSecret = '1defdf7f5364e253b5f285d33e53b59f';

        $this->lib = new Facebook(array(
            'appId'  => $this->clientId,
            'secret' => $this->clientSecret,
            'cookie' => true,
        ));

        $this->scope = array(
            'scope' => 'user_birthday, user_likes, email'
        );
    }

    public function getUser()
    {
        $user_id = $this->lib->getUser();

        if($user_id) {
            try {
                $user_profile = $this->lib->api('/me','GET');
            } catch(FacebookApiException $e) {
                $login_url = $this->lib->getLoginUrl($this->scope);
            }
        } else {
            $login_url = $this->lib->getLoginUrl($this->scope);
        }


        $ret = array(
            'profile' => $user_profile,
            'loginUrl' => $login_url,
            'logoutUrl' => $this->lib->getLogoutUrl()
        );

        return $ret;
    }
}