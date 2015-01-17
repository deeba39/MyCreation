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
$Application_Report_Summary = NULL;

//
// Table class for Application Report Summary
//
class crApplication_Report_Summary {
	var $TableVar = 'Application_Report_Summary';
	var $TableName = 'Application Report Summary';
	var $TableType = 'REPORT';
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
	function crApplication_Report_Summary() {
		global $ReportLanguage;

		// student_applicant_id
		$this->student_applicant_id = new crField('Application_Report_Summary', 'Application Report Summary', 'x_student_applicant_id', 'student_applicant_id', 'student_applicant.student_applicant_id', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->student_applicant_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['student_applicant_id'] =& $this->student_applicant_id;
		$this->student_applicant_id->DateFilter = "";
		$this->student_applicant_id->SqlSelect = "";
		$this->student_applicant_id->SqlOrderBy = "";

		// app_submission_year
		$this->app_submission_year = new crField('Application_Report_Summary', 'Application Report Summary', 'x_app_submission_year', 'app_submission_year', 'student_applicant.app_submission_year', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->app_submission_year->GroupingFieldId = 1;
		$this->app_submission_year->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['app_submission_year'] =& $this->app_submission_year;
		$this->app_submission_year->DateFilter = "";
		$this->app_submission_year->SqlSelect = "SELECT DISTINCT student_applicant.app_submission_year FROM " . $this->SqlFrom();
		$this->app_submission_year->SqlOrderBy = "student_applicant.app_submission_year";
		$this->app_submission_year->FldGroupByType = "";
		$this->app_submission_year->FldGroupInt = "0";
		$this->app_submission_year->FldGroupSql = "";

		// programarea_name
		$this->programarea_name = new crField('Application_Report_Summary', 'Application Report Summary', 'x_programarea_name', 'programarea_name', 'programarea.programarea_name', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['programarea_name'] =& $this->programarea_name;
		$this->programarea_name->DateFilter = "";
		$this->programarea_name->SqlSelect = "";
		$this->programarea_name->SqlOrderBy = "";

		// student_lastname
		$this->student_lastname = new crField('Application_Report_Summary', 'Application Report Summary', 'x_student_lastname', 'student_lastname', 'student_applicant.student_lastname', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['student_lastname'] =& $this->student_lastname;
		$this->student_lastname->DateFilter = "";
		$this->student_lastname->SqlSelect = "";
		$this->student_lastname->SqlOrderBy = "";

		// student_firstname
		$this->student_firstname = new crField('Application_Report_Summary', 'Application Report Summary', 'x_student_firstname', 'student_firstname', 'student_applicant.student_firstname', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['student_firstname'] =& $this->student_firstname;
		$this->student_firstname->DateFilter = "";
		$this->student_firstname->SqlSelect = "";
		$this->student_firstname->SqlOrderBy = "";

		// student_middlename
		$this->student_middlename = new crField('Application_Report_Summary', 'Application Report Summary', 'x_student_middlename', 'student_middlename', 'student_applicant.student_middlename', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['student_middlename'] =& $this->student_middlename;
		$this->student_middlename->DateFilter = "";
		$this->student_middlename->SqlSelect = "";
		$this->student_middlename->SqlOrderBy = "";

		// student_gender
		$this->student_gender = new crField('Application_Report_Summary', 'Application Report Summary', 'x_student_gender', 'student_gender', 'student_applicant.student_gender', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['student_gender'] =& $this->student_gender;
		$this->student_gender->DateFilter = "";
		$this->student_gender->SqlSelect = "";
		$this->student_gender->SqlOrderBy = "";

		// student_dob
		$this->student_dob = new crField('Application_Report_Summary', 'Application Report Summary', 'x_student_dob', 'student_dob', 'student_applicant.student_dob', 135, EWRPT_DATATYPE_DATE, 5);
		$this->student_dob->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateYMD"));
		$this->fields['student_dob'] =& $this->student_dob;
		$this->student_dob->DateFilter = "";
		$this->student_dob->SqlSelect = "";
		$this->student_dob->SqlOrderBy = "";

		// age
		$this->age = new crField('Application_Report_Summary', 'Application Report Summary', 'x_age', 'age', '(Year(CurDate()) - Year(student_applicant.student_dob))', 20, EWRPT_DATATYPE_NUMBER, -1);
		$this->age->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['age'] =& $this->age;
		$this->age->DateFilter = "";
		$this->age->SqlSelect = "";
		$this->age->SqlOrderBy = "";

		// student_telephone_1
		$this->student_telephone_1 = new crField('Application_Report_Summary', 'Application Report Summary', 'x_student_telephone_1', 'student_telephone_1', 'student_applicant.student_telephone_1', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['student_telephone_1'] =& $this->student_telephone_1;
		$this->student_telephone_1->DateFilter = "";
		$this->student_telephone_1->SqlSelect = "";
		$this->student_telephone_1->SqlOrderBy = "";

		// student_telephone_2
		$this->student_telephone_2 = new crField('Application_Report_Summary', 'Application Report Summary', 'x_student_telephone_2', 'student_telephone_2', 'student_applicant.student_telephone_2', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['student_telephone_2'] =& $this->student_telephone_2;
		$this->student_telephone_2->DateFilter = "";
		$this->student_telephone_2->SqlSelect = "";
		$this->student_telephone_2->SqlOrderBy = "";

		// student_address
		$this->student_address = new crField('Application_Report_Summary', 'Application Report Summary', 'x_student_address', 'student_address', 'student_applicant.student_address', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['student_address'] =& $this->student_address;
		$this->student_address->DateFilter = "";
		$this->student_address->SqlSelect = "";
		$this->student_address->SqlOrderBy = "";

		// community
		$this->community = new crField('Application_Report_Summary', 'Application Report Summary', 'x_community', 'community', 'community.community', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['community'] =& $this->community;
		$this->community->DateFilter = "";
		$this->community->SqlSelect = "";
		$this->community->SqlOrderBy = "";

		// app_mother_name
		$this->app_mother_name = new crField('Application_Report_Summary', 'Application Report Summary', 'x_app_mother_name', 'app_mother_name', 'student_applicant.app_mother_name', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['app_mother_name'] =& $this->app_mother_name;
		$this->app_mother_name->DateFilter = "";
		$this->app_mother_name->SqlSelect = "";
		$this->app_mother_name->SqlOrderBy = "";

		// app_father_name
		$this->app_father_name = new crField('Application_Report_Summary', 'Application Report Summary', 'x_app_father_name', 'app_father_name', 'student_applicant.app_father_name', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['app_father_name'] =& $this->app_father_name;
		$this->app_father_name->DateFilter = "";
		$this->app_father_name->SqlSelect = "";
		$this->app_father_name->SqlOrderBy = "";

		// app_father_occupation
		$this->app_father_occupation = new crField('Application_Report_Summary', 'Application Report Summary', 'x_app_father_occupation', 'app_father_occupation', 'student_applicant.app_father_occupation', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->app_father_occupation->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['app_father_occupation'] =& $this->app_father_occupation;
		$this->app_father_occupation->DateFilter = "";
		$this->app_father_occupation->SqlSelect = "";
		$this->app_father_occupation->SqlOrderBy = "";

		// app_father_isalive
		$this->app_father_isalive = new crField('Application_Report_Summary', 'Application Report Summary', 'x_app_father_isalive', 'app_father_isalive', 'student_applicant.app_father_isalive', 16, EWRPT_DATATYPE_NUMBER, -1);
		$this->app_father_isalive->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['app_father_isalive'] =& $this->app_father_isalive;
		$this->app_father_isalive->DateFilter = "";
		$this->app_father_isalive->SqlSelect = "";
		$this->app_father_isalive->SqlOrderBy = "";

		// app_mother_isalive
		$this->app_mother_isalive = new crField('Application_Report_Summary', 'Application Report Summary', 'x_app_mother_isalive', 'app_mother_isalive', 'student_applicant.app_mother_isalive', 16, EWRPT_DATATYPE_NUMBER, -1);
		$this->app_mother_isalive->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['app_mother_isalive'] =& $this->app_mother_isalive;
		$this->app_mother_isalive->DateFilter = "";
		$this->app_mother_isalive->SqlSelect = "";
		$this->app_mother_isalive->SqlOrderBy = "";

		// app_mother_occupation
		$this->app_mother_occupation = new crField('Application_Report_Summary', 'Application Report Summary', 'x_app_mother_occupation', 'app_mother_occupation', 'student_applicant.app_mother_occupation', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->app_mother_occupation->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['app_mother_occupation'] =& $this->app_mother_occupation;
		$this->app_mother_occupation->DateFilter = "";
		$this->app_mother_occupation->SqlSelect = "";
		$this->app_mother_occupation->SqlOrderBy = "";

		// app_guardian_name
		$this->app_guardian_name = new crField('Application_Report_Summary', 'Application Report Summary', 'x_app_guardian_name', 'app_guardian_name', 'student_applicant.app_guardian_name', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['app_guardian_name'] =& $this->app_guardian_name;
		$this->app_guardian_name->DateFilter = "";
		$this->app_guardian_name->SqlSelect = "";
		$this->app_guardian_name->SqlOrderBy = "";

		// app_guardian_relation
		$this->app_guardian_relation = new crField('Application_Report_Summary', 'Application Report Summary', 'x_app_guardian_relation', 'app_guardian_relation', 'student_applicant.app_guardian_relation', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['app_guardian_relation'] =& $this->app_guardian_relation;
		$this->app_guardian_relation->DateFilter = "";
		$this->app_guardian_relation->SqlSelect = "";
		$this->app_guardian_relation->SqlOrderBy = "";

		// app_guardian_occupation
		$this->app_guardian_occupation = new crField('Application_Report_Summary', 'Application Report Summary', 'x_app_guardian_occupation', 'app_guardian_occupation', 'student_applicant.app_guardian_occupation', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->app_guardian_occupation->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['app_guardian_occupation'] =& $this->app_guardian_occupation;
		$this->app_guardian_occupation->DateFilter = "";
		$this->app_guardian_occupation->SqlSelect = "";
		$this->app_guardian_occupation->SqlOrderBy = "";

		// student_picture
		$this->student_picture = new crField('Application_Report_Summary', 'Application Report Summary', 'x_student_picture', 'student_picture', 'student_applicant.student_picture', 201, EWRPT_DATATYPE_MEMO, -1);
		$this->fields['student_picture'] =& $this->student_picture;
		$this->student_picture->DateFilter = "";
		$this->student_picture->SqlSelect = "";
		$this->student_picture->SqlOrderBy = "";

		// student_grades
		$this->student_grades = new crField('Application_Report_Summary', 'Application Report Summary', 'x_student_grades', 'student_grades', 'student_applicant.student_grades', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['student_grades'] =& $this->student_grades;
		$this->student_grades->DateFilter = "";
		$this->student_grades->SqlSelect = "";
		$this->student_grades->SqlOrderBy = "";

		// applicant_school_name
		$this->applicant_school_name = new crField('Application_Report_Summary', 'Application Report Summary', 'x_applicant_school_name', 'applicant_school_name', 'applicant_school.applicant_school_name', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['applicant_school_name'] =& $this->applicant_school_name;
		$this->applicant_school_name->DateFilter = "";
		$this->applicant_school_name->SqlSelect = "";
		$this->applicant_school_name->SqlOrderBy = "";

		// app_points
		$this->app_points = new crField('Application_Report_Summary', 'Application Report Summary', 'x_app_points', 'app_points', 'student_applicant.app_points', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->app_points->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['app_points'] =& $this->app_points;
		$this->app_points->DateFilter = "";
		$this->app_points->SqlSelect = "";
		$this->app_points->SqlOrderBy = "";

		// sponsored_child_no
		$this->sponsored_child_no = new crField('Application_Report_Summary', 'Application Report Summary', 'x_sponsored_child_no', 'sponsored_child_no', 'student_applicant.sponsored_child_no', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['sponsored_child_no'] =& $this->sponsored_child_no;
		$this->sponsored_child_no->DateFilter = "";
		$this->sponsored_child_no->SqlSelect = "";
		$this->sponsored_child_no->SqlOrderBy = "";

		// school_name
		$this->school_name = new crField('Application_Report_Summary', 'Application Report Summary', 'x_school_name', 'school_name', 'schools.school_name', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['school_name'] =& $this->school_name;
		$this->school_name->DateFilter = "";
		$this->school_name->SqlSelect = "";
		$this->school_name->SqlOrderBy = "";

		// application_status
		$this->application_status = new crField('Application_Report_Summary', 'Application Report Summary', 'x_application_status', 'application_status', 'application_status.application_status', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['application_status'] =& $this->application_status;
		$this->application_status->DateFilter = "";
		$this->application_status->SqlSelect = "";
		$this->application_status->SqlOrderBy = "";

		// name
		$this->name = new crField('Application_Report_Summary', 'Application Report Summary', 'x_name', 'name', 'grant_package.name', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['name'] =& $this->name;
		$this->name->DateFilter = "";
		$this->name->SqlSelect = "";
		$this->name->SqlOrderBy = "";

		// app_amount
		$this->app_amount = new crField('Application_Report_Summary', 'Application Report Summary', 'x_app_amount', 'app_amount', 'student_applicant.app_amount', 131, EWRPT_DATATYPE_NUMBER, -1);
		$this->app_amount->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['app_amount'] =& $this->app_amount;
		$this->app_amount->DateFilter = "";
		$this->app_amount->SqlSelect = "";
		$this->app_amount->SqlOrderBy = "";

		// app_referees
		$this->app_referees = new crField('Application_Report_Summary', 'Application Report Summary', 'x_app_referees', 'app_referees', 'student_applicant.app_referees', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['app_referees'] =& $this->app_referees;
		$this->app_referees->DateFilter = "";
		$this->app_referees->SqlSelect = "";
		$this->app_referees->SqlOrderBy = "";

		// app_grant_id
		$this->app_grant_id = new crField('Application_Report_Summary', 'Application Report Summary', 'x_app_grant_id', 'app_grant_id', 'student_applicant.app_grant_id', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->app_grant_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['app_grant_id'] =& $this->app_grant_id;
		$this->app_grant_id->DateFilter = "";
		$this->app_grant_id->SqlSelect = "";
		$this->app_grant_id->SqlOrderBy = "";

		// student_admitted_school_id
		$this->student_admitted_school_id = new crField('Application_Report_Summary', 'Application Report Summary', 'x_student_admitted_school_id', 'student_admitted_school_id', 'student_applicant.student_admitted_school_id', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->student_admitted_school_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['student_admitted_school_id'] =& $this->student_admitted_school_id;
		$this->student_admitted_school_id->DateFilter = "";
		$this->student_admitted_school_id->SqlSelect = "";
		$this->student_admitted_school_id->SqlOrderBy = "";

		// community_community_id
		$this->community_community_id = new crField('Application_Report_Summary', 'Application Report Summary', 'x_community_community_id', 'community_community_id', 'student_applicant.community_community_id', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->community_community_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['community_community_id'] =& $this->community_community_id;
		$this->community_community_id->DateFilter = "";
		$this->community_community_id->SqlSelect = "";
		$this->community_community_id->SqlOrderBy = "";

		// app_status
		$this->app_status = new crField('Application_Report_Summary', 'Application Report Summary', 'x_app_status', 'app_status', 'student_applicant.app_status', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->app_status->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['app_status'] =& $this->app_status;
		$this->app_status->DateFilter = "";
		$this->app_status->SqlSelect = "";
		$this->app_status->SqlOrderBy = "";

		// app_primary_school_id
		$this->app_primary_school_id = new crField('Application_Report_Summary', 'Application Report Summary', 'x_app_primary_school_id', 'app_primary_school_id', 'student_applicant.app_primary_school_id', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->app_primary_school_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['app_primary_school_id'] =& $this->app_primary_school_id;
		$this->app_primary_school_id->DateFilter = "";
		$this->app_primary_school_id->SqlSelect = "";
		$this->app_primary_school_id->SqlOrderBy = "";

		// app_junior_secondary_id
		$this->app_junior_secondary_id = new crField('Application_Report_Summary', 'Application Report Summary', 'x_app_junior_secondary_id', 'app_junior_secondary_id', 'student_applicant.app_junior_secondary_id', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->app_junior_secondary_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['app_junior_secondary_id'] =& $this->app_junior_secondary_id;
		$this->app_junior_secondary_id->DateFilter = "";
		$this->app_junior_secondary_id->SqlSelect = "";
		$this->app_junior_secondary_id->SqlOrderBy = "";

		// student_resident_programarea_id
		$this->student_resident_programarea_id = new crField('Application_Report_Summary', 'Application Report Summary', 'x_student_resident_programarea_id', 'student_resident_programarea_id', 'student_applicant.student_resident_programarea_id', 3, EWRPT_DATATYPE_NUMBER, -1);
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
		return "student_applicant.app_submission_year ASC";
	}

	// Table Level Group SQL
	function SqlFirstGroupField() {
		return "student_applicant.app_submission_year";
	}

	function SqlSelectGroup() {
		return "SELECT DISTINCT " . $this->SqlFirstGroupField() . " FROM " . $this->SqlFrom();
	}

	function SqlOrderByGroup() {
		return "student_applicant.app_submission_year ASC";
	}

	function SqlSelectAgg() {
		return "SELECT SUM((Year(CurDate()) - Year(student_applicant.student_dob))) AS sum_age, MIN((Year(CurDate()) - Year(student_applicant.student_dob))) AS min_age, MAX((Year(CurDate()) - Year(student_applicant.student_dob))) AS max_age, SUM(student_applicant.app_amount) AS sum_app_amount FROM " . $this->SqlFrom();
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
$Application_Report_Summary_summary = new crApplication_Report_Summary_summary();
$Page =& $Application_Report_Summary_summary;

// Page init
$Application_Report_Summary_summary->Page_Init();

// Page main
$Application_Report_Summary_summary->Page_Main();
?>
<?php include "phprptinc/header.php"; ?>
<script type="text/javascript">

// Create page object
var Application_Report_Summary_summary = new ewrpt_Page("Application_Report_Summary_summary");

// page properties
Application_Report_Summary_summary.PageID = "summary"; // page ID
Application_Report_Summary_summary.FormID = "fApplication_Report_Summarysummaryfilter"; // form ID
var EWRPT_PAGE_ID = Application_Report_Summary_summary.PageID;

// extend page with ValidateForm function
Application_Report_Summary_summary.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj)) return false;
	return true;
}

// extend page with Form_CustomValidate function
Application_Report_Summary_summary.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EWRPT_CLIENT_VALIDATE) { ?>
Application_Report_Summary_summary.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
Application_Report_Summary_summary.ValidateRequired = false; // no JavaScript validation
<?php } ?>
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php $Application_Report_Summary_summary->ShowPageHeader(); ?>
<?php $Application_Report_Summary_summary->ShowMessage(); ?>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script type="text/javascript">

// popup fields
<?php $jsdata = ewrpt_GetJsData($Application_Report_Summary->app_submission_year, $Application_Report_Summary->app_submission_year->FldType); ?>
ewrpt_CreatePopup("Application_Report_Summary_app_submission_year", [<?php echo $jsdata ?>]);
</script>
<div id="Application_Report_Summary_app_submission_year_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0">
<!-- Top Container (Begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php echo $Application_Report_Summary->TableCaption() ?>
<?php if ($Application_Report_Summary_summary->FilterApplied) { ?>
&nbsp;&nbsp;<a href="Application_Report_Summarysmry.php?cmd=reset"><?php echo $ReportLanguage->Phrase("ResetAllFilter") ?></a>
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
<?php
if ($Application_Report_Summary->FilterPanelOption == 2 || ($Application_Report_Summary->FilterPanelOption == 3 && $Application_Report_Summary_summary->FilterApplied) || $Application_Report_Summary_summary->Filter == "0=101") {
	$sButtonImage = "phprptimages/collapse.gif";
	$sDivDisplay = "";
} else {
	$sButtonImage = "phprptimages/expand.gif";
	$sDivDisplay = " style=\"display: none;\"";
}
?>
<a href="javascript:ewrpt_ToggleFilterPanel();" style="text-decoration: none;"><img id="ewrptToggleFilterImg" src="<?php echo $sButtonImage ?>" alt="" width="9" height="9" border="0"></a><span class="phpreportmaker">&nbsp;<?php echo $ReportLanguage->Phrase("Filters") ?></span><br /><br />
<div id="ewrptExtFilterPanel"<?php echo $sDivDisplay ?>>
<!-- Search form (begin) -->
<form name="fApplication_Report_Summarysummaryfilter" id="fApplication_Report_Summarysummaryfilter" action="Application_Report_Summarysmry.php" class="ewForm" onsubmit="return Application_Report_Summary_summary.ValidateForm(this);">
<table class="ewRptExtFilter">
	<tr>
		<td><span class="phpreportmaker"><?php echo $Application_Report_Summary->programarea_name->FldCaption() ?></span></td>
		<td></td>
		<td colspan="4"><span class="ewRptSearchOpr">
		<select name="sv_programarea_name[]" id="sv_programarea_name[]" multiple<?php echo ($Application_Report_Summary_summary->ClearExtFilter == 'Application_Report_Summary_programarea_name') ? " class=\"ewInputCleared\"" : "" ?>>
		<option value="<?php echo EWRPT_ALL_VALUE; ?>"<?php if (ewrpt_MatchedFilterValue($Application_Report_Summary->programarea_name->DropDownValue, EWRPT_ALL_VALUE)) echo " selected=\"selected\""; ?>><?php echo $ReportLanguage->Phrase("SelectAll"); ?></option>
<?php

// Popup filter
$cntf = is_array($Application_Report_Summary->programarea_name->CustomFilters) ? count($Application_Report_Summary->programarea_name->CustomFilters) : 0;
$cntd = is_array($Application_Report_Summary->programarea_name->DropDownList) ? count($Application_Report_Summary->programarea_name->DropDownList) : 0;
$totcnt = $cntf + $cntd;
$wrkcnt = 0;
	for ($i = 0; $i < $cntf; $i++) {
		if ($Application_Report_Summary->programarea_name->CustomFilters[$i]->FldName == 'programarea_name') {
?>
		<option value="<?php echo "@@" . $Application_Report_Summary->programarea_name->CustomFilters[$i]->FilterName ?>"<?php if (ewrpt_MatchedFilterValue($Application_Report_Summary->programarea_name->DropDownValue, "@@" . $Application_Report_Summary->programarea_name->CustomFilters[$i]->FilterName)) echo " selected=\"selected\"" ?>><?php echo $Application_Report_Summary->programarea_name->CustomFilters[$i]->DisplayName ?></option>
<?php
		}
		$wrkcnt += 1;
	}

//}
	for ($i = 0; $i < $cntd; $i++) {
?>
		<option value="<?php echo $Application_Report_Summary->programarea_name->DropDownList[$i] ?>"<?php if (ewrpt_MatchedFilterValue($Application_Report_Summary->programarea_name->DropDownValue, $Application_Report_Summary->programarea_name->DropDownList[$i])) echo " selected=\"selected\"" ?>><?php echo ewrpt_DropDownDisplayValue($Application_Report_Summary->programarea_name->DropDownList[$i], "", 0) ?></option>
<?php
		$wrkcnt += 1;
	}

//}
?>
		</select>
		</span></td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Application_Report_Summary->student_gender->FldCaption() ?></span></td>
		<td></td>
		<td colspan="4"><span class="ewRptSearchOpr">
		<select name="sv_student_gender" id="sv_student_gender"<?php echo ($Application_Report_Summary_summary->ClearExtFilter == 'Application_Report_Summary_student_gender') ? " class=\"ewInputCleared\"" : "" ?>>
		<option value="<?php echo EWRPT_ALL_VALUE; ?>"<?php if (ewrpt_MatchedFilterValue($Application_Report_Summary->student_gender->DropDownValue, EWRPT_ALL_VALUE)) echo " selected=\"selected\""; ?>><?php echo $ReportLanguage->Phrase("PleaseSelect"); ?></option>
<?php

// Popup filter
$cntf = is_array($Application_Report_Summary->student_gender->CustomFilters) ? count($Application_Report_Summary->student_gender->CustomFilters) : 0;
$cntd = is_array($Application_Report_Summary->student_gender->DropDownList) ? count($Application_Report_Summary->student_gender->DropDownList) : 0;
$totcnt = $cntf + $cntd;
$wrkcnt = 0;
	for ($i = 0; $i < $cntf; $i++) {
		if ($Application_Report_Summary->student_gender->CustomFilters[$i]->FldName == 'student_gender') {
?>
		<option value="<?php echo "@@" . $Application_Report_Summary->student_gender->CustomFilters[$i]->FilterName ?>"<?php if (ewrpt_MatchedFilterValue($Application_Report_Summary->student_gender->DropDownValue, "@@" . $Application_Report_Summary->student_gender->CustomFilters[$i]->FilterName)) echo " selected=\"selected\"" ?>><?php echo $Application_Report_Summary->student_gender->CustomFilters[$i]->DisplayName ?></option>
<?php
		}
		$wrkcnt += 1;
	}

//}
	for ($i = 0; $i < $cntd; $i++) {
?>
		<option value="<?php echo $Application_Report_Summary->student_gender->DropDownList[$i] ?>"<?php if (ewrpt_MatchedFilterValue($Application_Report_Summary->student_gender->DropDownValue, $Application_Report_Summary->student_gender->DropDownList[$i])) echo " selected=\"selected\"" ?>><?php echo ewrpt_DropDownDisplayValue($Application_Report_Summary->student_gender->DropDownList[$i], "", 0) ?></option>
<?php
		$wrkcnt += 1;
	}

//}
?>
		</select>
		</span></td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Application_Report_Summary->application_status->FldCaption() ?></span></td>
		<td></td>
		<td colspan="4"><span class="ewRptSearchOpr">
		<select name="sv_application_status" id="sv_application_status"<?php echo ($Application_Report_Summary_summary->ClearExtFilter == 'Application_Report_Summary_application_status') ? " class=\"ewInputCleared\"" : "" ?>>
		<option value="<?php echo EWRPT_ALL_VALUE; ?>"<?php if (ewrpt_MatchedFilterValue($Application_Report_Summary->application_status->DropDownValue, EWRPT_ALL_VALUE)) echo " selected=\"selected\""; ?>><?php echo $ReportLanguage->Phrase("PleaseSelect"); ?></option>
<?php

// Popup filter
$cntf = is_array($Application_Report_Summary->application_status->CustomFilters) ? count($Application_Report_Summary->application_status->CustomFilters) : 0;
$cntd = is_array($Application_Report_Summary->application_status->DropDownList) ? count($Application_Report_Summary->application_status->DropDownList) : 0;
$totcnt = $cntf + $cntd;
$wrkcnt = 0;
	for ($i = 0; $i < $cntf; $i++) {
		if ($Application_Report_Summary->application_status->CustomFilters[$i]->FldName == 'application_status') {
?>
		<option value="<?php echo "@@" . $Application_Report_Summary->application_status->CustomFilters[$i]->FilterName ?>"<?php if (ewrpt_MatchedFilterValue($Application_Report_Summary->application_status->DropDownValue, "@@" . $Application_Report_Summary->application_status->CustomFilters[$i]->FilterName)) echo " selected=\"selected\"" ?>><?php echo $Application_Report_Summary->application_status->CustomFilters[$i]->DisplayName ?></option>
<?php
		}
		$wrkcnt += 1;
	}

//}
	for ($i = 0; $i < $cntd; $i++) {
?>
		<option value="<?php echo $Application_Report_Summary->application_status->DropDownList[$i] ?>"<?php if (ewrpt_MatchedFilterValue($Application_Report_Summary->application_status->DropDownValue, $Application_Report_Summary->application_status->DropDownList[$i])) echo " selected=\"selected\"" ?>><?php echo ewrpt_DropDownDisplayValue($Application_Report_Summary->application_status->DropDownList[$i], "", 0) ?></option>
<?php
		$wrkcnt += 1;
	}

//}
?>
		</select>
		</span></td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Application_Report_Summary->name->FldCaption() ?></span></td>
		<td></td>
		<td colspan="4"><span class="ewRptSearchOpr">
<?php

// Popup filter
$cntf = is_array($Application_Report_Summary->name->CustomFilters) ? count($Application_Report_Summary->name->CustomFilters) : 0;
$cntd = is_array($Application_Report_Summary->name->DropDownList) ? count($Application_Report_Summary->name->DropDownList) : 0;
$totcnt = $cntf + $cntd;
$wrkcnt = 0;
	for ($i = 0; $i < $cntf; $i++) {
		if ($Application_Report_Summary->name->CustomFilters[$i]->FldName == 'name') {
?>
		<?php echo ewrpt_RepeatColumnTable($totcnt, $wrkcnt, 5, 1) ?>
<label><input type="checkbox" name="$Application_Report_Summary->name->DropDownValue[]" id="$Application_Report_Summary->name->DropDownValue[]" value="<?php echo "@@" . $Application_Report_Summary->name->CustomFilters[$i]->FilterName ?>"<?php if (ewrpt_MatchedFilterValue($Application_Report_Summary->name->DropDownValue, "@@" . $Application_Report_Summary->name->CustomFilters[$i]->FilterName)) echo " checked=\"checked\"" ?>><?php echo $Application_Report_Summary->name->CustomFilters[$i]->DisplayName ?></label>
<?php echo ewrpt_RepeatColumnTable($totcnt, $wrkcnt, 5, 2) ?>
<?php
		}
		$wrkcnt += 1;
	}

//}
	for ($i = 0; $i < $cntd; $i++) {
?>
		<?php echo ewrpt_RepeatColumnTable($totcnt, $wrkcnt, 5, 1) ?>
<label><input type="checkbox" name="sv_name[]" id="sv_name[]" value="<?php echo $Application_Report_Summary->name->DropDownList[$i] ?>"<?php if (ewrpt_MatchedFilterValue($Application_Report_Summary->name->DropDownValue, $Application_Report_Summary->name->DropDownList[$i])) echo " checked=\"checked\"" ?>><?php echo ewrpt_DropDownDisplayValue($Application_Report_Summary->name->DropDownList[$i], "", 0) ?></label>
<?php echo ewrpt_RepeatColumnTable($totcnt, $wrkcnt, 5, 2) ?>
<?php
		$wrkcnt += 1;
	}

//}
?>
		</span></td>
	</tr>
</table>
<table class="ewRptExtFilter">
	<tr>
		<td><span class="phpreportmaker">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo $ReportLanguage->Phrase("Search") ?>">&nbsp;
			<input type="Reset" name="Reset" id="Reset" value="<?php echo $ReportLanguage->Phrase("Reset") ?>">&nbsp;
		</span></td>
	</tr>
</table>
</form>
<!-- Search form (end) -->
</div>
<br />
<?php if ($Application_Report_Summary->ShowCurrentFilter) { ?>
<div id="ewrptFilterList">
<?php $Application_Report_Summary_summary->ShowFilterList() ?>
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
if ($Application_Report_Summary->ExportAll && $Application_Report_Summary->Export <> "") {
	$Application_Report_Summary_summary->StopGrp = $Application_Report_Summary_summary->TotalGrps;
} else {
	$Application_Report_Summary_summary->StopGrp = $Application_Report_Summary_summary->StartGrp + $Application_Report_Summary_summary->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($Application_Report_Summary_summary->StopGrp) > intval($Application_Report_Summary_summary->TotalGrps))
	$Application_Report_Summary_summary->StopGrp = $Application_Report_Summary_summary->TotalGrps;
$Application_Report_Summary_summary->RecCount = 0;

// Get first row
if ($Application_Report_Summary_summary->TotalGrps > 0) {
	$Application_Report_Summary_summary->GetGrpRow(1);
	$Application_Report_Summary_summary->GrpCount = 1;
}
while (($rsgrp && !$rsgrp->EOF && $Application_Report_Summary_summary->GrpCount <= $Application_Report_Summary_summary->DisplayGrps) || $Application_Report_Summary_summary->ShowFirstHeader) {

	// Show header
	if ($Application_Report_Summary_summary->ShowFirstHeader) {
?>
	<thead>
	<tr>
<td class="ewTableHeader">
<?php if ($Application_Report_Summary->Export <> "") { ?>
<?php echo $Application_Report_Summary->app_submission_year->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Application_Report_Summary->SortUrl($Application_Report_Summary->app_submission_year) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Application_Report_Summary->app_submission_year->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Application_Report_Summary->SortUrl($Application_Report_Summary->app_submission_year) ?>',0);"><?php echo $Application_Report_Summary->app_submission_year->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Application_Report_Summary->app_submission_year->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Application_Report_Summary->app_submission_year->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Application_Report_Summary_app_submission_year', false, '<?php echo $Application_Report_Summary->app_submission_year->RangeFrom; ?>', '<?php echo $Application_Report_Summary->app_submission_year->RangeTo; ?>');return false;" name="x_app_submission_year<?php echo $Application_Report_Summary_summary->Cnt[0][0]; ?>" id="x_app_submission_year<?php echo $Application_Report_Summary_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($Application_Report_Summary->Export <> "") { ?>
<?php echo $Application_Report_Summary->programarea_name->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Application_Report_Summary->SortUrl($Application_Report_Summary->programarea_name) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Application_Report_Summary->programarea_name->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Application_Report_Summary->SortUrl($Application_Report_Summary->programarea_name) ?>',0);"><?php echo $Application_Report_Summary->programarea_name->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Application_Report_Summary->programarea_name->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Application_Report_Summary->programarea_name->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($Application_Report_Summary->Export <> "") { ?>
<?php echo $Application_Report_Summary->age->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Application_Report_Summary->SortUrl($Application_Report_Summary->age) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Application_Report_Summary->age->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Application_Report_Summary->SortUrl($Application_Report_Summary->age) ?>',0);"><?php echo $Application_Report_Summary->age->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Application_Report_Summary->age->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Application_Report_Summary->age->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($Application_Report_Summary->Export <> "") { ?>
<?php echo $Application_Report_Summary->application_status->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Application_Report_Summary->SortUrl($Application_Report_Summary->application_status) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Application_Report_Summary->application_status->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Application_Report_Summary->SortUrl($Application_Report_Summary->application_status) ?>',0);"><?php echo $Application_Report_Summary->application_status->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Application_Report_Summary->application_status->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Application_Report_Summary->application_status->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($Application_Report_Summary->Export <> "") { ?>
<?php echo $Application_Report_Summary->app_amount->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Application_Report_Summary->SortUrl($Application_Report_Summary->app_amount) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Application_Report_Summary->app_amount->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Application_Report_Summary->SortUrl($Application_Report_Summary->app_amount) ?>',0);"><?php echo $Application_Report_Summary->app_amount->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Application_Report_Summary->app_amount->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Application_Report_Summary->app_amount->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
	</tr>
	</thead>
	<tbody>
<?php
		$Application_Report_Summary_summary->ShowFirstHeader = FALSE;
	}

	// Build detail SQL
	$sWhere = ewrpt_DetailFilterSQL($Application_Report_Summary->app_submission_year, $Application_Report_Summary->SqlFirstGroupField(), $Application_Report_Summary->app_submission_year->GroupValue());
	if ($Application_Report_Summary_summary->Filter != "")
		$sWhere = "($Application_Report_Summary_summary->Filter) AND ($sWhere)";
	$sSql = ewrpt_BuildReportSql($Application_Report_Summary->SqlSelect(), $Application_Report_Summary->SqlWhere(), $Application_Report_Summary->SqlGroupBy(), $Application_Report_Summary->SqlHaving(), $Application_Report_Summary->SqlOrderBy(), $sWhere, $Application_Report_Summary_summary->Sort);
	$rs = $conn->Execute($sSql);
	$rsdtlcnt = ($rs) ? $rs->RecordCount() : 0;
	if ($rsdtlcnt > 0)
		$Application_Report_Summary_summary->GetRow(1);
	while ($rs && !$rs->EOF) { // Loop detail records
		$Application_Report_Summary_summary->RecCount++;

		// Render detail row
		$Application_Report_Summary->ResetCSS();
		$Application_Report_Summary->RowType = EWRPT_ROWTYPE_DETAIL;
		$Application_Report_Summary_summary->RenderRow();
?>
<?php

		// Accumulate page summary
		$Application_Report_Summary_summary->AccumulateSummary();

		// Get next record
		$Application_Report_Summary_summary->GetRow(2);

		// Show Footers
?>
<?php
	} // End detail records loop
?>
<?php
			$Application_Report_Summary->ResetCSS();
			$Application_Report_Summary->RowType = EWRPT_ROWTYPE_TOTAL;
			$Application_Report_Summary->RowTotalType = EWRPT_ROWTOTAL_GROUP;
			$Application_Report_Summary->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
			$Application_Report_Summary->RowGroupLevel = 1;
			$Application_Report_Summary_summary->RenderRow();
?>
	<tr<?php echo $Application_Report_Summary->RowAttributes(); ?>>
		<td colspan="5"<?php echo $Application_Report_Summary->app_submission_year->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSumHead") ?> <?php echo $Application_Report_Summary->app_submission_year->FldCaption() ?>: <?php echo $Application_Report_Summary->app_submission_year->GroupViewValue; ?> (<?php echo ewrpt_FormatNumber($Application_Report_Summary_summary->Cnt[1][0],0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php
			$Application_Report_Summary->ResetCSS();
			$Application_Report_Summary->app_amount->Count = $Application_Report_Summary_summary->Cnt[1][4];
			$Application_Report_Summary->app_amount->Summary = $Application_Report_Summary_summary->Smry[1][4]; // Load SUM
			$Application_Report_Summary->RowTotalSubType = EWRPT_ROWTOTAL_SUM;
			$Application_Report_Summary_summary->RenderRow();
?>
	<tr<?php echo $Application_Report_Summary->RowAttributes(); ?>>
		<td colspan="1"<?php echo $Application_Report_Summary->app_submission_year->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSum"); ?></td>
		<td<?php echo $Application_Report_Summary->app_submission_year->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Application_Report_Summary->app_submission_year->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Application_Report_Summary->app_submission_year->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Application_Report_Summary->app_submission_year->CellAttributes() ?>>
<div<?php echo $Application_Report_Summary->app_amount->ViewAttributes(); ?>><?php echo $Application_Report_Summary->app_amount->ListViewValue(); ?></div>
</td>
	</tr>
<?php
			$Application_Report_Summary->ResetCSS();
			$Application_Report_Summary->age->Count = $Application_Report_Summary_summary->Cnt[1][2];
			$Application_Report_Summary->age->Summary = ($Application_Report_Summary->age->Count > 0)? $Application_Report_Summary_summary->Smry[1][2]/$Application_Report_Summary->age->Count : 0; // Load AVG
			$Application_Report_Summary->RowTotalSubType = EWRPT_ROWTOTAL_AVG;
			$Application_Report_Summary_summary->RenderRow();
?>
	<tr<?php echo $Application_Report_Summary->RowAttributes(); ?>>
		<td colspan="1"<?php echo $Application_Report_Summary->app_submission_year->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptAvg"); ?></td>
		<td<?php echo $Application_Report_Summary->app_submission_year->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Application_Report_Summary->app_submission_year->CellAttributes() ?>>
<div<?php echo $Application_Report_Summary->age->ViewAttributes(); ?>><?php echo $Application_Report_Summary->age->ListViewValue(); ?></div>
</td>
		<td<?php echo $Application_Report_Summary->app_submission_year->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Application_Report_Summary->app_submission_year->CellAttributes() ?>>&nbsp;</td>
	</tr>
<?php
			$Application_Report_Summary->ResetCSS();
			$Application_Report_Summary->age->Count = $Application_Report_Summary_summary->Cnt[1][2];
			$Application_Report_Summary->age->Summary = $Application_Report_Summary_summary->Mn[1][2]; // Load MIN
			$Application_Report_Summary->RowTotalSubType = EWRPT_ROWTOTAL_MIN;
			$Application_Report_Summary_summary->RenderRow();
?>
	<tr<?php echo $Application_Report_Summary->RowAttributes(); ?>>
		<td colspan="1"<?php echo $Application_Report_Summary->app_submission_year->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptMin"); ?></td>
		<td<?php echo $Application_Report_Summary->app_submission_year->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Application_Report_Summary->app_submission_year->CellAttributes() ?>>
<div<?php echo $Application_Report_Summary->age->ViewAttributes(); ?>><?php echo $Application_Report_Summary->age->ListViewValue(); ?></div>
</td>
		<td<?php echo $Application_Report_Summary->app_submission_year->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Application_Report_Summary->app_submission_year->CellAttributes() ?>>&nbsp;</td>
	</tr>
<?php
			$Application_Report_Summary->ResetCSS();
			$Application_Report_Summary->age->Count = $Application_Report_Summary_summary->Cnt[1][2];
			$Application_Report_Summary->age->Summary = $Application_Report_Summary_summary->Mx[1][2]; // Load MAX
			$Application_Report_Summary->RowTotalSubType = EWRPT_ROWTOTAL_MAX;
			$Application_Report_Summary_summary->RenderRow();
?>
	<tr<?php echo $Application_Report_Summary->RowAttributes(); ?>>
		<td colspan="1"<?php echo $Application_Report_Summary->app_submission_year->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptMax"); ?></td>
		<td<?php echo $Application_Report_Summary->app_submission_year->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Application_Report_Summary->app_submission_year->CellAttributes() ?>>
<div<?php echo $Application_Report_Summary->age->ViewAttributes(); ?>><?php echo $Application_Report_Summary->age->ListViewValue(); ?></div>
</td>
		<td<?php echo $Application_Report_Summary->app_submission_year->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Application_Report_Summary->app_submission_year->CellAttributes() ?>>&nbsp;</td>
	</tr>
<?php

			// Reset level 1 summary
			$Application_Report_Summary_summary->ResetLevelSummary(1);
?>
<?php

	// Next group
	$Application_Report_Summary_summary->GetGrpRow(2);
	$Application_Report_Summary_summary->GrpCount++;
} // End while
?>
	</tbody>
	<tfoot>
<?php
if ($Application_Report_Summary_summary->TotalGrps > 0) {
	$Application_Report_Summary->ResetCSS();
	$Application_Report_Summary->RowType = EWRPT_ROWTYPE_TOTAL;
	$Application_Report_Summary->RowTotalType = EWRPT_ROWTOTAL_GRAND;
	$Application_Report_Summary->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
	$Application_Report_Summary->RowAttrs["class"] = "ewRptGrandSummary";
	$Application_Report_Summary_summary->RenderRow();
?>
	<!-- tr><td colspan="5"><span class="phpreportmaker">&nbsp;<br /></span></td></tr -->
	<tr<?php echo $Application_Report_Summary->RowAttributes(); ?>><td colspan="5"><?php echo $ReportLanguage->Phrase("RptGrandTotal") ?> (<?php echo ewrpt_FormatNumber($Application_Report_Summary_summary->TotCount,0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php
	$Application_Report_Summary->ResetCSS();
	$Application_Report_Summary->app_amount->Count = $Application_Report_Summary_summary->TotCount;
	$Application_Report_Summary->app_amount->Summary = $Application_Report_Summary_summary->GrandSmry[4]; // Load SUM
	$Application_Report_Summary->RowTotalSubType = EWRPT_ROWTOTAL_SUM;
	$Application_Report_Summary->app_amount->CurrentValue = $Application_Report_Summary->app_amount->Summary;
	$Application_Report_Summary->RowAttrs["class"] = "ewRptGrandSummary";
	$Application_Report_Summary_summary->RenderRow();
?>
	<tr<?php echo $Application_Report_Summary->RowAttributes(); ?>>
		<td colspan="1" class="ewRptGrpAggregate"><?php echo $ReportLanguage->Phrase("RptSum"); ?></td>
		<td<?php echo $Application_Report_Summary->programarea_name->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Application_Report_Summary->age->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Application_Report_Summary->application_status->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Application_Report_Summary->app_amount->CellAttributes() ?>>
<div<?php echo $Application_Report_Summary->app_amount->ViewAttributes(); ?>><?php echo $Application_Report_Summary->app_amount->ListViewValue(); ?></div>
</td>
	</tr>
<?php
	$Application_Report_Summary->ResetCSS();
	$Application_Report_Summary->age->Count = $Application_Report_Summary_summary->TotCount;
	$Application_Report_Summary->age->Summary = ($Application_Report_Summary->age->Count > 0) ? $Application_Report_Summary_summary->GrandSmry[2]/$Application_Report_Summary->age->Count : 0; // Load AVG
	$Application_Report_Summary->RowTotalSubType = EWRPT_ROWTOTAL_AVG;
	$Application_Report_Summary->age->CurrentValue = $Application_Report_Summary->age->Summary;
	$Application_Report_Summary->RowAttrs["class"] = "ewRptGrandSummary";
	$Application_Report_Summary_summary->RenderRow();
?>
	<tr<?php echo $Application_Report_Summary->RowAttributes(); ?>>
		<td colspan="1" class="ewRptGrpAggregate"><?php echo $ReportLanguage->Phrase("RptAvg"); ?></td>
		<td<?php echo $Application_Report_Summary->programarea_name->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Application_Report_Summary->age->CellAttributes() ?>>
<div<?php echo $Application_Report_Summary->age->ViewAttributes(); ?>><?php echo $Application_Report_Summary->age->ListViewValue(); ?></div>
</td>
		<td<?php echo $Application_Report_Summary->application_status->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Application_Report_Summary->app_amount->CellAttributes() ?>>&nbsp;</td>
	</tr>
<?php
	$Application_Report_Summary->ResetCSS();
	$Application_Report_Summary->age->Count = $Application_Report_Summary_summary->TotCount;
	$Application_Report_Summary->age->Summary = $Application_Report_Summary_summary->GrandMn[2]; // Load MIN
	$Application_Report_Summary->RowTotalSubType = EWRPT_ROWTOTAL_MIN;
	$Application_Report_Summary->age->CurrentValue = $Application_Report_Summary->age->Summary;
	$Application_Report_Summary->RowAttrs["class"] = "ewRptGrandSummary";
	$Application_Report_Summary_summary->RenderRow();
?>
	<tr<?php echo $Application_Report_Summary->RowAttributes(); ?>>
		<td colspan="1" class="ewRptGrpAggregate"><?php echo $ReportLanguage->Phrase("RptMin"); ?></td>
		<td<?php echo $Application_Report_Summary->programarea_name->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Application_Report_Summary->age->CellAttributes() ?>>
<div<?php echo $Application_Report_Summary->age->ViewAttributes(); ?>><?php echo $Application_Report_Summary->age->ListViewValue(); ?></div>
</td>
		<td<?php echo $Application_Report_Summary->application_status->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Application_Report_Summary->app_amount->CellAttributes() ?>>&nbsp;</td>
	</tr>
<?php
	$Application_Report_Summary->ResetCSS();
	$Application_Report_Summary->age->Count = $Application_Report_Summary_summary->TotCount;
	$Application_Report_Summary->age->Summary = $Application_Report_Summary_summary->GrandMx[2]; // Load MAX
	$Application_Report_Summary->RowTotalSubType = EWRPT_ROWTOTAL_MAX;
	$Application_Report_Summary->age->CurrentValue = $Application_Report_Summary->age->Summary;
	$Application_Report_Summary->RowAttrs["class"] = "ewRptGrandSummary";
	$Application_Report_Summary_summary->RenderRow();
?>
	<tr<?php echo $Application_Report_Summary->RowAttributes(); ?>>
		<td colspan="1" class="ewRptGrpAggregate"><?php echo $ReportLanguage->Phrase("RptMax"); ?></td>
		<td<?php echo $Application_Report_Summary->programarea_name->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Application_Report_Summary->age->CellAttributes() ?>>
<div<?php echo $Application_Report_Summary->age->ViewAttributes(); ?>><?php echo $Application_Report_Summary->age->ListViewValue(); ?></div>
</td>
		<td<?php echo $Application_Report_Summary->application_status->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Application_Report_Summary->app_amount->CellAttributes() ?>>&nbsp;</td>
	</tr>
<?php } ?>
	</tfoot>
</table>
</div>
<div class="ewGridLowerPanel">
<form action="Application_Report_Summarysmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($Application_Report_Summary_summary->StartGrp, $Application_Report_Summary_summary->DisplayGrps, $Application_Report_Summary_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="Application_Report_Summarysmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="Application_Report_Summarysmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="Application_Report_Summarysmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="Application_Report_Summarysmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($Application_Report_Summary_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($Application_Report_Summary_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($Application_Report_Summary_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($Application_Report_Summary_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($Application_Report_Summary_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($Application_Report_Summary_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($Application_Report_Summary_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($Application_Report_Summary_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($Application_Report_Summary_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($Application_Report_Summary_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($Application_Report_Summary->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
<?php $Application_Report_Summary_summary->ShowPageFooter(); ?>
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
$Application_Report_Summary_summary->Page_Terminate();
?>
<?php

//
// Page class
//
class crApplication_Report_Summary_summary {

	// Page ID
	var $PageID = 'summary';

	// Table name
	var $TableName = 'Application Report Summary';

	// Page object name
	var $PageObjName = 'Application_Report_Summary_summary';

	// Page name
	function PageName() {
		return ewrpt_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewrpt_CurrentPage() . "?";
		global $Application_Report_Summary;
		if ($Application_Report_Summary->UseTokenInUrl) $PageUrl .= "t=" . $Application_Report_Summary->TableVar . "&"; // Add page token
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
		global $Application_Report_Summary;
		if ($Application_Report_Summary->UseTokenInUrl) {
			if (ewrpt_IsHttpPost())
				return ($Application_Report_Summary->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($Application_Report_Summary->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crApplication_Report_Summary_summary() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Table object (Application_Report_Summary)
		$GLOBALS["Application_Report_Summary"] = new crApplication_Report_Summary();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Page ID
		if (!defined("EWRPT_PAGE_ID"))
			define("EWRPT_PAGE_ID", 'summary', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWRPT_TABLE_NAME"))
			define("EWRPT_TABLE_NAME", 'Application Report Summary', TRUE);

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
		global $Application_Report_Summary;

	// Get export parameters
	if (@$_GET["export"] <> "") {
		$Application_Report_Summary->Export = $_GET["export"];
	}
	$gsExport = $Application_Report_Summary->Export; // Get export parameter, used in header
	$gsExportFile = $Application_Report_Summary->TableVar; // Get export file, used in header

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
		global $Application_Report_Summary;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export to Email (use ob_file_contents for PHP)
		if ($Application_Report_Summary->Export == "email") {
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
		global $Application_Report_Summary;
		global $rs;
		global $rsgrp;
		global $gsFormError;

		// Aggregate variables
		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of fields

		$nDtls = 5;
		$nGrps = 2;
		$this->Val = ewrpt_InitArray($nDtls, 0);
		$this->Cnt = ewrpt_Init2DArray($nGrps, $nDtls, 0);
		$this->Smry = ewrpt_Init2DArray($nGrps, $nDtls, 0);
		$this->Mn = ewrpt_Init2DArray($nGrps, $nDtls, NULL);
		$this->Mx = ewrpt_Init2DArray($nGrps, $nDtls, NULL);
		$this->GrandSmry = ewrpt_InitArray($nDtls, 0);
		$this->GrandMn = ewrpt_InitArray($nDtls, NULL);
		$this->GrandMx = ewrpt_InitArray($nDtls, NULL);

		// Set up if accumulation required
		$this->Col = array(FALSE, FALSE, TRUE, FALSE, TRUE);

		// Set up groups per page dynamically
		$this->SetUpDisplayGrps();
		$Application_Report_Summary->app_submission_year->SelectionList = "";
		$Application_Report_Summary->app_submission_year->DefaultSelectionList = "";
		$Application_Report_Summary->app_submission_year->ValueList = "";

		// Load default filter values
		$this->LoadDefaultFilters();

		// Set up popup filter
		$this->SetupPopup();

		// Extended filter
		$sExtendedFilter = "";

		// Get dropdown values
		$this->GetExtendedFilterValues();

		// Load custom filters
		$Application_Report_Summary->CustomFilters_Load();

		// Build extended filter
		$sExtendedFilter = $this->GetExtendedFilter();
		if ($sExtendedFilter <> "") {
			if ($this->Filter <> "")
  				$this->Filter = "($this->Filter) AND ($sExtendedFilter)";
			else
				$this->Filter = $sExtendedFilter;
		}

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

		// Get total group count
		$sGrpSort = ewrpt_UpdateSortFields($Application_Report_Summary->SqlOrderByGroup(), $this->Sort, 2); // Get grouping field only
		$sSql = ewrpt_BuildReportSql($Application_Report_Summary->SqlSelectGroup(), $Application_Report_Summary->SqlWhere(), $Application_Report_Summary->SqlGroupBy(), $Application_Report_Summary->SqlHaving(), $Application_Report_Summary->SqlOrderByGroup(), $this->Filter, $sGrpSort);
		$this->TotalGrps = $this->GetGrpCnt($sSql);
		if ($this->DisplayGrps <= 0) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowFirstHeader = ($this->TotalGrps > 0);

		//$this->ShowFirstHeader = TRUE; // Uncomment to always show header
		// Set up start position if not export all

		if ($Application_Report_Summary->ExportAll && $Application_Report_Summary->Export <> "")
		    $this->DisplayGrps = $this->TotalGrps;
		else
			$this->SetUpStartGroup(); 

		// Get current page groups
		$rsgrp = $this->GetGrpRs($sSql, $this->StartGrp, $this->DisplayGrps);

		// Init detail recordset
		$rs = NULL;
	}

	// Check level break
	function ChkLvlBreak($lvl) {
		global $Application_Report_Summary;
		switch ($lvl) {
			case 1:
				return (is_null($Application_Report_Summary->app_submission_year->CurrentValue) && !is_null($Application_Report_Summary->app_submission_year->OldValue)) ||
					(!is_null($Application_Report_Summary->app_submission_year->CurrentValue) && is_null($Application_Report_Summary->app_submission_year->OldValue)) ||
					($Application_Report_Summary->app_submission_year->GroupValue() <> $Application_Report_Summary->app_submission_year->GroupOldValue());
		}
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

	// Get group count
	function GetGrpCnt($sql) {
		global $conn;
		global $Application_Report_Summary;
		$rsgrpcnt = $conn->Execute($sql);
		$grpcnt = ($rsgrpcnt) ? $rsgrpcnt->RecordCount() : 0;
		if ($rsgrpcnt) $rsgrpcnt->Close();
		return $grpcnt;
	}

	// Get group rs
	function GetGrpRs($sql, $start, $grps) {
		global $conn;
		global $Application_Report_Summary;
		$wrksql = $sql;
		if ($start > 0 && $grps > -1)
			$wrksql .= " LIMIT " . ($start-1) . ", " . ($grps);
		$rswrk = $conn->Execute($wrksql);
		return $rswrk;
	}

	// Get group row values
	function GetGrpRow($opt) {
		global $rsgrp;
		global $Application_Report_Summary;
		if (!$rsgrp)
			return;
		if ($opt == 1) { // Get first group

			//$rsgrp->MoveFirst(); // NOTE: no need to move position
			$Application_Report_Summary->app_submission_year->setDbValue(""); // Init first value
		} else { // Get next group
			$rsgrp->MoveNext();
		}
		if (!$rsgrp->EOF)
			$Application_Report_Summary->app_submission_year->setDbValue($rsgrp->fields[0]);
		if ($rsgrp->EOF) {
			$Application_Report_Summary->app_submission_year->setDbValue("");
		}
	}

	// Get row values
	function GetRow($opt) {
		global $rs;
		global $Application_Report_Summary;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row

	//		$rs->MoveFirst(); // NOTE: no need to move position
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$Application_Report_Summary->student_applicant_id->setDbValue($rs->fields('student_applicant_id'));
			if ($opt <> 1) {
				if (is_array($Application_Report_Summary->app_submission_year->GroupDbValues))
					$Application_Report_Summary->app_submission_year->setDbValue(@$Application_Report_Summary->app_submission_year->GroupDbValues[$rs->fields('app_submission_year')]);
				else
					$Application_Report_Summary->app_submission_year->setDbValue(ewrpt_GroupValue($Application_Report_Summary->app_submission_year, $rs->fields('app_submission_year')));
			}
			$Application_Report_Summary->programarea_name->setDbValue($rs->fields('programarea_name'));
			$Application_Report_Summary->student_lastname->setDbValue($rs->fields('student_lastname'));
			$Application_Report_Summary->student_firstname->setDbValue($rs->fields('student_firstname'));
			$Application_Report_Summary->student_middlename->setDbValue($rs->fields('student_middlename'));
			$Application_Report_Summary->student_gender->setDbValue($rs->fields('student_gender'));
			$Application_Report_Summary->student_dob->setDbValue($rs->fields('student_dob'));
			$Application_Report_Summary->age->setDbValue($rs->fields('age'));
			$Application_Report_Summary->student_telephone_1->setDbValue($rs->fields('student_telephone_1'));
			$Application_Report_Summary->student_telephone_2->setDbValue($rs->fields('student_telephone_2'));
			$Application_Report_Summary->student_address->setDbValue($rs->fields('student_address'));
			$Application_Report_Summary->community->setDbValue($rs->fields('community'));
			$Application_Report_Summary->app_mother_name->setDbValue($rs->fields('app_mother_name'));
			$Application_Report_Summary->app_father_name->setDbValue($rs->fields('app_father_name'));
			$Application_Report_Summary->app_father_occupation->setDbValue($rs->fields('app_father_occupation'));
			$Application_Report_Summary->app_father_isalive->setDbValue($rs->fields('app_father_isalive'));
			$Application_Report_Summary->app_mother_isalive->setDbValue($rs->fields('app_mother_isalive'));
			$Application_Report_Summary->app_mother_occupation->setDbValue($rs->fields('app_mother_occupation'));
			$Application_Report_Summary->app_guardian_name->setDbValue($rs->fields('app_guardian_name'));
			$Application_Report_Summary->app_guardian_relation->setDbValue($rs->fields('app_guardian_relation'));
			$Application_Report_Summary->app_guardian_occupation->setDbValue($rs->fields('app_guardian_occupation'));
			$Application_Report_Summary->student_picture->setDbValue($rs->fields('student_picture'));
			$Application_Report_Summary->student_grades->setDbValue($rs->fields('student_grades'));
			$Application_Report_Summary->applicant_school_name->setDbValue($rs->fields('applicant_school_name'));
			$Application_Report_Summary->app_points->setDbValue($rs->fields('app_points'));
			$Application_Report_Summary->sponsored_child_no->setDbValue($rs->fields('sponsored_child_no'));
			$Application_Report_Summary->school_name->setDbValue($rs->fields('school_name'));
			$Application_Report_Summary->application_status->setDbValue($rs->fields('application_status'));
			$Application_Report_Summary->name->setDbValue($rs->fields('name'));
			$Application_Report_Summary->app_amount->setDbValue($rs->fields('app_amount'));
			$Application_Report_Summary->app_referees->setDbValue($rs->fields('app_referees'));
			$Application_Report_Summary->app_grant_id->setDbValue($rs->fields('app_grant_id'));
			$Application_Report_Summary->student_admitted_school_id->setDbValue($rs->fields('student_admitted_school_id'));
			$Application_Report_Summary->community_community_id->setDbValue($rs->fields('community_community_id'));
			$Application_Report_Summary->app_status->setDbValue($rs->fields('app_status'));
			$Application_Report_Summary->app_primary_school_id->setDbValue($rs->fields('app_primary_school_id'));
			$Application_Report_Summary->app_junior_secondary_id->setDbValue($rs->fields('app_junior_secondary_id'));
			$Application_Report_Summary->student_resident_programarea_id->setDbValue($rs->fields('student_resident_programarea_id'));
			$this->Val[1] = $Application_Report_Summary->programarea_name->CurrentValue;
			$this->Val[2] = $Application_Report_Summary->age->CurrentValue;
			$this->Val[3] = $Application_Report_Summary->application_status->CurrentValue;
			$this->Val[4] = $Application_Report_Summary->app_amount->CurrentValue;
		} else {
			$Application_Report_Summary->student_applicant_id->setDbValue("");
			$Application_Report_Summary->app_submission_year->setDbValue("");
			$Application_Report_Summary->programarea_name->setDbValue("");
			$Application_Report_Summary->student_lastname->setDbValue("");
			$Application_Report_Summary->student_firstname->setDbValue("");
			$Application_Report_Summary->student_middlename->setDbValue("");
			$Application_Report_Summary->student_gender->setDbValue("");
			$Application_Report_Summary->student_dob->setDbValue("");
			$Application_Report_Summary->age->setDbValue("");
			$Application_Report_Summary->student_telephone_1->setDbValue("");
			$Application_Report_Summary->student_telephone_2->setDbValue("");
			$Application_Report_Summary->student_address->setDbValue("");
			$Application_Report_Summary->community->setDbValue("");
			$Application_Report_Summary->app_mother_name->setDbValue("");
			$Application_Report_Summary->app_father_name->setDbValue("");
			$Application_Report_Summary->app_father_occupation->setDbValue("");
			$Application_Report_Summary->app_father_isalive->setDbValue("");
			$Application_Report_Summary->app_mother_isalive->setDbValue("");
			$Application_Report_Summary->app_mother_occupation->setDbValue("");
			$Application_Report_Summary->app_guardian_name->setDbValue("");
			$Application_Report_Summary->app_guardian_relation->setDbValue("");
			$Application_Report_Summary->app_guardian_occupation->setDbValue("");
			$Application_Report_Summary->student_picture->setDbValue("");
			$Application_Report_Summary->student_grades->setDbValue("");
			$Application_Report_Summary->applicant_school_name->setDbValue("");
			$Application_Report_Summary->app_points->setDbValue("");
			$Application_Report_Summary->sponsored_child_no->setDbValue("");
			$Application_Report_Summary->school_name->setDbValue("");
			$Application_Report_Summary->application_status->setDbValue("");
			$Application_Report_Summary->name->setDbValue("");
			$Application_Report_Summary->app_amount->setDbValue("");
			$Application_Report_Summary->app_referees->setDbValue("");
			$Application_Report_Summary->app_grant_id->setDbValue("");
			$Application_Report_Summary->student_admitted_school_id->setDbValue("");
			$Application_Report_Summary->community_community_id->setDbValue("");
			$Application_Report_Summary->app_status->setDbValue("");
			$Application_Report_Summary->app_primary_school_id->setDbValue("");
			$Application_Report_Summary->app_junior_secondary_id->setDbValue("");
			$Application_Report_Summary->student_resident_programarea_id->setDbValue("");
		}
	}

	//  Set up starting group
	function SetUpStartGroup() {
		global $Application_Report_Summary;

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;

		// Check for a 'start' parameter
		if (@$_GET[EWRPT_TABLE_START_GROUP] != "") {
			$this->StartGrp = $_GET[EWRPT_TABLE_START_GROUP];
			$Application_Report_Summary->setStartGroup($this->StartGrp);
		} elseif (@$_GET["pageno"] != "") {
			$nPageNo = $_GET["pageno"];
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$Application_Report_Summary->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $Application_Report_Summary->getStartGroup();
			}
		} else {
			$this->StartGrp = $Application_Report_Summary->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$Application_Report_Summary->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$Application_Report_Summary->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$Application_Report_Summary->setStartGroup($this->StartGrp);
		}
	}

	// Set up popup
	function SetupPopup() {
		global $conn, $ReportLanguage;
		global $Application_Report_Summary;

		// Initialize popup
		// Build distinct values for app_submission_year

		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Application_Report_Summary->app_submission_year->SqlSelect, $Application_Report_Summary->SqlWhere(), $Application_Report_Summary->SqlGroupBy(), $Application_Report_Summary->SqlHaving(), $Application_Report_Summary->app_submission_year->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Application_Report_Summary->app_submission_year->setDbValue($rswrk->fields[0]);
			if (is_null($Application_Report_Summary->app_submission_year->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Application_Report_Summary->app_submission_year->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Application_Report_Summary->app_submission_year->GroupViewValue = ewrpt_DisplayGroupValue($Application_Report_Summary->app_submission_year,$Application_Report_Summary->app_submission_year->GroupValue());
				ewrpt_SetupDistinctValues($Application_Report_Summary->app_submission_year->ValueList, $Application_Report_Summary->app_submission_year->GroupValue(), $Application_Report_Summary->app_submission_year->GroupViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Application_Report_Summary->app_submission_year->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Application_Report_Summary->app_submission_year->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Process post back form
		if (ewrpt_IsHttpPost()) {
			$sName = @$_POST["popup"]; // Get popup form name
			if ($sName <> "") {
				$cntValues = (is_array(@$_POST["sel_$sName"])) ? count($_POST["sel_$sName"]) : 0;
				if ($cntValues > 0) {
					$arValues = ewrpt_StripSlashes($_POST["sel_$sName"]);
					if (trim($arValues[0]) == "") // Select all
						$arValues = EWRPT_INIT_VALUE;
					if (!ewrpt_MatchedArray($arValues, $_SESSION["sel_$sName"])) {
						if ($this->HasSessionFilterValues($sName))
							$this->ClearExtFilter = $sName; // Clear extended filter for this field
					}
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
				$this->ResetPager();
			}
		}

		// Load selection criteria to array
		// Get Year selected values

		if (is_array(@$_SESSION["sel_Application_Report_Summary_app_submission_year"])) {
			$this->LoadSelectionFromSession('app_submission_year');
		} elseif (@$_SESSION["sel_Application_Report_Summary_app_submission_year"] == EWRPT_INIT_VALUE) { // Select all
			$Application_Report_Summary->app_submission_year->SelectionList = "";
		}
	}

	// Reset pager
	function ResetPager() {

		// Reset start position (reset command)
		global $Application_Report_Summary;
		$this->StartGrp = 1;
		$Application_Report_Summary->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		global $Application_Report_Summary;
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
			$Application_Report_Summary->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$Application_Report_Summary->setStartGroup($this->StartGrp);
		} else {
			if ($Application_Report_Summary->getGroupPerPage() <> "") {
				$this->DisplayGrps = $Application_Report_Summary->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	function RenderRow() {
		global $conn, $rs, $Security;
		global $Application_Report_Summary;
		if ($Application_Report_Summary->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total

			// Get total count from sql directly
			$sSql = ewrpt_BuildReportSql($Application_Report_Summary->SqlSelectCount(), $Application_Report_Summary->SqlWhere(), $Application_Report_Summary->SqlGroupBy(), $Application_Report_Summary->SqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
			} else {
				$this->TotCount = 0;
			}

			// Get total from sql directly
			$sSql = ewrpt_BuildReportSql($Application_Report_Summary->SqlSelectAgg(), $Application_Report_Summary->SqlWhere(), $Application_Report_Summary->SqlGroupBy(), $Application_Report_Summary->SqlHaving(), "", $this->Filter, "");
			$sSql = $Application_Report_Summary->SqlAggPfx() . $sSql . $Application_Report_Summary->SqlAggSfx();
			$rsagg = $conn->Execute($sSql);
			if ($rsagg) {
				$this->GrandSmry[2] = $rsagg->fields("sum_age");
				$this->GrandMn[2] = $rsagg->fields("min_age");
				$this->GrandMx[2] = $rsagg->fields("max_age");
				$this->GrandSmry[4] = $rsagg->fields("sum_app_amount");
				$rsagg->Close();
			} else {

				// Accumulate grand summary from detail records
				$sSql = ewrpt_BuildReportSql($Application_Report_Summary->SqlSelect(), $Application_Report_Summary->SqlWhere(), $Application_Report_Summary->SqlGroupBy(), $Application_Report_Summary->SqlHaving(), "", $this->Filter, "");
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
		$Application_Report_Summary->Row_Rendering();

		//
		// Render view codes
		//

		if ($Application_Report_Summary->RowType == EWRPT_ROWTYPE_TOTAL) { // Summary row

			// app_submission_year
			$Application_Report_Summary->app_submission_year->GroupViewValue = $Application_Report_Summary->app_submission_year->GroupOldValue();
			$Application_Report_Summary->app_submission_year->CellAttrs["class"] = ($Application_Report_Summary->RowGroupLevel == 1) ? "ewRptGrpSummary1" : "ewRptGrpField1";
			$Application_Report_Summary->app_submission_year->GroupViewValue = ewrpt_DisplayGroupValue($Application_Report_Summary->app_submission_year, $Application_Report_Summary->app_submission_year->GroupViewValue);

			// programarea_name
			$Application_Report_Summary->programarea_name->ViewValue = $Application_Report_Summary->programarea_name->Summary;

			// age
			$Application_Report_Summary->age->ViewValue = $Application_Report_Summary->age->Summary;

			// application_status
			$Application_Report_Summary->application_status->ViewValue = $Application_Report_Summary->application_status->Summary;

			// app_amount
			$Application_Report_Summary->app_amount->ViewValue = $Application_Report_Summary->app_amount->Summary;
			$Application_Report_Summary->app_amount->ViewValue = ewrpt_FormatNumber($Application_Report_Summary->app_amount->ViewValue, 0, -2, -2, -2);
			$Application_Report_Summary->app_amount->ViewAttrs["style"] = "text-align:right;";
		} else {

			// app_submission_year
			$Application_Report_Summary->app_submission_year->GroupViewValue = $Application_Report_Summary->app_submission_year->GroupValue();
			$Application_Report_Summary->app_submission_year->CellAttrs["class"] = "ewRptGrpField1";
			$Application_Report_Summary->app_submission_year->GroupViewValue = ewrpt_DisplayGroupValue($Application_Report_Summary->app_submission_year, $Application_Report_Summary->app_submission_year->GroupViewValue);
			if ($Application_Report_Summary->app_submission_year->GroupValue() == $Application_Report_Summary->app_submission_year->GroupOldValue() && !$this->ChkLvlBreak(1))
				$Application_Report_Summary->app_submission_year->GroupViewValue = "&nbsp;";

			// programarea_name
			$Application_Report_Summary->programarea_name->ViewValue = $Application_Report_Summary->programarea_name->CurrentValue;
			$Application_Report_Summary->programarea_name->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// age
			$Application_Report_Summary->age->ViewValue = $Application_Report_Summary->age->CurrentValue;
			$Application_Report_Summary->age->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// application_status
			$Application_Report_Summary->application_status->ViewValue = $Application_Report_Summary->application_status->CurrentValue;
			$Application_Report_Summary->application_status->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// app_amount
			$Application_Report_Summary->app_amount->ViewValue = $Application_Report_Summary->app_amount->CurrentValue;
			$Application_Report_Summary->app_amount->ViewValue = ewrpt_FormatNumber($Application_Report_Summary->app_amount->ViewValue, 0, -2, -2, -2);
			$Application_Report_Summary->app_amount->ViewAttrs["style"] = "text-align:right;";
			$Application_Report_Summary->app_amount->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
		}

		// app_submission_year
		$Application_Report_Summary->app_submission_year->HrefValue = "";

		// programarea_name
		$Application_Report_Summary->programarea_name->HrefValue = "";

		// age
		$Application_Report_Summary->age->HrefValue = "";

		// application_status
		$Application_Report_Summary->application_status->HrefValue = "";

		// app_amount
		$Application_Report_Summary->app_amount->HrefValue = "";

		// Call Row_Rendered event
		$Application_Report_Summary->Row_Rendered();
	}

	// Get extended filter values
	function GetExtendedFilterValues() {
		global $Application_Report_Summary;

		// Field programarea_name
		$sSelect = "SELECT DISTINCT programarea.programarea_name FROM " . $Application_Report_Summary->SqlFrom();
		$sOrderBy = "programarea.programarea_name ASC";
		$wrkSql = ewrpt_BuildReportSql($sSelect, $Application_Report_Summary->SqlWhere(), "", "", $sOrderBy, $this->UserIDFilter, "");
		$Application_Report_Summary->programarea_name->DropDownList = ewrpt_GetDistinctValues("", $wrkSql);

		// Field student_gender
		$sSelect = "SELECT DISTINCT student_applicant.student_gender FROM " . $Application_Report_Summary->SqlFrom();
		$sOrderBy = "student_applicant.student_gender ASC";
		$wrkSql = ewrpt_BuildReportSql($sSelect, $Application_Report_Summary->SqlWhere(), "", "", $sOrderBy, $this->UserIDFilter, "");
		$Application_Report_Summary->student_gender->DropDownList = ewrpt_GetDistinctValues("", $wrkSql);

		// Field application_status
		$sSelect = "SELECT DISTINCT application_status.application_status FROM " . $Application_Report_Summary->SqlFrom();
		$sOrderBy = "application_status.application_status ASC";
		$wrkSql = ewrpt_BuildReportSql($sSelect, $Application_Report_Summary->SqlWhere(), "", "", $sOrderBy, $this->UserIDFilter, "");
		$Application_Report_Summary->application_status->DropDownList = ewrpt_GetDistinctValues("", $wrkSql);

		// Field name
		$sSelect = "SELECT DISTINCT grant_package.name FROM " . $Application_Report_Summary->SqlFrom();
		$sOrderBy = "grant_package.name ASC";
		$wrkSql = ewrpt_BuildReportSql($sSelect, $Application_Report_Summary->SqlWhere(), "", "", $sOrderBy, $this->UserIDFilter, "");
		$Application_Report_Summary->name->DropDownList = ewrpt_GetDistinctValues("", $wrkSql);
	}

	// Return extended filter
	function GetExtendedFilter() {
		global $Application_Report_Summary;
		global $gsFormError;
		$sFilter = "";
		$bPostBack = ewrpt_IsHttpPost();
		$bRestoreSession = TRUE;
		$bSetupFilter = FALSE;

		// Reset extended filter if filter changed
		if ($bPostBack) {

		// Reset search command
		} elseif (@$_GET["cmd"] == "reset") {

			// Load default values
			// Field programarea_name

			$this->SetSessionDropDownValue($Application_Report_Summary->programarea_name->DropDownValue, 'programarea_name');

			// Field student_gender
			$this->SetSessionDropDownValue($Application_Report_Summary->student_gender->DropDownValue, 'student_gender');

			// Field application_status
			$this->SetSessionDropDownValue($Application_Report_Summary->application_status->DropDownValue, 'application_status');

			// Field name
			$this->SetSessionDropDownValue($Application_Report_Summary->name->DropDownValue, 'name');
			$bSetupFilter = TRUE;
		} else {

			// Field programarea_name
			if ($this->GetDropDownValue($Application_Report_Summary->programarea_name->DropDownValue, 'programarea_name')) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			} elseif ($Application_Report_Summary->programarea_name->DropDownValue <> EWRPT_INIT_VALUE && !isset($_SESSION['sv_Application_Report_Summary->programarea_name'])) {
				$bSetupFilter = TRUE;
			}

			// Field student_gender
			if ($this->GetDropDownValue($Application_Report_Summary->student_gender->DropDownValue, 'student_gender')) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			} elseif ($Application_Report_Summary->student_gender->DropDownValue <> EWRPT_INIT_VALUE && !isset($_SESSION['sv_Application_Report_Summary->student_gender'])) {
				$bSetupFilter = TRUE;
			}

			// Field application_status
			if ($this->GetDropDownValue($Application_Report_Summary->application_status->DropDownValue, 'application_status')) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			} elseif ($Application_Report_Summary->application_status->DropDownValue <> EWRPT_INIT_VALUE && !isset($_SESSION['sv_Application_Report_Summary->application_status'])) {
				$bSetupFilter = TRUE;
			}

			// Field name
			if ($this->GetDropDownValue($Application_Report_Summary->name->DropDownValue, 'name')) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			} elseif ($Application_Report_Summary->name->DropDownValue <> EWRPT_INIT_VALUE && !isset($_SESSION['sv_Application_Report_Summary->name'])) {
				$bSetupFilter = TRUE;
			}
			if (!$this->ValidateForm()) {
				$this->setMessage($gsFormError);
				return $sFilter;
			}
		}

		// Restore session
		if ($bRestoreSession) {

			// Field programarea_name
			$this->GetSessionDropDownValue($Application_Report_Summary->programarea_name);

			// Field student_gender
			$this->GetSessionDropDownValue($Application_Report_Summary->student_gender);

			// Field application_status
			$this->GetSessionDropDownValue($Application_Report_Summary->application_status);

			// Field name
			$this->GetSessionDropDownValue($Application_Report_Summary->name);
		}

		// Call page filter validated event
		$Application_Report_Summary->Page_FilterValidated();

		// Build SQL
		// Field programarea_name

		$this->BuildDropDownFilter($Application_Report_Summary->programarea_name, $sFilter, "");

		// Field student_gender
		$this->BuildDropDownFilter($Application_Report_Summary->student_gender, $sFilter, "");

		// Field application_status
		$this->BuildDropDownFilter($Application_Report_Summary->application_status, $sFilter, "");

		// Field name
		$this->BuildDropDownFilter($Application_Report_Summary->name, $sFilter, "");

		// Save parms to session
		// Field programarea_name

		$this->SetSessionDropDownValue($Application_Report_Summary->programarea_name->DropDownValue, 'programarea_name');

		// Field student_gender
		$this->SetSessionDropDownValue($Application_Report_Summary->student_gender->DropDownValue, 'student_gender');

		// Field application_status
		$this->SetSessionDropDownValue($Application_Report_Summary->application_status->DropDownValue, 'application_status');

		// Field name
		$this->SetSessionDropDownValue($Application_Report_Summary->name->DropDownValue, 'name');

		// Setup filter
		if ($bSetupFilter) {
		}
		return $sFilter;
	}

	// Get drop down value from querystring
	function GetDropDownValue(&$sv, $parm) {
		if (ewrpt_IsHttpPost())
			return FALSE; // Skip post back
		if (isset($_GET["sv_$parm"])) {
			$sv = ewrpt_StripSlashes($_GET["sv_$parm"]);
			return TRUE;
		}
		return FALSE;
	}

	// Get filter values from querystring
	function GetFilterValues(&$fld) {
		$parm = substr($fld->FldVar, 2);
		if (ewrpt_IsHttpPost())
			return; // Skip post back
		$got = FALSE;
		if (isset($_GET["sv1_$parm"])) {
			$fld->SearchValue = ewrpt_StripSlashes($_GET["sv1_$parm"]);
			$got = TRUE;
		}
		if (isset($_GET["so1_$parm"])) {
			$fld->SearchOperator = ewrpt_StripSlashes($_GET["so1_$parm"]);
			$got = TRUE;
		}
		if (isset($_GET["sc_$parm"])) {
			$fld->SearchCondition = ewrpt_StripSlashes($_GET["sc_$parm"]);
			$got = TRUE;
		}
		if (isset($_GET["sv2_$parm"])) {
			$fld->SearchValue2 = ewrpt_StripSlashes($_GET["sv2_$parm"]);
			$got = TRUE;
		}
		if (isset($_GET["so2_$parm"])) {
			$fld->SearchOperator2 = ewrpt_StripSlashes($_GET["so2_$parm"]);
			$got = TRUE;
		}
		return $got;
	}

	// Set default ext filter
	function SetDefaultExtFilter(&$fld, $so1, $sv1, $sc, $so2, $sv2) {
		$fld->DefaultSearchValue = $sv1; // Default ext filter value 1
		$fld->DefaultSearchValue2 = $sv2; // Default ext filter value 2 (if operator 2 is enabled)
		$fld->DefaultSearchOperator = $so1; // Default search operator 1
		$fld->DefaultSearchOperator2 = $so2; // Default search operator 2 (if operator 2 is enabled)
		$fld->DefaultSearchCondition = $sc; // Default search condition (if operator 2 is enabled)
	}

	// Apply default ext filter
	function ApplyDefaultExtFilter(&$fld) {
		$fld->SearchValue = $fld->DefaultSearchValue;
		$fld->SearchValue2 = $fld->DefaultSearchValue2;
		$fld->SearchOperator = $fld->DefaultSearchOperator;
		$fld->SearchOperator2 = $fld->DefaultSearchOperator2;
		$fld->SearchCondition = $fld->DefaultSearchCondition;
	}

	// Check if Text Filter applied
	function TextFilterApplied(&$fld) {
		return (strval($fld->SearchValue) <> strval($fld->DefaultSearchValue) ||
			strval($fld->SearchValue2) <> strval($fld->DefaultSearchValue2) ||
			(strval($fld->SearchValue) <> "" &&
				strval($fld->SearchOperator) <> strval($fld->DefaultSearchOperator)) ||
			(strval($fld->SearchValue2) <> "" &&
				strval($fld->SearchOperator2) <> strval($fld->DefaultSearchOperator2)) ||
			strval($fld->SearchCondition) <> strval($fld->DefaultSearchCondition));
	}

	// Check if Non-Text Filter applied
	function NonTextFilterApplied(&$fld) {
		if (is_array($fld->DefaultDropDownValue) && is_array($fld->DropDownValue)) {
			if (count($fld->DefaultDropDownValue) <> count($fld->DropDownValue))
				return TRUE;
			else
				return (count(array_diff($fld->DefaultDropDownValue, $fld->DropDownValue)) <> 0);
		}
		else {
			$v1 = strval($fld->DefaultDropDownValue);
			if ($v1 == EWRPT_INIT_VALUE)
				$v1 = "";
			$v2 = strval($fld->DropDownValue);
			if ($v2 == EWRPT_INIT_VALUE || $v2 == EWRPT_ALL_VALUE)
				$v2 = "";
			return ($v1 <> $v2);
		}
	}

	// Load selection from a filter clause
	function LoadSelectionFromFilter(&$fld, $filter, &$sel) {
		$sel = "";
		if ($filter <> "") {
			$sSql = ewrpt_BuildReportSql($fld->SqlSelect, "", "", "", $fld->SqlOrderBy, $filter, "");
			ewrpt_LoadArrayFromSql($sSql, $sel);
		}
	}

	// Get dropdown value from session
	function GetSessionDropDownValue(&$fld) {
		$parm = substr($fld->FldVar, 2);
		$this->GetSessionValue($fld->DropDownValue, 'sv_Application_Report_Summary_' . $parm);
	}

	// Get filter values from session
	function GetSessionFilterValues(&$fld) {
		$parm = substr($fld->FldVar, 2);
		$this->GetSessionValue($fld->SearchValue, 'sv1_Application_Report_Summary_' . $parm);
		$this->GetSessionValue($fld->SearchOperator, 'so1_Application_Report_Summary_' . $parm);
		$this->GetSessionValue($fld->SearchCondition, 'sc_Application_Report_Summary_' . $parm);
		$this->GetSessionValue($fld->SearchValue2, 'sv2_Application_Report_Summary_' . $parm);
		$this->GetSessionValue($fld->SearchOperator2, 'so2_Application_Report_Summary_' . $parm);
	}

	// Get value from session
	function GetSessionValue(&$sv, $sn) {
		if (isset($_SESSION[$sn]))
			$sv = $_SESSION[$sn];
	}

	// Set dropdown value to session
	function SetSessionDropDownValue($sv, $parm) {
		$_SESSION['sv_Application_Report_Summary_' . $parm] = $sv;
	}

	// Set filter values to session
	function SetSessionFilterValues($sv1, $so1, $sc, $sv2, $so2, $parm) {
		$_SESSION['sv1_Application_Report_Summary_' . $parm] = $sv1;
		$_SESSION['so1_Application_Report_Summary_' . $parm] = $so1;
		$_SESSION['sc_Application_Report_Summary_' . $parm] = $sc;
		$_SESSION['sv2_Application_Report_Summary_' . $parm] = $sv2;
		$_SESSION['so2_Application_Report_Summary_' . $parm] = $so2;
	}

	// Check if has Session filter values
	function HasSessionFilterValues($parm) {
		return ((@$_SESSION['sv_' . $parm] <> "" && @$_SESSION['sv_' . $parm] <> EWRPT_INIT_VALUE) ||
			(@$_SESSION['sv1_' . $parm] <> "" && @$_SESSION['sv1_' . $parm] <> EWRPT_INIT_VALUE) ||
			(@$_SESSION['sv2_' . $parm] <> "" && @$_SESSION['sv2_' . $parm] <> EWRPT_INIT_VALUE));
	}

	// Dropdown filter exist
	function DropDownFilterExist(&$fld, $FldOpr) {
		$sWrk = "";
		$this->BuildDropDownFilter($fld, $sWrk, $FldOpr);
		return ($sWrk <> "");
	}

	// Build dropdown filter
	function BuildDropDownFilter(&$fld, &$FilterClause, $FldOpr) {
		$FldVal = $fld->DropDownValue;
		$sSql = "";
		if (is_array($FldVal)) {
			foreach ($FldVal as $val) {
				$sWrk = $this->GetDropDownfilter($fld, $val, $FldOpr);
				if ($sWrk <> "") {
					if ($sSql <> "")
						$sSql .= " OR " . $sWrk;
					else
						$sSql = $sWrk;
				}
			}
		} else {
			$sSql = $this->GetDropDownfilter($fld, $FldVal, $FldOpr);
		}
		if ($sSql <> "") {
			if ($FilterClause <> "") $FilterClause = "(" . $FilterClause . ") AND ";
			$FilterClause .= "(" . $sSql . ")";
		}
	}

	function GetDropDownfilter(&$fld, $FldVal, $FldOpr) {
		$FldName = $fld->FldName;
		$FldExpression = $fld->FldExpression;
		$FldDataType = $fld->FldDataType;
		$sWrk = "";
		if ($FldVal == EWRPT_NULL_VALUE) {
			$sWrk = $FldExpression . " IS NULL";
		} elseif ($FldVal == EWRPT_EMPTY_VALUE) {
			$sWrk = $FldExpression . " = ''";
		} else {
			if (substr($FldVal, 0, 2) == "@@") {
				$sWrk = ewrpt_getCustomFilter($fld, $FldVal);
			} else {
				if ($FldVal <> "" && $FldVal <> EWRPT_INIT_VALUE && $FldVal <> EWRPT_ALL_VALUE) {
					if ($FldDataType == EWRPT_DATATYPE_DATE && $FldOpr <> "") {
						$sWrk = $this->DateFilterString($FldOpr, $FldVal, $FldDataType);
					} else {
						$sWrk = $this->FilterString("=", $FldVal, $FldDataType);
					}
				}
				if ($sWrk <> "") $sWrk = $FldExpression . $sWrk;
			}
		}
		return $sWrk;
	}

	// Extended filter exist
	function ExtendedFilterExist(&$fld) {
		$sExtWrk = "";
		$this->BuildExtendedFilter($fld, $sExtWrk);
		return ($sExtWrk <> "");
	}

	// Build extended filter
	function BuildExtendedFilter(&$fld, &$FilterClause) {
		$FldName = $fld->FldName;
		$FldExpression = $fld->FldExpression;
		$FldDataType = $fld->FldDataType;
		$FldDateTimeFormat = $fld->FldDateTimeFormat;
		$FldVal1 = $fld->SearchValue;
		$FldOpr1 = $fld->SearchOperator;
		$FldCond = $fld->SearchCondition;
		$FldVal2 = $fld->SearchValue2;
		$FldOpr2 = $fld->SearchOperator2;
		$sWrk = "";
		$FldOpr1 = strtoupper(trim($FldOpr1));
		if ($FldOpr1 == "") $FldOpr1 = "=";
		$FldOpr2 = strtoupper(trim($FldOpr2));
		if ($FldOpr2 == "") $FldOpr2 = "=";
		$wrkFldVal1 = $FldVal1;
		$wrkFldVal2 = $FldVal2;
		if ($FldDataType == EWRPT_DATATYPE_BOOLEAN) {
			if (EWRPT_IS_MSACCESS) {
				if ($wrkFldVal1 <> "") $wrkFldVal1 = ($wrkFldVal1 == "1") ? "True" : "False";
				if ($wrkFldVal2 <> "") $wrkFldVal2 = ($wrkFldVal2 == "1") ? "True" : "False";
			} else {

				//if ($wrkFldVal1 <> "") $wrkFldVal1 = ($wrkFldVal1 == "1") ? EWRPT_TRUE_STRING : EWRPT_FALSE_STRING;
				//if ($wrkFldVal2 <> "") $wrkFldVal2 = ($wrkFldVal2 == "1") ? EWRPT_TRUE_STRING : EWRPT_FALSE_STRING;

				if ($wrkFldVal1 <> "") $wrkFldVal1 = ($wrkFldVal1 == "1") ? "1" : "0";
				if ($wrkFldVal2 <> "") $wrkFldVal2 = ($wrkFldVal2 == "1") ? "1" : "0";
			}
		} elseif ($FldDataType == EWRPT_DATATYPE_DATE) {
			if ($wrkFldVal1 <> "") $wrkFldVal1 = ewrpt_UnFormatDateTime($wrkFldVal1, $FldDateTimeFormat);
			if ($wrkFldVal2 <> "") $wrkFldVal2 = ewrpt_UnFormatDateTime($wrkFldVal2, $FldDateTimeFormat);
		}
		if ($FldOpr1 == "BETWEEN") {
			$IsValidValue = ($FldDataType <> EWRPT_DATATYPE_NUMBER ||
				($FldDataType == EWRPT_DATATYPE_NUMBER && is_numeric($wrkFldVal1) && is_numeric($wrkFldVal2)));
			if ($wrkFldVal1 <> "" && $wrkFldVal2 <> "" && $IsValidValue)
				$sWrk = $FldExpression . " BETWEEN " . ewrpt_QuotedValue($wrkFldVal1, $FldDataType) .
					" AND " . ewrpt_QuotedValue($wrkFldVal2, $FldDataType);
		} elseif ($FldOpr1 == "IS NULL" || $FldOpr1 == "IS NOT NULL") {
			$sWrk = $FldExpression . " " . $wrkFldVal1;
		} else {
			$IsValidValue = ($FldDataType <> EWRPT_DATATYPE_NUMBER ||
				($FldDataType == EWRPT_DATATYPE_NUMBER && is_numeric($wrkFldVal1)));
			if ($wrkFldVal1 <> "" && $IsValidValue && ewrpt_IsValidOpr($FldOpr1, $FldDataType))
				$sWrk = $FldExpression . $this->FilterString($FldOpr1, $wrkFldVal1, $FldDataType);
			$IsValidValue = ($FldDataType <> EWRPT_DATATYPE_NUMBER ||
				($FldDataType == EWRPT_DATATYPE_NUMBER && is_numeric($wrkFldVal2)));
			if ($wrkFldVal2 <> "" && $IsValidValue && ewrpt_IsValidOpr($FldOpr2, $FldDataType)) {
				if ($sWrk <> "")
					$sWrk .= " " . (($FldCond == "OR") ? "OR" : "AND") . " ";
				$sWrk .= $FldExpression . $this->FilterString($FldOpr2, $wrkFldVal2, $FldDataType);
			}
		}
		if ($sWrk <> "") {
			if ($FilterClause <> "") $FilterClause .= " AND ";
			$FilterClause .= "(" . $sWrk . ")";
		}
	}

	// Validate form
	function ValidateForm() {
		global $ReportLanguage, $gsFormError, $Application_Report_Summary;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EWRPT_SERVER_VALIDATE)
			return ($gsFormError == "");

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			$gsFormError .= ($gsFormError <> "") ? "<br />" : "";
			$gsFormError .= $sFormCustomError;
		}
		return $ValidateForm;
	}

	// Return filter string
	function FilterString($FldOpr, $FldVal, $FldType) {
		if ($FldOpr == "LIKE" || $FldOpr == "NOT LIKE") {
			return " " . $FldOpr . " " . ewrpt_QuotedValue("%$FldVal%", $FldType);
		} elseif ($FldOpr == "STARTS WITH") {
			return " LIKE " . ewrpt_QuotedValue("$FldVal%", $FldType);
		} else {
			return " $FldOpr " . ewrpt_QuotedValue($FldVal, $FldType);
		}
	}

	// Return date search string
	function DateFilterString($FldOpr, $FldVal, $FldType) {
		$wrkVal1 = ewrpt_DateVal($FldOpr, $FldVal, 1);
		$wrkVal2 = ewrpt_DateVal($FldOpr, $FldVal, 2);
		if ($wrkVal1 <> "" && $wrkVal2 <> "") {
			return " BETWEEN " . ewrpt_QuotedValue($wrkVal1, $FldType) . " AND " . ewrpt_QuotedValue($wrkVal2, $FldType);
		} else {
			return "";
		}
	}

	// Clear selection stored in session
	function ClearSessionSelection($parm) {
		$_SESSION["sel_Application_Report_Summary_$parm"] = "";
		$_SESSION["rf_Application_Report_Summary_$parm"] = "";
		$_SESSION["rt_Application_Report_Summary_$parm"] = "";
	}

	// Load selection from session
	function LoadSelectionFromSession($parm) {
		global $Application_Report_Summary;
		$fld =& $Application_Report_Summary->fields($parm);
		$fld->SelectionList = @$_SESSION["sel_Application_Report_Summary_$parm"];
		$fld->RangeFrom = @$_SESSION["rf_Application_Report_Summary_$parm"];
		$fld->RangeTo = @$_SESSION["rt_Application_Report_Summary_$parm"];
	}

	// Load default value for filters
	function LoadDefaultFilters() {
		global $Application_Report_Summary;

		/**
		* Set up default values for non Text filters
		*/

		// Field programarea_name
		$Application_Report_Summary->programarea_name->DefaultDropDownValue = EWRPT_INIT_VALUE;
		$Application_Report_Summary->programarea_name->DropDownValue = $Application_Report_Summary->programarea_name->DefaultDropDownValue;

		// Field student_gender
		$Application_Report_Summary->student_gender->DefaultDropDownValue = EWRPT_INIT_VALUE;
		$Application_Report_Summary->student_gender->DropDownValue = $Application_Report_Summary->student_gender->DefaultDropDownValue;

		// Field application_status
		$Application_Report_Summary->application_status->DefaultDropDownValue = EWRPT_INIT_VALUE;
		$Application_Report_Summary->application_status->DropDownValue = $Application_Report_Summary->application_status->DefaultDropDownValue;

		// Field name
		$Application_Report_Summary->name->DefaultDropDownValue = EWRPT_INIT_VALUE;
		$Application_Report_Summary->name->DropDownValue = $Application_Report_Summary->name->DefaultDropDownValue;

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
		// $Application_Report_Summary->app_submission_year->DefaultSelectionList = array("val1", "val2");

		$Application_Report_Summary->app_submission_year->DefaultSelectionList = "";
		$Application_Report_Summary->app_submission_year->SelectionList = $Application_Report_Summary->app_submission_year->DefaultSelectionList;
	}

	// Check if filter applied
	function CheckFilter() {
		global $Application_Report_Summary;

		// Check app_submission_year popup filter
		if (!ewrpt_MatchedArray($Application_Report_Summary->app_submission_year->DefaultSelectionList, $Application_Report_Summary->app_submission_year->SelectionList))
			return TRUE;

		// Check programarea_name extended filter
		if ($this->NonTextFilterApplied($Application_Report_Summary->programarea_name))
			return TRUE;

		// Check student_gender extended filter
		if ($this->NonTextFilterApplied($Application_Report_Summary->student_gender))
			return TRUE;

		// Check application_status extended filter
		if ($this->NonTextFilterApplied($Application_Report_Summary->application_status))
			return TRUE;

		// Check name extended filter
		if ($this->NonTextFilterApplied($Application_Report_Summary->name))
			return TRUE;
		return FALSE;
	}

	// Show list of filters
	function ShowFilterList() {
		global $Application_Report_Summary;
		global $ReportLanguage;

		// Initialize
		$sFilterList = "";

		// Field app_submission_year
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($Application_Report_Summary->app_submission_year->SelectionList))
			$sWrk = ewrpt_JoinArray($Application_Report_Summary->app_submission_year->SelectionList, ", ", EWRPT_DATATYPE_NUMBER);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Application_Report_Summary->app_submission_year->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field programarea_name
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildDropDownFilter($Application_Report_Summary->programarea_name, $sExtWrk, "");
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Application_Report_Summary->programarea_name->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field student_gender
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildDropDownFilter($Application_Report_Summary->student_gender, $sExtWrk, "");
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Application_Report_Summary->student_gender->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field application_status
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildDropDownFilter($Application_Report_Summary->application_status, $sExtWrk, "");
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Application_Report_Summary->application_status->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field name
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildDropDownFilter($Application_Report_Summary->name, $sExtWrk, "");
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Application_Report_Summary->name->FldCaption() . "<br />";
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
		global $Application_Report_Summary;
		$sWrk = "";
			if (is_array($Application_Report_Summary->app_submission_year->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Application_Report_Summary->app_submission_year, "student_applicant.app_submission_year", EWRPT_DATATYPE_NUMBER);
			}
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWRPT_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort() {
		global $Application_Report_Summary;

		// Check for a resetsort command
		if (strlen(@$_GET["cmd"]) > 0) {
			$sCmd = @$_GET["cmd"];
			if ($sCmd == "resetsort") {
				$Application_Report_Summary->setOrderBy("");
				$Application_Report_Summary->setStartGroup(1);
				$Application_Report_Summary->app_submission_year->setSort("");
				$Application_Report_Summary->programarea_name->setSort("");
				$Application_Report_Summary->age->setSort("");
				$Application_Report_Summary->application_status->setSort("");
				$Application_Report_Summary->app_amount->setSort("");
			}

		// Check for an Order parameter
		} elseif (@$_GET["order"] <> "") {
			$Application_Report_Summary->CurrentOrder = ewrpt_StripSlashes(@$_GET["order"]);
			$Application_Report_Summary->CurrentOrderType = @$_GET["ordertype"];
			$sSortSql = $Application_Report_Summary->SortSql();
			$Application_Report_Summary->setOrderBy($sSortSql);
			$Application_Report_Summary->setStartGroup(1);
		}
		return $Application_Report_Summary->getOrderBy();
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
