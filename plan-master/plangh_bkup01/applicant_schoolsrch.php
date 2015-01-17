<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "applicant_schoolinfo.php" ?>
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
$applicant_school_search = new capplicant_school_search();
$Page =& $applicant_school_search;

// Page init
$applicant_school_search->Page_Init();

// Page main
$applicant_school_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var applicant_school_search = new ew_Page("applicant_school_search");

// page properties
applicant_school_search.PageID = "search"; // page ID
applicant_school_search.FormID = "fapplicant_schoolsearch"; // form ID
var EW_PAGE_ID = applicant_school_search.PageID; // for backward compatibility

// extend page with validate function for search
applicant_school_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_applicant_school_category_applicant_school_category_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($applicant_school->applicant_school_category_applicant_school_category_id->FldErrMsg()) ?>");

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
applicant_school_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
applicant_school_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
applicant_school_search.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $applicant_school->TableCaption() ?><br><br>
<a href="<?php echo $applicant_school->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$applicant_school_search->ShowMessage();
?>
<form name="fapplicant_schoolsearch" id="fapplicant_schoolsearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return applicant_school_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="applicant_school">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $applicant_school->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $applicant_school->applicant_school_name->FldCaption() ?></td>
		<td<?php echo $applicant_school->applicant_school_name->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_applicant_school_name" id="z_applicant_school_name" value="LIKE"></span></td>
		<td<?php echo $applicant_school->applicant_school_name->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_applicant_school_name" id="x_applicant_school_name" title="<?php echo $applicant_school->applicant_school_name->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $applicant_school->applicant_school_name->EditValue ?>"<?php echo $applicant_school->applicant_school_name->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $applicant_school->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $applicant_school->applicant_school_type->FldCaption() ?></td>
		<td<?php echo $applicant_school->applicant_school_type->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_applicant_school_type" id="z_applicant_school_type" value="="></span></td>
		<td<?php echo $applicant_school->applicant_school_type->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_applicant_school_type" name="x_applicant_school_type" title="<?php echo $applicant_school->applicant_school_type->FldTitle() ?>"<?php echo $applicant_school->applicant_school_type->EditAttributes() ?>>
