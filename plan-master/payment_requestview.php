<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "payment_requestinfo.php" ?>
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
$payment_request_view = new cpayment_request_view();
$Page =& $payment_request_view;

// Page init
$payment_request_view->Page_Init();

// Page main
$payment_request_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($payment_request->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var payment_request_view = new ew_Page("payment_request_view");

// page properties
payment_request_view.PageID = "view"; // page ID
payment_request_view.FormID = "fpayment_requestview"; // form ID
var EW_PAGE_ID = payment_request_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
payment_request_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
payment_request_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
payment_request_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $payment_request->TableCaption() ?>
<br><br>
<?php if ($payment_request->Export == "") { ?>
<a href="<?php echo $payment_request_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<?php if ($payment_request_view->ShowOptionLink()) { ?>
<a href="<?php echo $payment_request_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<?php if ($payment_request_view->ShowOptionLink()) { ?>
<a href="<?php echo $payment_request_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<?php if ($payment_request_view->ShowOptionLink()) { ?>
<a href="<?php echo $payment_request_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$payment_request_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($payment_request->payment_request_id->Visible) { // payment_request_id ?>
	<tr<?php echo $payment_request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $payment_request->payment_request_id->FldCaption() ?></td>
		<td<?php echo $payment_request->payment_request_id->CellAttributes() ?>>
<div<?php echo $payment_request->payment_request_id->ViewAttributes() ?>><?php echo $payment_request->payment_request_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($payment_request->year->Visible) { // year ?>
	<tr<?php echo $payment_request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $payment_request->year->FldCaption() ?></td>
		<td<?php echo $payment_request->year->CellAttributes() ?>>
<div<?php echo $payment_request->year->ViewAttributes() ?>><?php echo $payment_request->year->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($payment_request->request_date->Visible) { // request_date ?>
	<tr<?php echo $payment_request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $payment_request->request_date->FldCaption() ?></td>
		<td<?php echo $payment_request->request_date->CellAttributes() ?>>
<div<?php echo $payment_request->request_date->ViewAttributes() ?>><?php echo $payment_request->request_date->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($payment_request->programarea_id->Visible) { // programarea_id ?>
	<tr<?php echo $payment_request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $payment_request->programarea_id->FldCaption() ?></td>
		<td<?php echo $payment_request->programarea_id->CellAttributes() ?>>
<div<?php echo $payment_request->programarea_id->ViewAttributes() ?>><?php echo $payment_request->programarea_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($payment_request->request_status->Visible) { // request_status ?>
	<tr<?php echo $payment_request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $payment_request->request_status->FldCaption() ?></td>
		<td<?php echo $payment_request->request_status->CellAttributes() ?>>
<div<?php echo $payment_request->request_status->ViewAttributes() ?>><?php echo $payment_request->request_status->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($payment_request->code->Visible) { // code ?>
	<tr<?php echo $payment_request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $payment_request->code->FldCaption() ?></td>
		<td<?php echo $payment_request->code->CellAttributes() ?>>
<div<?php echo $payment_request->code->ViewAttributes() ?>><?php echo $payment_request->code->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($payment_request->financial_year_financial_year_id->Visible) { // financial_year_financial_year_id ?>
	<tr<?php echo $payment_request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $payment_request->financial_year_financial_year_id->FldCaption() ?></td>
		<td<?php echo $payment_request->financial_year_financial_year_id->CellAttributes() ?>>
<div<?php echo $payment_request->financial_year_financial_year_id->ViewAttributes() ?>><?php echo $payment_request->financial_year_financial_year_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($payment_request->amount->Visible) { // amount ?>
	<tr<?php echo $payment_request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $payment_request->amount->FldCaption() ?></td>
		<td<?php echo $payment_request->amount->CellAttributes() ?>>
<div<?php echo $payment_request->amount->ViewAttributes() ?>><?php echo $payment_request->amount->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($payment_request->group_id->Visible) { // group_id ?>
	<tr<?php echo $payment_request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $payment_request->group_id->FldCaption() ?></td>
		<td<?php echo $payment_request->group_id->CellAttributes() ?>>
<div<?php echo $payment_request->group_id->ViewAttributes() ?>><?php echo $payment_request->group_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($payment_request->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$payment_request_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cpayment_request_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'payment_request';

	// Page object name
	var $PageObjName = 'payment_request_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $payment_request;
		if ($payment_request->UseTokenInUrl) $PageUrl .= "t=" . $payment_request->TableVar . "&"; // Add page token
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
		global $objForm, $payment_request;
		if ($payment_request->UseTokenInUrl) {
			if ($objForm)
				return ($payment_request->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($payment_request->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpayment_request_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (payment_request)
		$GLOBALS["payment_request"] = new cpayment_request();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'payment_request', TRUE);

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
		global $payment_request;

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
			$this->Page_Terminate("payment_requestlist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();
		if ($Security->IsLoggedIn() && $Security->CurrentUserID() == "") {
			$_SESSION[EW_SESSION_MESSAGE] = $Language->Phrase("NoPermission");
			$this->Page_Terminate("payment_requestlist.php");
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
		global $Language, $payment_request;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["payment_request_id"] <> "") {
				$payment_request->payment_request_id->setQueryStringValue($_GET["payment_request_id"]);
				$this->arRecKey["payment_request_id"] = $payment_request->payment_request_id->QueryStringValue;
			} else {
				$sReturnUrl = "payment_requestlist.php"; // Return to list
			}

			// Get action
			$payment_request->CurrentAction = "I"; // Display form
			switch ($payment_request->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "payment_requestlist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "payment_requestlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$payment_request->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $payment_request;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$payment_request->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$payment_request->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $payment_request->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$payment_request->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$payment_request->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$payment_request->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $payment_request;
		$sFilter = $payment_request->KeyFilter();

		// Call Row Selecting event
		$payment_request->Row_Selecting($sFilter);

		// Load SQL based on filter
		$payment_request->CurrentFilter = $sFilter;
		$sSql = $payment_request->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$payment_request->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $payment_request;
		$payment_request->payment_request_id->setDbValue($rs->fields('payment_request_id'));
		$payment_request->year->setDbValue($rs->fields('year'));
		$payment_request->request_date->setDbValue($rs->fields('request_date'));
		$payment_request->programarea_id->setDbValue($rs->fields('programarea_id'));
		$payment_request->request_status->setDbValue($rs->fields('request_status'));
		$payment_request->code->setDbValue($rs->fields('code'));
		$payment_request->financial_year_financial_year_id->setDbValue($rs->fields('financial_year_financial_year_id'));
		$payment_request->amount->setDbValue($rs->fields('amount'));
		$payment_request->group_id->setDbValue($rs->fields('group_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $payment_request;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "payment_request_id=" . urlencode($payment_request->payment_request_id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "payment_request_id=" . urlencode($payment_request->payment_request_id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "payment_request_id=" . urlencode($payment_request->payment_request_id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "payment_request_id=" . urlencode($payment_request->payment_request_id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "payment_request_id=" . urlencode($payment_request->payment_request_id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "payment_request_id=" . urlencode($payment_request->payment_request_id->CurrentValue);
		$this->AddUrl = $payment_request->AddUrl();
		$this->EditUrl = $payment_request->EditUrl();
		$this->CopyUrl = $payment_request->CopyUrl();
		$this->DeleteUrl = $payment_request->DeleteUrl();
		$this->ListUrl = $payment_request->ListUrl();

		// Call Row_Rendering event
		$payment_request->Row_Rendering();

		// Common render codes for all row types
		// payment_request_id

		$payment_request->payment_request_id->CellCssStyle = ""; $payment_request->payment_request_id->CellCssClass = "";
		$payment_request->payment_request_id->CellAttrs = array(); $payment_request->payment_request_id->ViewAttrs = array(); $payment_request->payment_request_id->EditAttrs = array();

		// year
		$payment_request->year->CellCssStyle = ""; $payment_request->year->CellCssClass = "";
		$payment_request->year->CellAttrs = array(); $payment_request->year->ViewAttrs = array(); $payment_request->year->EditAttrs = array();

		// request_date
		$payment_request->request_date->CellCssStyle = ""; $payment_request->request_date->CellCssClass = "";
		$payment_request->request_date->CellAttrs = array(); $payment_request->request_date->ViewAttrs = array(); $payment_request->request_date->EditAttrs = array();

		// programarea_id
		$payment_request->programarea_id->CellCssStyle = ""; $payment_request->programarea_id->CellCssClass = "";
		$payment_request->programarea_id->CellAttrs = array(); $payment_request->programarea_id->ViewAttrs = array(); $payment_request->programarea_id->EditAttrs = array();

		// request_status
		$payment_request->request_status->CellCssStyle = ""; $payment_request->request_status->CellCssClass = "";
		$payment_request->request_status->CellAttrs = array(); $payment_request->request_status->ViewAttrs = array(); $payment_request->request_status->EditAttrs = array();

		// code
		$payment_request->code->CellCssStyle = ""; $payment_request->code->CellCssClass = "";
		$payment_request->code->CellAttrs = array(); $payment_request->code->ViewAttrs = array(); $payment_request->code->EditAttrs = array();

		// financial_year_financial_year_id
		$payment_request->financial_year_financial_year_id->CellCssStyle = ""; $payment_request->financial_year_financial_year_id->CellCssClass = "";
		$payment_request->financial_year_financial_year_id->CellAttrs = array(); $payment_request->financial_year_financial_year_id->ViewAttrs = array(); $payment_request->financial_year_financial_year_id->EditAttrs = array();

		// amount
		$payment_request->amount->CellCssStyle = ""; $payment_request->amount->CellCssClass = "";
		$payment_request->amount->CellAttrs = array(); $payment_request->amount->ViewAttrs = array(); $payment_request->amount->EditAttrs = array();

		// group_id
		$payment_request->group_id->CellCssStyle = ""; $payment_request->group_id->CellCssClass = "";
		$payment_request->group_id->CellAttrs = array(); $payment_request->group_id->ViewAttrs = array(); $payment_request->group_id->EditAttrs = array();
		if ($payment_request->RowType == EW_ROWTYPE_VIEW) { // View row

			// payment_request_id
			$payment_request->payment_request_id->ViewValue = $payment_request->payment_request_id->CurrentValue;
			$payment_request->payment_request_id->CssStyle = "";
			$payment_request->payment_request_id->CssClass = "";
			$payment_request->payment_request_id->ViewCustomAttributes = "";

			// year
			$payment_request->year->ViewValue = $payment_request->year->CurrentValue;
			$payment_request->year->CssStyle = "";
			$payment_request->year->CssClass = "";
			$payment_request->year->ViewCustomAttributes = "";

			// request_date
			$payment_request->request_date->ViewValue = $payment_request->request_date->CurrentValue;
			$payment_request->request_date->ViewValue = ew_FormatDateTime($payment_request->request_date->ViewValue, 7);
			$payment_request->request_date->CssStyle = "";
			$payment_request->request_date->CssClass = "";
			$payment_request->request_date->ViewCustomAttributes = "";

			// programarea_id
			if (strval($payment_request->programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($payment_request->programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$payment_request->programarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$payment_request->programarea_id->ViewValue = $payment_request->programarea_id->CurrentValue;
				}
			} else {
				$payment_request->programarea_id->ViewValue = NULL;
			}
			$payment_request->programarea_id->CssStyle = "";
			$payment_request->programarea_id->CssClass = "";
			$payment_request->programarea_id->ViewCustomAttributes = "";

			// request_status
			if (strval($payment_request->request_status->CurrentValue) <> "") {
				switch ($payment_request->request_status->CurrentValue) {
					case "NEWREQ":
						$payment_request->request_status->ViewValue = "NEWREQ";
						break;
					case "REQUESTED":
						$payment_request->request_status->ViewValue = "REQUESTED";
						break;
					case "DISBURSED":
						$payment_request->request_status->ViewValue = "DISBURSED";
						break;
					case "LIQUIDATED":
						$payment_request->request_status->ViewValue = "LIQUIDATED";
						break;
					default:
						$payment_request->request_status->ViewValue = $payment_request->request_status->CurrentValue;
				}
			} else {
				$payment_request->request_status->ViewValue = NULL;
			}
			$payment_request->request_status->CssStyle = "";
			$payment_request->request_status->CssClass = "";
			$payment_request->request_status->ViewCustomAttributes = "";

			// code
			$payment_request->code->ViewValue = $payment_request->code->CurrentValue;
			$payment_request->code->CssStyle = "";
			$payment_request->code->CssClass = "";
			$payment_request->code->ViewCustomAttributes = "";

			// financial_year_financial_year_id
			if (strval($payment_request->financial_year_financial_year_id->CurrentValue) <> "") {
				$sFilterWrk = "`financial_year_id` = " . ew_AdjustSql($payment_request->financial_year_financial_year_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `year_name` FROM `financial_year`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$payment_request->financial_year_financial_year_id->ViewValue = $rswrk->fields('year_name');
					$rswrk->Close();
				} else {
					$payment_request->financial_year_financial_year_id->ViewValue = $payment_request->financial_year_financial_year_id->CurrentValue;
				}
			} else {
				$payment_request->financial_year_financial_year_id->ViewValue = NULL;
			}
			$payment_request->financial_year_financial_year_id->CssStyle = "";
			$payment_request->financial_year_financial_year_id->CssClass = "";
			$payment_request->financial_year_financial_year_id->ViewCustomAttributes = "";

			// amount
			$payment_request->amount->ViewValue = $payment_request->amount->CurrentValue;
			$payment_request->amount->CssStyle = "";
			$payment_request->amount->CssClass = "";
			$payment_request->amount->ViewCustomAttributes = "";

			// group_id
			$payment_request->group_id->ViewValue = $payment_request->group_id->CurrentValue;
			$payment_request->group_id->CssStyle = "";
			$payment_request->group_id->CssClass = "";
			$payment_request->group_id->ViewCustomAttributes = "";

			// payment_request_id
			$payment_request->payment_request_id->HrefValue = "";
			$payment_request->payment_request_id->TooltipValue = "";

			// year
			$payment_request->year->HrefValue = "";
			$payment_request->year->TooltipValue = "";

			// request_date
			$payment_request->request_date->HrefValue = "";
			$payment_request->request_date->TooltipValue = "";

			// programarea_id
			$payment_request->programarea_id->HrefValue = "";
			$payment_request->programarea_id->TooltipValue = "";

			// request_status
			$payment_request->request_status->HrefValue = "";
			$payment_request->request_status->TooltipValue = "";

			// code
			$payment_request->code->HrefValue = "";
			$payment_request->code->TooltipValue = "";

			// financial_year_financial_year_id
			$payment_request->financial_year_financial_year_id->HrefValue = "";
			$payment_request->financial_year_financial_year_id->TooltipValue = "";

			// amount
			$payment_request->amount->HrefValue = "";
			$payment_request->amount->TooltipValue = "";

			// group_id
			$payment_request->group_id->HrefValue = "";
			$payment_request->group_id->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($payment_request->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$payment_request->Row_Rendered();
	}

	// Show link optionally based on User ID
	function ShowOptionLink() {
		global $Security, $payment_request;
		if ($Security->IsLoggedIn()) {
			if (!$Security->IsAdmin()) {
				return $Security->IsValidUserID($payment_request->group_id->CurrentValue);
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
