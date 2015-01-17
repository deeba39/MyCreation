<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "schoolsinfo.php" ?>
<?php include "programareainfo.php" ?>
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
$schools_search = new cschools_search();
$Page =& $schools_search;

// Page init
$schools_search->Page_Init();

// Page main
$schools_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var schools_search = new ew_Page("schools_search");

// page properties
schools_search.PageID = "search"; // page ID
schools_search.FormID = "fschoolssearch"; // form ID
var EW_PAGE_ID = schools_search.PageID; // for backward compatibility

// extend page with validate function for search
schools_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_school_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($schools->school_id->FldErrMsg()) ?>");

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
schools_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
schools_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
schools_search.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $schools->TableCaption() ?><br><br>
<a href="<?php echo $schools->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$schools_search->ShowMessage();
?>
<form name="fschoolssearch" id="fschoolssearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return schools_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="schools">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $schools->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $schools->school_id->FldCaption() ?></td>
		<td<?php echo $schools->school_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_school_id" id="z_school_id" value="="></span></td>
		<td<?php echo $schools->school_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_school_id" id="x_school_id" title="<?php echo $schools->school_id->FldTitle() ?>" value="<?php echo $schools->school_id->EditValue ?>"<?php echo $schools->school_id->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $schools->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $schools->school_name->FldCaption() ?></td>
		<td<?php echo $schools->school_name->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_school_name" id="z_school_name" value="LIKE"></span></td>
		<td<?php echo $schools->school_name->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_school_name" id="x_school_name" title="<?php echo $schools->school_name->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $schools->school_name->EditValue ?>"<?php echo $schools->school_name->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $schools->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $schools->address->FldCaption() ?></td>
		<td<?php echo $schools->address->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_address" id="z_address" value="LIKE"></span></td>
		<td<?php echo $schools->address->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_address" id="x_address" title="<?php echo $schools->address->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $schools->address->EditValue ?>"<?php echo $schools->address->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $schools->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $schools->towncity->FldCaption() ?></td>
		<td<?php echo $schools->towncity->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_towncity" id="z_towncity" value="LIKE"></span></td>
		<td<?php echo $schools->towncity->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_towncity" id="x_towncity" title="<?php echo $schools->towncity->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $schools->towncity->EditValue ?>"<?php echo $schools->towncity->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $schools->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $schools->school_type->FldCaption() ?></td>
		<td<?php echo $schools->school_type->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_school_type" id="z_school_type" value="LIKE"></span></td>
		<td<?php echo $schools->school_type->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_school_type" name="x_school_type" title="<?php echo $schools->school_type->FldTitle() ?>"<?php echo $schools->school_type->EditAttributes() ?>>
