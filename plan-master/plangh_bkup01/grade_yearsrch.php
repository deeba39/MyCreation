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
$grade_year_search = new cgrade_year_search();
$Page =& $grade_year_search;

// Page init
$grade_year_search->Page_Init();

// Page main
$grade_year_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var grade_year_search = new ew_Page("grade_year_search");

// page properties
grade_year_search.PageID = "search"; // page ID
grade_year_search.FormID = "fgrade_yearsearch"; // form ID
var EW_PAGE_ID = grade_year_search.PageID; // for backward compatibility

// extend page with validate function for search
grade_year_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_year"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($grade_year->year->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_school_attendance_school_attendance_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($grade_year->school_attendance_school_attendance_id->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj))
			return false;
	}
	for (var i=0; i<fobj.elements.length; i++) {
		var elem = fobj.elements[i];
		if (elem.name.substring(0,2) == "s_" || elem.name.substring(0,3) == "sv_")
			elem.value = "";
	}
	return true;
}

// extend page with Form_CustomValidate function
grade_year_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
grade_year_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
grade_year_search.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $grade_year->TableCaption() ?><br><br>
<a href="<?php echo $grade_year->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$grade_year_search->ShowMessage();
?>
<form name="fgrade_yearsearch" id="fgrade_yearsearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return grade_year_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="grade_year">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $grade_year->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grade_year->class->FldCaption() ?></td>
		<td<?php echo $grade_year->class->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_class" id="z_class" value="LIKE"></span></td>
		<td<?php echo $grade_year->class->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_class" id="x_class" title="<?php echo $grade_year->class->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $grade_year->class->EditValue ?>"<?php echo $grade_year->class->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $grade_year->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grade_year->year->FldCaption() ?></td>
		<td<?php echo $grade_year->year->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_year" id="z_year" value="="></span></td>
		<td<?php echo $grade_year->year->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_year" id="x_year" title="<?php echo $grade_year->year->FldTitle() ?>" size="30" value="<?php echo $grade_year->year->EditValue ?>"<?php echo $grade_year->year->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $grade_year->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grade_year->promoted->FldCaption() ?></td>
		<td<?php echo $grade_year->promoted->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_promoted" id="z_promoted" value="="></span></td>
		<td<?php echo $grade_year->promoted->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<div id="tp_x_promoted" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_promoted" id="x_promoted" title="<?php echo $grade_year->promoted->FldTitle() ?>" value="{value}"<?php echo $grade_year->promoted->EditAttributes() ?>></label></div>
