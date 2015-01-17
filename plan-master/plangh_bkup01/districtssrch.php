<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "districtsinfo.php" ?>
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
$districts_search = new cdistricts_search();
$Page =& $districts_search;

// Page init
$districts_search->Page_Init();

// Page main
$districts_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var districts_search = new ew_Page("districts_search");

// page properties
districts_search.PageID = "search"; // page ID
districts_search.FormID = "fdistrictssearch"; // form ID
var EW_PAGE_ID = districts_search.PageID; // for backward compatibility

// extend page with validate function for search
districts_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_DistrictID"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($districts->DistrictID->FldErrMsg()) ?>");

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
districts_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
districts_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
districts_search.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $districts->TableCaption() ?><br><br>
<a href="<?php echo $districts->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$districts_search->ShowMessage();
?>
<form name="fdistrictssearch" id="fdistrictssearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return districts_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="districts">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $districts->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $districts->DistrictID->FldCaption() ?></td>
		<td<?php echo $districts->DistrictID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_DistrictID" id="z_DistrictID" value="="></span></td>
		<td<?php echo $districts->DistrictID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_DistrictID" id="x_DistrictID" title="<?php echo $districts->DistrictID->FldTitle() ?>" value="<?php echo $districts->DistrictID->EditValue ?>"<?php echo $districts->DistrictID->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $districts->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $districts->District->FldCaption() ?></td>
		<td<?php echo $districts->District->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_District" id="z_District" value="LIKE"></span></td>
		<td<?php echo $districts->District->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_District" id="x_District" title="<?php echo $districts->District->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $districts->District->EditValue ?>"<?php echo $districts->District->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $districts->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $districts->RegionID->FldCaption() ?></td>
		<td<?php echo $districts->RegionID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_RegionID" id="z_RegionID" value="="></span></td>
		<td<?php echo $districts->RegionID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_RegionID" name="x_RegionID" title="<?php echo $districts->RegionID->FldTitle() ?>"<?php echo $districts->RegionID->EditAttributes() ?>>
