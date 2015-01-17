<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
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
$programarea_search = new cprogramarea_search();
$Page =& $programarea_search;

// Page init
$programarea_search->Page_Init();

// Page main
$programarea_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var programarea_search = new ew_Page("programarea_search");

// page properties
programarea_search.PageID = "search"; // page ID
programarea_search.FormID = "fprogramareasearch"; // form ID
var EW_PAGE_ID = programarea_search.PageID; // for backward compatibility

// extend page with validate function for search
programarea_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";

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
programarea_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
programarea_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
programarea_search.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $programarea->TableCaption() ?><br><br>
<a href="<?php echo $programarea->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$programarea_search->ShowMessage();
?>
<form name="fprogramareasearch" id="fprogramareasearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return programarea_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="programarea">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $programarea->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $programarea->programarea_name->FldCaption() ?></td>
		<td<?php echo $programarea->programarea_name->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_programarea_name" id="z_programarea_name" value="LIKE"></span></td>
		<td<?php echo $programarea->programarea_name->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_programarea_name" id="x_programarea_name" title="<?php echo $programarea->programarea_name->FldTitle() ?>" size="30" maxlength="100" value="<?php echo $programarea->programarea_name->EditValue ?>"<?php echo $programarea->programarea_name->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $programarea->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $programarea->regionID->FldCaption() ?></td>
		<td<?php echo $programarea->regionID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_regionID" id="z_regionID" value="="></span></td>
		<td<?php echo $programarea->regionID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_regionID" name="x_regionID" title="<?php echo $programarea->regionID->FldTitle() ?>"<?php echo $programarea->regionID->EditAttributes() ?>>
<?php
if (is_array($programarea->regionID->EditValue)) {
	$arwrk = $programarea->regionID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($programarea->regionID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
$programarea_search->Page_Terminate();
?>
<?php

//
// Page class
//
class cprogramarea_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'programarea';

	// Page object name
	var $PageObjName = 'programarea_search';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $programarea;
		if ($programarea->UseTokenInUrl) $PageUrl .= "t=" . $programarea->TableVar . "&"; // Add page token
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
		global $objForm, $programarea;
		if ($programarea->UseTokenInUrl) {
			if ($objForm)
				return ($programarea->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($programarea->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cprogramarea_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (programarea)
		$GLOBALS["programarea"] = new cprogramarea();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'programarea', TRUE);

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
		global $programarea;

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
			$this->Page_Terminate("programarealist.php");
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
		global $objForm, $Language, $gsSearchError, $programarea;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$programarea->CurrentAction = $objForm->GetValue("a_search");
			switch ($programarea->CurrentAction) {
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
						$sSrchStr = $programarea->UrlParm($sSrchStr);
						$this->Page_Terminate("programarealist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$programarea->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $programarea;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $programarea->programarea_name); // programarea_name
	$this->BuildSearchUrl($sSrchUrl, $programarea->regionID); // regionID
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
		global $objForm, $programarea;

		// Load search values
		// programarea_name

		$programarea->programarea_name->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_programarea_name"));
		$programarea->programarea_name->AdvancedSearch->SearchOperator = $objForm->GetValue("z_programarea_name");

		// regionID
		$programarea->regionID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_regionID"));
		$programarea->regionID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_regionID");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $programarea;

		// Initialize URLs
		// Call Row_Rendering event

		$programarea->Row_Rendering();

		// Common render codes for all row types
		// programarea_name

		$programarea->programarea_name->CellCssStyle = ""; $programarea->programarea_name->CellCssClass = "";
		$programarea->programarea_name->CellAttrs = array(); $programarea->programarea_name->ViewAttrs = array(); $programarea->programarea_name->EditAttrs = array();

		// regionID
		$programarea->regionID->CellCssStyle = ""; $programarea->regionID->CellCssClass = "";
		$programarea->regionID->CellAttrs = array(); $programarea->regionID->ViewAttrs = array(); $programarea->regionID->EditAttrs = array();
		if ($programarea->RowType == EW_ROWTYPE_VIEW) { // View row

			// programarea_id
			$programarea->programarea_id->ViewValue = $programarea->programarea_id->CurrentValue;
			$programarea->programarea_id->CssStyle = "";
			$programarea->programarea_id->CssClass = "";
			$programarea->programarea_id->ViewCustomAttributes = "";

			// programarea_name
			$programarea->programarea_name->ViewValue = $programarea->programarea_name->CurrentValue;
			$programarea->programarea_name->CssStyle = "";
			$programarea->programarea_name->CssClass = "";
			$programarea->programarea_name->ViewCustomAttributes = "";

			// regionID
			if (strval($programarea->regionID->CurrentValue) <> "") {
				$sFilterWrk = "`RegionID` = " . ew_AdjustSql($programarea->regionID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Region` FROM `regions`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$programarea->regionID->ViewValue = $rswrk->fields('Region');
					$rswrk->Close();
				} else {
					$programarea->regionID->ViewValue = $programarea->regionID->CurrentValue;
				}
			} else {
				$programarea->regionID->ViewValue = NULL;
			}
			$programarea->regionID->CssStyle = "";
			$programarea->regionID->CssClass = "";
			$programarea->regionID->ViewCustomAttributes = "";

			// programarea_name
			$programarea->programarea_name->HrefValue = "";
			$programarea->programarea_name->TooltipValue = "";

			// regionID
			$programarea->regionID->HrefValue = "";
			$programarea->regionID->TooltipValue = "";
		} elseif ($programarea->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// programarea_name
			$programarea->programarea_name->EditCustomAttributes = "";
			$programarea->programarea_name->EditValue = ew_HtmlEncode($programarea->programarea_name->AdvancedSearch->SearchValue);

			// regionID
			$programarea->regionID->EditCustomAttributes = "";
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
			$programarea->regionID->EditValue = $arwrk;
		}

		// Call Row Rendered event
		if ($programarea->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$programarea->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $programarea;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;

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
		global $programarea;
		$programarea->programarea_name->AdvancedSearch->SearchValue = $programarea->getAdvancedSearch("x_programarea_name");
		$programarea->regionID->AdvancedSearch->SearchValue = $programarea->getAdvancedSearch("x_regionID");
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
