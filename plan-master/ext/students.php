<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once("rep.php");
define("SCHOLARSHIP_STATUS_ACTIVE",1);
define("SCHOLARSHIP_STATUS_SUSPEND",2);
define("SCHOLARSHIP_STATUS_END",3);

class students extends rep{
    var $count;
    function students(){
        //db::db();
        rep::rep();
        $this->er_code_prefix=ER_APPLICANTS;     //error prefix for this class is 23
        $this->src="payments";
    }

    function add_application_record($firstname,$lastname4,$birthdate,$gender,$startDate,$endDate,$entryLevel,$currentLevel,$academicProgram,$attendanceType,
            $jss,$school,$community,$programarea,$scholarshipType,$grant,$amount){
        $strQuery="insert into student_applicant(`student_firstname`,`student_lastname`,`student_gender`,`student_dob`,`community_community_id`,
            `app_submission_year`,`app_amount`,`app_status`,`app_primary_school_id`,`app_junior_secondary_id`,`student_admitted_school_id`,
            `student_resident_programarea_id`) 
            values('$firstname','$lastname','$gender','$birthdate',$community,$startDate,300,2,0,$jss,$school,$programarea)"; 


        if(!$this->sql_query($strQuery)){
            return false;
        }
        $id=$this->get_insert_id();
        if($id==false){
            return false;
        }
        $strQuery="insert into sponsored_student(`student_firstname`,
            `student_lastname`, `student_applicant_student_applicant_id`, `community_community_id`, `student_resident_programarea_id`)
               values('$firstname','$lastname',$id,$community,$programarea)";

        if(!$this->sql_query($strQuery)){
            return false;
        }
       $id=$this->get_insert_id();
        if($id==false){
            return false;
        }

        $strQuery="insert into school_attendance(`start_date`,`end_date`,`entry_class`,`entry_level`,`attendance_type`,`program`,
            `current_class`,`schools_school_id`,`sponsored_student_sponsored_student_id`)
            values($startDate,$endDate,$entryLevel,$entryLevel,'$attendanceType','$academicProgram',$currentLevel,$school,$id)";


         if(!$this->sql_query($strQuery)){
            return false;
        }


        $strQuery="insert into scholarship_package(`start_date`,`end_date`, `status`, `annual_amount`,
           `scholarship_type`,`grant_package_grant_package_id`, `sponsored_student_sponsored_student_id`,
           `scholarship_type_scholarship_type`)
            values($startDate,$endDate,1,$amount,$scholarshipType,$grant,$id,$scholarshipType)";


        if(!$this->sql_query($strQuery)){
            return false;
        }

        return true;

    }

    function update_student_record($student_id,$community_id,$firstname,$lastname,$middlename,$birthdate,$gender,$telephone1,$telephone2){
            $row=$this->get_student_record($student_id);
            if(!$row){
                return false;
            }
            $str_middlename="student_middlename=null"; 
            if($middlename==false){ //need clarification
                $str_middlename="student_middlename='$middlename'";
            }
            $str_query="update sponsored_student set 
                            student_firstname='$firstname',
                            student_lastname='$lastname',
                            $str_middlename,
                            community_community_id=$community_id
                        where sponsored_student_id=$student_id"; 
            
            if(!$this->sql_query($str_query)){
                return false;
            }
            $str_query="update student_applicant set 
                            student_firstname='$firstname',
                            student_lastname='$lastname',
                            $str_middlename,
                            student_gender='$gender',
                            student_dob='$birthdate',
                            student_telephone_2='$telephone1', 
                            student_telephone_1='$telephone2',
                            community_community_id=$community_id
                        where student_applicant_id={$row['student_applicant_student_applicant_id']}"; //haven't you swapped telephone numbers
             
             if(!$this->sql_query($str_query)){
                return false;
            }
            
            return true;
    }
    
    function get_student_record($id){
        $strQuery="SELECT
            s.`sponsored_student_id`, s.`student_firstname`, s.`student_middlename`, s.`student_lastname`,
            s.`student_picture`, s.`student_grades`, s.`student_applicant_student_applicant_id`,
            s.`student_resident_programarea_id`, s.`community_community_id`, s.`group_id`,
            programarea_name, community, District,
            sa.`student_telephone_1`, sa.`student_telephone_2`, sa.`student_dob`, sa.`app_submission_year`,
            sa.`student_gender`
            FROM sponsored_student s
            left join student_applicant sa on s.student_applicant_student_applicant_id=sa.student_applicant_id
            LEFT JOIN programarea on s.student_resident_programarea_id=programarea.programarea_id
            left join community  on s.community_community_id=community.`community_id`
            left join districts on community_districts_DistrictID=districts.DistrictID where s.sponsored_student_id={$id}";

       if(!$this->sql_query($strQuery)){
            return false;
        }
        return $this->fetch();

     
    }
    
    function get_scholarship_ending_students($programarea_id,$end_year, $page,$limit){
        //scholarship ends when the end_date in scholarhip_package is less than $end_year-08-31
        //build a filter to find student whose scholarhsip is ending in a given year 
    }
    
    function get_students_from_programarea($programarea_id,$year,$scholarship_status=1,$search_text=0, $page=0,$limit=0){
        $filter="1";
        
        if($programarea_id!=0){
            $filter="`programarea_id`=$programarea_id";
        }
        if($year!=0){
            $filter.=" and `app_submission_year`=$year";
        }
        
        if($scholarship_status!=0){
             $filter.=" and ifnull(sp.`status`,0)=$scholarship_status";
        }
        if($search_text){
            $filter.=" and (`student_firstname` like '%$search_text%' or `student_lastname` like '%$search_text%')";
        }
        $this->count=$this->get_students_count($filter);
        
        $orderBy=" programarea_name,community,student_lastname";
        
        return $this->get_students($filter,$page,$limit,$orderBy);
    }
      
    function get_students_from_district($district_id,$year, $page,$limit){
        $filter="1";
        if($district_id!=0){
            $filter.="`DistrictID`=$district_id";
        }
        if($year!=0){
            $filter.="and `app_submission_year`=$year";
        }
        
        $this->count=$this->get_students_count($filter);
        $order_by="District,community,student_lastname";
        return $this->get_students($filter, $page, $limit,$order_by);
    }
    
    function get_students_from_community($community_id,$year, $page,$limit){
        $filter="1";
        if($community_id!=0 && $year==0){
            $filter="`community_id`=$community_id";
        }
        if( $year!=0){
            $filter.="and `app_submission_year`=$year";
        }
        $order_by="District,community,student_lastname";
        
        $this->count=$this->get_students_count($filter);
        return $this->get_students($filter, $page, $limit,$order_by);
    }
    /**
     * gets the number of rows get_students will return if limit was not used. 
     * @param type $filter
     * @return boolean
     */
    function get_students_count($filter){

       
       $str_query="select count(*) as no_rec 
             from view_sponsored_student_detail v 
             left join scholarship_package sp on v.`sponsored_student_id`=sp.`sponsored_student_sponsored_student_id` 
             where $filter ";
        
        if(!$this->sql_query($str_query)){
            return false;
        }
        
        $row=$this->fetch();
        if($row==false){
            return 0;
        }
        return $row['no_rec'];
    }
        
    function get_students($filter,$page=0,$limit=0,$order="programarea_name,community,student_lastname"){
        $str_limit_clause="";
        if($limit!=0){
            $offset=($page-1)*$limit;
            $str_limit_clause="limit $offset,$limit";
        }

        $str_query="select `sponsored_student_id`, `student_firstname`, `student_middlename`, 
            `student_lastname`, `student_picture`, `student_grades`, 
            `programarea_name`, `programarea_id`, `DistrictID`, `community`, `community_id`, 
            `District`, `student_telephone_1`, `student_telephone_2`, `student_dob`, 
            `app_submission_year`, `student_gender`, `school_name`, 
            `app_grant_id`, `grant_package_id`, `grant_name`, v.`annual_amount`,
            ifnull(sp.`status`,0) as scholarship_status
             from view_sponsored_student_detail v 
             left join scholarship_package sp on v.`sponsored_student_id`=sp.`sponsored_student_sponsored_student_id` 
             where $filter 
             order by $order $str_limit_clause";
        //echo "$str_query";
        if(!$this->sql_query($str_query)){
            return false;
        }
        
        return true;
        
    }
   
    function get_student_scholarhsip_payment($id){
        $strQuery="SELECT s.scholarship_package_scholarship_package_id,s.`date`, s.`status`, s.`refund_amount`, s.`amount`, s.`memo`,
                s.`year`, s.`schools_school_id`,
                `sponsored_student_sponsored_student_id`, `school_name`
                FROM scholarship_payment s
                LEFT JOIN scholarship_package on s.scholarship_package_scholarship_package_id=scholarship_package.scholarship_package_id
                LEFT JOIN schools on s.schools_school_id=schools.school_id
                WHERE `sponsored_student_sponsored_student_id`={$id}";

        if(!$this->sql_query($strQuery)){
            return false;
        }
        return true;
    }
    
    function add_school_attendance($id,$start_date,$end_date,$program,$attendance_type,$entry_class,$entry_level,$current_class){
    }
    
    function get_scholarship_package($id){
        $str_query="SELECT s.`scholarship_package_id`, s.`start_date`, s.`end_date`, s.`status`, 
            s.`annual_amount`, s.`scholarship_type`, s.`grant_package_grant_package_id`, 
            s.`sponsored_student_sponsored_student_id`, s.`scholarship_type_scholarship_type`, 
            s.`group_id` FROM scholarship_package s where s.`sponsored_student_sponsored_student_id`=$id order by s.`start_date` desc limit 0,1 ";
       
        if(!$this->sql_query($str_query)){
            return false;
        }
        
        return $this->fetch();
    }
    
    function get_scholarship_packages($id){
        $str_query="SELECT s.`scholarship_package_id`, s.`start_date`, s.`end_date`, s.`status`, 
            s.`annual_amount`, s.`scholarship_type`, s.`grant_package_grant_package_id`, 
            s.`sponsored_student_sponsored_student_id`, s.`scholarship_type_scholarship_type`, 
            s.`group_id` FROM scholarship_package s where s.`sponsored_student_sponsored_student_id`=$id";

        if(!$this->sql_query($str_query)){
            return false;
        }
        
        return true;
    }

    function add_to_payment_request($student_id,$payment_request_id){
        $str_query="select custom_payment_request($payment_request_id,$student_id,1) as r";

        if(!$this->sql_query($str_query)){
            return false;
        }
        
        $row=$this->fetch();
        return $row["r"];
        
    }

    /**
     * returns all student paid for in the given finacial year
     * @param type $finacial_year_id
     * @param type $page
     * @param type $limit
     */
    function get_paid_for_students($paid_for=1,$financial_year_id,$programarea_id,$year,$scholarship_status=1, $page=0, $limit=0){ //i changed it from 'finacial_year_id' to 'financial_year_id'
        $not="";
        if($paid_for==0){
            $not="NOT";
        }
        
        //they should not be in payment request and they have tobe active
        $filter ="ifnull(sp.`status`,0)=1 and `sponsored_student_id` $not IN (SELECT spack.`sponsored_student_sponsored_student_id` FROM 
        scholarship_payment spay left join scholarship_package spack 
        on spay.`scholarship_package_scholarship_package_id`=spack.`scholarship_package_id`
        left join payment_request p
        on spay.payment_request_payment_request_id=p.payment_request_id
        where p.`financial_year_financial_year_id`=$financial_year_id)";
        
        if($programarea_id!=0){
            $filter.=" and `programarea_id`=$programarea_id";
        }
        
        if($year!=0){
            $filter.=" and `app_submission_year`=$year";
        }
        
        if($scholarship_status!=0){
             $filter.=" and ifnull(sp.`status`,0)=$scholarship_status";
        }
        
        $this->count=$this->get_students_count($filter);
        
        return $this->get_students($filter,$page,$limit);
    } 
    
    /**
     * get all student added under the payment request
     * @param type $payment_id
     * @param type $page
     * @param type $limit
     */
    function get_payment_request_students($payment_id,$programarea_id=0,$year=0,$page=0,$limit=0){

        $filter ="`sponsored_student_id` IN (SELECT spack.`sponsored_student_sponsored_student_id` FROM 
        scholarship_payment spay left join scholarship_package spack 
        on spay.`scholarship_package_scholarship_package_id`=spack.`scholarship_package_id`
        where spay.payment_request_payment_request_id=$payment_id)";
        
        if($programarea_id!=0){
            $filter.="and programarea_id=$programarea_id";
        }
        
        if($year!=0){
            $filter.="and `app_submission_year`=$year";
        }
        $this->count=$this->get_students_count($filter);
        return $this->get_students($filter,$page,$limit);
    }
    
    function remove_from_payment_request($student_id,$payment_request_id){
        //execute the sql function `custom_payment_request`(`var_payment_request_id` INT, `var_sponsored_student_id` INT, `var_isadd` BOOLEAN)
        //with var_isadd as false
        //return what the sql function return if it executes, otherwise return false;
        //see add_to_payment_request as a reference. this will be the reverse
        
        $str_query="select custom_payment_request($payment_request_id,$student_id,false) as r";

        if(!$this->sql_query($str_query)){
            return false;
        }
        
        $row=$this->fetch();
        return $row["r"];
        
    }

    function set_promote($attendance_id,$academic_year,$promoted,$grade_year_id,$english,$math){

        $sql_query="SELECT promote_student($academic_year,$attendance_id,$promoted,$grade_year_id,'$english','$math') as grade_year_id";
        //echo $sql_query;
        if(!$this->sql_query($sql_query)){
            return false;
        }

        return true;
       /*
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
         * 
         */
    }
    
    function get_student_performance($id){
        $str_query="SELECT g.`grade_year_id` , g.`class` , g.`year` , g.`promoted` , g.`programme` , g.`english` , g.`math` , g.`school_attendance_school_attendance_id` , g.`verified` , sa.`schools_school_id` , s.`school_name` 
                    FROM grade_year g
                        LEFT JOIN school_attendance sa ON (  `school_attendance_school_attendance_id` = sa.`school_attendance_id` ) 
                            LEFT JOIN schools s ON ( sa.`schools_school_id` = s.`school_id` ) where 
                            	sponsored_student_sponsored_student_id=$id";
        
        if(!$this->sql_query($str_query)){
            return false;
        }
        
        return true;
    }
    
    /**
     * Change status of scholarship package
     * @param type $scholarship_package_id
     * @param int status 1 resume, 2 suspend 3 end
     * @return boolean
     */
    function change_scholarship_status($scholarship_package_id,$status){
       //find the package id and set it to 2
        $str_query="update scholarship_package set status=$status where scholarship_package_id=$scholarship_package_id and status!=3";

        if(!$this->sql_query($str_query)){
            return false;
        }
        
        return true;
    }
    
    function change_student_scholarship_status($id,$status){
        $row=$this->get_scholarship_package($id);
        if(!$row){
            return false;
        }
        if($row['status']==3){
            return;
        }
        return $this->change_scholarship_status($row['scholarship_package_id'], $status);
        
    }
    
    function has_scholarship_expired($scholarship_package_id){
        $str_query="select end_date<curdate() as ended where scholarship_package_id=$scholarship_package_id";
        
        if(!$this->sql_query($str_query)){
            return -1;
        }
        
        $row=$this->fetch();
        if($row["ended"]==1){
            return 1;
        }
        
        return 0;
    }
    
    function get_student_attendance($id){
        $strQuery="SELECT  school_attendance_id,s.`start_date`, s.`end_date`,
        s.`entry_class`, s.`entry_level`, s.`attendance_type`,
        s.`program`, s.`current_class`, s.`schools_school_id`, s.`sponsored_student_sponsored_student_id`,
        schools.school_name
        FROM school_attendance s
        LEFT JOIN schools on s.schools_school_id=schools.school_id where s.`sponsored_student_sponsored_student_id`={$id}
        order by start_date desc";


       if(!$this->sql_query($strQuery)){
            return false;
        }
        return true;
    }
    
    function get_current_student_attendance($id){
        $strQuery="SELECT school_attendance_id,s.`start_date`, s.`end_date`,
        s.`entry_class`, s.`entry_level`, s.`attendance_type`,
        s.`program`, s.`current_class`, s.`schools_school_id`, s.`sponsored_student_sponsored_student_id`,
        schools.school_name
        FROM school_attendance s
        LEFT JOIN schools on s.schools_school_id=schools.school_id where s.`sponsored_student_sponsored_student_id`=$id order by start_date desc limit 0,1";

        
       if(!$this->sql_query($strQuery)){
            return false;
       }
       return $this->fetch();
    }
    
    function change_school($id, $current_attendance_id, $curent_end_date,$new_start_date,$new_end_date){
        
    }
}
?>
