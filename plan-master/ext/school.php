<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once("adb.php");
class school extends adb{
    function school(){
        adb::adb();
        $this->er_code_prefix=ER_SCHOOLS;     //error prefix for this class is 23//dont no yet
        $this->src="payments";
    }
	function add($school_name,$towncity,$address,$community_community_id){

       $str_query="INSERT INTO schools SET
                    community_community_id=$community_community_id,
					address='$address',
                    school_name='$school_name',
										towncity='$towncity'";
       //print_r($str_query);
       
        if(!$this->sql_query($str_query)){
            $this->log_error(LOG_LEVEL_DB_FAIL, 11, "error while adding school. see {$this->error} for detail");
            return false;
        }
        return $this->get_insert_id();
    }
    function add_sss($school_name,$towncity,$address,$programarea_programarea_id,$community_community_id){

       $str_query="INSERT INTO schools SET
                    community_community_id=$community_community_id,
					programarea_programarea_id=$programarea_programarea_id,
					address='$address',
                    school_name='$school_name',
										towncity='$towncity',
					school_type='SSS'";
       //echo($str_query);
       
        if(!$this->sql_query($str_query)){
            $this->log_error(LOG_LEVEL_DB_FAIL, 11, "error while adding school. see {$this->error} for detail");
            return false;
        }
        return $this->get_insert_id();
    }

    function add_primary_school($school_name,$category){
        $str_query="INSERT INTO applicant_school(applicant_school_name,applicant_school_type,applicant_school_category_applicant_school_category_id)
                    values('$school_name',1,$category)";
        if(!$this->sql_query($str_query)){
            $this->log_error(LOG_LEVEL_DB_FAIL, 11, "error while adding school. see {$this->error} for detail");
            return false;
        }
        return $this->get_insert_id();
    }

    function add_jss_school($school_name,$category){
        $str_query="INSERT INTO applicant_school(applicant_school_name,applicant_school_type,applicant_school_category_applicant_school_category_id)
                    values('$school_name',2,$category)";
        if(!$this->sql_query($str_query)){
            $this->log_error(LOG_LEVEL_DB_FAIL, 11, "error while adding school. see {$this->error} for detail");
            return false;
        }
        return $this->get_insert_id();
    }

		
    
    function get_school($school_id){
        //get record by id
       $str_query="SELECT `school_id`, `community_community_id`,`address`, `school_name`, `towncity`
        FROM schools
        WHERE school_id=$school_id";

        if(!$this->sql_query($str_query)){
            $this->log_error(LOG_LEVEL_DB_FAIL, 14, "error while getting school $school_id. see {$this->error} for detail");
            return false;
        }
        $row=$this->fetch();
        if(!$row){
            $this->log_error(LOG_LEVEL_DB_FAIL, 15, "error while fetching schoool $school_id.");
            return false;
        }
        return $row;
    }

    
    function get_schools(){
         //get all schools for list school page
       $str_query="SELECT `school_id`, `address`,`school_name`, `towncity`
        FROM schools ORDER BY school_name";

        if(!$this->sql_query($str_query)){
            $this->log_error(LOG_LEVEL_DB_FAIL, 14, "error while getting school. see {$this->error} for detail");
            return false;
        }
        
        return true;
    }

    function get_schools_sorted($region=false, $district=false, $programarea_programarea_id){
        //get schools sorted by region, district in alphabetical order
				//will work on
        $order_condition=" ";
        if($programarea!=false)
        {
           $order_condition="";
        }
        $str_query="SELECT `school_id`, `community_community_id`,`address`, `school_name`, `towncity`
        						FROM schools
                    $order_condition";

        if(!$this->sql_query($str_query)){
            $this->log_error(LOG_LEVEL_DB_FAIL, 16, "error while getting sorted schools. see {$this->error} for detail");
            return false;
        }

        return true;
    }
    function get_jss_school($id){
        $str_query="select applicant_school_name,applicant_school_type,applicant_school_category_applicant_school_category_id from applicant_school where applicant_school_id=$id";
         if(!$this->sql_query($str_query)){
            $this->log_error(LOG_LEVEL_DB_FAIL, 14, "error while getting school. see {$this->error} for detail");
            return false;
        }

        return $this->fetch();
    }
	function get_jss_schools(){
        $str_query="select applicant_school_id,applicant_school_name,applicant_school_type,applicant_school_category_applicant_school_category_id from applicant_school where applicant_school_type=2 order by applicant_school_name ";
         if(!$this->sql_query($str_query)){
            $this->log_error(LOG_LEVEL_DB_FAIL, 14, "error while getting school. see {$this->error} for detail");
            return false;
        }

        return $this->fetch();
    }

    function can_delete_school($school_id){
         $str_query="SELECT count(*) as REC_COUNT FROM school_attendance where schools_school_id=$school_id";
         if(!$this->sql_query($str_query)){
            $this->log_error(LOG_LEVEL_DB_FAIL, 14, "error while verifing if school can be deleted. see {$this->error} for detail");
            return -1;
        }

        $row=$this->fetch();
        if(!$row)
        {
            $this->log_error(LOG_LEVEL_DB_FAIL, 14, "could not fetch row while trying to verify if school can be deleted.");
            return -2;
            
        }

        if($row['REC_COUNT']>0){
            return $row['REC_COUNT'];
        }

        return 0;
    }

	
	
}
?>

