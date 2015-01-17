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
$programarea_view = new cprogramarea_view();
$Page =& $programarea_view;

// Page init
$programarea_view->Page_Init();

// Page main
$programarea_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($programarea->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var programarea_view = new ew_Page("programarea_view");

// page properties
programarea_view.PageID = "view"; // page ID
programarea_view.FormID = "fprogramareaview"; // form ID
var EW_PAGE_ID = programarea_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
programarea_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
programarea_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
programarea_view.ValidateRequired = false; // no JavaScript validation
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
<?php } ?>
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $programarea->TableCaption() ?>
<br><br>
<?php if ($programarea->Export == "") { ?>
<a href="<?php echo $programarea_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $programarea_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $programarea_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $programarea_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->AllowList('community')) { ?>
<a href="communitylist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=programarea&programarea_id=<?php echo urlencode(strval($programarea->programarea_id->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?><?php echo $Language->TablePhrase("community", "TblCaption") ?>
</a>
&nbsp;
<?php } ?>
<?php if ($Security->AllowList('sponsored_student_detail')) { ?>
<a href="sponsored_student_detaillist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=programarea&programarea_id=<?php echo urlencode(strval($programarea->programarea_id->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?><?php echo $Language->TablePhrase("sponsored_student_detail", "TblCaption") ?>
</a>
&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$programarea_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($programarea->programarea_id->Visible) { // programarea_id ?>
	<tr<?php echo $programarea->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $programarea->programarea_id->FldCaption() ?></td>
		<td<?php echo $programarea->programarea_id->CellAttributes() ?>>
<div<?php echo $programarea->programarea_id->ViewAttributes() ?>><?php echo $programarea->programarea_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($programarea->address->Visible) { // address ?>
	<tr<?php echo $programarea->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $programarea->address->FldCaption() ?></td>
		<td<?php echo $programarea->address->CellAttributes() ?>>
<div<?php echo $programarea->address->ViewAttributes() ?>><?php echo $programarea->address->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($programarea->programarea_name->Visible) { // programarea_name ?>
	<tr<?php echo $programarea->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $programarea->programarea_name->FldCaption() ?></td>
		<td<?php echo $programarea->programarea_name->CellAttributes() ?>>
<div<?php echo $programarea->programarea_name->ViewAttributes() ?>><?php echo $programarea->programarea_name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($programarea->regionID->Visible) { // regionID ?>
	<tr<?php echo $programarea->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $programarea->regionID->FldCaption() ?></td>
		<td<?php echo $programarea->regionID->CellAttributes() ?>>
<div<?php echo $programarea->regionID->ViewAttributes() ?>><?php echo $programarea->regionID->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($programarea->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$programarea_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cprogramarea_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'programarea';

	// Page object name
	var $PageObjName = 'programarea_view';

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
	function cprogramarea_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (programarea)
		$GLOBALS["programarea"] = new cprogramarea();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

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
		if (!$Security->CanView()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("programarealist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();

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
	var $lDisplayRecs = 1;
	var $lStartRec;
	var $lStopRec;
	var $lTotalRecs = 0;
	var $lRecRange = 10;
	var $lRecCnt;
	var $arRecKey = array();

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $programarea;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["programarea_id"] <> "") {
				$programarea->programarea_id->setQueryStringValue($_GET["programarea_id"]);
				$this->arRecKey["programarea_id"] = $programarea->programarea_id->QueryStringValue;
			} else {
				$sReturnUrl = "programarealist.php"; // Return to list
			}

			// Get action
			$programarea->CurrentAction = "I"; // Display form
			switch ($programarea->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "programarealist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "programarealist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$programarea->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $programarea;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$programarea->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$programarea->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $programarea->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$programarea->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$programarea->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$programarea->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $programarea;
		$sFilter = $programarea->KeyFilter();

		// Call Row Selecting event
		$programarea->Row_Selecting($sFilter);

		// Load SQL based on filter
		$programarea->CurrentFilter = $sFilter;
		$sSql = $programarea->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$programarea->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $programarea;
		$programarea->programarea_id->setDbValue($rs->fields('programarea_id'));
		$programarea->address->setDbValue($rs->fields('address'));
		$programarea->programarea_name->setDbValue($rs->fields('programarea_name'));
		$programarea->regionID->setDbValue($rs->fields('regionID'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $programarea;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "programarea_id=" . urlencode($programarea->programarea_id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "programarea_id=" . urlencode($programarea->programarea_id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "programarea_id=" . urlencode($programarea->programarea_id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "programarea_id=" . urlencode($programarea->programarea_id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "programarea_id=" . urlencode($programarea->programarea_id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "programarea_id=" . urlencode($programarea->programarea_id->CurrentValue);
		$this->AddUrl = $programarea->AddUrl();
		$this->EditUrl = $programarea->EditUrl();
		$this->CopyUrl = $programarea->CopyUrl();
		$this->DeleteUrl = $programarea->DeleteUrl();
		$this->ListUrl = $programarea->ListUrl();

		// Call Row_Rendering event
		$programarea->Row_Rendering();

		// Common render codes for all row types
		// programarea_id

		$programarea->programarea_id->CellCssStyle = ""; $programarea->programarea_id->CellCssClass = "";
		$programarea->programarea_id->CellAttrs = array(); $programarea->programarea_id->ViewAttrs = array(); $programarea->programarea_id->EditAttrs = array();

		// address
		$programarea->address->CellCssStyle = ""; $programarea->address->CellCssClass = "";
		$programarea->address->CellAttrs = array(); $programarea->address->ViewAttrs = array(); $programarea->address->EditAttrs = array();

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

			// address
			$programarea->address->ViewValue = $programarea->address->CurrentValue;
			$programarea->address->CssStyle = "";
			$programarea->address->CssClass = "";
			$programarea->address->ViewCustomAttributes = "";

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

			// programarea_id
			$programarea->programarea_id->HrefValue = "";
			$programarea->programarea_id->TooltipValue = "";

			// address
			$programarea->address->HrefValue = "";
			$programarea->address->TooltipValue = "";

			// programarea_name
			$programarea->programarea_name->HrefValue = "";
			$programarea->programarea_name->TooltipValue = "";

			// regionID
			$programarea->regionID->HrefValue = "";
			$programarea->regionID->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($programarea->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$programarea->Row_Rendered();
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
}
?>
