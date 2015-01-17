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
		
		
echo "You are logged in as <b>".$GLOBALS['Security']->CurrentUserName()."</b>"; ?>
<br/>
<br/>
<table border="0" cellpadding="5" cellspacing="5" style=" line-height: 1pt; font-size: 10pt;">
  <tr>
        <td  align="center" valign="top"><img src="images/menuimages/find.jpg" width="32" height="32" /></td>  
        <td align="center" valign="top">
          <p><?php if ($Security->AllowList('student_applicant')){   ?><a href="applicantlist.php">Student Applicant</a> <?php } else{   ?> Student Applicant <?php } ?> </p>
          <p><a href="studentlist.php">Sponsored Student</a></p>
        <p>&nbsp;</p></td>
        <td align="center" valign="top">
            <p><img src="images/menuimages/cash2.jpg" width="32" height="32" /></p>
        </td>
        <td valign="top">
          <p>New payment Request</p>
        <p><a href="paymentlist.php">Disburse Payment</a></p>
        <p><a href="paymentlist.php">Liquidate</a></p></td>
        <td align="center" valign="top">
            <p><img src="images/menuimages/reports.jpg" width="32" height="32" /></p>
        </td>
        <td  valign="top">
        <p><a href="paymentlist.php">Payments &amp; Refunds- Summary</a></p>
        <p><a href="paymentlist.php">Grant Package Expenditure</a></p>  
        <p>Distribution by Program Area</p></td>
        <td align="center" valign="top">
            <p><img src="images/menuimages/help.png" width="32" height="32" /></p>
        </td>
        <td lign="center" valign="top">
	<p><a target="_blank" href="help/manual.htm">help</a></p></td>
  </tr>
  <tr>
    <td align="center" valign="top"><p><img src="images/menuimages/applicationform.jpg" width="32" height="32" /></p></td>
    <td valign="top" ><p><a href="application.php">New Application</a></p></td>
    <td align="center" valign="top"><p><img src="images/menuimages/package.jpg" width="32" height="32" /></p></td>
    <td valign="top"><p><a href="grant_packagelist.php"> Grant Package</a></p></td>
    <td align="center" valign="top"><p><img src="images/menuimages/changepwd.png" width="32" height="32" /></p></td>
    <td valign="top"><p><a href="changepwd.php">Change Password</a></p></td>
  </tr>
  <tr>
    <td align="center" valign="top"><p><img src="images/menuimages/award.jpg" width="32" /></p></td>
    <td align="center" valign="top"><p><a href="applicantlist.php">Award a Scholarship</a></p></td>
    <td align="center" valign="top"><p><img src="images/menuimages/schoolattendance.jpg" width="32" height="32" /></p></td>
    <td align="center" valign="top"><p><a href="studentlist.php?cmd=resetall">Academics </a></p>
                                       <a href="studentlist.php">Attendance</a></p></td>
    <td align="center" valign="top"><p><img src="images/menuimages/exit.jpg" width="32" height="32" /></p></td>
    <td align="center" valign="top"><p><a href="logout.php">Exit</a></p></td>
  </tr>
</table>
<p>&nbsp;</p>
<?php include "footer.php" ?>

