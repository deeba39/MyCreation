<?php
/* 

 */
include_once("adb.php");
class grants extends adb{
    function grants(){
        adb::adb();
        $this->er_code_prefix=2300;     //error prefix for this class is 23
        $this->src="grants";
    }

    function add(){

    }

    function delete(){

    }

    function update(){

    }

    function get_grants(){
        $str_query="SELECT `grant_package_id`,`name`, `code`, `annual_amount` FROM grant_package WHERE grant_package_id!=0";
        if(!$this->sql_query($str_query)){
            $this->error=$this->log_error(LOG_LEVEL_DB_FAIL,11,"error while getting all grant packages. see error {$this->error} for details.");
            return false;
        }

        return true;
    }

    function get_grant($grant_package_id){
        $str_query="SELECT `grant_package_id`,`name`, `code`, `annual_amount` FROM grant_package WHERE grant_package_id=$grant_package_id";
        if(!$this->sql_query($str_query)){
            $this->error=$this->log_error(LOG_LEVEL_DB_FAIL,11,"error while getting all grant packages. see error {$this->error} for details.");
            return false;
        }
        return $this->fetch();
        
    }

    function get_grant_summary(){

    }


}
?>
