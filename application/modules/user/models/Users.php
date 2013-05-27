<? 

class User_Model_Users extends Core_Model_Abstract
{
    public function registerSimple($data)
    {
        $lang = Zend_Registry::get('lang');
        $data['password'] = $this->_crypt($data['password']);
        $data['name'] = array($lang['alias'] => $data['name']);
        $data['firstname'] = array($lang['alias'] => $data['firstname']);
        $preformated = array(
            'z_users_roles_id' => 2,
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
    
    public function getUser()
    {
        
    }
}