<?php

// Global variable for table object
$New_Payment_Requests = NULL;

//
// Table class for New_Payment_Requests
//
class cNew_Payment_Requests {
	var $TableVar = 'New_Payment_Requests';
	var $TableName = 'New_Payment_Requests';
	var $TableType = 'CUSTOMVIEW';
	var $payment_request_id;
	var $year;
	var $request_date;
	var $programarea_id;
	var $request_status;
	var $code;
	var $group_id;
	var $fields = array();
	var $UseTokenInUrl = EW_USE_TOKEN_IN_URL;
	var $Export; // Export
	var $ExportOriginalValue = EW_EXPORT_ORIGINAL_VALUE;
	var $ExportAll = TRUE;
	var $SendEmail; // Send email
	var $TableCustomInnerHtml; // Custom inner HTML
	var $BasicSearchKeyword; // Basic search keyword
	var $BasicSearchType; // Basic search type
	var $CurrentFilter; // Current filter
	var $CurrentOrder; // Current order
	var $CurrentOrderType; // Current order type
	var $RowType; // Row type
	var $CssClass; // CSS class
	var $CssStyle; // CSS style
	var $RowAttrs = array(); // Row custom attributes
	var $TableFilter = "";
	var $CurrentAction; // Current action
	var $UpdateConflict; // Update conflict
	var $EventName; // Event name
	var $EventCancelled; // Event cancelled
	var $CancelMessage; // Cancel message

	//
	// Table class constructor
	//
	function cNew_Payment_Requests() {
		global $Language;

		// payment_request_id
		$this->payment_request_id = new cField('New_Payment_Requests', 'New_Payment_Requests', 'x_payment_request_id', 'payment_request_id', 'payment_request.payment_request_id', 3, -1, FALSE, 'payment_request.payment_request_id', FALSE);
		$this->payment_request_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['payment_request_id'] =& $this->payment_request_id;

		// year
		$this->year = new cField('New_Payment_Requests', 'New_Payment_Requests', 'x_year', 'year', 'payment_request.year', 18, -1, FALSE, 'payment_request.year', FALSE);
		$this->year->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['year'] =& $this->year;

		// request_date
		$this->request_date = new cField('New_Payment_Requests', 'New_Payment_Requests', 'x_request_date', 'request_date', 'payment_request.request_date', 133, 7, FALSE, 'payment_request.request_date', FALSE);
		$this->request_date->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['request_date'] =& $this->request_date;

		// programarea_id
		$this->programarea_id = new cField('New_Payment_Requests', 'New_Payment_Requests', 'x_programarea_id', 'programarea_id', 'payment_request.programarea_id', 3, -1, FALSE, 'payment_request.programarea_id', FALSE);
		$this->programarea_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['programarea_id'] =& $this->programarea_id;

		// request_status
		$this->request_status = new cField('New_Payment_Requests', 'New_Payment_Requests', 'x_request_status', 'request_status', 'payment_request.request_status', 202, -1, FALSE, 'payment_request.request_status', FALSE);
		$this->fields['request_status'] =& $this->request_status;

		// code
		$this->code = new cField('New_Payment_Requests', 'New_Payment_Requests', 'x_code', 'code', 'payment_request.code', 200, -1, FALSE, 'payment_request.code', FALSE);
		$this->fields['code'] =& $this->code;

		// group_id
		$this->group_id = new cField('New_Payment_Requests', 'New_Payment_Requests', 'x_group_id', 'group_id', 'payment_request.group_id', 3, -1, FALSE, 'payment_request.group_id', FALSE);
		$this->group_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['group_id'] =& $this->group_id;
	}

	// Table caption
	function TableCaption() {
		global $Language;
		return $Language->TablePhrase($this->TableVar, "TblCaption");
	}

	// Page caption
	function PageCaption($Page) {
		global $Language;
		$Caption = $Language->TablePhrase($this->TableVar, "TblPageCaption" . $Page);
		if ($Caption == "") $Caption = "Page " . $Page;
		return $Caption;
	}

