<? 

class User_Model_Users extends Core_Model_Abstract
{
    public $thumbnails = array(
        'drop-thumbnail', 'thumbnail', 'thumbnail-180-256'
    );

    public function getUserByEmail($email)
    {
        $select = $this->_db->select();

        $select->from(
            array('users' => $this->_tZUsers['title']),
            array(
                'z_users_id',
                'email',
                'z_users_roles_id'
            )
        );
        $select->where('email = ?', $email);

        return $this->_db->fetchRow($select);
    }
    
    public function registerSimple($data)
    {
        $lang = Zend_Registry::get('lang');
        $data['password'] = $this->_crypt($data['password']);
//        $data['name'] = array($lang['alias'] => $data['name']);
//        $data['firstname'] = array($lang['alias'] => $data['firstname']);
        $preformated = array(
            'z_users_roles_id' => 3,
            'created_ts'       => time(),
            'activate_code'    => md5($data['email'])
        );
        $insert = array_merge($preformated, $data);
        if ($this->_insert($this->_tZUsers['title'], $insert) > 0) {
            $url = new Zend_View_Helper_Url();
            $msg = '<a href="http://' . $_SERVER['HTTP_HOST'] . $url->url(array('code' => md5($data['email'])), 'user-activate') . '">Activation code</a>';
            $this->mailto($data['email'], 'Please activate your email', $msg);
            return true;
        } else {
            return false;
        }
    }

    public function updateUser($array, $id)
    {
        foreach ($array as $key=>&$row) {
            if ($key == 'z_users_id' ||
                $key == 'z_users_roles_id' ||
                $key == 'email' ||
                $key == 'password' ||
                $key == 'status' ||
                $key == 'balance' ||
                $key == 'votes' ||
                $key == 'activate_code') {

                unset($row);
            }

            if (is_array($row)) {
                $row = base64_encode(json_encode($row));
            }
        }

        $this->_update($id, $this->_tZUsers['title'], $array);
    }

    public function registerFb($array)
    {
        $ins = $this->_insert($this->_tZUsers['title'], $array);

        if ($ins > 0) {
            $url = new Zend_View_Helper_Url();
            $msg = '<a href="http://' . $_SERVER['HTTP_HOST'] . $url->url(array('code' => $array['activate_code']), 'user-activate') . '">Activation code</a>';
            $this->mailto($array['email'], 'Please activate your email', $msg);
            return $ins;
        } else {
            return false;
        }

    }
    
    public function parseUserLiveCity($str = null) {
        if (is_null($str)) {
            return false;
        }
        
        $data = $this->googleGetAddress($str);
        $data = $data->results[0];
        
        $country = $this->getCountry($data);
        $state = $this->getState($data);
        $town = $this->getTown($data);
        
        $return = array(
            'z_countries_id' => $country,
            'z_states_id' => $state,
            'z_towns_id' => $town
        );

        return $return;
    }
    
    public function prepareUserProfileData()
    {
        $data = $this->getActiveUser();
        
        $town = $this->getTownById($data['z_towns_id']);
        $state = $this->getStateById($data['z_states_id']);
        $country = $this->getCountryById($data['z_countries_id']);
        
        $data['geo'] = $town['title'] . ', ' . $state['title'] . ', ' . $country['title'];
        $data['birth'] = date("Y-m-d", $data['birth']);
        $data['documentation'] = ($data['documentation'] == 'YES') ? 1 : 0;
        
        return $data;
    }
    
    public function activateUserPhone($line=-1, $code=null)
    {
        if ($line == -1) {
            return false;
        }
        
        $demo = 1;
        $user = $this->getActiveUser();
        
        if ($code == $user['phones'][$line]['activate'] || $demo == 1) {
            $user['phones'][$line]['activate'] = '';
            $upd['phones'] = $this->_prepareToTree($user['phones']);
            $this->_update($user['z_users_id'], $this->_tZUsers['title'], $upd);
            return true;
        } else {
            return false;
        }
    }
    
