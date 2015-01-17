<?php
define("PDF_REPORT_LIMIT",1000);
define("APPLICATION_NAME","PLAN_SCH_TRAKCK");

include_once("aconfig.php");
/**
*change mysql date to UK date format i.e. dd/mm/yyyy
*/
function conv_mysql_uk($str_date)
{
    if(!stripos($str_date,"-"))
    {
       return $str_date; //date is not well formated sql date
    }
    else
    {
      //if the date includes time	
      if((stripos($str_date," ")+1)>0)
      {
		$arr_date=explode(" ",$str_date,2);
		$str_date=$arr_date[0];	
	  }
      $arr_date=explode("-",$str_date,3);
      return $arr_date[2]. '/' .$arr_date[1]. '/' .$arr_date[0];
    }
	
}

/**
*change mysql date to UK date format i.e. dd/mm/yyyy
*/
function conv_to_mysql_date($str_date,$delimiter="/")
{
    if(!stripos($str_date,$delimiter))
    {
       return $str_date; //date is not well formated sql date
    }
    else
    {
      //if the date includes time	
      if((stripos($str_date," ")+1)>0)
      {
		$arr_date=explode(" ",$str_date,2);
		$str_date=$arr_date[0];	
	  }
      $arr_date=explode($delimiter,$str_date,3);
      return $arr_date[2]. '-' .$arr_date[1]. '-' .$arr_date[0];
    }
	
}
/**
*extracts date form datetime data type of mysql and convert it to dd/mm/yyyy format
*/ 
function conv_timestamp_uk($str_date)
{
    if(!stripos($str_date,"-"))
    {
       return $str_date; //date is not well formated sql date
    }
    else
    {
      $arr_date=explode(" ",$str_date,2);
       return conv_mysql_uk($arr_date[0])." ".$arr_date[1];

    }

}

function get_datan($name){
	if(!isset($_REQUEST[$name])){
		return 0;
	}
	return (int)$_REQUEST[$name];
}
function get_data($name){
	if(!isset($_REQUEST[$name])){
		return false;
	}
	return $_REQUEST[$name];
}
function jsonn($name,$value){
	return "\"$name\":$value";
}
function jsons($name,$value){
	return "\"$name\":\"$value\"";
}
function jsona($name,$a){
	$str="";
	$lenght=0;
	for($i=0;$i<$length;$i++)
	{
		$str.="\"$value\"";
		if($i<$length-1){
			$str.=",";
		}
	}
	return $str;
}
function json($row)
{
    $str="{";
    $length=count($row);
    $i=0;
    foreach($row as $key => $value)
    {
        $t=  gettype($value);
        if($t=="integer" || $t=="double" ){
            $str.="\"$key\":$value";
        }else{
            $str.="\"$key\":\"$value\"";
        }
            
        
        $i++;
        if($i<$length)
        {
            $str.=",";
        }
    }

    $str.="}";
    return $str;
}

function gender($g){
    if($g=='m' or $g=='M'){
        return "male";
    }
    else if($g=='f' or $g=='F'){
        return "female";
    }
    return "";
}
function fullname($lastname,$firstname,$middlename){
    $str=ucfirst(strtolower($lastname)).", ". ucfirst($firstname);
    if($middlename!=false and strlen($middlename)>=0){
        $str.=" ". ucfirst($middlename);
    }

    return $str;

}
function formatted_fullname($lastname,$firstname,$middlename){
    $str="<b>".ucfirst(strtolower($lastname)) ."</b>, ". ucfirst($firstname);
    if($middlename!=false and strlen($middlename)>=0){
        $str.=" ". ucfirst($middlename);
    }

    return $str;

}

function clean_str($str){
    $replace=array('"',"'");
    $replace2=array("\r","\n");
    $str=  str_replace($replace, "", $str);
    $str=  str_replace($replace2, ",", $str);
    return $str;
}

/*
*sends a redirect meta data to browser
*/
function redirect_topage($page)
{
  echo "<meta http-equiv='refresh' content ='0;url=$page'></meta>";
  
}


/**
*author: Aelaf T Dafla
*date:
*/


define("ER_LOG_LOGGER",1100);
define("ER_MYSQL", 3000);
define("ER_MANAGE_SCHOOL",2000);
define("ER_APPLICANTS",2100);
define("ER_OCCUPATION",2600);
define("ER_COMMUNITY",2700);
define("ER_SCHOOLS",2800);
define("ER_GRANTS",2900);

define("LOG_LEVEL_SEC",0);
define("LOG_LEVEL_DB_FAIL",0);
define("LOG_LEVEL_TRN_SUCC",0);
define("LOG_LEVEL_TRN_FAIL",0);
define("LOG_LEVEL_WRRNING",5);
define("LOG_LEVEL_SUCCESS",7);
define("LOG_LEVEL_SUCCESS_LOW",8);
define("LOG_LEVEL_BANK_ERROR",8);

