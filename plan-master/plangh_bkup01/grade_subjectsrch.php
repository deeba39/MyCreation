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
$grade_subject_search = new cgrade_subject_search();
$Page =& $grade_subject_search;

// Page init
$grade_subject_search->Page_Init();

// Page main
$grade_subject_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var grade_subject_search = new ew_Page("grade_subject_search");

// page properties
grade_subject_search.PageID = "search"; // page ID
grade_subject_search.FormID = "fgrade_subjectsearch"; // form ID
var EW_PAGE_ID = grade_subject_search.PageID; // for backward compatibility

// extend page with validate function for search
grade_subject_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_grade_subject_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($grade_subject->grade_subject_id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_raw_score"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($grade_subject->raw_score->FldErrMsg()) ?>");

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
grade_subject_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
grade_subject_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
grade_subject_search.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $grade_subject->TableCaption() ?><br><br>
<a href="<?php echo $grade_subject->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$grade_subject_search->ShowMessage();
?>
<form name="fgrade_subjectsearch" id="fgrade_subjectsearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return grade_subject_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="grade_subject">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $grade_subject->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grade_subject->grade_subject_id->FldCaption() ?></td>
		<td<?php echo $grade_subject->grade_subject_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_grade_subject_id" id="z_grade_subject_id" value="="></span></td>
		<td<?php echo $grade_subject->grade_subject_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_grade_subject_id" id="x_grade_subject_id" title="<?php echo $grade_subject->grade_subject_id->FldTitle() ?>" value="<?php echo $grade_subject->grade_subject_id->EditValue ?>"<?php echo $grade_subject->grade_subject_id->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $grade_subject->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grade_subject->subject->FldCaption() ?></td>
		<td<?php echo $grade_subject->subject->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_subject" id="z_subject" value="LIKE"></span></td>
		<td<?php echo $grade_subject->subject->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_subject" id="x_subject" title="<?php echo $grade_subject->subject->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $grade_subject->subject->EditValue ?>"<?php echo $grade_subject->subject->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $grade_subject->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grade_subject->raw_score->FldCaption() ?></td>
		<td<?php echo $grade_subject->raw_score->CellAttributes() ?>><span class="ewSearchOpr"><select name="z_raw_score" id="z_raw_score" onchange="ew_SrchOprChanged('z_raw_score')"><option value="="<?php echo ($grade_subject->raw_score->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($grade_subject->raw_score->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($grade_subject->raw_score->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($grade_subject->raw_score->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($grade_subject->raw_score->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($grade_subject->raw_score->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($grade_subject->raw_score->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></span></td>
		<td<?php echo $grade_subject->raw_score->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_raw_score" id="x_raw_score" title="<?php echo $grade_subject->raw_score->FldTitle() ?>" size="30" value="<?php echo $grade_subject->raw_score->EditValue ?>"<?php echo $grade_subject->raw_score->EditAttributes() ?>>
</span>
				<span class="ewSearchOpr" id="btw0_raw_score" name="btw0_raw_score"><label><input type="radio" name="v_raw_score" id="v_raw_score" value="AND"<?php if ($grade_subject->raw_score->AdvancedSearch->SearchCondition <> "OR") echo " checked=\"checked\"" ?>><?php echo $Language->Phrase("AND") ?></label>&nbsp;<label><input type="radio" name="v_raw_score" id="v_raw_score" value="OR"<?php if ($grade_subject->raw_score->AdvancedSearch->SearchCondition == "OR") echo " checked=\"checked\"" ?>><?php echo $Language->Phrase("OR") ?></label>&nbsp;</span>
				<span class="ewSearchOpr" id="btw1_raw_score" name="btw1_raw_score">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="ewSearchOpr" id="btw0_raw_score" name="btw0_raw_score" ><select name="w_raw_score" id="w_raw_score"><option value="="<?php echo ($grade_subject->raw_score->AdvancedSearch->SearchOperator2=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($grade_subject->raw_score->AdvancedSearch->SearchOperator2=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($grade_subject->raw_score->AdvancedSearch->SearchOperator2=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($grade_subject->raw_score->AdvancedSearch->SearchOperator2=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($grade_subject->raw_score->AdvancedSearch->SearchOperator2==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($grade_subject->raw_score->AdvancedSearch->SearchOperator2==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option></select></span>
				<span class="phpmaker" style="float: left;">
<input type="text" name="y_raw_score" id="y_raw_score" title="<?php echo $grade_subject->raw_score->FldTitle() ?>" size="30" value="<?php echo $grade_subject->raw_score->EditValue2 ?>"<?php echo $grade_subject->raw_score->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $grade_subject->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grade_subject->letter_score->FldCaption() ?></td>
		<td<?php echo $grade_subject->letter_score->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_letter_score" id="z_letter_score" value="LIKE"></span></td>
		<td<?php echo $grade_subject->letter_score->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_letter_score" id="x_letter_score" title="<?php echo $grade_subject->letter_score->FldTitle() ?>" size="30" maxlength="3" value="<?php echo $grade_subject->letter_score->EditValue ?>"<?php echo $grade_subject->letter_score->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $grade_subject->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grade_subject->letter_description->FldCaption() ?></td>
		<td<?php echo $grade_subject->letter_description->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_letter_description" id="z_letter_description" value="LIKE"></span></td>
		<td<?php echo $grade_subject->letter_description->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_letter_description" id="x_letter_description" title="<?php echo $grade_subject->letter_description->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $grade_subject->letter_description->EditValue ?>"<?php echo $grade_subject->letter_description->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $grade_subject->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grade_subject->grade_year_grade_year_id->FldCaption() ?></td>
		<td<?php echo $grade_subject->grade_year_grade_year_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_grade_year_grade_year_id" id="z_grade_year_grade_year_id" value="="></span></td>
		<td<?php echo $grade_subject->grade_year_grade_year_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_grade_year_grade_year_id" name="x_grade_year_grade_year_id" title="<?php echo $grade_subject->grade_year_grade_year_id->FldTitle() ?>"<?php echo $grade_subject->grade_year_grade_year_id->EditAttributes() ?>>
<?php
if (is_array($grade_subject->grade_year_grade_year_id->EditValue)) {
	$arwrk = $grade_subject->grade_year_grade_year_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($grade_subject->grade_year_grade_year_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
ew_SrchOprChanged('z_raw_score');

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$grade_subject_search->Page_Terminate();
?>
<?php

//
// Page class
//
class cgrade_subject_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'grade_subject';

	// Page object name
	var $PageObjName = 'grade_subject_search';

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
	function cgrade_subject_search() {
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
			define("EW_PAGE_ID", 'search', TRUE);

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
		if (!$Security->CanSearch()) {
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

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError, $grade_subject;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$grade_subject->CurrentAction = $objForm->GetValue("a_search");
			switch ($grade_subject->CurrentAction) {
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
						$sSrchStr = $grade_subject->UrlParm($sSrchStr);
						$this->Page_Terminate("grade_subjectlist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$grade_subject->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $grade_subject;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $grade_subject->grade_subject_id); // grade_subject_id
	$this->BuildSearchUrl($sSrchUrl, $grade_subject->subject); // subject
	$this->BuildSearchUrl($sSrchUrl, $grade_subject->raw_score); // raw_score
	$this->BuildSearchUrl($sSrchUrl, $grade_subject->letter_score); // letter_score
	$this->BuildSearchUrl($sSrchUrl, $grade_subject->letter_description); // letter_description
	$this->BuildSearchUrl($sSrchUrl, $grade_subject->grade_year_grade_year_id); // grade_year_grade_year_id
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
		global $objForm, $grade_subject;

		// Load search values
		// grade_subject_id

		$grade_subject->grade_subject_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_grade_subject_id"));
		$grade_subject->grade_subject_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_grade_subject_id");

		// subject
		$grade_subject->subject->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_subject"));
		$grade_subject->subject->AdvancedSearch->SearchOperator = $objForm->GetValue("z_subject");

		// raw_score
		$grade_subject->raw_score->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_raw_score"));
		$grade_subject->raw_score->AdvancedSearch->SearchOperator = $objForm->GetValue("z_raw_score");
		$grade_subject->raw_score->AdvancedSearch->SearchCondition = $objForm->GetValue("v_raw_score");
		$grade_subject->raw_score->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_raw_score"));
		$grade_subject->raw_score->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_raw_score");

		// letter_score
		$grade_subject->letter_score->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_letter_score"));
		$grade_subject->letter_score->AdvancedSearch->SearchOperator = $objForm->GetValue("z_letter_score");

		// letter_description
		$grade_subject->letter_description->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_letter_description"));
		$grade_subject->letter_description->AdvancedSearch->SearchOperator = $objForm->GetValue("z_letter_description");

		// grade_year_grade_year_id
		$grade_subject->grade_year_grade_year_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_grade_year_grade_year_id"));
		$grade_subject->grade_year_grade_year_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_grade_year_grade_year_id");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $grade_subject;

		// Initialize URLs
		// Call Row_Rendering event

		$grade_subject->Row_Rendering();

		// Common render codes for all row types
		// grade_subject_id

		$grade_subject->grade_subject_id->CellCssStyle = ""; $grade_subject->grade_subject_id->CellCssClass = "";
		$grade_subject->grade_subject_id->CellAttrs = array(); $grade_subject->grade_subject_id->ViewAttrs = array(); $grade_subject->grade_subject_id->EditAttrs = array();

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

			// grade_subject_id
			$grade_subject->grade_subject_id->HrefValue = "";
			$grade_subject->grade_subject_id->TooltipValue = "";

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
		} elseif ($grade_subject->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// grade_subject_id
			$grade_subject->grade_subject_id->EditCustomAttributes = "";
			$grade_subject->grade_subject_id->EditValue = ew_HtmlEncode($grade_subject->grade_subject_id->AdvancedSearch->SearchValue);

			// subject
			$grade_subject->subject->EditCustomAttributes = "";
			$grade_subject->subject->EditValue = ew_HtmlEncode($grade_subject->subject->AdvancedSearch->SearchValue);

			// raw_score
			$grade_subject->raw_score->EditCustomAttributes = "";
			$grade_subject->raw_score->EditValue = ew_HtmlEncode($grade_subject->raw_score->AdvancedSearch->SearchValue);
			$grade_subject->raw_score->EditCustomAttributes = "";
			$grade_subject->raw_score->EditValue2 = ew_HtmlEncode($grade_subject->raw_score->AdvancedSearch->SearchValue2);

			// letter_score
			$grade_subject->letter_score->EditCustomAttributes = "";
			$grade_subject->letter_score->EditValue = ew_HtmlEncode($grade_subject->letter_score->AdvancedSearch->SearchValue);

			// letter_description
			$grade_subject->letter_description->EditCustomAttributes = "";
			$grade_subject->letter_description->EditValue = ew_HtmlEncode($grade_subject->letter_description->AdvancedSearch->SearchValue);

			// grade_year_grade_year_id
			$grade_subject->grade_year_grade_year_id->EditCustomAttributes = "";
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

		// Call Row Rendered event
		if ($grade_subject->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$grade_subject->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $grade_subject;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($grade_subject->grade_subject_id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $grade_subject->grade_subject_id->FldErrMsg();
		}
		if (!ew_CheckInteger($grade_subject->raw_score->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $grade_subject->raw_score->FldErrMsg();
		}
		if (!ew_CheckInteger($grade_subject->raw_score->AdvancedSearch->SearchValue2)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $grade_subject->raw_score->FldErrMsg();
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
		global $grade_subject;
		$grade_subject->grade_subject_id->AdvancedSearch->SearchValue = $grade_subject->getAdvancedSearch("x_grade_subject_id");
		$grade_subject->subject->AdvancedSearch->SearchValue = $grade_subject->getAdvancedSearch("x_subject");
		$grade_subject->raw_score->AdvancedSearch->SearchValue = $grade_subject->getAdvancedSearch("x_raw_score");
		$grade_subject->raw_score->AdvancedSearch->SearchOperator = $grade_subject->getAdvancedSearch("z_raw_score");
		$grade_subject->raw_score->AdvancedSearch->SearchCondition = $grade_subject->getAdvancedSearch("v_raw_score");
		$grade_subject->raw_score->AdvancedSearch->SearchValue2 = $grade_subject->getAdvancedSearch("y_raw_score");
		$grade_subject->raw_score->AdvancedSearch->SearchOperator2 = $grade_subject->getAdvancedSearch("w_raw_score");
		$grade_subject->letter_score->AdvancedSearch->SearchValue = $grade_subject->getAdvancedSearch("x_letter_score");
		$grade_subject->letter_description->AdvancedSearch->SearchValue = $grade_subject->getAdvancedSearch("x_letter_description");
		$grade_subject->grade_year_grade_year_id->AdvancedSearch->SearchValue = $grade_subject->getAdvancedSearch("x_grade_year_grade_year_id");
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
