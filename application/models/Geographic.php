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
        $select->order('country.title');

        return $this->_db->fetchAll($select);
    }

    public function saveCountriesGreed($greed)
    {
        foreach ($greed as $row) {
            $countryUpdate = array(
                'day_price' => $row['day_price'],
                'avaliable' => $row['avaliable']
            );

            $codeUpdate = array(
                'code' => $row['code']
            );

            $this->_update($row['z_countries_id'], $this->_tZCountries['title'], $countryUpdate);
            $this->_update($row['z_phone_codes_id'], $this->_tZPhoneCodes['title'], $codeUpdate);
        }
    }

    public function getTownsForManage($country = 0)
    {
        $select = $this->_db->select();
        $select->from($this->_tZTowns['title']);
        $select->where('z_countries_id = ?', $country);

        return $this->_db->fetchAll($select);
    }

    public function saveTownsGreed($greed)
    {
        foreach ($greed as $row) {
            $townUpdate = array(
                'day_price' => $row['day_price'],
                'avaliable' => $row['avaliable']
            );

            $this->_update($row['z_towns_id'], $this->_tZTowns['title'], $townUpdate);

        }
    }
}