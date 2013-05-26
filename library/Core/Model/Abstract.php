<?php 
class Core_Model_Abstract
{
    protected $_db;
    protected $_lang;
    protected $_currencie;

    // List of tables
    protected $_tZCountries = array(
        'title' => 'z_countries',
        'treeFields' => array(
            'title'              => 'multilanguage',
        )
    );
    
    protected $_tZCurrencies = array(
        'title' => 'z_currencies',
        'treeFields' => array(
            'title'              => 'multilanguage'
        )
    );
    
    protected $_tZDistricts = array(
        'title' => 'z_districts',
        'treeFields' => array(
            'title'              => 'multilanguage',
        )
    );
    
    protected $_tZFlats = array(
        'title' => 'z_flats',
        'treeFields' => array(
            'district_description' => 'multilanguage',
            'main_description'     => 'multilanguage',
            'photos' => 'array',
            'votes' => 'array'
        )
    );
    
    protected $_tZFlatsInTop = array(
        'title' => 'z_flats_in_top',
        'treeFields' => array()
    );
    
    protected $_tZFlatsParams = array(
        'title' => 'z_flats_params',
        'treeFields' => array(
            'title'              => 'multilanguage',
            'description'        => 'multilanguage'
        )
    );
    
    protected $_tZFlatsParamsValues = array(
        'title' => 'z_flats_params_values',
        'treeFields' => array(
            'text_value' => 'multilanguage'
        )
    );
    
    protected $_tFlatsTopsCountriesPrices = array(
        'title' => 'z_flats_tops_countries_prices',
        'treeFields' => array()
    );
    
    protected $_tZFlatsTopList = array(
        'title' => 'z_flats_tops_list',
        'treeFields' => array(
            'title'              => 'multilanguage',
            'description'        => 'multilanguage'
        )
    );
    
    protected $_tZFlatsTopsTownsPrices = array(
        'title' => 'z_flats_tops_towns_prices',
        'treeFields' => array()
    );
    
    protected $_tZLanguages = array(
        'title' => 'z_languages',
        'treeFields' => array(
            'title'              => 'multilanguage'
        )
    );
    
    protected $_tZMetros = array(
        'title' => 'z_metros',
        'treeFields' => array(
            'title'              => 'multilanguage'
        )
    );
    
    protected $_tZStates = array(
        'title' => 'z_states',
        'treeFields' => array(
            'title'              => 'multilanguage'
        )
    );
    
    protected $_tZTowns = array(
        'title' => 'z_towns',
        'treeFields' => array(
            'title'              => 'multilanguage'
        )
    );
    
    protected $_tZUsersFinanceLog = array(
        'title' => 'z_users_finance_log',
        'treeFields' => array(
            'comment'              => 'multilanguage'
        )
    );
    
    protected $_tZUsersRoles = array(
        'title' => 'z_users_roles',
        'treeFields' => array(
            
        )
    );
    
    protected $_tZUsersSessions = array(
        'title' => 'z_users_sessions',
        'treeFields' => array()
    );
    
    protected $_tZUsers = array(
        'title' => 'z_users',
        'treeFields' => array(
            'name'              => 'multilanguage',
            'firstname'         => 'multilanguage',
            'about'             => 'multilanguage',
            'phones'            => 'array',
            'z_languages_array' => 'array',
            'votes'             => 'array',
            'tops_price_drop'             => 'array'
        )
    );
    
    private $_cryptKey = 'dssdf123567676fdgf';
    
    public function __construct()
    {
    	$path = parse_url($_SERVER['REQUEST_URI']);
	$path = $path['path'];
	$path = explode('/', trim($path, '/'));
        
        $this->_db = Zend_Registry::get('db');
        $this->initLanguage($path[0]);
        $this->initCurrencie($path[1]);
        $this->_urlTransform();
    }
    
