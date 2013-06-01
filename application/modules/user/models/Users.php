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
    
    public function getActiveUser()
    {
        if (Zend_Auth::getInstance()->hasIdentity()) {
	    $user = Zend_Auth::getInstance()->getIdentity();
        }
        
        $select = $this->_db->select();
        $select->from(array('user' => $this->_tZUsers['title']));
        $select->where('user.z_users_id = ?', $user->z_users_id);
        $return = $this->_db->fetchRow($select);
        
        $return = $this->_treeFieldsTransform($this->_tZUsers['title'], $return, true);
        return $return;
    }
    
    public function isActiveSession()
    {
        $user = $this->getActiveUser();
        
        $select = $this->_db->select();
        $select->from(array('session' => $this->_tZUsersSessions['title']));
        $select->where('session.z_users_id = ?', $user['z_users_id']);
        $select->where(new Zend_Db_Expr('session.created_ts + session.ttl >' . time()));
        $select->order('session.z_users_sessions_id desc');
        
        
        
        $return = $this->_db->fetchRow($select);
        
        return $return;
        
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
        $insert = array(
            'z_users_id' => $id,
            'created_ts' => time(),
            'ttl' => $ttl,
            'ip'        =>  $_SERVER['REMOTE_ADDR']
        );
        
        $this->_insert($this->_tZUsersSessions['title'], $insert);
    }
}