<div id="dsl_x_promoted" repeatcolumn="5">
<?php
$arwrk = $grade_year->promoted->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($grade_year->promoted->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
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
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $grade_year->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grade_year->programme->FldCaption() ?></td>
		<td<?php echo $grade_year->programme->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_programme" id="z_programme" value="LIKE"></span></td>
		<td<?php echo $grade_year->programme->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_programme" id="x_programme" title="<?php echo $grade_year->programme->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $grade_year->programme->EditValue ?>"<?php echo $grade_year->programme->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $grade_year->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grade_year->school_attendance_school_attendance_id->FldCaption() ?></td>
		<td<?php echo $grade_year->school_attendance_school_attendance_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_school_attendance_school_attendance_id" id="z_school_attendance_school_attendance_id" value="="></span></td>
		<td<?php echo $grade_year->school_attendance_school_attendance_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_school_attendance_school_attendance_id" id="x_school_attendance_school_attendance_id" title="<?php echo $grade_year->school_attendance_school_attendance_id->FldTitle() ?>" size="30" value="<?php echo $grade_year->school_attendance_school_attendance_id->EditValue ?>"<?php echo $grade_year->school_attendance_school_attendance_id->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("Search")) ?>">
<input type="button" name="Reset" id="Reset" value="<?php echo ew_BtnCaption($Language->Phrase("Reset")) ?>" onclick="ew_ClearForm(this.form);">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$grade_year_search->Page_Terminate();
?>
<?php

//
// Page class
//
class cgrade_year_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'grade_year';

	// Page object name
	var $PageObjName = 'grade_year_search';

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
	function cgrade_year_search() {
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
			define("EW_PAGE_ID", 'search', TRUE);

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
		if (!$Security->CanSearch()) {
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

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError, $grade_year;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$grade_year->CurrentAction = $objForm->GetValue("a_search");
			switch ($grade_year->CurrentAction) {
				case "S": // Get search criteria

					// Build search string for advanced search, remove blank field
					$this->LoadSearchValues(); // Get search values
					if ($this->ValidateSearch()) {
						$sSrchStr = $this->BuildAdvancedSearch();
					} else {
						$sSrchStr = "";
						$this->setMessage($gsSearchError);
					}
					if ($sSrchStr <> "") {
						$sSrchStr = $grade_year->UrlParm($sSrchStr);
						$this->Page_Terminate("grade_yearlist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$grade_year->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $grade_year;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $grade_year->class); // class
	$this->BuildSearchUrl($sSrchUrl, $grade_year->year); // year
	$this->BuildSearchUrl($sSrchUrl, $grade_year->promoted); // promoted
	$this->BuildSearchUrl($sSrchUrl, $grade_year->programme); // programme
	$this->BuildSearchUrl($sSrchUrl, $grade_year->school_attendance_school_attendance_id); // school_attendance_school_attendance_id
	return $sSrchUrl;
}

// Build search URL
function BuildSearchUrl(&$Url, &$Fld) {
	global $objForm;
	$sWrk = "";
	$FldParm = substr($Fld->FldVar, 2);
	$FldVal = $objForm->GetValue("x_$FldParm");
	$FldOpr = $objForm->GetValue("z_$FldParm");
	$FldCond = $objForm->GetValue("v_$FldParm");
	$FldVal2 = $objForm->GetValue("y_$FldParm");
	$FldOpr2 = $objForm->GetValue("w_$FldParm");
	$FldVal = ew_StripSlashes($FldVal);
	if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
	$FldVal2 = ew_StripSlashes($FldVal2);
	if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
	$FldOpr = strtoupper(trim($FldOpr));
	$lFldDataType = ($Fld->FldIsVirtual) ? EW_DATATYPE_STRING : $Fld->FldDataType;
	if ($FldOpr == "BETWEEN") {
		$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
			($lFldDataType == EW_DATATYPE_NUMBER && is_numeric($FldVal) && is_numeric($FldVal2));
		if ($FldVal <> "" && $FldVal2 <> "" && $IsValidValue) {
			$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
				"&y_" . $FldParm . "=" . urlencode($FldVal2) .
				"&z_" . $FldParm . "=" . urlencode($FldOpr);
		}
	} elseif ($FldOpr == "IS NULL" || $FldOpr == "IS NOT NULL") {
		$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
			"&z_" . $FldParm . "=" . urlencode($FldOpr);
	} else {
		$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
			($lFldDataType == EW_DATATYPE_NUMBER && is_numeric($FldVal));
		if ($FldVal <> "" && $IsValidValue && ew_IsValidOpr($FldOpr, $lFldDataType)) {

			//$FldVal = $this->ConvertSearchValue($Fld, $FldVal);
			$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
				"&z_" . $FldParm . "=" . urlencode($FldOpr);
		}
		$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
			($lFldDataType == EW_DATATYPE_NUMBER && is_numeric($FldVal2));
		if ($FldVal2 <> "" && $IsValidValue && ew_IsValidOpr($FldOpr2, $lFldDataType)) {

			//$FldVal2 = $this->ConvertSearchValue($Fld, $FldVal2);
			if ($sWrk <> "") $sWrk .= "&v_" . $FldParm . "=" . urlencode($FldCond) . "&";
			$sWrk .= "&y_" . $FldParm . "=" . urlencode($FldVal2) .
				"&w_" . $FldParm . "=" . urlencode($FldOpr2);
		}
	}
	if ($sWrk <> "") {
		if ($Url <> "") $Url .= "&";
		$Url .= $sWrk;
	}
}

// Convert search value for date
function ConvertSearchValue(&$Fld, $FldVal) {
	$Value = $FldVal;
	if ($Fld->FldDataType == EW_DATATYPE_DATE && $FldVal <> "")
		$Value = ew_UnFormatDateTime($FldVal, $Fld->FldDateTimeFormat);
	return $Value;
}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $grade_year;

		// Load search values
		// class

		$grade_year->class->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_class"));
		$grade_year->class->AdvancedSearch->SearchOperator = $objForm->GetValue("z_class");

		// year
		$grade_year->year->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_year"));
		$grade_year->year->AdvancedSearch->SearchOperator = $objForm->GetValue("z_year");

		// promoted
		$grade_year->promoted->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_promoted"));
		$grade_year->promoted->AdvancedSearch->SearchOperator = $objForm->GetValue("z_promoted");

		// programme
		$grade_year->programme->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_programme"));
		$grade_year->programme->AdvancedSearch->SearchOperator = $objForm->GetValue("z_programme");

		// school_attendance_school_attendance_id
		$grade_year->school_attendance_school_attendance_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_school_attendance_school_attendance_id"));
		$grade_year->school_attendance_school_attendance_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_school_attendance_school_attendance_id");
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
		} elseif ($grade_year->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// class
			$grade_year->class->EditCustomAttributes = "";
			$grade_year->class->EditValue = ew_HtmlEncode($grade_year->class->AdvancedSearch->SearchValue);

			// year
			$grade_year->year->EditCustomAttributes = "";
			$grade_year->year->EditValue = ew_HtmlEncode($grade_year->year->AdvancedSearch->SearchValue);

			// promoted
			$grade_year->promoted->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", "Yes");
			$arwrk[] = array("0", "No");
			$grade_year->promoted->EditValue = $arwrk;

			// programme
			$grade_year->programme->EditCustomAttributes = "";
			$grade_year->programme->EditValue = ew_HtmlEncode($grade_year->programme->AdvancedSearch->SearchValue);

			// school_attendance_school_attendance_id
			$grade_year->school_attendance_school_attendance_id->EditCustomAttributes = "";
			$grade_year->school_attendance_school_attendance_id->EditValue = ew_HtmlEncode($grade_year->school_attendance_school_attendance_id->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		if ($grade_year->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$grade_year->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $grade_year;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($grade_year->year->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $grade_year->year->FldErrMsg();
		}
		if (!ew_CheckInteger($grade_year->school_attendance_school_attendance_id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $grade_year->school_attendance_school_attendance_id->FldErrMsg();
		}

		// Return validate result
		$ValidateSearch = ($gsSearchError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateSearch = $ValidateSearch && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $sFormCustomError;
		}
		return $ValidateSearch;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $grade_year;
		$grade_year->class->AdvancedSearch->SearchValue = $grade_year->getAdvancedSearch("x_class");
		$grade_year->year->AdvancedSearch->SearchValue = $grade_year->getAdvancedSearch("x_year");
		$grade_year->promoted->AdvancedSearch->SearchValue = $grade_year->getAdvancedSearch("x_promoted");
		$grade_year->programme->AdvancedSearch->SearchValue = $grade_year->getAdvancedSearch("x_programme");
		$grade_year->school_attendance_school_attendance_id->AdvancedSearch->SearchValue = $grade_year->getAdvancedSearch("x_school_attendance_school_attendance_id");
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
