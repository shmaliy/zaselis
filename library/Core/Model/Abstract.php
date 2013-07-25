<?php 
class Core_Model_Abstract
{
    protected $_db;
    protected $_lang;
    protected $_currencie;
    
    public $snetworks_list = array(
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

    // List of tables
    protected $_tZCountries = array(
        'title' => 'z_countries',
        'treeFields' => array()
    );
    
    protected $_tZCurrencies = array(
        'title' => 'z_currencies',
        'treeFields' => array(
            'title'              => 'multilanguage'
        )
    );
    
    protected $_tZDistricts = array(
        'title' => 'z_districts',
        'treeFields' => array()
    );
    
    protected $_tZFlats = array(
        'title' => 'z_flats',
        'treeFields' => array(
            'photos' => 'array',
            'votes' => 'array'
        )
    );
    
    protected $_tZFlatsTypes = array(
        'title' => 'z_flats_types',
        'treeFields' => array()
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
        'treeFields' => array()
    );
    
    protected $_tZStates = array(
        'title' => 'z_states',
        'treeFields' => array()
    );
    
    protected $_tZTowns = array(
        'title' => 'z_towns',
        'treeFields' => array()
    );
    
    protected $_tZUsersFinanceLog = array(
        'title' => 'z_users_finance_log',
        'treeFields' => array(
            'comment'              => 'multilanguage'
        )
    );
    
    protected $_tZPhoneCodes = array(
        'title' => 'z_phone_codes',
        'treeFields' => array()
    );
    
    protected $_tZUsersRoles = array(
        'title' => 'z_users_roles',
        'treeFields' => array()
    );
    
    protected $_tZUsersSessions = array(
        'title' => 'z_users_sessions',
        'treeFields' => array()
    );
    
    protected $_tZUsers = array(
        'title' => 'z_users',
        'treeFields' => array(
            'phones'            => 'array',
            'z_languages_array' => 'array',
            'votes'             => 'array',
            'tops_price_drop'   => 'array',
            'social_networks'   => 'array'
        )
    );
    
    private $_cryptKey = 'dssdf123567676fdgf';
    
    // z_countries country
    // z_states administrative_area_level_1
    // z_towns locality
    
    public $geoPoints = array(
        'z_countries' => 'country',
        'z_states'    =>  'administrative_area_level_1',
        'z_towns'     => 'locality',
        'z_districts' => 'sublocality',
        'street'      => 'route'
    );
    
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
    
    public function codeConverter()
    {
        $select = $this->_db->select();
        $select->from($this->_tZPhoneCodes['title']);
        $select->where('converted = 0');
        $select->limit(10);
        $data = $this->_db->fetchAll($select);
        
        foreach ($data as $item) {
            $obj = $this->googleGetAddress($item['z_countries_title']);
            $cid = $this->saveCountry($obj);
            
            $country = $this->getCountryById($cid);
            $update = array(
                "z_countries_title" => $country['title'],
                'converted' => 1,
                'z_countries_id' => $cid
            );
            
            $this->_update($item['z_phone_codes_id'], $this->_tZPhoneCodes['title'], $update);
        } 
    }
    
    public function codeCleaner()
    {
        $select = $this->_db->select();
        $select->from($this->_tZPhoneCodes['title']);
        $data = $this->_db->fetchAll($select);
        
        foreach ($data as $item) {
            $select->reset();
            
            $select = $this->_db->select();
            $select->from($this->_tZPhoneCodes['title']);
            $select->where('z_countries_id = ?', $item['z_countries_id']);
            
            $codes = $this->_db->fetchAll($select);
            
            $i = 0;
            foreach($codes as $code) {
                if ($i > 0) {
                    $this->_delete($code['z_phone_codes_id'], $this->_tZPhoneCodes['title']);
                }
                $i++;
            }
            
        }
    }
    
    public function getGeoIp()
    {
        if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1') {
            $ip = '46.98.24.112';
        } else {$ip = $_SERVER['REMOTE_ADDR'];}
        
        $url = 'http://freegeoip.net/json/' . $ip;
                
        $options = array(
                       CURLOPT_RETURNTRANSFER => true,         // return web page
                       CURLOPT_CONNECTTIMEOUT => 5,          // timeout on connect
       );

       $ch      = curl_init($url);
       curl_setopt_array($ch, $options);
       $content = curl_exec($ch);
       $err     = curl_errno($ch);
       $errmsg  = curl_error($ch) ;
       $header  = curl_getinfo($ch);
       curl_close($ch);

       $content = json_decode($content);
//       echo '<pre>';
//       var_export($content);
//       echo '</pre>';
       return $content;
    }
    
