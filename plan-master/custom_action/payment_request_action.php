<?php 
	error_reporting(0);
	$_sys_custom_actionpage = true;;
	session_start();
	include ("../custom/cconfig.php");
	
	include ("../ewcfg7.php");
	header('Content-type: text/html');
	header("Cache-Control: no-cache, must-revalidate");
	$tmp_action = '';
	$tmp_id = '0';
	//sleep(2);
	if(isset($_GET['action']))
	{
		$tmp_action = $_GET['action'];
	}
	if(isset($_GET['id']))
	{
		if(is_numeric($_GET['id']))
		{
			$tmp_id = $_GET['id'];
		}
	}
	
	$html = '';
	$html_sql = '';
	function custom_mysql_connect()
	{
		$link = mysql_connect(EW_CONN_HOST.':'.EW_CONN_PORT, EW_CONN_USER, EW_CONN_PASS);
		mysql_select_db(EW_CONN_DB,$link);
		
		return $link;
	}
	function custom_payment_request_student_action($request_id, $student_id,$isset)
	{
		
	
		if(!is_numeric($request_id) || !is_numeric($student_id)) { return null;}
		$isset = $isset? 1 : 0; //turn set variable to simply integer
		$sql_str = "SELECT custom_payment_request($request_id, $student_id, $isset) as `value`;";
		//print ("<div>$sql_str</div>");
		$sql_link = custom_mysql_connect();
		$sql_resource = mysql_query($sql_str);
		$sql_row = mysql_fetch_assoc($sql_resource);	
		mysql_close($sql_link);
		return $sql_row['value'];
	}
	
	function custom_payment_request_student_status($request_id, $student_id)
	{
		
	
		if(!is_numeric($request_id) || !is_numeric($student_id)) { return null;}

		$sql_str = "SELECT custom_payment_request_status($request_id, $student_id) as `value`;";
		//print ("<div>$sql_str</div>");
		$sql_link = custom_mysql_connect();
		$sql_resource = mysql_query($sql_str);
		$sql_row = mysql_fetch_assoc($sql_resource);
		mysql_close($sql_link);
		return $sql_row['value'];
	}
	
	function custom_payment_request_student_describecode($code)
	{
		$str = '';
		switch((int)$code)
		{
			case(400):
				$str = 'Included';
				break;
			case(500):
				$str = ' - not assigned ';
				break;
			case(-101):
				$str = 'No Such Request';
				break;
			case(-102):
				$str = 'No Such Student';
				break;
			case(-103):
				$str = 'No Scholarship Package';
				break;
			case(201):
				$str = 'Newly Added';
				break;
			case(200):
				$str = 'Added';
				break;
			case(300):
				$str = 'Newly Removed';
				break;
			case(301):
				$str = 'Removed';
				break;
			default:
				$str = "unknown($code)";
		}
		return $str;
	}
	function custom_json_sql()
	{
		global $html_sql;
		global $json_sql;
		$html_sql = str_replace('"','\"',$html_sql);
		$json_sql = ",\"sql_debug\":\"$html_sql\"";
	
	}
	$html_sql .=custom_mysql_connect();
	$tmp_student_id = $_GET['student_id'];
	$tmp_request_id = $_SESSION[$cusom_application_name]['action_task']['payment_request_students'];
	//var_dump($tmp_student_id);
	//var_dump($tmp_request_id);
	switch($tmp_action)
	{
		case("add"):
			
			$code =custom_payment_request_student_action($tmp_request_id,$tmp_student_id,1);
			$code_message = custom_payment_request_student_describecode($code);
			
			custom_json_sql();
			$html .= "{\"action\": \"$tmp_action\",\"response\":\"done\",\"message\":\"$code_message\"$json_sql}";
		break;
		case("remove"):
			$code =custom_payment_request_student_action($tmp_request_id,$tmp_student_id,0);
			$code_message = custom_payment_request_student_describecode($code);
			custom_json_sql();
			$html .= "{\"action\": \"$tmp_action\",\"response\":\"done\",\"message\":\"$code_message\"$json_sql}";
		break;
		case("status"):
			$code =custom_payment_request_student_status($tmp_request_id,$tmp_student_id);
			$code_message = custom_payment_request_student_describecode($code);
			custom_json_sql();
			$html .= "{\"action\": \"$tmp_action\",\"response\":\"done\",\"message\":\"$code_message\"$json_sql}";
		break;
	}
	
	print "$html";
?>