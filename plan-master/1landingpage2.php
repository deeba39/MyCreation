<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "programareainfo.php" ?>
<?php include "usersinfo.php" ?>
<?php include "userfn7.php" ?>



<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0

include "header.php" ;
$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) {$Security->AutoLogin();
					if ( ob_get_length())
				ob_end_clean();
			header("Location: " . "login.php");			
			}
		
		
echo "You are logged in as <b>".$GLOBALS['Security']->CurrentUserName()."</b>";
?>
<table width="550" border="0" align="center" cellpadding="0" cellspacing="0" style=" line-height: 1pt; font-size: 8pt;">
  <tr>
    <td align="center" valign="top"><p><img src="images/menuimages/find.jpg" width="64" height="64" /></p>
      <p><?php if ($Security->AllowList('student_applicant')){   ?><a href="student_applicantlist.php">Student Applicant</a> <?php } else{   ?> Student Applicant <?php } ?> </p>
      
      
      <p><a href="sponsored_studentlist.php">Sponsored Student</a></p>
      <p><a href="schoolslist.php?cmd=resetall">Students in a school</a></p>
    <p>&nbsp;</p></td>
    <td align="center" valign="top"><p><img src="images/menuimages/cash2.jpg" width="64" height="64" /></p>
      <p>New payment Request</p>
<p><a href="Disburse_Paymentslist.php">Disburse Payment</a></p>
      <p>    <a href="view_for_payment_refund_selectionlist.php">Enter Refunds</a></p>
      <p><a href="Liquidate_Payment_Requestlist.php">Liquidate</a></p></td>
    <td align="center" valign="top"><p><img src="images/menuimages/reports.jpg" width="64" height="64" /></p>
      <p><a href="reports/planProj/Refund_Report_detailedsmry.php">Payments &amp; Refunds-Detailed</a></p>
<p><a href="reports/planProj/Refunds_summariessmry.php">Payments &amp; Refunds- Summary</a></p>
<p><a href="reports/planProj/Grant_Package_Expenditure_Detailsmry.php">Grant Package Expenditure</a></p>
<p>Distribution by Program Area</p></td>
  </tr>
  <tr>
    <td align="center" valign="top"><p><img src="images/menuimages/applicationform.jpg" width="64" height="64" /></p>
    <p><a href="student_applicantadd.php">New Application</a></p></td>
    <td align="center" valign="top"><p><img src="images/menuimages/package.jpg" width="64" height="64" /></p>
    <p><a href="grant_packagelist.php"> Grant Package</a></p></td>
    <td align="center" valign="top"><p><img src="images/menuimages/changepwd.png" width="64" height="64" /></p>
    <p><a href="changepwd.php">Change Password</a></p></td>
  </tr>
  <tr>
    <td align="center" valign="top"><p><img src="images/menuimages/award.jpg" width="64" /></p>
    <p><a href="SelectionViewlist.php">Award a Scholarship</a></p></td>
    <td align="center" valign="top"><p><img src="images/menuimages/schoolattendance.jpg" width="64" height="64" /></p>
    <p><a href="school_attendancelist.php?cmd=resetall">Academics </a></p>
    <p><a href="view_school_lists_paymentslist.php">Attendance</a></p></td>
    <td align="center" valign="top"><p><img src="images/menuimages/exit.jpg" width="64" height="64" /></p>
    <p><a href="logout.php">Exit</a></p></td>
  </tr>
</table>
<p>&nbsp;</p>
<?php include "footer.php" ?>

