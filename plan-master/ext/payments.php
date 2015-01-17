<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of payments
 *
 * @author Aelaf Dafla
 */
include_once("rep.php");
class payments extends rep {
    //put your code here
    function get_all_financial_year(){
        $str_query="select financial_year_id, year_name, date_start, date_end from financial_year order by date_end desc";
	if (!$this->sql_query($str_query)){
            return false;
	}
	else{
            return true;
	}
    }
    
    function get_current_finacial_year(){
        //return the current finacial year
    $str_query="select financial_year_id, year_name, date_start, date_end from financial_year 
    where CURDATE() between date_start and date_end";
	if (!$this->sql_query($str_query)){
            return false;
	}
	
        return $this->fetch();
    }
    /**
     * get all payment request in the given finacial year and with the given status. 
     * if finaical year is 0, then return payment request 
     * status 1 NEWREQ, 2 REQUESTED, 3 DISBURSED, 4 LIQUDATE
     */
    function get_payment_requests($financial_year_id=0,$programarea_id=0, $status=0, $owner_id=0){ // i changed 'finacial' to 'financial'
        $filter="1";
        if($status!=0){
            $filter="request_status=$status";               //replace this with the right column
        }
        

        if($financial_year_id!=0){  
           $filter.=" and financial_year_financial_year_id=$financial_year_id";         //chech the column from payment request 
        }        // i changed 'finacial' to 'financial' on the line above
        

        if($programarea_id!=0){  
           $filter.=" and p.`programarea_id`=$programarea_id";         //chech the column from payment request 
        }
        
        if($owner_id!=0){
           $filter.=" and owner_id=$owner_id "; 
        }
        
        $str_query="select p.`payment_request_id`,p.`code`,p.`year`,p.`request_date`,p.`programarea_id`,
            p.`request_status`,p.`financial_year_financial_year_id`,p.`amount`,
            p.`group_id`,p.`verification_document`,p.`liquidationdoc`,p.`owner_id`,
            pa.`programarea_name`,f.`year_name`  
            from payment_request p
            join financial_year f on p.`financial_year_financial_year_id`=f.`financial_year_id`
            left join programarea pa on p.`programarea_id`=pa.`programarea_id` 
            where $filter"; 
       //echo $str_query;
       if (!$this->sql_query($str_query)){
            return false;
        }
        else{
            return true;
        }
    }

    function get_new_payment_requests($programarea_id){
        
        return $this->get_payment_requests(0,$programarea_id,1);    
    }
    
    function get_all_payment_requests(){ 

        $str_query="select p.`payment_request_id`,p.`code`,p.`year`,p.`request_date`,p.`programarea_id`,
            p.`request_status`,p.`financial_year_financial_year_id`,p.`amount`,
            p.`group_id`,p.`verification_document`,p.`liquidationdoc`,
            pa.`programarea_name`,f.`year_name`
            from payment_request p
            join financial_year f on p.`financial_year_financial_year_id`=f.`financial_year_id`
            left join programarea pa on p.`programarea_id`=pa.`programarea_id`"; 
        
       if (!$this->sql_query($str_query)){
            return false;
        }
        else{
            return true;
        }
    }
    
    function get_payment_for_school($payment_request_id){
        //each payment request has a list of scholarship payment, 
        //each scholarhsip payment linked to the school the student is in
        //group the payment by school and return school name, total amount, number of scholarship paymennt in the given request
        //you have to cont the sponsred sudent that belong to this payment request and school
        /*
        $str_query="select sp.`schools_school_id`,s.`school_name`,sum(sp.`amount`) as total_amount,count(sp.`scholarship_payment_id`) as payment_number from schools s, 
        scholarship_payment sp where (sp.`payment_request_payment_request_id`=$payment_request_id)
        group by sp.schools_school_id,s.`school_name`";*/

        $str_query="select sp.`schools_school_id`,s.`school_id`,s.`school_name`,sum(sp.`amount`) as total_amount,count(sp.`scholarship_payment_id`) as payment_number from schools s, 
        scholarship_payment sp where (sp.schools_school_id=s.school_id) and (sp.`payment_request_payment_request_id`=$payment_request_id)
        group by sp.schools_school_id,s.`school_name`";

        if (!$this->sql_query($str_query)){
            return false;
        }
        else{
            return true;
        }
        
    }
    