    protected function _urlTransform()
    {
        $path = parse_url($_SERVER['REQUEST_URI']);
	$path = $path['path'];
	$path = explode('/', trim($path, '/'));
        
        $lng = $this->isLanguage($path[0]);
        $cur = $this->isCurrencie(strtoupper($path[1]));
        
        $redirect = false;
        if ($path[0] == '') {
            $path[0] = $this->_lang['alias'];
            $path[1] = strtolower($this->_currencie['alias']);
            $redirect = true;
        } elseif (!$lng && !$cur) {
            array_unshift($path, $this->_lang['alias'], strtolower($this->_currencie['alias']));
            $redirect = true;
        } elseif (!$lng && $cur) {
            array_unshift($path, $this->_lang['alias']);
            $redirect = true;
        } elseif ($lng && !$cur) {
            $newPath = array();
            $newPath[0] = $this->_lang['alias'];
            $newPath[1] = strtolower($this->_currencie['alias']);
            $i == -1;
            foreach ($path as $item) {
                $i++;
                if ($i > 1) {
                    $newPath[] = $item;
                }
            }
            $path = $newPath;
            $redirect = true;
        }
        
        if ($redirect) {
            $location = '/' . implode('/', $path);
            header ('Location: ' . $location);
        }
        
    }   
    
    public function mailto($to, $subject, $msg) {
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers .= 'To: ' . $to . "\r\n";
        $headers .= 'From: Zaselis Notification Service <activation@zaselis.com>' . "\r\n";
        mail($to, $subject, $msg, $headers);
    }
    
    public function initLanguage($lang = null)
    {
        if (!is_null($lang)) {
            $nLang = $this->isLanguage($lang);
            if ($nLang) {
                $nLang = $this->_treeFieldsTransform($this->_tZLanguages['title'], $nLang, false);
                foreach ($nLang as $key=>&$item) {
                    if ($key == 'title') {
                        $item = $item->$nLang['alias'];
                    }
                }
                Zend_Registry::set('lang', $nLang);
                $this->_lang = Zend_Registry::get('lang');
                return;
            }
        }
        
        try {
            $this->_lang = Zend_Registry::get('lang');
        } catch (Exception $e) {
            $select = $this->_db->select();
            $select->from(array('lng' => $this->_tZLanguages['title']));
            $select->where('lng.default = ?', 'YES');
            $result = $this->_db->fetchRow($select);
            $result = $this->_treeFieldsTransform($this->_tZLanguages['title'], $result, false);
            foreach ($result as $key=>&$item) {
                if ($key == 'title') {
                    $item = $item->$result['alias'];
                }
            }
            Zend_Registry::set('lang', $result);
            $this->_lang = Zend_Registry::get('lang');
        }
    }
    
    public function initCurrencie($currencie = null)
    {
        if (!is_null($currencie)) {
            $nCur = $this->isCurrencie(strtoupper($currencie));
            if ($nCur) {
                $nCur = $this->_treeFieldsTransform($this->_tZCurrencies['title'], $nCur, true);
                Zend_Registry::set('currencie', $nCur);
                $this->_currencie = Zend_Registry::get('currencie');
                return;
            }
        }
        try {
            $this->_currencie = Zend_Registry::get('currencie');
        } catch (Exception $e) {
            $select = $this->_db->select();
            $select->from(array('cur' => $this->_tZCurrencies['title']));
            $select->where('cur.default = ?', 'YES');
            $result = $this->_db->fetchRow($select);
            $result = $this->_treeFieldsTransform($this->_tZCurrencies['title'], $result, true);
            Zend_Registry::set('currencie', $result);
            $this->_currencie = Zend_Registry::get('currencie');
        }
    }
    
    protected function _crypt($str = null) 
    {
        
        if (is_null($str)) {
            return false;
        }        
        
        $td = mcrypt_module_open ('des', '', 'ecb', '');
        $key = substr ($this->_cryptKey, 0, mcrypt_enc_get_key_size ($td));
        $iv_size = mcrypt_enc_get_iv_size ($td);
        $iv = mcrypt_create_iv ($iv_size, MCRYPT_RAND);

        if (mcrypt_generic_init ($td, $key, $iv) != -1) {
                $encrypted_data = base64_encode(mcrypt_generic($td, $str));
                mcrypt_generic_deinit ($td);
                mcrypt_module_close ($td);
        }
        return $encrypted_data;
    }
    
    protected function _deCrypt($str) 
    {
        $td = mcrypt_module_open ('des', '', 'ecb', '');
        $key = substr ($this->_cryptKey, 0, mcrypt_enc_get_key_size ($td));
        $iv_size = mcrypt_enc_get_iv_size ($td);
        $iv = mcrypt_create_iv ($iv_size, MCRYPT_RAND);
        
        if (mcrypt_generic_init ($td, $key, $iv) != -1) {
            $data = mdecrypt_generic($td, base64_decode($str));
            mcrypt_generic_deinit ($td);   
        } 
        mcrypt_module_close ($td);
        $data = trim ($data)."\n";
        return $data;
    }
    
    
    
