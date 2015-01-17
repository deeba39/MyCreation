<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "student_applicantinfo.php" ?>
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
$student_applicant_view = new cstudent_applicant_view();
$Page =& $student_applicant_view;

// Page init
$student_applicant_view->Page_Init();

// Page main
$student_applicant_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($student_applicant->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var student_applicant_view = new ew_Page("student_applicant_view");

// page properties
student_applicant_view.PageID = "view"; // page ID
student_applicant_view.FormID = "fstudent_applicantview"; // form ID
var EW_PAGE_ID = student_applicant_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
student_applicant_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
student_applicant_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
student_applicant_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $student_applicant->TableCaption() ?>
<br><br>
<?php if ($student_applicant->Export == "") { ?>
<a href="<?php echo $student_applicant_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $student_applicant_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $student_applicant_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $student_applicant_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $student_applicant_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$student_applicant_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($student_applicant->student_applicant_id->Visible) { // student_applicant_id ?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->student_applicant_id->FldCaption() ?></td>
		<td<?php echo $student_applicant->student_applicant_id->CellAttributes() ?>>
<div<?php echo $student_applicant->student_applicant_id->ViewAttributes() ?>><?php echo $student_applicant->student_applicant_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($student_applicant->app_submission_year->Visible) { // app_submission_year ?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->app_submission_year->FldCaption() ?></td>
		<td<?php echo $student_applicant->app_submission_year->CellAttributes() ?>>
<div<?php echo $student_applicant->app_submission_year->ViewAttributes() ?>><?php echo $student_applicant->app_submission_year->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($student_applicant->student_resident_programarea_id->Visible) { // student_resident_programarea_id ?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->student_resident_programarea_id->FldCaption() ?></td>
		<td<?php echo $student_applicant->student_resident_programarea_id->CellAttributes() ?>>
<div<?php echo $student_applicant->student_resident_programarea_id->ViewAttributes() ?>><?php echo $student_applicant->student_resident_programarea_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($student_applicant->community_community_id->Visible) { // community_community_id ?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->community_community_id->FldCaption() ?></td>
		<td<?php echo $student_applicant->community_community_id->CellAttributes() ?>>
<div<?php echo $student_applicant->community_community_id->ViewAttributes() ?>><?php echo $student_applicant->community_community_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($student_applicant->app_status->Visible) { // app_status ?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->app_status->FldCaption() ?></td>
		<td<?php echo $student_applicant->app_status->CellAttributes() ?>>
<div<?php echo $student_applicant->app_status->ViewAttributes() ?>><?php echo $student_applicant->app_status->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($student_applicant->app_points->Visible) { // app_points ?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->app_points->FldCaption() ?></td>
		<td<?php echo $student_applicant->app_points->CellAttributes() ?>>
<div<?php echo $student_applicant->app_points->ViewAttributes() ?>><?php echo $student_applicant->app_points->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($student_applicant->app_grant_id->Visible) { // app_grant_id ?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->app_grant_id->FldCaption() ?></td>
		<td<?php echo $student_applicant->app_grant_id->CellAttributes() ?>>
<div<?php echo $student_applicant->app_grant_id->ViewAttributes() ?>><?php echo $student_applicant->app_grant_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($student_applicant->app_amount->Visible) { // app_amount ?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->app_amount->FldCaption() ?></td>
		<td<?php echo $student_applicant->app_amount->CellAttributes() ?>>
<div<?php echo $student_applicant->app_amount->ViewAttributes() ?>><?php echo $student_applicant->app_amount->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($student_applicant->student_firstname->Visible) { // student_firstname ?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->student_firstname->FldCaption() ?></td>
		<td<?php echo $student_applicant->student_firstname->CellAttributes() ?>>
<div<?php echo $student_applicant->student_firstname->ViewAttributes() ?>><?php echo $student_applicant->student_firstname->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($student_applicant->student_middlename->Visible) { // student_middlename ?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->student_middlename->FldCaption() ?></td>
		<td<?php echo $student_applicant->student_middlename->CellAttributes() ?>>
<div<?php echo $student_applicant->student_middlename->ViewAttributes() ?>><?php echo $student_applicant->student_middlename->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($student_applicant->student_lastname->Visible) { // student_lastname ?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->student_lastname->FldCaption() ?></td>
		<td<?php echo $student_applicant->student_lastname->CellAttributes() ?>>
<div<?php echo $student_applicant->student_lastname->ViewAttributes() ?>><?php echo $student_applicant->student_lastname->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($student_applicant->student_gender->Visible) { // student_gender ?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->student_gender->FldCaption() ?></td>
		<td<?php echo $student_applicant->student_gender->CellAttributes() ?>>
<div<?php echo $student_applicant->student_gender->ViewAttributes() ?>><?php echo $student_applicant->student_gender->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($student_applicant->student_dob->Visible) { // student_dob ?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->student_dob->FldCaption() ?></td>
		<td<?php echo $student_applicant->student_dob->CellAttributes() ?>>
<div<?php echo $student_applicant->student_dob->ViewAttributes() ?>><?php echo $student_applicant->student_dob->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($student_applicant->app_mother_name->Visible) { // app_mother_name ?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->app_mother_name->FldCaption() ?></td>
		<td<?php echo $student_applicant->app_mother_name->CellAttributes() ?>>
<div<?php echo $student_applicant->app_mother_name->ViewAttributes() ?>><?php echo $student_applicant->app_mother_name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($student_applicant->app_mother_isalive->Visible) { // app_mother_isalive ?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->app_mother_isalive->FldCaption() ?></td>
		<td<?php echo $student_applicant->app_mother_isalive->CellAttributes() ?>>
<div<?php echo $student_applicant->app_mother_isalive->ViewAttributes() ?>><?php echo $student_applicant->app_mother_isalive->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($student_applicant->app_mother_occupation->Visible) { // app_mother_occupation ?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->app_mother_occupation->FldCaption() ?></td>
		<td<?php echo $student_applicant->app_mother_occupation->CellAttributes() ?>>
<div<?php echo $student_applicant->app_mother_occupation->ViewAttributes() ?>><?php echo $student_applicant->app_mother_occupation->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($student_applicant->app_father_name->Visible) { // app_father_name ?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->app_father_name->FldCaption() ?></td>
		<td<?php echo $student_applicant->app_father_name->CellAttributes() ?>>
<div<?php echo $student_applicant->app_father_name->ViewAttributes() ?>><?php echo $student_applicant->app_father_name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($student_applicant->app_father_occupation->Visible) { // app_father_occupation ?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->app_father_occupation->FldCaption() ?></td>
		<td<?php echo $student_applicant->app_father_occupation->CellAttributes() ?>>
<div<?php echo $student_applicant->app_father_occupation->ViewAttributes() ?>><?php echo $student_applicant->app_father_occupation->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($student_applicant->app_father_isalive->Visible) { // app_father_isalive ?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->app_father_isalive->FldCaption() ?></td>
		<td<?php echo $student_applicant->app_father_isalive->CellAttributes() ?>>
<div<?php echo $student_applicant->app_father_isalive->ViewAttributes() ?>><?php echo $student_applicant->app_father_isalive->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($student_applicant->student_picture->Visible) { // student_picture ?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->student_picture->FldCaption() ?></td>
		<td<?php echo $student_applicant->student_picture->CellAttributes() ?>>
<?php if ($student_applicant->student_picture->HrefValue <> "" || $student_applicant->student_picture->TooltipValue <> "") { ?>
<?php if (!empty($student_applicant->student_picture->Upload->DbValue)) { ?>
<a href="<?php echo $student_applicant->student_picture->HrefValue ?>"><?php echo $student_applicant->student_picture->ViewValue ?></a>
<?php } elseif (!in_array($student_applicant->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($student_applicant->student_picture->Upload->DbValue)) { ?>
<?php echo $student_applicant->student_picture->ViewValue ?>
<?php } elseif (!in_array($student_applicant->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($student_applicant->app_guardian_name->Visible) { // app_guardian_name ?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->app_guardian_name->FldCaption() ?></td>
		<td<?php echo $student_applicant->app_guardian_name->CellAttributes() ?>>
<div<?php echo $student_applicant->app_guardian_name->ViewAttributes() ?>><?php echo $student_applicant->app_guardian_name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($student_applicant->app_guardian_relation->Visible) { // app_guardian_relation ?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->app_guardian_relation->FldCaption() ?></td>
		<td<?php echo $student_applicant->app_guardian_relation->CellAttributes() ?>>
<div<?php echo $student_applicant->app_guardian_relation->ViewAttributes() ?>><?php echo $student_applicant->app_guardian_relation->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($student_applicant->app_guardian_occupation->Visible) { // app_guardian_occupation ?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->app_guardian_occupation->FldCaption() ?></td>
		<td<?php echo $student_applicant->app_guardian_occupation->CellAttributes() ?>>
<div<?php echo $student_applicant->app_guardian_occupation->ViewAttributes() ?>><?php echo $student_applicant->app_guardian_occupation->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($student_applicant->app_referees->Visible) { // app_referees ?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->app_referees->FldCaption() ?></td>
		<td<?php echo $student_applicant->app_referees->CellAttributes() ?>>
<div<?php echo $student_applicant->app_referees->ViewAttributes() ?>><?php echo $student_applicant->app_referees->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($student_applicant->sponsored_child_no->Visible) { // sponsored_child_no ?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->sponsored_child_no->FldCaption() ?></td>
		<td<?php echo $student_applicant->sponsored_child_no->CellAttributes() ?>>
<div<?php echo $student_applicant->sponsored_child_no->ViewAttributes() ?>><?php echo $student_applicant->sponsored_child_no->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($student_applicant->student_grades->Visible) { // student_grades ?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->student_grades->FldCaption() ?></td>
		<td<?php echo $student_applicant->student_grades->CellAttributes() ?>>
<div<?php echo $student_applicant->student_grades->ViewAttributes() ?>><?php echo $student_applicant->student_grades->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($student_applicant->student_address->Visible) { // student_address ?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->student_address->FldCaption() ?></td>
		<td<?php echo $student_applicant->student_address->CellAttributes() ?>>
<div<?php echo $student_applicant->student_address->ViewAttributes() ?>><?php echo $student_applicant->student_address->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($student_applicant->student_telephone_1->Visible) { // student_telephone_1 ?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->student_telephone_1->FldCaption() ?></td>
		<td<?php echo $student_applicant->student_telephone_1->CellAttributes() ?>>
<div<?php echo $student_applicant->student_telephone_1->ViewAttributes() ?>><?php echo $student_applicant->student_telephone_1->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($student_applicant->student_telephone_2->Visible) { // student_telephone_2 ?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->student_telephone_2->FldCaption() ?></td>
		<td<?php echo $student_applicant->student_telephone_2->CellAttributes() ?>>
<div<?php echo $student_applicant->student_telephone_2->ViewAttributes() ?>><?php echo $student_applicant->student_telephone_2->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($student_applicant->student_admitted_school_id->Visible) { // student_admitted_school_id ?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->student_admitted_school_id->FldCaption() ?></td>
		<td<?php echo $student_applicant->student_admitted_school_id->CellAttributes() ?>>
<div<?php echo $student_applicant->student_admitted_school_id->ViewAttributes() ?>><?php echo $student_applicant->student_admitted_school_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($student_applicant->app_primary_school_id->Visible) { // app_primary_school_id ?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->app_primary_school_id->FldCaption() ?></td>
		<td<?php echo $student_applicant->app_primary_school_id->CellAttributes() ?>>
<div<?php echo $student_applicant->app_primary_school_id->ViewAttributes() ?>><?php echo $student_applicant->app_primary_school_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($student_applicant->app_junior_secondary_id->Visible) { // app_junior_secondary_id ?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->app_junior_secondary_id->FldCaption() ?></td>
		<td<?php echo $student_applicant->app_junior_secondary_id->CellAttributes() ?>>
<div<?php echo $student_applicant->app_junior_secondary_id->ViewAttributes() ?>><?php echo $student_applicant->app_junior_secondary_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($student_applicant->app_scanneddocument->Visible) { // app_scanneddocument ?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->app_scanneddocument->FldCaption() ?></td>
		<td<?php echo $student_applicant->app_scanneddocument->CellAttributes() ?>>
<?php if ($student_applicant->app_scanneddocument->HrefValue <> "" || $student_applicant->app_scanneddocument->TooltipValue <> "") { ?>
<?php if (!empty($student_applicant->app_scanneddocument->Upload->DbValue)) { ?>
<a href="<?php echo $student_applicant->app_scanneddocument->HrefValue ?>"><?php echo $student_applicant->app_scanneddocument->ViewValue ?></a>
<?php } elseif (!in_array($student_applicant->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($student_applicant->app_scanneddocument->Upload->DbValue)) { ?>
<?php echo $student_applicant->app_scanneddocument->ViewValue ?>
<?php } elseif (!in_array($student_applicant->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($student_applicant->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$student_applicant_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cstudent_applicant_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'student_applicant';

	// Page object name
	var $PageObjName = 'student_applicant_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $student_applicant;
		if ($student_applicant->UseTokenInUrl) $PageUrl .= "t=" . $student_applicant->TableVar . "&"; // Add page token
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
		global $objForm, $student_applicant;
		if ($student_applicant->UseTokenInUrl) {
			if ($objForm)
				return ($student_applicant->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($student_applicant->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cstudent_applicant_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (student_applicant)
		$GLOBALS["student_applicant"] = new cstudent_applicant();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'student_applicant', TRUE);

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
		global $student_applicant;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		$Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->TableName);
		$Security->TablePermission_Loaded();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		if (!$Security->CanView()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("student_applicantlist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();

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
	var $lDisplayRecs = 1;
	var $lStartRec;
	var $lStopRec;
	var $lTotalRecs = 0;
	var $lRecRange = 10;
	var $lRecCnt;
	var $arRecKey = array();

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $student_applicant;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["student_applicant_id"] <> "") {
				$student_applicant->student_applicant_id->setQueryStringValue($_GET["student_applicant_id"]);
				$this->arRecKey["student_applicant_id"] = $student_applicant->student_applicant_id->QueryStringValue;
			} else {
				$sReturnUrl = "student_applicantlist.php"; // Return to list
			}

			// Get action
			$student_applicant->CurrentAction = "I"; // Display form
			switch ($student_applicant->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "student_applicantlist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "student_applicantlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$student_applicant->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $student_applicant;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$student_applicant->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$student_applicant->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $student_applicant->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$student_applicant->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$student_applicant->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$student_applicant->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $student_applicant;
		$sFilter = $student_applicant->KeyFilter();

		// Call Row Selecting event
		$student_applicant->Row_Selecting($sFilter);

		// Load SQL based on filter
		$student_applicant->CurrentFilter = $sFilter;
		$sSql = $student_applicant->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$student_applicant->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $student_applicant;
		$student_applicant->student_applicant_id->setDbValue($rs->fields('student_applicant_id'));
		$student_applicant->app_submission_year->setDbValue($rs->fields('app_submission_year'));
		$student_applicant->student_resident_programarea_id->setDbValue($rs->fields('student_resident_programarea_id'));
		$student_applicant->community_community_id->setDbValue($rs->fields('community_community_id'));
		$student_applicant->app_status->setDbValue($rs->fields('app_status'));
		$student_applicant->app_points->setDbValue($rs->fields('app_points'));
		$student_applicant->app_grant_id->setDbValue($rs->fields('app_grant_id'));
		$student_applicant->app_amount->setDbValue($rs->fields('app_amount'));
		$student_applicant->student_firstname->setDbValue($rs->fields('student_firstname'));
		$student_applicant->student_middlename->setDbValue($rs->fields('student_middlename'));
		$student_applicant->student_lastname->setDbValue($rs->fields('student_lastname'));
		$student_applicant->student_gender->setDbValue($rs->fields('student_gender'));
		$student_applicant->student_dob->setDbValue($rs->fields('student_dob'));
		$student_applicant->app_mother_name->setDbValue($rs->fields('app_mother_name'));
		$student_applicant->app_mother_isalive->setDbValue($rs->fields('app_mother_isalive'));
		$student_applicant->app_mother_occupation->setDbValue($rs->fields('app_mother_occupation'));
		$student_applicant->app_father_name->setDbValue($rs->fields('app_father_name'));
		$student_applicant->app_father_occupation->setDbValue($rs->fields('app_father_occupation'));
		$student_applicant->app_father_isalive->setDbValue($rs->fields('app_father_isalive'));
		$student_applicant->student_picture->Upload->DbValue = $rs->fields('student_picture');
		$student_applicant->app_guardian_name->setDbValue($rs->fields('app_guardian_name'));
		$student_applicant->app_guardian_relation->setDbValue($rs->fields('app_guardian_relation'));
		$student_applicant->app_guardian_occupation->setDbValue($rs->fields('app_guardian_occupation'));
		$student_applicant->app_referees->setDbValue($rs->fields('app_referees'));
		$student_applicant->sponsored_child_no->setDbValue($rs->fields('sponsored_child_no'));
		$student_applicant->student_grades->setDbValue($rs->fields('student_grades'));
		$student_applicant->student_address->setDbValue($rs->fields('student_address'));
		$student_applicant->student_telephone_1->setDbValue($rs->fields('student_telephone_1'));
		$student_applicant->student_telephone_2->setDbValue($rs->fields('student_telephone_2'));
		$student_applicant->student_admitted_school_id->setDbValue($rs->fields('student_admitted_school_id'));
		$student_applicant->app_primary_school_id->setDbValue($rs->fields('app_primary_school_id'));
		$student_applicant->app_junior_secondary_id->setDbValue($rs->fields('app_junior_secondary_id'));
		$student_applicant->app_scanneddocument->Upload->DbValue = $rs->fields('app_scanneddocument');
		$student_applicant->group_id->setDbValue($rs->fields('group_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $student_applicant;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "student_applicant_id=" . urlencode($student_applicant->student_applicant_id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "student_applicant_id=" . urlencode($student_applicant->student_applicant_id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "student_applicant_id=" . urlencode($student_applicant->student_applicant_id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "student_applicant_id=" . urlencode($student_applicant->student_applicant_id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "student_applicant_id=" . urlencode($student_applicant->student_applicant_id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "student_applicant_id=" . urlencode($student_applicant->student_applicant_id->CurrentValue);
		$this->AddUrl = $student_applicant->AddUrl();
		$this->EditUrl = $student_applicant->EditUrl();
		$this->CopyUrl = $student_applicant->CopyUrl();
		$this->DeleteUrl = $student_applicant->DeleteUrl();
		$this->ListUrl = $student_applicant->ListUrl();

		// Call Row_Rendering event
		$student_applicant->Row_Rendering();

		// Common render codes for all row types
		// student_applicant_id

		$student_applicant->student_applicant_id->CellCssStyle = ""; $student_applicant->student_applicant_id->CellCssClass = "";
		$student_applicant->student_applicant_id->CellAttrs = array(); $student_applicant->student_applicant_id->ViewAttrs = array(); $student_applicant->student_applicant_id->EditAttrs = array();

		// app_submission_year
		$student_applicant->app_submission_year->CellCssStyle = ""; $student_applicant->app_submission_year->CellCssClass = "";
		$student_applicant->app_submission_year->CellAttrs = array(); $student_applicant->app_submission_year->ViewAttrs = array(); $student_applicant->app_submission_year->EditAttrs = array();

		// student_resident_programarea_id
		$student_applicant->student_resident_programarea_id->CellCssStyle = ""; $student_applicant->student_resident_programarea_id->CellCssClass = "";
		$student_applicant->student_resident_programarea_id->CellAttrs = array(); $student_applicant->student_resident_programarea_id->ViewAttrs = array(); $student_applicant->student_resident_programarea_id->EditAttrs = array();

		// community_community_id
		$student_applicant->community_community_id->CellCssStyle = ""; $student_applicant->community_community_id->CellCssClass = "";
		$student_applicant->community_community_id->CellAttrs = array(); $student_applicant->community_community_id->ViewAttrs = array(); $student_applicant->community_community_id->EditAttrs = array();

		// app_status
		$student_applicant->app_status->CellCssStyle = ""; $student_applicant->app_status->CellCssClass = "";
		$student_applicant->app_status->CellAttrs = array(); $student_applicant->app_status->ViewAttrs = array(); $student_applicant->app_status->EditAttrs = array();

		// app_points
		$student_applicant->app_points->CellCssStyle = ""; $student_applicant->app_points->CellCssClass = "";
		$student_applicant->app_points->CellAttrs = array(); $student_applicant->app_points->ViewAttrs = array(); $student_applicant->app_points->EditAttrs = array();

		// app_grant_id
		$student_applicant->app_grant_id->CellCssStyle = ""; $student_applicant->app_grant_id->CellCssClass = "";
		$student_applicant->app_grant_id->CellAttrs = array(); $student_applicant->app_grant_id->ViewAttrs = array(); $student_applicant->app_grant_id->EditAttrs = array();

		// app_amount
		$student_applicant->app_amount->CellCssStyle = ""; $student_applicant->app_amount->CellCssClass = "";
		$student_applicant->app_amount->CellAttrs = array(); $student_applicant->app_amount->ViewAttrs = array(); $student_applicant->app_amount->EditAttrs = array();

		// student_firstname
		$student_applicant->student_firstname->CellCssStyle = ""; $student_applicant->student_firstname->CellCssClass = "";
		$student_applicant->student_firstname->CellAttrs = array(); $student_applicant->student_firstname->ViewAttrs = array(); $student_applicant->student_firstname->EditAttrs = array();

		// student_middlename
		$student_applicant->student_middlename->CellCssStyle = ""; $student_applicant->student_middlename->CellCssClass = "";
		$student_applicant->student_middlename->CellAttrs = array(); $student_applicant->student_middlename->ViewAttrs = array(); $student_applicant->student_middlename->EditAttrs = array();

		// student_lastname
		$student_applicant->student_lastname->CellCssStyle = ""; $student_applicant->student_lastname->CellCssClass = "";
		$student_applicant->student_lastname->CellAttrs = array(); $student_applicant->student_lastname->ViewAttrs = array(); $student_applicant->student_lastname->EditAttrs = array();

		// student_gender
		$student_applicant->student_gender->CellCssStyle = ""; $student_applicant->student_gender->CellCssClass = "";
		$student_applicant->student_gender->CellAttrs = array(); $student_applicant->student_gender->ViewAttrs = array(); $student_applicant->student_gender->EditAttrs = array();

		// student_dob
		$student_applicant->student_dob->CellCssStyle = ""; $student_applicant->student_dob->CellCssClass = "";
		$student_applicant->student_dob->CellAttrs = array(); $student_applicant->student_dob->ViewAttrs = array(); $student_applicant->student_dob->EditAttrs = array();

		// app_mother_name
		$student_applicant->app_mother_name->CellCssStyle = ""; $student_applicant->app_mother_name->CellCssClass = "";
		$student_applicant->app_mother_name->CellAttrs = array(); $student_applicant->app_mother_name->ViewAttrs = array(); $student_applicant->app_mother_name->EditAttrs = array();

		// app_mother_isalive
		$student_applicant->app_mother_isalive->CellCssStyle = ""; $student_applicant->app_mother_isalive->CellCssClass = "";
		$student_applicant->app_mother_isalive->CellAttrs = array(); $student_applicant->app_mother_isalive->ViewAttrs = array(); $student_applicant->app_mother_isalive->EditAttrs = array();

		// app_mother_occupation
		$student_applicant->app_mother_occupation->CellCssStyle = ""; $student_applicant->app_mother_occupation->CellCssClass = "";
		$student_applicant->app_mother_occupation->CellAttrs = array(); $student_applicant->app_mother_occupation->ViewAttrs = array(); $student_applicant->app_mother_occupation->EditAttrs = array();

		// app_father_name
		$student_applicant->app_father_name->CellCssStyle = ""; $student_applicant->app_father_name->CellCssClass = "";
		$student_applicant->app_father_name->CellAttrs = array(); $student_applicant->app_father_name->ViewAttrs = array(); $student_applicant->app_father_name->EditAttrs = array();

		// app_father_occupation
		$student_applicant->app_father_occupation->CellCssStyle = ""; $student_applicant->app_father_occupation->CellCssClass = "";
		$student_applicant->app_father_occupation->CellAttrs = array(); $student_applicant->app_father_occupation->ViewAttrs = array(); $student_applicant->app_father_occupation->EditAttrs = array();

		// app_father_isalive
		$student_applicant->app_father_isalive->CellCssStyle = ""; $student_applicant->app_father_isalive->CellCssClass = "";
		$student_applicant->app_father_isalive->CellAttrs = array(); $student_applicant->app_father_isalive->ViewAttrs = array(); $student_applicant->app_father_isalive->EditAttrs = array();

		// student_picture
		$student_applicant->student_picture->CellCssStyle = ""; $student_applicant->student_picture->CellCssClass = "";
		$student_applicant->student_picture->CellAttrs = array(); $student_applicant->student_picture->ViewAttrs = array(); $student_applicant->student_picture->EditAttrs = array();

		// app_guardian_name
		$student_applicant->app_guardian_name->CellCssStyle = ""; $student_applicant->app_guardian_name->CellCssClass = "";
		$student_applicant->app_guardian_name->CellAttrs = array(); $student_applicant->app_guardian_name->ViewAttrs = array(); $student_applicant->app_guardian_name->EditAttrs = array();

		// app_guardian_relation
		$student_applicant->app_guardian_relation->CellCssStyle = ""; $student_applicant->app_guardian_relation->CellCssClass = "";
		$student_applicant->app_guardian_relation->CellAttrs = array(); $student_applicant->app_guardian_relation->ViewAttrs = array(); $student_applicant->app_guardian_relation->EditAttrs = array();

		// app_guardian_occupation
		$student_applicant->app_guardian_occupation->CellCssStyle = ""; $student_applicant->app_guardian_occupation->CellCssClass = "";
		$student_applicant->app_guardian_occupation->CellAttrs = array(); $student_applicant->app_guardian_occupation->ViewAttrs = array(); $student_applicant->app_guardian_occupation->EditAttrs = array();

		// app_referees
		$student_applicant->app_referees->CellCssStyle = ""; $student_applicant->app_referees->CellCssClass = "";
		$student_applicant->app_referees->CellAttrs = array(); $student_applicant->app_referees->ViewAttrs = array(); $student_applicant->app_referees->EditAttrs = array();

		// sponsored_child_no
		$student_applicant->sponsored_child_no->CellCssStyle = ""; $student_applicant->sponsored_child_no->CellCssClass = "";
		$student_applicant->sponsored_child_no->CellAttrs = array(); $student_applicant->sponsored_child_no->ViewAttrs = array(); $student_applicant->sponsored_child_no->EditAttrs = array();

		// student_grades
		$student_applicant->student_grades->CellCssStyle = ""; $student_applicant->student_grades->CellCssClass = "";
		$student_applicant->student_grades->CellAttrs = array(); $student_applicant->student_grades->ViewAttrs = array(); $student_applicant->student_grades->EditAttrs = array();

		// student_address
		$student_applicant->student_address->CellCssStyle = ""; $student_applicant->student_address->CellCssClass = "";
		$student_applicant->student_address->CellAttrs = array(); $student_applicant->student_address->ViewAttrs = array(); $student_applicant->student_address->EditAttrs = array();

		// student_telephone_1
		$student_applicant->student_telephone_1->CellCssStyle = ""; $student_applicant->student_telephone_1->CellCssClass = "";
		$student_applicant->student_telephone_1->CellAttrs = array(); $student_applicant->student_telephone_1->ViewAttrs = array(); $student_applicant->student_telephone_1->EditAttrs = array();

		// student_telephone_2
		$student_applicant->student_telephone_2->CellCssStyle = ""; $student_applicant->student_telephone_2->CellCssClass = "";
		$student_applicant->student_telephone_2->CellAttrs = array(); $student_applicant->student_telephone_2->ViewAttrs = array(); $student_applicant->student_telephone_2->EditAttrs = array();

		// student_admitted_school_id
		$student_applicant->student_admitted_school_id->CellCssStyle = ""; $student_applicant->student_admitted_school_id->CellCssClass = "";
		$student_applicant->student_admitted_school_id->CellAttrs = array(); $student_applicant->student_admitted_school_id->ViewAttrs = array(); $student_applicant->student_admitted_school_id->EditAttrs = array();

		// app_primary_school_id
		$student_applicant->app_primary_school_id->CellCssStyle = ""; $student_applicant->app_primary_school_id->CellCssClass = "";
		$student_applicant->app_primary_school_id->CellAttrs = array(); $student_applicant->app_primary_school_id->ViewAttrs = array(); $student_applicant->app_primary_school_id->EditAttrs = array();

		// app_junior_secondary_id
		$student_applicant->app_junior_secondary_id->CellCssStyle = ""; $student_applicant->app_junior_secondary_id->CellCssClass = "";
		$student_applicant->app_junior_secondary_id->CellAttrs = array(); $student_applicant->app_junior_secondary_id->ViewAttrs = array(); $student_applicant->app_junior_secondary_id->EditAttrs = array();

		// app_scanneddocument
		$student_applicant->app_scanneddocument->CellCssStyle = ""; $student_applicant->app_scanneddocument->CellCssClass = "";
		$student_applicant->app_scanneddocument->CellAttrs = array(); $student_applicant->app_scanneddocument->ViewAttrs = array(); $student_applicant->app_scanneddocument->EditAttrs = array();
		if ($student_applicant->RowType == EW_ROWTYPE_VIEW) { // View row

			// student_applicant_id
			$student_applicant->student_applicant_id->ViewValue = $student_applicant->student_applicant_id->CurrentValue;
			$student_applicant->student_applicant_id->CssStyle = "";
			$student_applicant->student_applicant_id->CssClass = "";
			$student_applicant->student_applicant_id->ViewCustomAttributes = "";

			// app_submission_year
			$student_applicant->app_submission_year->ViewValue = $student_applicant->app_submission_year->CurrentValue;
			if (strval($student_applicant->app_submission_year->CurrentValue) <> "") {
				$sFilterWrk = "`app_year` = " . ew_AdjustSql($student_applicant->app_submission_year->CurrentValue) . "";
			$sSqlWrk = "SELECT `app_year` FROM `academic_year`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "active='ACTIVE'" . ")";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `app_year` Desc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->app_submission_year->ViewValue = $rswrk->fields('app_year');
					$rswrk->Close();
				} else {
					$student_applicant->app_submission_year->ViewValue = $student_applicant->app_submission_year->CurrentValue;
				}
			} else {
				$student_applicant->app_submission_year->ViewValue = NULL;
			}
			$student_applicant->app_submission_year->CssStyle = "";
			$student_applicant->app_submission_year->CssClass = "";
			$student_applicant->app_submission_year->ViewCustomAttributes = "";

			// student_resident_programarea_id
			if (strval($student_applicant->student_resident_programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($student_applicant->student_resident_programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->student_resident_programarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$student_applicant->student_resident_programarea_id->ViewValue = $student_applicant->student_resident_programarea_id->CurrentValue;
				}
			} else {
				$student_applicant->student_resident_programarea_id->ViewValue = NULL;
			}
			$student_applicant->student_resident_programarea_id->CssStyle = "";
			$student_applicant->student_resident_programarea_id->CssClass = "";
			$student_applicant->student_resident_programarea_id->ViewCustomAttributes = "";

			// community_community_id
			if (strval($student_applicant->community_community_id->CurrentValue) <> "") {
				$sFilterWrk = "`community_id` = " . ew_AdjustSql($student_applicant->community_community_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `community` FROM `community`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->community_community_id->ViewValue = $rswrk->fields('community');
					$rswrk->Close();
				} else {
					$student_applicant->community_community_id->ViewValue = $student_applicant->community_community_id->CurrentValue;
				}
			} else {
				$student_applicant->community_community_id->ViewValue = NULL;
			}
			$student_applicant->community_community_id->CssStyle = "";
			$student_applicant->community_community_id->CssClass = "";
			$student_applicant->community_community_id->ViewCustomAttributes = "";

			// app_status
			$student_applicant->app_status->ViewValue = $student_applicant->app_status->CurrentValue;
			if (strval($student_applicant->app_status->CurrentValue) <> "") {
				$sFilterWrk = "`application_status_id` = " . ew_AdjustSql($student_applicant->app_status->CurrentValue) . "";
			$sSqlWrk = "SELECT `application_status` FROM `application_status`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->app_status->ViewValue = $rswrk->fields('application_status');
					$rswrk->Close();
				} else {
					$student_applicant->app_status->ViewValue = $student_applicant->app_status->CurrentValue;
				}
			} else {
				$student_applicant->app_status->ViewValue = NULL;
			}
			$student_applicant->app_status->CssStyle = "";
			$student_applicant->app_status->CssClass = "";
			$student_applicant->app_status->ViewCustomAttributes = "";

			// app_points
			$student_applicant->app_points->ViewValue = $student_applicant->app_points->CurrentValue;
			$student_applicant->app_points->CssStyle = "";
			$student_applicant->app_points->CssClass = "";
			$student_applicant->app_points->ViewCustomAttributes = "";

			// app_grant_id
			$student_applicant->app_grant_id->ViewValue = $student_applicant->app_grant_id->CurrentValue;
			if (strval($student_applicant->app_grant_id->CurrentValue) <> "") {
				$sFilterWrk = "`grant_package_id` = " . ew_AdjustSql($student_applicant->app_grant_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `name` FROM `grant_package`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->app_grant_id->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$student_applicant->app_grant_id->ViewValue = $student_applicant->app_grant_id->CurrentValue;
				}
			} else {
				$student_applicant->app_grant_id->ViewValue = NULL;
			}
			$student_applicant->app_grant_id->CssStyle = "";
			$student_applicant->app_grant_id->CssClass = "";
			$student_applicant->app_grant_id->ViewCustomAttributes = "";

			// app_amount
			$student_applicant->app_amount->ViewValue = $student_applicant->app_amount->CurrentValue;
			$student_applicant->app_amount->CssStyle = "";
			$student_applicant->app_amount->CssClass = "";
			$student_applicant->app_amount->ViewCustomAttributes = "";

			// student_firstname
			$student_applicant->student_firstname->ViewValue = $student_applicant->student_firstname->CurrentValue;
			$student_applicant->student_firstname->CssStyle = "";
			$student_applicant->student_firstname->CssClass = "";
			$student_applicant->student_firstname->ViewCustomAttributes = "";

			// student_middlename
			$student_applicant->student_middlename->ViewValue = $student_applicant->student_middlename->CurrentValue;
			$student_applicant->student_middlename->CssStyle = "";
			$student_applicant->student_middlename->CssClass = "";
			$student_applicant->student_middlename->ViewCustomAttributes = "";

			// student_lastname
			$student_applicant->student_lastname->ViewValue = $student_applicant->student_lastname->CurrentValue;
			$student_applicant->student_lastname->CssStyle = "";
			$student_applicant->student_lastname->CssClass = "";
			$student_applicant->student_lastname->ViewCustomAttributes = "";

			// student_gender
			if (strval($student_applicant->student_gender->CurrentValue) <> "") {
				switch ($student_applicant->student_gender->CurrentValue) {
					case "M":
						$student_applicant->student_gender->ViewValue = "Male";
						break;
					case "F":
						$student_applicant->student_gender->ViewValue = "Female";
						break;
					default:
						$student_applicant->student_gender->ViewValue = $student_applicant->student_gender->CurrentValue;
				}
			} else {
				$student_applicant->student_gender->ViewValue = NULL;
			}
			$student_applicant->student_gender->CssStyle = "";
			$student_applicant->student_gender->CssClass = "";
			$student_applicant->student_gender->ViewCustomAttributes = "";

			// student_dob
			$student_applicant->student_dob->ViewValue = $student_applicant->student_dob->CurrentValue;
			$student_applicant->student_dob->ViewValue = ew_FormatDateTime($student_applicant->student_dob->ViewValue, 7);
			$student_applicant->student_dob->CssStyle = "";
			$student_applicant->student_dob->CssClass = "";
			$student_applicant->student_dob->ViewCustomAttributes = "";

			// app_mother_name
			$student_applicant->app_mother_name->ViewValue = $student_applicant->app_mother_name->CurrentValue;
			$student_applicant->app_mother_name->CssStyle = "";
			$student_applicant->app_mother_name->CssClass = "";
			$student_applicant->app_mother_name->ViewCustomAttributes = "";

			// app_mother_isalive
			if (strval($student_applicant->app_mother_isalive->CurrentValue) <> "") {
				switch ($student_applicant->app_mother_isalive->CurrentValue) {
					case "1":
						$student_applicant->app_mother_isalive->ViewValue = "Alive";
						break;
					case "0":
						$student_applicant->app_mother_isalive->ViewValue = "Deceased";
						break;
					default:
						$student_applicant->app_mother_isalive->ViewValue = $student_applicant->app_mother_isalive->CurrentValue;
				}
			} else {
				$student_applicant->app_mother_isalive->ViewValue = NULL;
			}
			$student_applicant->app_mother_isalive->CssStyle = "";
			$student_applicant->app_mother_isalive->CssClass = "";
			$student_applicant->app_mother_isalive->ViewCustomAttributes = "";

			// app_mother_occupation
			if (strval($student_applicant->app_mother_occupation->CurrentValue) <> "") {
				$sFilterWrk = "`application_occupation_id` = " . ew_AdjustSql($student_applicant->app_mother_occupation->CurrentValue) . "";
			$sSqlWrk = "SELECT `name` FROM `application_occupation`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->app_mother_occupation->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$student_applicant->app_mother_occupation->ViewValue = $student_applicant->app_mother_occupation->CurrentValue;
				}
			} else {
				$student_applicant->app_mother_occupation->ViewValue = NULL;
			}
			$student_applicant->app_mother_occupation->CssStyle = "";
			$student_applicant->app_mother_occupation->CssClass = "";
			$student_applicant->app_mother_occupation->ViewCustomAttributes = "";

			// app_father_name
			$student_applicant->app_father_name->ViewValue = $student_applicant->app_father_name->CurrentValue;
			$student_applicant->app_father_name->CssStyle = "";
			$student_applicant->app_father_name->CssClass = "";
			$student_applicant->app_father_name->ViewCustomAttributes = "";

			// app_father_occupation
			if (strval($student_applicant->app_father_occupation->CurrentValue) <> "") {
				$sFilterWrk = "`application_occupation_id` = " . ew_AdjustSql($student_applicant->app_father_occupation->CurrentValue) . "";
			$sSqlWrk = "SELECT `name` FROM `application_occupation`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->app_father_occupation->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$student_applicant->app_father_occupation->ViewValue = $student_applicant->app_father_occupation->CurrentValue;
				}
			} else {
				$student_applicant->app_father_occupation->ViewValue = NULL;
			}
			$student_applicant->app_father_occupation->CssStyle = "";
			$student_applicant->app_father_occupation->CssClass = "";
			$student_applicant->app_father_occupation->ViewCustomAttributes = "";

			// app_father_isalive
			if (strval($student_applicant->app_father_isalive->CurrentValue) <> "") {
				switch ($student_applicant->app_father_isalive->CurrentValue) {
					case "1":
						$student_applicant->app_father_isalive->ViewValue = "Alive";
						break;
					case "0":
						$student_applicant->app_father_isalive->ViewValue = "Deceased";
						break;
					default:
						$student_applicant->app_father_isalive->ViewValue = $student_applicant->app_father_isalive->CurrentValue;
				}
			} else {
				$student_applicant->app_father_isalive->ViewValue = NULL;
			}
			$student_applicant->app_father_isalive->CssStyle = "";
			$student_applicant->app_father_isalive->CssClass = "";
			$student_applicant->app_father_isalive->ViewCustomAttributes = "";

			// student_picture
			if (!ew_Empty($student_applicant->student_picture->Upload->DbValue)) {
				$student_applicant->student_picture->ViewValue = $student_applicant->student_picture->Upload->DbValue;
			} else {
				$student_applicant->student_picture->ViewValue = "";
			}
			$student_applicant->student_picture->CssStyle = "";
			$student_applicant->student_picture->CssClass = "";
			$student_applicant->student_picture->ViewCustomAttributes = "";

			// app_guardian_name
			$student_applicant->app_guardian_name->ViewValue = $student_applicant->app_guardian_name->CurrentValue;
			$student_applicant->app_guardian_name->CssStyle = "";
			$student_applicant->app_guardian_name->CssClass = "";
			$student_applicant->app_guardian_name->ViewCustomAttributes = "";

			// app_guardian_relation
			if (strval($student_applicant->app_guardian_relation->CurrentValue) <> "") {
				switch ($student_applicant->app_guardian_relation->CurrentValue) {
					case "NA":
						$student_applicant->app_guardian_relation->ViewValue = "not applicable";
						break;
					case "grandparent":
						$student_applicant->app_guardian_relation->ViewValue = "grandparent";
						break;
					case "grandparent":
						$student_applicant->app_guardian_relation->ViewValue = "grandparent";
						break;
					case "aunt":
						$student_applicant->app_guardian_relation->ViewValue = "aunt";
						break;
					case "sibling":
						$student_applicant->app_guardian_relation->ViewValue = "sibling";
						break;
					case "cousin":
						$student_applicant->app_guardian_relation->ViewValue = "cousin";
						break;
					case "in law":
						$student_applicant->app_guardian_relation->ViewValue = "in law";
						break;
					case "father family":
						$student_applicant->app_guardian_relation->ViewValue = "father family";
						break;
					case "mother family":
						$student_applicant->app_guardian_relation->ViewValue = "mother family";
						break;
					case "extended family":
						$student_applicant->app_guardian_relation->ViewValue = "extended family";
						break;
					case "other relation":
						$student_applicant->app_guardian_relation->ViewValue = "other relation";
						break;
					default:
						$student_applicant->app_guardian_relation->ViewValue = $student_applicant->app_guardian_relation->CurrentValue;
				}
			} else {
				$student_applicant->app_guardian_relation->ViewValue = NULL;
			}
			$student_applicant->app_guardian_relation->CssStyle = "";
			$student_applicant->app_guardian_relation->CssClass = "";
			$student_applicant->app_guardian_relation->ViewCustomAttributes = "";

			// app_guardian_occupation
			if (strval($student_applicant->app_guardian_occupation->CurrentValue) <> "") {
				$sFilterWrk = "`application_occupation_id` = " . ew_AdjustSql($student_applicant->app_guardian_occupation->CurrentValue) . "";
			$sSqlWrk = "SELECT `name` FROM `application_occupation`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->app_guardian_occupation->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$student_applicant->app_guardian_occupation->ViewValue = $student_applicant->app_guardian_occupation->CurrentValue;
				}
			} else {
				$student_applicant->app_guardian_occupation->ViewValue = NULL;
			}
			$student_applicant->app_guardian_occupation->CssStyle = "";
			$student_applicant->app_guardian_occupation->CssClass = "";
			$student_applicant->app_guardian_occupation->ViewCustomAttributes = "";

			// app_referees
			$student_applicant->app_referees->ViewValue = $student_applicant->app_referees->CurrentValue;
			$student_applicant->app_referees->CssStyle = "";
			$student_applicant->app_referees->CssClass = "";
			$student_applicant->app_referees->ViewCustomAttributes = "";

			// sponsored_child_no
			$student_applicant->sponsored_child_no->ViewValue = $student_applicant->sponsored_child_no->CurrentValue;
			$student_applicant->sponsored_child_no->CssStyle = "";
			$student_applicant->sponsored_child_no->CssClass = "";
			$student_applicant->sponsored_child_no->ViewCustomAttributes = "";

			// student_grades
			$student_applicant->student_grades->ViewValue = $student_applicant->student_grades->CurrentValue;
			$student_applicant->student_grades->CssStyle = "";
			$student_applicant->student_grades->CssClass = "";
			$student_applicant->student_grades->ViewCustomAttributes = "";

			// student_address
			$student_applicant->student_address->ViewValue = $student_applicant->student_address->CurrentValue;
			$student_applicant->student_address->CssStyle = "";
			$student_applicant->student_address->CssClass = "";
			$student_applicant->student_address->ViewCustomAttributes = "";

			// student_telephone_1
			$student_applicant->student_telephone_1->ViewValue = $student_applicant->student_telephone_1->CurrentValue;
			$student_applicant->student_telephone_1->CssStyle = "";
			$student_applicant->student_telephone_1->CssClass = "";
			$student_applicant->student_telephone_1->ViewCustomAttributes = "";

			// student_telephone_2
			$student_applicant->student_telephone_2->ViewValue = $student_applicant->student_telephone_2->CurrentValue;
			$student_applicant->student_telephone_2->CssStyle = "";
			$student_applicant->student_telephone_2->CssClass = "";
			$student_applicant->student_telephone_2->ViewCustomAttributes = "";

			// student_admitted_school_id
			if (strval($student_applicant->student_admitted_school_id->CurrentValue) <> "") {
				$sFilterWrk = "`school_id` = " . ew_AdjustSql($student_applicant->student_admitted_school_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `school_name` FROM `schools`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->student_admitted_school_id->ViewValue = $rswrk->fields('school_name');
					$rswrk->Close();
				} else {
					$student_applicant->student_admitted_school_id->ViewValue = $student_applicant->student_admitted_school_id->CurrentValue;
				}
			} else {
				$student_applicant->student_admitted_school_id->ViewValue = NULL;
			}
			$student_applicant->student_admitted_school_id->CssStyle = "";
			$student_applicant->student_admitted_school_id->CssClass = "";
			$student_applicant->student_admitted_school_id->ViewCustomAttributes = "";

			// app_primary_school_id
			if (strval($student_applicant->app_primary_school_id->CurrentValue) <> "") {
				$sFilterWrk = "`applicant_school_id` = " . ew_AdjustSql($student_applicant->app_primary_school_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `applicant_school_name` FROM `applicant_school`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "`applicant_school_type`=1" . ")";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->app_primary_school_id->ViewValue = $rswrk->fields('applicant_school_name');
					$rswrk->Close();
				} else {
					$student_applicant->app_primary_school_id->ViewValue = $student_applicant->app_primary_school_id->CurrentValue;
				}
			} else {
				$student_applicant->app_primary_school_id->ViewValue = NULL;
			}
			$student_applicant->app_primary_school_id->CssStyle = "";
			$student_applicant->app_primary_school_id->CssClass = "";
			$student_applicant->app_primary_school_id->ViewCustomAttributes = "";

			// app_junior_secondary_id
			if (strval($student_applicant->app_junior_secondary_id->CurrentValue) <> "") {
				$sFilterWrk = "`applicant_school_id` = " . ew_AdjustSql($student_applicant->app_junior_secondary_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `applicant_school_name` FROM `applicant_school`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "`applicant_school_type`=2" . ")";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->app_junior_secondary_id->ViewValue = $rswrk->fields('applicant_school_name');
					$rswrk->Close();
				} else {
					$student_applicant->app_junior_secondary_id->ViewValue = $student_applicant->app_junior_secondary_id->CurrentValue;
				}
			} else {
				$student_applicant->app_junior_secondary_id->ViewValue = NULL;
			}
			$student_applicant->app_junior_secondary_id->CssStyle = "";
			$student_applicant->app_junior_secondary_id->CssClass = "";
			$student_applicant->app_junior_secondary_id->ViewCustomAttributes = "";

			// app_scanneddocument
			if (!ew_Empty($student_applicant->app_scanneddocument->Upload->DbValue)) {
				$student_applicant->app_scanneddocument->ViewValue = $student_applicant->app_scanneddocument->Upload->DbValue;
			} else {
				$student_applicant->app_scanneddocument->ViewValue = "";
			}
			$student_applicant->app_scanneddocument->CssStyle = "";
			$student_applicant->app_scanneddocument->CssClass = "";
			$student_applicant->app_scanneddocument->ViewCustomAttributes = "";

			// group_id
			$student_applicant->group_id->ViewValue = $student_applicant->group_id->CurrentValue;
			$student_applicant->group_id->CssStyle = "";
			$student_applicant->group_id->CssClass = "";
			$student_applicant->group_id->ViewCustomAttributes = "";

			// student_applicant_id
			$student_applicant->student_applicant_id->HrefValue = "";
			$student_applicant->student_applicant_id->TooltipValue = "";

			// app_submission_year
			$student_applicant->app_submission_year->HrefValue = "";
			$student_applicant->app_submission_year->TooltipValue = "";

			// student_resident_programarea_id
			$student_applicant->student_resident_programarea_id->HrefValue = "";
			$student_applicant->student_resident_programarea_id->TooltipValue = "";

			// community_community_id
			$student_applicant->community_community_id->HrefValue = "";
			$student_applicant->community_community_id->TooltipValue = "";

			// app_status
			$student_applicant->app_status->HrefValue = "";
			$student_applicant->app_status->TooltipValue = "";

			// app_points
			$student_applicant->app_points->HrefValue = "";
			$student_applicant->app_points->TooltipValue = "";

			// app_grant_id
			$student_applicant->app_grant_id->HrefValue = "";
			$student_applicant->app_grant_id->TooltipValue = "";

			// app_amount
			$student_applicant->app_amount->HrefValue = "";
			$student_applicant->app_amount->TooltipValue = "";

			// student_firstname
			$student_applicant->student_firstname->HrefValue = "";
			$student_applicant->student_firstname->TooltipValue = "";

			// student_middlename
			$student_applicant->student_middlename->HrefValue = "";
			$student_applicant->student_middlename->TooltipValue = "";

			// student_lastname
			$student_applicant->student_lastname->HrefValue = "";
			$student_applicant->student_lastname->TooltipValue = "";

			// student_gender
			$student_applicant->student_gender->HrefValue = "";
			$student_applicant->student_gender->TooltipValue = "";

			// student_dob
			$student_applicant->student_dob->HrefValue = "";
			$student_applicant->student_dob->TooltipValue = "";

			// app_mother_name
			$student_applicant->app_mother_name->HrefValue = "";
			$student_applicant->app_mother_name->TooltipValue = "";

			// app_mother_isalive
			$student_applicant->app_mother_isalive->HrefValue = "";
			$student_applicant->app_mother_isalive->TooltipValue = "";

			// app_mother_occupation
			$student_applicant->app_mother_occupation->HrefValue = "";
			$student_applicant->app_mother_occupation->TooltipValue = "";

			// app_father_name
			$student_applicant->app_father_name->HrefValue = "";
			$student_applicant->app_father_name->TooltipValue = "";

			// app_father_occupation
			$student_applicant->app_father_occupation->HrefValue = "";
			$student_applicant->app_father_occupation->TooltipValue = "";

			// app_father_isalive
			$student_applicant->app_father_isalive->HrefValue = "";
			$student_applicant->app_father_isalive->TooltipValue = "";

			// student_picture
			if (!ew_Empty($student_applicant->student_picture->Upload->DbValue)) {
				$student_applicant->student_picture->HrefValue = ew_UploadPathEx(FALSE, $student_applicant->student_picture->UploadPath) . ((!empty($student_applicant->student_picture->ViewValue)) ? $student_applicant->student_picture->ViewValue : $student_applicant->student_picture->CurrentValue);
				if ($student_applicant->Export <> "") $student_applicant->student_picture->HrefValue = ew_ConvertFullUrl($student_applicant->student_picture->HrefValue);
			} else {
				$student_applicant->student_picture->HrefValue = "";
			}
			$student_applicant->student_picture->TooltipValue = "";

			// app_guardian_name
			$student_applicant->app_guardian_name->HrefValue = "";
			$student_applicant->app_guardian_name->TooltipValue = "";

			// app_guardian_relation
			$student_applicant->app_guardian_relation->HrefValue = "";
			$student_applicant->app_guardian_relation->TooltipValue = "";

			// app_guardian_occupation
			$student_applicant->app_guardian_occupation->HrefValue = "";
			$student_applicant->app_guardian_occupation->TooltipValue = "";

			// app_referees
			$student_applicant->app_referees->HrefValue = "";
			$student_applicant->app_referees->TooltipValue = "";

			// sponsored_child_no
			$student_applicant->sponsored_child_no->HrefValue = "";
			$student_applicant->sponsored_child_no->TooltipValue = "";

			// student_grades
			$student_applicant->student_grades->HrefValue = "";
			$student_applicant->student_grades->TooltipValue = "";

			// student_address
			$student_applicant->student_address->HrefValue = "";
			$student_applicant->student_address->TooltipValue = "";

			// student_telephone_1
			$student_applicant->student_telephone_1->HrefValue = "";
			$student_applicant->student_telephone_1->TooltipValue = "";

			// student_telephone_2
			$student_applicant->student_telephone_2->HrefValue = "";
			$student_applicant->student_telephone_2->TooltipValue = "";

			// student_admitted_school_id
			$student_applicant->student_admitted_school_id->HrefValue = "";
			$student_applicant->student_admitted_school_id->TooltipValue = "";

			// app_primary_school_id
			$student_applicant->app_primary_school_id->HrefValue = "";
			$student_applicant->app_primary_school_id->TooltipValue = "";

			// app_junior_secondary_id
			$student_applicant->app_junior_secondary_id->HrefValue = "";
			$student_applicant->app_junior_secondary_id->TooltipValue = "";

			// app_scanneddocument
			if (!ew_Empty($student_applicant->app_scanneddocument->Upload->DbValue)) {
				$student_applicant->app_scanneddocument->HrefValue = ew_UploadPathEx(FALSE, $student_applicant->app_scanneddocument->UploadPath) . ((!empty($student_applicant->app_scanneddocument->ViewValue)) ? $student_applicant->app_scanneddocument->ViewValue : $student_applicant->app_scanneddocument->CurrentValue);
				if ($student_applicant->Export <> "") $student_applicant->app_scanneddocument->HrefValue = ew_ConvertFullUrl($student_applicant->app_scanneddocument->HrefValue);
			} else {
				$student_applicant->app_scanneddocument->HrefValue = "";
			}
			$student_applicant->app_scanneddocument->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($student_applicant->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$student_applicant->Row_Rendered();
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
