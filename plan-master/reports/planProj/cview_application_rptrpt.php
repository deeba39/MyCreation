<?php
session_start();
ob_start();
?>
<?php include "phprptinc/ewrcfg4.php"; ?>
<?php include "phprptinc/ewmysql.php"; ?>
<?php include "phprptinc/ewrfn4.php"; ?>
<?php include "phprptinc/ewrusrfn.php"; ?>
<?php

// Global variable for table object
$cview_application_rpt = NULL;

//
// Table class for cview_application_rpt
//
class crcview_application_rpt {
	var $TableVar = 'cview_application_rpt';
	var $TableName = 'cview_application_rpt';
	var $TableType = 'CUSTOMVIEW';
	var $ShowCurrentFilter = EWRPT_SHOW_CURRENT_FILTER;
	var $FilterPanelOption = EWRPT_FILTER_PANEL_OPTION;
	var $CurrentOrder; // Current order
	var $CurrentOrderType; // Current order type

	// Table caption
	function TableCaption() {
		global $ReportLanguage;
		return $ReportLanguage->TablePhrase($this->TableVar, "TblCaption");
	}

	// Session Group Per Page
	function getGroupPerPage() {
		return @$_SESSION[EWRPT_PROJECT_VAR . "_" . $this->TableVar . "_grpperpage"];
	}

	function setGroupPerPage($v) {
		@$_SESSION[EWRPT_PROJECT_VAR . "_" . $this->TableVar . "_grpperpage"] = $v;
	}

	// Session Start Group
	function getStartGroup() {
		return @$_SESSION[EWRPT_PROJECT_VAR . "_" . $this->TableVar . "_start"];
	}

	function setStartGroup($v) {
		@$_SESSION[EWRPT_PROJECT_VAR . "_" . $this->TableVar . "_start"] = $v;
	}

	// Session Order By
	function getOrderBy() {
		return @$_SESSION[EWRPT_PROJECT_VAR . "_" . $this->TableVar . "_orderby"];
	}

	function setOrderBy($v) {
		@$_SESSION[EWRPT_PROJECT_VAR . "_" . $this->TableVar . "_orderby"] = $v;
	}

//	var $SelectLimit = TRUE;
	var $student_applicant_id;
	var $app_submission_year;
	var $programarea_name;
	var $student_lastname;
	var $student_firstname;
	var $student_middlename;
	var $student_gender;
	var $student_dob;
	var $age;
	var $student_telephone_1;
	var $student_telephone_2;
	var $student_address;
	var $community;
	var $app_mother_name;
	var $app_father_name;
	var $app_father_occupation;
	var $app_father_isalive;
	var $app_mother_isalive;
	var $app_mother_occupation;
	var $app_guardian_name;
	var $app_guardian_relation;
	var $app_guardian_occupation;
	var $student_picture;
	var $student_grades;
	var $applicant_school_name;
	var $app_points;
	var $sponsored_child_no;
	var $school_name;
	var $application_status;
	var $name;
	var $app_amount;
	var $app_referees;
	var $app_grant_id;
	var $student_admitted_school_id;
	var $community_community_id;
	var $app_status;
	var $app_primary_school_id;
	var $app_junior_secondary_id;
	var $student_resident_programarea_id;
	var $fields = array();
	var $Export; // Export
	var $ExportAll = FALSE;
	var $UseTokenInUrl = EWRPT_USE_TOKEN_IN_URL;
	var $RowType; // Row type
	var $RowTotalType; // Row total type
	var $RowTotalSubType; // Row total subtype
	var $RowGroupLevel; // Row group level
	var $RowAttrs = array(); // Row attributes

	// Reset CSS styles for table object
	function ResetCSS() {
    	$this->RowAttrs["style"] = "";
		$this->RowAttrs["class"] = "";
		foreach ($this->fields as $fld) {
			$fld->ResetCSS();
		}
	}

