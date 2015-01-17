<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once("rep.php");
class applicants extends rep{
    function applicants(){
        //db::db();
        rep::rep();
        $this->er_code_prefix=ER_APPLICANTS;     //error prefix for this class is 23
        $this->src="payments";
    }
    function get_applicant($student_applicant_id){
        //get record by id
       $str_query="SELECT s.`app_submission_year`,s.`student_applicant_id`, s.`student_firstname`, s.`student_middlename`, s.`student_lastname`,
        s.`app_scanneddocument`, s.`app_mother_name`, s.`app_mother_isalive`, s.`app_mother_occupation`, s.`app_father_name`,
        s.`app_father_occupation`, s.`app_father_isalive`, s.`student_picture`, s.`student_grades`, s.`app_points`, s.`app_referees`,
        s.`app_guardian_name`, s.`app_guardian_relation`, s.`app_guardian_occupation`,
        s.`app_primary_school_id`, s.`app_junior_secondary_id`, s.`student_address`,
        s.`student_telephone_1`, s.`student_telephone_2`, s.`student_resident_programarea_id`, s.`student_admitted_school_id`,
        s.`student_gender`, s.`student_dob`,s.`community_community_id`,sh.`school_name`, p.`programarea_name`,
        c.`community`,cc.`community_category_name`, cc.`community_category_app_point`,
	a.`applicant_school_name` as `applicant_jounior_secondary_name`, ac.`applicant_school_category_app_point`, ac.`applicant_school_category_name`
        FROM student_applicant s left join schools sh on s.`student_admitted_school_id`=sh.`school_id`
        left join programarea p on s.`student_resident_programarea_id`=p.`programarea_id`
        left join community c on s.`community_community_id`=c.`community_id`
        left join community_category cc ON community_category_community_category_id=community_category_id
	      left join applicant_school a on s.`app_junior_secondary_id`=a.`applicant_school_id`
        left join `applicant_school_category` ac on `applicant_school_category_applicant_school_category_id`=`applicant_school_category_id`
        WHERE student_applicant_id=$student_applicant_id";

        if(!$this->sql_query($str_query)){
            $this->log_error(LOG_LEVEL_DB_FAIL, 14, "error while getting applicant $student_applicant_id. see {$this->error} for detail");
            return false;
        }
        $row=$this->fetch();
        if(!$row){
            $this->log_error(LOG_LEVEL_DB_FAIL, 15, "error while fetching applicant $student_applicant_id.");
            return false;
        }
        return $row;
    }
    function upload_photo($student_applicant_id,$temp_file){
        //upload the picture to db from temp upload file path

        if(filesize($temp_file)>65000){
            $this->log_error(LOG_LEVEL_DB_FAIL,17,"phofo uploaded for $student_applicant_id is too big");
            return false;
        }
        $fp=fopen($temp_file);
        if(!$fp){
            $this->log_error(LOG_LEVEL_DB_FAIL,17,"error while reading photo file for $student_applicant_id, temp file=$temp_file");
            return false;
        }


        $content=fread($fp,filesize($temp_file));
        $sql_query="INSERT INTO picture SET student_applicant_id=$student_applicant_id, picture=$content";
        if(!mysql_query($sql_query))
        {
            $this->log_error(LOG_LEVEL_DB_FAIL,17,"error while writing photo data to db for $student_applicant_id, temp file=$temp_file");
            return false;
        }

        return true;
    }

