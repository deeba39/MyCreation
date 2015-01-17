<?php

// Global variable for table object
$scholarship_payment = NULL;

//
// Table class for scholarship_payment
//
class cscholarship_payment {
	var $TableVar = 'scholarship_payment';
	var $TableName = 'scholarship_payment';
	var $TableType = 'TABLE';
	var $scholarship_payment_id;
	var $date;
	var $status;
	var $amount;
	var $memo;
	var $year;
	var $scholarship_package_scholarship_package_id;
	var $programarea_residentarea_id;
	var $programarea_payingarea_id;
	var $refund_amount;
	var $payment_request_payment_request_id;
	var $bankname;
	var $account_no;
	var $schools_school_id;
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
	function cscholarship_payment() {
		global $Language;

		// scholarship_payment_id
		$this->scholarship_payment_id = new cField('scholarship_payment', 'scholarship_payment', 'x_scholarship_payment_id', 'scholarship_payment_id', '`scholarship_payment_id`', 3, -1, FALSE, '`scholarship_payment_id`', FALSE);
		$this->scholarship_payment_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['scholarship_payment_id'] =& $this->scholarship_payment_id;

		// date
		$this->date = new cField('scholarship_payment', 'scholarship_payment', 'x_date', 'date', '`date`', 135, 7, FALSE, '`date`', FALSE);
		$this->date->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['date'] =& $this->date;

		// status
		$this->status = new cField('scholarship_payment', 'scholarship_payment', 'x_status', 'status', '`status`', 202, -1, FALSE, '`status`', FALSE);
		$this->status->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['status'] =& $this->status;

		// amount
		$this->amount = new cField('scholarship_payment', 'scholarship_payment', 'x_amount', 'amount', '`amount`', 131, -1, FALSE, '`amount`', FALSE);
		$this->amount->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['amount'] =& $this->amount;

		// memo
		$this->memo = new cField('scholarship_payment', 'scholarship_payment', 'x_memo', 'memo', '`memo`', 201, -1, FALSE, '`memo`', FALSE);
		$this->fields['memo'] =& $this->memo;

		// year
		$this->year = new cField('scholarship_payment', 'scholarship_payment', 'x_year', 'year', '`year`', 3, -1, FALSE, '`year`', FALSE);
		$this->year->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['year'] =& $this->year;

		// scholarship_package_scholarship_package_id
		$this->scholarship_package_scholarship_package_id = new cField('scholarship_payment', 'scholarship_payment', 'x_scholarship_package_scholarship_package_id', 'scholarship_package_scholarship_package_id', '`scholarship_package_scholarship_package_id`', 3, -1, FALSE, '`scholarship_package_scholarship_package_id`', FALSE);
		$this->scholarship_package_scholarship_package_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['scholarship_package_scholarship_package_id'] =& $this->scholarship_package_scholarship_package_id;

		// programarea_residentarea_id
		$this->programarea_residentarea_id = new cField('scholarship_payment', 'scholarship_payment', 'x_programarea_residentarea_id', 'programarea_residentarea_id', '`programarea_residentarea_id`', 3, -1, FALSE, '`programarea_residentarea_id`', FALSE);
		$this->programarea_residentarea_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['programarea_residentarea_id'] =& $this->programarea_residentarea_id;

		// programarea_payingarea_id
		$this->programarea_payingarea_id = new cField('scholarship_payment', 'scholarship_payment', 'x_programarea_payingarea_id', 'programarea_payingarea_id', '`programarea_payingarea_id`', 3, -1, FALSE, '`programarea_payingarea_id`', FALSE);
		$this->programarea_payingarea_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['programarea_payingarea_id'] =& $this->programarea_payingarea_id;

		// refund_amount
		$this->refund_amount = new cField('scholarship_payment', 'scholarship_payment', 'x_refund_amount', 'refund_amount', '`refund_amount`', 131, -1, FALSE, '`refund_amount`', FALSE);
		$this->refund_amount->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['refund_amount'] =& $this->refund_amount;

		// payment_request_payment_request_id
		$this->payment_request_payment_request_id = new cField('scholarship_payment', 'scholarship_payment', 'x_payment_request_payment_request_id', 'payment_request_payment_request_id', '`payment_request_payment_request_id`', 3, -1, FALSE, '`payment_request_payment_request_id`', FALSE);
		$this->payment_request_payment_request_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['payment_request_payment_request_id'] =& $this->payment_request_payment_request_id;

		// bankname
		$this->bankname = new cField('scholarship_payment', 'scholarship_payment', 'x_bankname', 'bankname', '`bankname`', 200, -1, FALSE, '`bankname`', FALSE);
		$this->fields['bankname'] =& $this->bankname;

		// account_no
		$this->account_no = new cField('scholarship_payment', 'scholarship_payment', 'x_account_no', 'account_no', '`account_no`', 200, -1, FALSE, '`account_no`', FALSE);
		$this->fields['account_no'] =& $this->account_no;

		// schools_school_id
		$this->schools_school_id = new cField('scholarship_payment', 'scholarship_payment', 'x_schools_school_id', 'schools_school_id', '`schools_school_id`', 3, -1, FALSE, '`schools_school_id`', FALSE);
		$this->schools_school_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['schools_school_id'] =& $this->schools_school_id;

		// group_id
		$this->group_id = new cField('scholarship_payment', 'scholarship_payment', 'x_group_id', 'group_id', '`group_id`', 3, -1, FALSE, '`group_id`', FALSE);
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
		return "scholarship_payment_Highlight";
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

	// Current master table name
	function getCurrentMasterTable() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_TABLE];
	}

	function setCurrentMasterTable($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_TABLE] = $v;
	}

	// Session master WHERE clause
	function getMasterFilter() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_FILTER];
	}

	function setMasterFilter($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_FILTER] = $v;
	}

	// Session detail WHERE clause
	function getDetailFilter() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_DETAIL_FILTER];
	}

	function setDetailFilter($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_DETAIL_FILTER] = $v;
	}

	// Master filter
	function SqlMasterFilter_scholarship_package() {
		return "`scholarship_package_id`=@scholarship_package_id@";
	}

	// Detail filter
	function SqlDetailFilter_scholarship_package() {
		return "`scholarship_package_scholarship_package_id`=@scholarship_package_scholarship_package_id@";
	}

	// Table level SQL
	function SqlFrom() { // From
		return "`scholarship_payment`";
	}

	function SqlSelect() { // Select
		return "SELECT * FROM " . $this->SqlFrom();
	}

	function SqlWhere() { // Where
		$sWhere = "";
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
			if ($this->getCurrentMasterTable() == "scholarship_package")
				$sFilter = $this->AddDetailUserIDFilter($sFilter, "scholarship_package"); // Add detail User ID filter
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
		return "INSERT INTO `scholarship_payment` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `scholarship_payment` SET ";
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
		$SQL = "DELETE FROM `scholarship_payment` WHERE ";
		$SQL .= ew_QuotedName('scholarship_payment_id') . '=' . ew_QuotedValue($rs['scholarship_payment_id'], $this->scholarship_payment_id->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`scholarship_payment_id` = @scholarship_payment_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->scholarship_payment_id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@scholarship_payment_id@", ew_AdjustSql($this->scholarship_payment_id->CurrentValue), $sKeyFilter); // Replace key value
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
			return "scholarship_paymentlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "scholarship_paymentlist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("scholarship_paymentview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "scholarship_paymentadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit URL
	function EditUrl() {
		return $this->KeyUrl("scholarship_paymentedit.php", $this->UrlParm());
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl() {
		return $this->KeyUrl("scholarship_paymentadd.php", $this->UrlParm());
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("scholarship_paymentdelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->scholarship_payment_id->CurrentValue)) {
			$sUrl .= "scholarship_payment_id=" . urlencode($this->scholarship_payment_id->CurrentValue);
		} else {
			return "javascript:alert(ewLanguage.Phrase(\"InvalidRecord\"));";
		}
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=scholarship_payment" : "";
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
		$this->scholarship_payment_id->setDbValue($rs->fields('scholarship_payment_id'));
		$this->date->setDbValue($rs->fields('date'));
		$this->status->setDbValue($rs->fields('status'));
		$this->amount->setDbValue($rs->fields('amount'));
		$this->memo->setDbValue($rs->fields('memo'));
		$this->year->setDbValue($rs->fields('year'));
		$this->scholarship_package_scholarship_package_id->setDbValue($rs->fields('scholarship_package_scholarship_package_id'));
		$this->programarea_residentarea_id->setDbValue($rs->fields('programarea_residentarea_id'));
		$this->programarea_payingarea_id->setDbValue($rs->fields('programarea_payingarea_id'));
		$this->refund_amount->setDbValue($rs->fields('refund_amount'));
		$this->payment_request_payment_request_id->setDbValue($rs->fields('payment_request_payment_request_id'));
		$this->bankname->setDbValue($rs->fields('bankname'));
		$this->account_no->setDbValue($rs->fields('account_no'));
		$this->schools_school_id->setDbValue($rs->fields('schools_school_id'));
		$this->group_id->setDbValue($rs->fields('group_id'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// status

		$this->status->CellCssStyle = ""; $this->status->CellCssClass = "";
		$this->status->CellAttrs = array(); $this->status->ViewAttrs = array(); $this->status->EditAttrs = array();

		// year
		$this->year->CellCssStyle = ""; $this->year->CellCssClass = "";
		$this->year->CellAttrs = array(); $this->year->ViewAttrs = array(); $this->year->EditAttrs = array();

		// scholarship_package_scholarship_package_id
		$this->scholarship_package_scholarship_package_id->CellCssStyle = ""; $this->scholarship_package_scholarship_package_id->CellCssClass = "";
		$this->scholarship_package_scholarship_package_id->CellAttrs = array(); $this->scholarship_package_scholarship_package_id->ViewAttrs = array(); $this->scholarship_package_scholarship_package_id->EditAttrs = array();

		// programarea_residentarea_id
		$this->programarea_residentarea_id->CellCssStyle = ""; $this->programarea_residentarea_id->CellCssClass = "";
		$this->programarea_residentarea_id->CellAttrs = array(); $this->programarea_residentarea_id->ViewAttrs = array(); $this->programarea_residentarea_id->EditAttrs = array();

		// programarea_payingarea_id
		$this->programarea_payingarea_id->CellCssStyle = ""; $this->programarea_payingarea_id->CellCssClass = "";
		$this->programarea_payingarea_id->CellAttrs = array(); $this->programarea_payingarea_id->ViewAttrs = array(); $this->programarea_payingarea_id->EditAttrs = array();

		// refund_amount
		$this->refund_amount->CellCssStyle = ""; $this->refund_amount->CellCssClass = "";
		$this->refund_amount->CellAttrs = array(); $this->refund_amount->ViewAttrs = array(); $this->refund_amount->EditAttrs = array();

		// payment_request_payment_request_id
		$this->payment_request_payment_request_id->CellCssStyle = ""; $this->payment_request_payment_request_id->CellCssClass = "";
		$this->payment_request_payment_request_id->CellAttrs = array(); $this->payment_request_payment_request_id->ViewAttrs = array(); $this->payment_request_payment_request_id->EditAttrs = array();

		// bankname
		$this->bankname->CellCssStyle = ""; $this->bankname->CellCssClass = "";
		$this->bankname->CellAttrs = array(); $this->bankname->ViewAttrs = array(); $this->bankname->EditAttrs = array();

		// account_no
		$this->account_no->CellCssStyle = ""; $this->account_no->CellCssClass = "";
		$this->account_no->CellAttrs = array(); $this->account_no->ViewAttrs = array(); $this->account_no->EditAttrs = array();

		// schools_school_id
		$this->schools_school_id->CellCssStyle = ""; $this->schools_school_id->CellCssClass = "";
		$this->schools_school_id->CellAttrs = array(); $this->schools_school_id->ViewAttrs = array(); $this->schools_school_id->EditAttrs = array();

		// group_id
		$this->group_id->CellCssStyle = ""; $this->group_id->CellCssClass = "";
		$this->group_id->CellAttrs = array(); $this->group_id->ViewAttrs = array(); $this->group_id->EditAttrs = array();

		// status
		if (strval($this->status->CurrentValue) <> "") {
			switch ($this->status->CurrentValue) {
				case "PENDING":
					$this->status->ViewValue = "PENDING";
					break;
				case "PAID":
					$this->status->ViewValue = "PAID";
					break;
				default:
					$this->status->ViewValue = $this->status->CurrentValue;
			}
		} else {
			$this->status->ViewValue = NULL;
		}
		$this->status->CssStyle = "";
		$this->status->CssClass = "";
		$this->status->ViewCustomAttributes = "";

		// year
		$this->year->ViewValue = $this->year->CurrentValue;
		$this->year->CssStyle = "";
		$this->year->CssClass = "";
		$this->year->ViewCustomAttributes = "";

		// scholarship_package_scholarship_package_id
		if (strval($this->scholarship_package_scholarship_package_id->CurrentValue) <> "") {
			$sFilterWrk = "`scholarship_package_id` = " . ew_AdjustSql($this->scholarship_package_scholarship_package_id->CurrentValue) . "";
		$sSqlWrk = "SELECT `annual_amount` FROM `scholarship_package`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->scholarship_package_scholarship_package_id->ViewValue = $rswrk->fields('annual_amount');
				$rswrk->Close();
			} else {
				$this->scholarship_package_scholarship_package_id->ViewValue = $this->scholarship_package_scholarship_package_id->CurrentValue;
			}
		} else {
			$this->scholarship_package_scholarship_package_id->ViewValue = NULL;
		}
		$this->scholarship_package_scholarship_package_id->CssStyle = "";
		$this->scholarship_package_scholarship_package_id->CssClass = "";
		$this->scholarship_package_scholarship_package_id->ViewCustomAttributes = "";

		// programarea_residentarea_id
		if (strval($this->programarea_residentarea_id->CurrentValue) <> "") {
			$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($this->programarea_residentarea_id->CurrentValue) . "";
		$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->programarea_residentarea_id->ViewValue = $rswrk->fields('programarea_name');
				$rswrk->Close();
			} else {
				$this->programarea_residentarea_id->ViewValue = $this->programarea_residentarea_id->CurrentValue;
			}
		} else {
			$this->programarea_residentarea_id->ViewValue = NULL;
		}
		$this->programarea_residentarea_id->CssStyle = "";
		$this->programarea_residentarea_id->CssClass = "";
		$this->programarea_residentarea_id->ViewCustomAttributes = "";

		// programarea_payingarea_id
		if (strval($this->programarea_payingarea_id->CurrentValue) <> "") {
			$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($this->programarea_payingarea_id->CurrentValue) . "";
		$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->programarea_payingarea_id->ViewValue = $rswrk->fields('programarea_name');
				$rswrk->Close();
			} else {
				$this->programarea_payingarea_id->ViewValue = $this->programarea_payingarea_id->CurrentValue;
			}
		} else {
			$this->programarea_payingarea_id->ViewValue = NULL;
		}
		$this->programarea_payingarea_id->CssStyle = "";
		$this->programarea_payingarea_id->CssClass = "";
		$this->programarea_payingarea_id->ViewCustomAttributes = "";

		// refund_amount
		$this->refund_amount->ViewValue = $this->refund_amount->CurrentValue;
		$this->refund_amount->CssStyle = "";
		$this->refund_amount->CssClass = "";
		$this->refund_amount->ViewCustomAttributes = "";

		// payment_request_payment_request_id
		if (strval($this->payment_request_payment_request_id->CurrentValue) <> "") {
			$sFilterWrk = "`payment_request_id` = " . ew_AdjustSql($this->payment_request_payment_request_id->CurrentValue) . "";
		$sSqlWrk = "SELECT `code` FROM `payment_request`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->payment_request_payment_request_id->ViewValue = $rswrk->fields('code');
				$rswrk->Close();
			} else {
				$this->payment_request_payment_request_id->ViewValue = $this->payment_request_payment_request_id->CurrentValue;
			}
		} else {
			$this->payment_request_payment_request_id->ViewValue = NULL;
		}
		$this->payment_request_payment_request_id->CssStyle = "";
		$this->payment_request_payment_request_id->CssClass = "";
		$this->payment_request_payment_request_id->ViewCustomAttributes = "";

		// bankname
		$this->bankname->ViewValue = $this->bankname->CurrentValue;
		$this->bankname->CssStyle = "";
		$this->bankname->CssClass = "";
		$this->bankname->ViewCustomAttributes = "";

		// account_no
		$this->account_no->ViewValue = $this->account_no->CurrentValue;
		$this->account_no->CssStyle = "";
		$this->account_no->CssClass = "";
		$this->account_no->ViewCustomAttributes = "";

		// schools_school_id
		$this->schools_school_id->ViewValue = $this->schools_school_id->CurrentValue;
		if (strval($this->schools_school_id->CurrentValue) <> "") {
			$sFilterWrk = "`school_id` = " . ew_AdjustSql($this->schools_school_id->CurrentValue) . "";
		$sSqlWrk = "SELECT `school_name` FROM `schools`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->schools_school_id->ViewValue = $rswrk->fields('school_name');
				$rswrk->Close();
			} else {
				$this->schools_school_id->ViewValue = $this->schools_school_id->CurrentValue;
			}
		} else {
			$this->schools_school_id->ViewValue = NULL;
		}
		$this->schools_school_id->CssStyle = "";
		$this->schools_school_id->CssClass = "";
		$this->schools_school_id->ViewCustomAttributes = "";

		// group_id
		$this->group_id->ViewValue = $this->group_id->CurrentValue;
		$this->group_id->CssStyle = "";
		$this->group_id->CssClass = "";
		$this->group_id->ViewCustomAttributes = "";

		// status
		$this->status->HrefValue = "";
		$this->status->TooltipValue = "";

		// year
		$this->year->HrefValue = "";
		$this->year->TooltipValue = "";

		// scholarship_package_scholarship_package_id
		$this->scholarship_package_scholarship_package_id->HrefValue = "";
		$this->scholarship_package_scholarship_package_id->TooltipValue = "";

		// programarea_residentarea_id
		$this->programarea_residentarea_id->HrefValue = "";
		$this->programarea_residentarea_id->TooltipValue = "";

		// programarea_payingarea_id
		$this->programarea_payingarea_id->HrefValue = "";
		$this->programarea_payingarea_id->TooltipValue = "";

		// refund_amount
		$this->refund_amount->HrefValue = "";
		$this->refund_amount->TooltipValue = "";

		// payment_request_payment_request_id
		$this->payment_request_payment_request_id->HrefValue = "";
		$this->payment_request_payment_request_id->TooltipValue = "";

		// bankname
		$this->bankname->HrefValue = "";
		$this->bankname->TooltipValue = "";

		// account_no
		$this->account_no->HrefValue = "";
		$this->account_no->TooltipValue = "";

		// schools_school_id
		$this->schools_school_id->HrefValue = "";
		$this->schools_school_id->TooltipValue = "";

		// group_id
		$this->group_id->HrefValue = "";
		$this->group_id->TooltipValue = "";

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
			$sFilterWrk = '`group_id` IN (' . $sFilterWrk . ')';
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
		$sSql = "SELECT " . $masterfld->FldExpression . " FROM `scholarship_payment` WHERE " . $this->AddUserIDFilter("");

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

	// Add master User ID filter
	function AddMasterUserIDFilter($sFilter, $sCurrentMasterTable) {
		$sFilterWrk = $sFilter;
		if ($sCurrentMasterTable == "scholarship_package") {
			$sFilterWrk = $GLOBALS["scholarship_package"]->AddUserIDFilter($sFilterWrk);
		}
		return $sFilterWrk;
	}

	// Add detail User ID filter
	function AddDetailUserIDFilter($sFilter, $sCurrentMasterTable) {
		$sFilterWrk = $sFilter;
		if ($sCurrentMasterTable == "scholarship_package") {
			$sSubqueryWrk = $GLOBALS["scholarship_package"]->GetUserIDSubquery($this->scholarship_package_scholarship_package_id, $GLOBALS["scholarship_package"]->scholarship_package_id);
			if ($sSubqueryWrk <> "") {
				if ($sFilterWrk <> "") {
					$sFilterWrk = "($sFilterWrk) AND ($sSubqueryWrk)";
				} else {
					$sFilterWrk = $sSubqueryWrk;
				}
			}
		}
		return $sFilterWrk;
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
