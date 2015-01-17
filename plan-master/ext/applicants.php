<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once("rep.php");
define("APPLICAITON_STATUS_NEW_APPLICANT",0);
define("APPLICAITON_STATUS_AWARDED",1);
define("APPLICAITON_STATUS_CONFIRMED",2);

class applicants extends rep{
    var $count=0;
    function applicants(){
        //db::db();
        rep::rep();
        $this->er_code_prefix=ER_APPLICANTS;     //error prefix for this class is 23
        $this->src="applicants";
    }
    
    function get_applicant($student_applicant_id){
        //get record by id
       $str_query="SELECT * from view_student_applicants
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
    
    function get_applicants($filter,$order="",$page=0,$limit=0){
        $str_limit_clause="";
        if($limit!=0){
            $offset=($page-1)*$limit;
            $str_limit_clause="limit $offset,$limit";
        }
       $this->count=$this->get_applicants_count($filter);
       
       
       $str_query="SELECT * from view_student_applicants
        WHERE $filter order by $order $str_limit_clause ";
       
     
       //echo $str_query;
       if(!$this->sql_query($str_query)){
            $this->log_error(LOG_LEVEL_DB_FAIL, 14, "error while getting applicants count with $filter. see {$this->error}");
            return false;
        }
       
        return true;
    }
    
    function get_applicants_count($filter){
       
        
       $str_query="SELECT count(*) as no_rec from view_student_applicants
        WHERE $filter ";

        if(!$this->sql_query($str_query)){
            $this->error=$this->log_error(LOG_LEVEL_DB_FAIL, 14, "error while getting applicants count with $filter. see {$this->error}");
            return false;
        }
        
        $row=$this->fetch();
        return $row['no_rec'];
    }

    function get_applicants_programarea_sponsored($programarea_id=0,$academic_year=0,$school_id=0,$status=0,$search_text="0",$sponsored=true,$order=0,$page=0,$limit=0){
        $filter="1";
        if($programarea_id!=0){
            $filter="programarea_id=$programarea_id ";
        }
        if($academic_year!=0){
            $filter.=" AND app_submission_year=$academic_year ";
        }
        
        if($status!=0){
            $status=$status-1; //status start from 0
            $filter.=" AND app_status=$status ";
        }
        
        if($school_id!=0){
            $filter.=" AND student_admitted_school_id=$status ";
        }

        if($search_text!="0"){
            $filter.=" and (`student_firstname` like '%$search_text%' or `student_lastname` like '%$search_text%')";
        }
        if($sponsored==true){
            $filter.=" and sponsored_child_no!='NA' ";
        }else{
            $filter.=" and sponsored_child_no='NA' ";
        }
        if($order==0){
            $orderBy=" programarea_name,community,student_lastname";
        }elseif($order==1){
            $orderBy=" app_points desc";
        }elseif($order==2){
            $orderBy=" app_points asc";
        }else{
            $orderBy=" programarea_name,community,student_lastname";
        }
        
        return $this->get_applicants($filter,$orderBy,$page,$limit);
    }
    
    function get_applicants_programarea($programarea_id=0,$academic_year=0,$school_id=0,$status=0,$search_text="0",$order=0,$page=0,$limit=0){
        $filter="1";
        if($programarea_id!=0){
            $filter="programarea_id=$programarea_id ";
        }
        if($academic_year!=0){
            $filter.=" AND app_submission_year=$academic_year ";
        }
        
        if($status!=0){
            $status=$status-1; //status start from 0
            $filter.=" AND app_status=$status ";
        }
        
        if($school_id!=0){
            $filter.=" AND student_admitted_school_id=$status ";
        }

        if($search_text!="0"){
            $filter.=" and (`student_firstname` like '%$search_text%' or `student_lastname` like '%$search_text%')";
        }
        if($order==0){
            $orderBy=" programarea_name,community,student_lastname";
        }elseif($order==1){
            $orderBy=" app_points desc";
        }elseif($order==2){
            $orderBy=" app_points asc";
        }else{
            $orderBy=" programarea_name,community,student_lastname";
        }
        
        return $this->get_applicants($filter,$orderBy,$page,$limit);
    }
    
    function get_applicants_district($district_id,$year){
        $filter="1";
        if($programarea!=0){
            $filter="d.`DistrictID=$district_id";
        }
        if($academic_year!=0){
            $filter.=" AND app_submission_year=$year";
        }
        
        if($status!=0){
            $filter.=" AND app_status=$status ";
        }
        
        if($school_id!=0){
            $filter.=" AND student_admitted_school_id=$status ";
        }
        return get_applicants($filter);
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
        $year=$this->get_admission_year();
        $obj=$this->get_applicant($applicant_id);
        
        if($obj['app_status']!=0){
            $this->log_error(LOG_LEVEL_SUCCESS_LOW, 16, "error while awarding scholarship to $applicant_id. Current status is {$obj['app_status']}.");
            return false;
        }
        
        //application submited during the admission year are allowed to be submitted
        if($year!=$obj['app_submission_year']){
            $this->log_error(LOG_LEVEL_SUCCESS_LOW, 18, "error while awarding scholarship to $applicant_id. Applicants year is {$obj['app_submission_year']} while admission year is $year.");
            $this->str_error="You can only award application from $year.";
            return false;
        }
        
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
        $obj=$this->get_applicant($applicant_id);
        if($obj['app_status']!=1){
            $this->log_error(LOG_LEVEL_SUCCESS_LOW, 16, "error while awarding scholarship to $applicant_id. Current status is {$obj['app_status']}.");
            return false;
        }
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
	
    function get_parent_status_points($father_alive,$mother_alive){
        $parent_status=0;   //assume they are alive
        if(!$father_alive){
            $parent_status+=10; //add 10 if one is not alive
        }
        if(!$mother_alive){
            $parent_status+=10; //add 10 if one is not alive
        }
        return $parent_status;
    }
    
    function assign_applicant_point($father_occupation, $mother_occupation,$gurdian_occupation, $grade,$jss_school_id,$community_id,$father_alive=0,$mother_alive=0){
		//get points awarded to each parent/guardian occuptation
        $father_occupation_point=(int)$this->get_occupation_point($father_occupation);
        $mother_occupation_point=(int)$this->get_occupation_point($mother_occupation);
        $gurdian_occupation_point=(int)$this->get_occupation_point($gurdian_occupation);
	$school_point=$this->get_school_point($jss_school_id);
	$community_point=$this->get_community_point($community_id);
		
        $grade_point=$this->get_grade_point($grade);
	$parent_status=$this->get_parent_status_points($father_alive, $mother_alive);
        //select the minimum occupation point
        //the selection is based on one of the parents who is well to do
        $arr=array($father_occupation_point,$mother_occupation_point,$gurdian_occupation_point);
 
        /*$arr2=array();
        $j=0;
        for($i=0;$i<3;$i++){
                if($arr[$i]!=0){
                        $arr2[$j]=$arr[$i];
                        $j++;
                }
        }*/

        $point=max($arr);

        return $point+$grade_point+$school_point+$community_point+$parent_status;

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
        $str_query="select app_year,active from academic_year where active='GRADE_RECORDING' order by app_year desc";
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

    function set_promote($attendance_id,$academic_year,$promoted,$grade_year_id,$english,$math){

        $sql_query="SELECT promote_student($academic_year,$attendance_id,$promoted,$grade_year_id,'$english','$math') as grade_year_id";

        if(!$this->sql_query($sql_query)){
            return false;
        }

        $row=$this->fetch();
        
        if(!$row)
        {
            return false;
        }
       
        if($row['grade_year_id']<=0){
            return false;
        }

        $sql_query="select grade_year_id, `year`, promoted, school_attendance_school_attendance_id,class,programme,english,math  from grade_year where grade_year_id={$row['grade_year_id']}";
      
        if(!$this->sql_query($sql_query)){
            return false;
        }

        return $this->fetch();
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

    function submit_payment_request($preq_id){
        $sql_query="UPDATE payment_request SET request_status='REQUESTED' WHERE payment_request_id=$preq_id";
        if(!$this->sql_query($sql_query)){
            return false;
        }
        return true;
    }

    function add_applicant($programarea_id,$year,$firstname,$lastname,$middlename,$gender,$birthdate,
            $community_id,$mother_name,$mother_alive,$mother_ocupation,
            $father_name,$father_alive,$father_occupation,$gurdian_name,$gurdian_relation,$gurdian_occupation,
            $app_referees,$student_grades,
            $address,$telephone1,$telephone2,$jss_school_id,$school_admitted_to,$sponsored_child_no
            ){
        $address=  clean_str($address);
        $lastname= clean_str($lastname);
        $firstname=clean_str($firstname);
        $middlename=clean_str($middlename);
        $gurdian_name=clean_str($gurdian_name);
        $app_referees=clean_str($app_referees);
        
        $str_query="insert into student_applicant set
                `student_resident_programarea_id`=$programarea_id,
                `app_submission_year`=$year,
                `student_firstname`='$firstname',
                `student_lastname`='$lastname',";
                if(!$middlename){
                    $str_query.="`student_middlename`=null,";
                }else{    
                    $str_query.="`student_middlename`='$middlename',";
                }
                $str_query.="`student_gender`='$gender',
                `student_dob`='$birthdate',
                `community_community_id`=$community_id,
                `app_mother_name`='$mother_name',
                `app_mother_isalive`='$mother_alive',
                `app_mother_occupation`=$mother_ocupation,
                `app_father_name`='$father_name',
                `app_father_isalive`=$father_alive,
                `app_father_occupation`=$father_occupation,"; 
                 if(!$gurdian_name or count($gurdian_name)==0){
                     $str_query.="`app_guardian_name`='NA',";
                 }else{
                     $str_query.="`app_guardian_name`='$gurdian_name',";
                 }   
                
                $str_query.="`app_guardian_relation`='$gurdian_relation',
                `app_guardian_occupation`=$gurdian_occupation,
                `app_referees`='$app_referees',
                `student_grades`=$student_grades,
                `student_address`='$address',
                `student_telephone_1`='$telephone1',";
                 if(!$telephone2 or count($telephone2)==0){
                     $str_query.="`student_telephone_2`='none',";
                 }else{
                      $str_query.="`student_telephone_2`='$telephone2',";
                 }   
                $str_query.="`student_admitted_school_id`=$school_admitted_to,
                `app_junior_secondary_id`=$jss_school_id,
                `sponsored_child_no`='$sponsored_child_no',    
                `app_primary_school_id`=0,
                `app_amount`=0,
                `app_status`=" .APPLICAITON_STATUS_NEW_APPLICANT .",";
                $point=$this->assign_applicant_point($mother_ocupation,$father_occupation,$gurdian_occupation,$student_grades,$jss_school_id,$community_id);
                $str_query.="`app_points`=$point";
        
        if(!$this->sql_query($str_query)){
            return false;
        }
  
        return $this->get_insert_id();
    }
    
    /**
     * addes or replaces students relation with prudential banck
     * @param type $student_applicant_id
     * @param type $relation
     * @return boolean
     */
    function add_prudential_relation($student_applicant_id,$relation){
        $str_query="replace into `prudential_relations` set 
                        student_applicant_id=$student_applicant_id,
                        relation='$relation' ";
        
        if(!$this->sql_query($str_query)){
            return false;
        }
        return true;
    }
    
    /**
     * remove students relation with prudential bank
     * @param type $student_applicant_id
     * @param type $relation
     * @return boolean
     */
    function remove_prudential_relation($student_applicant_id){
        $str_query="delete from `prudential_relations`  where student_applicant_id=$student_applicant_id";
        
        if(!$this->sql_query($str_query)){
            return false;
        }
        return true;
    }
    
    function set_address($student_applicant_id,$address){
        $str_query="update student_applicant set student_address='$address' where student_applicant_id=$student_applicant_id";
        if(!$this->sql_query($str_query)){
            return false;
        }
        return true;
    }
    
    /**
     * This function is used to update new applicants before confirmation
     * @param type $id
     * @param type $programarea_id
     * @param type $firstname
     * @param type $lastname
     * @param type $middlename
     * @param type $gender
     * @param type $birthdate
     * @param type $community_id
     * @param type $mother_name
     * @param type $mother_alive
     * @param type $mother_ocupation
     * @param type $father_name
     * @param type $father_alive
     * @param type $father_occupation
     * @param type $gurdian_name
     * @param type $gurdian_relation
     * @param type $gurdian_occupation
     * @param type $app_referees
     * @param type $student_grades
     * @param type $address
     * @param type $telephone1
     * @param type $telephone2
     * @param type $jss_school_id
     * @param type $school_admitted_to
     * @param type $sponsored_child_no
     * @return boolean
     */
    function update_applicant($id,$programarea_id,$firstname,$lastname,$middlename,$gender,$birthdate,
            $community_id,$mother_name,$mother_alive,$mother_ocupation,
            $father_name,$father_alive,$father_occupation,$gurdian_name,$gurdian_relation,$gurdian_occupation,
            $app_referees,$student_grades,
            $address,$telephone1,$telephone2,$jss_school_id,$school_admitted_to,$sponsored_child_no
            ){
        $address=  clean_str($address);
        $lastname= clean_str($lastname);
        $firstname=clean_str($firstname);
        $middlename=clean_str($middlename);
        $gurdian_name=clean_str($gurdian_name);
        $app_referees=clean_str($app_referees);
        
        $str_query="update student_applicant set
                `student_resident_programarea_id`=$programarea_id,
                `student_firstname`='$firstname',
                `student_lastname`='$lastname',";
                if(!$middlename){
                    $str_query.="`student_middlename`=null,";
                }else{    
                    $str_query.="`student_middlename`='$middlename',";
                }
                $str_query.="`student_gender`='$gender',
                `student_dob`='$birthdate',
                `community_community_id`=$community_id,
                `app_mother_name`='$mother_name',
                `app_mother_isalive`='$mother_alive',
                `app_mother_occupation`=$mother_ocupation,
                `app_father_name`='$father_name',
                `app_father_isalive`=$father_alive,
                `app_father_occupation`=$father_occupation,"; 
                 if(!$gurdian_name or count($gurdian_name)==0){
                     $str_query.="`app_guardian_name`='NA',";
                 }else{
                     $str_query.="`app_guardian_name`='$gurdian_name',";
                 }   
                $str_query.="`app_guardian_relation`='$gurdian_relation',
                `app_guardian_occupation`=$gurdian_occupation,
                `app_referees`='$app_referees',
                `student_grades`=$student_grades,
                `student_address`='$address',
                `student_telephone_1`='$telephone1',";
                 if(!$telephone2 or count($telephone2)==0){
                     $str_query.="`student_telephone_2`='none',";
                 }else{
                      $str_query.="`student_telephone_2`='$telephone2',";
                 }   
                $str_query.="`student_admitted_school_id`=$school_admitted_to,
                `app_junior_secondary_id`=$jss_school_id,
                `sponsored_child_no`='$sponsored_child_no',";
                
                $point=$this->assign_applicant_point($mother_ocupation,$father_occupation,$gurdian_occupation,$student_grades,$jss_school_id,$community_id);
                $str_query.="`app_points`=$point WHERE student_applicant_id=$id";    
                
                
              
               
        
        if(!$this->sql_query($str_query)){
            return false;
        }
  
        return $id;
    }
    
    /**
     * This function is used to update confirm students record because of the link between sponsured students and applicants
     * @param type $id
     * @param type $firstname
     * @param type $lastname
     * @param type $middlename
     * @param type $mother_name
     * @param type $father_name
     * @param type $gurdian_name
     * @param type $gender
     * @param type $app_referees
     * @param type $address
     * @param type $telephone1
     * @param type $telephone2
     * @return boolean
     */
    function update_applicant2($id,$firstname,$lastname,$middlename,$mother_name,$father_name,$gurdian_name,
            $gender,$app_referees,$address,$telephone1,$telephone2
            ){
        $address=  clean_str($address);
        $lastname= clean_str($lastname);
        $firstname=clean_str($firstname);
        $middlename=clean_str($middlename);
        $gurdian_name=clean_str($gurdian_name);
        $mother_name=clean_str($mother_name);
        $father_name=clean_str($father_name);
        $gender=clean_str($gender);
        $app_referees=clean_str($app_referees);
        $telephone1=clean_str($telephone1);
        $telephone2=clean_str($telephone2);
        
        $str_query="update student_applicant set
                
                `student_firstname`='$firstname',
                `student_lastname`='$lastname',";
                if(!$middlename or count($gurdian_name)==0){
                    $str_query.="`student_middlename`=null,";
                }else{    
                    $str_query.="`student_middlename`='$middlename',";
                }
                
                $str_query.="`app_mother_name`='$mother_name',
                `app_father_name`='$father_name',";
                
                 if(!$gender or count($gender)==0){
                     $str_query.="`student_gender`='M',";
                 }else{
                     $str_query.="`student_gender`='$gender',";
                 }
                
                if(!$gurdian_name or count($gurdian_name)==0){
                     $str_query.="`app_guardian_name`='NA',";
                 }else{
                     $str_query.="`app_guardian_name`='$gurdian_name',";
                 }   
                
                $str_query.="`app_referees`='$app_referees',
                `student_address`='$address',
                `student_telephone_1`='$telephone1',";
                 if(!$telephone2 or count($telephone2)==0){
                     $str_query.="`student_telephone_2`='0880000000' ";
                 }else{
                      $str_query.="`student_telephone_2`='$telephone2' ";
                 }   
                
                 $str_query.=" WHERE student_applicant_id=$id"; 
                 
                
       if(!$this->sql_query($str_query)){
            return false;
       }
  
        return $id;
    }

    function delete_application($id){
        $str_query="delete from student_applicant where student_applicant_id=$id";
        
        if(!$this->sql_query($str_query)){
            return false;
        }
        
        $this->remove_prudential_relation($id);
        return true;
    }
    /**
     *updates applicaiton point based on current student record 
     */
    function update_applicant_point($id){
        $row=$this->get_applicant($id);
        if(!$row){
            
            return false;
        }
        if($row['app_status']!=APPLICAITON_STATUS_NEW_APPLICANT){
            return false;
        }
                
        $point=$this->assign_applicant_point($row['app_mother_occupation'],
                $row['app_father_occupation'],$row['app_guardian_occupation'],$row['student_grades']
                ,$row['app_junior_secondary_id'],$row['community_community_id']);
        $str_query="update student_applicant set `app_points`=$point WHERE student_applicant_id=$id"; 
        if($this->sql_query($str_query)){
            return $point;
        }else{
            return 0;
        }
    }
}


?>
