<?php

namespace App\Models;

use CodeIgniter\Model;

class DatabaseModel extends Model{
	public $db;
	public function __construct(){
		$this->db = \Config\Database::connect();
	}
	
	public function getRows($params = array()){
		$table = $this->db->table($params['table_name'] ); 
		
		if(!empty($params['table_name'])){
			$table->select('*');			
			
			if(array_key_exists("conditions", $params)){
				foreach($params['conditions'] as $key => $val){
					$table->where($key, $val); 
				}
			}
			
			if(isset($params['operator']) && $params['operator'] == 'IN'){
				$table->where_in($params['fiendin'][0], $params['fiendin'][1]);
			}
			
			
			//Filter with like operator
			if(isset($params['like'])){
				$table->like( $params['like'][0], $params['like'][1] );
			}
			
			//print_r($params);
			if( isset($params['order_by'])){
				$table->order_by('ID', $params['order_by']);
			}
			
			if( $params['return_result'] == 'single' ){
				$query = $table->get();				
				$this->db->close();
				return $query->getResultArray();
				die();				
			}else{
				if( isset($params['limit'])){
					if( isset($params['offset'])){
						$offset = $params['offset'];
					}else{
						$offset = '';
					}
					$table->limit($params['limit'], $offset);
				}
				$query = $table->get();				
				$this->db->close();
				return $query->getResultArray();
				die();
			}
		}
	
		die;
    }
	
	/* 
     * Delete
     * @param $data data to be inserted 
     */
	 public function delete_row($params = array()) {
		$table = $this->db->table($params['table_name']); 
		if(array_key_exists("conditions", $params)){
			foreach($params['conditions'] as $key => $val){ 
				$table->where($key, $val);
			}
		}

		return $delete = $table->delete();
		
		die();
    }
}