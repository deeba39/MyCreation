<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "grade_subjectinfo.php" ?>
<?php include "sponsored_studentinfo.php" ?>
<?php include "grade_yearinfo.php" ?>
<?php include "school_attendanceinfo.php" ?>
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
$grade_subject_add = new cgrade_subject_add();
$Page =& $grade_subject_add;

// Page init
$grade_subject_add->Page_Init();

// Page main
$grade_subject_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var grade_subject_add = new ew_Page("grade_subject_add");

// page properties
grade_subject_add.PageID = "add"; // page ID
grade_subject_add.FormID = "fgrade_subjectadd"; // form ID
var EW_PAGE_ID = grade_subject_add.PageID; // for backward compatibility

// extend page with ValidateForm function
grade_subject_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_subject"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($grade_subject->subject->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_raw_score"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($grade_subject->raw_score->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
grade_subject_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
grade_subject_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
grade_subject_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $grade_subject->TableCaption() ?><br><br>
<a href="<?php echo $grade_subject->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$grade_subject_add->ShowMessage();
?>
<form name="fgrade_subjectadd" id="fgrade_subjectadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return grade_subject_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="grade_subject">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($grade_subject->subject->Visible) { // subject ?>
	<tr<?php echo $grade_subject->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grade_subject->subject->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $grade_subject->subject->CellAttributes() ?>><span id="el_subject">
<input type="text" name="x_subject" id="x_subject" title="<?php echo $grade_subject->subject->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $grade_subject->subject->EditValue ?>"<?php echo $grade_subject->subject->EditAttributes() ?>>
</span><?php echo $grade_subject->subject->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($grade_subject->raw_score->Visible) { // raw_score ?>
	<tr<?php echo $grade_subject->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grade_subject->raw_score->FldCaption() ?></td>
		<td<?php echo $grade_subject->raw_score->CellAttributes() ?>><span id="el_raw_score">
<input type="text" name="x_raw_score" id="x_raw_score" title="<?php echo $grade_subject->raw_score->FldTitle() ?>" size="30" value="<?php echo $grade_subject->raw_score->EditValue ?>"<?php echo $grade_subject->raw_score->EditAttributes() ?>>
</span><?php echo $grade_subject->raw_score->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($grade_subject->letter_score->Visible) { // letter_score ?>
	<tr<?php echo $grade_subject->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grade_subject->letter_score->FldCaption() ?></td>
		<td<?php echo $grade_subject->letter_score->CellAttributes() ?>><span id="el_letter_score">
<input type="text" name="x_letter_score" id="x_letter_score" title="<?php echo $grade_subject->letter_score->FldTitle() ?>" size="30" maxlength="3" value="<?php echo $grade_subject->letter_score->EditValue ?>"<?php echo $grade_subject->letter_score->EditAttributes() ?>>
</span><?php echo $grade_subject->letter_score->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($grade_subject->letter_description->Visible) { // letter_description ?>
	<tr<?php echo $grade_subject->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grade_subject->letter_description->FldCaption() ?></td>
		<td<?php echo $grade_subject->letter_description->CellAttributes() ?>><span id="el_letter_description">
<input type="text" name="x_letter_description" id="x_letter_description" title="<?php echo $grade_subject->letter_description->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $grade_subject->letter_description->EditValue ?>"<?php echo $grade_subject->letter_description->EditAttributes() ?>>
</span><?php echo $grade_subject->letter_description->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($grade_subject->grade_year_grade_year_id->Visible) { // grade_year_grade_year_id ?>
	<tr<?php echo $grade_subject->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grade_subject->grade_year_grade_year_id->FldCaption() ?></td>
		<td<?php echo $grade_subject->grade_year_grade_year_id->CellAttributes() ?>><span id="el_grade_year_grade_year_id">
<?php if ($grade_subject->grade_year_grade_year_id->getSessionValue() <> "") { ?>
<div<?php echo $grade_subject->grade_year_grade_year_id->ViewAttributes() ?>><?php echo $grade_subject->grade_year_grade_year_id->ViewValue ?></div>
<input type="hidden" id="x_grade_year_grade_year_id" name="x_grade_year_grade_year_id" value="<?php echo ew_HtmlEncode($grade_subject->grade_year_grade_year_id->CurrentValue) ?>">
<?php } else { ?>
<select id="x_grade_year_grade_year_id" name="x_grade_year_grade_year_id" title="<?php echo $grade_subject->grade_year_grade_year_id->FldTitle() ?>"<?php echo $grade_subject->grade_year_grade_year_id->EditAttributes() ?>>
<?php
if (is_array($grade_subject->grade_year_grade_year_id->EditValue)) {
	$arwrk = $grade_subject->grade_year_grade_year_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($grade_subject->grade_year_grade_year_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
<?php } ?>
</span><?php echo $grade_subject->grade_year_grade_year_id->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$grade_subject_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cgrade_subject_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'grade_subject';

	// Page object name
	var $PageObjName = 'grade_subject_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $grade_subject;
		if ($grade_subject->UseTokenInUrl) $PageUrl .= "t=" . $grade_subject->TableVar . "&"; // Add page token
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
		global $objForm, $grade_subject;
		if ($grade_subject->UseTokenInUrl) {
			if ($objForm)
				return ($grade_subject->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($grade_subject->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cgrade_subject_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (grade_subject)
		$GLOBALS["grade_subject"] = new cgrade_subject();

		// Table object (sponsored_student)
		$GLOBALS['sponsored_student'] = new csponsored_student();

		// Table object (grade_year)
		$GLOBALS['grade_year'] = new cgrade_year();

		// Table object (school_attendance)
		$GLOBALS['school_attendance'] = new cschool_attendance();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'grade_subject', TRUE);

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
		global $grade_subject;

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
			$this->Page_Terminate("grade_subjectlist.php");
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
		global $objForm, $Language, $gsFormError, $grade_subject;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["grade_subject_id"] != "") {
		  $grade_subject->grade_subject_id->setQueryStringValue($_GET["grade_subject_id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Set up master/detail parameters
		$this->SetUpMasterDetail();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $grade_subject->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$grade_subject->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $grade_subject->CurrentAction = "C"; // Copy record
		  } else {
		    $grade_subject->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($grade_subject->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("grade_subjectlist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$grade_subject->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $grade_subject->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$grade_subject->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $grade_subject;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $grade_subject;
		$grade_subject->raw_score->CurrentValue = 0;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $grade_subject;
		$grade_subject->subject->setFormValue($objForm->GetValue("x_subject"));
		$grade_subject->raw_score->setFormValue($objForm->GetValue("x_raw_score"));
		$grade_subject->letter_score->setFormValue($objForm->GetValue("x_letter_score"));
		$grade_subject->letter_description->setFormValue($objForm->GetValue("x_letter_description"));
		$grade_subject->grade_year_grade_year_id->setFormValue($objForm->GetValue("x_grade_year_grade_year_id"));
		$grade_subject->grade_subject_id->setFormValue($objForm->GetValue("x_grade_subject_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $grade_subject;
		$grade_subject->grade_subject_id->CurrentValue = $grade_subject->grade_subject_id->FormValue;
		$grade_subject->subject->CurrentValue = $grade_subject->subject->FormValue;
		$grade_subject->raw_score->CurrentValue = $grade_subject->raw_score->FormValue;
		$grade_subject->letter_score->CurrentValue = $grade_subject->letter_score->FormValue;
		$grade_subject->letter_description->CurrentValue = $grade_subject->letter_description->FormValue;
		$grade_subject->grade_year_grade_year_id->CurrentValue = $grade_subject->grade_year_grade_year_id->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $grade_subject;
		$sFilter = $grade_subject->KeyFilter();

		// Call Row Selecting event
		$grade_subject->Row_Selecting($sFilter);

		// Load SQL based on filter
		$grade_subject->CurrentFilter = $sFilter;
		$sSql = $grade_subject->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$grade_subject->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $grade_subject;
		$grade_subject->grade_subject_id->setDbValue($rs->fields('grade_subject_id'));
		$grade_subject->subject->setDbValue($rs->fields('subject'));
		$grade_subject->raw_score->setDbValue($rs->fields('raw_score'));
		$grade_subject->letter_score->setDbValue($rs->fields('letter_score'));
		$grade_subject->letter_description->setDbValue($rs->fields('letter_description'));
		$grade_subject->grade_year_grade_year_id->setDbValue($rs->fields('grade_year_grade_year_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $grade_subject;

		// Initialize URLs
		// Call Row_Rendering event

		$grade_subject->Row_Rendering();

		// Common render codes for all row types
		// subject

		$grade_subject->subject->CellCssStyle = ""; $grade_subject->subject->CellCssClass = "";
		$grade_subject->subject->CellAttrs = array(); $grade_subject->subject->ViewAttrs = array(); $grade_subject->subject->EditAttrs = array();

		// raw_score
		$grade_subject->raw_score->CellCssStyle = ""; $grade_subject->raw_score->CellCssClass = "";
		$grade_subject->raw_score->CellAttrs = array(); $grade_subject->raw_score->ViewAttrs = array(); $grade_subject->raw_score->EditAttrs = array();

		// letter_score
		$grade_subject->letter_score->CellCssStyle = ""; $grade_subject->letter_score->CellCssClass = "";
		$grade_subject->letter_score->CellAttrs = array(); $grade_subject->letter_score->ViewAttrs = array(); $grade_subject->letter_score->EditAttrs = array();

		// letter_description
		$grade_subject->letter_description->CellCssStyle = ""; $grade_subject->letter_description->CellCssClass = "";
		$grade_subject->letter_description->CellAttrs = array(); $grade_subject->letter_description->ViewAttrs = array(); $grade_subject->letter_description->EditAttrs = array();

		// grade_year_grade_year_id
		$grade_subject->grade_year_grade_year_id->CellCssStyle = ""; $grade_subject->grade_year_grade_year_id->CellCssClass = "";
		$grade_subject->grade_year_grade_year_id->CellAttrs = array(); $grade_subject->grade_year_grade_year_id->ViewAttrs = array(); $grade_subject->grade_year_grade_year_id->EditAttrs = array();
		if ($grade_subject->RowType == EW_ROWTYPE_VIEW) { // View row

			// grade_subject_id
			$grade_subject->grade_subject_id->ViewValue = $grade_subject->grade_subject_id->CurrentValue;
			$grade_subject->grade_subject_id->CssStyle = "";
			$grade_subject->grade_subject_id->CssClass = "";
			$grade_subject->grade_subject_id->ViewCustomAttributes = "";

			// subject
			$grade_subject->subject->ViewValue = $grade_subject->subject->CurrentValue;
			$grade_subject->subject->CssStyle = "";
			$grade_subject->subject->CssClass = "";
			$grade_subject->subject->ViewCustomAttributes = "";

			// raw_score
			$grade_subject->raw_score->ViewValue = $grade_subject->raw_score->CurrentValue;
			$grade_subject->raw_score->CssStyle = "";
			$grade_subject->raw_score->CssClass = "";
			$grade_subject->raw_score->ViewCustomAttributes = "";

			// letter_score
			$grade_subject->letter_score->ViewValue = $grade_subject->letter_score->CurrentValue;
			$grade_subject->letter_score->CssStyle = "";
			$grade_subject->letter_score->CssClass = "";
			$grade_subject->letter_score->ViewCustomAttributes = "";

			// letter_description
			$grade_subject->letter_description->ViewValue = $grade_subject->letter_description->CurrentValue;
			$grade_subject->letter_description->CssStyle = "";
			$grade_subject->letter_description->CssClass = "";
			$grade_subject->letter_description->ViewCustomAttributes = "";

			// grade_year_grade_year_id
			if (strval($grade_subject->grade_year_grade_year_id->CurrentValue) <> "") {
				$sFilterWrk = "`grade_year_id` = " . ew_AdjustSql($grade_subject->grade_year_grade_year_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `year` FROM `grade_year`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$grade_subject->grade_year_grade_year_id->ViewValue = $rswrk->fields('year');
					$rswrk->Close();
				} else {
					$grade_subject->grade_year_grade_year_id->ViewValue = $grade_subject->grade_year_grade_year_id->CurrentValue;
				}
			} else {
				$grade_subject->grade_year_grade_year_id->ViewValue = NULL;
			}
			$grade_subject->grade_year_grade_year_id->CssStyle = "";
			$grade_subject->grade_year_grade_year_id->CssClass = "";
			$grade_subject->grade_year_grade_year_id->ViewCustomAttributes = "";

			// subject
			$grade_subject->subject->HrefValue = "";
			$grade_subject->subject->TooltipValue = "";

			// raw_score
			$grade_subject->raw_score->HrefValue = "";
			$grade_subject->raw_score->TooltipValue = "";

			// letter_score
			$grade_subject->letter_score->HrefValue = "";
			$grade_subject->letter_score->TooltipValue = "";

			// letter_description
			$grade_subject->letter_description->HrefValue = "";
			$grade_subject->letter_description->TooltipValue = "";

			// grade_year_grade_year_id
			$grade_subject->grade_year_grade_year_id->HrefValue = "";
			$grade_subject->grade_year_grade_year_id->TooltipValue = "";
		} elseif ($grade_subject->RowType == EW_ROWTYPE_ADD) { // Add row

			// subject
			$grade_subject->subject->EditCustomAttributes = "";
			$grade_subject->subject->EditValue = ew_HtmlEncode($grade_subject->subject->CurrentValue);

			// raw_score
			$grade_subject->raw_score->EditCustomAttributes = "";
			$grade_subject->raw_score->EditValue = ew_HtmlEncode($grade_subject->raw_score->CurrentValue);

			// letter_score
			$grade_subject->letter_score->EditCustomAttributes = "";
			$grade_subject->letter_score->EditValue = ew_HtmlEncode($grade_subject->letter_score->CurrentValue);

			// letter_description
			$grade_subject->letter_description->EditCustomAttributes = "";
			$grade_subject->letter_description->EditValue = ew_HtmlEncode($grade_subject->letter_description->CurrentValue);

			// grade_year_grade_year_id
			$grade_subject->grade_year_grade_year_id->EditCustomAttributes = "";
			if ($grade_subject->grade_year_grade_year_id->getSessionValue() <> "") {
				$grade_subject->grade_year_grade_year_id->CurrentValue = $grade_subject->grade_year_grade_year_id->getSessionValue();
			if (strval($grade_subject->grade_year_grade_year_id->CurrentValue) <> "") {
				$sFilterWrk = "`grade_year_id` = " . ew_AdjustSql($grade_subject->grade_year_grade_year_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `year` FROM `grade_year`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$grade_subject->grade_year_grade_year_id->ViewValue = $rswrk->fields('year');
					$rswrk->Close();
				} else {
					$grade_subject->grade_year_grade_year_id->ViewValue = $grade_subject->grade_year_grade_year_id->CurrentValue;
				}
			} else {
				$grade_subject->grade_year_grade_year_id->ViewValue = NULL;
			}
			$grade_subject->grade_year_grade_year_id->CssStyle = "";
			$grade_subject->grade_year_grade_year_id->CssClass = "";
			$grade_subject->grade_year_grade_year_id->ViewCustomAttributes = "";
			} else {
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `grade_year_id`, `year`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `grade_year`";
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
			$grade_subject->grade_year_grade_year_id->EditValue = $arwrk;
			}
		}

		// Call Row Rendered event
		if ($grade_subject->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$grade_subject->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $grade_subject;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($grade_subject->subject->FormValue) && $grade_subject->subject->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $grade_subject->subject->FldCaption();
		}
		if (!ew_CheckInteger($grade_subject->raw_score->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $grade_subject->raw_score->FldErrMsg();
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
		global $conn, $Language, $Security, $grade_subject;
		$rsnew = array();

		// subject
		$grade_subject->subject->SetDbValueDef($rsnew, $grade_subject->subject->CurrentValue, NULL, FALSE);

		// raw_score
		$grade_subject->raw_score->SetDbValueDef($rsnew, $grade_subject->raw_score->CurrentValue, NULL, FALSE);

		// letter_score
		$grade_subject->letter_score->SetDbValueDef($rsnew, $grade_subject->letter_score->CurrentValue, NULL, FALSE);

		// letter_description
		$grade_subject->letter_description->SetDbValueDef($rsnew, $grade_subject->letter_description->CurrentValue, NULL, FALSE);

		// grade_year_grade_year_id
		$grade_subject->grade_year_grade_year_id->SetDbValueDef($rsnew, $grade_subject->grade_year_grade_year_id->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$bInsertRow = $grade_subject->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($grade_subject->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($grade_subject->CancelMessage <> "") {
				$this->setMessage($grade_subject->CancelMessage);
				$grade_subject->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$grade_subject->grade_subject_id->setDbValue($conn->Insert_ID());
			$rsnew['grade_subject_id'] = $grade_subject->grade_subject_id->DbValue;

			// Call Row Inserted event
			$grade_subject->Row_Inserted($rsnew);
		}
		return $AddRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $grade_subject;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "grade_year") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $grade_subject->SqlMasterFilter_grade_year();
				$this->sDbDetailFilter = $grade_subject->SqlDetailFilter_grade_year();
				if (@$_GET["grade_year_id"] <> "") {
					$GLOBALS["grade_year"]->grade_year_id->setQueryStringValue($_GET["grade_year_id"]);
					$grade_subject->grade_year_grade_year_id->setQueryStringValue($GLOBALS["grade_year"]->grade_year_id->QueryStringValue);
					$grade_subject->grade_year_grade_year_id->setSessionValue($grade_subject->grade_year_grade_year_id->QueryStringValue);
					if (!is_numeric($GLOBALS["grade_year"]->grade_year_id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@grade_year_id@", ew_AdjustSql($GLOBALS["grade_year"]->grade_year_id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@grade_year_grade_year_id@", ew_AdjustSql($GLOBALS["grade_year"]->grade_year_id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$grade_subject->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$grade_subject->setStartRecordNumber($this->lStartRec);
			$grade_subject->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$grade_subject->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "grade_year") {
				if ($grade_subject->grade_year_grade_year_id->QueryStringValue == "") $grade_subject->grade_year_grade_year_id->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $grade_subject->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $grade_subject->getDetailFilter(); // Restore detail filter
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
