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
$programarea_delete = new cprogramarea_delete();
$Page =& $programarea_delete;

// Page init
$programarea_delete->Page_Init();

// Page main
$programarea_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var programarea_delete = new ew_Page("programarea_delete");

// page properties
programarea_delete.PageID = "delete"; // page ID
programarea_delete.FormID = "fprogramareadelete"; // form ID
var EW_PAGE_ID = programarea_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
programarea_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
programarea_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
programarea_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $programarea_delete->LoadRecordset())
	$programarea_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($programarea_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$programarea_delete->Page_Terminate("programarealist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $programarea->TableCaption() ?><br><br>
<a href="<?php echo $programarea->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$programarea_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="programarea">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($programarea_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $programarea->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $programarea->programarea_name->FldCaption() ?></td>
		<td valign="top"><?php echo $programarea->regionID->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$programarea_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$programarea_delete->lRecCnt++;

	// Set row properties
	$programarea->CssClass = "";
	$programarea->CssStyle = "";
	$programarea->RowAttrs = array();
	$programarea->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$programarea_delete->LoadRowValues($rs);

	// Render row
	$programarea_delete->RenderRow();
?>
	<tr<?php echo $programarea->RowAttributes() ?>>
		<td<?php echo $programarea->programarea_name->CellAttributes() ?>>
<div<?php echo $programarea->programarea_name->ViewAttributes() ?>><?php echo $programarea->programarea_name->ListViewValue() ?></div></td>
		<td<?php echo $programarea->regionID->CellAttributes() ?>>
<div<?php echo $programarea->regionID->ViewAttributes() ?>><?php echo $programarea->regionID->ListViewValue() ?></div></td>
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
$programarea_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cprogramarea_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'programarea';

	// Page object name
	var $PageObjName = 'programarea_delete';

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
	function cprogramarea_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (programarea)
		$GLOBALS["programarea"] = new cprogramarea();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
		if (!$Security->CanDelete()) {
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
	var $lTotalRecs = 0;
	var $lRecCnt;
	var $arRecKeys = array();

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $programarea;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["programarea_id"] <> "") {
			$programarea->programarea_id->setQueryStringValue($_GET["programarea_id"]);
			if (!is_numeric($programarea->programarea_id->QueryStringValue))
				$this->Page_Terminate("programarealist.php"); // Prevent SQL injection, exit
			$sKey .= $programarea->programarea_id->QueryStringValue;
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
			$this->Page_Terminate("programarealist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("programarealist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`programarea_id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in programarea class, programareainfo.php

		$programarea->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$programarea->CurrentAction = $_POST["a_delete"];
		} else {
			$programarea->CurrentAction = "I"; // Display record
		}
		switch ($programarea->CurrentAction) {
			case "D": // Delete
				$programarea->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($programarea->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $programarea;
		$DeleteRows = TRUE;
		$sWrkFilter = $programarea->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in programarea class, programareainfo.php

		$programarea->CurrentFilter = $sWrkFilter;
		$sSql = $programarea->SQL();
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
				$DeleteRows = $programarea->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['programarea_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($programarea->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($programarea->CancelMessage <> "") {
				$this->setMessage($programarea->CancelMessage);
				$programarea->CancelMessage = "";
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
				$programarea->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $programarea;

		// Call Recordset Selecting event
		$programarea->Recordset_Selecting($programarea->CurrentFilter);

		// Load List page SQL
		$sSql = $programarea->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$programarea->Recordset_Selected($rs);
		return $rs;
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

	    $msg="<font size='4'>Program Area/Unit record is an important record for this database because all other records refer to it. Before you delete a program area/unit record, all district, communit, school, studnet and other record that belong to the program area are removed.</font>";
	}
}
?>
