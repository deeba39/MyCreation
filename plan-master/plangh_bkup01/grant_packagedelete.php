<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "grant_packageinfo.php" ?>
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
$grant_package_delete = new cgrant_package_delete();
$Page =& $grant_package_delete;

// Page init
$grant_package_delete->Page_Init();

// Page main
$grant_package_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var grant_package_delete = new ew_Page("grant_package_delete");

// page properties
grant_package_delete.PageID = "delete"; // page ID
grant_package_delete.FormID = "fgrant_packagedelete"; // form ID
var EW_PAGE_ID = grant_package_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
grant_package_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
grant_package_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
grant_package_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $grant_package_delete->LoadRecordset())
	$grant_package_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($grant_package_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$grant_package_delete->Page_Terminate("grant_packagelist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $grant_package->TableCaption() ?><br><br>
<a href="<?php echo $grant_package->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$grant_package_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="grant_package">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($grant_package_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $grant_package->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $grant_package->name->FldCaption() ?></td>
		<td valign="top"><?php echo $grant_package->code->FldCaption() ?></td>
		<td valign="top"><?php echo $grant_package->annual_amount->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$grant_package_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$grant_package_delete->lRecCnt++;

	// Set row properties
	$grant_package->CssClass = "";
	$grant_package->CssStyle = "";
	$grant_package->RowAttrs = array();
	$grant_package->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$grant_package_delete->LoadRowValues($rs);

	// Render row
	$grant_package_delete->RenderRow();
?>
	<tr<?php echo $grant_package->RowAttributes() ?>>
		<td<?php echo $grant_package->name->CellAttributes() ?>>
<div<?php echo $grant_package->name->ViewAttributes() ?>><?php echo $grant_package->name->ListViewValue() ?></div></td>
		<td<?php echo $grant_package->code->CellAttributes() ?>>
<div<?php echo $grant_package->code->ViewAttributes() ?>><?php echo $grant_package->code->ListViewValue() ?></div></td>
		<td<?php echo $grant_package->annual_amount->CellAttributes() ?>>
<div<?php echo $grant_package->annual_amount->ViewAttributes() ?>><?php echo $grant_package->annual_amount->ListViewValue() ?></div></td>
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
$grant_package_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cgrant_package_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'grant_package';

	// Page object name
	var $PageObjName = 'grant_package_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $grant_package;
		if ($grant_package->UseTokenInUrl) $PageUrl .= "t=" . $grant_package->TableVar . "&"; // Add page token
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
		global $objForm, $grant_package;
		if ($grant_package->UseTokenInUrl) {
			if ($objForm)
				return ($grant_package->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($grant_package->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cgrant_package_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (grant_package)
		$GLOBALS["grant_package"] = new cgrant_package();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'grant_package', TRUE);

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
		global $grant_package;

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
			$this->Page_Terminate("grant_packagelist.php");
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
	var $lTotalRecs = 0;
	var $lRecCnt;
	var $arRecKeys = array();

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $grant_package;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["grant_package_id"] <> "") {
			$grant_package->grant_package_id->setQueryStringValue($_GET["grant_package_id"]);
			if (!is_numeric($grant_package->grant_package_id->QueryStringValue))
				$this->Page_Terminate("grant_packagelist.php"); // Prevent SQL injection, exit
			$sKey .= $grant_package->grant_package_id->QueryStringValue;
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
			$this->Page_Terminate("grant_packagelist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("grant_packagelist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`grant_package_id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in grant_package class, grant_packageinfo.php

		$grant_package->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$grant_package->CurrentAction = $_POST["a_delete"];
		} else {
			$grant_package->CurrentAction = "I"; // Display record
		}
		switch ($grant_package->CurrentAction) {
			case "D": // Delete
				$grant_package->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($grant_package->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $grant_package;
		$DeleteRows = TRUE;
		$sWrkFilter = $grant_package->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in grant_package class, grant_packageinfo.php

		$grant_package->CurrentFilter = $sWrkFilter;
		$sSql = $grant_package->SQL();
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

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $grant_package->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['grant_package_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($grant_package->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($grant_package->CancelMessage <> "") {
				$this->setMessage($grant_package->CancelMessage);
				$grant_package->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$grant_package->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $grant_package;

		// Call Recordset Selecting event
		$grant_package->Recordset_Selecting($grant_package->CurrentFilter);

		// Load List page SQL
		$sSql = $grant_package->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$grant_package->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $grant_package;
		$sFilter = $grant_package->KeyFilter();

		// Call Row Selecting event
		$grant_package->Row_Selecting($sFilter);

		// Load SQL based on filter
		$grant_package->CurrentFilter = $sFilter;
		$sSql = $grant_package->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$grant_package->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $grant_package;
		$grant_package->grant_package_id->setDbValue($rs->fields('grant_package_id'));
		$grant_package->name->setDbValue($rs->fields('name'));
		$grant_package->code->setDbValue($rs->fields('code'));
		$grant_package->annual_amount->setDbValue($rs->fields('annual_amount'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $grant_package;

		// Initialize URLs
		// Call Row_Rendering event

		$grant_package->Row_Rendering();

		// Common render codes for all row types
		// name

		$grant_package->name->CellCssStyle = ""; $grant_package->name->CellCssClass = "";
		$grant_package->name->CellAttrs = array(); $grant_package->name->ViewAttrs = array(); $grant_package->name->EditAttrs = array();

		// code
		$grant_package->code->CellCssStyle = ""; $grant_package->code->CellCssClass = "";
		$grant_package->code->CellAttrs = array(); $grant_package->code->ViewAttrs = array(); $grant_package->code->EditAttrs = array();

		// annual_amount
		$grant_package->annual_amount->CellCssStyle = ""; $grant_package->annual_amount->CellCssClass = "";
		$grant_package->annual_amount->CellAttrs = array(); $grant_package->annual_amount->ViewAttrs = array(); $grant_package->annual_amount->EditAttrs = array();
		if ($grant_package->RowType == EW_ROWTYPE_VIEW) { // View row

			// grant_package_id
			$grant_package->grant_package_id->ViewValue = $grant_package->grant_package_id->CurrentValue;
			$grant_package->grant_package_id->CssStyle = "";
			$grant_package->grant_package_id->CssClass = "";
			$grant_package->grant_package_id->ViewCustomAttributes = "";

			// name
			$grant_package->name->ViewValue = $grant_package->name->CurrentValue;
			$grant_package->name->CssStyle = "";
			$grant_package->name->CssClass = "";
			$grant_package->name->ViewCustomAttributes = "";

			// code
			$grant_package->code->ViewValue = $grant_package->code->CurrentValue;
			$grant_package->code->CssStyle = "";
			$grant_package->code->CssClass = "";
			$grant_package->code->ViewCustomAttributes = "";

			// annual_amount
			$grant_package->annual_amount->ViewValue = $grant_package->annual_amount->CurrentValue;
			$grant_package->annual_amount->CssStyle = "";
			$grant_package->annual_amount->CssClass = "";
			$grant_package->annual_amount->ViewCustomAttributes = "";

			// name
			$grant_package->name->HrefValue = "";
			$grant_package->name->TooltipValue = "";

			// code
			$grant_package->code->HrefValue = "";
			$grant_package->code->TooltipValue = "";

			// annual_amount
			$grant_package->annual_amount->HrefValue = "";
			$grant_package->annual_amount->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($grant_package->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$grant_package->Row_Rendered();
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
