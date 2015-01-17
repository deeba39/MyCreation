<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of grants
 *
 * @author Aelaf Dafla
 */
include_once("adb.php");
class grants extends adb {
    //put your code here
    function grants(){
        adb::adb();
        $this->er_code_prefix=ER_GRANTS;     //error prefix for this class is 23
        $this->src="grants";
    }
    function get_grants(){
        $str_query="SELECT `grant_package_id`,`name`, `code`, `annual_amount` FROM grant_package WHERE grant_package_id!=0";
        if(!$this->sql_query($str_query)){
            $this->error=$this->log_error(LOG_LEVEL_DB_FAIL,11,"error while getting all grant packages. see error {$this->error} for details.");
            return false;
        }

        return true;
    }
}

?>
