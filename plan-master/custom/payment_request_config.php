<?php
	function payment_request_link()
	{
		global $_GET;
		global $_SESSION;
		global $custom_include_root;
		global $cusom_application_name;
		
		$return_link = '<div>ActionTask Links:';
		if(isset($_SESSION[$cusom_application_name]['action_task']['payment_request_students']))
		{
			$return_link .= "(<a href='?action_task_clear=payment_request_students'>Clear Payment Request Task</a>)";		
		}
		$return_link .= '</div>';
		print $return_link;
	}
	function payment_request_config()
	{
		global $_GET;
		global $_SESSION;
		global $custom_include_root;
		global $cusom_application_name;
		
		$is_save = false;
		$tmp_action = null;
		if(isset($_GET['action_task_save']))
		{
			$tmp_action = $_GET['action_task_save'];
			$is_save = true;
		}
		else if (isset($_GET['action_task_clear']))
		{
			$tmp_action = $_GET['action_task_clear'];
			$is_save = false;
		}
		$return_msg = '<div>ActionTask Message:';
		switch($tmp_action)
		{
			case('payment_request_students'):
				$return_msg .= '&nbsp'.$tmp_action;
				if($is_save)
				{
					if(is_numeric($_GET['payment_request']))
					{
						$_SESSION[$cusom_application_name]['action_task'][$tmp_action] = $_GET['payment_request'];
						$return_msg .= '(saved)';
					}
				}
				else
				{
					unset($_SESSION[$cusom_application_name]['action_task'][$tmp_action]);
					$return_msg .= '(cleared)';
				}
				break;
			default:
				break;
		}
		$return_msg .= '</div>';
		print $return_msg;
	}
	payment_request_config();
	payment_request_link();
?>