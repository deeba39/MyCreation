<?php
include_once("adb.php");
class programareas extends adb{
    function programareas(){
        adb::adb();
        $this->er_code_prefix=2400;     //error prefix for this class is 25
        $this->src="payments";
    }
   
    function get_programarea($programarea_id){
        $str_query="SELECT programarea_id,programarea_name from programarea";

        if(!$this->sql_query($str_query))
        {
            $this->error=$this->log_error(LOG_LEVEL_DB_FAIL, 14, "error while getting program area identfied $programarea_id. see {$this->error} for detail");
            return false;
        }

        $row=$this->fetch();
        if(!$row){
             $this->error=$this->log_error(LOG_LEVEL_DB_FAIL, 14, "error error fetching program area identified by $programarea_id.");
            return false;
        }
        return $row;
    }
    function get_programareas($region=false,$district=false){
        $str_query="SELECT programarea_id,programarea_name from programarea";

        if(!$this->sql_query($str_query))
        {
            $this->error=$this->log_error(LOG_LEVEL_DB_FAIL, 14, "error while getting all program areas. see {$this->error} for detail");
            return false;
        }
        return true;
    }
	
	function get_user_program_area($username){
            $str_query="SELECT programarea_programarea_id FROM users WHERE username='$username'";
            echo $str_query;
            if(!$this->sql_query($str_query))
            {
                $this->error=$this->log_error(LOG_LEVEL_DB_FAIL, 14, "error while getting programe area id for user $id. see {$this->error} for detail");
                return false;
            }

                    $row=$this->fetch();
                    if(!$row){
                            return false;
                    }
            return $row[programarea_programarea_id];
	}

    function can_delete_programarea($programarea_id){
            $str_query="select count(*) REC_COUNT from community WHERE programarea_programarea_id=$programarea_id";
             if(!$this->sql_query($str_query)){
                $this->log_error(LOG_LEVEL_DB_FAIL, 14, "error while verifing if program area/unit can be deleted. see {$this->error} for detail");
                return -1;
             }

            $row=$this->fetch();
            if(!$row)
            {
                $this->log_error(LOG_LEVEL_DB_FAIL, 14, "could not fetch row while trying to verify if program area/unit can be deleted.");
                return -2;

            }

            if($row['REC_COUNT']>0){
                return $row['REC_COUNT'];
            }

            return 0;
        }
    function get_districts($programarea_id=false) {
        $programarea = "1=1";
        if ($programarea_id) {
            $programarea = "programarea_programarea_id=$programarea_id";
        }
        $str_query = "SELECT `DistrictID`, `District`, `programarea_programarea_id` FROM districts where $programarea";

        if (!$this->sql_query($str_query)) {
            $this->error = $this->log_error(LOG_LEVEL_DB_FAIL, 14, "error while getting districts for pogramarea $programarea_id. see {$this->error} for detail");
            return false;
        }
        return true;
    }
    function get_district($district_id) {

        $str_query = "SELECT `DistrictID`, `District`, `programarea_programarea_id` FROM districts where DistrictID=$district_id";

        if (!$this->sql_query($str_query)) {
            $this->error = $this->log_error(LOG_LEVEL_DB_FAIL, 14, "error while getting district $district_id. see {$this->error} for detail");
            return false;
        }
        return $this->fetch();
    }
    function get_communities($district_id=false) {
        $district = "1=1";
        if ($district_id) {
            $district = "community_districts_DistrictID=$district_id";
        }
        $str_query = "SELECT`community_id`, `community`, `community_districts_DistrictID`,
        `programarea_programarea_id`, `community_category_community_category_id` FROM community where $district";

        if (!$this->sql_query($str_query)) {
            $this->error = $this->log_error(LOG_LEVEL_DB_FAIL, 14, "error while getting districts for pogramarea $district_id. see {$this->error} for detail");
            return false;
        }
        return true;
    }

    function get_community($community_id=false) {

        $str_query = "SELECT`community_id`, `community`, `community_districts_DistrictID`,
        `programarea_programarea_id`, `community_category_community_category_id` FROM community_id=$community_id";

        if (!$this->sql_query($str_query)) {
            $this->error = $this->log_error(LOG_LEVEL_DB_FAIL, 14, "error while getting community $community_id. see {$this->error} for detail");
            return false;
        }
        return true;
    }

    function add_community($community_name,$district_id,$community_category){
        $row=$this->get_district($district_id);
        if(!$row){
            return false;
        }
        $str_query="insert into community(`community`, `community_districts_DistrictID`,
        `programarea_programarea_id`,
        `community_category_community_category_id`)
        values('$community_name',$district_id,{$row['programarea_programarea_id']},$community_category)";
        if(!$this->sql_query($str_query)){
            return false;
        }

        return $this->get_insert_id();
    }
}
?>