    public function googleGetAddress($str = null, $lang = 'en')
    {
        if (is_null($str)) {
            return false;
        }
        
        $str = str_replace(' ', '%20', $str);
        
        $url = 'http://maps.googleapis.com/maps/api/geocode/json?address=' . $str . '&sensor=false&language=' . $lang;
        
        $options = array(
                       CURLOPT_RETURNTRANSFER => true,         // return web page
                       CURLOPT_HEADER         => false,        // don't return headers
                       CURLOPT_FOLLOWLOCATION => true,         // follow redirects
                       CURLOPT_AUTOREFERER    => true,         // set referer on redirect
                       CURLOPT_CONNECTTIMEOUT => 120,          // timeout on connect
                       CURLOPT_TIMEOUT        => 120,          // timeout on response
                       CURLOPT_MAXREDIRS      => 10,           // stop after 10 redirects
                       CURLOPT_POST            => 1,            // i am sending post data
                       CURLOPT_POSTFIELDS     => $post,    // this are my post vars
                       CURLOPT_SSL_VERIFYHOST => 0,            // don't verify ssl
                       CURLOPT_SSL_VERIFYPEER => false,        //
                       CURLOPT_VERBOSE        => 1                //
       );

       $ch      = curl_init($url);
       curl_setopt_array($ch, $options);
       $content = curl_exec($ch);
       $err     = curl_errno($ch);
       $errmsg  = curl_error($ch) ;
       $header  = curl_getinfo($ch);
       curl_close($ch);

       $content = json_decode($content);
       
       // Formatted adress  $content->results[0]->formatted_address
       // City name         $content->results[0]->address_components[0]->long_name
       // State name        $content->results[0]->address_components[2]->long_name
       // Country name      $content->results[0]->address_components[3]->long_name
       
       // City location lat $content->results[0]->geometry->location->lat
       // City location lng $content->results[0]->geometry->location->lat
       
       
       return $content;
    }
    
    public function getCountryById($id) 
    {
        $select = $this->_db->select();
        $select->from(
            array ('country' => $this->_tZCountries['title'])
        );
        $select->where('country.z_countries_id = ?', $id);
        return $this->_db->fetchRow($select);
    }
    
    public function getStateById($id) 
    {
        $select = $this->_db->select();
        $select->from(
            array ('state' => $this->_tZStates['title'])
        );
        $select->where('state.z_states_id = ?', $id);
        return $this->_db->fetchRow($select);
    }
    
    public function getTownById($id) 
    {
        $select = $this->_db->select();
        $select->from(
            array ('town' => $this->_tZTowns['title'])
        );
        $select->where('town.z_towns_id = ?', $id);
        return $this->_db->fetchRow($select);
    }
    
    
    public function saveCountry($obj)
    {
        foreach ($obj->results[0]->address_components as $item) {
            foreach ($item->types as $type) {
                if ($type == $this->geoPoints['z_countries']) {
                    $name = $item->long_name;
                }
            }
        }
        
//        $name = $obj->results[0]->address_components[0]->long_name;
        
        $select = $this->_db->select();
        $select->from(
            array ('country' => $this->_tZCountries['title']),
            array ('z_countries_id')
        );
        $select->where('country.title = ?', $name);
        $return = $this->_db->fetchRow($select);
        
        if($return) {
            return $return['z_countries_id'];
        }
        
        $insert = array(
            'title'     => $name,
            'latitude'  => $obj->results[0]->geometry->location->lat,
            'longitude' => $obj->results[0]->geometry->location->lng,
            'alias'     => $obj->results[0]->address_components[0]->short_name
        );
        return $this->_insert($this->_tZCountries['title'], $insert);
        
    }
    
