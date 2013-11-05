<?php
class Application_Model_Geographic extends Core_Model_Abstract
{
    private $_user;

    public function __construct() {
        $this->_usersModel = new User_Model_Users();
        $this->_user = $this->_usersModel->getActiveUser();

        parent::__construct();
    }

    public function getCountriesForManage()
    {
        $select = $this->_db->select();
        $select->from(array('country' => $this->_tZCountries['title']));
        $select->joinLeft(
            array('code' => $this->_tZPhoneCodes['title']),
            "country.z_countries_id = code.z_countries_id",
            array(
                'codes_id' => 'code.z_phone_codes_id',
                'codes_code' => 'code.code'
            )
        );

        return $this->_db->fetchAll($select);
    }

    public function saveCountriesGreed($greed)
    {

    }

    public function getTownsForManage($country = 0)
    {

    }

    public function saveTownsGreed($greed)
    {

    }
}