<? 

class Flats_Model_Flats extends Core_Model_Abstract
{
    private $_usersModel;
    private $_user;
    
    public function __construct() {
        $this->_usersModel = new User_Model_Users();
        $this->_user = $this->_usersModel->getActiveUser();
        
        parent::__construct();
    }
    
    public function getFlatsTypesList()
    {
        $select = $this->_db->select();
        $select->from(array('types' => $this->_tZFlatsTypes['title']));
        $select->where('types.avaliable = ?', 'YES');
        $select->order('types.ordering');
        
        $data = $this->_db->fetchAll($select);
        
        $multiOptions = array();
        
        foreach ($data as $item) {
            $multiOptions[$item['z_flats_types_id']] = $item['title'];
        }
        
        return $multiOptions;
    }
    
    public function saveFirstTab($data)
    {
        var_export($data);
        $obj = $this->googleGetAddress($data['adress']);
        
        $insert = array(
            'z_flats_id' => $data['z_flats_id'],
            'z_flats_types_id' => $data['z_flats_types_id'],
            'z_users_id' => $this->_user['z_users_id'],
            'z_countries_id' => $this->saveCountry($obj),
            'z_states_id' => $this->saveState($obj),
            'z_towns_id' => $this->saveTown($obj),
            'z_districts_id' => '',
            'z_metros_id' => '',
            'adress' => $data['adress'],
            'district_description' => $data['district_description'],
            'main_description' => $data['main_description'],
            'rooms_count' => $data['rooms_count'],
            'guests_count' => $data['guests_count'],
            'price' => $data['price'],
            'gps' => '',
            'status' => 'Hidden',
            'created_ts' => time(),
            'edited_ts' => time()
        );
        
        if ($data['z_flats_id'] == 'new' || !is_int($data['z_flats_id'])) {
            unset($insert['z_flats_id']);
        } else {
            unset($insert['created_ts']);
        }
        
        var_export($insert);
    }
}