<?php
if (is_array($districts->RegionID->EditValue)) {
	$arwrk = $districts->RegionID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($districts->RegionID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $districts->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $districts->programarea_programarea_id->FldCaption() ?></td>
		<td<?php echo $districts->programarea_programarea_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_programarea_programarea_id" id="z_programarea_programarea_id" value="="></span></td>
		<td<?php echo $districts->programarea_programarea_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_programarea_programarea_id" name="x_programarea_programarea_id" title="<?php echo $districts->programarea_programarea_id->FldTitle() ?>"<?php echo $districts->programarea_programarea_id->EditAttributes() ?>>
<?php
if (is_array($districts->programarea_programarea_id->EditValue)) {
	$arwrk = $districts->programarea_programarea_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($districts->programarea_programarea_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
$districts_search->Page_Terminate();
?>
<?php

//
// Page class
//
class cdistricts_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'districts';

	// Page object name
	var $PageObjName = 'districts_search';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $districts;
		if ($districts->UseTokenInUrl) $PageUrl .= "t=" . $districts->TableVar . "&"; // Add page token
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
		global $objForm, $districts;
		if ($districts->UseTokenInUrl) {
			if ($objForm)
				return ($districts->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($districts->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cdistricts_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (districts)
		$GLOBALS["districts"] = new cdistricts();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'districts', TRUE);

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
		global $districts;

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
			$this->Page_Terminate("districtslist.php");
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
		global $objForm, $Language, $gsSearchError, $districts;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$districts->CurrentAction = $objForm->GetValue("a_search");
			switch ($districts->CurrentAction) {
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
						$sSrchStr = $districts->UrlParm($sSrchStr);
						$this->Page_Terminate("districtslist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$districts->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $districts;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $districts->DistrictID); // DistrictID
	$this->BuildSearchUrl($sSrchUrl, $districts->District); // District
	$this->BuildSearchUrl($sSrchUrl, $districts->RegionID); // RegionID
	$this->BuildSearchUrl($sSrchUrl, $districts->programarea_programarea_id); // programarea_programarea_id
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
		global $objForm, $districts;

		// Load search values
		// DistrictID

		$districts->DistrictID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_DistrictID"));
		$districts->DistrictID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_DistrictID");

		// District
		$districts->District->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_District"));
		$districts->District->AdvancedSearch->SearchOperator = $objForm->GetValue("z_District");

		// RegionID
		$districts->RegionID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_RegionID"));
		$districts->RegionID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_RegionID");

		// programarea_programarea_id
		$districts->programarea_programarea_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_programarea_programarea_id"));
		$districts->programarea_programarea_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_programarea_programarea_id");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $districts;

		// Initialize URLs
		// Call Row_Rendering event

		$districts->Row_Rendering();

		// Common render codes for all row types
		// DistrictID

		$districts->DistrictID->CellCssStyle = ""; $districts->DistrictID->CellCssClass = "";
		$districts->DistrictID->CellAttrs = array(); $districts->DistrictID->ViewAttrs = array(); $districts->DistrictID->EditAttrs = array();

		// District
		$districts->District->CellCssStyle = ""; $districts->District->CellCssClass = "";
		$districts->District->CellAttrs = array(); $districts->District->ViewAttrs = array(); $districts->District->EditAttrs = array();

		// RegionID
		$districts->RegionID->CellCssStyle = ""; $districts->RegionID->CellCssClass = "";
		$districts->RegionID->CellAttrs = array(); $districts->RegionID->ViewAttrs = array(); $districts->RegionID->EditAttrs = array();

		// programarea_programarea_id
		$districts->programarea_programarea_id->CellCssStyle = ""; $districts->programarea_programarea_id->CellCssClass = "";
		$districts->programarea_programarea_id->CellAttrs = array(); $districts->programarea_programarea_id->ViewAttrs = array(); $districts->programarea_programarea_id->EditAttrs = array();
		if ($districts->RowType == EW_ROWTYPE_VIEW) { // View row

			// DistrictID
			$districts->DistrictID->ViewValue = $districts->DistrictID->CurrentValue;
			$districts->DistrictID->CssStyle = "";
			$districts->DistrictID->CssClass = "";
			$districts->DistrictID->ViewCustomAttributes = "";

			// District
			$districts->District->ViewValue = $districts->District->CurrentValue;
			$districts->District->CssStyle = "";
			$districts->District->CssClass = "";
			$districts->District->ViewCustomAttributes = "";

			// RegionID
			if (strval($districts->RegionID->CurrentValue) <> "") {
				$sFilterWrk = "`RegionID` = " . ew_AdjustSql($districts->RegionID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Region` FROM `regions`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$districts->RegionID->ViewValue = $rswrk->fields('Region');
					$rswrk->Close();
				} else {
					$districts->RegionID->ViewValue = $districts->RegionID->CurrentValue;
				}
			} else {
				$districts->RegionID->ViewValue = NULL;
			}
			$districts->RegionID->CssStyle = "";
			$districts->RegionID->CssClass = "";
			$districts->RegionID->ViewCustomAttributes = "";

			// programarea_programarea_id
			if (strval($districts->programarea_programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($districts->programarea_programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$districts->programarea_programarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$districts->programarea_programarea_id->ViewValue = $districts->programarea_programarea_id->CurrentValue;
				}
			} else {
				$districts->programarea_programarea_id->ViewValue = NULL;
			}
			$districts->programarea_programarea_id->CssStyle = "";
			$districts->programarea_programarea_id->CssClass = "";
			$districts->programarea_programarea_id->ViewCustomAttributes = "";

			// DistrictID
			$districts->DistrictID->HrefValue = "";
			$districts->DistrictID->TooltipValue = "";

			// District
			$districts->District->HrefValue = "";
			$districts->District->TooltipValue = "";

			// RegionID
			$districts->RegionID->HrefValue = "";
			$districts->RegionID->TooltipValue = "";

			// programarea_programarea_id
			$districts->programarea_programarea_id->HrefValue = "";
			$districts->programarea_programarea_id->TooltipValue = "";
		} elseif ($districts->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// DistrictID
			$districts->DistrictID->EditCustomAttributes = "";
			$districts->DistrictID->EditValue = ew_HtmlEncode($districts->DistrictID->AdvancedSearch->SearchValue);

			// District
			$districts->District->EditCustomAttributes = "";
			$districts->District->EditValue = ew_HtmlEncode($districts->District->AdvancedSearch->SearchValue);

			// RegionID
			$districts->RegionID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `RegionID`, `Region`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `regions`";
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
			$districts->RegionID->EditValue = $arwrk;

			// programarea_programarea_id
			$districts->programarea_programarea_id->EditCustomAttributes = "";
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
			$districts->programarea_programarea_id->EditValue = $arwrk;
		}

		// Call Row Rendered event
		if ($districts->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$districts->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $districts;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($districts->DistrictID->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $districts->DistrictID->FldErrMsg();
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
		global $districts;
		$districts->DistrictID->AdvancedSearch->SearchValue = $districts->getAdvancedSearch("x_DistrictID");
		$districts->District->AdvancedSearch->SearchValue = $districts->getAdvancedSearch("x_District");
		$districts->RegionID->AdvancedSearch->SearchValue = $districts->getAdvancedSearch("x_RegionID");
		$districts->programarea_programarea_id->AdvancedSearch->SearchValue = $districts->getAdvancedSearch("x_programarea_programarea_id");
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
