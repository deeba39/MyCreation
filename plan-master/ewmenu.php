<?php

// Menu
define("EW_MENUBAR_CLASSNAME", "MenuBarHorizontal", TRUE);
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
$RootMenu->AddMenuItem(65, $Language->MenuPhrase("65", "MenuText"), "", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(7, $Language->MenuPhrase("7", "MenuText"), "programarealist.php", 65, "", AllowListMenu('programarea'));
$RootMenu->AddMenuItem(12, $Language->MenuPhrase("12", "MenuText"), "schoolslist.php?cmd=resetall", 65, "", AllowListMenu('schools'));
$RootMenu->AddMenuItem(3, $Language->MenuPhrase("3", "MenuText"), "communitylist.php?cmd=resetall", 65, "", AllowListMenu('community'));
$RootMenu->AddMenuItem(66, $Language->MenuPhrase("66", "MenuText"), "", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(14, $Language->MenuPhrase("14", "MenuText"), "applicantlist.php", 66, "", AllowListMenu('student_applicant'));
$RootMenu->AddMenuItem(102, $Language->MenuPhrase("102", "MenuText"), "reports/planProj/Application_Report_Summarysmry.php", 66, "", AllowListMenu('student_applicant'));
$RootMenu->AddMenuItem(103, $Language->MenuPhrase("103", "MenuText"), "reports/planProj/cview_application_rptrpt.php", 66, "", AllowListMenu('student_applicant'));
$RootMenu->AddMenuItem(45, $Language->MenuPhrase("45", "MenuText"), "scholarship_letter.php", 66, "", IsLoggedIn());
$RootMenu->AddMenuItem(43, $Language->MenuPhrase("43", "MenuText"), "AppConfirmViewlist.php", 66, "", AllowListMenu('AppConfirmView'));
$RootMenu->AddMenuItem(42, $Language->MenuPhrase("42", "MenuText"), "SelectionViewlist.php", 66, "", AllowListMenu('SelectionView'));
$RootMenu->AddMenuItem(44, $Language->MenuPhrase("44", "MenuText"), "generate_summary.php", 66, "", IsLoggedIn());
$RootMenu->AddMenuItem(46, $Language->MenuPhrase("46", "MenuText"), "application.php", 66, "", IsLoggedIn());
$RootMenu->AddMenuItem(67, $Language->MenuPhrase("67", "MenuText"), "", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(13, $Language->MenuPhrase("13", "MenuText"), "studentlist.php", 67, "", AllowListMenu('sponsored_student'));
$RootMenu->AddMenuItem(52, $Language->MenuPhrase("52", "MenuText"), "view_sponsored_student_gradelist.php", 67, "", AllowListMenu('view_sponsored_student_grade'));
$RootMenu->AddMenuItem(48, $Language->MenuPhrase("48", "MenuText"), "sponsored_student_detaillist.php?cmd=resetall", 67, "", AllowListMenu('sponsored_student_detail'));
$RootMenu->AddMenuItem(6, $Language->MenuPhrase("6", "MenuText"), "grant_packagelist.php", -1, "", AllowListMenu('grant_package'));
$RootMenu->AddMenuItem(58, $Language->MenuPhrase("58", "MenuText"), "", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(10, $Language->MenuPhrase("10", "MenuText"), "school_attendancelist.php?cmd=resetall", 58, "", AllowListMenu('school_attendance'));
$RootMenu->AddMenuItem(57, $Language->MenuPhrase("57", "MenuText"), "view_student_academic_recordslist.php", 58, "", AllowListMenu('view_student_academic_records'));
$RootMenu->AddMenuItem(55, $Language->MenuPhrase("55", "MenuText"), "view_school_lists_paymentslist.php", 58, "", AllowListMenu('view_school_lists_payments'));
$RootMenu->AddMenuItem(28, $Language->MenuPhrase("28", "MenuText"), "", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(104, $Language->MenuPhrase("104", "MenuText"), "paymentlist.php", 28, "", AllowListMenu('Payment_Requests'));
$RootMenu->AddMenuItem(29, $Language->MenuPhrase("29", "MenuText"), "New_Payment_Requestslist.php", 28, "", AllowListMenu('New_Payment_Requests'));
$RootMenu->AddMenuItem(25, $Language->MenuPhrase("25", "MenuText"), "Disburse_Paymentslist.php", 28, "", AllowListMenu('Disburse Payments'));
$RootMenu->AddMenuItem(59, $Language->MenuPhrase("59", "MenuText"), "paymentlist.php", 28, "", AllowListMenu('AllPaymentRecords'));
$RootMenu->AddMenuItem(27, $Language->MenuPhrase("27", "MenuText"), "Liquidate_Payment_Requestlist.php", 28, "", AllowListMenu('Liquidate Payment Request'));
$RootMenu->AddMenuItem(60, $Language->MenuPhrase("60", "MenuText"), "view_for_payment_refund_selectionlist.php", 28, "", AllowListMenu('view_for_payment_refund_selection'));
$RootMenu->AddMenuItem(9, $Language->MenuPhrase("9", "MenuText"), "scholarship_paymentlist.php?cmd=resetall", 28, "", AllowListMenu('scholarship_payment'));
$RootMenu->AddMenuItem(26, $Language->MenuPhrase("26", "MenuText"), "Payment_Refundlist.php?cmd=resetall", 28, "", AllowListMenu('Payment Refund'));
$RootMenu->AddMenuItem(41, $Language->MenuPhrase("41", "MenuText"), "", 28, "", IsLoggedIn());
$RootMenu->AddMenuItem(37, $Language->MenuPhrase("37", "MenuText"), "financial_yearlist.php", 41, "", AllowListMenu('financial_year'));
$RootMenu->AddMenuItem(61, $Language->MenuPhrase("61", "MenuText"), "", 28, "", IsLoggedIn());
$RootMenu->AddMenuItem(62, $Language->MenuPhrase("62", "MenuText"), "reports/planProj/Refund_Report_detailedsmry.php", 61, "", IsLoggedIn());
$RootMenu->AddMenuItem(63, $Language->MenuPhrase("63", "MenuText"), "reports/planProj/Refunds_summariessmry.php", 61, "", IsLoggedIn());
$RootMenu->AddMenuItem(64, $Language->MenuPhrase("64", "MenuText"), "reports/planProj/Payments_wBankDetailssmry.php", 61, "", IsLoggedIn());
$RootMenu->AddMenuItem(68, $Language->MenuPhrase("68", "MenuText"), "reports/planProj/Grant_Package_Expenditure_Detailsmry.php", 61, "", IsLoggedIn());
$RootMenu->AddMenuItem(17, $Language->MenuPhrase("17", "MenuText"), "", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(11, $Language->MenuPhrase("11", "MenuText"), "school_typelist.php", 17, "", AllowListMenu('school_type'));
$RootMenu->AddMenuItem(1, $Language->MenuPhrase("1", "MenuText"), "applicant_schoollist.php", 17, "", AllowListMenu('applicant_school'));
$RootMenu->AddMenuItem(2, $Language->MenuPhrase("2", "MenuText"), "application_occupationlist.php", 17, "", AllowListMenu('application_occupation'));
$RootMenu->AddMenuItem(101, $Language->MenuPhrase("101", "MenuText"), "reports/planProj/Report_sponsored_students_programme_unitsmry.php", 67, "", AllowListMenu('sponsored_student'));
$RootMenu->AddMenuItem(15, $Language->MenuPhrase("15", "MenuText"), "districtslist.php", 17, "", AllowListMenu('districts'));
$RootMenu->AddMenuItem(22, $Language->MenuPhrase("22", "MenuText"), "application_statuslist.php", 17, "", AllowListMenu('application_status'));
$RootMenu->AddMenuItem(38, $Language->MenuPhrase("38", "MenuText"), "scholarship_typelist.php", 17, "", AllowListMenu('scholarship_type'));
$RootMenu->AddMenuItem(39, $Language->MenuPhrase("39", "MenuText"), "selection_grade_pointlist.php", 17, "", AllowListMenu('selection_grade_point'));
$RootMenu->AddMenuItem(51, $Language->MenuPhrase("51", "MenuText"), "academic_yearlist.php", 17, "", AllowListMenu('academic_year'));
$RootMenu->AddMenuItem(23, $Language->MenuPhrase("23", "MenuText"), "", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(18, $Language->MenuPhrase("18", "MenuText"), "userslist.php", 23, "", AllowListMenu('users'));
$RootMenu->AddMenuItem(20, $Language->MenuPhrase("20", "MenuText"), "userlevelslist.php", 23, "", (@$_SESSION[EW_SESSION_USER_LEVEL] & EW_ALLOW_ADMIN) == EW_ALLOW_ADMIN);
$RootMenu->AddMenuItem(40, $Language->MenuPhrase("40", "MenuText"), "audittraillist.php", 23, "", AllowListMenu('audittrail'));
$RootMenu->AddMenuItem(-2, $Language->Phrase("ChangePwd"), "changepwd.php", -1, "", IsLoggedIn() && !IsSysAdmin());
$RootMenu->AddMenuItem(-1, $Language->Phrase("Logout"), "logout.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(-1, $Language->Phrase("Login"), "login.php", -1, "", !IsLoggedIn() && substr(@$_SERVER["URL"], -1 * strlen("login.php")) <> "login.php");
$RootMenu->Render();
?>
</div>
<!-- End Main Menu -->
<script type="text/javascript">
<!--

// append space to menu item
function ew_SetupHorizontalMenuLink(a) {
	if (a.innerHTML != "") {
		var c = a.cloneNode(true);
		c.innerHTML += "&nbsp;";
		a.parentNode.replaceChild(c, a);
	} 
}

// make room for the down arrow (horizontal menu only)
ewDom.getElementsByClassName("MenuBarItemSubmenu", "A", ewDom.get("RootMenu"), ew_SetupHorizontalMenuLink); 

// init the menu
var RootMenu = new Spry.Widget.MenuBar("RootMenu", {imgDown:"images/SpryMenuBarDownHover.gif", imgRight:"images/SpryMenuBarRightHover.gif"});

//-->
</script>
