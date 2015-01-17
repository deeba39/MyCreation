<?php

/**
 * author: Aelaf T Dafla
 * date:
 * description: A root class for all manage classes. This class communicates with DB
 */


include_once("const.php");



class adb {

	
	/**error description*/
    var $str_error;
    /*error code*/
    var $error;
    /*db connection link*/
    var $link;
    /* Every error log has a 4 digit code. The first two digits(prefix) tells you which class logged the error*/
    var $er_code_prefix;
    /* query result resource*/
    var $result;
    /* name of the sub class*/
    var $src;

    function adb() {
        $this->src = "db";
        $this->er_code_prefix=1000;
        $this->link=false;
        $this->result = false;
    }

    /**
     * logs error into database using functions defined in log.php
     */
    function log_error($level, $code, $msg, $mysql_msg = "NONE") {
        $er_code = $this->er_code_prefix + $code;
        $log_id = log_msg($level, $er_code, $msg, $mysql_msg);
        //if log id is false return 0;
        if (!$log_id) {
            return 0;
        }

        //display this code to user
        $this->error="$er_code-$log_id";
        return $log_id;
    }

   

    /**
     * creates connection to database
     */
    function connect() {

        $log_id = 0;
        if($this->link)
        {
            return true;
        }
        //try to connect to db
        $this->link = mysql_connect(DB_HOST . ":" . DB_PORT, DB_USER, DB_PWORD);
		
        if (!$this->link) {
            //if connection fail log error and set $str_error
            echo "not connected";
            $this->log_error(LOG_LEVEL_DB_FAIL, 1, "Could not connect to DB in manage::init_connection", mysql_error());
            return false;
        }
		
        if (!mysql_select_db(DB_NAME)) {
            
            $log_id = $this->log_error(LOG_LEVEL_DB_FAIL,2, "Could not select database in manage::init_connection() :", mysql_error($this->link));
            return false;
        }

        return true;
    }

    function select_db($db) {
        if (!mysql_select_db(DB_NAME)) {
            
            $log_id = $this->log_error(LOG_LEVEL_DB_FAIL, 3, "Could not select database in manage::init_connection() :", mysql_error($this->link));
           
            return false;
        }
        return true;
    }

    

    function fetch() {
        return mysql_fetch_assoc($this->result);
    }

    /**
     * returns error message store in str_error in a formatted way
     */
    //It is not ideal to keep this method
    function get_formatted_error() {
        $str_formatted_error = "<span class='sprompt'>{$this->str_error}({$this->error})</span>";
        return $str_formatted_error;
    }

    /**
     * checks user's if user has insert permission to the table specified
     */
    function sql_query($str_sql) {
        $log_id = 0;
        

        if (!$this->connect()) {
            return false;
        }
        
        $this->result = mysql_query($str_sql);
        if (!$this->result) {
            $log_id = $this->log_error(LOG_LEVEL_DB_FAIL, 4, "could not query database in {$this->src}::sql_query() :", mysql_error($this->link));
            return false;
        }

        return true;
    }

    function free_result() {
        if (!$this->result) {
            return;
        }
        mysql_free_result($this->result);
    }

    function get_num_rows() {
        return mysql_num_rows($this->result);
    }

    function get_insert_id() {
        return mysql_insert_id($this->link);
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