	// Export return page
	function ExportReturnUrl() {
		$url = @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_EXPORT_RETURN_URL];
		return ($url <> "") ? $url : ew_CurrentPage();
	}

	function setExportReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_EXPORT_RETURN_URL] = $v;
	}

	// Records per page
	function getRecordsPerPage() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE];
	}

	function setRecordsPerPage($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE] = $v;
	}

	// Start record number
	function getStartRecordNumber() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC];
	}

	function setStartRecordNumber($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC] = $v;
	}

	// Search highlight name
	function HighlightName() {
		return "New_Payment_Requests_Highlight";
	}

	// Advanced search
	function getAdvancedSearch($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld];
	}

	function setAdvancedSearch($fld, $v) {
		if (@$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] <> $v) {
			$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] = $v;
		}
	}

	// Basic search keyword
	function getSessionBasicSearchKeyword() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH];
	}

	function setSessionBasicSearchKeyword($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH] = $v;
	}

	// Basic search type
	function getSessionBasicSearchType() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE];
	}

	function setSessionBasicSearchType($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE] = $v;
	}

	// Search WHERE clause
	function getSearchWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE];
	}

	function setSearchWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE] = $v;
	}

	// Single column sort
	function UpdateSort(&$ofld) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
		} else {
			$ofld->setSort("");
		}
	}

	// Session WHERE clause
	function getSessionWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE];
	}

	function setSessionWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE] = $v;
	}

	// Session ORDER BY
	function getSessionOrderBy() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY];
	}

	function setSessionOrderBy($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY] = $v;
	}

	// Session key
	function getKey($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld];
	}

	function setKey($fld, $v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld] = $v;
	}

	// Table level SQL
	function SqlFrom() { // From
		return "payment_request";
	}

	function SqlSelect() { // Select
		return "SELECT payment_request.payment_request_id, payment_request.year, payment_request.request_date, payment_request.programarea_id, payment_request.request_status, payment_request.code, payment_request.group_id FROM " . $this->SqlFrom();
	}

	function SqlWhere() { // Where
		$sWhere = "payment_request.request_status = 0";
		$this->TableFilter = "";
		if ($this->TableFilter <> "") {
			if ($sWhere <> "") $sWhere = "(" . $sWhere . ") AND (";
			$sWhere .= "(" . $this->TableFilter . ")";
		}
		return $sWhere;
	}

	function SqlGroupBy() { // Group By
		return "";
	}

	function SqlHaving() { // Having
		return "";
	}

	function SqlOrderBy() { // Order By
		return "";
	}

	// Check if Anonymous User is allowed
	function AllowAnonymousUser() {
		switch (EW_PAGE_ID) {
			case "add":
			case "register":
			case "addopt":
				return FALSE;
			case "edit":
			case "update":
				return FALSE;
			case "delete":
				return FALSE;
			case "view":
				return FALSE;
			case "search":
				return FALSE;
			default:
				return FALSE;
		}
	}

	// Apply User ID filters
	function ApplyUserIDFilters($sFilter) {
		global $Security;

		// Add User ID filter
		if (!$this->AllowAnonymousUser() && $Security->CurrentUserID() <> "" && !$Security->IsAdmin()) { // Non system admin
			$sFilter = $this->AddUserIDFilter($sFilter);
		}
		return $sFilter;
	}

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$sFilter = $this->CurrentFilter;
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$sFilter, $sSort);
	}

	// Table SQL with List page filter
	function SelectSQL() {
		$sFilter = $this->getSessionWhere();
		if ($this->CurrentFilter <> "") {
			if ($sFilter <> "") $sFilter = "(" . $sFilter . ") AND ";
			$sFilter .= "(" . $this->CurrentFilter . ")";
		}
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(), $this->SqlGroupBy(),
			$this->SqlHaving(), $this->SqlOrderBy(), $sFilter, $sSort);
	}

	// Try to get record count
	function TryGetRecordCount($sSql) {
		global $conn;
		$cnt = -1;
		if ($this->TableType == 'TABLE' || $this->TableType == 'VIEW') {
			$sSql = "SELECT COUNT(*) FROM" . substr($sSql, 13);
		} else {
			$sSql = "SELECT COUNT(*) FROM (" . $sSql . ") EW_COUNT_TABLE";
		}
		if ($rs = $conn->Execute($sSql)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// Get record count based on filter (for detail record count in master table pages)
	function LoadRecordCount($sFilter) {
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $sFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$sSql = $this->SQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $this->LoadRs($this->CurrentFilter)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// Get record count (for current List page)
	function SelectRecordCount() {
		global $conn;
		$origFilter = $this->CurrentFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$sSql = $this->SelectSQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $conn->Execute($this->SelectSQL())) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// INSERT statement
	function InsertSQL(&$rs) {
		global $conn;
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		if (substr($names, -1) == ",") $names = substr($names, 0, strlen($names)-1);
		if (substr($values, -1) == ",") $values = substr($values, 0, strlen($values)-1);
		return "INSERT INTO payment_request ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE payment_request SET ";
		foreach ($rs as $name => $value) {
			$SQL .= $this->fields[$name]->FldExpression . "=";
			$SQL .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		if (substr($SQL, -1) == ",") $SQL = substr($SQL, 0, strlen($SQL)-1);
		if ($this->CurrentFilter <> "")	$SQL .= " WHERE " . $this->CurrentFilter;
		return $SQL;
	}

	// DELETE statement
	function DeleteSQL(&$rs) {
		$SQL = "DELETE FROM payment_request WHERE ";
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		return $sKeyFilter;
	}

	// Return page URL
	function getReturnUrl() {
		$name = EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "New_Payment_Requestslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "New_Payment_Requestslist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("New_Payment_Requestsview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "New_Payment_Requestsadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit URL
	function EditUrl() {
		return $this->KeyUrl("New_Payment_Requestsedit.php", $this->UrlParm());
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl() {
		return $this->KeyUrl("New_Payment_Requestsadd.php", $this->UrlParm());
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("New_Payment_Requestsdelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&ordertype=" . $fld->ReverseSort());
			return ew_CurrentPage() . "?" . $sUrlParm;
		} else {
			return "";
		}
	}

	// Add URL parameter
	function UrlParm($parm = "") {
		$UrlParm = ($this->UseTokenInUrl) ? "t=New_Payment_Requests" : "";
		if ($parm <> "") {
			if ($UrlParm <> "")
				$UrlParm .= "&";
			$UrlParm .= $parm;
		}
		return $UrlParm;
	}

	// Load rows based on filter
	function &LoadRs($sFilter) {
		global $conn;

		// Set up filter (SQL WHERE clause) and get return SQL
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		return $conn->Execute($sSql);
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->payment_request_id->setDbValue($rs->fields('payment_request_id'));
		$this->year->setDbValue($rs->fields('year'));
		$this->request_date->setDbValue($rs->fields('request_date'));
		$this->programarea_id->setDbValue($rs->fields('programarea_id'));
		$this->request_status->setDbValue($rs->fields('request_status'));
		$this->code->setDbValue($rs->fields('code'));
		$this->group_id->setDbValue($rs->fields('group_id'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// payment_request_id

		$this->payment_request_id->CellCssStyle = ""; $this->payment_request_id->CellCssClass = "";
		$this->payment_request_id->CellAttrs = array(); $this->payment_request_id->ViewAttrs = array(); $this->payment_request_id->EditAttrs = array();

		// year
		$this->year->CellCssStyle = ""; $this->year->CellCssClass = "";
		$this->year->CellAttrs = array(); $this->year->ViewAttrs = array(); $this->year->EditAttrs = array();

		// request_date
		$this->request_date->CellCssStyle = ""; $this->request_date->CellCssClass = "";
		$this->request_date->CellAttrs = array(); $this->request_date->ViewAttrs = array(); $this->request_date->EditAttrs = array();

		// programarea_id
		$this->programarea_id->CellCssStyle = ""; $this->programarea_id->CellCssClass = "";
		$this->programarea_id->CellAttrs = array(); $this->programarea_id->ViewAttrs = array(); $this->programarea_id->EditAttrs = array();

		// request_status
		$this->request_status->CellCssStyle = ""; $this->request_status->CellCssClass = "";
		$this->request_status->CellAttrs = array(); $this->request_status->ViewAttrs = array(); $this->request_status->EditAttrs = array();

		// code
		$this->code->CellCssStyle = ""; $this->code->CellCssClass = "";
		$this->code->CellAttrs = array(); $this->code->ViewAttrs = array(); $this->code->EditAttrs = array();

		// payment_request_id
		$this->payment_request_id->ViewValue = $this->payment_request_id->CurrentValue;
		$this->payment_request_id->CssStyle = "";
		$this->payment_request_id->CssClass = "";
		$this->payment_request_id->ViewCustomAttributes = "";

		// year
		$this->year->ViewValue = $this->year->CurrentValue;
		$this->year->CssStyle = "";
		$this->year->CssClass = "";
		$this->year->ViewCustomAttributes = "";

		// request_date
		$this->request_date->ViewValue = $this->request_date->CurrentValue;
		$this->request_date->ViewValue = ew_FormatDateTime($this->request_date->ViewValue, 7);
		$this->request_date->CssStyle = "";
		$this->request_date->CssClass = "";
		$this->request_date->ViewCustomAttributes = "";

		// programarea_id
		if (strval($this->programarea_id->CurrentValue) <> "") {
			$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($this->programarea_id->CurrentValue) . "";
		$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->programarea_id->ViewValue = $rswrk->fields('programarea_name');
				$rswrk->Close();
			} else {
				$this->programarea_id->ViewValue = $this->programarea_id->CurrentValue;
			}
		} else {
			$this->programarea_id->ViewValue = NULL;
		}
		$this->programarea_id->CssStyle = "";
		$this->programarea_id->CssClass = "";
		$this->programarea_id->ViewCustomAttributes = "";

		// request_status
		if (strval($this->request_status->CurrentValue) <> "") {
			switch ($this->request_status->CurrentValue) {
				case "NEWREQ":
					$this->request_status->ViewValue = "NEWREQ";
					break;
				case "REQUESTED":
					$this->request_status->ViewValue = "REQUESTED";
					break;
				case "DISBURSED":
					$this->request_status->ViewValue = "DISBURSED";
					break;
				case "LIQUIDATED":
					$this->request_status->ViewValue = "LIQUIDATED";
					break;
				default:
					$this->request_status->ViewValue = $this->request_status->CurrentValue;
			}
		} else {
			$this->request_status->ViewValue = NULL;
		}
		$this->request_status->CssStyle = "";
		$this->request_status->CssClass = "";
		$this->request_status->ViewCustomAttributes = "";

		// code
		$this->code->ViewValue = $this->code->CurrentValue;
		$this->code->CssStyle = "";
		$this->code->CssClass = "";
		$this->code->ViewCustomAttributes = "";

		// payment_request_id
		$this->payment_request_id->HrefValue = "";
		$this->payment_request_id->TooltipValue = "";

		// year
		$this->year->HrefValue = "";
		$this->year->TooltipValue = "";

		// request_date
		$this->request_date->HrefValue = "";
		$this->request_date->TooltipValue = "";

		// programarea_id
		$this->programarea_id->HrefValue = "";
		$this->programarea_id->TooltipValue = "";

		// request_status
		$this->request_status->HrefValue = "";
		$this->request_status->TooltipValue = "";

		// code
		$this->code->HrefValue = "";
		$this->code->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {
	}

	// Add User ID filter
	function AddUserIDFilter($sFilter) {
		global $Security;
		$sFilterWrk = $Security->UserIDList();
		if (!$Security->IsAdmin() && $sFilterWrk <> "") {
			$sFilterWrk = 'payment_request.group_id IN (' . $sFilterWrk . ')';
			if ($sFilter <> "")
				$sFilterWrk = "(" . $sFilter . ") AND (" . $sFilterWrk . ")";
		} else {
			$sFilterWrk = $sFilter;
		}
		return $sFilterWrk;
	}

	// User ID subquery
	function GetUserIDSubquery(&$fld, &$masterfld) {
		global $conn;
		$sWrk = "";
		$sSql = "SELECT " . $masterfld->FldExpression . " FROM payment_request WHERE " . $this->AddUserIDFilter("");

		// List all values
		if ($rs = $conn->Execute($sSql)) {
			while (!$rs->EOF) {
				if ($sWrk <> "") $sWrk .= ",";
				$sWrk .= ew_QuotedValue($rs->fields[0], $masterfld->FldDataType);
				$rs->MoveNext();
			}
			$rs->Close();
		}
		if ($sWrk <> "") {
			$sWrk = $fld->FldExpression . " IN (" . $sWrk . ")";
		}
		return $sWrk;
	}

	// Row styles
	function RowStyles() {
		$sAtt = "";
		$sStyle = trim($this->CssStyle);
		if (@$this->RowAttrs["style"] <> "")
			$sStyle .= " " . $this->RowAttrs["style"];
		$sClass = trim($this->CssClass);
		if (@$this->RowAttrs["class"] <> "")
			$sClass .= " " . $this->RowAttrs["class"];
		if (trim($sStyle) <> "")
			$sAtt .= " style=\"" . trim($sStyle) . "\"";
		if (trim($sClass) <> "")
			$sAtt .= " class=\"" . trim($sClass) . "\"";
		return $sAtt;
	}

	// Row attributes
	function RowAttributes() {
		$sAtt = $this->RowStyles();
		if ($this->Export == "") {
			foreach ($this->RowAttrs as $k => $v) {
				if ($k <> "class" && $k <> "style" && trim($v) <> "")
					$sAtt .= " " . $k . "=\"" . trim($v) . "\"";
			}
		}
		return $sAtt;
	}

	// Field object by name
	function fields($fldname) {
		return $this->fields[$fldname];
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here	
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here	
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here	
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 

	}

	// Row Inserting event
	function Row_Inserting(&$rs) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted(&$rs) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating(&$rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated(&$rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict(&$rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}
}
?>
