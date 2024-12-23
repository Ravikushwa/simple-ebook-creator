<?php

namespace App\Models;
use CodeIgniter\Model;

class Db_model extends Model {

    public $db;

    public function __construct(){
        $this->db = \Config\Database::connect();
    }

    /**
     * Select data from the database with various conditions
     */
    public function select_data($field = '', $table = '', $where = '', $limit = '', $order = '', $like = '', $join_array = '', $group = '', $or_like = '', $where_in = '') {
        $table = $this->db->table( $table );
		$table->select( ($field) ? $field : '*' );
       
        if ($where != '') {
            // foreach($where as $key => $val){
            //     $table->where($key, $val); 
            // }
            $table->where($where);
        }

        if ($where_in != '') {
            $table->where_in($where_in[0], explode(',', $where_in[1]));
        }

        if ($join_array != '') {
            if (isset($join_array['multiple']) && $join_array['multiple']) {
                foreach ($join_array['1'] as $joinArray) {
                    $table->join($joinArray[0], $joinArray[1]);
                }
            } else {
                $table->join($join_array[0], $join_array[1]);
            }
        }

        if ($order != '') {
            $table->order_by($order[0], $order[1]);
        }

        if ($group != '') {
            $table->group_by($group);
        }

        if ($limit != '') {
            if (is_array($limit) && count($limit) > 1) {
                $table->limit($limit[0], $limit[1]);
            } else {
                $table->limit($limit);
            }
        }

        if ($like != '') {
            $like_keys = explode(',', $like[0]);
            $like_values = explode(',', $like[1]);
            foreach ($like_keys as $index => $key) {
                if (!empty($like_values[$index])) {
                    $table->like($key, $like_values[$index]);
                }
            }
        }

        if ($or_like != '') {
            if (is_array($or_like)) {
                foreach ($or_like as $like) {
                    $table->or_like($like[0], $like[1]);
                }
            }
        }
		$query = $table->get();
        // print_r($query); exit;
		$this->db->close();
        return $query->getResultArray();
		die();
      
    }

    /**
     * Insert data into a table
     */
    public function insert_data($table, $data) {
		$table = $this->db->table( $table );
		$table->insert($data);
		
		return $this->db->insertID();
		die();  
    }

     /**
     * Delete data from a table
     */
    public function delete_data($table, $condition, $limit = '') {

		$table = $this->db->table( $table );
		$table->where($condition);
		if (isset($limit) && !empty($limit)) {
			if (is_array($limit)) {
				$table->limit($limit['limit'], $limit['offset']);
			} else {
				$table->limit($limit);
			}
		}

		return $table->delete();
		die();
    }

    public function delete_data_order($table, $condition, $limit = '', $order = '') {
	
		$table = $this->db->table( $table );
		$table->where($condition);
		if (isset($limit)) {
			if (is_array($limit)) {
				$table->limit($limit['limit'], $limit['offset']);
			} else {
				$table->limit($limit);
			}
		}

		if (isset($order)) {
		    if(is_array($order) && !empty($order)){
			    $table->order_by($order[0], $order[1]);
		    }else{
		        $table->order_by($order);
		    }
		}

		return $table->delete();
		die();
    }

    /**
     * Update data in a table
     */
    public function update_data($table, $data, $condition) {
		$table = $this->db->table($table);
		$table->where($condition);
		$table->set($data);
		return $table->update();
    }

    public function update_data_limit($table, $data, $condition, $limit = NULL) {
		$table = $this->db->table( $table );
		$table->where($condition);
		if (isset($limit)) {
			if (is_array($limit)) {
				$table->limit($limit['limit'], $limit['offset']);
			} else {
				$table->limit($limit);
			}
		}
		return $table->update($data);
    }

    public function update_data_join($table, $data, $condition, $join_array = '') {
        $this->db->where($condition);
        if ($join_array != '') {
            if (isset($join_array['multiple']) && $join_array['multiple']) {
                foreach ($join_array['1'] as $joinArray) {
                    $this->db->join($joinArray[0], $joinArray[1]);
                }
            } else {
                $this->db->join($join_array[0], $join_array[1]);
            }
        }
        return $this->db->update($table, $this->security->xss_clean($data));
    }

