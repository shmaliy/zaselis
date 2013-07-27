<? 

class Flats_Model_Flats extends Core_Model_Abstract
{
    private $_usersModel;
    private $_user;
    private $_demo = true;
    
    public function __construct() {
        $this->_usersModel = new User_Model_Users();
        $this->_user = $this->_usersModel->getActiveUser();
        
        parent::__construct();
    }
    
    public function createParam($data) 
    {
        $this->_insert($this->_tZFlatsParams['title'], $data);
        $this->fixParamsOrder();
    }
    
    public function getManageParamsList()
    {
        $select = $this->_db->select();
        
        $select->from($this->_tZFlatsParams);
        $select->order('ordering');
        return $this->_db->fetchAll($select);
    }
    
    public function fixParamsOrder()
    {
        $list = $this->getManageParamsList();
        
        if ($list[0]['ordering'] == 0) {
            foreach ($list as $item) {
                $upd = array(
                    'ordering' => $item['ordering'] + 1
                );
                $this->_update($item['z_flats_params_id'], $this->_tZFlatsParams['title'], $upd);
            }
        }
    }
    
    public function getFlatsForMap()
    {
        $select = $this->_db->select();
        $select->from(
            array('flat' => $this->_tZFlats['title']),
            array(
                'z_flats_id', 
                'district_description', 
                'main_description', 
                'latitude', 
                'longitude', 
                'adress')
        );
        
        if (!$this->_demo) {
            $select->where('flat.status = ?', 'Visible');
        }
        
        return $this->_db->fetchAll($select);
        
    }
    
    public function getFlat($id) {
        $select = $this->_db->select();
        $select->from(array('flat' => $this->_tZFlats['title']));
        $select->where('flat.z_flats_id = ?', $id);
        $return = $this->_db->fetchRow($select);
        $return = $this->_treeFieldsTransform($this->_tZFlats['title'], $return, true);
        return $return;
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
    
    public function getFlatsRoomTypesList()
    {
        $select = $this->_db->select();
        $select->from(array('types' => $this->_tZFlatsRoomTypes['title']));
        $select->where('types.avaliable = ?', 'YES');
        $select->order('types.ordering');
        
        $data = $this->_db->fetchAll($select);
        
        $multiOptions = array();
        
        foreach ($data as $item) {
            $multiOptions[$item['z_flats_room_types_id']] = $item['title'];
        }
        
        return $multiOptions;
    }
    
    public function saveFirstTab($data)
    {
        if (empty($data)) {
            return 0;
        }
        
        $obj = $this->googleGetAddress($data['adress']);
        
        $adress = $obj->results[0]->formatted_address;
        $lat = $obj->results[0]->geometry->location->lat;
        $lng = $obj->results[0]->geometry->location->lng;
        $insert = array(
            'z_flats_types_id' => $data['z_flats_types_id'],
            'z_flats_room_types_id' => $data['z_flats_room_types_id'],
            'z_users_id' => $this->_user['z_users_id'],
            'z_countries_id' => $this->saveCountry($obj),
            'z_states_id' => $this->saveState($obj),
            'z_towns_id' => $this->saveTown($obj),
            'z_districts_id' => $this->saveTown($obj),
            'z_streets_id' => $this->saveStreet($obj),
            'adress' => $adress,
            'district_description' => $data['district_description'],
            'main_description' => $data['main_description'],
            'rooms_count' => $data['rooms_count'],
            'latitude' => $lat,
            'longitude' => $lng,
            'status' => 'Hidden',
            'created_ts' => time(),
            'edited_ts' => time()
        );
        
        if ($data['z_flats_id'] == 'new') {
            return $this->_insert($this->_tZFlats['title'], $insert);
            
        } else {
            $id = $data['z_flats_id'];
            unset($insert['created_ts']);
            
            if(0 < $this->_update($id, $this->_tZFlats['title'], $insert)) {
                return $id;
            } else {
                return 0;
            }
        }
        
    }
    
    public function savePhotos($id, $list) {
        $update['photos'] = $this->_prepareToTree($list);
        return $this->_update($id, $this->_tZFlats['title'], $update);
    }
}