<?php
if (is_array($schools->school_type->EditValue)) {
	$arwrk = $schools->school_type->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($schools->school_type->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $schools->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $schools->contact_person_name->FldCaption() ?></td>
		<td<?php echo $schools->contact_person_name->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_contact_person_name" id="z_contact_person_name" value="LIKE"></span></td>
		<td<?php echo $schools->contact_person_name->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_contact_person_name" id="x_contact_person_name" title="<?php echo $schools->contact_person_name->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $schools->contact_person_name->EditValue ?>"<?php echo $schools->contact_person_name->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $schools->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $schools->telephone->FldCaption() ?></td>
		<td<?php echo $schools->telephone->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_telephone" id="z_telephone" value="LIKE"></span></td>
		<td<?php echo $schools->telephone->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_telephone" id="x_telephone" title="<?php echo $schools->telephone->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $schools->telephone->EditValue ?>"<?php echo $schools->telephone->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $schools->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $schools->bankname->FldCaption() ?></td>
		<td<?php echo $schools->bankname->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_bankname" id="z_bankname" value="LIKE"></span></td>
		<td<?php echo $schools->bankname->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_bankname" id="x_bankname" title="<?php echo $schools->bankname->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $schools->bankname->EditValue ?>"<?php echo $schools->bankname->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $schools->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $schools->account_no->FldCaption() ?></td>
		<td<?php echo $schools->account_no->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_account_no" id="z_account_no" value="LIKE"></span></td>
		<td<?php echo $schools->account_no->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_account_no" id="x_account_no" title="<?php echo $schools->account_no->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $schools->account_no->EditValue ?>"<?php echo $schools->account_no->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $schools->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $schools->programarea_programarea_id->FldCaption() ?></td>
		<td<?php echo $schools->programarea_programarea_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_programarea_programarea_id" id="z_programarea_programarea_id" value="="></span></td>
		<td<?php echo $schools->programarea_programarea_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_programarea_programarea_id" name="x_programarea_programarea_id" title="<?php echo $schools->programarea_programarea_id->FldTitle() ?>"<?php echo $schools->programarea_programarea_id->EditAttributes() ?>>
<?php
if (is_array($schools->programarea_programarea_id->EditValue)) {
	$arwrk = $schools->programarea_programarea_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($schools->programarea_programarea_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$schools_search->Page_Terminate();
?>
<?php

//
// Page class
//
class cschools_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'schools';

	// Page object name
	var $PageObjName = 'schools_search';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $schools;
		if ($schools->UseTokenInUrl) $PageUrl .= "t=" . $schools->TableVar . "&"; // Add page token
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
		global $objForm, $schools;
		if ($schools->UseTokenInUrl) {
			if ($objForm)
				return ($schools->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($schools->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cschools_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (schools)
		$GLOBALS["schools"] = new cschools();

		// Table object (programarea)
		$GLOBALS['programarea'] = new cprogramarea();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'schools', TRUE);

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
		global $schools;

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
			$this->Page_Terminate("schoolslist.php");
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
		global $objForm, $Language, $gsSearchError, $schools;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$schools->CurrentAction = $objForm->GetValue("a_search");
			switch ($schools->CurrentAction) {
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
						$sSrchStr = $schools->UrlParm($sSrchStr);
						$this->Page_Terminate("schoolslist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$schools->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $schools;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $schools->school_id); // school_id
	$this->BuildSearchUrl($sSrchUrl, $schools->school_name); // school_name
	$this->BuildSearchUrl($sSrchUrl, $schools->address); // address
	$this->BuildSearchUrl($sSrchUrl, $schools->towncity); // towncity
	$this->BuildSearchUrl($sSrchUrl, $schools->school_type); // school_type
	$this->BuildSearchUrl($sSrchUrl, $schools->contact_person_name); // contact_person_name
	$this->BuildSearchUrl($sSrchUrl, $schools->telephone); // telephone
	$this->BuildSearchUrl($sSrchUrl, $schools->bankname); // bankname
	$this->BuildSearchUrl($sSrchUrl, $schools->account_no); // account_no
	$this->BuildSearchUrl($sSrchUrl, $schools->programarea_programarea_id); // programarea_programarea_id
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
		global $objForm, $schools;

		// Load search values
		// school_id

		$schools->school_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_school_id"));
		$schools->school_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_school_id");

		// school_name
		$schools->school_name->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_school_name"));
		$schools->school_name->AdvancedSearch->SearchOperator = $objForm->GetValue("z_school_name");

		// address
		$schools->address->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_address"));
		$schools->address->AdvancedSearch->SearchOperator = $objForm->GetValue("z_address");

		// towncity
		$schools->towncity->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_towncity"));
		$schools->towncity->AdvancedSearch->SearchOperator = $objForm->GetValue("z_towncity");

		// school_type
		$schools->school_type->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_school_type"));
		$schools->school_type->AdvancedSearch->SearchOperator = $objForm->GetValue("z_school_type");

		// contact_person_name
		$schools->contact_person_name->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_contact_person_name"));
		$schools->contact_person_name->AdvancedSearch->SearchOperator = $objForm->GetValue("z_contact_person_name");

		// telephone
		$schools->telephone->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_telephone"));
		$schools->telephone->AdvancedSearch->SearchOperator = $objForm->GetValue("z_telephone");

		// bankname
		$schools->bankname->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_bankname"));
		$schools->bankname->AdvancedSearch->SearchOperator = $objForm->GetValue("z_bankname");

		// account_no
		$schools->account_no->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_account_no"));
		$schools->account_no->AdvancedSearch->SearchOperator = $objForm->GetValue("z_account_no");

		// programarea_programarea_id
		$schools->programarea_programarea_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_programarea_programarea_id"));
		$schools->programarea_programarea_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_programarea_programarea_id");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $schools;

		// Initialize URLs
		// Call Row_Rendering event

		$schools->Row_Rendering();

		// Common render codes for all row types
		// school_id

		$schools->school_id->CellCssStyle = ""; $schools->school_id->CellCssClass = "";
		$schools->school_id->CellAttrs = array(); $schools->school_id->ViewAttrs = array(); $schools->school_id->EditAttrs = array();

		// school_name
		$schools->school_name->CellCssStyle = ""; $schools->school_name->CellCssClass = "";
		$schools->school_name->CellAttrs = array(); $schools->school_name->ViewAttrs = array(); $schools->school_name->EditAttrs = array();

		// address
		$schools->address->CellCssStyle = ""; $schools->address->CellCssClass = "";
		$schools->address->CellAttrs = array(); $schools->address->ViewAttrs = array(); $schools->address->EditAttrs = array();

		// towncity
		$schools->towncity->CellCssStyle = ""; $schools->towncity->CellCssClass = "";
		$schools->towncity->CellAttrs = array(); $schools->towncity->ViewAttrs = array(); $schools->towncity->EditAttrs = array();

		// school_type
		$schools->school_type->CellCssStyle = ""; $schools->school_type->CellCssClass = "";
		$schools->school_type->CellAttrs = array(); $schools->school_type->ViewAttrs = array(); $schools->school_type->EditAttrs = array();

		// contact_person_name
		$schools->contact_person_name->CellCssStyle = ""; $schools->contact_person_name->CellCssClass = "";
		$schools->contact_person_name->CellAttrs = array(); $schools->contact_person_name->ViewAttrs = array(); $schools->contact_person_name->EditAttrs = array();

		// telephone
		$schools->telephone->CellCssStyle = ""; $schools->telephone->CellCssClass = "";
		$schools->telephone->CellAttrs = array(); $schools->telephone->ViewAttrs = array(); $schools->telephone->EditAttrs = array();

		// bankname
		$schools->bankname->CellCssStyle = ""; $schools->bankname->CellCssClass = "";
		$schools->bankname->CellAttrs = array(); $schools->bankname->ViewAttrs = array(); $schools->bankname->EditAttrs = array();

		// account_no
		$schools->account_no->CellCssStyle = ""; $schools->account_no->CellCssClass = "";
		$schools->account_no->CellAttrs = array(); $schools->account_no->ViewAttrs = array(); $schools->account_no->EditAttrs = array();

		// programarea_programarea_id
		$schools->programarea_programarea_id->CellCssStyle = ""; $schools->programarea_programarea_id->CellCssClass = "";
		$schools->programarea_programarea_id->CellAttrs = array(); $schools->programarea_programarea_id->ViewAttrs = array(); $schools->programarea_programarea_id->EditAttrs = array();
		if ($schools->RowType == EW_ROWTYPE_VIEW) { // View row

			// school_id
			$schools->school_id->ViewValue = $schools->school_id->CurrentValue;
			$schools->school_id->CssStyle = "";
			$schools->school_id->CssClass = "";
			$schools->school_id->ViewCustomAttributes = "";

			// school_name
			$schools->school_name->ViewValue = $schools->school_name->CurrentValue;
			$schools->school_name->CssStyle = "";
			$schools->school_name->CssClass = "";
			$schools->school_name->ViewCustomAttributes = "";

			// address
			$schools->address->ViewValue = $schools->address->CurrentValue;
			$schools->address->CssStyle = "";
			$schools->address->CssClass = "";
			$schools->address->ViewCustomAttributes = "";

			// towncity
			$schools->towncity->ViewValue = $schools->towncity->CurrentValue;
			$schools->towncity->CssStyle = "";
			$schools->towncity->CssClass = "";
			$schools->towncity->ViewCustomAttributes = "";

			// school_type
			if (strval($schools->school_type->CurrentValue) <> "") {
				$sFilterWrk = "`school_type` = '" . ew_AdjustSql($schools->school_type->CurrentValue) . "'";
			$sSqlWrk = "SELECT `school_type` FROM `school_type`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$schools->school_type->ViewValue = $rswrk->fields('school_type');
					$rswrk->Close();
				} else {
					$schools->school_type->ViewValue = $schools->school_type->CurrentValue;
				}
			} else {
				$schools->school_type->ViewValue = NULL;
			}
			$schools->school_type->CssStyle = "";
			$schools->school_type->CssClass = "";
			$schools->school_type->ViewCustomAttributes = "";

			// contact_person_name
			$schools->contact_person_name->ViewValue = $schools->contact_person_name->CurrentValue;
			$schools->contact_person_name->CssStyle = "";
			$schools->contact_person_name->CssClass = "";
			$schools->contact_person_name->ViewCustomAttributes = "";

			// telephone
			$schools->telephone->ViewValue = $schools->telephone->CurrentValue;
			$schools->telephone->CssStyle = "";
			$schools->telephone->CssClass = "";
			$schools->telephone->ViewCustomAttributes = "";

			// bankname
			$schools->bankname->ViewValue = $schools->bankname->CurrentValue;
			$schools->bankname->CssStyle = "";
			$schools->bankname->CssClass = "";
			$schools->bankname->ViewCustomAttributes = "";

			// account_no
			$schools->account_no->ViewValue = $schools->account_no->CurrentValue;
			$schools->account_no->CssStyle = "";
			$schools->account_no->CssClass = "";
			$schools->account_no->ViewCustomAttributes = "";

			// programarea_programarea_id
			if (strval($schools->programarea_programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($schools->programarea_programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$schools->programarea_programarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$schools->programarea_programarea_id->ViewValue = $schools->programarea_programarea_id->CurrentValue;
				}
			} else {
				$schools->programarea_programarea_id->ViewValue = NULL;
			}
			$schools->programarea_programarea_id->CssStyle = "";
			$schools->programarea_programarea_id->CssClass = "";
			$schools->programarea_programarea_id->ViewCustomAttributes = "";

			// school_id
			$schools->school_id->HrefValue = "";
			$schools->school_id->TooltipValue = "";

			// school_name
			$schools->school_name->HrefValue = "";
			$schools->school_name->TooltipValue = "";

			// address
			$schools->address->HrefValue = "";
			$schools->address->TooltipValue = "";

			// towncity
			$schools->towncity->HrefValue = "";
			$schools->towncity->TooltipValue = "";

			// school_type
			$schools->school_type->HrefValue = "";
			$schools->school_type->TooltipValue = "";

			// contact_person_name
			$schools->contact_person_name->HrefValue = "";
			$schools->contact_person_name->TooltipValue = "";

			// telephone
			$schools->telephone->HrefValue = "";
			$schools->telephone->TooltipValue = "";

			// bankname
			$schools->bankname->HrefValue = "";
			$schools->bankname->TooltipValue = "";

			// account_no
			$schools->account_no->HrefValue = "";
			$schools->account_no->TooltipValue = "";

			// programarea_programarea_id
			$schools->programarea_programarea_id->HrefValue = "";
			$schools->programarea_programarea_id->TooltipValue = "";
		} elseif ($schools->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// school_id
			$schools->school_id->EditCustomAttributes = "";
			$schools->school_id->EditValue = ew_HtmlEncode($schools->school_id->AdvancedSearch->SearchValue);

			// school_name
			$schools->school_name->EditCustomAttributes = "";
			$schools->school_name->EditValue = ew_HtmlEncode($schools->school_name->AdvancedSearch->SearchValue);

			// address
			$schools->address->EditCustomAttributes = "";
			$schools->address->EditValue = ew_HtmlEncode($schools->address->AdvancedSearch->SearchValue);

			// towncity
			$schools->towncity->EditCustomAttributes = "";
			$schools->towncity->EditValue = ew_HtmlEncode($schools->towncity->AdvancedSearch->SearchValue);

			// school_type
			$schools->school_type->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `school_type`, `school_type`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `school_type`";
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
			$schools->school_type->EditValue = $arwrk;

			// contact_person_name
			$schools->contact_person_name->EditCustomAttributes = "";
			$schools->contact_person_name->EditValue = ew_HtmlEncode($schools->contact_person_name->AdvancedSearch->SearchValue);

			// telephone
			$schools->telephone->EditCustomAttributes = "";
			$schools->telephone->EditValue = ew_HtmlEncode($schools->telephone->AdvancedSearch->SearchValue);

			// bankname
			$schools->bankname->EditCustomAttributes = "";
			$schools->bankname->EditValue = ew_HtmlEncode($schools->bankname->AdvancedSearch->SearchValue);

			// account_no
			$schools->account_no->EditCustomAttributes = "";
			$schools->account_no->EditValue = ew_HtmlEncode($schools->account_no->AdvancedSearch->SearchValue);

			// programarea_programarea_id
			$schools->programarea_programarea_id->EditCustomAttributes = "";
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
			$schools->programarea_programarea_id->EditValue = $arwrk;
		}

		// Call Row Rendered event
		if ($schools->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$schools->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $schools;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($schools->school_id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $schools->school_id->FldErrMsg();
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
		global $schools;
		$schools->school_id->AdvancedSearch->SearchValue = $schools->getAdvancedSearch("x_school_id");
		$schools->school_name->AdvancedSearch->SearchValue = $schools->getAdvancedSearch("x_school_name");
		$schools->address->AdvancedSearch->SearchValue = $schools->getAdvancedSearch("x_address");
		$schools->towncity->AdvancedSearch->SearchValue = $schools->getAdvancedSearch("x_towncity");
		$schools->school_type->AdvancedSearch->SearchValue = $schools->getAdvancedSearch("x_school_type");
		$schools->contact_person_name->AdvancedSearch->SearchValue = $schools->getAdvancedSearch("x_contact_person_name");
		$schools->telephone->AdvancedSearch->SearchValue = $schools->getAdvancedSearch("x_telephone");
		$schools->bankname->AdvancedSearch->SearchValue = $schools->getAdvancedSearch("x_bankname");
		$schools->account_no->AdvancedSearch->SearchValue = $schools->getAdvancedSearch("x_account_no");
		$schools->programarea_programarea_id->AdvancedSearch->SearchValue = $schools->getAdvancedSearch("x_programarea_programarea_id");
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