    function get_photo($student_applicant_id){
        //get applicant photo from db and return binary array
        $str_query="select picture from picture where student_applicant_id=$student_applicant_id";
        if($this->sql_query($str_query))
        {
            $this->log_error(LOG_LEVEL_DB_FAIL,17,"error while reading photo data for $student_applicant_id. see {$this->error} for detail");
            return false;
        }

        $row=$this->fetch();
        if(!$row){
            $this->log_error(LOG_LEVEL_DB_FAIL,17,"error while fetching picture data for $student_applicant_id");
            return false;
        }
        return $row['picture'];
    }
    function get_applicants_for_letter($programarea,$academic_year){
        //return applicants based on given parameter
        $condition="";


        $str_query="SELECT s.`student_applicant_id`, s.`student_firstname`, s.`student_middlename`, s.`student_lastname`, s.`student_dob`,
                    s.`student_gender`, s.`student_resident_programarea_id`, s.`student_admitted_school_id`, s.`app_points`,sh.`school_name`,
                    s.`app_grant_id`,s.`app_amount`,s.`student_address`,g.`name`,g.`code`,p.programarea_name,c.community,d.District,r.Region
                    FROM student_applicant s left join schools sh on s.`student_admitted_school_id`=sh.`school_id`
                    left join programarea p on s.`student_resident_programarea_id`=p.`programarea_id`
                    left join community c on s.`community_community_id`=c.`community_id`
                    left join districts d on c.`community_districts_DistrictID`=d.`DistrictID`
                    left join regions r on d.`RegionID`=r.`RegionID`
                    left join grant_package g on s.`app_grant_id`=g.`grant_package_id`
                    WHERE s.`app_status`>=1 AND s.`app_submission_year`=$academic_year AND s.`student_resident_programarea_id`=$programarea ORDER BY app_points DESC";


        if(!$this->sql_query($str_query)){
            $this->log_error(LOG_LEVEL_DB_FAIL, 16, "error while getting applicants . see {$this->error} for detail");
            return false;
        }

        return true;
    }
	
    function get_applicants_for_review($programarea,$academic_year,$no_limit=false){
        //return applicants based on given parameter
        
		$condition="";
			

        $str_query="SELECT s.`student_applicant_id`, s.`student_firstname`, s.`student_middlename`, s.`student_lastname`, s.`student_dob`,
                    s.`student_gender`, s.`student_resident_programarea_id`, s.`student_admitted_school_id`, s.`app_points`,sh.`school_name`,
                    s.`app_grant_id`,s.`app_amount`,g.`name`,g.`code`,p.programarea_name,c.community,d.District,r.Region
                    FROM student_applicant s left join schools sh on s.`student_admitted_school_id`=sh.`school_id`
                    left join programarea p on s.`student_resident_programarea_id`=p.`programarea_id`
                    left join community c on s.`community_community_id`=c.`community_id`
                    left join districts d on c.`community_districts_DistrictID`=d.`DistrictID`
                    left join regions r on d.`RegionID`=r.`RegionID`
                    left join grant_package g on s.`app_grant_id`=g.`grant_package_id`
                    WHERE s.`app_status`=0 and s.`app_submission_year`=$academic_year AND s.`student_resident_programarea_id`=$programarea ORDER BY app_points DESC";


		
        if($no_limit){
            $r=$this->sql_query($str_query);
        }
        else{
            $r=$this->init_query($str_query);
        }



        if(!$r){
            $this->log_error(LOG_LEVEL_DB_FAIL, 16, "error while getting applicants . see {$this->error} for detail");
            return false;
        }

        return true;
    }
	
	function get_applicants_for_pdf($programarea,$academic_year,$no_limit=false){
        //return applicants based on given parameter
        
		$condition="";
			

        $str_query="SELECT s.`student_applicant_id`, s.`student_firstname`, s.`student_middlename`, s.`student_lastname`, s.`student_dob`,
                    s.`student_gender`, s.`student_resident_programarea_id`, s.`student_admitted_school_id`, s.`app_points`,sh.`school_name`,
                    s.`app_grant_id`,s.`app_amount`,g.`name`,g.`code`,p.programarea_name,c.community,d.District,r.Region
                    FROM student_applicant s left join schools sh on s.`student_admitted_school_id`=sh.`school_id`
                    left join programarea p on s.`student_resident_programarea_id`=p.`programarea_id`
                    left join community c on s.`community_community_id`=c.`community_id`
                    left join districts d on c.`community_districts_DistrictID`=d.`DistrictID`
                    left join regions r on d.`RegionID`=r.`RegionID`
                    left join grant_package g on s.`app_grant_id`=g.`grant_package_id`
                    WHERE s.`app_status`=0 and s.`app_submission_year`=$academic_year AND s.`student_resident_programarea_id`=$programarea ORDER BY app_points DESC";


		
        if($no_limit){
            $r=$this->sql_query($str_query);
        }
        else{
            $r=$this->init_query($str_query);
        }



        if(!$r){
            $this->log_error(LOG_LEVEL_DB_FAIL, 16, "error while getting applicants . see {$this->error} for detail");
            return false;
        }

        return true;
    }
    function get_grant_amount($grant_id){
        $str_query="SELECT  `annual_amount` FROM grant_package WHERE grant_package_id=$grant_id";
        if(!$this->sql_query($str_query)){
            $this->error=$this->log_error(LOG_LEVEL_DB_FAIL,11,"error while getting all grant packages. see error {$this->error} for details.");
            return false;
        }

        $row=$this->fetch();
        if(!$row){
            return 0;
        }

        return $row['annual_amount'];

    }
    function award_applicant_scholarship($applicant_id,$grant_id){
        $amount=$this->get_grant_amount($grant_id);
        $str_query="UPDATE student_applicant SET app_grant_id=$grant_id, app_amount=$amount, app_status=1 WHERE student_applicant_id=$applicant_id";

        //echo $str_query;
        if(!$this->sql_query($str_query)){
            $this->log_error(LOG_LEVEL_DB_FAIL, 16, "error while awarding scholarship . see {$this->error} for detail");
            return false;
        }
        return true;
    }

