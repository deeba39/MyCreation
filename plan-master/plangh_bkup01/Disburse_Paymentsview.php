<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "Disburse_Paymentsinfo.php" ?>
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
$Disburse_Payments_view = new cDisburse_Payments_view();
$Page =& $Disburse_Payments_view;

// Page init
$Disburse_Payments_view->Page_Init();

// Page main
$Disburse_Payments_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($Disburse_Payments->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var Disburse_Payments_view = new ew_Page("Disburse_Payments_view");

// page properties
Disburse_Payments_view.PageID = "view"; // page ID
Disburse_Payments_view.FormID = "fDisburse_Paymentsview"; // form ID
var EW_PAGE_ID = Disburse_Payments_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
Disburse_Payments_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
Disburse_Payments_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
Disburse_Payments_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $Disburse_Payments->TableCaption() ?>
<br><br>
<?php if ($Disburse_Payments->Export == "") { ?>
<a href="<?php echo $Disburse_Payments_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanEdit()) { ?>
<?php if ($Disburse_Payments_view->ShowOptionLink()) { ?>
<a href="<?php echo $Disburse_Payments_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$Disburse_Payments_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($Disburse_Payments->payment_request_id->Visible) { // payment_request_id ?>
	<tr<?php echo $Disburse_Payments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Disburse_Payments->payment_request_id->FldCaption() ?></td>
		<td<?php echo $Disburse_Payments->payment_request_id->CellAttributes() ?>>
<div<?php echo $Disburse_Payments->payment_request_id->ViewAttributes() ?>><?php echo $Disburse_Payments->payment_request_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($Disburse_Payments->code->Visible) { // code ?>
	<tr<?php echo $Disburse_Payments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Disburse_Payments->code->FldCaption() ?></td>
		<td<?php echo $Disburse_Payments->code->CellAttributes() ?>>
<div<?php echo $Disburse_Payments->code->ViewAttributes() ?>><?php echo $Disburse_Payments->code->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($Disburse_Payments->programarea_id->Visible) { // programarea_id ?>
	<tr<?php echo $Disburse_Payments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Disburse_Payments->programarea_id->FldCaption() ?></td>
		<td<?php echo $Disburse_Payments->programarea_id->CellAttributes() ?>>
<div<?php echo $Disburse_Payments->programarea_id->ViewAttributes() ?>><?php echo $Disburse_Payments->programarea_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($Disburse_Payments->year->Visible) { // year ?>
	<tr<?php echo $Disburse_Payments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Disburse_Payments->year->FldCaption() ?></td>
		<td<?php echo $Disburse_Payments->year->CellAttributes() ?>>
<div<?php echo $Disburse_Payments->year->ViewAttributes() ?>><?php echo $Disburse_Payments->year->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($Disburse_Payments->request_date->Visible) { // request_date ?>
	<tr<?php echo $Disburse_Payments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Disburse_Payments->request_date->FldCaption() ?></td>
		<td<?php echo $Disburse_Payments->request_date->CellAttributes() ?>>
<div<?php echo $Disburse_Payments->request_date->ViewAttributes() ?>><?php echo $Disburse_Payments->request_date->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($Disburse_Payments->request_status->Visible) { // request_status ?>
	<tr<?php echo $Disburse_Payments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Disburse_Payments->request_status->FldCaption() ?></td>
		<td<?php echo $Disburse_Payments->request_status->CellAttributes() ?>>
<div<?php echo $Disburse_Payments->request_status->ViewAttributes() ?>><?php echo $Disburse_Payments->request_status->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($Disburse_Payments->financial_year_financial_year_id->Visible) { // financial_year_financial_year_id ?>
	<tr<?php echo $Disburse_Payments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Disburse_Payments->financial_year_financial_year_id->FldCaption() ?></td>
		<td<?php echo $Disburse_Payments->financial_year_financial_year_id->CellAttributes() ?>>
<div<?php echo $Disburse_Payments->financial_year_financial_year_id->ViewAttributes() ?>><?php echo $Disburse_Payments->financial_year_financial_year_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($Disburse_Payments->amount->Visible) { // amount ?>
	<tr<?php echo $Disburse_Payments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Disburse_Payments->amount->FldCaption() ?></td>
		<td<?php echo $Disburse_Payments->amount->CellAttributes() ?>>
<div<?php echo $Disburse_Payments->amount->ViewAttributes() ?>><?php echo $Disburse_Payments->amount->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($Disburse_Payments->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$Disburse_Payments_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cDisburse_Payments_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'Disburse Payments';

	// Page object name
	var $PageObjName = 'Disburse_Payments_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $Disburse_Payments;
		if ($Disburse_Payments->UseTokenInUrl) $PageUrl .= "t=" . $Disburse_Payments->TableVar . "&"; // Add page token
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
		global $objForm, $Disburse_Payments;
		if ($Disburse_Payments->UseTokenInUrl) {
			if ($objForm)
				return ($Disburse_Payments->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($Disburse_Payments->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cDisburse_Payments_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (Disburse_Payments)
		$GLOBALS["Disburse_Payments"] = new cDisburse_Payments();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'Disburse Payments', TRUE);

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
		global $Disburse_Payments;

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
			$this->Page_Terminate("Disburse_Paymentslist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();
		if ($Security->IsLoggedIn() && $Security->CurrentUserID() == "") {
			$_SESSION[EW_SESSION_MESSAGE] = $Language->Phrase("NoPermission");
			$this->Page_Terminate("Disburse_Paymentslist.php");
		}

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
		global $Language, $Disburse_Payments;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["payment_request_id"] <> "") {
				$Disburse_Payments->payment_request_id->setQueryStringValue($_GET["payment_request_id"]);
				$this->arRecKey["payment_request_id"] = $Disburse_Payments->payment_request_id->QueryStringValue;
			} else {
				$sReturnUrl = "Disburse_Paymentslist.php"; // Return to list
			}

			// Get action
			$Disburse_Payments->CurrentAction = "I"; // Display form
			switch ($Disburse_Payments->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "Disburse_Paymentslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "Disburse_Paymentslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$Disburse_Payments->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $Disburse_Payments;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$Disburse_Payments->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$Disburse_Payments->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $Disburse_Payments->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$Disburse_Payments->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$Disburse_Payments->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$Disburse_Payments->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $Disburse_Payments;
		$sFilter = $Disburse_Payments->KeyFilter();

		// Call Row Selecting event
		$Disburse_Payments->Row_Selecting($sFilter);

		// Load SQL based on filter
		$Disburse_Payments->CurrentFilter = $sFilter;
		$sSql = $Disburse_Payments->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$Disburse_Payments->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $Disburse_Payments;
		$Disburse_Payments->payment_request_id->setDbValue($rs->fields('payment_request_id'));
		$Disburse_Payments->code->setDbValue($rs->fields('code'));
		$Disburse_Payments->programarea_id->setDbValue($rs->fields('programarea_id'));
		$Disburse_Payments->year->setDbValue($rs->fields('year'));
		$Disburse_Payments->request_date->setDbValue($rs->fields('request_date'));
		$Disburse_Payments->request_status->setDbValue($rs->fields('request_status'));
		$Disburse_Payments->financial_year_financial_year_id->setDbValue($rs->fields('financial_year_financial_year_id'));
		$Disburse_Payments->amount->setDbValue($rs->fields('amount'));
		$Disburse_Payments->group_id->setDbValue($rs->fields('group_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $Disburse_Payments;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "payment_request_id=" . urlencode($Disburse_Payments->payment_request_id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "payment_request_id=" . urlencode($Disburse_Payments->payment_request_id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "payment_request_id=" . urlencode($Disburse_Payments->payment_request_id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "payment_request_id=" . urlencode($Disburse_Payments->payment_request_id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "payment_request_id=" . urlencode($Disburse_Payments->payment_request_id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "payment_request_id=" . urlencode($Disburse_Payments->payment_request_id->CurrentValue);
		$this->AddUrl = $Disburse_Payments->AddUrl();
		$this->EditUrl = $Disburse_Payments->EditUrl();
		$this->CopyUrl = $Disburse_Payments->CopyUrl();
		$this->DeleteUrl = $Disburse_Payments->DeleteUrl();
		$this->ListUrl = $Disburse_Payments->ListUrl();

		// Call Row_Rendering event
		$Disburse_Payments->Row_Rendering();

		// Common render codes for all row types
		// payment_request_id

		$Disburse_Payments->payment_request_id->CellCssStyle = ""; $Disburse_Payments->payment_request_id->CellCssClass = "";
		$Disburse_Payments->payment_request_id->CellAttrs = array(); $Disburse_Payments->payment_request_id->ViewAttrs = array(); $Disburse_Payments->payment_request_id->EditAttrs = array();

		// code
		$Disburse_Payments->code->CellCssStyle = ""; $Disburse_Payments->code->CellCssClass = "";
		$Disburse_Payments->code->CellAttrs = array(); $Disburse_Payments->code->ViewAttrs = array(); $Disburse_Payments->code->EditAttrs = array();

		// programarea_id
		$Disburse_Payments->programarea_id->CellCssStyle = ""; $Disburse_Payments->programarea_id->CellCssClass = "";
		$Disburse_Payments->programarea_id->CellAttrs = array(); $Disburse_Payments->programarea_id->ViewAttrs = array(); $Disburse_Payments->programarea_id->EditAttrs = array();

		// year
		$Disburse_Payments->year->CellCssStyle = ""; $Disburse_Payments->year->CellCssClass = "";
		$Disburse_Payments->year->CellAttrs = array(); $Disburse_Payments->year->ViewAttrs = array(); $Disburse_Payments->year->EditAttrs = array();

		// request_date
		$Disburse_Payments->request_date->CellCssStyle = ""; $Disburse_Payments->request_date->CellCssClass = "";
		$Disburse_Payments->request_date->CellAttrs = array(); $Disburse_Payments->request_date->ViewAttrs = array(); $Disburse_Payments->request_date->EditAttrs = array();

		// request_status
		$Disburse_Payments->request_status->CellCssStyle = ""; $Disburse_Payments->request_status->CellCssClass = "";
		$Disburse_Payments->request_status->CellAttrs = array(); $Disburse_Payments->request_status->ViewAttrs = array(); $Disburse_Payments->request_status->EditAttrs = array();

		// financial_year_financial_year_id
		$Disburse_Payments->financial_year_financial_year_id->CellCssStyle = ""; $Disburse_Payments->financial_year_financial_year_id->CellCssClass = "";
		$Disburse_Payments->financial_year_financial_year_id->CellAttrs = array(); $Disburse_Payments->financial_year_financial_year_id->ViewAttrs = array(); $Disburse_Payments->financial_year_financial_year_id->EditAttrs = array();

		// amount
		$Disburse_Payments->amount->CellCssStyle = ""; $Disburse_Payments->amount->CellCssClass = "";
		$Disburse_Payments->amount->CellAttrs = array(); $Disburse_Payments->amount->ViewAttrs = array(); $Disburse_Payments->amount->EditAttrs = array();
		if ($Disburse_Payments->RowType == EW_ROWTYPE_VIEW) { // View row

			// payment_request_id
			$Disburse_Payments->payment_request_id->ViewValue = $Disburse_Payments->payment_request_id->CurrentValue;
			$Disburse_Payments->payment_request_id->CssStyle = "";
			$Disburse_Payments->payment_request_id->CssClass = "";
			$Disburse_Payments->payment_request_id->ViewCustomAttributes = "";

			// code
			$Disburse_Payments->code->ViewValue = $Disburse_Payments->code->CurrentValue;
			$Disburse_Payments->code->CssStyle = "";
			$Disburse_Payments->code->CssClass = "";
			$Disburse_Payments->code->ViewCustomAttributes = "";

			// programarea_id
			if (strval($Disburse_Payments->programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($Disburse_Payments->programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Disburse_Payments->programarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$Disburse_Payments->programarea_id->ViewValue = $Disburse_Payments->programarea_id->CurrentValue;
				}
			} else {
				$Disburse_Payments->programarea_id->ViewValue = NULL;
			}
			$Disburse_Payments->programarea_id->CssStyle = "";
			$Disburse_Payments->programarea_id->CssClass = "";
			$Disburse_Payments->programarea_id->ViewCustomAttributes = "";

			// year
			$Disburse_Payments->year->ViewValue = $Disburse_Payments->year->CurrentValue;
			$Disburse_Payments->year->CssStyle = "";
			$Disburse_Payments->year->CssClass = "";
			$Disburse_Payments->year->ViewCustomAttributes = "";

			// request_date
			$Disburse_Payments->request_date->ViewValue = $Disburse_Payments->request_date->CurrentValue;
			$Disburse_Payments->request_date->ViewValue = ew_FormatDateTime($Disburse_Payments->request_date->ViewValue, 7);
			$Disburse_Payments->request_date->CssStyle = "";
			$Disburse_Payments->request_date->CssClass = "";
			$Disburse_Payments->request_date->ViewCustomAttributes = "";

			// request_status
			if (strval($Disburse_Payments->request_status->CurrentValue) <> "") {
				switch ($Disburse_Payments->request_status->CurrentValue) {
					case "NEWREQ":
						$Disburse_Payments->request_status->ViewValue = "NEWREQ";
						break;
					case "REQUESTED":
						$Disburse_Payments->request_status->ViewValue = "REQUESTED";
						break;
					case "DISBURSED":
						$Disburse_Payments->request_status->ViewValue = "DISBURSED";
						break;
					case "LIQUIDATED":
						$Disburse_Payments->request_status->ViewValue = "LIQUIDATED";
						break;
					default:
						$Disburse_Payments->request_status->ViewValue = $Disburse_Payments->request_status->CurrentValue;
				}
			} else {
				$Disburse_Payments->request_status->ViewValue = NULL;
			}
			$Disburse_Payments->request_status->CssStyle = "";
			$Disburse_Payments->request_status->CssClass = "";
			$Disburse_Payments->request_status->ViewCustomAttributes = "";

			// financial_year_financial_year_id
			if (strval($Disburse_Payments->financial_year_financial_year_id->CurrentValue) <> "") {
				$sFilterWrk = "`financial_year_id` = " . ew_AdjustSql($Disburse_Payments->financial_year_financial_year_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `year_name` FROM `financial_year`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Disburse_Payments->financial_year_financial_year_id->ViewValue = $rswrk->fields('year_name');
					$rswrk->Close();
				} else {
					$Disburse_Payments->financial_year_financial_year_id->ViewValue = $Disburse_Payments->financial_year_financial_year_id->CurrentValue;
				}
			} else {
				$Disburse_Payments->financial_year_financial_year_id->ViewValue = NULL;
			}
			$Disburse_Payments->financial_year_financial_year_id->CssStyle = "";
			$Disburse_Payments->financial_year_financial_year_id->CssClass = "";
			$Disburse_Payments->financial_year_financial_year_id->ViewCustomAttributes = "";

			// amount
			$Disburse_Payments->amount->ViewValue = $Disburse_Payments->amount->CurrentValue;
			$Disburse_Payments->amount->CssStyle = "";
			$Disburse_Payments->amount->CssClass = "";
			$Disburse_Payments->amount->ViewCustomAttributes = "";

			// payment_request_id
			$Disburse_Payments->payment_request_id->HrefValue = "";
			$Disburse_Payments->payment_request_id->TooltipValue = "";

			// code
			$Disburse_Payments->code->HrefValue = "";
			$Disburse_Payments->code->TooltipValue = "";

			// programarea_id
			$Disburse_Payments->programarea_id->HrefValue = "";
			$Disburse_Payments->programarea_id->TooltipValue = "";

			// year
			$Disburse_Payments->year->HrefValue = "";
			$Disburse_Payments->year->TooltipValue = "";

			// request_date
			$Disburse_Payments->request_date->HrefValue = "";
			$Disburse_Payments->request_date->TooltipValue = "";

			// request_status
			$Disburse_Payments->request_status->HrefValue = "";
			$Disburse_Payments->request_status->TooltipValue = "";

			// financial_year_financial_year_id
			$Disburse_Payments->financial_year_financial_year_id->HrefValue = "";
			$Disburse_Payments->financial_year_financial_year_id->TooltipValue = "";

			// amount
			$Disburse_Payments->amount->HrefValue = "";
			$Disburse_Payments->amount->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($Disburse_Payments->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$Disburse_Payments->Row_Rendered();
	}

	// Show link optionally based on User ID
	function ShowOptionLink() {
		global $Security, $Disburse_Payments;
		if ($Security->IsLoggedIn()) {
			if (!$Security->IsAdmin()) {
				return $Security->IsValidUserID($Disburse_Payments->group_id->CurrentValue);
			}
		}
		return TRUE;
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