    /**
     * Transform returned row when it has an JSON fields
     * 
     * @param string $tbl
     * @param mysql_row $data
     * @param boolean $translate if TRUE then returns only value in current language
     * @return array
     */
    public function _treeFieldsTransform($tbl = null, $data = array(), $translate = false) {
        if ($tbl == null) {
            return $data;
        }
        $filter = new Zend_Filter_Word_UnderscoreToCamelCase();
        $tbl = '_t' . ucfirst($filter->filter($tbl));
        $tbl = $this->$tbl;
        
        if (!empty($tbl['treeFields'])) {
            foreach ($data as $key=>&$value) {
                if (isset($tbl['treeFields'][$key])) {
                    $value = json_decode(base64_decode($value));
                    if($tbl['treeFields'][$key] == 'multilanguage' && $translate == true) {
                        $lang = $this->_lang['alias'];
                        if (isset($value->$lang)) {
                            $value =  $value->$lang;
                        } else {
                            $value = '';
                        }
                    }
                }
            }
        }
        return $data;
    }
    
    protected function _multiTreeFieldsTransform($tbl = null, $data = array(), $translate = false) {
        foreach ($data as &$row) {
            $row = $this->_treeFieldsTransform($tbl, $row, $translate);
        }
        return $data;
    }
    
    public function getLanguagesList()
    {
        $select = $this->_db->select();
        
        $select->from(array('lng' => $this->_tZLanguages['title']));
        $select->where('lng.avaliable = ?', 'YES');
        $result = $this->_db->fetchAll($select);
        $return = $this->_multiTreeFieldsTransform($this->_tZLanguages['title'], $result, false);
        return $return; 
    }
    
    public function isCurrencie($alias = null) 
    {
        if (is_null($alias)) {
            return false;
        }
        $select = $this->_db->select();
        
        $select->from(array('cur' => $this->_tZCurrencies['title']));
        $select->where('cur.avaliable = ?', 'YES');
        $select->where('cur.alias = ?', $alias);
        
        $result = $this->_db->fetchRow($select);
        
        if (count($result) > 0) {
            return $result;
        } 
        return false;
    }
    
    public function isLanguage($alias = null)
    {
        if (is_null($alias)) {
            return false;
        }
        $select = $this->_db->select();
        
        $select->from(array('lng' => $this->_tZLanguages['title']));
        $select->where('lng.avaliable = ?', 'YES');
        $select->where('lng.alias = ?', $alias);
        
        $result = $this->_db->fetchRow($select);
        
        if (count($result) > 0) {
            return $result;
        } 
        return false;
    }
    
    public function getCurrenciesList()
    {
        $select = $this->_db->select();
        $select->from(array('cur' => $this->_tZCurrencies['title']));
        $select->where('cur.avaliable = ?', 'YES');
        $result = $this->_db->fetchAll($select);
        $return = $this->_multiTreeFieldsTransform($this->_tZCurrencies['title'], $result, true);
        return $return;
    }
    
    protected function _prepareToTree($array)
    {
        return base64_encode(json_encode($array));
    }
    
    /**
     * 
     * Inserts row in table
     * @param string $tbl
     * @param array $array
     * @return integer
     */
    protected function _insert($tbl, $array)
    {
    	foreach ($array as $key=>&$item) {
            if (is_array($item)) {
                $item = $this->_prepareToTree($item);
            }
        }
        
        $this->_db->insert($tbl, $array);
    	return $this->_db->lastInsertId();
    }
    
    /**
     * 
     * Updates row in tables
     * @param integer $id
     * @param string $tbl
     * @param array $array
     */
    protected function _update($id, $tbl, $array)
    {
    	foreach ($array as &$item) {
            foreach ($item as &$cell) {
                if (is_array($cell)) {
                    $cell = $this->_prepareToTree($cell);
                }
            }
        }
        
        $this->_db->update($tbl, $array, $tbl . '_id = ' . $id);
    }
    
    /**
     * 
     * Remove row from table
     * @param integer $id
     * @param string $tbl
     */
    protected function _delete($id, $tbl)
    {
    	$this->_db->delete($tbl, $tbl . '_id = ' . $id);
    }
   
    
}