    public function saveUserProfileData($array)
    {
        $user = $this->getActiveUser();
        $user_id = $user['z_users_id'];
        
        $living = $this->parseUserLiveCity($array['geo']);
        
        $birth = explode('-', $array['birth']);
        $birth = mktime(0, 0, 0, $birth[1], $birth[2], $birth[0]);

        $office_addres = '';

        if (!empty($array['office_addr'])) {
            $office_addres = $this->googleGetAddress($array['office_addr']);
            $office_addres = $office_addres->results[0]->formatted_address;
        }
        
        $update = array(
            'name' => $array['name'],
            'firstname' => $array['firstname'],
            'birth' => $birth,
            'gender' => ucfirst($array['gender']),
            'about' => $array['about'],
            'documentation' => ($array['documentation'] == 1) ? 'YES' : 'NO',
            'office_addr' => $office_addres,
            'type_of_settle' => $array['type_of_settle'],
            'edited_ts' => time(),
            'z_countries_id' => $living['z_countries_id'],
            'z_states_id' => $living['z_states_id'],
            'z_towns_id' => $living['z_towns_id']
        );
        
        
        $this->_update($user_id, $this->_tZUsers['title'], $update);
        
    }
    
    public function saveUserPhones($update) {
        $user = $this->getActiveUser();
        $user_id = $user['z_users_id'];
        $upd['phones'] = $this->_prepareToTree($update);
        
        $this->_update($user_id, $this->_tZUsers['title'], $upd);
    }
    
    public function getPhoneCodes($country_id = null)
    {
        $select = $this->_db->select();
        $select->from($this->_tZPhoneCodes['title']);
        if (!is_null($country_id)) {
            $select->where('z_countries_id = ?', $country_id);
            return $this->_db->fetchRow($select);
        } else {
            $select->order('z_countries_title');
            return $this->_db->fetchAll($select);
        }
        
    }
    
    public function getPhoneCode($id = null)
    {
        $select = $this->_db->select();
        $select->from($this->_tZPhoneCodes['title']);
        $select->where('z_phone_codes_id = ?', $id);
        return $this->_db->fetchRow($select);
    }
    
    public function removeSinglePhone($id) {
        $user = $this->getActiveUser();
        $phones = $user['phones'];
        unset ($phones[$id]);
        $upd = array(
            'phones' => $this->_prepareToTree($phones)
        );
        
        $this->_update($user['z_users_id'], $this->_tZUsers['title'], $upd);
    }
    
    public function saveSocialNetworks($ins)
    {
        $user = $this->getActiveUser();
        $user_id = $user['z_users_id'];
        $insert['social_networks'] = $this->_prepareToTree($ins);
        
        $this->_update($user_id, $this->_tZUsers['title'], $insert);
    }


    public function validateEmailOnDb($email) 
    {
        $select = $this->_db->select();
        $select->from(array('user' => $this->_tZUsers['title']));
        $select->where('user.email = ?', $email);
        $return = $this->_db->fetchRow($select);
        if ($return) {
            return false;
        }
        return true;
    }
    
    public function isActive($email) 
    {
        $select = $this->_db->select();
        $select->from(array('user' => $this->_tZUsers['title']));
        $select->where('user.email = ?', $email);
        $select->where('user.status = ?', 'Active');
        $select->where('user.activate_code = ?', '');
        $return = $this->_db->fetchRow($select);
        if ($return) {
            return true;
        }
        return false;
    }
    
    public function preparePasswordToCompare($str)
    {
        return $this->_crypt($str);
    }
    
    public function userActivate($code)
    {
        $select = $this->_db->select();
        $select->from(array('user' => $this->_tZUsers['title']));
        $select->where('user.activate_code = ?', $code);
        $return = $this->_db->fetchRow($select);
        
        $array = array(
            'status'        => 'Active',
            'activate_code' => ''
        );
        
        if ($return) {
            $this->_update($return['z_users_id'], $this->_tZUsers['title'], $array);
        }
    }
    
    public function restorePassword($email) {
        $select = $this->_db->select();
        $select->from(array('user' => $this->_tZUsers['title']));
        $select->where('user.email = ?', $email);
        $return = $this->_db->fetchRow($select);
        
        $password = $this->_deCrypt($return['password']);
        
        $this->mailto($email, 'Password reminder', $password);
    }
    
