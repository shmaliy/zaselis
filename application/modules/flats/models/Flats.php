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
    
    public function setParamIcon($pId, $file = null)
    {
        if (is_null($file)) {
            $file = '';
        }
        $upd['icon'] = $file;
        $this->_update($pId, $this->_tZFlatsParams['title'], $upd);
    }
    
    public function saveParamsGreed($greed)
    {
        $i = 1;
        foreach ($greed as $cell) {
            $upd = array(
                'title' => $cell['1'],
                'description' => $cell['2'],
                'type' => $cell['3'],
                'ordering' => $i,
                'avaliable' => $cell['4']
            );
            $this->_update($cell['0'], $this->_tZFlatsParams['title'], $upd);
        }
    }
    
    public function getParameterValuesList($paramId)
    {
        $select = $this->_db->select();
        $select->from($this->_tZFlatsParamsValues['title']);
        $select->where('z_flats_params_id = ?', $paramId);
        $select->order('ordering');
        return $this->_db->fetchAll($select);
    }
    
    public function createParametersValue($data)
    {
        $this->_insert($this->_tZFlatsParamsValues['title'], $data);
        $this->fixValuesOrdering($data['z_flats_params_id']);
    }
    
    public function saveParametersValues($greed)
    {
        $i = 1;
        foreach ($greed as $row) {
            $rowId = $row['0'];
            $upd = array(
                'text_value' => $row['1'],
                'avaliable' => $row['2'],
                'ordering' => $i
            );
            
            $this->_update($rowId, $this->_tZFlatsParamsValues['title'], $upd);
            $i++;
        } 
    }
    
    public function removeParametersValue($id)
    {
        $this->_delete($id, $this->_tZFlatsParamsValues['title']);
    }
    
    public function removeParam($id)
    {
        $select = $this->_db->select();
        $select->from($this->_tZFlatsParamsValues['title']);
        $select->where('z_flats_params_id = ?', $id);
        $values = $this->_db->fetchAll($select);

        $this->_delete($id, $this->_tZFlatsParams['title']);
        
        if (!empty($values)) {
            foreach ($values as $item) {
                $this->_delete($item['z_flats_params_values_id'], $this->_tZFlatsParamsValues['title']);
            }
        }
    }
    
    public function getManageBedsList()
    {
        $select = $this->_db->select();
        $select->from($this->_tZFlatsBads['title']);
        $select->order('ordering');
        return $this->_db->fetchAll($select);
    }
    
    public function createBed($data)
    {
        $this->_insert($this->_tZFlatsBads['title'], $data);
        $this->fixBedsOrder();
    }
    
    public function removeBed($id)
    {
        $this->_delete($id, $this->_tZFlatsBads['title']);
    }
    
    public function saveBedsGreed($greed)
    {
        $i = 1;
        foreach ($greed as $row) {
            $id = $row[0];
            $upd = array(
                'title' => $row[1],
                'guests' => $row[2],
                'avaliable' => $row[3],
                'ordering' => $i
            );
            $this->_update($id, $this->_tZFlatsBads['title'], $upd);
            $i++;
        }
    }
    
    public function setBedIcon($id, $file = null)
    {
        $upd['icon'] = $file;
        if (is_null($file)) {
            $upd['icon'] = '';
        }
        $this->_update($id, $this->_tZFlatsBads['title'], $upd);
    }
    
    public function fixBedsOrder()
    {
        $select = $this->_db->select();
        $select->from($this->_tZFlatsBads['title']);
        $select->order('ordering');
        $list = $this->_db->fetchAll($select);
        
        if ($list[0]['ordering'] == 0) {
            foreach ($list as $item) {
                $upd['ordering'] = $item['ordering'] + 1;
                $this->_update($item['z_flats_beds_id'], $this->_tZFlatsBads['title'], $upd);
            }
        }
    }
    
    public function fixValuesOrdering($paramId)
    {
        $select = $this->_db->select();
        $select->from($this->_tZFlatsParamsValues['title']);
        $select->where('z_flats_params_id = ?', $paramId);
        $select->order('ordering');
        $list = $this->_db->fetchAll($select);
        
        if ($list[0]['ordering'] == 0) {
            foreach ($list as $item) {
                $upd = array(
                    'ordering' => $item['ordering'] + 1
                );
                $this->_update($item['z_flats_params_values_id'], $this->_tZFlatsParamsValues['title'], $upd);
            }
        }
    }
    
    public function getManageParamsList()
    {
        $select = $this->_db->select();
        
        $select->from($this->_tZFlatsParams['title']);
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
            'route_description' => $data['route_description'],
            'house_rules' => $data['house_rules'],
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
    
    public function getParamsList($flatId)
    {
        $select = $this->_db->select();
        $select->from(
            array('params' => $this->_tZFlatsParams['title']),
            array(
                'param_id' => 'params.' . $this->_tZFlatsParams['title'] . '_id',
                'param_icon' => 'params.icon',
                'param_title' => 'params.title',
                'param_type' => 'params.type'
            )
        );
        $select->where('params.avaliable = ?', 'YES');
        $select->order('params.ordering');
        
        $select->joinLeft(
            array('relations' => $this->_tZFlatsParamsValuesRelations['title']),
            "params.z_flats_params_id = relations.z_flats_params_id and " . 
            "relations.z_flats_id = " . $flatId,
            array(
                'rel_id' => 'relations.z_flats_params_values_relations_id',
                'rel_boolean' => 'relations.boolean',
                'rel_value_id' => 'relations.z_flats_params_values_id'
            )
        );
        $return = $this->_db->fetchAll($select);
        
        echo '<pre>';
        var_export($return);
        echo '</pre>';
        
        return $return;
    }
    
    public function getParamsValuesList()
    {
        $select = $this->_db->select();
    }
}