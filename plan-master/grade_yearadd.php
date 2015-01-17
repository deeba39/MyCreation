<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "grade_yearinfo.php" ?>
<?php include "sponsored_studentinfo.php" ?>
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
$grade_year_add = new cgrade_year_add();
$Page =& $grade_year_add;

// Page init
$grade_year_add->Page_Init();

// Page main
$grade_year_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var grade_year_add = new ew_Page("grade_year_add");

// page properties
grade_year_add.PageID = "add"; // page ID
grade_year_add.FormID = "fgrade_yearadd"; // form ID
var EW_PAGE_ID = grade_year_add.PageID; // for backward compatibility

// extend page with ValidateForm function
grade_year_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_class"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($grade_year->class->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_year"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($grade_year->year->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_school_attendance_school_attendance_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($grade_year->school_attendance_school_attendance_id->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
grade_year_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
grade_year_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
grade_year_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $grade_year->TableCaption() ?><br><br>
<a href="<?php echo $grade_year->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$grade_year_add->ShowMessage();
?>
<form name="fgrade_yearadd" id="fgrade_yearadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return grade_year_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="grade_year">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($grade_year->class->Visible) { // class ?>
	<tr<?php echo $grade_year->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grade_year->class->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $grade_year->class->CellAttributes() ?>><span id="el_class">
<input type="text" name="x_class" id="x_class" title="<?php echo $grade_year->class->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $grade_year->class->EditValue ?>"<?php echo $grade_year->class->EditAttributes() ?>>
</span><?php echo $grade_year->class->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($grade_year->year->Visible) { // year ?>
	<tr<?php echo $grade_year->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grade_year->year->FldCaption() ?></td>
		<td<?php echo $grade_year->year->CellAttributes() ?>><span id="el_year">
<input type="text" name="x_year" id="x_year" title="<?php echo $grade_year->year->FldTitle() ?>" size="30" value="<?php echo $grade_year->year->EditValue ?>"<?php echo $grade_year->year->EditAttributes() ?>>
</span><?php echo $grade_year->year->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($grade_year->promoted->Visible) { // promoted ?>
	<tr<?php echo $grade_year->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grade_year->promoted->FldCaption() ?></td>
		<td<?php echo $grade_year->promoted->CellAttributes() ?>><span id="el_promoted">
<div id="tp_x_promoted" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_promoted" id="x_promoted" title="<?php echo $grade_year->promoted->FldTitle() ?>" value="{value}"<?php echo $grade_year->promoted->EditAttributes() ?>></label></div>
<div id="dsl_x_promoted" repeatcolumn="5">
<?php
$arwrk = $grade_year->promoted->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($grade_year->promoted->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_promoted" id="x_promoted" title="<?php echo $grade_year->promoted->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $grade_year->promoted->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $grade_year->promoted->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($grade_year->programme->Visible) { // programme ?>
	<tr<?php echo $grade_year->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grade_year->programme->FldCaption() ?></td>
		<td<?php echo $grade_year->programme->CellAttributes() ?>><span id="el_programme">
<input type="text" name="x_programme" id="x_programme" title="<?php echo $grade_year->programme->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $grade_year->programme->EditValue ?>"<?php echo $grade_year->programme->EditAttributes() ?>>
</span><?php echo $grade_year->programme->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($grade_year->school_attendance_school_attendance_id->Visible) { // school_attendance_school_attendance_id ?>
	<tr<?php echo $grade_year->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grade_year->school_attendance_school_attendance_id->FldCaption() ?></td>
		<td<?php echo $grade_year->school_attendance_school_attendance_id->CellAttributes() ?>><span id="el_school_attendance_school_attendance_id">
<?php if ($grade_year->school_attendance_school_attendance_id->getSessionValue() <> "") { ?>
<div<?php echo $grade_year->school_attendance_school_attendance_id->ViewAttributes() ?>><?php echo $grade_year->school_attendance_school_attendance_id->ViewValue ?></div>
<input type="hidden" id="x_school_attendance_school_attendance_id" name="x_school_attendance_school_attendance_id" value="<?php echo ew_HtmlEncode($grade_year->school_attendance_school_attendance_id->CurrentValue) ?>">
<?php } else { ?>
<input type="text" name="x_school_attendance_school_attendance_id" id="x_school_attendance_school_attendance_id" title="<?php echo $grade_year->school_attendance_school_attendance_id->FldTitle() ?>" size="30" value="<?php echo $grade_year->school_attendance_school_attendance_id->EditValue ?>"<?php echo $grade_year->school_attendance_school_attendance_id->EditAttributes() ?>>
<?php } ?>
</span><?php echo $grade_year->school_attendance_school_attendance_id->CustomMsg ?></td>
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
$grade_year_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cgrade_year_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'grade_year';

	// Page object name
	var $PageObjName = 'grade_year_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $grade_year;
		if ($grade_year->UseTokenInUrl) $PageUrl .= "t=" . $grade_year->TableVar . "&"; // Add page token
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
		global $objForm, $grade_year;
		if ($grade_year->UseTokenInUrl) {
			if ($objForm)
				return ($grade_year->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($grade_year->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cgrade_year_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (grade_year)
		$GLOBALS["grade_year"] = new cgrade_year();

		// Table object (sponsored_student)
		$GLOBALS['sponsored_student'] = new csponsored_student();

		// Table object (school_attendance)
		$GLOBALS['school_attendance'] = new cschool_attendance();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'grade_year', TRUE);

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
		global $grade_year;

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
			$this->Page_Terminate("grade_yearlist.php");
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
		global $objForm, $Language, $gsFormError, $grade_year;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["grade_year_id"] != "") {
		  $grade_year->grade_year_id->setQueryStringValue($_GET["grade_year_id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Set up master/detail parameters
		$this->SetUpMasterDetail();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $grade_year->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$grade_year->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $grade_year->CurrentAction = "C"; // Copy record
		  } else {
		    $grade_year->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($grade_year->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("grade_yearlist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$grade_year->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $grade_year->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$grade_year->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $grade_year;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $grade_year;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $grade_year;
		$grade_year->class->setFormValue($objForm->GetValue("x_class"));
		$grade_year->year->setFormValue($objForm->GetValue("x_year"));
		$grade_year->promoted->setFormValue($objForm->GetValue("x_promoted"));
		$grade_year->programme->setFormValue($objForm->GetValue("x_programme"));
		$grade_year->school_attendance_school_attendance_id->setFormValue($objForm->GetValue("x_school_attendance_school_attendance_id"));
		$grade_year->grade_year_id->setFormValue($objForm->GetValue("x_grade_year_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $grade_year;
		$grade_year->grade_year_id->CurrentValue = $grade_year->grade_year_id->FormValue;
		$grade_year->class->CurrentValue = $grade_year->class->FormValue;
		$grade_year->year->CurrentValue = $grade_year->year->FormValue;
		$grade_year->promoted->CurrentValue = $grade_year->promoted->FormValue;
		$grade_year->programme->CurrentValue = $grade_year->programme->FormValue;
		$grade_year->school_attendance_school_attendance_id->CurrentValue = $grade_year->school_attendance_school_attendance_id->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $grade_year;
		$sFilter = $grade_year->KeyFilter();

		// Call Row Selecting event
		$grade_year->Row_Selecting($sFilter);

		// Load SQL based on filter
		$grade_year->CurrentFilter = $sFilter;
		$sSql = $grade_year->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$grade_year->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $grade_year;
		$grade_year->grade_year_id->setDbValue($rs->fields('grade_year_id'));
		$grade_year->class->setDbValue($rs->fields('class'));
		$grade_year->year->setDbValue($rs->fields('year'));
		$grade_year->promoted->setDbValue($rs->fields('promoted'));
		$grade_year->programme->setDbValue($rs->fields('programme'));
		$grade_year->school_attendance_school_attendance_id->setDbValue($rs->fields('school_attendance_school_attendance_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $grade_year;

		// Initialize URLs
		// Call Row_Rendering event

		$grade_year->Row_Rendering();

		// Common render codes for all row types
		// class

		$grade_year->class->CellCssStyle = ""; $grade_year->class->CellCssClass = "";
		$grade_year->class->CellAttrs = array(); $grade_year->class->ViewAttrs = array(); $grade_year->class->EditAttrs = array();

		// year
		$grade_year->year->CellCssStyle = ""; $grade_year->year->CellCssClass = "";
		$grade_year->year->CellAttrs = array(); $grade_year->year->ViewAttrs = array(); $grade_year->year->EditAttrs = array();

		// promoted
		$grade_year->promoted->CellCssStyle = ""; $grade_year->promoted->CellCssClass = "";
		$grade_year->promoted->CellAttrs = array(); $grade_year->promoted->ViewAttrs = array(); $grade_year->promoted->EditAttrs = array();

		// programme
		$grade_year->programme->CellCssStyle = ""; $grade_year->programme->CellCssClass = "";
		$grade_year->programme->CellAttrs = array(); $grade_year->programme->ViewAttrs = array(); $grade_year->programme->EditAttrs = array();

		// school_attendance_school_attendance_id
		$grade_year->school_attendance_school_attendance_id->CellCssStyle = ""; $grade_year->school_attendance_school_attendance_id->CellCssClass = "";
		$grade_year->school_attendance_school_attendance_id->CellAttrs = array(); $grade_year->school_attendance_school_attendance_id->ViewAttrs = array(); $grade_year->school_attendance_school_attendance_id->EditAttrs = array();
		if ($grade_year->RowType == EW_ROWTYPE_VIEW) { // View row

			// grade_year_id
			$grade_year->grade_year_id->ViewValue = $grade_year->grade_year_id->CurrentValue;
			$grade_year->grade_year_id->CssStyle = "";
			$grade_year->grade_year_id->CssClass = "";
			$grade_year->grade_year_id->ViewCustomAttributes = "";

			// class
			$grade_year->class->ViewValue = $grade_year->class->CurrentValue;
			$grade_year->class->CssStyle = "";
			$grade_year->class->CssClass = "";
			$grade_year->class->ViewCustomAttributes = "";

			// year
			$grade_year->year->ViewValue = $grade_year->year->CurrentValue;
			$grade_year->year->CssStyle = "";
			$grade_year->year->CssClass = "";
			$grade_year->year->ViewCustomAttributes = "";

			// promoted
			if (strval($grade_year->promoted->CurrentValue) <> "") {
				switch ($grade_year->promoted->CurrentValue) {
					case "1":
						$grade_year->promoted->ViewValue = "Yes";
						break;
					case "0":
						$grade_year->promoted->ViewValue = "No";
						break;
					default:
						$grade_year->promoted->ViewValue = $grade_year->promoted->CurrentValue;
				}
			} else {
				$grade_year->promoted->ViewValue = NULL;
			}
			$grade_year->promoted->CssStyle = "";
			$grade_year->promoted->CssClass = "";
			$grade_year->promoted->ViewCustomAttributes = "";

			// programme
			$grade_year->programme->ViewValue = $grade_year->programme->CurrentValue;
			$grade_year->programme->CssStyle = "";
			$grade_year->programme->CssClass = "";
			$grade_year->programme->ViewCustomAttributes = "";

			// school_attendance_school_attendance_id
			$grade_year->school_attendance_school_attendance_id->ViewValue = $grade_year->school_attendance_school_attendance_id->CurrentValue;
			$grade_year->school_attendance_school_attendance_id->CssStyle = "";
			$grade_year->school_attendance_school_attendance_id->CssClass = "";
			$grade_year->school_attendance_school_attendance_id->ViewCustomAttributes = "";

			// class
			$grade_year->class->HrefValue = "";
			$grade_year->class->TooltipValue = "";

			// year
			$grade_year->year->HrefValue = "";
			$grade_year->year->TooltipValue = "";

			// promoted
			$grade_year->promoted->HrefValue = "";
			$grade_year->promoted->TooltipValue = "";

			// programme
			$grade_year->programme->HrefValue = "";
			$grade_year->programme->TooltipValue = "";

			// school_attendance_school_attendance_id
			$grade_year->school_attendance_school_attendance_id->HrefValue = "";
			$grade_year->school_attendance_school_attendance_id->TooltipValue = "";
		} elseif ($grade_year->RowType == EW_ROWTYPE_ADD) { // Add row

			// class
			$grade_year->class->EditCustomAttributes = "";
			$grade_year->class->EditValue = ew_HtmlEncode($grade_year->class->CurrentValue);

			// year
			$grade_year->year->EditCustomAttributes = "";
			$grade_year->year->EditValue = ew_HtmlEncode($grade_year->year->CurrentValue);

			// promoted
			$grade_year->promoted->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", "Yes");
			$arwrk[] = array("0", "No");
			$grade_year->promoted->EditValue = $arwrk;

			// programme
			$grade_year->programme->EditCustomAttributes = "";
			$grade_year->programme->EditValue = ew_HtmlEncode($grade_year->programme->CurrentValue);

			// school_attendance_school_attendance_id
			$grade_year->school_attendance_school_attendance_id->EditCustomAttributes = "";
			if ($grade_year->school_attendance_school_attendance_id->getSessionValue() <> "") {
				$grade_year->school_attendance_school_attendance_id->CurrentValue = $grade_year->school_attendance_school_attendance_id->getSessionValue();
			$grade_year->school_attendance_school_attendance_id->ViewValue = $grade_year->school_attendance_school_attendance_id->CurrentValue;
			$grade_year->school_attendance_school_attendance_id->CssStyle = "";
			$grade_year->school_attendance_school_attendance_id->CssClass = "";
			$grade_year->school_attendance_school_attendance_id->ViewCustomAttributes = "";
			} else {
			$grade_year->school_attendance_school_attendance_id->EditValue = ew_HtmlEncode($grade_year->school_attendance_school_attendance_id->CurrentValue);
			}
		}

		// Call Row Rendered event
		if ($grade_year->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$grade_year->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $grade_year;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($grade_year->class->FormValue) && $grade_year->class->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $grade_year->class->FldCaption();
		}
		if (!ew_CheckInteger($grade_year->year->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $grade_year->year->FldErrMsg();
		}
		if (!ew_CheckInteger($grade_year->school_attendance_school_attendance_id->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $grade_year->school_attendance_school_attendance_id->FldErrMsg();
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
		global $conn, $Language, $Security, $grade_year;

		// Check if valid key values for master user
		if ($Security->CurrentUserID() <> "" && !$Security->IsAdmin()) { // Non system admin
			$sFilter = $grade_year->SqlMasterFilter_school_attendance();
			if (strval($grade_year->school_attendance_school_attendance_id->CurrentValue) <> "" &&
				$grade_year->getCurrentMasterTable() == "school_attendance") {
				$sFilter = str_replace("@school_attendance_id@", ew_AdjustSql($grade_year->school_attendance_school_attendance_id->CurrentValue), $sFilter);
			} else {
				$sFilter = "";
			}
			if ($sFilter <> "") {			
				$rsmaster = $GLOBALS["school_attendance"]->LoadRs($sFilter);
				$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
				if (!$this->bMasterRecordExists) {
					$sMasterUserIdMsg = str_replace("%c", CurrentUserID(), $Language->Phrase("UnAuthorizedMasterUserID"));
					$sMasterUserIdMsg = str_replace("%f", $sFilter, $sMasterUserIdMsg);
					$this->setMessage($sMasterUserIdMsg);					
					return FALSE;
				} else {
					$rsmaster->Close();
				}
			}
		}
		$rsnew = array();

		// class
		$grade_year->class->SetDbValueDef($rsnew, $grade_year->class->CurrentValue, NULL, FALSE);

		// year
		$grade_year->year->SetDbValueDef($rsnew, $grade_year->year->CurrentValue, NULL, FALSE);

		// promoted
		$grade_year->promoted->SetDbValueDef($rsnew, $grade_year->promoted->CurrentValue, NULL, FALSE);

		// programme
		$grade_year->programme->SetDbValueDef($rsnew, $grade_year->programme->CurrentValue, NULL, FALSE);

		// school_attendance_school_attendance_id
		$grade_year->school_attendance_school_attendance_id->SetDbValueDef($rsnew, $grade_year->school_attendance_school_attendance_id->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$bInsertRow = $grade_year->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($grade_year->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($grade_year->CancelMessage <> "") {
				$this->setMessage($grade_year->CancelMessage);
				$grade_year->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$grade_year->grade_year_id->setDbValue($conn->Insert_ID());
			$rsnew['grade_year_id'] = $grade_year->grade_year_id->DbValue;

			// Call Row Inserted event
			$grade_year->Row_Inserted($rsnew);
		}
		return $AddRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $grade_year;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "school_attendance") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $grade_year->SqlMasterFilter_school_attendance();
				$this->sDbDetailFilter = $grade_year->SqlDetailFilter_school_attendance();
				if (@$_GET["school_attendance_id"] <> "") {
					$GLOBALS["school_attendance"]->school_attendance_id->setQueryStringValue($_GET["school_attendance_id"]);
					$grade_year->school_attendance_school_attendance_id->setQueryStringValue($GLOBALS["school_attendance"]->school_attendance_id->QueryStringValue);
					$grade_year->school_attendance_school_attendance_id->setSessionValue($grade_year->school_attendance_school_attendance_id->QueryStringValue);
					if (!is_numeric($GLOBALS["school_attendance"]->school_attendance_id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@school_attendance_id@", ew_AdjustSql($GLOBALS["school_attendance"]->school_attendance_id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@school_attendance_school_attendance_id@", ew_AdjustSql($GLOBALS["school_attendance"]->school_attendance_id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$grade_year->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$grade_year->setStartRecordNumber($this->lStartRec);
			$grade_year->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$grade_year->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "school_attendance") {
				if ($grade_year->school_attendance_school_attendance_id->QueryStringValue == "") $grade_year->school_attendance_school_attendance_id->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $grade_year->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $grade_year->getDetailFilter(); // Restore detail filter
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
