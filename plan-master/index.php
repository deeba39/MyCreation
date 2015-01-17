<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "usersinfo.php" ?>
<?php include "userfn7.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php

// Create page object
$default = new cdefault();
$Page =& $default;

// Page init
$default->Page_Init();

// Page main
$default->Page_Main();
?>
<?php
$default->Page_Terminate();
?>
<?php

//
// Page class
//
class cdefault {

	// Page ID
	var $PageID = 'default';

	// Page object name
	var $PageObjName = 'default';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		return $PageUrl;
	}

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		if (@$_SESSION[EW_SESSION_MESSAGE] <> "") { // Append
			$_SESSION[EW_SESSION_MESSAGE] .= "<br>" . $v;
		} else {
			$_SESSION[EW_SESSION_MESSAGE] = $v;
		}
	}

	// Show message
	function ShowMessage() {
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage);
		if ($sMessage <> "") { // Message in Session, display
			echo "<p><span class=\"ewMessage\">" . $sMessage . "</span></p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}
	}

	// Validate page request
	function IsPageRequest() {
		return TRUE;
	}

	//
	// Page class constructor
	//
	function cdefault() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// User table object (users)
		$GLOBALS["users"] = new cusers;

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'default', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new cTimer();

		// Open connection
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $users;

		// Security
		$Security = new cAdvancedSecurity();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		$this->Page_Redirecting($url);
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}

	//
	// Page main
	//
	function Page_Main() {
		global $Security, $Language;
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		$Security->LoadUserLevel(); // load User Level
		if ($Security->AllowList('programarea'))
		$this->Page_Terminate("programarealist.php"); // Exit and go to default page
		if ($Security->AllowList('sponsored_student'))
			$this->Page_Terminate("sponsored_studentlist.php");
		if ($Security->AllowList('student_applicant'))
			$this->Page_Terminate("student_applicantlist.php");
		if ($Security->AllowList('applicant_school'))
			$this->Page_Terminate("applicant_schoollist.php");
		if ($Security->AllowList('application_occupation'))
			$this->Page_Terminate("application_occupationlist.php");
		if ($Security->AllowList('community'))
			$this->Page_Terminate("communitylist.php");
		if ($Security->AllowList('grade_subject'))
			$this->Page_Terminate("grade_subjectlist.php");
		if ($Security->AllowList('grade_year'))
			$this->Page_Terminate("grade_yearlist.php");
		if ($Security->AllowList('grant_package'))
			$this->Page_Terminate("grant_packagelist.php");
		if ($Security->AllowList('scholarship_package'))
			$this->Page_Terminate("scholarship_packagelist.php");
		if ($Security->AllowList('scholarship_payment'))
			$this->Page_Terminate("scholarship_paymentlist.php");
		if ($Security->AllowList('school_attendance'))
			$this->Page_Terminate("school_attendancelist.php");
		if ($Security->AllowList('school_type'))
			$this->Page_Terminate("school_typelist.php");
		if ($Security->AllowList('schools'))
			$this->Page_Terminate("schoolslist.php");
		if ($Security->AllowList('users'))
			$this->Page_Terminate("userslist.php");
		if ($Security->AllowList('userlevelpermissions'))
			$this->Page_Terminate("userlevelpermissionslist.php");
		if ($Security->AllowList('userlevels'))
			$this->Page_Terminate("userlevelslist.php");
		if ($Security->AllowList('application_status'))
			$this->Page_Terminate("application_statuslist.php");
		if ($Security->AllowList('payment_request'))
			$this->Page_Terminate("payment_requestlist.php");
		if ($Security->AllowList('financial_year'))
			$this->Page_Terminate("financial_yearlist.php");
		if ($Security->AllowList('scholarship_type'))
			$this->Page_Terminate("scholarship_typelist.php");
		if ($Security->AllowList('selection_grade_point'))
			$this->Page_Terminate("selection_grade_pointlist.php");
		if ($Security->AllowList('audittrail'))
			$this->Page_Terminate("audittraillist.php");
		if ($Security->AllowList('Disburse Payments'))
			$this->Page_Terminate("Disburse_Paymentslist.php");
		if ($Security->AllowList('Payment Refund'))
			$this->Page_Terminate("Payment_Refundlist.php");
		if ($Security->AllowList('Liquidate Payment Request'))
			$this->Page_Terminate("Liquidate_Payment_Requestlist.php");
		if ($Security->AllowList('New_Payment_Requests'))
			$this->Page_Terminate("New_Payment_Requestslist.php");
		if ($Security->AllowList('SelectionView'))
			$this->Page_Terminate("SelectionViewlist.php");
		if ($Security->AllowList('AppConfirmView'))
			$this->Page_Terminate("AppConfirmViewlist.php");
		if ($Security->AllowList('sponsored_student_detail'))
			$this->Page_Terminate("sponsored_student_detaillist.php");
		if ($Security->AllowList('Refund Amounts'))
			$this->Page_Terminate("Refund_Amountsreport.php");
		if ($Security->AllowList('Refunds To Students'))
			$this->Page_Terminate("Refunds_To_Studentsreport.php");
		if ($Security->AllowList('Refunds by School'))
			$this->Page_Terminate("Refunds_by_Schoolreport.php");
		if ($Security->IsLoggedIn()) {
			echo $Language->Phrase("NoPermission");
			echo "<br><a href=\"logout.php\">" . $Language->Phrase("BackToLogin") . "</a>";
		} else {
			$this->Page_Terminate("login.php"); // Exit and go to login page
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	function Message_Showing(&$msg) {

		// Example:
		//$msg = "your new message";

	}
}
?>
