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

$programearea_id=0;
// Create page object
$student_applicant_add = new cstudent_applicant_add();
$Page =& $student_applicant_add;

// Page init
$student_applicant_add->Page_Init();

// Page main
$student_applicant_add->Page_Main();


?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var student_applicant_add = new ew_Page("student_applicant_add");

// page properties
student_applicant_add.PageID = "add"; // page ID
student_applicant_add.FormID = "fstudent_applicantadd"; // form ID
var EW_PAGE_ID = student_applicant_add.PageID; // for backward compatibility

// extend page with ValidateForm function
student_applicant_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_student_firstname"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($student_applicant->student_firstname->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_student_lastname"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($student_applicant->student_lastname->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_app_scanneddocument"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, ewLanguage.Phrase("WrongFileType"));
		elm = fobj.elements["x" + infix + "_student_picture"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, ewLanguage.Phrase("WrongFileType"));
		elm = fobj.elements["x" + infix + "_student_dob"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($student_applicant->student_dob->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_app_primary_school_id"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($student_applicant->app_primary_school_id->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_app_junior_secondary_id"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($student_applicant->app_junior_secondary_id->FldCaption()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
student_applicant_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
student_applicant_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
student_applicant_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $student_applicant->TableCaption() ?><br><br>
<a href="<?php echo $student_applicant->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$student_applicant_add->ShowMessage();
?>
<?php include("ext/student_applicant_form.php"); ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$student_applicant_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cstudent_applicant_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'student_applicant';

	// Page object name
	var $PageObjName = 'student_applicant_add';

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
	function cstudent_applicant_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (student_applicant)
		$GLOBALS["student_applicant"] = new cstudent_applicant();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

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
		if (!$Security->CanAdd()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("student_applicantlist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();

		// Create form object
		$objForm = new cFormObj();

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
	var $sDbMasterFilter = "";
	var $sDbDetailFilter = "";
	var $lPriv = 0;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $student_applicant;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["student_applicant_id"] != "") {
		  $student_applicant->student_applicant_id->setQueryStringValue($_GET["student_applicant_id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $student_applicant->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->GetUploadFiles(); // Get upload files
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$student_applicant->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $student_applicant->CurrentAction = "C"; // Copy record
		  } else {
		    $student_applicant->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($student_applicant->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("student_applicantlist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$student_applicant->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $student_applicant->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$student_applicant->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $student_applicant;

		// Get upload data
			if ($student_applicant->app_scanneddocument->Upload->UploadFile()) {

				// No action required
			} else {
				echo $student_applicant->app_scanneddocument->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
			if ($student_applicant->student_picture->Upload->UploadFile()) {

				// No action required
			} else {
				echo $student_applicant->student_picture->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load default values
	function LoadDefaultValues() {
		global $student_applicant;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $student_applicant;
		$student_applicant->student_firstname->setFormValue($objForm->GetValue("x_student_firstname"));
		$student_applicant->student_middlename->setFormValue($objForm->GetValue("x_student_middlename"));
		$student_applicant->student_lastname->setFormValue($objForm->GetValue("x_student_lastname"));
		$student_applicant->app_mother_name->setFormValue($objForm->GetValue("x_app_mother_name"));
		$student_applicant->app_mother_isalive->setFormValue($objForm->GetValue("x_app_mother_isalive"));
		$student_applicant->app_mother_occupation->setFormValue($objForm->GetValue("x_app_mother_occupation"));
		$student_applicant->app_father_name->setFormValue($objForm->GetValue("x_app_father_name"));
		$student_applicant->app_father_occupation->setFormValue($objForm->GetValue("x_app_father_occupation"));
		$student_applicant->app_father_isalive->setFormValue($objForm->GetValue("x_app_father_isalive"));
		$student_applicant->student_grades->setFormValue($objForm->GetValue("x_student_grades"));
		$student_applicant->app_referees->setFormValue($objForm->GetValue("x_app_referees"));
		$student_applicant->app_guardian_name->setFormValue($objForm->GetValue("x_app_guardian_name"));
		$student_applicant->app_guardian_relation->setFormValue($objForm->GetValue("x_app_guardian_relation"));
		$student_applicant->app_guardian_occupation->setFormValue($objForm->GetValue("x_app_guardian_occupation"));
		$student_applicant->student_address->setFormValue($objForm->GetValue("x_student_address"));
		$student_applicant->student_telephone_1->setFormValue($objForm->GetValue("x_student_telephone_1"));
		$student_applicant->student_telephone_2->setFormValue($objForm->GetValue("x_student_telephone_2"));
		$student_applicant->student_resident_programarea_id->setFormValue($objForm->GetValue("x_student_resident_programarea_id"));
		$student_applicant->student_admitted_school_id->setFormValue($objForm->GetValue("x_student_admitted_school_id"));
		$student_applicant->student_gender->setFormValue($objForm->GetValue("x_student_gender"));
		$student_applicant->student_dob->setFormValue($objForm->GetValue("x_student_dob"));
		$student_applicant->student_dob->CurrentValue = ew_UnFormatDateTime($student_applicant->student_dob->CurrentValue, 7);
		$student_applicant->community_community_id->setFormValue($objForm->GetValue("x_community_community_id"));
		$student_applicant->app_submission_year->setFormValue($objForm->GetValue("x_app_submission_year"));
		$student_applicant->app_primary_school_id->setFormValue($objForm->GetValue("x_app_primary_school_id"));
		$student_applicant->app_junior_secondary_id->setFormValue($objForm->GetValue("x_app_junior_secondary_id"));
		$student_applicant->student_applicant_id->setFormValue($objForm->GetValue("x_student_applicant_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $student_applicant;
		$student_applicant->student_applicant_id->CurrentValue = $student_applicant->student_applicant_id->FormValue;
		$student_applicant->student_firstname->CurrentValue = $student_applicant->student_firstname->FormValue;
		$student_applicant->student_middlename->CurrentValue = $student_applicant->student_middlename->FormValue;
		$student_applicant->student_lastname->CurrentValue = $student_applicant->student_lastname->FormValue;
		$student_applicant->app_mother_name->CurrentValue = $student_applicant->app_mother_name->FormValue;
		$student_applicant->app_mother_isalive->CurrentValue = $student_applicant->app_mother_isalive->FormValue;
		$student_applicant->app_mother_occupation->CurrentValue = $student_applicant->app_mother_occupation->FormValue;
		$student_applicant->app_father_name->CurrentValue = $student_applicant->app_father_name->FormValue;
		$student_applicant->app_father_occupation->CurrentValue = $student_applicant->app_father_occupation->FormValue;
		$student_applicant->app_father_isalive->CurrentValue = $student_applicant->app_father_isalive->FormValue;
		$student_applicant->student_grades->CurrentValue = $student_applicant->student_grades->FormValue;
		$student_applicant->app_referees->CurrentValue = $student_applicant->app_referees->FormValue;
		$student_applicant->app_guardian_name->CurrentValue = $student_applicant->app_guardian_name->FormValue;
		$student_applicant->app_guardian_relation->CurrentValue = $student_applicant->app_guardian_relation->FormValue;
		$student_applicant->app_guardian_occupation->CurrentValue = $student_applicant->app_guardian_occupation->FormValue;
		$student_applicant->student_address->CurrentValue = $student_applicant->student_address->FormValue;
		$student_applicant->student_telephone_1->CurrentValue = $student_applicant->student_telephone_1->FormValue;
		$student_applicant->student_telephone_2->CurrentValue = $student_applicant->student_telephone_2->FormValue;
		$student_applicant->student_resident_programarea_id->CurrentValue = $student_applicant->student_resident_programarea_id->FormValue;
		$student_applicant->student_admitted_school_id->CurrentValue = $student_applicant->student_admitted_school_id->FormValue;
		$student_applicant->student_gender->CurrentValue = $student_applicant->student_gender->FormValue;
		$student_applicant->student_dob->CurrentValue = $student_applicant->student_dob->FormValue;
		$student_applicant->student_dob->CurrentValue = ew_UnFormatDateTime($student_applicant->student_dob->CurrentValue, 7);
		$student_applicant->community_community_id->CurrentValue = $student_applicant->community_community_id->FormValue;
		$student_applicant->app_submission_year->CurrentValue = $student_applicant->app_submission_year->FormValue;
		$student_applicant->app_primary_school_id->CurrentValue = $student_applicant->app_primary_school_id->FormValue;
		$student_applicant->app_junior_secondary_id->CurrentValue = $student_applicant->app_junior_secondary_id->FormValue;
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
		$student_applicant->app_grant_id->setDbValue($rs->fields('app_grant_id'));
		$student_applicant->student_firstname->setDbValue($rs->fields('student_firstname'));
		$student_applicant->student_middlename->setDbValue($rs->fields('student_middlename'));
		$student_applicant->student_lastname->setDbValue($rs->fields('student_lastname'));
		$student_applicant->app_scanneddocument->Upload->DbValue = $rs->fields('app_scanneddocument');
		$student_applicant->app_mother_name->setDbValue($rs->fields('app_mother_name'));
		$student_applicant->app_mother_isalive->setDbValue($rs->fields('app_mother_isalive'));
		$student_applicant->app_mother_occupation->setDbValue($rs->fields('app_mother_occupation'));
		$student_applicant->app_father_name->setDbValue($rs->fields('app_father_name'));
		$student_applicant->app_father_occupation->setDbValue($rs->fields('app_father_occupation'));
		$student_applicant->app_father_isalive->setDbValue($rs->fields('app_father_isalive'));
		$student_applicant->student_picture->Upload->DbValue = $rs->fields('student_picture');
		$student_applicant->student_grades->setDbValue($rs->fields('student_grades'));
		$student_applicant->app_points->setDbValue($rs->fields('app_points'));
		$student_applicant->app_referees->setDbValue($rs->fields('app_referees'));
		$student_applicant->app_guardian_name->setDbValue($rs->fields('app_guardian_name'));
		$student_applicant->app_guardian_relation->setDbValue($rs->fields('app_guardian_relation'));
		$student_applicant->app_guardian_occupation->setDbValue($rs->fields('app_guardian_occupation'));
		$student_applicant->student_address->setDbValue($rs->fields('student_address'));
		$student_applicant->student_telephone_1->setDbValue($rs->fields('student_telephone_1'));
		$student_applicant->student_telephone_2->setDbValue($rs->fields('student_telephone_2'));
		$student_applicant->student_resident_programarea_id->setDbValue($rs->fields('student_resident_programarea_id'));
		$student_applicant->student_admitted_school_id->setDbValue($rs->fields('student_admitted_school_id'));
		$student_applicant->student_gender->setDbValue($rs->fields('student_gender'));
		$student_applicant->student_dob->setDbValue($rs->fields('student_dob'));
		$student_applicant->community_community_id->setDbValue($rs->fields('community_community_id'));
		$student_applicant->app_submission_year->setDbValue($rs->fields('app_submission_year'));
		$student_applicant->app_amount->setDbValue($rs->fields('app_amount'));
		$student_applicant->app_status->setDbValue($rs->fields('app_status'));
		$student_applicant->app_primary_school_id->setDbValue($rs->fields('app_primary_school_id'));
		$student_applicant->app_junior_secondary_id->setDbValue($rs->fields('app_junior_secondary_id'));
		$student_applicant->group_id->setDbValue($rs->fields('group_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $student_applicant;

		// Initialize URLs
		// Call Row_Rendering event

		$student_applicant->Row_Rendering();

		// Common render codes for all row types
		// student_firstname

		$student_applicant->student_firstname->CellCssStyle = ""; $student_applicant->student_firstname->CellCssClass = "";
		$student_applicant->student_firstname->CellAttrs = array(); $student_applicant->student_firstname->ViewAttrs = array(); $student_applicant->student_firstname->EditAttrs = array();

		// student_middlename
		$student_applicant->student_middlename->CellCssStyle = ""; $student_applicant->student_middlename->CellCssClass = "";
		$student_applicant->student_middlename->CellAttrs = array(); $student_applicant->student_middlename->ViewAttrs = array(); $student_applicant->student_middlename->EditAttrs = array();

		// student_lastname
		$student_applicant->student_lastname->CellCssStyle = ""; $student_applicant->student_lastname->CellCssClass = "";
		$student_applicant->student_lastname->CellAttrs = array(); $student_applicant->student_lastname->ViewAttrs = array(); $student_applicant->student_lastname->EditAttrs = array();

		// app_scanneddocument
		$student_applicant->app_scanneddocument->CellCssStyle = ""; $student_applicant->app_scanneddocument->CellCssClass = "";
		$student_applicant->app_scanneddocument->CellAttrs = array(); $student_applicant->app_scanneddocument->ViewAttrs = array(); $student_applicant->app_scanneddocument->EditAttrs = array();

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

		// student_grades
		$student_applicant->student_grades->CellCssStyle = ""; $student_applicant->student_grades->CellCssClass = "";
		$student_applicant->student_grades->CellAttrs = array(); $student_applicant->student_grades->ViewAttrs = array(); $student_applicant->student_grades->EditAttrs = array();

		// app_referees
		$student_applicant->app_referees->CellCssStyle = ""; $student_applicant->app_referees->CellCssClass = "";
		$student_applicant->app_referees->CellAttrs = array(); $student_applicant->app_referees->ViewAttrs = array(); $student_applicant->app_referees->EditAttrs = array();

		// app_guardian_name
		$student_applicant->app_guardian_name->CellCssStyle = ""; $student_applicant->app_guardian_name->CellCssClass = "";
		$student_applicant->app_guardian_name->CellAttrs = array(); $student_applicant->app_guardian_name->ViewAttrs = array(); $student_applicant->app_guardian_name->EditAttrs = array();

		// app_guardian_relation
		$student_applicant->app_guardian_relation->CellCssStyle = ""; $student_applicant->app_guardian_relation->CellCssClass = "";
		$student_applicant->app_guardian_relation->CellAttrs = array(); $student_applicant->app_guardian_relation->ViewAttrs = array(); $student_applicant->app_guardian_relation->EditAttrs = array();

		// app_guardian_occupation
		$student_applicant->app_guardian_occupation->CellCssStyle = ""; $student_applicant->app_guardian_occupation->CellCssClass = "";
		$student_applicant->app_guardian_occupation->CellAttrs = array(); $student_applicant->app_guardian_occupation->ViewAttrs = array(); $student_applicant->app_guardian_occupation->EditAttrs = array();

		// student_address
		$student_applicant->student_address->CellCssStyle = ""; $student_applicant->student_address->CellCssClass = "";
		$student_applicant->student_address->CellAttrs = array(); $student_applicant->student_address->ViewAttrs = array(); $student_applicant->student_address->EditAttrs = array();

		// student_telephone_1
		$student_applicant->student_telephone_1->CellCssStyle = ""; $student_applicant->student_telephone_1->CellCssClass = "";
		$student_applicant->student_telephone_1->CellAttrs = array(); $student_applicant->student_telephone_1->ViewAttrs = array(); $student_applicant->student_telephone_1->EditAttrs = array();

		// student_telephone_2
		$student_applicant->student_telephone_2->CellCssStyle = ""; $student_applicant->student_telephone_2->CellCssClass = "";
		$student_applicant->student_telephone_2->CellAttrs = array(); $student_applicant->student_telephone_2->ViewAttrs = array(); $student_applicant->student_telephone_2->EditAttrs = array();

		// student_resident_programarea_id
		$student_applicant->student_resident_programarea_id->CellCssStyle = ""; $student_applicant->student_resident_programarea_id->CellCssClass = "";
		$student_applicant->student_resident_programarea_id->CellAttrs = array(); $student_applicant->student_resident_programarea_id->ViewAttrs = array(); $student_applicant->student_resident_programarea_id->EditAttrs = array();

		// student_admitted_school_id
		$student_applicant->student_admitted_school_id->CellCssStyle = ""; $student_applicant->student_admitted_school_id->CellCssClass = "";
		$student_applicant->student_admitted_school_id->CellAttrs = array(); $student_applicant->student_admitted_school_id->ViewAttrs = array(); $student_applicant->student_admitted_school_id->EditAttrs = array();

		// student_gender
		$student_applicant->student_gender->CellCssStyle = ""; $student_applicant->student_gender->CellCssClass = "";
		$student_applicant->student_gender->CellAttrs = array(); $student_applicant->student_gender->ViewAttrs = array(); $student_applicant->student_gender->EditAttrs = array();

		// student_dob
		$student_applicant->student_dob->CellCssStyle = ""; $student_applicant->student_dob->CellCssClass = "";
		$student_applicant->student_dob->CellAttrs = array(); $student_applicant->student_dob->ViewAttrs = array(); $student_applicant->student_dob->EditAttrs = array();

		// community_community_id
		$student_applicant->community_community_id->CellCssStyle = ""; $student_applicant->community_community_id->CellCssClass = "";
		$student_applicant->community_community_id->CellAttrs = array(); $student_applicant->community_community_id->ViewAttrs = array(); $student_applicant->community_community_id->EditAttrs = array();

		// app_submission_year
		$student_applicant->app_submission_year->CellCssStyle = ""; $student_applicant->app_submission_year->CellCssClass = "";
		$student_applicant->app_submission_year->CellAttrs = array(); $student_applicant->app_submission_year->ViewAttrs = array(); $student_applicant->app_submission_year->EditAttrs = array();

		// app_primary_school_id
		$student_applicant->app_primary_school_id->CellCssStyle = ""; $student_applicant->app_primary_school_id->CellCssClass = "";
		$student_applicant->app_primary_school_id->CellAttrs = array(); $student_applicant->app_primary_school_id->ViewAttrs = array(); $student_applicant->app_primary_school_id->EditAttrs = array();

		// app_junior_secondary_id
		$student_applicant->app_junior_secondary_id->CellCssStyle = ""; $student_applicant->app_junior_secondary_id->CellCssClass = "";
		$student_applicant->app_junior_secondary_id->CellAttrs = array(); $student_applicant->app_junior_secondary_id->ViewAttrs = array(); $student_applicant->app_junior_secondary_id->EditAttrs = array();
		if ($student_applicant->RowType == EW_ROWTYPE_VIEW) { // View row

			// student_applicant_id
			$student_applicant->student_applicant_id->ViewValue = $student_applicant->student_applicant_id->CurrentValue;
			$student_applicant->student_applicant_id->CssStyle = "";
			$student_applicant->student_applicant_id->CssClass = "";
			$student_applicant->student_applicant_id->ViewCustomAttributes = "";

			// app_grant_id
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

			// app_scanneddocument
			if (!ew_Empty($student_applicant->app_scanneddocument->Upload->DbValue)) {
				$student_applicant->app_scanneddocument->ViewValue = $student_applicant->app_scanneddocument->Upload->DbValue;
			} else {
				$student_applicant->app_scanneddocument->ViewValue = "";
			}
			$student_applicant->app_scanneddocument->CssStyle = "";
			$student_applicant->app_scanneddocument->CssClass = "";
			$student_applicant->app_scanneddocument->ViewCustomAttributes = "";

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

			// student_grades
			$student_applicant->student_grades->ViewValue = $student_applicant->student_grades->CurrentValue;
			$student_applicant->student_grades->CssStyle = "";
			$student_applicant->student_grades->CssClass = "";
			$student_applicant->student_grades->ViewCustomAttributes = "";

			// app_points
			$student_applicant->app_points->ViewValue = $student_applicant->app_points->CurrentValue;
			$student_applicant->app_points->CssStyle = "";
			$student_applicant->app_points->CssClass = "";
			$student_applicant->app_points->ViewCustomAttributes = "";

			// app_referees
			$student_applicant->app_referees->ViewValue = $student_applicant->app_referees->CurrentValue;
			$student_applicant->app_referees->CssStyle = "";
			$student_applicant->app_referees->CssClass = "";
			$student_applicant->app_referees->ViewCustomAttributes = "";

			// app_guardian_name
			$student_applicant->app_guardian_name->ViewValue = $student_applicant->app_guardian_name->CurrentValue;
			$student_applicant->app_guardian_name->CssStyle = "";
			$student_applicant->app_guardian_name->CssClass = "";
			$student_applicant->app_guardian_name->ViewCustomAttributes = "";

			// app_guardian_relation
			if (strval($student_applicant->app_guardian_relation->CurrentValue) <> "") {
				switch ($student_applicant->app_guardian_relation->CurrentValue) {
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
				echo "here";
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

			// app_submission_year
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

			// app_amount
			$student_applicant->app_amount->ViewValue = $student_applicant->app_amount->CurrentValue;
			$student_applicant->app_amount->CssStyle = "";
			$student_applicant->app_amount->CssClass = "";
			$student_applicant->app_amount->ViewCustomAttributes = "";

			// app_status
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
			$sWhereWrk = "`applicant_school_type`=2";
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

			// group_id
			$student_applicant->group_id->ViewValue = $student_applicant->group_id->CurrentValue;
			$student_applicant->group_id->CssStyle = "";
			$student_applicant->group_id->CssClass = "";
			$student_applicant->group_id->ViewCustomAttributes = "";

			// student_firstname
			$student_applicant->student_firstname->HrefValue = "";
			$student_applicant->student_firstname->TooltipValue = "";

			// student_middlename
			$student_applicant->student_middlename->HrefValue = "";
			$student_applicant->student_middlename->TooltipValue = "";

			// student_lastname
			$student_applicant->student_lastname->HrefValue = "";
			$student_applicant->student_lastname->TooltipValue = "";

			// app_scanneddocument
			if (!ew_Empty($student_applicant->app_scanneddocument->Upload->DbValue)) {
				$student_applicant->app_scanneddocument->HrefValue = ew_UploadPathEx(FALSE, $student_applicant->app_scanneddocument->UploadPath) . ((!empty($student_applicant->app_scanneddocument->ViewValue)) ? $student_applicant->app_scanneddocument->ViewValue : $student_applicant->app_scanneddocument->CurrentValue);
				if ($student_applicant->Export <> "") $student_applicant->app_scanneddocument->HrefValue = ew_ConvertFullUrl($student_applicant->app_scanneddocument->HrefValue);
			} else {
				$student_applicant->app_scanneddocument->HrefValue = "";
			}
			$student_applicant->app_scanneddocument->TooltipValue = "";

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

			// student_grades
			$student_applicant->student_grades->HrefValue = "";
			$student_applicant->student_grades->TooltipValue = "";

			// app_referees
			$student_applicant->app_referees->HrefValue = "";
			$student_applicant->app_referees->TooltipValue = "";

			// app_guardian_name
			$student_applicant->app_guardian_name->HrefValue = "";
			$student_applicant->app_guardian_name->TooltipValue = "";

			// app_guardian_relation
			$student_applicant->app_guardian_relation->HrefValue = "";
			$student_applicant->app_guardian_relation->TooltipValue = "";

			// app_guardian_occupation
			$student_applicant->app_guardian_occupation->HrefValue = "";
			$student_applicant->app_guardian_occupation->TooltipValue = "";

			// student_address
			$student_applicant->student_address->HrefValue = "";
			$student_applicant->student_address->TooltipValue = "";

			// student_telephone_1
			$student_applicant->student_telephone_1->HrefValue = "";
			$student_applicant->student_telephone_1->TooltipValue = "";

			// student_telephone_2
			$student_applicant->student_telephone_2->HrefValue = "";
			$student_applicant->student_telephone_2->TooltipValue = "";

			// student_resident_programarea_id
			$student_applicant->student_resident_programarea_id->HrefValue = "";
			$student_applicant->student_resident_programarea_id->TooltipValue = "";

			// student_admitted_school_id
			$student_applicant->student_admitted_school_id->HrefValue = "";
			$student_applicant->student_admitted_school_id->TooltipValue = "";

			// student_gender
			$student_applicant->student_gender->HrefValue = "";
			$student_applicant->student_gender->TooltipValue = "";

			// student_dob
			$student_applicant->student_dob->HrefValue = "";
			$student_applicant->student_dob->TooltipValue = "";

			// community_community_id
			$student_applicant->community_community_id->HrefValue = "";
			$student_applicant->community_community_id->TooltipValue = "";

			// app_submission_year
			$student_applicant->app_submission_year->HrefValue = "";
			$student_applicant->app_submission_year->TooltipValue = "";

			// app_primary_school_id
			$student_applicant->app_primary_school_id->HrefValue = "";
			$student_applicant->app_primary_school_id->TooltipValue = "";

			// app_junior_secondary_id
			$student_applicant->app_junior_secondary_id->HrefValue = "";
			$student_applicant->app_junior_secondary_id->TooltipValue = "";
		} elseif ($student_applicant->RowType == EW_ROWTYPE_ADD) { // Add row

			// student_firstname
			$student_applicant->student_firstname->EditCustomAttributes = "";
			$student_applicant->student_firstname->EditValue = ew_HtmlEncode($student_applicant->student_firstname->CurrentValue);

			// student_middlename
			$student_applicant->student_middlename->EditCustomAttributes = "";
			$student_applicant->student_middlename->EditValue = ew_HtmlEncode($student_applicant->student_middlename->CurrentValue);

			// student_lastname
			$student_applicant->student_lastname->EditCustomAttributes = "";
			$student_applicant->student_lastname->EditValue = ew_HtmlEncode($student_applicant->student_lastname->CurrentValue);

			// app_scanneddocument
			$student_applicant->app_scanneddocument->EditCustomAttributes = "";
			if (!ew_Empty($student_applicant->app_scanneddocument->Upload->DbValue)) {
				$student_applicant->app_scanneddocument->EditValue = $student_applicant->app_scanneddocument->Upload->DbValue;
			} else {
				$student_applicant->app_scanneddocument->EditValue = "";
			}

			// app_mother_name
			$student_applicant->app_mother_name->EditCustomAttributes = "";
			$student_applicant->app_mother_name->EditValue = ew_HtmlEncode($student_applicant->app_mother_name->CurrentValue);

			// app_mother_isalive
			$student_applicant->app_mother_isalive->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", "Alive");
			$arwrk[] = array("0", "Deceased");
			$student_applicant->app_mother_isalive->EditValue = $arwrk;

			// app_mother_occupation
			$student_applicant->app_mother_occupation->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `application_occupation_id`, `name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `application_occupation`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$student_applicant->app_mother_occupation->EditValue = $arwrk;

			// app_father_name
			$student_applicant->app_father_name->EditCustomAttributes = "";
			$student_applicant->app_father_name->EditValue = ew_HtmlEncode($student_applicant->app_father_name->CurrentValue);

			// app_father_occupation
			$student_applicant->app_father_occupation->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `application_occupation_id`, `name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `application_occupation`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$student_applicant->app_father_occupation->EditValue = $arwrk;

			// app_father_isalive
			$student_applicant->app_father_isalive->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", "Alive");
			$arwrk[] = array("0", "Deceased");
			$student_applicant->app_father_isalive->EditValue = $arwrk;

			// student_picture
			$student_applicant->student_picture->EditCustomAttributes = "";
			if (!ew_Empty($student_applicant->student_picture->Upload->DbValue)) {
				$student_applicant->student_picture->EditValue = $student_applicant->student_picture->Upload->DbValue;
			} else {
				$student_applicant->student_picture->EditValue = "";
			}

			// student_grades
			$student_applicant->student_grades->EditCustomAttributes = "";
			$student_applicant->student_grades->EditValue = ew_HtmlEncode($student_applicant->student_grades->CurrentValue);

			// app_referees
			$student_applicant->app_referees->EditCustomAttributes = "";
			$student_applicant->app_referees->EditValue = ew_HtmlEncode($student_applicant->app_referees->CurrentValue);

			// app_guardian_name
			$student_applicant->app_guardian_name->EditCustomAttributes = "";
			$student_applicant->app_guardian_name->EditValue = ew_HtmlEncode($student_applicant->app_guardian_name->CurrentValue);

			// app_guardian_relation
			$student_applicant->app_guardian_relation->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("grandparent", "grandparent");
			$arwrk[] = array("grandparent", "grandparent");
			$arwrk[] = array("aunt", "aunt");
			$arwrk[] = array("sibling", "sibling");
			$arwrk[] = array("cousin", "cousin");
			$arwrk[] = array("in law", "in law");
			$arwrk[] = array("father family", "father family");
			$arwrk[] = array("mother family", "mother family");
			$arwrk[] = array("extended family", "extended family");
			$arwrk[] = array("other relation", "other relation");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$student_applicant->app_guardian_relation->EditValue = $arwrk;

			// app_guardian_occupation
			$student_applicant->app_guardian_occupation->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `application_occupation_id`, `name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `application_occupation`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$student_applicant->app_guardian_occupation->EditValue = $arwrk;

			// student_address
			$student_applicant->student_address->EditCustomAttributes = "";
			$student_applicant->student_address->EditValue = ew_HtmlEncode($student_applicant->student_address->CurrentValue);

			// student_telephone_1
			$student_applicant->student_telephone_1->EditCustomAttributes = "";
			$student_applicant->student_telephone_1->EditValue = ew_HtmlEncode($student_applicant->student_telephone_1->CurrentValue);

			// student_telephone_2
			$student_applicant->student_telephone_2->EditCustomAttributes = "";
			$student_applicant->student_telephone_2->EditValue = ew_HtmlEncode($student_applicant->student_telephone_2->CurrentValue);

			// student_resident_programarea_id
			$student_applicant->student_resident_programarea_id->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `programarea_id`, `programarea_name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$student_applicant->student_resident_programarea_id->EditValue = $arwrk;

			// student_admitted_school_id
			$student_applicant->student_admitted_school_id->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `school_id`, `school_name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `schools`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$student_applicant->student_admitted_school_id->EditValue = $arwrk;

			// student_gender
			$student_applicant->student_gender->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("M", "Male");
			$arwrk[] = array("F", "Female");
			$student_applicant->student_gender->EditValue = $arwrk;

			// student_dob
			$student_applicant->student_dob->EditCustomAttributes = "";
			$student_applicant->student_dob->EditValue = ew_HtmlEncode(ew_FormatDateTime($student_applicant->student_dob->CurrentValue, 7));

			// community_community_id
			$student_applicant->community_community_id->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `community_id`, `community`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `community`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$student_applicant->community_community_id->EditValue = $arwrk;

			// app_submission_year
			$student_applicant->app_submission_year->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `app_year`, `app_year`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `academic_year`";
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
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$student_applicant->app_submission_year->EditValue = $arwrk;

			// app_primary_school_id
			$student_applicant->app_primary_school_id->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `applicant_school_id`, `applicant_school_name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `applicant_school`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$student_applicant->app_primary_school_id->EditValue = $arwrk;

			// app_junior_secondary_id
			$student_applicant->app_junior_secondary_id->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `applicant_school_id`, `applicant_school_name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `applicant_school`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$student_applicant->app_junior_secondary_id->EditValue = $arwrk;
		}

		// Call Row Rendered event
		if ($student_applicant->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$student_applicant->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $student_applicant;

		// Initialize form error message
		$gsFormError = "";
		if (!ew_CheckFileType($student_applicant->app_scanneddocument->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("WrongFileType");
		}
		if ($student_applicant->app_scanneddocument->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0 && $student_applicant->app_scanneddocument->Upload->FileSize > EW_MAX_FILE_SIZE) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, $Language->Phrase("MaxFileSize"));
		}
		if (in_array($student_applicant->app_scanneddocument->Upload->Error, array(1, 2, 3, 6, 7, 8))) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("PhpUploadErr" . $student_applicant->app_scanneddocument->Upload->Error);
		}
		if (!ew_CheckFileType($student_applicant->student_picture->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("WrongFileType");
		}
		if ($student_applicant->student_picture->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0 && $student_applicant->student_picture->Upload->FileSize > EW_MAX_FILE_SIZE) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, $Language->Phrase("MaxFileSize"));
		}
		if (in_array($student_applicant->student_picture->Upload->Error, array(1, 2, 3, 6, 7, 8))) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("PhpUploadErr" . $student_applicant->student_picture->Upload->Error);
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($student_applicant->student_firstname->FormValue) && $student_applicant->student_firstname->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $student_applicant->student_firstname->FldCaption();
		}
		if (!is_null($student_applicant->student_lastname->FormValue) && $student_applicant->student_lastname->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $student_applicant->student_lastname->FldCaption();
		}
		if (!ew_CheckEuroDate($student_applicant->student_dob->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $student_applicant->student_dob->FldErrMsg();
		}
		if (!is_null($student_applicant->app_primary_school_id->FormValue) && $student_applicant->app_primary_school_id->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $student_applicant->app_primary_school_id->FldCaption();
		}
		if (!is_null($student_applicant->app_junior_secondary_id->FormValue) && $student_applicant->app_junior_secondary_id->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $student_applicant->app_junior_secondary_id->FldCaption();
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $sFormCustomError;
		}
		return $ValidateForm;
	}

	// Add record
	function AddRow() {
		global $conn, $Language, $Security, $student_applicant;
		$rsnew = array();

		// student_firstname
		$student_applicant->student_firstname->SetDbValueDef($rsnew, $student_applicant->student_firstname->CurrentValue, NULL, FALSE);

		// student_middlename
		$student_applicant->student_middlename->SetDbValueDef($rsnew, $student_applicant->student_middlename->CurrentValue, NULL, FALSE);

		// student_lastname
		$student_applicant->student_lastname->SetDbValueDef($rsnew, $student_applicant->student_lastname->CurrentValue, NULL, FALSE);

		// app_scanneddocument
		$student_applicant->app_scanneddocument->Upload->SaveToSession(); // Save file value to Session
		if (is_null($student_applicant->app_scanneddocument->Upload->Value)) {
			$rsnew['app_scanneddocument'] = NULL;
		} else {
			$rsnew['app_scanneddocument'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $student_applicant->app_scanneddocument->UploadPath), $student_applicant->app_scanneddocument->Upload->FileName);
		}

		// app_mother_name
		$student_applicant->app_mother_name->SetDbValueDef($rsnew, $student_applicant->app_mother_name->CurrentValue, NULL, FALSE);

		// app_mother_isalive
		$student_applicant->app_mother_isalive->SetDbValueDef($rsnew, $student_applicant->app_mother_isalive->CurrentValue, NULL, FALSE);

		// app_mother_occupation
		$student_applicant->app_mother_occupation->SetDbValueDef($rsnew, $student_applicant->app_mother_occupation->CurrentValue, NULL, FALSE);

		// app_father_name
		$student_applicant->app_father_name->SetDbValueDef($rsnew, $student_applicant->app_father_name->CurrentValue, NULL, FALSE);

		// app_father_occupation
		$student_applicant->app_father_occupation->SetDbValueDef($rsnew, $student_applicant->app_father_occupation->CurrentValue, NULL, FALSE);

		// app_father_isalive
		$student_applicant->app_father_isalive->SetDbValueDef($rsnew, $student_applicant->app_father_isalive->CurrentValue, NULL, FALSE);

		// student_picture
		$student_applicant->student_picture->Upload->SaveToSession(); // Save file value to Session
		if (is_null($student_applicant->student_picture->Upload->Value)) {
			$rsnew['student_picture'] = NULL;
		} else {
			$rsnew['student_picture'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $student_applicant->student_picture->UploadPath), $student_applicant->student_picture->Upload->FileName);
		}

		// student_grades
		$student_applicant->student_grades->SetDbValueDef($rsnew, $student_applicant->student_grades->CurrentValue, NULL, FALSE);

		// app_referees
		$student_applicant->app_referees->SetDbValueDef($rsnew, $student_applicant->app_referees->CurrentValue, NULL, FALSE);

		// app_guardian_name
		$student_applicant->app_guardian_name->SetDbValueDef($rsnew, $student_applicant->app_guardian_name->CurrentValue, NULL, FALSE);

		// app_guardian_relation
		$student_applicant->app_guardian_relation->SetDbValueDef($rsnew, $student_applicant->app_guardian_relation->CurrentValue, NULL, FALSE);

		// app_guardian_occupation
		$student_applicant->app_guardian_occupation->SetDbValueDef($rsnew, $student_applicant->app_guardian_occupation->CurrentValue, NULL, FALSE);

		// student_address
		$student_applicant->student_address->SetDbValueDef($rsnew, $student_applicant->student_address->CurrentValue, NULL, FALSE);

		// student_telephone_1
		$student_applicant->student_telephone_1->SetDbValueDef($rsnew, $student_applicant->student_telephone_1->CurrentValue, NULL, FALSE);

		// student_telephone_2
		$student_applicant->student_telephone_2->SetDbValueDef($rsnew, $student_applicant->student_telephone_2->CurrentValue, NULL, FALSE);

		// student_resident_programarea_id
		$student_applicant->student_resident_programarea_id->SetDbValueDef($rsnew, $student_applicant->student_resident_programarea_id->CurrentValue, NULL, FALSE);

		// student_admitted_school_id
		$student_applicant->student_admitted_school_id->SetDbValueDef($rsnew, $student_applicant->student_admitted_school_id->CurrentValue, NULL, FALSE);

		// student_gender
		$student_applicant->student_gender->SetDbValueDef($rsnew, $student_applicant->student_gender->CurrentValue, NULL, FALSE);

		// student_dob
		$student_applicant->student_dob->SetDbValueDef($rsnew, ew_UnFormatDateTime($student_applicant->student_dob->CurrentValue, 7, FALSE), NULL);

		// community_community_id
		$student_applicant->community_community_id->SetDbValueDef($rsnew, $student_applicant->community_community_id->CurrentValue, NULL, FALSE);

		// app_submission_year
		$student_applicant->app_submission_year->SetDbValueDef($rsnew, $student_applicant->app_submission_year->CurrentValue, NULL, FALSE);

		// app_primary_school_id
		$student_applicant->app_primary_school_id->SetDbValueDef($rsnew, $student_applicant->app_primary_school_id->CurrentValue, 0, FALSE);

		// app_junior_secondary_id
		$student_applicant->app_junior_secondary_id->SetDbValueDef($rsnew, $student_applicant->app_junior_secondary_id->CurrentValue, 0, FALSE);

		// Call Row Inserting event
		$bInsertRow = $student_applicant->Row_Inserting($rsnew);
		if ($bInsertRow) {
			if (!ew_Empty($student_applicant->app_scanneddocument->Upload->Value)) {
				$student_applicant->app_scanneddocument->Upload->SaveToFile($student_applicant->app_scanneddocument->UploadPath, $rsnew['app_scanneddocument'], FALSE);
			}
			if (!ew_Empty($student_applicant->student_picture->Upload->Value)) {
				$student_applicant->student_picture->Upload->SaveToFile($student_applicant->student_picture->UploadPath, $rsnew['student_picture'], FALSE);
			}
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($student_applicant->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($student_applicant->CancelMessage <> "") {
				$this->setMessage($student_applicant->CancelMessage);
				$student_applicant->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$student_applicant->student_applicant_id->setDbValue($conn->Insert_ID());
			$rsnew['student_applicant_id'] = $student_applicant->student_applicant_id->DbValue;

			// Call Row Inserted event
			$student_applicant->Row_Inserted($rsnew);
			$this->WriteAuditTrailOnAdd($rsnew);
		}

		// app_scanneddocument
		$student_applicant->app_scanneddocument->Upload->RemoveFromSession(); // Remove file value from Session

		// student_picture
		$student_applicant->student_picture->Upload->RemoveFromSession(); // Remove file value from Session
		return $AddRow;
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'student_applicant';
	  $usr = CurrentUserID();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	function WriteAuditTrailOnAdd(&$rs) {
		global $student_applicant;
		$table = 'student_applicant';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['student_applicant_id'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserID();
		foreach (array_keys($rs) as $fldname) {
			if ($student_applicant->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($student_applicant->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					$newvalue = "<MEMO>"; // Memo Field
				} elseif ($student_applicant->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
					$newvalue = "<XML>"; // XML Field
				} else {
					$newvalue = $rs[$fldname];
				}
				ew_WriteAuditTrail("log", $dt, $id, $usr, "A", $table, $fldname, $key, "", $newvalue);
			}
		}
	}

		// Page Load event
function Page_Load() {
    //echo "Page Load";
    //this customized seciont can be moved to Page_In
    $programarea_id=0;
	global $student_applicant;
    if($_SESSION[EW_PROJECT_NAME]["PROGRAM_AREA"]==0){
		$programarea_id=0;	
        
    }else{
        $programarea_id=$_SESSION[EW_PROJECT_NAME]["PROGRAM_AREA"];        
        $student_applicant->student_resident_programarea_id->setSessionValue($programarea_id);
    }
            

//end customization
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
