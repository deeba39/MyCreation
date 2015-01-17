<?php

// Menu
define("EW_MENUBAR_CLASSNAME", "MenuBarVertical", TRUE);
define("EW_MENUBAR_SUBMENU_CLASSNAME", "MenuBarItemSubmenu", TRUE);
?>
<?php

// MenuItem Adding event
function MenuItem_Adding(&$Item) {

	//var_dump($Item);
	// Return FALSE if menu item not allowed

	return TRUE;
}
?>
<!-- Begin Main Menu -->
<div class="phpmaker">
<?php

// Generate all menu items
$RootMenu = new cMenu("RootMenu");
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(7, $Language->MenuPhrase("7", "MenuText"), "programarealist.php", -1, "", AllowListMenu('programarea'));
$RootMenu->AddMenuItem(3, $Language->MenuPhrase("3", "MenuText"), "communitylist.php?cmd=resetall", 7, "", AllowListMenu('community'));
$RootMenu->AddMenuItem(12, $Language->MenuPhrase("12", "MenuText"), "schoolslist.php?cmd=resetall", 7, "", AllowListMenu('schools'));
$RootMenu->AddMenuItem(14, $Language->MenuPhrase("14", "MenuText"), "student_applicantlist.php", -1, "", AllowListMenu('student_applicant'));
$RootMenu->AddMenuItem(46, $Language->MenuPhrase("46", "MenuText"), "student_applicantadd.php", 14, "", IsLoggedIn());
$RootMenu->AddMenuItem(44, $Language->MenuPhrase("44", "MenuText"), "generate_summary.php", 14, "", IsLoggedIn());
$RootMenu->AddMenuItem(42, $Language->MenuPhrase("42", "MenuText"), "SelectionViewlist.php", 14, "", AllowListMenu('SelectionView'));
$RootMenu->AddMenuItem(43, $Language->MenuPhrase("43", "MenuText"), "AppConfirmViewlist.php", 14, "", AllowListMenu('AppConfirmView'));
$RootMenu->AddMenuItem(45, $Language->MenuPhrase("45", "MenuText"), "scholarship_letter.php", 14, "", IsLoggedIn());
$RootMenu->AddMenuItem(13, $Language->MenuPhrase("13", "MenuText"), "studentlist.php", -1, "", AllowListMenu('sponsored_student'));
$RootMenu->AddMenuItem(48, $Language->MenuPhrase("48", "MenuText"), "studentlist.php?cmd=resetall", 13, "", AllowListMenu('sponsored_student_detail'));
$RootMenu->AddMenuItem(52, $Language->MenuPhrase("52", "MenuText"), "studentlist.php", 13, "", AllowListMenu('view_sponsored_student_grade'));
$RootMenu->AddMenuItem(6, $Language->MenuPhrase("6", "MenuText"), "grant_packagelist.php", -1, "", AllowListMenu('grant_package'));
$RootMenu->AddMenuItem(28, $Language->MenuPhrase("28", "MenuText"), "", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(30, $Language->MenuPhrase("30", "MenuText"), "", 28, "", IsLoggedIn());
$RootMenu->AddMenuItem(24, $Language->MenuPhrase("24", "MenuText"), "paymentlist.php", 30, "", AllowListMenu('payment_request'));
$RootMenu->AddMenuItem(29, $Language->MenuPhrase("29", "MenuText"), "New_Payment_Requestslist.php", 30, "", AllowListMenu('New_Payment_Requests'));
$RootMenu->AddMenuItem(32, $Language->MenuPhrase("32", "MenuText"), "Refund_Amountsreport.php", 30, "", AllowListMenu('Refund Amounts'));
$RootMenu->AddMenuItem(35, $Language->MenuPhrase("35", "MenuText"), "Refunds_To_Studentsreport.php", 28, "", AllowListMenu('Refunds To Students'));
$RootMenu->AddMenuItem(36, $Language->MenuPhrase("36", "MenuText"), "Refunds_by_Schoolreport.php", 28, "", AllowListMenu('Refunds by School'));
$RootMenu->AddMenuItem(9, $Language->MenuPhrase("9", "MenuText"), "scholarship_paymentlist.php?cmd=resetall", 28, "", AllowListMenu('scholarship_payment'));
$RootMenu->AddMenuItem(25, $Language->MenuPhrase("25", "MenuText"), "Disburse_Paymentslist.php", 28, "", AllowListMenu('Disburse Payments'));
$RootMenu->AddMenuItem(26, $Language->MenuPhrase("26", "MenuText"), "Payment_Refundlist.php", 28, "", AllowListMenu('Payment Refund'));
$RootMenu->AddMenuItem(27, $Language->MenuPhrase("27", "MenuText"), "Liquidate_Payment_Requestlist.php", 28, "", AllowListMenu('Liquidate Payment Request'));
$RootMenu->AddMenuItem(41, $Language->MenuPhrase("41", "MenuText"), "", 28, "", IsLoggedIn());
$RootMenu->AddMenuItem(37, $Language->MenuPhrase("37", "MenuText"), "financial_yearlist.php", 41, "", AllowListMenu('financial_year'));
$RootMenu->AddMenuItem(17, $Language->MenuPhrase("17", "MenuText"), "", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(11, $Language->MenuPhrase("11", "MenuText"), "school_typelist.php", 17, "", AllowListMenu('school_type'));
$RootMenu->AddMenuItem(1, $Language->MenuPhrase("1", "MenuText"), "applicant_schoollist.php", 17, "", AllowListMenu('applicant_school'));
$RootMenu->AddMenuItem(2, $Language->MenuPhrase("2", "MenuText"), "application_occupationlist.php", 17, "", AllowListMenu('application_occupation'));
$RootMenu->AddMenuItem(15, $Language->MenuPhrase("15", "MenuText"), "districtslist.php", 17, "", AllowListMenu('districts'));
$RootMenu->AddMenuItem(22, $Language->MenuPhrase("22", "MenuText"), "application_statuslist.php", 17, "", AllowListMenu('application_status'));
$RootMenu->AddMenuItem(38, $Language->MenuPhrase("38", "MenuText"), "scholarship_typelist.php", 17, "", AllowListMenu('scholarship_type'));
$RootMenu->AddMenuItem(39, $Language->MenuPhrase("39", "MenuText"), "selection_grade_pointlist.php", 17, "", AllowListMenu('selection_grade_point'));
$RootMenu->AddMenuItem(51, $Language->MenuPhrase("51", "MenuText"), "academic_yearlist.php", 17, "", AllowListMenu('academic_year'));
$RootMenu->AddMenuItem(23, $Language->MenuPhrase("23", "MenuText"), "", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(18, $Language->MenuPhrase("18", "MenuText"), "userslist.php", 23, "", AllowListMenu('users'));
$RootMenu->AddMenuItem(20, $Language->MenuPhrase("20", "MenuText"), "userlevelslist.php", 23, "", (@$_SESSION[EW_SESSION_USER_LEVEL] & EW_ALLOW_ADMIN) == EW_ALLOW_ADMIN);
$RootMenu->AddMenuItem(40, $Language->MenuPhrase("40", "MenuText"), "audittraillist.php", 23, "", AllowListMenu('audittrail'));
$RootMenu->AddMenuItem(-1, $Language->Phrase("Logout"), "logout.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(-1, $Language->Phrase("Login"), "login.php", -1, "", !IsLoggedIn() && substr(@$_SERVER["URL"], -1 * strlen("login.php")) <> "login.php");
$RootMenu->Render();
?>
</div>
<!-- End Main Menu -->
<script type="text/javascript">
<!--

// init the menu
var RootMenu = new Spry.Widget.MenuBar("RootMenu", {imgDown:"images/SpryMenuBarDownHover.gif", imgRight:"images/SpryMenuBarRightHover.gif"});

//-->
</script>