define("USER_LEVEL_ADMIN",0);
define("USER_LEVEL_PUOFFICER",1);
define("USER_LEVEL_LEARNING_ADVISOR",2);
define("USER_LEVEL_ICT",4);
define("USER_LEVEL_ACCOUNT",3);
define("USER_LEVEL_DATA_ENTRY",5);

function get_user_level(){

    if($_SESSION['PlanGhana_SysAdmin']==1){
        return  USER_LEVEL_ADMIN;                   //system adminstrator
    }
    
    if(isset($_SESSION['PlanGhana_status_UserLevel'])){
        return $_SESSION['PlanGhana_status_UserLevel'];
    }
    
    return -1;
}

function get_user_id(){

    if($_SESSION['PlanGhana_SysAdmin']==1){
        return 0;                   //system adminstrator
    }
    
    if(isset($_SESSION['PlanGhana_status_UserID'])){
        return $_SESSION['PlanGhana_status_UserID'];
    }
    
    return -1;
}

function get_programarea(){

     if($_SESSION["PlanGhana"]["PROGRAM_AREA"]==0){
         return get_data("programarea_id");
     }else{
         return $_SESSION["PlanGhana"]["PROGRAM_AREA"];
     }
}

function check_programarea($programarea_id){
    if($_SESSION["PlanGhana"]["PROGRAM_AREA"]==0){
         return true;
     }else{
         if($_SESSION["PlanGhana"]["PROGRAM_AREA"]==$programarea_id){
             return true;
         }else{
             return false;
         }
     }
}
/*
*Connect to log database to log error
*/
function init_connection_to_log()
{
    //connect to log host
    $link=mysql_connect(DB_HOST.":".DB_PORT,DB_USER,DB_PWORD);
    if(!$link)
    {
        //log error into text file
        log_logger_error(0,ER_LOG_ERROR+1,"Could not connect to log database" );
        return false;
    }
    
    //select insurance database
    if(!mysql_select_db(DB_NAME,$link))
    {
        //log error into text file
        log_logger_error(0,ER_LOG_ERROR+2,"Could not select log database". mysql_error($link));
       return false;
    }
    return $link;
}

/*
* log error with database, error message includes current username, host name, time, file it origninated
* param $level severity of error
* param $code unique code of the error
* param $msg error message
* param $mysql_msg error message from sql server, default value 'NONE'
*/
function log_msg($level,$code,$msg,$mysql_msg='NONE')
{
    
    $link=init_connection_to_log();
    if(!$link)
    {
        //error has been loged by init_connection_to_log
        return false;
    }
    
  
    $username="";
    //if user has already logged in use the username
    //if user has not loged in use unknown as user name
    if(!isset($_SESSION['UR_USERNAME']))
    {
        $username="unknown";
    }
    else
    {
        $username=$_SESSION['UR_USERNAME'];
    }
    
    if(!isset($_SESSION['UR_FDOMAIN']))
    {
        $domain="unknown";
    }
    else
    {
        $domain=$_SESSION['UR_FDOMAIN'];
    }
    $mysql_msg=str_replace("'","%",$mysql_msg);
	$mysql_msg=str_replace('"',"%",$mysql_msg);

    $str_query="INSERT INTO logs SET " .
    "LOG_CODE=$code, ".
    "USERNAME='$username', ".
    "DOMAIN='$domain', ".
    "HOST='" . $_SERVER['HTTP_HOST']."',".
    "PAGE_URI='" . $_SERVER['SCRIPT_FILENAME']."',".
    "LOG_MSG='$msg',".
    "MYSQL_MSG='$mysql_msg'";
    
    
    if(!mysql_query($str_query,$link))
    {
        //log error in text file
        log_logger_error(0,ER_LOG_LOGGER+3,"Could not insert log into table :" . mysql_error($link));
        return false;
    }

    return mysql_insert_id($link);
    //return true;
}

/**
*this functionis envoked if error could not be logged into database
*it writes error message into text file
*/
function log_logger_error($level,$code,$msg)
{
     //open text file in append text mode
    $fhandle=fopen(LOG_PATH,"at");

    $username="";
    //current day and time
	$str_date= date(" d/m/Y H:i:s") ;
	
	if(isset($_SESSION['UR_USERNAME']))
	{
		$username=$_SESSION['UR_USERNAME'];
	}
	else
	{
		$username="unknown";
	}

       //compile text line
	$log_msg=sprintf("E%d : %-10s, %-15s , %-30s, %s \n", $code, $str_date, $username, $_SERVER['HTTP_HOST'],$msg);

    //write line
	fwrite($fhandle,$log_msg);
	//close file
	fclose($fhandle);

}


?>