    function cancel_applicant_scholarship($applicant_id){
        $str_query="UPDATE student_applicant SET app_grant_id=0, app_amount=0,app_status=0 WHERE student_applicant_id=$applicant_id";

        //echo $str_query;
        if(!$this->sql_query($str_query)){
            $this->log_error(LOG_LEVEL_DB_FAIL, 16, "error while awarding scholarship . see {$this->error} for detail");
            return false;
        }
        return true;
    }
    
    function confirm_applicant_scholarship($student_applicant_id,$scholarship_start_date,$scholarship_end_date,$school_id,
            $school_start_date,$school_end_date,$entry_class,$entry_level,$attendance,$program){

         $str_query= "SELECT confirm_applicant($student_applicant_id,'$scholarship_start_date','$scholarship_end_date',
                        $school_id,'$school_start_date','$school_end_date',$entry_class,'$entry_level',$attendance,'$program') AS R";
		 //echo $str_query;
         if(!$this->sql_query($str_query)){
            $this->log_error(LOG_LEVEL_DB_FAIL, 16, "error while getting application record for $student_applicant_id for confirmation. see {$this->error} for detail");
            return false;
         }
         $row=$this->fetch();
         if(!$row){
             $this->log_error(LOG_LEVEL_DB_FAIL, 16, "error while fetching application record for $student_applicant_id for confirmation. see {$this->error} for detail");
             return false;
         }
         
         if($row['R']==0){
             $this->log_error(LOG_LEVEL_DB_FAIL, 16, "db function call return error while confirming $student_applicant_id. see log for detail");
             return false;
         }
         