    public function saveState($obj)
    {
//        echo '<pre>';
//        var_export($obj);
//        echo '</pre>';
        
        $states_parent = $this->saveCountry($obj);
        
        foreach ($obj->results[0]->address_components as $item) {
            foreach ($item->types as $type) {
                if ($type == $this->geoPoints['z_states']) {
                    $name = $item->long_name;
                }
            }
        }
        
//        echo $name;
        
        $select = $this->_db->select();
        $select->from(
            array ('state' => $this->_tZStates['title']),
            array ('z_states_id')
        );
        $select->where('state.title = ?', $name);
        $select->where('state.z_countries_id = ?', $states_parent);
        $return = $this->_db->fetchRow($select);
        
        if($return) {
            return $return['z_states_id'];
        }
        
        $insert = array(
            'z_countries_id' => $states_parent,
            'title'          => $name,
            'latitude'  => $obj->results[0]->geometry->location->lat,
            'longitude' => $obj->results[0]->geometry->location->lng,
            'alias'     => $obj->results[0]->address_components[0]->short_name
            
        );
        
//        echo '<pre>';
//        var_export($insert);
//        echo '</pre>';
        
        return $this->_insert($this->_tZStates['title'], $insert);
        
    }
    
    public function saveTown($obj)
    {
        $parent_state = $this->saveState($obj);
        $parent_country = $this->saveCountry($obj);
        
        foreach ($obj->results[0]->address_components as $item) {
            foreach ($item->types as $type) {
                if ($type == $this->geoPoints['z_towns']) {
                    $name = $item->long_name;
                }
            }
        }
        
        $select = $this->_db->select();
        $select->from(
            array ('town' => $this->_tZTowns['title']),
            array ('z_towns_id')
        );
        $select->where('town.title = ?', $name);
        $select->where('town.z_countries_id = ?', $parent_country);
        $select->where('town.z_states_id = ?', $parent_state);
        $return = $this->_db->fetchRow($select);
        
        if($return) {
            return $return['z_towns_id'];
        }
        
        $insert = array(
            'z_countries_id' => $parent_country,
            'z_states_id' => $parent_state,
            'title'          => $name,
            'latitude'  => $obj->results[0]->geometry->location->lat,
            'longitude' => $obj->results[0]->geometry->location->lng,
            'alias'     => $obj->results[0]->address_components[0]->short_name
        );
        
//        echo '<pre>';
//        var_export($insert);
//        echo '</pre>';
        
        return $this->_insert($this->_tZTowns['title'], $insert);
    }
    
    public function saveDistrict($obj)
    {
        
    }
    
    public function saveMetro($obj)
    {
        
    }
    
    public function getCountry($obj)
    {
        foreach ($obj->address_components as $item) {
            foreach ($item->types as $type) {
                if ($type == $this->geoPoints['z_countries']) {
                    $country = $this->googleGetAddress($item->long_name);
                    
                    return $this->saveCountry($country);
                }
            }
        }
    }
    
    public function getState($obj)
    {
        foreach ($obj->address_components as $item) {
            foreach ($item->types as $type) {
                if ($type == $this->geoPoints['z_states']) {
                    $state = $this->googleGetAddress($item->long_name);
                    
                    return $this->saveState($state);
                }
            }
        }
    }
    
    public function getTown($obj)
    {
        foreach ($obj->address_components as $item) {
            foreach ($item->types as $type) {
                if ($type == $this->geoPoints['z_towns']) {
                    $town = $this->googleGetAddress($item->long_name);
                    
                    return $this->saveTown($town);
                }
            }
        }
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
                        $item = $item[$nLang['alias']];
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
                    $value = json_decode(base64_decode($value), true);
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
        
        return $this->_db->update($tbl, $array, $tbl . '_id = ' . $id);
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