    /**
     * Aggregate functions (SUM, COUNT, etc.)
     */
    public function aggregate_data($table, $field_nm, $function, $where = NULL, $join_array = NULL) {
        $table = $this->db->table( $table );
        $table->select( $function . "(" . $field_name . ") AS MyFun" );

		if (isset($where) && $where != '') {
			$table->where($where);
		}
        
		if (isset($join_array) && $join_array != '') {
			if (in_array('multiple', $join_array)) {
				foreach ($join_array['1'] as $joinArray) {
					if(isset($joinArray[2])){
					    $table->join($joinArray[0], $joinArray[1] , $joinArray[2]);
					}else{
						$table->join($joinArray[0], $joinArray[1]);
					}
					
				}
			} else {
				if(isset($join_array[2])){
					$table->join($join_array[0], $join_array[1] , $join_array[2]);
				}else{
					$table->join($join_array[0], $join_array[1]);
				}
				
			}
		}

		$query1 = $table->get();

		if ($query1->getNumRows() > 0) {
			$res = $query1->getFirstRow();
			return $res->MyFun;
		} else {
			return array();
		}		
    }

    /**
     * Run custom queries
     */
   	# function for run custom query  
	function custom_query($query)
	{
		return $this->db->query($query);
		$this->db->insert_id();
		die();
	}

	/**
     * Count all rows with conditions
     */
    public function countAll($tbl_name, $where = '', $like = '', $where1 = '', $likes = '', $join_array = '', $group = '', $or_like = '', $where_in = '') {
        $table = $this->db->table( $tbl_name ); 
		// $table->select( ($field) ? $field : '*' );

        if ($where != '') {
             $table->where($where);
        }

        if ($like != '') {
             $table->or_like($like);
        }

        if ($where1 != '') {
             $table->where($where1);
        }

        if ($where_in != '') {
             $table->where_in($where_in[0], explode(',', $where_in[1]));
        }

        if ($likes != '') {
            $like_keys = explode(',', $likes[0]);
            $like_values = explode(',', $likes[1]);
            foreach ($like_keys as $index => $key) {
                if (!empty($like_values[$index])) {
                     $table->like($key, $like_values[$index]);
                }
            }
        }

        if ($or_like != '') {
            foreach ($or_like as $like) {
                 $table->or_like($like[0], $like[1]);
            }
        }

        if ($join_array != '') {
            if (isset($join_array['multiple']) && $join_array['multiple']) {
                foreach ($join_array['1'] as $joinArray) {
                    if (isset($joinArray[2])) {
                         $table->join($joinArray[0], $joinArray[1], $joinArray[2]);
                    } else {
                         $table->join($joinArray[0], $joinArray[1]);
                    }
                }
            } else {
                if (isset($join_array[2])) {
                     $table->join($join_array[0], $join_array[1], $join_array[2]);
                } else {
                     $table->join($join_array[0], $join_array[1]);
                }
            }
        }

        if ($group != '') {
             $table->group_by($group);
        }
        $query = $table->get();
        // print_r($query); exit;
		$this->db->close();
        return count($query->getResultArray());
		die();
        // return  $table->count_all_results();
    }

    /**
     * Increment or decrement a column value
     */
    public function update_with_increment($table, $column, $condition, $plusminus, $limit = NULL) {
        $table = $this->db->table( $table ); 
		 $table->where($condition);
         $table->set($column, "$column+1", FALSE);
        if ($plusminus == 'minus') {
             $table->set($column, "$column-1", FALSE);
        }
        if ($limit != NULL) {
             $table->limit($limit);
        }
        return  $table->update($table);
    }

    /**
     * Configure SQL mode
     */
    public function setCode() {
        $this->db->query("SET sql_mode='NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION'");
    }

	function get_schema_data($params){
		extract($params);
		$this->dbName = $this->db->database;
		echo $query = "SELECT $fields FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$this->dbName' AND TABLE_NAME = '$table'";
		return $this->db->query($query)->result_array()[0];
		die();
	}
}
