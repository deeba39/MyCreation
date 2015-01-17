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
        $str_query="select financial_year_id, year_name, date_start, date_end from financial_year";
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
	else{
            return true;
	}
    }
    /**
     * get all payment request in the given finacial year and with the given status. 
     * if finaical year is 0, then return payment request 
     */
    function get_all_payment_request($financial_year_id=0,$status=0){ // i changed 'finacial' to 'financial'
        $str_status="1";
        if($status!=0){
            $str_status="request_status='$status'";               //replace this with the right column
        }
        
        $str_financial_year_id="1";
        if($financial_year_id!=0){  
           $str_financial_year_id="financial_year_financial_year_id=$financial_year_id";         //chech the column from payment request 
        }        // i changed 'finacial' to 'financial' on the line above
        
        $str_query="select p.`payment_request_id`,p.`code`,p.`year`,p.`request_date`,p.`programarea_id`,
            p.`request_status`,p.`financial_year_financial_year_id`,p.`amount`,p.`group_id`,p.`verification_document`,p.`liquidationdoc`  
            from payment_request p where $str_status and $str_financial_year_id"; 
        
       if (!$this->sql_query($str_query)){
            return false;
        }
        else{
            return true;
        }
    }


     function get_all_payment_requests(){ 

        $str_query="select p.`payment_request_id`,p.`code`,p.`year`,p.`request_date`,p.`programarea_id`,
            p.`request_status`,p.`financial_year_financial_year_id`,p.`amount`,p.`group_id`,p.`verification_document`,p.`liquidationdoc`  
            from payment_request p"; 
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

        $str_query="select sp.`schools_school_id`,s.`school_name`,sum(sp.`amount`) as total_amount,count(sp.`scholarship_payment_id`) as payment_number from schools s, 
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
            p.`request_status`,p.`financial_year_financial_year_id`,p.`amount`,p.`group_id`,p.`verification_document`,p.`liquidationdoc`  
            from payment_request p where p.`payment_request_id`=$payment_request_id";
        if (!$this->sql_query($str_query)){
            return false;
        }
        
		return $this->fetch();
        
    }
}

?>
