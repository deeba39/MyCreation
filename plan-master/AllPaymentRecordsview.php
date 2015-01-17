<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "AllPaymentRecordsinfo.php" ?>
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
$AllPaymentRecords_view = new cAllPaymentRecords_view();
$Page =& $AllPaymentRecords_view;

// Page init
$AllPaymentRecords_view->Page_Init();

// Page main
$AllPaymentRecords_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($AllPaymentRecords->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var AllPaymentRecords_view = new ew_Page("AllPaymentRecords_view");

// page properties
AllPaymentRecords_view.PageID = "view"; // page ID
AllPaymentRecords_view.FormID = "fAllPaymentRecordsview"; // form ID
var EW_PAGE_ID = AllPaymentRecords_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
AllPaymentRecords_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
AllPaymentRecords_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
AllPaymentRecords_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $AllPaymentRecords->TableCaption() ?>
<br><br>
<?php if ($AllPaymentRecords->Export == "") { ?>
<a href="<?php echo $AllPaymentRecords_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $AllPaymentRecords_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$AllPaymentRecords_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($AllPaymentRecords->payment_request_id->Visible) { // payment_request_id ?>
	<tr<?php echo $AllPaymentRecords->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $AllPaymentRecords->payment_request_id->FldCaption() ?></td>
		<td<?php echo $AllPaymentRecords->payment_request_id->CellAttributes() ?>>
<div<?php echo $AllPaymentRecords->payment_request_id->ViewAttributes() ?>><?php echo $AllPaymentRecords->payment_request_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($AllPaymentRecords->year->Visible) { // year ?>
	<tr<?php echo $AllPaymentRecords->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $AllPaymentRecords->year->FldCaption() ?></td>
		<td<?php echo $AllPaymentRecords->year->CellAttributes() ?>>
<div<?php echo $AllPaymentRecords->year->ViewAttributes() ?>><?php echo $AllPaymentRecords->year->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($AllPaymentRecords->request_date->Visible) { // request_date ?>
	<tr<?php echo $AllPaymentRecords->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $AllPaymentRecords->request_date->FldCaption() ?></td>
		<td<?php echo $AllPaymentRecords->request_date->CellAttributes() ?>>
<div<?php echo $AllPaymentRecords->request_date->ViewAttributes() ?>><?php echo $AllPaymentRecords->request_date->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($AllPaymentRecords->programarea_id->Visible) { // programarea_id ?>
	<tr<?php echo $AllPaymentRecords->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $AllPaymentRecords->programarea_id->FldCaption() ?></td>
		<td<?php echo $AllPaymentRecords->programarea_id->CellAttributes() ?>>
<div<?php echo $AllPaymentRecords->programarea_id->ViewAttributes() ?>><?php echo $AllPaymentRecords->programarea_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($AllPaymentRecords->request_status->Visible) { // request_status ?>
	<tr<?php echo $AllPaymentRecords->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $AllPaymentRecords->request_status->FldCaption() ?></td>
		<td<?php echo $AllPaymentRecords->request_status->CellAttributes() ?>>
<div<?php echo $AllPaymentRecords->request_status->ViewAttributes() ?>><?php echo $AllPaymentRecords->request_status->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($AllPaymentRecords->code->Visible) { // code ?>
	<tr<?php echo $AllPaymentRecords->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $AllPaymentRecords->code->FldCaption() ?></td>
		<td<?php echo $AllPaymentRecords->code->CellAttributes() ?>>
<div<?php echo $AllPaymentRecords->code->ViewAttributes() ?>><?php echo $AllPaymentRecords->code->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($AllPaymentRecords->financial_year_financial_year_id->Visible) { // financial_year_financial_year_id ?>
	<tr<?php echo $AllPaymentRecords->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $AllPaymentRecords->financial_year_financial_year_id->FldCaption() ?></td>
		<td<?php echo $AllPaymentRecords->financial_year_financial_year_id->CellAttributes() ?>>
<div<?php echo $AllPaymentRecords->financial_year_financial_year_id->ViewAttributes() ?>><?php echo $AllPaymentRecords->financial_year_financial_year_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($AllPaymentRecords->amount->Visible) { // amount ?>
	<tr<?php echo $AllPaymentRecords->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $AllPaymentRecords->amount->FldCaption() ?></td>
		<td<?php echo $AllPaymentRecords->amount->CellAttributes() ?>>
<div<?php echo $AllPaymentRecords->amount->ViewAttributes() ?>><?php echo $AllPaymentRecords->amount->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($AllPaymentRecords->group_id->Visible) { // group_id ?>
	<tr<?php echo $AllPaymentRecords->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $AllPaymentRecords->group_id->FldCaption() ?></td>
		<td<?php echo $AllPaymentRecords->group_id->CellAttributes() ?>>
<div<?php echo $AllPaymentRecords->group_id->ViewAttributes() ?>><?php echo $AllPaymentRecords->group_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($AllPaymentRecords->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$AllPaymentRecords_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cAllPaymentRecords_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'AllPaymentRecords';

	// Page object name
	var $PageObjName = 'AllPaymentRecords_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $AllPaymentRecords;
		if ($AllPaymentRecords->UseTokenInUrl) $PageUrl .= "t=" . $AllPaymentRecords->TableVar . "&"; // Add page token
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
		global $objForm, $AllPaymentRecords;
		if ($AllPaymentRecords->UseTokenInUrl) {
			if ($objForm)
				return ($AllPaymentRecords->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($AllPaymentRecords->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cAllPaymentRecords_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (AllPaymentRecords)
		$GLOBALS["AllPaymentRecords"] = new cAllPaymentRecords();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'AllPaymentRecords', TRUE);

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
		global $AllPaymentRecords;

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
			$this->Page_Terminate("AllPaymentRecordslist.php");
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
		global $Language, $AllPaymentRecords;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["payment_request_id"] <> "") {
				$AllPaymentRecords->payment_request_id->setQueryStringValue($_GET["payment_request_id"]);
				$this->arRecKey["payment_request_id"] = $AllPaymentRecords->payment_request_id->QueryStringValue;
			} else {
				$sReturnUrl = "AllPaymentRecordslist.php"; // Return to list
			}

			// Get action
			$AllPaymentRecords->CurrentAction = "I"; // Display form
			switch ($AllPaymentRecords->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "AllPaymentRecordslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "AllPaymentRecordslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$AllPaymentRecords->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $AllPaymentRecords;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$AllPaymentRecords->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$AllPaymentRecords->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $AllPaymentRecords->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$AllPaymentRecords->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$AllPaymentRecords->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$AllPaymentRecords->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $AllPaymentRecords;
		$sFilter = $AllPaymentRecords->KeyFilter();

		// Call Row Selecting event
		$AllPaymentRecords->Row_Selecting($sFilter);

		// Load SQL based on filter
		$AllPaymentRecords->CurrentFilter = $sFilter;
		$sSql = $AllPaymentRecords->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$AllPaymentRecords->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $AllPaymentRecords;
		$AllPaymentRecords->payment_request_id->setDbValue($rs->fields('payment_request_id'));
		$AllPaymentRecords->year->setDbValue($rs->fields('year'));
		$AllPaymentRecords->request_date->setDbValue($rs->fields('request_date'));
		$AllPaymentRecords->programarea_id->setDbValue($rs->fields('programarea_id'));
		$AllPaymentRecords->request_status->setDbValue($rs->fields('request_status'));
		$AllPaymentRecords->code->setDbValue($rs->fields('code'));
		$AllPaymentRecords->financial_year_financial_year_id->setDbValue($rs->fields('financial_year_financial_year_id'));
		$AllPaymentRecords->amount->setDbValue($rs->fields('amount'));
		$AllPaymentRecords->group_id->setDbValue($rs->fields('group_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $AllPaymentRecords;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "payment_request_id=" . urlencode($AllPaymentRecords->payment_request_id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "payment_request_id=" . urlencode($AllPaymentRecords->payment_request_id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "payment_request_id=" . urlencode($AllPaymentRecords->payment_request_id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "payment_request_id=" . urlencode($AllPaymentRecords->payment_request_id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "payment_request_id=" . urlencode($AllPaymentRecords->payment_request_id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "payment_request_id=" . urlencode($AllPaymentRecords->payment_request_id->CurrentValue);
		$this->AddUrl = $AllPaymentRecords->AddUrl();
		$this->EditUrl = $AllPaymentRecords->EditUrl();
		$this->CopyUrl = $AllPaymentRecords->CopyUrl();
		$this->DeleteUrl = $AllPaymentRecords->DeleteUrl();
		$this->ListUrl = $AllPaymentRecords->ListUrl();

		// Call Row_Rendering event
		$AllPaymentRecords->Row_Rendering();

		// Common render codes for all row types
		// payment_request_id

		$AllPaymentRecords->payment_request_id->CellCssStyle = ""; $AllPaymentRecords->payment_request_id->CellCssClass = "";
		$AllPaymentRecords->payment_request_id->CellAttrs = array(); $AllPaymentRecords->payment_request_id->ViewAttrs = array(); $AllPaymentRecords->payment_request_id->EditAttrs = array();

		// year
		$AllPaymentRecords->year->CellCssStyle = ""; $AllPaymentRecords->year->CellCssClass = "";
		$AllPaymentRecords->year->CellAttrs = array(); $AllPaymentRecords->year->ViewAttrs = array(); $AllPaymentRecords->year->EditAttrs = array();

		// request_date
		$AllPaymentRecords->request_date->CellCssStyle = ""; $AllPaymentRecords->request_date->CellCssClass = "";
		$AllPaymentRecords->request_date->CellAttrs = array(); $AllPaymentRecords->request_date->ViewAttrs = array(); $AllPaymentRecords->request_date->EditAttrs = array();

		// programarea_id
		$AllPaymentRecords->programarea_id->CellCssStyle = ""; $AllPaymentRecords->programarea_id->CellCssClass = "";
		$AllPaymentRecords->programarea_id->CellAttrs = array(); $AllPaymentRecords->programarea_id->ViewAttrs = array(); $AllPaymentRecords->programarea_id->EditAttrs = array();

		// request_status
		$AllPaymentRecords->request_status->CellCssStyle = ""; $AllPaymentRecords->request_status->CellCssClass = "";
		$AllPaymentRecords->request_status->CellAttrs = array(); $AllPaymentRecords->request_status->ViewAttrs = array(); $AllPaymentRecords->request_status->EditAttrs = array();

		// code
		$AllPaymentRecords->code->CellCssStyle = ""; $AllPaymentRecords->code->CellCssClass = "";
		$AllPaymentRecords->code->CellAttrs = array(); $AllPaymentRecords->code->ViewAttrs = array(); $AllPaymentRecords->code->EditAttrs = array();

		// financial_year_financial_year_id
		$AllPaymentRecords->financial_year_financial_year_id->CellCssStyle = ""; $AllPaymentRecords->financial_year_financial_year_id->CellCssClass = "";
		$AllPaymentRecords->financial_year_financial_year_id->CellAttrs = array(); $AllPaymentRecords->financial_year_financial_year_id->ViewAttrs = array(); $AllPaymentRecords->financial_year_financial_year_id->EditAttrs = array();

		// amount
		$AllPaymentRecords->amount->CellCssStyle = ""; $AllPaymentRecords->amount->CellCssClass = "";
		$AllPaymentRecords->amount->CellAttrs = array(); $AllPaymentRecords->amount->ViewAttrs = array(); $AllPaymentRecords->amount->EditAttrs = array();

		// group_id
		$AllPaymentRecords->group_id->CellCssStyle = ""; $AllPaymentRecords->group_id->CellCssClass = "";
		$AllPaymentRecords->group_id->CellAttrs = array(); $AllPaymentRecords->group_id->ViewAttrs = array(); $AllPaymentRecords->group_id->EditAttrs = array();
		if ($AllPaymentRecords->RowType == EW_ROWTYPE_VIEW) { // View row

			// payment_request_id
			$AllPaymentRecords->payment_request_id->ViewValue = $AllPaymentRecords->payment_request_id->CurrentValue;
			$AllPaymentRecords->payment_request_id->CssStyle = "";
			$AllPaymentRecords->payment_request_id->CssClass = "";
			$AllPaymentRecords->payment_request_id->ViewCustomAttributes = "";

			// year
			$AllPaymentRecords->year->ViewValue = $AllPaymentRecords->year->CurrentValue;
			$AllPaymentRecords->year->CssStyle = "";
			$AllPaymentRecords->year->CssClass = "";
			$AllPaymentRecords->year->ViewCustomAttributes = "";

			// request_date
			$AllPaymentRecords->request_date->ViewValue = $AllPaymentRecords->request_date->CurrentValue;
			$AllPaymentRecords->request_date->ViewValue = ew_FormatDateTime($AllPaymentRecords->request_date->ViewValue, 7);
			$AllPaymentRecords->request_date->CssStyle = "";
			$AllPaymentRecords->request_date->CssClass = "";
			$AllPaymentRecords->request_date->ViewCustomAttributes = "";

			// programarea_id
			if (strval($AllPaymentRecords->programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($AllPaymentRecords->programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$AllPaymentRecords->programarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$AllPaymentRecords->programarea_id->ViewValue = $AllPaymentRecords->programarea_id->CurrentValue;
				}
			} else {
				$AllPaymentRecords->programarea_id->ViewValue = NULL;
			}
			$AllPaymentRecords->programarea_id->CssStyle = "";
			$AllPaymentRecords->programarea_id->CssClass = "";
			$AllPaymentRecords->programarea_id->ViewCustomAttributes = "";

			// request_status
			if (strval($AllPaymentRecords->request_status->CurrentValue) <> "") {
				switch ($AllPaymentRecords->request_status->CurrentValue) {
					case "NEWREQ":
						$AllPaymentRecords->request_status->ViewValue = "NEWREQ";
						break;
					case "REQUESTED":
						$AllPaymentRecords->request_status->ViewValue = "REQUESTED";
						break;
					case "DISBURSED":
						$AllPaymentRecords->request_status->ViewValue = "DISBURSED";
						break;
					case "LIQUIDATED":
						$AllPaymentRecords->request_status->ViewValue = "LIQUIDATED";
						break;
					default:
						$AllPaymentRecords->request_status->ViewValue = $AllPaymentRecords->request_status->CurrentValue;
				}
			} else {
				$AllPaymentRecords->request_status->ViewValue = NULL;
			}
			$AllPaymentRecords->request_status->CssStyle = "";
			$AllPaymentRecords->request_status->CssClass = "";
			$AllPaymentRecords->request_status->ViewCustomAttributes = "";

			// code
			$AllPaymentRecords->code->ViewValue = $AllPaymentRecords->code->CurrentValue;
			$AllPaymentRecords->code->CssStyle = "";
			$AllPaymentRecords->code->CssClass = "";
			$AllPaymentRecords->code->ViewCustomAttributes = "";

			// financial_year_financial_year_id
			if (strval($AllPaymentRecords->financial_year_financial_year_id->CurrentValue) <> "") {
				$sFilterWrk = "`financial_year_id` = " . ew_AdjustSql($AllPaymentRecords->financial_year_financial_year_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `year_name` FROM `financial_year`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$AllPaymentRecords->financial_year_financial_year_id->ViewValue = $rswrk->fields('year_name');
					$rswrk->Close();
				} else {
					$AllPaymentRecords->financial_year_financial_year_id->ViewValue = $AllPaymentRecords->financial_year_financial_year_id->CurrentValue;
				}
			} else {
				$AllPaymentRecords->financial_year_financial_year_id->ViewValue = NULL;
			}
			$AllPaymentRecords->financial_year_financial_year_id->CssStyle = "";
			$AllPaymentRecords->financial_year_financial_year_id->CssClass = "";
			$AllPaymentRecords->financial_year_financial_year_id->ViewCustomAttributes = "";

			// amount
			$AllPaymentRecords->amount->ViewValue = $AllPaymentRecords->amount->CurrentValue;
			$AllPaymentRecords->amount->CssStyle = "";
			$AllPaymentRecords->amount->CssClass = "";
			$AllPaymentRecords->amount->ViewCustomAttributes = "";

			// group_id
			$AllPaymentRecords->group_id->ViewValue = $AllPaymentRecords->group_id->CurrentValue;
			$AllPaymentRecords->group_id->CssStyle = "";
			$AllPaymentRecords->group_id->CssClass = "";
			$AllPaymentRecords->group_id->ViewCustomAttributes = "";

			// payment_request_id
			$AllPaymentRecords->payment_request_id->HrefValue = "";
			$AllPaymentRecords->payment_request_id->TooltipValue = "";

			// year
			$AllPaymentRecords->year->HrefValue = "";
			$AllPaymentRecords->year->TooltipValue = "";

			// request_date
			$AllPaymentRecords->request_date->HrefValue = "";
			$AllPaymentRecords->request_date->TooltipValue = "";

			// programarea_id
			$AllPaymentRecords->programarea_id->HrefValue = "";
			$AllPaymentRecords->programarea_id->TooltipValue = "";

			// request_status
			$AllPaymentRecords->request_status->HrefValue = "";
			$AllPaymentRecords->request_status->TooltipValue = "";

			// code
			$AllPaymentRecords->code->HrefValue = "";
			$AllPaymentRecords->code->TooltipValue = "";

			// financial_year_financial_year_id
			$AllPaymentRecords->financial_year_financial_year_id->HrefValue = "";
			$AllPaymentRecords->financial_year_financial_year_id->TooltipValue = "";

			// amount
			$AllPaymentRecords->amount->HrefValue = "";
			$AllPaymentRecords->amount->TooltipValue = "";

			// group_id
			$AllPaymentRecords->group_id->HrefValue = "";
			$AllPaymentRecords->group_id->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($AllPaymentRecords->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$AllPaymentRecords->Row_Rendered();
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