    function get_payment_detail($payment_request_id){
        //get details of one payment request from payment request table and return the row
        //you have to fetch
	
        $str_query="select p.`payment_request_id`,p.`code`,p.`year`,p.`request_date`,p.`programarea_id`,
            p.`request_status`,p.`financial_year_financial_year_id`,p.`amount`,
            p.`group_id`,p.`verification_document`,p.`liquidationdoc`,p.`owner_id`,
            pa.`programarea_name`,f.`year_name`
            from payment_request p
            join financial_year f on p.`financial_year_financial_year_id`=f.`financial_year_id`
            left join programarea pa on p.`programarea_id`=pa.`programarea_id` 
            where p.`payment_request_id`=$payment_request_id";
        if (!$this->sql_query($str_query)){
            return false;
        }
        
		return $this->fetch();
        
    }

    function get_payment_request_students($filter="1", $page=0,$limit=0){
        $str_limit_clause="";
        if($limit!=0){
            $offset=($page-1)*$limit;
            $str_limit_clause="limit $offset,$limit";
        }
        
        $str_query="SELECT spa.`payment_request_payment_request_id`, spa.`scholarship_payment_id`, spa.`date`, spa.`status`, spa.`amount`, spa.`schools_school_id`,
        spack.`scholarship_package_id`,spack.`start_date`,spack.`end_date`,spack.`annual_amount` as scholarship_annaual_amount , ifnull(spack.`status`,0),
            v.`sponsored_student_id`, v.`student_firstname`, v.`student_middlename`, v.`student_lastname`,
            v.`student_applicant_student_applicant_id`, v.`programarea_id`, v.`programarea_name`,
            v.`DistrictID`, v.`District`, v.`community_id`, v.`community`, v.`student_telephone_1`,
            v.`student_telephone_2`, v.`student_dob`,v.`app_submission_year`, v.`student_gender`,
            v.`app_grant_id`, v.`grant_package_id`, v.`grant_name`, v.`annual_amount`,sch.`school_id`,sch.`school_name`
        FROM scholarship_payment spa
        left join scholarship_package spack on spa.`scholarship_package_scholarship_package_id`=spack.`scholarship_package_id`
        left join view_sponsored_student_detail v on spack.`sponsored_student_sponsored_student_id`=v.`sponsored_student_id`
        left join schools sch on spa.`schools_school_id`=sch.`school_id` 
        where  $filter $str_limit_clause";
        //echo $str_query;
        if(!$this->sql_query($str_query)){
            return false;
        }
        
        return true;
    }
    
    function get_payment_request_students_programarea($payment_request_id,$programarea_id,$year,$page=0,$limit=0){
        $filter="1";
         if($payment_request_id!=0){
            $filter="spa.`payment_request_payment_request_id`=$payment_request_id ";
        }
        if($programarea_id!=0){
            $filter.=" and v.`programarea_id`=$programarea_id ";
        }
        
        if($year!=0){
            $filter.=" and v.`app_submission_year`=$year ";
        }
        
        return $this->get_payment_request_students($filter,$page,$limit);
    }
    
    function get_payment_request_students_school($payment_request_id,$school_id,$year,$page=0,$limit=0){
        $filter="1";

        if($payment_request_id!=0){
            $filter="spa.`payment_request_payment_request_id`=$payment_request_id ";
        }
        
        if($school_id!=0){
            $filter.= " and spa.`schools_school_id`=$school_id ";
        }
        
         if($year!=0){
            $filter.=" and v.`app_submission_year`=$year ";
        }

        return $this->get_payment_request_students($filter,$page,$limit);
    }

    function submit_payment_request($payment_request_id){
        $str_query="update payment_request set request_status='REQUESTED',request_date=curdate() 
            where payment_request_id=$payment_request_id and request_status='NEWREQ'";
        
        if (!$this->sql_query($str_query)){
            return false;
        }
        else{
            return true;
        }
    }
    
    function disburse_payment_request($payment_request_id){
        $str_query="update payment_request set request_status='DISBURSED',request_date=curdate() 
            where payment_request_id=$payment_request_id and request_status='REQUESTED'";
        
        if (!$this->sql_query($str_query)){
            return false;
        }
        else{
            return true;
        }
    }
    
    function liqudate_payment_request($payment_request_id){
        $str_query="update payment_request set request_status='LIQUIDATED',request_date=curdate() 
            where payment_request_id=$payment_request_id and request_status='DISBURSED'";
        
        if (!$this->sql_query($str_query)){
            return false;
        }
        else{
            return true;
        }
    }
    
    function create_payment_request($finacial_year_id,$programarea_id,$request_name,$owner_id=0){
        $year=date('Y');
        $str_query="insert into payment_request set code='$request_name', programarea_id=$programarea_id, 
                    year=$year,request_date=current_date(), request_status='NEWREQ',financial_year_financial_year_id=$finacial_year_id,
                amount=0,group_id=0,owner_id=$owner_id";
        
        if (!$this->sql_query($str_query)){
            return false;
        }
        else{
            return $this->get_insert_id();
        }
        
    }
}

?>
