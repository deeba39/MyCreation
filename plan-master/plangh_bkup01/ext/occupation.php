<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once("adb.php");
class occupation extends adb{
    function occupation(){
        adb::adb();
        $this->er_code_prefix=ER_OCCUPATION;     //error prefix for this class is 23//dont no yet
        $this->src="payments";
    }

    function add($name,$description){

       $str_query="INSERT INTO application_occupation SET
                    name='$name',
                    description='$description'";
       //print_r($str_query);
       
        if(!$this->sql_query($str_query)){
            $this->log_error(LOG_LEVEL_DB_FAIL, 11, "error while adding occupation. see {$this->error} for detail");
            return false;
        }
        return $this->get_insert_id();
    }
		
    function delete($application_occupation_id){
        //delete occupation
        $str_query="DELETE FROM application_occupation WHERE application_occupation_id=$application_occupation_id";
				//print_r($str_query);
        if(!$this->sql_query($str_query)){
            $this->log_error(LOG_LEVEL_DB_FAIL, 12, "error while deleting occupation $application_occupation_id. see {$this->error} for detail");
            return false;
        }
        return true;
    }

    function update($name,$description,$application_occupation_id){

         $str_query="UPDATE application_occupation SET
                     name='$name',
                    description='$description'
										WHERE application_occupation_id=$application_occupation_id";
         //print_r($str_query);

        if(!$this->sql_query($str_query)){
            $this->log_error(LOG_LEVEL_DB_FAIL, 13, "error while updating occupation. see {$this->error} for detail");
            return false;
        }

        return true;
    }
    function get_occupation($application_occupation_id){
        //get record by id
       $str_query="SELECT `application_occupation_id`, `name`, `description`,`app_point`
        FROM application_occupation
        WHERE application_occupation_id=$application_occupation_id";

        if(!$this->sql_query($str_query)){
            $this->log_error(LOG_LEVEL_DB_FAIL, 14, "error while getting occupation $application_occupation_id. see {$this->error} for detail");
            return false;
        }
        $row=$this->fetch();
        if(!$row){
            $this->log_error(LOG_LEVEL_DB_FAIL, 15, "error while fetching occupation $application_occupation_id.");
            return false;
        }
        return $row;
    }

    
    function get_occupations(){
         //get all communities for list occupation page
       $str_query="SELECT `application_occupation_id`, `name`, `description`
        FROM application_occupation";

        if(!$this->sql_query($str_query)){
            $this->log_error(LOG_LEVEL_DB_FAIL, 14, "error while getting occupation. see {$this->error} for detail");
            return false;
        }
        return true;
    }

    function get_sorted_occupation(){
        //get occupation sorted alphabetical order
				//will work on
        
        $str_query= "SELECT `application_occupation_id`, `name`, `description`
        						FROM application_occupation
                    ODER BY `name` ASC";

        if(!$this->sql_query($str_query)){
            $this->log_error(LOG_LEVEL_DB_FAIL, 16, "error while getting sorted occupations. see {$this->error} for detail");
            return false;
        }

        return true;
    }
}
?>