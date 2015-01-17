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
$payment_request_delete = new cpayment_request_delete();
$Page =& $payment_request_delete;

// Page init
$payment_request_delete->Page_Init();

// Page main
$payment_request_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var payment_request_delete = new ew_Page("payment_request_delete");

// page properties
payment_request_delete.PageID = "delete"; // page ID
payment_request_delete.FormID = "fpayment_requestdelete"; // form ID
var EW_PAGE_ID = payment_request_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
payment_request_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
payment_request_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
payment_request_delete.ValidateRequired = false; // no JavaScript validation
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
<?php

// Load records for display
if ($rs = $payment_request_delete->LoadRecordset())
	$payment_request_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($payment_request_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$payment_request_delete->Page_Terminate("payment_requestlist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $payment_request->TableCaption() ?><br><br>
<a href="<?php echo $payment_request->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$payment_request_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="payment_request">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($payment_request_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $payment_request->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $payment_request->payment_request_id->FldCaption() ?></td>
		<td valign="top"><?php echo $payment_request->year->FldCaption() ?></td>
		<td valign="top"><?php echo $payment_request->request_date->FldCaption() ?></td>
		<td valign="top"><?php echo $payment_request->programarea_id->FldCaption() ?></td>
		<td valign="top"><?php echo $payment_request->request_status->FldCaption() ?></td>
		<td valign="top"><?php echo $payment_request->code->FldCaption() ?></td>
		<td valign="top"><?php echo $payment_request->financial_year_financial_year_id->FldCaption() ?></td>
		<td valign="top"><?php echo $payment_request->amount->FldCaption() ?></td>
		<td valign="top"><?php echo $payment_request->group_id->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$payment_request_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$payment_request_delete->lRecCnt++;

	// Set row properties
	$payment_request->CssClass = "";
	$payment_request->CssStyle = "";
	$payment_request->RowAttrs = array();
	$payment_request->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$payment_request_delete->LoadRowValues($rs);

	// Render row
	$payment_request_delete->RenderRow();
?>
	<tr<?php echo $payment_request->RowAttributes() ?>>
		<td<?php echo $payment_request->payment_request_id->CellAttributes() ?>>
<div<?php echo $payment_request->payment_request_id->ViewAttributes() ?>><?php echo $payment_request->payment_request_id->ListViewValue() ?></div></td>
		<td<?php echo $payment_request->year->CellAttributes() ?>>
<div<?php echo $payment_request->year->ViewAttributes() ?>><?php echo $payment_request->year->ListViewValue() ?></div></td>
		<td<?php echo $payment_request->request_date->CellAttributes() ?>>
<div<?php echo $payment_request->request_date->ViewAttributes() ?>><?php echo $payment_request->request_date->ListViewValue() ?></div></td>
		<td<?php echo $payment_request->programarea_id->CellAttributes() ?>>
<div<?php echo $payment_request->programarea_id->ViewAttributes() ?>><?php echo $payment_request->programarea_id->ListViewValue() ?></div></td>
		<td<?php echo $payment_request->request_status->CellAttributes() ?>>
<div<?php echo $payment_request->request_status->ViewAttributes() ?>><?php echo $payment_request->request_status->ListViewValue() ?></div></td>
		<td<?php echo $payment_request->code->CellAttributes() ?>>
<div<?php echo $payment_request->code->ViewAttributes() ?>><?php echo $payment_request->code->ListViewValue() ?></div></td>
		<td<?php echo $payment_request->financial_year_financial_year_id->CellAttributes() ?>>
<div<?php echo $payment_request->financial_year_financial_year_id->ViewAttributes() ?>><?php echo $payment_request->financial_year_financial_year_id->ListViewValue() ?></div></td>
		<td<?php echo $payment_request->amount->CellAttributes() ?>>
<div<?php echo $payment_request->amount->ViewAttributes() ?>><?php echo $payment_request->amount->ListViewValue() ?></div></td>
		<td<?php echo $payment_request->group_id->CellAttributes() ?>>
<div<?php echo $payment_request->group_id->ViewAttributes() ?>><?php echo $payment_request->group_id->ListViewValue() ?></div></td>
	</tr>
<?php
	$rs->MoveNext();
}
$rs->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$payment_request_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cpayment_request_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'payment_request';

	// Page object name
	var $PageObjName = 'payment_request_delete';

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
	function cpayment_request_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (payment_request)
		$GLOBALS["payment_request"] = new cpayment_request();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
		if (!$Security->CanDelete()) {
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
	var $lTotalRecs = 0;
	var $lRecCnt;
	var $arRecKeys = array();

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $payment_request;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["payment_request_id"] <> "") {
			$payment_request->payment_request_id->setQueryStringValue($_GET["payment_request_id"]);
			if (!is_numeric($payment_request->payment_request_id->QueryStringValue))
				$this->Page_Terminate("payment_requestlist.php"); // Prevent SQL injection, exit
			$sKey .= $payment_request->payment_request_id->QueryStringValue;
		} else {
			$bSingleDelete = FALSE;
		}
		if ($bSingleDelete) {
			$nKeySelected = 1; // Set up key selected count
			$this->arRecKeys[0] = $sKey;
		} else {
			if (isset($_POST["key_m"])) { // Key in form
				$nKeySelected = count($_POST["key_m"]); // Set up key selected count
				$this->arRecKeys = ew_StripSlashes($_POST["key_m"]);
			}
		}
		if ($nKeySelected <= 0)
			$this->Page_Terminate("payment_requestlist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("payment_requestlist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`payment_request_id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in payment_request class, payment_requestinfo.php

		$payment_request->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$payment_request->CurrentAction = $_POST["a_delete"];
		} else {
			$payment_request->CurrentAction = "I"; // Display record
		}
		switch ($payment_request->CurrentAction) {
			case "D": // Delete
				$payment_request->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($payment_request->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $payment_request;
		$DeleteRows = TRUE;
		$sWrkFilter = $payment_request->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in payment_request class, payment_requestinfo.php

		$payment_request->CurrentFilter = $sWrkFilter;
		$sSql = $payment_request->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;
		}
		$conn->BeginTrans();
		$this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteBegin")); // Batch delete begin

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $payment_request->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['payment_request_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($payment_request->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($payment_request->CancelMessage <> "") {
				$this->setMessage($payment_request->CancelMessage);
				$payment_request->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
			if ($DeleteRows) {
				foreach ($rsold as $row)
					$this->WriteAuditTrailOnDelete($row);
			}
			$this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteSuccess")); // Batch delete success
		} else {
			$conn->RollbackTrans(); // Rollback changes
			$this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteRollback")); // Batch delete rollback
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$payment_request->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $payment_request;

		// Call Recordset Selecting event
		$payment_request->Recordset_Selecting($payment_request->CurrentFilter);

		// Load List page SQL
		$sSql = $payment_request->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$payment_request->Recordset_Selected($rs);
		return $rs;
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

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'payment_request';
	  $usr = CurrentUserID();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (delete page)
	function WriteAuditTrailOnDelete(&$rs) {
		global $payment_request;
		$table = 'payment_request';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['payment_request_id'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $curUser = CurrentUserID();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $payment_request->fields) && $payment_request->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($payment_request->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					$oldvalue = "<MEMO>"; // Memo field
				} elseif ($payment_request->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
					$oldvalue = "<XML>"; // XML field
				} else {
					$oldvalue = $rs[$fldname];
				}
				ew_WriteAuditTrail("log", $dt, $id, $curUser, "D", $table, $fldname, $key, $oldvalue, "");
			}
		}
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
