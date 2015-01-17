<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "school_typeinfo.php" ?>
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
$school_type_search = new cschool_type_search();
$Page =& $school_type_search;

// Page init
$school_type_search->Page_Init();

// Page main
$school_type_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var school_type_search = new ew_Page("school_type_search");

// page properties
school_type_search.PageID = "search"; // page ID
school_type_search.FormID = "fschool_typesearch"; // form ID
var EW_PAGE_ID = school_type_search.PageID; // for backward compatibility

// extend page with validate function for search
school_type_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_school_type_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($school_type->school_type_id->FldErrMsg()) ?>");

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
school_type_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
school_type_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
school_type_search.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $school_type->TableCaption() ?><br><br>
<a href="<?php echo $school_type->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$school_type_search->ShowMessage();
?>
<form name="fschool_typesearch" id="fschool_typesearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return school_type_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="school_type">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $school_type->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $school_type->school_type_id->FldCaption() ?></td>
		<td<?php echo $school_type->school_type_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_school_type_id" id="z_school_type_id" value="="></span></td>
		<td<?php echo $school_type->school_type_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_school_type_id" id="x_school_type_id" title="<?php echo $school_type->school_type_id->FldTitle() ?>" size="30" value="<?php echo $school_type->school_type_id->EditValue ?>"<?php echo $school_type->school_type_id->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $school_type->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $school_type->school_type_1->FldCaption() ?></td>
		<td<?php echo $school_type->school_type_1->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_school_type_1" id="z_school_type_1" value="LIKE"></span></td>
		<td<?php echo $school_type->school_type_1->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_school_type_1" id="x_school_type_1" title="<?php echo $school_type->school_type_1->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $school_type->school_type_1->EditValue ?>"<?php echo $school_type->school_type_1->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $school_type->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $school_type->description->FldCaption() ?></td>
		<td<?php echo $school_type->description->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_description" id="z_description" value="LIKE"></span></td>
		<td<?php echo $school_type->description->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_description" id="x_description" title="<?php echo $school_type->description->FldTitle() ?>" size="30" maxlength="100" value="<?php echo $school_type->description->EditValue ?>"<?php echo $school_type->description->EditAttributes() ?>>
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
$school_type_search->Page_Terminate();
?>
<?php

//
// Page class
//
class cschool_type_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'school_type';

	// Page object name
	var $PageObjName = 'school_type_search';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $school_type;
		if ($school_type->UseTokenInUrl) $PageUrl .= "t=" . $school_type->TableVar . "&"; // Add page token
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
		global $objForm, $school_type;
		if ($school_type->UseTokenInUrl) {
			if ($objForm)
				return ($school_type->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($school_type->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cschool_type_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (school_type)
		$GLOBALS["school_type"] = new cschool_type();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'school_type', TRUE);

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
		global $school_type;

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
			$this->Page_Terminate("school_typelist.php");
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
		global $objForm, $Language, $gsSearchError, $school_type;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$school_type->CurrentAction = $objForm->GetValue("a_search");
			switch ($school_type->CurrentAction) {
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
						$sSrchStr = $school_type->UrlParm($sSrchStr);
						$this->Page_Terminate("school_typelist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$school_type->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $school_type;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $school_type->school_type_id); // school_type_id
	$this->BuildSearchUrl($sSrchUrl, $school_type->school_type_1); // school_type
	$this->BuildSearchUrl($sSrchUrl, $school_type->description); // description
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
		global $objForm, $school_type;

		// Load search values
		// school_type_id

		$school_type->school_type_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_school_type_id"));
		$school_type->school_type_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_school_type_id");

		// school_type
		$school_type->school_type_1->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_school_type_1"));
		$school_type->school_type_1->AdvancedSearch->SearchOperator = $objForm->GetValue("z_school_type_1");

		// description
		$school_type->description->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_description"));
		$school_type->description->AdvancedSearch->SearchOperator = $objForm->GetValue("z_description");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $school_type;

		// Initialize URLs
		// Call Row_Rendering event

		$school_type->Row_Rendering();

		// Common render codes for all row types
		// school_type_id

		$school_type->school_type_id->CellCssStyle = ""; $school_type->school_type_id->CellCssClass = "";
		$school_type->school_type_id->CellAttrs = array(); $school_type->school_type_id->ViewAttrs = array(); $school_type->school_type_id->EditAttrs = array();

		// school_type
		$school_type->school_type_1->CellCssStyle = ""; $school_type->school_type_1->CellCssClass = "";
		$school_type->school_type_1->CellAttrs = array(); $school_type->school_type_1->ViewAttrs = array(); $school_type->school_type_1->EditAttrs = array();

		// description
		$school_type->description->CellCssStyle = ""; $school_type->description->CellCssClass = "";
		$school_type->description->CellAttrs = array(); $school_type->description->ViewAttrs = array(); $school_type->description->EditAttrs = array();
		if ($school_type->RowType == EW_ROWTYPE_VIEW) { // View row

			// school_type_id
			$school_type->school_type_id->ViewValue = $school_type->school_type_id->CurrentValue;
			$school_type->school_type_id->CssStyle = "";
			$school_type->school_type_id->CssClass = "";
			$school_type->school_type_id->ViewCustomAttributes = "";

			// school_type
			$school_type->school_type_1->ViewValue = $school_type->school_type_1->CurrentValue;
			$school_type->school_type_1->CssStyle = "";
			$school_type->school_type_1->CssClass = "";
			$school_type->school_type_1->ViewCustomAttributes = "";

			// description
			$school_type->description->ViewValue = $school_type->description->CurrentValue;
			$school_type->description->CssStyle = "";
			$school_type->description->CssClass = "";
			$school_type->description->ViewCustomAttributes = "";

			// school_type_id
			$school_type->school_type_id->HrefValue = "";
			$school_type->school_type_id->TooltipValue = "";

			// school_type
			$school_type->school_type_1->HrefValue = "";
			$school_type->school_type_1->TooltipValue = "";

			// description
			$school_type->description->HrefValue = "";
			$school_type->description->TooltipValue = "";
		} elseif ($school_type->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// school_type_id
			$school_type->school_type_id->EditCustomAttributes = "";
			$school_type->school_type_id->EditValue = ew_HtmlEncode($school_type->school_type_id->AdvancedSearch->SearchValue);

			// school_type
			$school_type->school_type_1->EditCustomAttributes = "";
			$school_type->school_type_1->EditValue = ew_HtmlEncode($school_type->school_type_1->AdvancedSearch->SearchValue);

			// description
			$school_type->description->EditCustomAttributes = "";
			$school_type->description->EditValue = ew_HtmlEncode($school_type->description->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		if ($school_type->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$school_type->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $school_type;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($school_type->school_type_id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $school_type->school_type_id->FldErrMsg();
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
		global $school_type;
		$school_type->school_type_id->AdvancedSearch->SearchValue = $school_type->getAdvancedSearch("x_school_type_id");
		$school_type->school_type_1->AdvancedSearch->SearchValue = $school_type->getAdvancedSearch("x_school_type_1");
		$school_type->description->AdvancedSearch->SearchValue = $school_type->getAdvancedSearch("x_description");
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