<?php
if (is_array($applicant_school->applicant_school_type->EditValue)) {
	$arwrk = $applicant_school->applicant_school_type->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($applicant_school->applicant_school_type->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $applicant_school->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $applicant_school->applicant_school_category_applicant_school_category_id->FldCaption() ?></td>
		<td<?php echo $applicant_school->applicant_school_category_applicant_school_category_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_applicant_school_category_applicant_school_category_id" id="z_applicant_school_category_applicant_school_category_id" value="="></span></td>
		<td<?php echo $applicant_school->applicant_school_category_applicant_school_category_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<div id="as_x_applicant_school_category_applicant_school_category_id" style="z-index: 8960">
	<input type="text" name="sv_x_applicant_school_category_applicant_school_category_id" id="sv_x_applicant_school_category_applicant_school_category_id" value="<?php echo $applicant_school->applicant_school_category_applicant_school_category_id->EditValue ?>" title="<?php echo $applicant_school->applicant_school_category_applicant_school_category_id->FldTitle() ?>" size="30"<?php echo $applicant_school->applicant_school_category_applicant_school_category_id->EditAttributes() ?>>&nbsp;<span id="em_x_applicant_school_category_applicant_school_category_id" class="ewMessage" style="display: none"><?php echo $Language->Phrase("UnmatchedValue") ?></span>
	<div id="sc_x_applicant_school_category_applicant_school_category_id"></div>
</div>
<input type="hidden" name="x_applicant_school_category_applicant_school_category_id" id="x_applicant_school_category_applicant_school_category_id" value="<?php echo $applicant_school->applicant_school_category_applicant_school_category_id->AdvancedSearch->SearchValue ?>">
<?php
$sSqlWrk = "SELECT `applicant_school_category_id`, `applicant_school_category_name` FROM `applicant_school_category`";
$sWhereWrk = "`applicant_school_category_name` LIKE '{query_value}%'";
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
	$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
?>
<input type="hidden" name="s_x_applicant_school_category_applicant_school_category_id" id="s_x_applicant_school_category_applicant_school_category_id" value="<?php echo $sSqlWrk ?>">
<script type="text/javascript">
<!--
var oas_x_applicant_school_category_applicant_school_category_id = new ew_AutoSuggest("sv_x_applicant_school_category_applicant_school_category_id", "sc_x_applicant_school_category_applicant_school_category_id", "s_x_applicant_school_category_applicant_school_category_id", "em_x_applicant_school_category_applicant_school_category_id", "x_applicant_school_category_applicant_school_category_id", "", false);
oas_x_applicant_school_category_applicant_school_category_id.formatResult = function(ar) {	
	var df1 = ar[1];
	return df1;
};
oas_x_applicant_school_category_applicant_school_category_id.ac.typeAhead = false;

//-->
</script>
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
$applicant_school_search->Page_Terminate();
?>
<?php

//
// Page class
//
class capplicant_school_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'applicant_school';

	// Page object name
	var $PageObjName = 'applicant_school_search';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $applicant_school;
		if ($applicant_school->UseTokenInUrl) $PageUrl .= "t=" . $applicant_school->TableVar . "&"; // Add page token
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
		global $objForm, $applicant_school;
		if ($applicant_school->UseTokenInUrl) {
			if ($objForm)
				return ($applicant_school->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($applicant_school->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function capplicant_school_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (applicant_school)
		$GLOBALS["applicant_school"] = new capplicant_school();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'applicant_school', TRUE);

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
		global $applicant_school;

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
			$this->Page_Terminate("applicant_schoollist.php");
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
		global $objForm, $Language, $gsSearchError, $applicant_school;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$applicant_school->CurrentAction = $objForm->GetValue("a_search");
			switch ($applicant_school->CurrentAction) {
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
						$sSrchStr = $applicant_school->UrlParm($sSrchStr);
						$this->Page_Terminate("applicant_schoollist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$applicant_school->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $applicant_school;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $applicant_school->applicant_school_name); // applicant_school_name
	$this->BuildSearchUrl($sSrchUrl, $applicant_school->applicant_school_type); // applicant_school_type
	$this->BuildSearchUrl($sSrchUrl, $applicant_school->applicant_school_category_applicant_school_category_id); // applicant_school_category_applicant_school_category_id
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
		global $objForm, $applicant_school;

		// Load search values
		// applicant_school_name

		$applicant_school->applicant_school_name->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_applicant_school_name"));
		$applicant_school->applicant_school_name->AdvancedSearch->SearchOperator = $objForm->GetValue("z_applicant_school_name");

		// applicant_school_type
		$applicant_school->applicant_school_type->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_applicant_school_type"));
		$applicant_school->applicant_school_type->AdvancedSearch->SearchOperator = $objForm->GetValue("z_applicant_school_type");

		// applicant_school_category_applicant_school_category_id
		$applicant_school->applicant_school_category_applicant_school_category_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_applicant_school_category_applicant_school_category_id"));
		$applicant_school->applicant_school_category_applicant_school_category_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_applicant_school_category_applicant_school_category_id");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $applicant_school;

		// Initialize URLs
		// Call Row_Rendering event

		$applicant_school->Row_Rendering();

		// Common render codes for all row types
		// applicant_school_name

		$applicant_school->applicant_school_name->CellCssStyle = ""; $applicant_school->applicant_school_name->CellCssClass = "";
		$applicant_school->applicant_school_name->CellAttrs = array(); $applicant_school->applicant_school_name->ViewAttrs = array(); $applicant_school->applicant_school_name->EditAttrs = array();

		// applicant_school_type
		$applicant_school->applicant_school_type->CellCssStyle = ""; $applicant_school->applicant_school_type->CellCssClass = "";
		$applicant_school->applicant_school_type->CellAttrs = array(); $applicant_school->applicant_school_type->ViewAttrs = array(); $applicant_school->applicant_school_type->EditAttrs = array();

		// applicant_school_category_applicant_school_category_id
		$applicant_school->applicant_school_category_applicant_school_category_id->CellCssStyle = ""; $applicant_school->applicant_school_category_applicant_school_category_id->CellCssClass = "";
		$applicant_school->applicant_school_category_applicant_school_category_id->CellAttrs = array(); $applicant_school->applicant_school_category_applicant_school_category_id->ViewAttrs = array(); $applicant_school->applicant_school_category_applicant_school_category_id->EditAttrs = array();
		if ($applicant_school->RowType == EW_ROWTYPE_VIEW) { // View row

			// applicant_school_id
			$applicant_school->applicant_school_id->ViewValue = $applicant_school->applicant_school_id->CurrentValue;
			if (strval($applicant_school->applicant_school_id->CurrentValue) <> "") {
				$sFilterWrk = "`applicant_school_category_id` = " . ew_AdjustSql($applicant_school->applicant_school_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `applicant_school_category_name` FROM `applicant_school_category`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$applicant_school->applicant_school_id->ViewValue = $rswrk->fields('applicant_school_category_name');
					$rswrk->Close();
				} else {
					$applicant_school->applicant_school_id->ViewValue = $applicant_school->applicant_school_id->CurrentValue;
				}
			} else {
				$applicant_school->applicant_school_id->ViewValue = NULL;
			}
			$applicant_school->applicant_school_id->CssStyle = "";
			$applicant_school->applicant_school_id->CssClass = "";
			$applicant_school->applicant_school_id->ViewCustomAttributes = "";

			// applicant_school_name
			$applicant_school->applicant_school_name->ViewValue = $applicant_school->applicant_school_name->CurrentValue;
			$applicant_school->applicant_school_name->CssStyle = "";
			$applicant_school->applicant_school_name->CssClass = "";
			$applicant_school->applicant_school_name->ViewCustomAttributes = "";

			// applicant_school_type
			if (strval($applicant_school->applicant_school_type->CurrentValue) <> "") {
				$sFilterWrk = "`school_type_id` = " . ew_AdjustSql($applicant_school->applicant_school_type->CurrentValue) . "";
			$sSqlWrk = "SELECT `school_type` FROM `school_type`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$applicant_school->applicant_school_type->ViewValue = $rswrk->fields('school_type');
					$rswrk->Close();
				} else {
					$applicant_school->applicant_school_type->ViewValue = $applicant_school->applicant_school_type->CurrentValue;
				}
			} else {
				$applicant_school->applicant_school_type->ViewValue = NULL;
			}
			$applicant_school->applicant_school_type->CssStyle = "";
			$applicant_school->applicant_school_type->CssClass = "";
			$applicant_school->applicant_school_type->ViewCustomAttributes = "";

			// applicant_school_category_applicant_school_category_id
			$applicant_school->applicant_school_category_applicant_school_category_id->ViewValue = $applicant_school->applicant_school_category_applicant_school_category_id->CurrentValue;
			if (strval($applicant_school->applicant_school_category_applicant_school_category_id->CurrentValue) <> "") {
				$sFilterWrk = "`applicant_school_category_id` = " . ew_AdjustSql($applicant_school->applicant_school_category_applicant_school_category_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `applicant_school_category_name` FROM `applicant_school_category`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$applicant_school->applicant_school_category_applicant_school_category_id->ViewValue = $rswrk->fields('applicant_school_category_name');
					$rswrk->Close();
				} else {
					$applicant_school->applicant_school_category_applicant_school_category_id->ViewValue = $applicant_school->applicant_school_category_applicant_school_category_id->CurrentValue;
				}
			} else {
				$applicant_school->applicant_school_category_applicant_school_category_id->ViewValue = NULL;
			}
			$applicant_school->applicant_school_category_applicant_school_category_id->CssStyle = "";
			$applicant_school->applicant_school_category_applicant_school_category_id->CssClass = "";
			$applicant_school->applicant_school_category_applicant_school_category_id->ViewCustomAttributes = "";

			// applicant_school_name
			$applicant_school->applicant_school_name->HrefValue = "";
			$applicant_school->applicant_school_name->TooltipValue = "";

			// applicant_school_type
			$applicant_school->applicant_school_type->HrefValue = "";
			$applicant_school->applicant_school_type->TooltipValue = "";

			// applicant_school_category_applicant_school_category_id
			$applicant_school->applicant_school_category_applicant_school_category_id->HrefValue = "";
			$applicant_school->applicant_school_category_applicant_school_category_id->TooltipValue = "";
		} elseif ($applicant_school->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// applicant_school_name
			$applicant_school->applicant_school_name->EditCustomAttributes = "";
			$applicant_school->applicant_school_name->EditValue = ew_HtmlEncode($applicant_school->applicant_school_name->AdvancedSearch->SearchValue);

			// applicant_school_type
			$applicant_school->applicant_school_type->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `school_type_id`, `school_type`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `school_type`";
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
			$applicant_school->applicant_school_type->EditValue = $arwrk;

			// applicant_school_category_applicant_school_category_id
			$applicant_school->applicant_school_category_applicant_school_category_id->EditCustomAttributes = "";
			$applicant_school->applicant_school_category_applicant_school_category_id->EditValue = ew_HtmlEncode($applicant_school->applicant_school_category_applicant_school_category_id->AdvancedSearch->SearchValue);
			if (strval($applicant_school->applicant_school_category_applicant_school_category_id->AdvancedSearch->SearchValue) <> "") {
				$sFilterWrk = "`applicant_school_category_id` = " . ew_AdjustSql($applicant_school->applicant_school_category_applicant_school_category_id->AdvancedSearch->SearchValue) . "";
			$sSqlWrk = "SELECT `applicant_school_category_name` FROM `applicant_school_category`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$applicant_school->applicant_school_category_applicant_school_category_id->EditValue = $rswrk->fields('applicant_school_category_name');
					$rswrk->Close();
				} else {
					$applicant_school->applicant_school_category_applicant_school_category_id->EditValue = $applicant_school->applicant_school_category_applicant_school_category_id->AdvancedSearch->SearchValue;
				}
			} else {
				$applicant_school->applicant_school_category_applicant_school_category_id->EditValue = NULL;
			}
		}

		// Call Row Rendered event
		if ($applicant_school->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$applicant_school->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $applicant_school;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($applicant_school->applicant_school_category_applicant_school_category_id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $applicant_school->applicant_school_category_applicant_school_category_id->FldErrMsg();
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
		global $applicant_school;
		$applicant_school->applicant_school_name->AdvancedSearch->SearchValue = $applicant_school->getAdvancedSearch("x_applicant_school_name");
		$applicant_school->applicant_school_type->AdvancedSearch->SearchValue = $applicant_school->getAdvancedSearch("x_applicant_school_type");
		$applicant_school->applicant_school_category_applicant_school_category_id->AdvancedSearch->SearchValue = $applicant_school->getAdvancedSearch("x_applicant_school_category_applicant_school_category_id");
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
