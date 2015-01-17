<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "Payment_Refundinfo.php" ?>
<?php include "scholarship_packageinfo.php" ?>
<?php include "usersinfo.php" ?>
<?php include "payment_requestinfo.php" ?>
<?php include "view_for_payment_refund_selectioninfo.php" ?>
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
$Payment_Refund_view = new cPayment_Refund_view();
$Page =& $Payment_Refund_view;

// Page init
$Payment_Refund_view->Page_Init();

// Page main
$Payment_Refund_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($Payment_Refund->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var Payment_Refund_view = new ew_Page("Payment_Refund_view");

// page properties
Payment_Refund_view.PageID = "view"; // page ID
Payment_Refund_view.FormID = "fPayment_Refundview"; // form ID
var EW_PAGE_ID = Payment_Refund_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
Payment_Refund_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
Payment_Refund_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
Payment_Refund_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $Payment_Refund->TableCaption() ?>
<br><br>
<?php if ($Payment_Refund->Export == "") { ?>
<a href="<?php echo $Payment_Refund_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanEdit()) { ?>
<?php if ($Payment_Refund_view->ShowOptionLink()) { ?>
<a href="<?php echo $Payment_Refund_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$Payment_Refund_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($Payment_Refund->scholarship_payment_id->Visible) { // scholarship_payment_id ?>
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Payment_Refund->scholarship_payment_id->FldCaption() ?></td>
		<td<?php echo $Payment_Refund->scholarship_payment_id->CellAttributes() ?>>
<div<?php echo $Payment_Refund->scholarship_payment_id->ViewAttributes() ?>><?php echo $Payment_Refund->scholarship_payment_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($Payment_Refund->date->Visible) { // date ?>
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Payment_Refund->date->FldCaption() ?></td>
		<td<?php echo $Payment_Refund->date->CellAttributes() ?>>
<div<?php echo $Payment_Refund->date->ViewAttributes() ?>><?php echo $Payment_Refund->date->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($Payment_Refund->status->Visible) { // status ?>
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Payment_Refund->status->FldCaption() ?></td>
		<td<?php echo $Payment_Refund->status->CellAttributes() ?>>
<div<?php echo $Payment_Refund->status->ViewAttributes() ?>><?php echo $Payment_Refund->status->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($Payment_Refund->refund_amount->Visible) { // refund_amount ?>
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Payment_Refund->refund_amount->FldCaption() ?></td>
		<td<?php echo $Payment_Refund->refund_amount->CellAttributes() ?>>
<div<?php echo $Payment_Refund->refund_amount->ViewAttributes() ?>><?php echo $Payment_Refund->refund_amount->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($Payment_Refund->amount->Visible) { // amount ?>
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Payment_Refund->amount->FldCaption() ?></td>
		<td<?php echo $Payment_Refund->amount->CellAttributes() ?>>
<div<?php echo $Payment_Refund->amount->ViewAttributes() ?>><?php echo $Payment_Refund->amount->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($Payment_Refund->memo->Visible) { // memo ?>
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Payment_Refund->memo->FldCaption() ?></td>
		<td<?php echo $Payment_Refund->memo->CellAttributes() ?>>
<div<?php echo $Payment_Refund->memo->ViewAttributes() ?>><?php echo $Payment_Refund->memo->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($Payment_Refund->year->Visible) { // year ?>
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Payment_Refund->year->FldCaption() ?></td>
		<td<?php echo $Payment_Refund->year->CellAttributes() ?>>
<div<?php echo $Payment_Refund->year->ViewAttributes() ?>><?php echo $Payment_Refund->year->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($Payment_Refund->scholarship_package_scholarship_package_id->Visible) { // scholarship_package_scholarship_package_id ?>
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Payment_Refund->scholarship_package_scholarship_package_id->FldCaption() ?></td>
		<td<?php echo $Payment_Refund->scholarship_package_scholarship_package_id->CellAttributes() ?>>
<div<?php echo $Payment_Refund->scholarship_package_scholarship_package_id->ViewAttributes() ?>><?php echo $Payment_Refund->scholarship_package_scholarship_package_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($Payment_Refund->programarea_residentarea_id->Visible) { // programarea_residentarea_id ?>
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Payment_Refund->programarea_residentarea_id->FldCaption() ?></td>
		<td<?php echo $Payment_Refund->programarea_residentarea_id->CellAttributes() ?>>
<div<?php echo $Payment_Refund->programarea_residentarea_id->ViewAttributes() ?>><?php echo $Payment_Refund->programarea_residentarea_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($Payment_Refund->programarea_payingarea_id->Visible) { // programarea_payingarea_id ?>
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Payment_Refund->programarea_payingarea_id->FldCaption() ?></td>
		<td<?php echo $Payment_Refund->programarea_payingarea_id->CellAttributes() ?>>
<div<?php echo $Payment_Refund->programarea_payingarea_id->ViewAttributes() ?>><?php echo $Payment_Refund->programarea_payingarea_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($Payment_Refund->payment_request_payment_request_id->Visible) { // payment_request_payment_request_id ?>
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Payment_Refund->payment_request_payment_request_id->FldCaption() ?></td>
		<td<?php echo $Payment_Refund->payment_request_payment_request_id->CellAttributes() ?>>
<div<?php echo $Payment_Refund->payment_request_payment_request_id->ViewAttributes() ?>><?php echo $Payment_Refund->payment_request_payment_request_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($Payment_Refund->bankname->Visible) { // bankname ?>
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Payment_Refund->bankname->FldCaption() ?></td>
		<td<?php echo $Payment_Refund->bankname->CellAttributes() ?>>
<div<?php echo $Payment_Refund->bankname->ViewAttributes() ?>><?php echo $Payment_Refund->bankname->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($Payment_Refund->account_no->Visible) { // account_no ?>
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Payment_Refund->account_no->FldCaption() ?></td>
		<td<?php echo $Payment_Refund->account_no->CellAttributes() ?>>
<div<?php echo $Payment_Refund->account_no->ViewAttributes() ?>><?php echo $Payment_Refund->account_no->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($Payment_Refund->schools_school_id->Visible) { // schools_school_id ?>
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Payment_Refund->schools_school_id->FldCaption() ?></td>
		<td<?php echo $Payment_Refund->schools_school_id->CellAttributes() ?>>
<div<?php echo $Payment_Refund->schools_school_id->ViewAttributes() ?>><?php echo $Payment_Refund->schools_school_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($Payment_Refund->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$Payment_Refund_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cPayment_Refund_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'Payment Refund';

	// Page object name
	var $PageObjName = 'Payment_Refund_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $Payment_Refund;
		if ($Payment_Refund->UseTokenInUrl) $PageUrl .= "t=" . $Payment_Refund->TableVar . "&"; // Add page token
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
		global $objForm, $Payment_Refund;
		if ($Payment_Refund->UseTokenInUrl) {
			if ($objForm)
				return ($Payment_Refund->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($Payment_Refund->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cPayment_Refund_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (Payment_Refund)
		$GLOBALS["Payment_Refund"] = new cPayment_Refund();

		// Table object (scholarship_package)
		$GLOBALS['scholarship_package'] = new cscholarship_package();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (payment_request)
		$GLOBALS['payment_request'] = new cpayment_request();

		// Table object (view_for_payment_refund_selection)
		$GLOBALS['view_for_payment_refund_selection'] = new cview_for_payment_refund_selection();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'Payment Refund', TRUE);

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
		global $Payment_Refund;

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
			$this->Page_Terminate("Payment_Refundlist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();
		if ($Security->IsLoggedIn() && $Security->CurrentUserID() == "") {
			$_SESSION[EW_SESSION_MESSAGE] = $Language->Phrase("NoPermission");
			$this->Page_Terminate("Payment_Refundlist.php");
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
		global $Language, $Payment_Refund;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["scholarship_payment_id"] <> "") {
				$Payment_Refund->scholarship_payment_id->setQueryStringValue($_GET["scholarship_payment_id"]);
				$this->arRecKey["scholarship_payment_id"] = $Payment_Refund->scholarship_payment_id->QueryStringValue;
			} else {
				$sReturnUrl = "Payment_Refundlist.php"; // Return to list
			}

			// Get action
			$Payment_Refund->CurrentAction = "I"; // Display form
			switch ($Payment_Refund->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "Payment_Refundlist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "Payment_Refundlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$Payment_Refund->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $Payment_Refund;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$Payment_Refund->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$Payment_Refund->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $Payment_Refund->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$Payment_Refund->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$Payment_Refund->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$Payment_Refund->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $Payment_Refund;
		$sFilter = $Payment_Refund->KeyFilter();

		// Call Row Selecting event
		$Payment_Refund->Row_Selecting($sFilter);

		// Load SQL based on filter
		$Payment_Refund->CurrentFilter = $sFilter;
		$sSql = $Payment_Refund->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$Payment_Refund->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $Payment_Refund;
		$Payment_Refund->scholarship_payment_id->setDbValue($rs->fields('scholarship_payment_id'));
		$Payment_Refund->date->setDbValue($rs->fields('date'));
		$Payment_Refund->status->setDbValue($rs->fields('status'));
		$Payment_Refund->refund_amount->setDbValue($rs->fields('refund_amount'));
		$Payment_Refund->amount->setDbValue($rs->fields('amount'));
		$Payment_Refund->memo->setDbValue($rs->fields('memo'));
		$Payment_Refund->year->setDbValue($rs->fields('year'));
		$Payment_Refund->scholarship_package_scholarship_package_id->setDbValue($rs->fields('scholarship_package_scholarship_package_id'));
		$Payment_Refund->programarea_residentarea_id->setDbValue($rs->fields('programarea_residentarea_id'));
		$Payment_Refund->programarea_payingarea_id->setDbValue($rs->fields('programarea_payingarea_id'));
		$Payment_Refund->payment_request_payment_request_id->setDbValue($rs->fields('payment_request_payment_request_id'));
		$Payment_Refund->bankname->setDbValue($rs->fields('bankname'));
		$Payment_Refund->account_no->setDbValue($rs->fields('account_no'));
		$Payment_Refund->schools_school_id->setDbValue($rs->fields('schools_school_id'));
		$Payment_Refund->group_id->setDbValue($rs->fields('group_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $Payment_Refund;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "scholarship_payment_id=" . urlencode($Payment_Refund->scholarship_payment_id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "scholarship_payment_id=" . urlencode($Payment_Refund->scholarship_payment_id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "scholarship_payment_id=" . urlencode($Payment_Refund->scholarship_payment_id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "scholarship_payment_id=" . urlencode($Payment_Refund->scholarship_payment_id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "scholarship_payment_id=" . urlencode($Payment_Refund->scholarship_payment_id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "scholarship_payment_id=" . urlencode($Payment_Refund->scholarship_payment_id->CurrentValue);
		$this->AddUrl = $Payment_Refund->AddUrl();
		$this->EditUrl = $Payment_Refund->EditUrl();
		$this->CopyUrl = $Payment_Refund->CopyUrl();
		$this->DeleteUrl = $Payment_Refund->DeleteUrl();
		$this->ListUrl = $Payment_Refund->ListUrl();

		// Call Row_Rendering event
		$Payment_Refund->Row_Rendering();

		// Common render codes for all row types
		// scholarship_payment_id

		$Payment_Refund->scholarship_payment_id->CellCssStyle = ""; $Payment_Refund->scholarship_payment_id->CellCssClass = "";
		$Payment_Refund->scholarship_payment_id->CellAttrs = array(); $Payment_Refund->scholarship_payment_id->ViewAttrs = array(); $Payment_Refund->scholarship_payment_id->EditAttrs = array();

		// date
		$Payment_Refund->date->CellCssStyle = ""; $Payment_Refund->date->CellCssClass = "";
		$Payment_Refund->date->CellAttrs = array(); $Payment_Refund->date->ViewAttrs = array(); $Payment_Refund->date->EditAttrs = array();

		// status
		$Payment_Refund->status->CellCssStyle = ""; $Payment_Refund->status->CellCssClass = "";
		$Payment_Refund->status->CellAttrs = array(); $Payment_Refund->status->ViewAttrs = array(); $Payment_Refund->status->EditAttrs = array();

		// refund_amount
		$Payment_Refund->refund_amount->CellCssStyle = ""; $Payment_Refund->refund_amount->CellCssClass = "";
		$Payment_Refund->refund_amount->CellAttrs = array(); $Payment_Refund->refund_amount->ViewAttrs = array(); $Payment_Refund->refund_amount->EditAttrs = array();

		// amount
		$Payment_Refund->amount->CellCssStyle = ""; $Payment_Refund->amount->CellCssClass = "";
		$Payment_Refund->amount->CellAttrs = array(); $Payment_Refund->amount->ViewAttrs = array(); $Payment_Refund->amount->EditAttrs = array();

		// memo
		$Payment_Refund->memo->CellCssStyle = ""; $Payment_Refund->memo->CellCssClass = "";
		$Payment_Refund->memo->CellAttrs = array(); $Payment_Refund->memo->ViewAttrs = array(); $Payment_Refund->memo->EditAttrs = array();

		// year
		$Payment_Refund->year->CellCssStyle = ""; $Payment_Refund->year->CellCssClass = "";
		$Payment_Refund->year->CellAttrs = array(); $Payment_Refund->year->ViewAttrs = array(); $Payment_Refund->year->EditAttrs = array();

		// scholarship_package_scholarship_package_id
		$Payment_Refund->scholarship_package_scholarship_package_id->CellCssStyle = ""; $Payment_Refund->scholarship_package_scholarship_package_id->CellCssClass = "";
		$Payment_Refund->scholarship_package_scholarship_package_id->CellAttrs = array(); $Payment_Refund->scholarship_package_scholarship_package_id->ViewAttrs = array(); $Payment_Refund->scholarship_package_scholarship_package_id->EditAttrs = array();

		// programarea_residentarea_id
		$Payment_Refund->programarea_residentarea_id->CellCssStyle = ""; $Payment_Refund->programarea_residentarea_id->CellCssClass = "";
		$Payment_Refund->programarea_residentarea_id->CellAttrs = array(); $Payment_Refund->programarea_residentarea_id->ViewAttrs = array(); $Payment_Refund->programarea_residentarea_id->EditAttrs = array();

		// programarea_payingarea_id
		$Payment_Refund->programarea_payingarea_id->CellCssStyle = ""; $Payment_Refund->programarea_payingarea_id->CellCssClass = "";
		$Payment_Refund->programarea_payingarea_id->CellAttrs = array(); $Payment_Refund->programarea_payingarea_id->ViewAttrs = array(); $Payment_Refund->programarea_payingarea_id->EditAttrs = array();

		// payment_request_payment_request_id
		$Payment_Refund->payment_request_payment_request_id->CellCssStyle = ""; $Payment_Refund->payment_request_payment_request_id->CellCssClass = "";
		$Payment_Refund->payment_request_payment_request_id->CellAttrs = array(); $Payment_Refund->payment_request_payment_request_id->ViewAttrs = array(); $Payment_Refund->payment_request_payment_request_id->EditAttrs = array();

		// bankname
		$Payment_Refund->bankname->CellCssStyle = ""; $Payment_Refund->bankname->CellCssClass = "";
		$Payment_Refund->bankname->CellAttrs = array(); $Payment_Refund->bankname->ViewAttrs = array(); $Payment_Refund->bankname->EditAttrs = array();

		// account_no
		$Payment_Refund->account_no->CellCssStyle = ""; $Payment_Refund->account_no->CellCssClass = "";
		$Payment_Refund->account_no->CellAttrs = array(); $Payment_Refund->account_no->ViewAttrs = array(); $Payment_Refund->account_no->EditAttrs = array();

		// schools_school_id
		$Payment_Refund->schools_school_id->CellCssStyle = ""; $Payment_Refund->schools_school_id->CellCssClass = "";
		$Payment_Refund->schools_school_id->CellAttrs = array(); $Payment_Refund->schools_school_id->ViewAttrs = array(); $Payment_Refund->schools_school_id->EditAttrs = array();
		if ($Payment_Refund->RowType == EW_ROWTYPE_VIEW) { // View row

			// scholarship_payment_id
			$Payment_Refund->scholarship_payment_id->ViewValue = $Payment_Refund->scholarship_payment_id->CurrentValue;
			$Payment_Refund->scholarship_payment_id->CssStyle = "";
			$Payment_Refund->scholarship_payment_id->CssClass = "";
			$Payment_Refund->scholarship_payment_id->ViewCustomAttributes = "";

			// date
			$Payment_Refund->date->ViewValue = $Payment_Refund->date->CurrentValue;
			$Payment_Refund->date->ViewValue = ew_FormatDateTime($Payment_Refund->date->ViewValue, 7);
			$Payment_Refund->date->CssStyle = "";
			$Payment_Refund->date->CssClass = "";
			$Payment_Refund->date->ViewCustomAttributes = "";

			// status
			if (strval($Payment_Refund->status->CurrentValue) <> "") {
				switch ($Payment_Refund->status->CurrentValue) {
					case "PENDING":
						$Payment_Refund->status->ViewValue = "PENDING";
						break;
					case "PAID":
						$Payment_Refund->status->ViewValue = "PAID";
						break;
					default:
						$Payment_Refund->status->ViewValue = $Payment_Refund->status->CurrentValue;
				}
			} else {
				$Payment_Refund->status->ViewValue = NULL;
			}
			$Payment_Refund->status->CssStyle = "";
			$Payment_Refund->status->CssClass = "";
			$Payment_Refund->status->ViewCustomAttributes = "";

			// refund_amount
			$Payment_Refund->refund_amount->ViewValue = $Payment_Refund->refund_amount->CurrentValue;
			$Payment_Refund->refund_amount->CssStyle = "";
			$Payment_Refund->refund_amount->CssClass = "";
			$Payment_Refund->refund_amount->ViewCustomAttributes = "";

			// amount
			$Payment_Refund->amount->ViewValue = $Payment_Refund->amount->CurrentValue;
			$Payment_Refund->amount->CssStyle = "";
			$Payment_Refund->amount->CssClass = "";
			$Payment_Refund->amount->ViewCustomAttributes = "";

			// memo
			$Payment_Refund->memo->ViewValue = $Payment_Refund->memo->CurrentValue;
			$Payment_Refund->memo->CssStyle = "";
			$Payment_Refund->memo->CssClass = "";
			$Payment_Refund->memo->ViewCustomAttributes = "";

			// year
			$Payment_Refund->year->ViewValue = $Payment_Refund->year->CurrentValue;
			$Payment_Refund->year->CssStyle = "";
			$Payment_Refund->year->CssClass = "";
			$Payment_Refund->year->ViewCustomAttributes = "";

			// scholarship_package_scholarship_package_id
			if (strval($Payment_Refund->scholarship_package_scholarship_package_id->CurrentValue) <> "") {
				$sFilterWrk = "`status` = " . ew_AdjustSql($Payment_Refund->scholarship_package_scholarship_package_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `scholarship_type` FROM `scholarship_package`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Payment_Refund->scholarship_package_scholarship_package_id->ViewValue = $rswrk->fields('scholarship_type');
					$rswrk->Close();
				} else {
					$Payment_Refund->scholarship_package_scholarship_package_id->ViewValue = $Payment_Refund->scholarship_package_scholarship_package_id->CurrentValue;
				}
			} else {
				$Payment_Refund->scholarship_package_scholarship_package_id->ViewValue = NULL;
			}
			$Payment_Refund->scholarship_package_scholarship_package_id->CssStyle = "";
			$Payment_Refund->scholarship_package_scholarship_package_id->CssClass = "";
			$Payment_Refund->scholarship_package_scholarship_package_id->ViewCustomAttributes = "";

			// programarea_residentarea_id
			if (strval($Payment_Refund->programarea_residentarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($Payment_Refund->programarea_residentarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Payment_Refund->programarea_residentarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$Payment_Refund->programarea_residentarea_id->ViewValue = $Payment_Refund->programarea_residentarea_id->CurrentValue;
				}
			} else {
				$Payment_Refund->programarea_residentarea_id->ViewValue = NULL;
			}
			$Payment_Refund->programarea_residentarea_id->CssStyle = "";
			$Payment_Refund->programarea_residentarea_id->CssClass = "";
			$Payment_Refund->programarea_residentarea_id->ViewCustomAttributes = "";

			// programarea_payingarea_id
			if (strval($Payment_Refund->programarea_payingarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($Payment_Refund->programarea_payingarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Payment_Refund->programarea_payingarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$Payment_Refund->programarea_payingarea_id->ViewValue = $Payment_Refund->programarea_payingarea_id->CurrentValue;
				}
			} else {
				$Payment_Refund->programarea_payingarea_id->ViewValue = NULL;
			}
			$Payment_Refund->programarea_payingarea_id->CssStyle = "";
			$Payment_Refund->programarea_payingarea_id->CssClass = "";
			$Payment_Refund->programarea_payingarea_id->ViewCustomAttributes = "";

			// payment_request_payment_request_id
			if (strval($Payment_Refund->payment_request_payment_request_id->CurrentValue) <> "") {
				$sFilterWrk = "`payment_request_id` = " . ew_AdjustSql($Payment_Refund->payment_request_payment_request_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `code` FROM `payment_request`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Payment_Refund->payment_request_payment_request_id->ViewValue = $rswrk->fields('code');
					$rswrk->Close();
				} else {
					$Payment_Refund->payment_request_payment_request_id->ViewValue = $Payment_Refund->payment_request_payment_request_id->CurrentValue;
				}
			} else {
				$Payment_Refund->payment_request_payment_request_id->ViewValue = NULL;
			}
			$Payment_Refund->payment_request_payment_request_id->CssStyle = "";
			$Payment_Refund->payment_request_payment_request_id->CssClass = "";
			$Payment_Refund->payment_request_payment_request_id->ViewCustomAttributes = "";

			// bankname
			$Payment_Refund->bankname->ViewValue = $Payment_Refund->bankname->CurrentValue;
			$Payment_Refund->bankname->CssStyle = "";
			$Payment_Refund->bankname->CssClass = "";
			$Payment_Refund->bankname->ViewCustomAttributes = "";

			// account_no
			$Payment_Refund->account_no->ViewValue = $Payment_Refund->account_no->CurrentValue;
			$Payment_Refund->account_no->CssStyle = "";
			$Payment_Refund->account_no->CssClass = "";
			$Payment_Refund->account_no->ViewCustomAttributes = "";

			// schools_school_id
			if (strval($Payment_Refund->schools_school_id->CurrentValue) <> "") {
				$sFilterWrk = "`school_id` = " . ew_AdjustSql($Payment_Refund->schools_school_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `school_name` FROM `schools`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Payment_Refund->schools_school_id->ViewValue = $rswrk->fields('school_name');
					$rswrk->Close();
				} else {
					$Payment_Refund->schools_school_id->ViewValue = $Payment_Refund->schools_school_id->CurrentValue;
				}
			} else {
				$Payment_Refund->schools_school_id->ViewValue = NULL;
			}
			$Payment_Refund->schools_school_id->CssStyle = "";
			$Payment_Refund->schools_school_id->CssClass = "";
			$Payment_Refund->schools_school_id->ViewCustomAttributes = "";

			// group_id
			$Payment_Refund->group_id->ViewValue = $Payment_Refund->group_id->CurrentValue;
			$Payment_Refund->group_id->CssStyle = "";
			$Payment_Refund->group_id->CssClass = "";
			$Payment_Refund->group_id->ViewCustomAttributes = "";

			// scholarship_payment_id
			$Payment_Refund->scholarship_payment_id->HrefValue = "";
			$Payment_Refund->scholarship_payment_id->TooltipValue = "";

			// date
			$Payment_Refund->date->HrefValue = "";
			$Payment_Refund->date->TooltipValue = "";

			// status
			$Payment_Refund->status->HrefValue = "";
			$Payment_Refund->status->TooltipValue = "";

			// refund_amount
			$Payment_Refund->refund_amount->HrefValue = "";
			$Payment_Refund->refund_amount->TooltipValue = "";

			// amount
			$Payment_Refund->amount->HrefValue = "";
			$Payment_Refund->amount->TooltipValue = "";

			// memo
			$Payment_Refund->memo->HrefValue = "";
			$Payment_Refund->memo->TooltipValue = "";

			// year
			$Payment_Refund->year->HrefValue = "";
			$Payment_Refund->year->TooltipValue = "";

			// scholarship_package_scholarship_package_id
			$Payment_Refund->scholarship_package_scholarship_package_id->HrefValue = "";
			$Payment_Refund->scholarship_package_scholarship_package_id->TooltipValue = "";

			// programarea_residentarea_id
			$Payment_Refund->programarea_residentarea_id->HrefValue = "";
			$Payment_Refund->programarea_residentarea_id->TooltipValue = "";

			// programarea_payingarea_id
			$Payment_Refund->programarea_payingarea_id->HrefValue = "";
			$Payment_Refund->programarea_payingarea_id->TooltipValue = "";

			// payment_request_payment_request_id
			$Payment_Refund->payment_request_payment_request_id->HrefValue = "";
			$Payment_Refund->payment_request_payment_request_id->TooltipValue = "";

			// bankname
			$Payment_Refund->bankname->HrefValue = "";
			$Payment_Refund->bankname->TooltipValue = "";

			// account_no
			$Payment_Refund->account_no->HrefValue = "";
			$Payment_Refund->account_no->TooltipValue = "";

			// schools_school_id
			$Payment_Refund->schools_school_id->HrefValue = "";
			$Payment_Refund->schools_school_id->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($Payment_Refund->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$Payment_Refund->Row_Rendered();
	}

	// Show link optionally based on User ID
	function ShowOptionLink() {
		global $Security, $Payment_Refund;
		if ($Security->IsLoggedIn()) {
			if (!$Security->IsAdmin()) {
				return $Security->IsValidUserID($Payment_Refund->group_id->CurrentValue);
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