    public function changePassword($new)
    {
        if (Zend_Auth::getInstance()->hasIdentity()) {
	    $user = Zend_Auth::getInstance()->getIdentity();
        } else return false;
        
        $select = $this->_db->select();
        $select->from(array('user' => $this->_tZUsers['title']));
        $select->where('user.z_users_id = ?', $user->z_users_id);
        $return = $this->_db->fetchRow($select);
        
        $upd = array('password' => $this->_crypt($new));
        
        $this->_update($return['z_users_id'], $this->_tZUsers['title'], $upd);
        return true;
    }
    
    public function validateUserPassword($data)
    {
        $return = $this->getActiveUser();
        
        if ($return['password'] == $this->_crypt($data)) {
            return true;
        }
        return false;
    }        
    
    public function getActiveUser()
    {
        if (Zend_Auth::getInstance()->hasIdentity()) {
	    $user = Zend_Auth::getInstance()->getIdentity();
        } else return false;
        
        $select = $this->_db->select();
        $select->from(array('user' => $this->_tZUsers['title']));
        $select->where('user.z_users_id = ?', $user->z_users_id);
        
        $select->joinLeft(
            array('session' => $this->_tZUsersSessions['title']),
            'session.z_users_id = user.z_users_id',
            array(
                'session_country' => 'session.z_countries_id',
                'session_state' => 'session.z_states_id',
                'session_town' => 'session.z_towns_id'
            )
        );
        $select->where(new Zend_Db_Expr('session.created_ts + session.ttl >' . time()));
        $select->order('session.z_users_sessions_id desc');
        
        $return = $this->_db->fetchRow($select);
        if ($return != false) {
            $return = $this->_treeFieldsTransform($this->_tZUsers['title'], $return, true);
            return $return;
        }
        
        return false;
        
    }
    
    public function isActiveSession()
    {
        $user = $this->getActiveUser();
        if (!$user) {
            return false;
        }
        
        $select = $this->_db->select();
        $select->from(array('session' => $this->_tZUsersSessions['title']));
        $select->where('session.z_users_id = ?', $user['z_users_id']);
        $select->where(new Zend_Db_Expr('session.created_ts + session.ttl >' . time()));
        $select->order('session.z_users_sessions_id desc');
        
        $return = $this->_db->fetchRow($select);
        
        return $return;
        
    }
    
    public function saveAvatar($fname) 
    {
        $user = $this->getActiveUser(); 
        
        if (!empty($user['avatar']) && empty($fname)) {
            $file = ltrim($user['avatar'], '/');
            
            unlink($file);
            
            foreach ($this->thumbnails as $dir) {
                $th = str_replace('/avatars/', '/avatars/' . $dir . '/', $file);
                unlink($th);
            }
        }
        
        $update['avatar'] = $fname;
        
        $this->_update($user['z_users_id'], $this->_tZUsers['title'], $update);
    }
    
    public function closeActiveSession()
    {
        
        $user = $this->isActiveSession();
        
        if ($user) {
            $update = array(
                'ttl' => new Zend_Db_Expr(time() . ' - ' . $this->_db->quoteIdentifier('created_ts', true))
            );

            $this->_update($user['z_users_sessions_id'], $this->_tZUsersSessions['title'], $update);
        }
    }            


    public function writeRegisterSession($id, $ttl = 86400) {
        $geo = $this->getGeoIp();
        
        $googleObject = $this->googleGetAddress($geo->city . ', ' . $geo->region_name . ', ' . $geo->country_name);
        
        $insert = array(
            'z_users_id' => $id,
            'created_ts' => time(),
            'ttl' => $ttl,
            'ip'        =>  $_SERVER['REMOTE_ADDR'],
            'z_countries_id' => $this->saveCountry($googleObject),
            'z_states_id' => $this->saveState($googleObject),
            'z_towns_id' => $this->saveTown($googleObject)
        );
        
        $this->_insert($this->_tZUsersSessions['title'], $insert);
    }
}