        return true;
    }

	function get_occupation_point($id){
		$str_query="SELECT a.`app_point` FROM application_occupation a WHERE application_occupation_id=$id";
		if(!$this->sql_query($str_query)){
			$this->log_error(LOG_LEVEL_DB_FAIL, 16, "error while getting occupation point for $id. see {$this->error} for detail");
            return false;
		}
		
		$row=$this->fetch();
		if(!$row){
			$this->log_error(LOG_LEVEL_DB_FAIL, 16, "error while fetch occupation point for $id. see {$this->error} for detail");
            return false;
		}
		return $row['app_point'];
	}
	function get_grade_point($grade){
            $str_query="SELECT grade_point FROM selection_grade_point where min_grade<=$grade and $grade<=max_grade;";
            if(!$this->sql_query($str_query)){
                    $this->log_error(LOG_LEVEL_DB_FAIL, 16, "error while getting occupation point for $id. see {$this->error} for detail");
                return false;
            }
            
            $row=$this->fetch();
            if(!$row){
                    $this->log_error(LOG_LEVEL_DB_FAIL, 16, "error while fetch grade point for $grade. see {$this->error} for detail");
                    return false;
            }
            return $row['grade_point'];
	}
	
	function get_school_point($id){
		$str_query="SELECT `applicant_school_category_app_point` FROM `applicant_school` LEFT JOIN `applicant_school_category`
                on `applicant_school_category_applicant_school_category_id`=`applicant_school_category_id` where applicant_school_id=$id";
		if(!$this->sql_query($str_query)){
			$this->log_error(LOG_LEVEL_DB_FAIL, 16, "error while getting school point for $id. see {$this->error} for detail");
            return false;
		}
		
		$row=$this->fetch();
		if(!$row){
			$this->log_error(LOG_LEVEL_DB_FAIL, 16, "error while fetch school point for $id. see {$this->error} for detail");
            return false;
		}
		return $row['applicant_school_category_app_point'];
	}
	
	function get_community_point($id){
		$str_query="SELECT community_id,community_category_app_point  FROM community c
                        LEFT JOIN community_category ON community_category_community_category_id=community_category_id
                        where community_id=$id";
		
		if(!$this->sql_query($str_query)){
			$this->log_error(LOG_LEVEL_DB_FAIL, 16, "error while getting school point for $id. see {$this->error} for detail");
            return false;
		}
	
		$row=$this->fetch();
		
		if(!$row){
			$this->log_error(LOG_LEVEL_DB_FAIL, 16, "error while fetch school point for $id. see {$this->error} for detail");
            return false;
		}
		
		return $row['community_category_app_point'];
	}
	
    function assign_applicant_point($father_occupation, $mother_occupation,$gurdian_occupation, $grade,$jss_school_id,$community_id){
		//get points awarded to each parent/guardian occuptation
        $father_occupation_point=$this->get_occupation_point($father_occupation);
        $mother_occupation_point=$this->get_occupation_point($mother_occupation);
        $gurdian_occupation_point=$this->get_occupation_point($gurdian_occupation);
	$school_point=$this->get_school_point($jss_school_id);
	$community_point=$this->get_community_point($community_id);
		
        $grade_point=$this->get_grade_point($grade);
		
        //select the minimum occupation point
        //the selection is based on one of the parents who is well to do
        $arr=array($father_occupation_point,$mother_occupation_point,$gurdian_occupation_point);

        $arr2=array();
        $j=0;
        for($i=0;$i<3;$i++){
                if($arr[$i]!=0){
                        $arr2[$j]=$arr[$i];
                        $j++;
                }
        }
        print_r($arr2);
        $point=max($arr2);
	echo "$point $grade_point $school_point $community_point";
        return $point+$grade_point+$school_point+$community_point;

    }

    function get_years(){
        $str_query="select app_year,active from academic_year order by app_year desc";
        if(!$this->sql_query($str_query)){
            $this->log_error(LOG_LEVEL_DB_FAIL, 16, "error while getting applicatin years . see {$this->error} for detail");
            return false;
        }
        
        return true;
    }
    function get_admission_year(){
        $str_query="select app_year,active from academic_year where active='ADMISSION' order by app_year desc";
        if(!$this->sql_query($str_query)){
            $this->log_error(LOG_LEVEL_DB_FAIL, 16, "error while getting applicatin years . see {$this->error} for detail");
            return false;
        }
        
		$row=$this->fetch();
		if(!$row){
			return false;
		}
		
        return $row["app_year"];
    }

    function get_grade_record_year(){
        $str_query="select app_year,active from academic_year where active='ADMISSION' OR active='GRADE_RECORDING' order by app_year desc";
        if(!$this->sql_query($str_query)){
            $this->log_error(LOG_LEVEL_DB_FAIL, 16, "error while getting applicatin years . see {$this->error} for detail");
            return false;
        }

        $row=$this->fetch();
        if(!$row){
                return false;
        }
		
        return $row["app_year"];
    }

    function update_promote($grade_year_id,$promoted){
        
        $str_query="UPDATE grade_year SET promoted=$promoted WHERE grade_year_id=$grade_year_id";
        if(!$this->sql_query($str_query)){
            return false;
        }
        return true;
    }
    function set_promote($attendance_id,$academic_year,$promoted){
        $attendance=$this->get_attendace($attendance_id);
        if(!$attendance){
            return false;
        }

        $sql_query="INSERT INTO grade_year SET 
                class=1,
                year=$academic_year,
                promoted=$promoted,
                programme='{$attendance['program']}',
                school_attendance_school_attendance_id=$attendance_id";

        if(!$this->sql_query($sql_query)){
            return false;
        }

        return true;

    }
    function get_attendace($attendace_id){
        $str_query="SELECT s.`program`, s.`entry_class` FROM school_attendance s WHERE school_attendance_id=$attendace_id";
        if(!$this->sql_query($str_query)){
            $this->log_error(LOG_LEVEL_DB_FAIL, 16, "error while attenace recoard . see {$this->error} for detail");
            return false;
        }

        $row=$this->fetch();
        if(!$row){
                return false;
        }
        return $row;
    }



}

/*$obj=new applicants();
$rs=$obj->get_applicant(5);

$point=$obj->assign_applicant_point(
        $rs["app_father_occupation"],
        $rs["app_father_occupation"],
        $rs["app_guardian_occupation"],
        $rs["student_grades"],
        $rs["app_junior_secondary_id"],
        $rs["community_community_id"]
        );
*/
?>