	//
	// Table class constructor
	//
	function crcview_application_rpt() {
		global $ReportLanguage;

		// student_applicant_id
		$this->student_applicant_id = new crField('cview_application_rpt', 'cview_application_rpt', 'x_student_applicant_id', 'student_applicant_id', 'student_applicant.student_applicant_id', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->student_applicant_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['student_applicant_id'] =& $this->student_applicant_id;
		$this->student_applicant_id->DateFilter = "";
		$this->student_applicant_id->SqlSelect = "";
		$this->student_applicant_id->SqlOrderBy = "";

		// app_submission_year
		$this->app_submission_year = new crField('cview_application_rpt', 'cview_application_rpt', 'x_app_submission_year', 'app_submission_year', 'student_applicant.app_submission_year', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->app_submission_year->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['app_submission_year'] =& $this->app_submission_year;
		$this->app_submission_year->DateFilter = "";
		$this->app_submission_year->SqlSelect = "SELECT DISTINCT student_applicant.app_submission_year FROM " . $this->SqlFrom();
		$this->app_submission_year->SqlOrderBy = "student_applicant.app_submission_year";

		// programarea_name
		$this->programarea_name = new crField('cview_application_rpt', 'cview_application_rpt', 'x_programarea_name', 'programarea_name', 'programarea.programarea_name', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['programarea_name'] =& $this->programarea_name;
		$this->programarea_name->DateFilter = "";
		$this->programarea_name->SqlSelect = "SELECT DISTINCT programarea.programarea_name FROM " . $this->SqlFrom();
		$this->programarea_name->SqlOrderBy = "programarea.programarea_name";

		// student_lastname
		$this->student_lastname = new crField('cview_application_rpt', 'cview_application_rpt', 'x_student_lastname', 'student_lastname', 'student_applicant.student_lastname', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['student_lastname'] =& $this->student_lastname;
		$this->student_lastname->DateFilter = "";
		$this->student_lastname->SqlSelect = "";
		$this->student_lastname->SqlOrderBy = "";

		// student_firstname
		$this->student_firstname = new crField('cview_application_rpt', 'cview_application_rpt', 'x_student_firstname', 'student_firstname', 'student_applicant.student_firstname', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['student_firstname'] =& $this->student_firstname;
		$this->student_firstname->DateFilter = "";
		$this->student_firstname->SqlSelect = "";
		$this->student_firstname->SqlOrderBy = "";

		// student_middlename
		$this->student_middlename = new crField('cview_application_rpt', 'cview_application_rpt', 'x_student_middlename', 'student_middlename', 'student_applicant.student_middlename', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['student_middlename'] =& $this->student_middlename;
		$this->student_middlename->DateFilter = "";
		$this->student_middlename->SqlSelect = "";
		$this->student_middlename->SqlOrderBy = "";

		// student_gender
		$this->student_gender = new crField('cview_application_rpt', 'cview_application_rpt', 'x_student_gender', 'student_gender', 'student_applicant.student_gender', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['student_gender'] =& $this->student_gender;
		$this->student_gender->DateFilter = "";
		$this->student_gender->SqlSelect = "SELECT DISTINCT student_applicant.student_gender FROM " . $this->SqlFrom();
		$this->student_gender->SqlOrderBy = "student_applicant.student_gender";

		// student_dob
		$this->student_dob = new crField('cview_application_rpt', 'cview_application_rpt', 'x_student_dob', 'student_dob', 'student_applicant.student_dob', 135, EWRPT_DATATYPE_DATE, 5);
		$this->student_dob->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateYMD"));
		$this->fields['student_dob'] =& $this->student_dob;
		$this->student_dob->DateFilter = "";
		$this->student_dob->SqlSelect = "";
		$this->student_dob->SqlOrderBy = "";

		// age
		$this->age = new crField('cview_application_rpt', 'cview_application_rpt', 'x_age', 'age', '(Year(CurDate()) - Year(student_applicant.student_dob))', 20, EWRPT_DATATYPE_NUMBER, -1);
		$this->age->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['age'] =& $this->age;
		$this->age->DateFilter = "";
		$this->age->SqlSelect = "SELECT DISTINCT (Year(CurDate()) - Year(student_applicant.student_dob)) FROM " . $this->SqlFrom();
		$this->age->SqlOrderBy = "(Year(CurDate()) - Year(student_applicant.student_dob))";

		// student_telephone_1
		$this->student_telephone_1 = new crField('cview_application_rpt', 'cview_application_rpt', 'x_student_telephone_1', 'student_telephone_1', 'student_applicant.student_telephone_1', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['student_telephone_1'] =& $this->student_telephone_1;
		$this->student_telephone_1->DateFilter = "";
		$this->student_telephone_1->SqlSelect = "";
		$this->student_telephone_1->SqlOrderBy = "";

		// student_telephone_2
		$this->student_telephone_2 = new crField('cview_application_rpt', 'cview_application_rpt', 'x_student_telephone_2', 'student_telephone_2', 'student_applicant.student_telephone_2', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['student_telephone_2'] =& $this->student_telephone_2;
		$this->student_telephone_2->DateFilter = "";
		$this->student_telephone_2->SqlSelect = "";
		$this->student_telephone_2->SqlOrderBy = "";

		// student_address
		$this->student_address = new crField('cview_application_rpt', 'cview_application_rpt', 'x_student_address', 'student_address', 'student_applicant.student_address', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['student_address'] =& $this->student_address;
		$this->student_address->DateFilter = "";
		$this->student_address->SqlSelect = "";
		$this->student_address->SqlOrderBy = "";

		// community
		$this->community = new crField('cview_application_rpt', 'cview_application_rpt', 'x_community', 'community', 'community.community', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['community'] =& $this->community;
		$this->community->DateFilter = "";
		$this->community->SqlSelect = "";
		$this->community->SqlOrderBy = "";

		// app_mother_name
		$this->app_mother_name = new crField('cview_application_rpt', 'cview_application_rpt', 'x_app_mother_name', 'app_mother_name', 'student_applicant.app_mother_name', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['app_mother_name'] =& $this->app_mother_name;
		$this->app_mother_name->DateFilter = "";
		$this->app_mother_name->SqlSelect = "";
		$this->app_mother_name->SqlOrderBy = "";

		// app_father_name
		$this->app_father_name = new crField('cview_application_rpt', 'cview_application_rpt', 'x_app_father_name', 'app_father_name', 'student_applicant.app_father_name', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['app_father_name'] =& $this->app_father_name;
		$this->app_father_name->DateFilter = "";
		$this->app_father_name->SqlSelect = "";
		$this->app_father_name->SqlOrderBy = "";

		// app_father_occupation
		$this->app_father_occupation = new crField('cview_application_rpt', 'cview_application_rpt', 'x_app_father_occupation', 'app_father_occupation', 'student_applicant.app_father_occupation', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->app_father_occupation->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['app_father_occupation'] =& $this->app_father_occupation;
		$this->app_father_occupation->DateFilter = "";
		$this->app_father_occupation->SqlSelect = "";
		$this->app_father_occupation->SqlOrderBy = "";

		// app_father_isalive
		$this->app_father_isalive = new crField('cview_application_rpt', 'cview_application_rpt', 'x_app_father_isalive', 'app_father_isalive', 'student_applicant.app_father_isalive', 16, EWRPT_DATATYPE_NUMBER, -1);
		$this->app_father_isalive->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['app_father_isalive'] =& $this->app_father_isalive;
		$this->app_father_isalive->DateFilter = "";
		$this->app_father_isalive->SqlSelect = "";
		$this->app_father_isalive->SqlOrderBy = "";

		// app_mother_isalive
		$this->app_mother_isalive = new crField('cview_application_rpt', 'cview_application_rpt', 'x_app_mother_isalive', 'app_mother_isalive', 'student_applicant.app_mother_isalive', 16, EWRPT_DATATYPE_NUMBER, -1);
		$this->app_mother_isalive->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['app_mother_isalive'] =& $this->app_mother_isalive;
		$this->app_mother_isalive->DateFilter = "";
		$this->app_mother_isalive->SqlSelect = "";
		$this->app_mother_isalive->SqlOrderBy = "";

		// app_mother_occupation
		$this->app_mother_occupation = new crField('cview_application_rpt', 'cview_application_rpt', 'x_app_mother_occupation', 'app_mother_occupation', 'student_applicant.app_mother_occupation', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->app_mother_occupation->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['app_mother_occupation'] =& $this->app_mother_occupation;
		$this->app_mother_occupation->DateFilter = "";
		$this->app_mother_occupation->SqlSelect = "";
		$this->app_mother_occupation->SqlOrderBy = "";

		// app_guardian_name
		$this->app_guardian_name = new crField('cview_application_rpt', 'cview_application_rpt', 'x_app_guardian_name', 'app_guardian_name', 'student_applicant.app_guardian_name', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['app_guardian_name'] =& $this->app_guardian_name;
		$this->app_guardian_name->DateFilter = "";
		$this->app_guardian_name->SqlSelect = "";
		$this->app_guardian_name->SqlOrderBy = "";

		// app_guardian_relation
		$this->app_guardian_relation = new crField('cview_application_rpt', 'cview_application_rpt', 'x_app_guardian_relation', 'app_guardian_relation', 'student_applicant.app_guardian_relation', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['app_guardian_relation'] =& $this->app_guardian_relation;
		$this->app_guardian_relation->DateFilter = "";
		$this->app_guardian_relation->SqlSelect = "";
		$this->app_guardian_relation->SqlOrderBy = "";

		// app_guardian_occupation
		$this->app_guardian_occupation = new crField('cview_application_rpt', 'cview_application_rpt', 'x_app_guardian_occupation', 'app_guardian_occupation', 'student_applicant.app_guardian_occupation', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->app_guardian_occupation->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['app_guardian_occupation'] =& $this->app_guardian_occupation;
		$this->app_guardian_occupation->DateFilter = "";
		$this->app_guardian_occupation->SqlSelect = "";
		$this->app_guardian_occupation->SqlOrderBy = "";

		// student_picture
		$this->student_picture = new crField('cview_application_rpt', 'cview_application_rpt', 'x_student_picture', 'student_picture', 'student_applicant.student_picture', 201, EWRPT_DATATYPE_MEMO, -1);
		$this->fields['student_picture'] =& $this->student_picture;
		$this->student_picture->DateFilter = "";
		$this->student_picture->SqlSelect = "";
		$this->student_picture->SqlOrderBy = "";

		// student_grades
		$this->student_grades = new crField('cview_application_rpt', 'cview_application_rpt', 'x_student_grades', 'student_grades', 'student_applicant.student_grades', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['student_grades'] =& $this->student_grades;
		$this->student_grades->DateFilter = "";
		$this->student_grades->SqlSelect = "";
		$this->student_grades->SqlOrderBy = "";

		// applicant_school_name
		$this->applicant_school_name = new crField('cview_application_rpt', 'cview_application_rpt', 'x_applicant_school_name', 'applicant_school_name', 'applicant_school.applicant_school_name', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['applicant_school_name'] =& $this->applicant_school_name;
		$this->applicant_school_name->DateFilter = "";
		$this->applicant_school_name->SqlSelect = "";
		$this->applicant_school_name->SqlOrderBy = "";

		// app_points
		$this->app_points = new crField('cview_application_rpt', 'cview_application_rpt', 'x_app_points', 'app_points', 'student_applicant.app_points', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->app_points->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['app_points'] =& $this->app_points;
		$this->app_points->DateFilter = "";
		$this->app_points->SqlSelect = "";
		$this->app_points->SqlOrderBy = "";

		// sponsored_child_no
		$this->sponsored_child_no = new crField('cview_application_rpt', 'cview_application_rpt', 'x_sponsored_child_no', 'sponsored_child_no', 'student_applicant.sponsored_child_no', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['sponsored_child_no'] =& $this->sponsored_child_no;
		$this->sponsored_child_no->DateFilter = "";
		$this->sponsored_child_no->SqlSelect = "";
		$this->sponsored_child_no->SqlOrderBy = "";

		// school_name
		$this->school_name = new crField('cview_application_rpt', 'cview_application_rpt', 'x_school_name', 'school_name', 'schools.school_name', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['school_name'] =& $this->school_name;
		$this->school_name->DateFilter = "";
		$this->school_name->SqlSelect = "";
		$this->school_name->SqlOrderBy = "";

		// application_status
		$this->application_status = new crField('cview_application_rpt', 'cview_application_rpt', 'x_application_status', 'application_status', 'application_status.application_status', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['application_status'] =& $this->application_status;
		$this->application_status->DateFilter = "";
		$this->application_status->SqlSelect = "SELECT DISTINCT application_status.application_status FROM " . $this->SqlFrom();
		$this->application_status->SqlOrderBy = "application_status.application_status";

		// name
		$this->name = new crField('cview_application_rpt', 'cview_application_rpt', 'x_name', 'name', 'grant_package.name', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['name'] =& $this->name;
		$this->name->DateFilter = "";
		$this->name->SqlSelect = "";
		$this->name->SqlOrderBy = "";

		// app_amount
		$this->app_amount = new crField('cview_application_rpt', 'cview_application_rpt', 'x_app_amount', 'app_amount', 'student_applicant.app_amount', 131, EWRPT_DATATYPE_NUMBER, -1);
		$this->app_amount->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['app_amount'] =& $this->app_amount;
		$this->app_amount->DateFilter = "";
		$this->app_amount->SqlSelect = "";
		$this->app_amount->SqlOrderBy = "";

		// app_referees
		$this->app_referees = new crField('cview_application_rpt', 'cview_application_rpt', 'x_app_referees', 'app_referees', 'student_applicant.app_referees', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['app_referees'] =& $this->app_referees;
		$this->app_referees->DateFilter = "";
		$this->app_referees->SqlSelect = "";
		$this->app_referees->SqlOrderBy = "";

		// app_grant_id
		$this->app_grant_id = new crField('cview_application_rpt', 'cview_application_rpt', 'x_app_grant_id', 'app_grant_id', 'student_applicant.app_grant_id', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->app_grant_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['app_grant_id'] =& $this->app_grant_id;
		$this->app_grant_id->DateFilter = "";
		$this->app_grant_id->SqlSelect = "";
		$this->app_grant_id->SqlOrderBy = "";

		// student_admitted_school_id
		$this->student_admitted_school_id = new crField('cview_application_rpt', 'cview_application_rpt', 'x_student_admitted_school_id', 'student_admitted_school_id', 'student_applicant.student_admitted_school_id', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->student_admitted_school_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['student_admitted_school_id'] =& $this->student_admitted_school_id;
		$this->student_admitted_school_id->DateFilter = "";
		$this->student_admitted_school_id->SqlSelect = "";
		$this->student_admitted_school_id->SqlOrderBy = "";

		// community_community_id
		$this->community_community_id = new crField('cview_application_rpt', 'cview_application_rpt', 'x_community_community_id', 'community_community_id', 'student_applicant.community_community_id', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->community_community_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['community_community_id'] =& $this->community_community_id;
		$this->community_community_id->DateFilter = "";
		$this->community_community_id->SqlSelect = "";
		$this->community_community_id->SqlOrderBy = "";

		// app_status
		$this->app_status = new crField('cview_application_rpt', 'cview_application_rpt', 'x_app_status', 'app_status', 'student_applicant.app_status', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->app_status->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['app_status'] =& $this->app_status;
		$this->app_status->DateFilter = "";
		$this->app_status->SqlSelect = "";
		$this->app_status->SqlOrderBy = "";

		// app_primary_school_id
		$this->app_primary_school_id = new crField('cview_application_rpt', 'cview_application_rpt', 'x_app_primary_school_id', 'app_primary_school_id', 'student_applicant.app_primary_school_id', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->app_primary_school_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['app_primary_school_id'] =& $this->app_primary_school_id;
		$this->app_primary_school_id->DateFilter = "";
		$this->app_primary_school_id->SqlSelect = "";
		$this->app_primary_school_id->SqlOrderBy = "";

		// app_junior_secondary_id
		$this->app_junior_secondary_id = new crField('cview_application_rpt', 'cview_application_rpt', 'x_app_junior_secondary_id', 'app_junior_secondary_id', 'student_applicant.app_junior_secondary_id', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->app_junior_secondary_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['app_junior_secondary_id'] =& $this->app_junior_secondary_id;
		$this->app_junior_secondary_id->DateFilter = "";
		$this->app_junior_secondary_id->SqlSelect = "";
		$this->app_junior_secondary_id->SqlOrderBy = "";

		// student_resident_programarea_id
		$this->student_resident_programarea_id = new crField('cview_application_rpt', 'cview_application_rpt', 'x_student_resident_programarea_id', 'student_resident_programarea_id', 'student_applicant.student_resident_programarea_id', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->student_resident_programarea_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['student_resident_programarea_id'] =& $this->student_resident_programarea_id;
		$this->student_resident_programarea_id->DateFilter = "";
		$this->student_resident_programarea_id->SqlSelect = "";
		$this->student_resident_programarea_id->SqlOrderBy = "";
	}

	// Single column sort
	function UpdateSort(&$ofld) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
		} else {
			if ($ofld->GroupingFieldId == 0) $ofld->setSort("");
		}
	}

	// Get Sort SQL
	function SortSql() {
		$sDtlSortSql = "";
		$argrps = array();
		foreach ($this->fields as $fld) {
			if ($fld->getSort() <> "") {
				if ($fld->GroupingFieldId > 0) {
					if ($fld->FldGroupSql <> "")
						$argrps[$fld->GroupingFieldId] = str_replace("%s", $fld->FldExpression, $fld->FldGroupSql) . " " . $fld->getSort();
					else
						$argrps[$fld->GroupingFieldId] = $fld->FldExpression . " " . $fld->getSort();
				} else {
					if ($sDtlSortSql <> "") $sDtlSortSql .= ", ";
					$sDtlSortSql .= $fld->FldExpression . " " . $fld->getSort();
				}
			}
		}
		$sSortSql = "";
		foreach ($argrps as $grp) {
			if ($sSortSql <> "") $sSortSql .= ", ";
			$sSortSql .= $grp;
		}
		if ($sDtlSortSql <> "") {
			if ($sSortSql <> "") $sSortSql .= ",";
			$sSortSql .= $sDtlSortSql;
		}
		return $sSortSql;
	}

	// Table level SQL
	function SqlFrom() { // From
		return "student_applicant Left Join community On student_applicant.community_community_id = community.community_id Left Join programarea On student_applicant.student_resident_programarea_id = programarea.programarea_id Left Join schools On student_applicant.student_admitted_school_id = schools.school_id Left Join applicant_school On student_applicant.app_primary_school_id = applicant_school.applicant_school_id Left Join application_status On student_applicant.app_status = application_status.application_status_id Inner Join grant_package On student_applicant.app_grant_id = grant_package.grant_package_id";
	}

	function SqlSelect() { // Select
		return "SELECT student_applicant.app_grant_id, student_applicant.student_applicant_id, student_applicant.student_firstname, student_applicant.student_middlename, student_applicant.student_lastname, student_applicant.app_mother_name, student_applicant.app_father_name, student_applicant.app_father_occupation, student_applicant.app_father_isalive, student_applicant.app_mother_isalive, student_applicant.app_mother_occupation, student_applicant.student_picture, student_applicant.student_grades, student_applicant.sponsored_child_no, student_applicant.app_points, student_applicant.app_referees, student_applicant.app_guardian_name, student_applicant.app_guardian_relation, student_applicant.app_guardian_occupation, student_applicant.student_address, student_applicant.student_telephone_1, student_applicant.student_telephone_2, student_applicant.student_resident_programarea_id, student_applicant.student_admitted_school_id, student_applicant.student_gender, student_applicant.student_dob, (Year(CurDate()) - Year(student_applicant.student_dob)) As age, student_applicant.community_community_id, student_applicant.app_submission_year, student_applicant.app_amount, student_applicant.app_status, student_applicant.app_primary_school_id, student_applicant.app_junior_secondary_id, programarea.programarea_name, schools.school_name, application_status.application_status, applicant_school.applicant_school_name, community.community, grant_package.name FROM " . $this->SqlFrom();
	}

	function SqlWhere() { // Where
		return "";
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

	function SqlSelectAgg() {
		return "SELECT  FROM " . $this->SqlFrom();
	}

	function SqlAggPfx() {
		return "";
	}

	function SqlAggSfx() {
		return "";
	}

	function SqlSelectCount() {
		return "SELECT COUNT(*) FROM " . $this->SqlFrom();
	}

	// Sort URL
	function SortUrl(&$fld) {
		return "";
	}

	// Row attributes
	function RowAttributes() {
		$sAtt = "";
		foreach ($this->RowAttrs as $k => $v) {
			if (trim($v) <> "")
				$sAtt .= " " . $k . "=\"" . trim($v) . "\"";
		}
		return $sAtt;
	}

	// Field object by fldvar
	function &fields($fldvar) {
		return $this->fields[$fldvar];
	}

	// Table level events
	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 

	}

	// Load Custom Filters event
	function CustomFilters_Load() {

		// Enter your code here	
		// ewrpt_RegisterCustomFilter($this-><Field>, 'LastMonth', 'Last Month', 'GetLastMonthFilter'); // Date example
		// ewrpt_RegisterCustomFilter($this-><Field>, 'StartsWithA', 'Starts With A', 'GetStartsWithAFilter'); // String example

	}

	// Page Filter Validated event
	function Page_FilterValidated() {

		// Example:
		//global $MyTable;
		//$MyTable->MyField1->SearchValue = "your search criteria"; // Search value

	}

	// Chart Rendering event
	function Chart_Rendering(&$chart) {

		// var_dump($chart);
	}

	// Chart Rendered event
	function Chart_Rendered($chart, &$chartxml) {

		//var_dump($chart);
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}
}
?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php

// Create page object
$cview_application_rpt_rpt = new crcview_application_rpt_rpt();
$Page =& $cview_application_rpt_rpt;

// Page init
$cview_application_rpt_rpt->Page_Init();

// Page main
$cview_application_rpt_rpt->Page_Main();
?>
<?php include "phprptinc/header.php"; ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php $cview_application_rpt_rpt->ShowPageHeader(); ?>
<?php $cview_application_rpt_rpt->ShowMessage(); ?>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script type="text/javascript">

// popup fields
<?php $jsdata = ewrpt_GetJsData($cview_application_rpt->app_submission_year, $cview_application_rpt->app_submission_year->FldType); ?>
ewrpt_CreatePopup("cview_application_rpt_app_submission_year", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($cview_application_rpt->programarea_name, $cview_application_rpt->programarea_name->FldType); ?>
ewrpt_CreatePopup("cview_application_rpt_programarea_name", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($cview_application_rpt->student_gender, $cview_application_rpt->student_gender->FldType); ?>
ewrpt_CreatePopup("cview_application_rpt_student_gender", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($cview_application_rpt->age, $cview_application_rpt->age->FldType); ?>
ewrpt_CreatePopup("cview_application_rpt_age", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($cview_application_rpt->application_status, $cview_application_rpt->application_status->FldType); ?>
ewrpt_CreatePopup("cview_application_rpt_application_status", [<?php echo $jsdata ?>]);
</script>
<div id="cview_application_rpt_app_submission_year_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="cview_application_rpt_programarea_name_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="cview_application_rpt_student_gender_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="cview_application_rpt_age_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="cview_application_rpt_application_status_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0">
<!-- Top Container (Begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php echo $cview_application_rpt->TableCaption() ?>
<?php if ($cview_application_rpt_rpt->FilterApplied) { ?>
&nbsp;&nbsp;<a href="cview_application_rptrpt.php?cmd=reset"><?php echo $ReportLanguage->Phrase("ResetAllFilter") ?></a>
<?php } ?>
<br /><br />
</div></td></tr>
<!-- Top Container (End) -->
<tr>
	<!-- Left Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewLeft" class="phpreportmaker">
	<!-- Left slot -->
	</div></td>
	<!-- Left Container (End) -->
	<!-- Center Container - Report (Begin) -->
	<td style="vertical-align: top;" class="ewPadding"><div id="ewCenter" class="phpreportmaker">
	<!-- center slot -->
<!-- summary report starts -->
<div id="report_summary">
<?php if ($cview_application_rpt->ShowCurrentFilter) { ?>
<div id="ewrptFilterList">
<?php $cview_application_rpt_rpt->ShowFilterList() ?>
</div>
<br />
<?php } ?>
<table class="ewGrid" cellspacing="0"><tr>
	<td class="ewGridContent">
<!-- Report Grid (Begin) -->
<div class="ewGridMiddlePanel">
<table class="ewTable ewTableSeparate" cellspacing="0">
<?php

// Set the last group to display if not export all
if ($cview_application_rpt->ExportAll && $cview_application_rpt->Export <> "") {
	$cview_application_rpt_rpt->StopGrp = $cview_application_rpt_rpt->TotalGrps;
} else {
	$cview_application_rpt_rpt->StopGrp = $cview_application_rpt_rpt->StartGrp + $cview_application_rpt_rpt->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($cview_application_rpt_rpt->StopGrp) > intval($cview_application_rpt_rpt->TotalGrps))
	$cview_application_rpt_rpt->StopGrp = $cview_application_rpt_rpt->TotalGrps;
$cview_application_rpt_rpt->RecCount = 0;

// Get first row
if ($cview_application_rpt_rpt->TotalGrps > 0) {
	$cview_application_rpt_rpt->GetRow(1);
	$cview_application_rpt_rpt->GrpCount = 1;
}
while (($rs && !$rs->EOF && $cview_application_rpt_rpt->GrpCount <= $cview_application_rpt_rpt->DisplayGrps) || $cview_application_rpt_rpt->ShowFirstHeader) {

	// Show header
	if ($cview_application_rpt_rpt->ShowFirstHeader) {
?>
	<thead>
	<tr>
<td class="ewTableHeader">
<?php if ($cview_application_rpt->Export <> "") { ?>
<?php echo $cview_application_rpt->student_applicant_id->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($cview_application_rpt->SortUrl($cview_application_rpt->student_applicant_id) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $cview_application_rpt->student_applicant_id->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $cview_application_rpt->SortUrl($cview_application_rpt->student_applicant_id) ?>',0);"><?php echo $cview_application_rpt->student_applicant_id->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($cview_application_rpt->student_applicant_id->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cview_application_rpt->student_applicant_id->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($cview_application_rpt->Export <> "") { ?>
<?php echo $cview_application_rpt->app_submission_year->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($cview_application_rpt->SortUrl($cview_application_rpt->app_submission_year) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $cview_application_rpt->app_submission_year->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $cview_application_rpt->SortUrl($cview_application_rpt->app_submission_year) ?>',0);"><?php echo $cview_application_rpt->app_submission_year->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($cview_application_rpt->app_submission_year->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cview_application_rpt->app_submission_year->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'cview_application_rpt_app_submission_year', false, '<?php echo $cview_application_rpt->app_submission_year->RangeFrom; ?>', '<?php echo $cview_application_rpt->app_submission_year->RangeTo; ?>');return false;" name="x_app_submission_year<?php echo $cview_application_rpt_rpt->Cnt[0][0]; ?>" id="x_app_submission_year<?php echo $cview_application_rpt_rpt->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($cview_application_rpt->Export <> "") { ?>
<?php echo $cview_application_rpt->programarea_name->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($cview_application_rpt->SortUrl($cview_application_rpt->programarea_name) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $cview_application_rpt->programarea_name->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $cview_application_rpt->SortUrl($cview_application_rpt->programarea_name) ?>',0);"><?php echo $cview_application_rpt->programarea_name->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($cview_application_rpt->programarea_name->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cview_application_rpt->programarea_name->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'cview_application_rpt_programarea_name', false, '<?php echo $cview_application_rpt->programarea_name->RangeFrom; ?>', '<?php echo $cview_application_rpt->programarea_name->RangeTo; ?>');return false;" name="x_programarea_name<?php echo $cview_application_rpt_rpt->Cnt[0][0]; ?>" id="x_programarea_name<?php echo $cview_application_rpt_rpt->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($cview_application_rpt->Export <> "") { ?>
<?php echo $cview_application_rpt->student_lastname->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($cview_application_rpt->SortUrl($cview_application_rpt->student_lastname) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $cview_application_rpt->student_lastname->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $cview_application_rpt->SortUrl($cview_application_rpt->student_lastname) ?>',0);"><?php echo $cview_application_rpt->student_lastname->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($cview_application_rpt->student_lastname->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cview_application_rpt->student_lastname->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($cview_application_rpt->Export <> "") { ?>
<?php echo $cview_application_rpt->student_firstname->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($cview_application_rpt->SortUrl($cview_application_rpt->student_firstname) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $cview_application_rpt->student_firstname->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $cview_application_rpt->SortUrl($cview_application_rpt->student_firstname) ?>',0);"><?php echo $cview_application_rpt->student_firstname->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($cview_application_rpt->student_firstname->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cview_application_rpt->student_firstname->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($cview_application_rpt->Export <> "") { ?>
<?php echo $cview_application_rpt->student_middlename->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($cview_application_rpt->SortUrl($cview_application_rpt->student_middlename) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $cview_application_rpt->student_middlename->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $cview_application_rpt->SortUrl($cview_application_rpt->student_middlename) ?>',0);"><?php echo $cview_application_rpt->student_middlename->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($cview_application_rpt->student_middlename->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cview_application_rpt->student_middlename->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($cview_application_rpt->Export <> "") { ?>
<?php echo $cview_application_rpt->student_gender->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($cview_application_rpt->SortUrl($cview_application_rpt->student_gender) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $cview_application_rpt->student_gender->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $cview_application_rpt->SortUrl($cview_application_rpt->student_gender) ?>',0);"><?php echo $cview_application_rpt->student_gender->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($cview_application_rpt->student_gender->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cview_application_rpt->student_gender->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'cview_application_rpt_student_gender', false, '<?php echo $cview_application_rpt->student_gender->RangeFrom; ?>', '<?php echo $cview_application_rpt->student_gender->RangeTo; ?>');return false;" name="x_student_gender<?php echo $cview_application_rpt_rpt->Cnt[0][0]; ?>" id="x_student_gender<?php echo $cview_application_rpt_rpt->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($cview_application_rpt->Export <> "") { ?>
<?php echo $cview_application_rpt->student_dob->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($cview_application_rpt->SortUrl($cview_application_rpt->student_dob) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $cview_application_rpt->student_dob->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $cview_application_rpt->SortUrl($cview_application_rpt->student_dob) ?>',0);"><?php echo $cview_application_rpt->student_dob->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($cview_application_rpt->student_dob->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cview_application_rpt->student_dob->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($cview_application_rpt->Export <> "") { ?>
<?php echo $cview_application_rpt->age->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($cview_application_rpt->SortUrl($cview_application_rpt->age) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $cview_application_rpt->age->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $cview_application_rpt->SortUrl($cview_application_rpt->age) ?>',0);"><?php echo $cview_application_rpt->age->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($cview_application_rpt->age->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cview_application_rpt->age->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'cview_application_rpt_age', true, '<?php echo $cview_application_rpt->age->RangeFrom; ?>', '<?php echo $cview_application_rpt->age->RangeTo; ?>');return false;" name="x_age<?php echo $cview_application_rpt_rpt->Cnt[0][0]; ?>" id="x_age<?php echo $cview_application_rpt_rpt->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($cview_application_rpt->Export <> "") { ?>
<?php echo $cview_application_rpt->school_name->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($cview_application_rpt->SortUrl($cview_application_rpt->school_name) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $cview_application_rpt->school_name->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $cview_application_rpt->SortUrl($cview_application_rpt->school_name) ?>',0);"><?php echo $cview_application_rpt->school_name->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($cview_application_rpt->school_name->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cview_application_rpt->school_name->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($cview_application_rpt->Export <> "") { ?>
<?php echo $cview_application_rpt->application_status->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($cview_application_rpt->SortUrl($cview_application_rpt->application_status) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $cview_application_rpt->application_status->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $cview_application_rpt->SortUrl($cview_application_rpt->application_status) ?>',0);"><?php echo $cview_application_rpt->application_status->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($cview_application_rpt->application_status->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cview_application_rpt->application_status->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'cview_application_rpt_application_status', false, '<?php echo $cview_application_rpt->application_status->RangeFrom; ?>', '<?php echo $cview_application_rpt->application_status->RangeTo; ?>');return false;" name="x_application_status<?php echo $cview_application_rpt_rpt->Cnt[0][0]; ?>" id="x_application_status<?php echo $cview_application_rpt_rpt->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($cview_application_rpt->Export <> "") { ?>
<?php echo $cview_application_rpt->name->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($cview_application_rpt->SortUrl($cview_application_rpt->name) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $cview_application_rpt->name->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $cview_application_rpt->SortUrl($cview_application_rpt->name) ?>',0);"><?php echo $cview_application_rpt->name->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($cview_application_rpt->name->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cview_application_rpt->name->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($cview_application_rpt->Export <> "") { ?>
<?php echo $cview_application_rpt->app_amount->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($cview_application_rpt->SortUrl($cview_application_rpt->app_amount) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $cview_application_rpt->app_amount->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $cview_application_rpt->SortUrl($cview_application_rpt->app_amount) ?>',0);"><?php echo $cview_application_rpt->app_amount->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($cview_application_rpt->app_amount->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cview_application_rpt->app_amount->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
	</tr>
	</thead>
	<tbody>
<?php
		$cview_application_rpt_rpt->ShowFirstHeader = FALSE;
	}
	$cview_application_rpt_rpt->RecCount++;

		// Render detail row
		$cview_application_rpt->ResetCSS();
		$cview_application_rpt->RowType = EWRPT_ROWTYPE_DETAIL;
		$cview_application_rpt_rpt->RenderRow();
?>
	<tr<?php echo $cview_application_rpt->RowAttributes(); ?>>
		<td<?php echo $cview_application_rpt->student_applicant_id->CellAttributes() ?>>
<div<?php echo $cview_application_rpt->student_applicant_id->ViewAttributes(); ?>><?php echo $cview_application_rpt->student_applicant_id->ListViewValue(); ?></div>
</td>
		<td<?php echo $cview_application_rpt->app_submission_year->CellAttributes() ?>>
<div<?php echo $cview_application_rpt->app_submission_year->ViewAttributes(); ?>><?php echo $cview_application_rpt->app_submission_year->ListViewValue(); ?></div>
</td>
		<td<?php echo $cview_application_rpt->programarea_name->CellAttributes() ?>>
<div<?php echo $cview_application_rpt->programarea_name->ViewAttributes(); ?>><?php echo $cview_application_rpt->programarea_name->ListViewValue(); ?></div>
</td>
		<td<?php echo $cview_application_rpt->student_lastname->CellAttributes() ?>>
<div<?php echo $cview_application_rpt->student_lastname->ViewAttributes(); ?>><?php echo $cview_application_rpt->student_lastname->ListViewValue(); ?></div>
</td>
		<td<?php echo $cview_application_rpt->student_firstname->CellAttributes() ?>>
<div<?php echo $cview_application_rpt->student_firstname->ViewAttributes(); ?>><?php echo $cview_application_rpt->student_firstname->ListViewValue(); ?></div>
</td>
		<td<?php echo $cview_application_rpt->student_middlename->CellAttributes() ?>>
<div<?php echo $cview_application_rpt->student_middlename->ViewAttributes(); ?>><?php echo $cview_application_rpt->student_middlename->ListViewValue(); ?></div>
</td>
		<td<?php echo $cview_application_rpt->student_gender->CellAttributes() ?>>
<div<?php echo $cview_application_rpt->student_gender->ViewAttributes(); ?>><?php echo $cview_application_rpt->student_gender->ListViewValue(); ?></div>
</td>
		<td<?php echo $cview_application_rpt->student_dob->CellAttributes() ?>>
<div<?php echo $cview_application_rpt->student_dob->ViewAttributes(); ?>><?php echo $cview_application_rpt->student_dob->ListViewValue(); ?></div>
</td>
		<td<?php echo $cview_application_rpt->age->CellAttributes() ?>>
<div<?php echo $cview_application_rpt->age->ViewAttributes(); ?>><?php echo $cview_application_rpt->age->ListViewValue(); ?></div>
</td>
		<td<?php echo $cview_application_rpt->school_name->CellAttributes() ?>>
<div<?php echo $cview_application_rpt->school_name->ViewAttributes(); ?>><?php echo $cview_application_rpt->school_name->ListViewValue(); ?></div>
</td>
		<td<?php echo $cview_application_rpt->application_status->CellAttributes() ?>>
<div<?php echo $cview_application_rpt->application_status->ViewAttributes(); ?>><?php echo $cview_application_rpt->application_status->ListViewValue(); ?></div>
</td>
		<td<?php echo $cview_application_rpt->name->CellAttributes() ?>>
<div<?php echo $cview_application_rpt->name->ViewAttributes(); ?>><?php echo $cview_application_rpt->name->ListViewValue(); ?></div>
</td>
		<td<?php echo $cview_application_rpt->app_amount->CellAttributes() ?>>
<div<?php echo $cview_application_rpt->app_amount->ViewAttributes(); ?>><?php echo $cview_application_rpt->app_amount->ListViewValue(); ?></div>
</td>
	</tr>
<?php

		// Accumulate page summary
		$cview_application_rpt_rpt->AccumulateSummary();

		// Get next record
		$cview_application_rpt_rpt->GetRow(2);
	$cview_application_rpt_rpt->GrpCount++;
} // End while
?>
	</tbody>
	<tfoot>
	</tfoot>
</table>
</div>
<div class="ewGridLowerPanel">
<form action="cview_application_rptrpt.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($cview_application_rpt_rpt->StartGrp, $cview_application_rpt_rpt->DisplayGrps, $cview_application_rpt_rpt->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="cview_application_rptrpt.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="cview_application_rptrpt.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="cview_application_rptrpt.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="cview_application_rptrpt.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/lastdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpreportmaker">&nbsp;<?php echo $ReportLanguage->Phrase("of") ?> <?php echo $Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Record") ?> <?php echo $Pager->FromIndex ?> <?php echo $ReportLanguage->Phrase("To") ?> <?php echo $Pager->ToIndex ?> <?php echo $ReportLanguage->Phrase("Of") ?> <?php echo $Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($cview_application_rpt_rpt->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($cview_application_rpt_rpt->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("RecordsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($cview_application_rpt_rpt->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($cview_application_rpt_rpt->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($cview_application_rpt_rpt->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($cview_application_rpt_rpt->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($cview_application_rpt_rpt->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($cview_application_rpt_rpt->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($cview_application_rpt_rpt->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($cview_application_rpt_rpt->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($cview_application_rpt->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
</select>
		</span></td>
<?php } ?>
	</tr>
</table>
</form>
</div>
</td></tr></table>
</div>
<!-- Summary Report Ends -->
	</div><br /></td>
	<!-- Center Container - Report (End) -->
	<!-- Right Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewRight" class="phpreportmaker">
	<!-- Right slot -->
	</div></td>
	<!-- Right Container (End) -->
</tr>
<!-- Bottom Container (Begin) -->
<tr><td colspan="3"><div id="ewBottom" class="phpreportmaker">
	<!-- Bottom slot -->
	</div><br /></td></tr>
<!-- Bottom Container (End) -->
</table>
<!-- Table Container (End) -->
<?php $cview_application_rpt_rpt->ShowPageFooter(); ?>
<?php if (EWRPT_DEBUG_ENABLED) echo ewrpt_DebugMsg(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "phprptinc/footer.php"; ?>
<?php
$cview_application_rpt_rpt->Page_Terminate();
?>
<?php

//
// Page class
//
class crcview_application_rpt_rpt {

	// Page ID
	var $PageID = 'rpt';

	// Table name
	var $TableName = 'cview_application_rpt';

	// Page object name
	var $PageObjName = 'cview_application_rpt_rpt';

	// Page name
	function PageName() {
		return ewrpt_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewrpt_CurrentPage() . "?";
		global $cview_application_rpt;
		if ($cview_application_rpt->UseTokenInUrl) $PageUrl .= "t=" . $cview_application_rpt->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Export URLs
	var $ExportPrintUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;

	// Message
	function getMessage() {
		return @$_SESSION[EWRPT_SESSION_MESSAGE];
	}

	function setMessage($v) {
		if (@$_SESSION[EWRPT_SESSION_MESSAGE] <> "") { // Append
			$_SESSION[EWRPT_SESSION_MESSAGE] .= "<br />" . $v;
		} else {
			$_SESSION[EWRPT_SESSION_MESSAGE] = $v;
		}
	}

	// Show message
	function ShowMessage() {
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage);
		if ($sMessage <> "") { // Message in Session, display
			echo "<p><span class=\"ewMessage\">" . $sMessage . "</span></p>";
			$_SESSION[EWRPT_SESSION_MESSAGE] = ""; // Clear message in Session
		}
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p><span class=\"phpreportmaker\">" . $sHeader . "</span></p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Fotoer exists, display
			echo "<p><span class=\"phpreportmaker\">" . $sFooter . "</span></p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $cview_application_rpt;
		if ($cview_application_rpt->UseTokenInUrl) {
			if (ewrpt_IsHttpPost())
				return ($cview_application_rpt->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($cview_application_rpt->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crcview_application_rpt_rpt() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Table object (cview_application_rpt)
		$GLOBALS["cview_application_rpt"] = new crcview_application_rpt();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Page ID
		if (!defined("EWRPT_PAGE_ID"))
			define("EWRPT_PAGE_ID", 'rpt', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWRPT_TABLE_NAME"))
			define("EWRPT_TABLE_NAME", 'cview_application_rpt', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new crTimer();

		// Open connection
		$conn = ewrpt_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $ReportLanguage, $Security;
		global $cview_application_rpt;

	// Get export parameters
	if (@$_GET["export"] <> "") {
		$cview_application_rpt->Export = $_GET["export"];
	}
	$gsExport = $cview_application_rpt->Export; // Get export parameter, used in header
	$gsExportFile = $cview_application_rpt->TableVar; // Get export file, used in header

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
		global $ReportLanguage;
		global $cview_application_rpt;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export to Email (use ob_file_contents for PHP)
		if ($cview_application_rpt->Export == "email") {
			$sContent = ob_get_contents();
			$this->ExportEmail($sContent);
			ob_end_clean();

			 // Close connection
			$conn->Close();
			header("Location: " . ewrpt_CurrentPage());
			exit();
		}

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		if ($url <> "") {
			if (!EWRPT_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}

	// Initialize common variables
	// Paging variables

	var $RecCount = 0; // Record count
	var $StartGrp = 0; // Start group
	var $StopGrp = 0; // Stop group
	var $TotalGrps = 0; // Total groups
	var $GrpCount = 0; // Group count
	var $DisplayGrps = 3; // Groups per page
	var $GrpRange = 10;
	var $Sort = "";
	var $Filter = "";
	var $UserIDFilter = "";

	// Clear field for ext filter
	var $ClearExtFilter = "";
	var $FilterApplied;
	var $ShowFirstHeader;
	var $Cnt, $Col, $Val, $Smry, $Mn, $Mx, $GrandSmry, $GrandMn, $GrandMx;
	var $TotCount;

	//
	// Page main
	//
	function Page_Main() {
		global $cview_application_rpt;
		global $rs;
		global $rsgrp;
		global $gsFormError;

		// Aggregate variables
		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of fields

		$nDtls = 14;
		$nGrps = 1;
		$this->Val = ewrpt_InitArray($nDtls, 0);
		$this->Cnt = ewrpt_Init2DArray($nGrps, $nDtls, 0);
		$this->Smry = ewrpt_Init2DArray($nGrps, $nDtls, 0);
		$this->Mn = ewrpt_Init2DArray($nGrps, $nDtls, NULL);
		$this->Mx = ewrpt_Init2DArray($nGrps, $nDtls, NULL);
		$this->GrandSmry = ewrpt_InitArray($nDtls, 0);
		$this->GrandMn = ewrpt_InitArray($nDtls, NULL);
		$this->GrandMx = ewrpt_InitArray($nDtls, NULL);

		// Set up if accumulation required
		$this->Col = array(FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, TRUE, FALSE, FALSE, FALSE, TRUE);

		// Set up groups per page dynamically
		$this->SetUpDisplayGrps();
		$cview_application_rpt->app_submission_year->SelectionList = "";
		$cview_application_rpt->app_submission_year->DefaultSelectionList = "";
		$cview_application_rpt->app_submission_year->ValueList = "";
		$cview_application_rpt->programarea_name->SelectionList = "";
		$cview_application_rpt->programarea_name->DefaultSelectionList = "";
		$cview_application_rpt->programarea_name->ValueList = "";
		$cview_application_rpt->student_gender->SelectionList = "";
		$cview_application_rpt->student_gender->DefaultSelectionList = "";
		$cview_application_rpt->student_gender->ValueList = "";
		$cview_application_rpt->age->SelectionList = "";
		$cview_application_rpt->age->DefaultSelectionList = "";
		$cview_application_rpt->age->ValueList = "";
		$cview_application_rpt->application_status->SelectionList = "";
		$cview_application_rpt->application_status->DefaultSelectionList = "";
		$cview_application_rpt->application_status->ValueList = "";

		// Load default filter values
		$this->LoadDefaultFilters();

		// Set up popup filter
		$this->SetupPopup();

		// Extended filter
		$sExtendedFilter = "";

		// Build popup filter
		$sPopupFilter = $this->GetPopupFilter();

		//ewrpt_SetDebugMsg("popup filter: " . $sPopupFilter);
		if ($sPopupFilter <> "") {
			if ($this->Filter <> "")
				$this->Filter = "($this->Filter) AND ($sPopupFilter)";
			else
				$this->Filter = $sPopupFilter;
		}

		// Check if filter applied
		$this->FilterApplied = $this->CheckFilter();

		// Get sort
		$this->Sort = $this->GetSort();

		// Get total count
		$sSql = ewrpt_BuildReportSql($cview_application_rpt->SqlSelect(), $cview_application_rpt->SqlWhere(), $cview_application_rpt->SqlGroupBy(), $cview_application_rpt->SqlHaving(), $cview_application_rpt->SqlOrderBy(), $this->Filter, $this->Sort);
		$this->TotalGrps = $this->GetCnt($sSql);
		if ($this->DisplayGrps <= 0) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowFirstHeader = ($this->TotalGrps > 0);

		//$this->ShowFirstHeader = TRUE; // Uncomment to always show header
		// Set up start position if not export all

		if ($cview_application_rpt->ExportAll && $cview_application_rpt->Export <> "")
		    $this->DisplayGrps = $this->TotalGrps;
		else
			$this->SetUpStartGroup(); 

		// Get current page records
		$rs = $this->GetRs($sSql, $this->StartGrp, $this->DisplayGrps);
	}

	// Accummulate summary
	function AccumulateSummary() {
		$cntx = count($this->Smry);
		for ($ix = 0; $ix < $cntx; $ix++) {
			$cnty = count($this->Smry[$ix]);
			for ($iy = 1; $iy < $cnty; $iy++) {
				$this->Cnt[$ix][$iy]++;
				if ($this->Col[$iy]) {
					$valwrk = $this->Val[$iy];
					if (is_null($valwrk) || !is_numeric($valwrk)) {

						// skip
					} else {
						$this->Smry[$ix][$iy] += $valwrk;
						if (is_null($this->Mn[$ix][$iy])) {
							$this->Mn[$ix][$iy] = $valwrk;
							$this->Mx[$ix][$iy] = $valwrk;
						} else {
							if ($this->Mn[$ix][$iy] > $valwrk) $this->Mn[$ix][$iy] = $valwrk;
							if ($this->Mx[$ix][$iy] < $valwrk) $this->Mx[$ix][$iy] = $valwrk;
						}
					}
				}
			}
		}
		$cntx = count($this->Smry);
		for ($ix = 1; $ix < $cntx; $ix++) {
			$this->Cnt[$ix][0]++;
		}
	}

	// Reset level summary
	function ResetLevelSummary($lvl) {

		// Clear summary values
		$cntx = count($this->Smry);
		for ($ix = $lvl; $ix < $cntx; $ix++) {
			$cnty = count($this->Smry[$ix]);
			for ($iy = 1; $iy < $cnty; $iy++) {
				$this->Cnt[$ix][$iy] = 0;
				if ($this->Col[$iy]) {
					$this->Smry[$ix][$iy] = 0;
					$this->Mn[$ix][$iy] = NULL;
					$this->Mx[$ix][$iy] = NULL;
				}
			}
		}
		$cntx = count($this->Smry);
		for ($ix = $lvl; $ix < $cntx; $ix++) {
			$this->Cnt[$ix][0] = 0;
		}

		// Reset record count
		$this->RecCount = 0;
	}

	// Accummulate grand summary
	function AccumulateGrandSummary() {
		$this->Cnt[0][0]++;
		$cntgs = count($this->GrandSmry);
		for ($iy = 1; $iy < $cntgs; $iy++) {
			if ($this->Col[$iy]) {
				$valwrk = $this->Val[$iy];
				if (is_null($valwrk) || !is_numeric($valwrk)) {

					// skip
				} else {
					$this->GrandSmry[$iy] += $valwrk;
					if (is_null($this->GrandMn[$iy])) {
						$this->GrandMn[$iy] = $valwrk;
						$this->GrandMx[$iy] = $valwrk;
					} else {
						if ($this->GrandMn[$iy] > $valwrk) $this->GrandMn[$iy] = $valwrk;
						if ($this->GrandMx[$iy] < $valwrk) $this->GrandMx[$iy] = $valwrk;
					}
				}
			}
		}
	}

	// Get count
	function GetCnt($sql) {
		global $conn;
		$rscnt = $conn->Execute($sql);
		$cnt = ($rscnt) ? $rscnt->RecordCount() : 0;
		if ($rscnt) $rscnt->Close();
		return $cnt;
	}

	// Get rs
	function GetRs($sql, $start, $grps) {
		global $conn;
		$wrksql = $sql;
		if ($start > 0 && $grps > -1)
			$wrksql .= " LIMIT " . ($start-1) . ", " . ($grps);
		$rswrk = $conn->Execute($wrksql);
		return $rswrk;
	}

	// Get row values
	function GetRow($opt) {
		global $rs;
		global $cview_application_rpt;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row

	//		$rs->MoveFirst(); // NOTE: no need to move position
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$cview_application_rpt->student_applicant_id->setDbValue($rs->fields('student_applicant_id'));
			$cview_application_rpt->app_submission_year->setDbValue($rs->fields('app_submission_year'));
			$cview_application_rpt->programarea_name->setDbValue($rs->fields('programarea_name'));
			$cview_application_rpt->student_lastname->setDbValue($rs->fields('student_lastname'));
			$cview_application_rpt->student_firstname->setDbValue($rs->fields('student_firstname'));
			$cview_application_rpt->student_middlename->setDbValue($rs->fields('student_middlename'));
			$cview_application_rpt->student_gender->setDbValue($rs->fields('student_gender'));
			$cview_application_rpt->student_dob->setDbValue($rs->fields('student_dob'));
			$cview_application_rpt->age->setDbValue($rs->fields('age'));
			$cview_application_rpt->student_telephone_1->setDbValue($rs->fields('student_telephone_1'));
			$cview_application_rpt->student_telephone_2->setDbValue($rs->fields('student_telephone_2'));
			$cview_application_rpt->student_address->setDbValue($rs->fields('student_address'));
			$cview_application_rpt->community->setDbValue($rs->fields('community'));
			$cview_application_rpt->app_mother_name->setDbValue($rs->fields('app_mother_name'));
			$cview_application_rpt->app_father_name->setDbValue($rs->fields('app_father_name'));
			$cview_application_rpt->app_father_occupation->setDbValue($rs->fields('app_father_occupation'));
			$cview_application_rpt->app_father_isalive->setDbValue($rs->fields('app_father_isalive'));
			$cview_application_rpt->app_mother_isalive->setDbValue($rs->fields('app_mother_isalive'));
			$cview_application_rpt->app_mother_occupation->setDbValue($rs->fields('app_mother_occupation'));
			$cview_application_rpt->app_guardian_name->setDbValue($rs->fields('app_guardian_name'));
			$cview_application_rpt->app_guardian_relation->setDbValue($rs->fields('app_guardian_relation'));
			$cview_application_rpt->app_guardian_occupation->setDbValue($rs->fields('app_guardian_occupation'));
			$cview_application_rpt->student_picture->setDbValue($rs->fields('student_picture'));
			$cview_application_rpt->student_grades->setDbValue($rs->fields('student_grades'));
			$cview_application_rpt->applicant_school_name->setDbValue($rs->fields('applicant_school_name'));
			$cview_application_rpt->app_points->setDbValue($rs->fields('app_points'));
			$cview_application_rpt->sponsored_child_no->setDbValue($rs->fields('sponsored_child_no'));
			$cview_application_rpt->school_name->setDbValue($rs->fields('school_name'));
			$cview_application_rpt->application_status->setDbValue($rs->fields('application_status'));
			$cview_application_rpt->name->setDbValue($rs->fields('name'));
			$cview_application_rpt->app_amount->setDbValue($rs->fields('app_amount'));
			$cview_application_rpt->app_referees->setDbValue($rs->fields('app_referees'));
			$cview_application_rpt->app_grant_id->setDbValue($rs->fields('app_grant_id'));
			$cview_application_rpt->student_admitted_school_id->setDbValue($rs->fields('student_admitted_school_id'));
			$cview_application_rpt->community_community_id->setDbValue($rs->fields('community_community_id'));
			$cview_application_rpt->app_status->setDbValue($rs->fields('app_status'));
			$cview_application_rpt->app_primary_school_id->setDbValue($rs->fields('app_primary_school_id'));
			$cview_application_rpt->app_junior_secondary_id->setDbValue($rs->fields('app_junior_secondary_id'));
			$cview_application_rpt->student_resident_programarea_id->setDbValue($rs->fields('student_resident_programarea_id'));
			$this->Val[1] = $cview_application_rpt->student_applicant_id->CurrentValue;
			$this->Val[2] = $cview_application_rpt->app_submission_year->CurrentValue;
			$this->Val[3] = $cview_application_rpt->programarea_name->CurrentValue;
			$this->Val[4] = $cview_application_rpt->student_lastname->CurrentValue;
			$this->Val[5] = $cview_application_rpt->student_firstname->CurrentValue;
			$this->Val[6] = $cview_application_rpt->student_middlename->CurrentValue;
			$this->Val[7] = $cview_application_rpt->student_gender->CurrentValue;
			$this->Val[8] = $cview_application_rpt->student_dob->CurrentValue;
			$this->Val[9] = $cview_application_rpt->age->CurrentValue;
			$this->Val[10] = $cview_application_rpt->school_name->CurrentValue;
			$this->Val[11] = $cview_application_rpt->application_status->CurrentValue;
			$this->Val[12] = $cview_application_rpt->name->CurrentValue;
			$this->Val[13] = $cview_application_rpt->app_amount->CurrentValue;
		} else {
			$cview_application_rpt->student_applicant_id->setDbValue("");
			$cview_application_rpt->app_submission_year->setDbValue("");
			$cview_application_rpt->programarea_name->setDbValue("");
			$cview_application_rpt->student_lastname->setDbValue("");
			$cview_application_rpt->student_firstname->setDbValue("");
			$cview_application_rpt->student_middlename->setDbValue("");
			$cview_application_rpt->student_gender->setDbValue("");
			$cview_application_rpt->student_dob->setDbValue("");
			$cview_application_rpt->age->setDbValue("");
			$cview_application_rpt->student_telephone_1->setDbValue("");
			$cview_application_rpt->student_telephone_2->setDbValue("");
			$cview_application_rpt->student_address->setDbValue("");
			$cview_application_rpt->community->setDbValue("");
			$cview_application_rpt->app_mother_name->setDbValue("");
			$cview_application_rpt->app_father_name->setDbValue("");
			$cview_application_rpt->app_father_occupation->setDbValue("");
			$cview_application_rpt->app_father_isalive->setDbValue("");
			$cview_application_rpt->app_mother_isalive->setDbValue("");
			$cview_application_rpt->app_mother_occupation->setDbValue("");
			$cview_application_rpt->app_guardian_name->setDbValue("");
			$cview_application_rpt->app_guardian_relation->setDbValue("");
			$cview_application_rpt->app_guardian_occupation->setDbValue("");
			$cview_application_rpt->student_picture->setDbValue("");
			$cview_application_rpt->student_grades->setDbValue("");
			$cview_application_rpt->applicant_school_name->setDbValue("");
			$cview_application_rpt->app_points->setDbValue("");
			$cview_application_rpt->sponsored_child_no->setDbValue("");
			$cview_application_rpt->school_name->setDbValue("");
			$cview_application_rpt->application_status->setDbValue("");
			$cview_application_rpt->name->setDbValue("");
			$cview_application_rpt->app_amount->setDbValue("");
			$cview_application_rpt->app_referees->setDbValue("");
			$cview_application_rpt->app_grant_id->setDbValue("");
			$cview_application_rpt->student_admitted_school_id->setDbValue("");
			$cview_application_rpt->community_community_id->setDbValue("");
			$cview_application_rpt->app_status->setDbValue("");
			$cview_application_rpt->app_primary_school_id->setDbValue("");
			$cview_application_rpt->app_junior_secondary_id->setDbValue("");
			$cview_application_rpt->student_resident_programarea_id->setDbValue("");
		}
	}

	//  Set up starting group
	function SetUpStartGroup() {
		global $cview_application_rpt;

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;

		// Check for a 'start' parameter
		if (@$_GET[EWRPT_TABLE_START_GROUP] != "") {
			$this->StartGrp = $_GET[EWRPT_TABLE_START_GROUP];
			$cview_application_rpt->setStartGroup($this->StartGrp);
		} elseif (@$_GET["pageno"] != "") {
			$nPageNo = $_GET["pageno"];
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$cview_application_rpt->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $cview_application_rpt->getStartGroup();
			}
		} else {
			$this->StartGrp = $cview_application_rpt->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$cview_application_rpt->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$cview_application_rpt->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$cview_application_rpt->setStartGroup($this->StartGrp);
		}
	}

	// Set up popup
	function SetupPopup() {
		global $conn, $ReportLanguage;
		global $cview_application_rpt;

		// Initialize popup
		// Build distinct values for app_submission_year

		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($cview_application_rpt->app_submission_year->SqlSelect, $cview_application_rpt->SqlWhere(), $cview_application_rpt->SqlGroupBy(), $cview_application_rpt->SqlHaving(), $cview_application_rpt->app_submission_year->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$cview_application_rpt->app_submission_year->setDbValue($rswrk->fields[0]);
			if (is_null($cview_application_rpt->app_submission_year->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($cview_application_rpt->app_submission_year->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$cview_application_rpt->app_submission_year->ViewValue = $cview_application_rpt->app_submission_year->CurrentValue;
				ewrpt_SetupDistinctValues($cview_application_rpt->app_submission_year->ValueList, $cview_application_rpt->app_submission_year->CurrentValue, $cview_application_rpt->app_submission_year->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($cview_application_rpt->app_submission_year->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($cview_application_rpt->app_submission_year->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for programarea_name
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($cview_application_rpt->programarea_name->SqlSelect, $cview_application_rpt->SqlWhere(), $cview_application_rpt->SqlGroupBy(), $cview_application_rpt->SqlHaving(), $cview_application_rpt->programarea_name->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$cview_application_rpt->programarea_name->setDbValue($rswrk->fields[0]);
			if (is_null($cview_application_rpt->programarea_name->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($cview_application_rpt->programarea_name->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$cview_application_rpt->programarea_name->ViewValue = $cview_application_rpt->programarea_name->CurrentValue;
				ewrpt_SetupDistinctValues($cview_application_rpt->programarea_name->ValueList, $cview_application_rpt->programarea_name->CurrentValue, $cview_application_rpt->programarea_name->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($cview_application_rpt->programarea_name->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($cview_application_rpt->programarea_name->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for student_gender
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($cview_application_rpt->student_gender->SqlSelect, $cview_application_rpt->SqlWhere(), $cview_application_rpt->SqlGroupBy(), $cview_application_rpt->SqlHaving(), $cview_application_rpt->student_gender->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$cview_application_rpt->student_gender->setDbValue($rswrk->fields[0]);
			if (is_null($cview_application_rpt->student_gender->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($cview_application_rpt->student_gender->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$cview_application_rpt->student_gender->ViewValue = $cview_application_rpt->student_gender->CurrentValue;
				ewrpt_SetupDistinctValues($cview_application_rpt->student_gender->ValueList, $cview_application_rpt->student_gender->CurrentValue, $cview_application_rpt->student_gender->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($cview_application_rpt->student_gender->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($cview_application_rpt->student_gender->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for age
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($cview_application_rpt->age->SqlSelect, $cview_application_rpt->SqlWhere(), $cview_application_rpt->SqlGroupBy(), $cview_application_rpt->SqlHaving(), $cview_application_rpt->age->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$cview_application_rpt->age->setDbValue($rswrk->fields[0]);
			if (is_null($cview_application_rpt->age->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($cview_application_rpt->age->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$cview_application_rpt->age->ViewValue = $cview_application_rpt->age->CurrentValue;
				ewrpt_SetupDistinctValues($cview_application_rpt->age->ValueList, $cview_application_rpt->age->CurrentValue, $cview_application_rpt->age->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($cview_application_rpt->age->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($cview_application_rpt->age->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for application_status
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($cview_application_rpt->application_status->SqlSelect, $cview_application_rpt->SqlWhere(), $cview_application_rpt->SqlGroupBy(), $cview_application_rpt->SqlHaving(), $cview_application_rpt->application_status->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$cview_application_rpt->application_status->setDbValue($rswrk->fields[0]);
			if (is_null($cview_application_rpt->application_status->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($cview_application_rpt->application_status->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$cview_application_rpt->application_status->ViewValue = $cview_application_rpt->application_status->CurrentValue;
				ewrpt_SetupDistinctValues($cview_application_rpt->application_status->ValueList, $cview_application_rpt->application_status->CurrentValue, $cview_application_rpt->application_status->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($cview_application_rpt->application_status->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($cview_application_rpt->application_status->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Process post back form
		if (ewrpt_IsHttpPost()) {
			$sName = @$_POST["popup"]; // Get popup form name
			if ($sName <> "") {
				$cntValues = (is_array(@$_POST["sel_$sName"])) ? count($_POST["sel_$sName"]) : 0;
				if ($cntValues > 0) {
					$arValues = ewrpt_StripSlashes($_POST["sel_$sName"]);
					if (trim($arValues[0]) == "") // Select all
						$arValues = EWRPT_INIT_VALUE;
					$_SESSION["sel_$sName"] = $arValues;
					$_SESSION["rf_$sName"] = ewrpt_StripSlashes(@$_POST["rf_$sName"]);
					$_SESSION["rt_$sName"] = ewrpt_StripSlashes(@$_POST["rt_$sName"]);
					$this->ResetPager();
				}
			}

		// Get 'reset' command
		} elseif (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];
			if (strtolower($sCmd) == "reset") {
				$this->ClearSessionSelection('app_submission_year');
				$this->ClearSessionSelection('programarea_name');
				$this->ClearSessionSelection('student_gender');
				$this->ClearSessionSelection('age');
				$this->ClearSessionSelection('application_status');
				$this->ResetPager();
			}
		}

		// Load selection criteria to array
		// Get Year selected values

		if (is_array(@$_SESSION["sel_cview_application_rpt_app_submission_year"])) {
			$this->LoadSelectionFromSession('app_submission_year');
		} elseif (@$_SESSION["sel_cview_application_rpt_app_submission_year"] == EWRPT_INIT_VALUE) { // Select all
			$cview_application_rpt->app_submission_year->SelectionList = "";
		}

		// Get Programme Area/Unit selected values
		if (is_array(@$_SESSION["sel_cview_application_rpt_programarea_name"])) {
			$this->LoadSelectionFromSession('programarea_name');
		} elseif (@$_SESSION["sel_cview_application_rpt_programarea_name"] == EWRPT_INIT_VALUE) { // Select all
			$cview_application_rpt->programarea_name->SelectionList = "";
		}

		// Get Gender selected values
		if (is_array(@$_SESSION["sel_cview_application_rpt_student_gender"])) {
			$this->LoadSelectionFromSession('student_gender');
		} elseif (@$_SESSION["sel_cview_application_rpt_student_gender"] == EWRPT_INIT_VALUE) { // Select all
			$cview_application_rpt->student_gender->SelectionList = "";
		}

		// Get Age selected values
		if (is_array(@$_SESSION["sel_cview_application_rpt_age"])) {
			$this->LoadSelectionFromSession('age');
		} elseif (@$_SESSION["sel_cview_application_rpt_age"] == EWRPT_INIT_VALUE) { // Select all
			$cview_application_rpt->age->SelectionList = "";
		}

		// Get App Status selected values
		if (is_array(@$_SESSION["sel_cview_application_rpt_application_status"])) {
			$this->LoadSelectionFromSession('application_status');
		} elseif (@$_SESSION["sel_cview_application_rpt_application_status"] == EWRPT_INIT_VALUE) { // Select all
			$cview_application_rpt->application_status->SelectionList = "";
		}
	}

	// Reset pager
	function ResetPager() {

		// Reset start position (reset command)
		global $cview_application_rpt;
		$this->StartGrp = 1;
		$cview_application_rpt->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		global $cview_application_rpt;
		$sWrk = @$_GET[EWRPT_TABLE_GROUP_PER_PAGE];
		if ($sWrk <> "") {
			if (is_numeric($sWrk)) {
				$this->DisplayGrps = intval($sWrk);
			} else {
				if (strtoupper($sWrk) == "ALL") { // display all groups
					$this->DisplayGrps = -1;
				} else {
					$this->DisplayGrps = 3; // Non-numeric, load default
				}
			}
			$cview_application_rpt->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$cview_application_rpt->setStartGroup($this->StartGrp);
		} else {
			if ($cview_application_rpt->getGroupPerPage() <> "") {
				$this->DisplayGrps = $cview_application_rpt->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	function RenderRow() {
		global $conn, $rs, $Security;
		global $cview_application_rpt;
		if ($cview_application_rpt->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total

			// Get total count from sql directly
			$sSql = ewrpt_BuildReportSql($cview_application_rpt->SqlSelectCount(), $cview_application_rpt->SqlWhere(), $cview_application_rpt->SqlGroupBy(), $cview_application_rpt->SqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
			} else {
				$this->TotCount = 0;
			}

			// Get total from sql directly
			$sSql = ewrpt_BuildReportSql($cview_application_rpt->SqlSelectAgg(), $cview_application_rpt->SqlWhere(), $cview_application_rpt->SqlGroupBy(), $cview_application_rpt->SqlHaving(), "", $this->Filter, "");
			$sSql = $cview_application_rpt->SqlAggPfx() . $sSql . $cview_application_rpt->SqlAggSfx();
			$rsagg = $conn->Execute($sSql);
			if ($rsagg) {
				$this->GrandSmry[9] = $rsagg->fields("sum_age");
				$this->GrandMn[9] = $rsagg->fields("min_age");
				$this->GrandMx[9] = $rsagg->fields("max_age");
				$this->GrandSmry[13] = $rsagg->fields("sum_app_amount");
				$rsagg->Close();
			} else {

				// Accumulate grand summary from detail records
				$sSql = ewrpt_BuildReportSql($cview_application_rpt->SqlSelect(), $cview_application_rpt->SqlWhere(), $cview_application_rpt->SqlGroupBy(), $cview_application_rpt->SqlHaving(), "", $this->Filter, "");
				$rs = $conn->Execute($sSql);
				if ($rs) {
					$this->GetRow(1);
					while (!$rs->EOF) {
						$this->AccumulateGrandSummary();
						$this->GetRow(2);
					}
					$rs->Close();
				}
			}
		}

		// Call Row_Rendering event
		$cview_application_rpt->Row_Rendering();

		//
		// Render view codes
		//

		if ($cview_application_rpt->RowType == EWRPT_ROWTYPE_TOTAL) { // Summary row

			// student_applicant_id
			$cview_application_rpt->student_applicant_id->ViewValue = $cview_application_rpt->student_applicant_id->Summary;

			// app_submission_year
			$cview_application_rpt->app_submission_year->ViewValue = $cview_application_rpt->app_submission_year->Summary;

			// programarea_name
			$cview_application_rpt->programarea_name->ViewValue = $cview_application_rpt->programarea_name->Summary;

			// student_lastname
			$cview_application_rpt->student_lastname->ViewValue = $cview_application_rpt->student_lastname->Summary;
			$cview_application_rpt->student_lastname->ViewAttrs["style"] = "font-weight:bold;";

			// student_firstname
			$cview_application_rpt->student_firstname->ViewValue = $cview_application_rpt->student_firstname->Summary;

			// student_middlename
			$cview_application_rpt->student_middlename->ViewValue = $cview_application_rpt->student_middlename->Summary;

			// student_gender
			$cview_application_rpt->student_gender->ViewValue = $cview_application_rpt->student_gender->Summary;

			// student_dob
			$cview_application_rpt->student_dob->ViewValue = $cview_application_rpt->student_dob->Summary;
			$cview_application_rpt->student_dob->ViewValue = ewrpt_FormatDateTime($cview_application_rpt->student_dob->ViewValue, 5);

			// age
			$cview_application_rpt->age->ViewValue = $cview_application_rpt->age->Summary;

			// school_name
			$cview_application_rpt->school_name->ViewValue = $cview_application_rpt->school_name->Summary;

			// application_status
			$cview_application_rpt->application_status->ViewValue = $cview_application_rpt->application_status->Summary;

			// name
			$cview_application_rpt->name->ViewValue = $cview_application_rpt->name->Summary;

			// app_amount
			$cview_application_rpt->app_amount->ViewValue = $cview_application_rpt->app_amount->Summary;
			$cview_application_rpt->app_amount->ViewValue = ewrpt_FormatCurrency($cview_application_rpt->app_amount->ViewValue, 0, -2, -2, -2);
		} else {

			// student_applicant_id
			$cview_application_rpt->student_applicant_id->ViewValue = $cview_application_rpt->student_applicant_id->CurrentValue;
			$cview_application_rpt->student_applicant_id->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// app_submission_year
			$cview_application_rpt->app_submission_year->ViewValue = $cview_application_rpt->app_submission_year->CurrentValue;
			$cview_application_rpt->app_submission_year->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// programarea_name
			$cview_application_rpt->programarea_name->ViewValue = $cview_application_rpt->programarea_name->CurrentValue;
			$cview_application_rpt->programarea_name->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// student_lastname
			$cview_application_rpt->student_lastname->ViewValue = $cview_application_rpt->student_lastname->CurrentValue;
			$cview_application_rpt->student_lastname->ViewAttrs["style"] = "font-weight:bold;";
			$cview_application_rpt->student_lastname->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// student_firstname
			$cview_application_rpt->student_firstname->ViewValue = $cview_application_rpt->student_firstname->CurrentValue;
			$cview_application_rpt->student_firstname->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// student_middlename
			$cview_application_rpt->student_middlename->ViewValue = $cview_application_rpt->student_middlename->CurrentValue;
			$cview_application_rpt->student_middlename->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// student_gender
			$cview_application_rpt->student_gender->ViewValue = $cview_application_rpt->student_gender->CurrentValue;
			$cview_application_rpt->student_gender->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// student_dob
			$cview_application_rpt->student_dob->ViewValue = $cview_application_rpt->student_dob->CurrentValue;
			$cview_application_rpt->student_dob->ViewValue = ewrpt_FormatDateTime($cview_application_rpt->student_dob->ViewValue, 5);
			$cview_application_rpt->student_dob->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// age
			$cview_application_rpt->age->ViewValue = $cview_application_rpt->age->CurrentValue;
			$cview_application_rpt->age->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// school_name
			$cview_application_rpt->school_name->ViewValue = $cview_application_rpt->school_name->CurrentValue;
			$cview_application_rpt->school_name->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// application_status
			$cview_application_rpt->application_status->ViewValue = $cview_application_rpt->application_status->CurrentValue;
			$cview_application_rpt->application_status->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// name
			$cview_application_rpt->name->ViewValue = $cview_application_rpt->name->CurrentValue;
			$cview_application_rpt->name->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// app_amount
			$cview_application_rpt->app_amount->ViewValue = $cview_application_rpt->app_amount->CurrentValue;
			$cview_application_rpt->app_amount->ViewValue = ewrpt_FormatCurrency($cview_application_rpt->app_amount->ViewValue, 0, -2, -2, -2);
			$cview_application_rpt->app_amount->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
		}

		// student_applicant_id
		$cview_application_rpt->student_applicant_id->HrefValue = "";

		// app_submission_year
		$cview_application_rpt->app_submission_year->HrefValue = "";

		// programarea_name
		$cview_application_rpt->programarea_name->HrefValue = "";

		// student_lastname
		$cview_application_rpt->student_lastname->HrefValue = "";

		// student_firstname
		$cview_application_rpt->student_firstname->HrefValue = "";

		// student_middlename
		$cview_application_rpt->student_middlename->HrefValue = "";

		// student_gender
		$cview_application_rpt->student_gender->HrefValue = "";

		// student_dob
		$cview_application_rpt->student_dob->HrefValue = "";

		// age
		$cview_application_rpt->age->HrefValue = "";

		// school_name
		$cview_application_rpt->school_name->HrefValue = "";

		// application_status
		$cview_application_rpt->application_status->HrefValue = "";

		// name
		$cview_application_rpt->name->HrefValue = "";

		// app_amount
		$cview_application_rpt->app_amount->HrefValue = "";

		// Call Row_Rendered event
		$cview_application_rpt->Row_Rendered();
	}

	// Clear selection stored in session
	function ClearSessionSelection($parm) {
		$_SESSION["sel_cview_application_rpt_$parm"] = "";
		$_SESSION["rf_cview_application_rpt_$parm"] = "";
		$_SESSION["rt_cview_application_rpt_$parm"] = "";
	}

	// Load selection from session
	function LoadSelectionFromSession($parm) {
		global $cview_application_rpt;
		$fld =& $cview_application_rpt->fields($parm);
		$fld->SelectionList = @$_SESSION["sel_cview_application_rpt_$parm"];
		$fld->RangeFrom = @$_SESSION["rf_cview_application_rpt_$parm"];
		$fld->RangeTo = @$_SESSION["rt_cview_application_rpt_$parm"];
	}

	// Load default value for filters
	function LoadDefaultFilters() {
		global $cview_application_rpt;

		/**
		* Set up default values for non Text filters
		*/

		/**
		* Set up default values for extended filters
		* function SetDefaultExtFilter(&$fld, $so1, $sv1, $sc, $so2, $sv2)
		* Parameters:
		* $fld - Field object
		* $so1 - Default search operator 1
		* $sv1 - Default ext filter value 1
		* $sc - Default search condition (if operator 2 is enabled)
		* $so2 - Default search operator 2 (if operator 2 is enabled)
		* $sv2 - Default ext filter value 2 (if operator 2 is enabled)
		*/

		/**
		* Set up default values for popup filters
		* NOTE: if extended filter is enabled, use default values in extended filter instead
		*/

		// Field app_submission_year
		// Setup your default values for the popup filter below, e.g.
		// $cview_application_rpt->app_submission_year->DefaultSelectionList = array("val1", "val2");

		$cview_application_rpt->app_submission_year->DefaultSelectionList = "";
		$cview_application_rpt->app_submission_year->SelectionList = $cview_application_rpt->app_submission_year->DefaultSelectionList;

		// Field programarea_name
		// Setup your default values for the popup filter below, e.g.
		// $cview_application_rpt->programarea_name->DefaultSelectionList = array("val1", "val2");

		$cview_application_rpt->programarea_name->DefaultSelectionList = "";
		$cview_application_rpt->programarea_name->SelectionList = $cview_application_rpt->programarea_name->DefaultSelectionList;

		// Field student_gender
		// Setup your default values for the popup filter below, e.g.
		// $cview_application_rpt->student_gender->DefaultSelectionList = array("val1", "val2");

		$cview_application_rpt->student_gender->DefaultSelectionList = "";
		$cview_application_rpt->student_gender->SelectionList = $cview_application_rpt->student_gender->DefaultSelectionList;

		// Field age
		// Setup your default values for the popup filter below, e.g.
		// $cview_application_rpt->age->DefaultSelectionList = array("val1", "val2");

		$cview_application_rpt->age->DefaultSelectionList = "";
		$cview_application_rpt->age->SelectionList = $cview_application_rpt->age->DefaultSelectionList;

		// Field application_status
		// Setup your default values for the popup filter below, e.g.
		// $cview_application_rpt->application_status->DefaultSelectionList = array("val1", "val2");

		$cview_application_rpt->application_status->DefaultSelectionList = "";
		$cview_application_rpt->application_status->SelectionList = $cview_application_rpt->application_status->DefaultSelectionList;
	}

	// Check if filter applied
	function CheckFilter() {
		global $cview_application_rpt;

		// Check app_submission_year popup filter
		if (!ewrpt_MatchedArray($cview_application_rpt->app_submission_year->DefaultSelectionList, $cview_application_rpt->app_submission_year->SelectionList))
			return TRUE;

		// Check programarea_name popup filter
		if (!ewrpt_MatchedArray($cview_application_rpt->programarea_name->DefaultSelectionList, $cview_application_rpt->programarea_name->SelectionList))
			return TRUE;

		// Check student_gender popup filter
		if (!ewrpt_MatchedArray($cview_application_rpt->student_gender->DefaultSelectionList, $cview_application_rpt->student_gender->SelectionList))
			return TRUE;

		// Check age popup filter
		if (!ewrpt_MatchedArray($cview_application_rpt->age->DefaultSelectionList, $cview_application_rpt->age->SelectionList))
			return TRUE;

		// Check application_status popup filter
		if (!ewrpt_MatchedArray($cview_application_rpt->application_status->DefaultSelectionList, $cview_application_rpt->application_status->SelectionList))
			return TRUE;
		return FALSE;
	}

	// Show list of filters
	function ShowFilterList() {
		global $cview_application_rpt;
		global $ReportLanguage;

		// Initialize
		$sFilterList = "";

		// Field app_submission_year
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($cview_application_rpt->app_submission_year->SelectionList))
			$sWrk = ewrpt_JoinArray($cview_application_rpt->app_submission_year->SelectionList, ", ", EWRPT_DATATYPE_NUMBER);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $cview_application_rpt->app_submission_year->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field programarea_name
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($cview_application_rpt->programarea_name->SelectionList))
			$sWrk = ewrpt_JoinArray($cview_application_rpt->programarea_name->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $cview_application_rpt->programarea_name->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field student_gender
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($cview_application_rpt->student_gender->SelectionList))
			$sWrk = ewrpt_JoinArray($cview_application_rpt->student_gender->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $cview_application_rpt->student_gender->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field age
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($cview_application_rpt->age->SelectionList))
			$sWrk = ewrpt_JoinArray($cview_application_rpt->age->SelectionList, ", ", EWRPT_DATATYPE_NUMBER);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $cview_application_rpt->age->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field application_status
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($cview_application_rpt->application_status->SelectionList))
			$sWrk = ewrpt_JoinArray($cview_application_rpt->application_status->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $cview_application_rpt->application_status->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Show Filters
		if ($sFilterList <> "")
			echo $ReportLanguage->Phrase("CurrentFilters") . "<br />$sFilterList";
	}

	// Return poup filter
	function GetPopupFilter() {
		global $cview_application_rpt;
		$sWrk = "";
			if (is_array($cview_application_rpt->app_submission_year->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($cview_application_rpt->app_submission_year, "student_applicant.app_submission_year", EWRPT_DATATYPE_NUMBER);
			}
			if (is_array($cview_application_rpt->programarea_name->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($cview_application_rpt->programarea_name, "programarea.programarea_name", EWRPT_DATATYPE_STRING);
			}
			if (is_array($cview_application_rpt->student_gender->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($cview_application_rpt->student_gender, "student_applicant.student_gender", EWRPT_DATATYPE_STRING);
			}
			if (is_array($cview_application_rpt->age->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($cview_application_rpt->age, "(Year(CurDate()) - Year(student_applicant.student_dob))", EWRPT_DATATYPE_NUMBER);
			}
			if (is_array($cview_application_rpt->application_status->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($cview_application_rpt->application_status, "application_status.application_status", EWRPT_DATATYPE_STRING);
			}
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWRPT_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort() {
		global $cview_application_rpt;

		// Check for a resetsort command
		if (strlen(@$_GET["cmd"]) > 0) {
			$sCmd = @$_GET["cmd"];
			if ($sCmd == "resetsort") {
				$cview_application_rpt->setOrderBy("");
				$cview_application_rpt->setStartGroup(1);
				$cview_application_rpt->student_applicant_id->setSort("");
				$cview_application_rpt->app_submission_year->setSort("");
				$cview_application_rpt->programarea_name->setSort("");
				$cview_application_rpt->student_lastname->setSort("");
				$cview_application_rpt->student_firstname->setSort("");
				$cview_application_rpt->student_middlename->setSort("");
				$cview_application_rpt->student_gender->setSort("");
				$cview_application_rpt->student_dob->setSort("");
				$cview_application_rpt->age->setSort("");
				$cview_application_rpt->school_name->setSort("");
				$cview_application_rpt->application_status->setSort("");
				$cview_application_rpt->name->setSort("");
				$cview_application_rpt->app_amount->setSort("");
			}

		// Check for an Order parameter
		} elseif (@$_GET["order"] <> "") {
			$cview_application_rpt->CurrentOrder = ewrpt_StripSlashes(@$_GET["order"]);
			$cview_application_rpt->CurrentOrderType = @$_GET["ordertype"];
			$sSortSql = $cview_application_rpt->SortSql();
			$cview_application_rpt->setOrderBy($sSortSql);
			$cview_application_rpt->setStartGroup(1);
		}
		return $cview_application_rpt->getOrderBy();
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Message Showing event
	function Message_Showing(&$msg) {

		// Example:
		//$msg = "your new message";

	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
