<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Audit extends Model
{

    /****************
     * Audit Location
     ****************/

    /**
     * Get list of location audit
     */
    public static function getAuditLocation($data)
    {
        $locID = $data['loc'];
        $checklist = $data['cl'];
        $submit = $data['submit'];
        $startDateFrom = $data['sdf'];
        $startDateTo = $data['sdt'];
        $endDateFrom = $data['edf'];
        $endDateTo = $data['edt'];
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_AuditLocation_Get] ?, ?, ?, ?, ?, ?, ?, ?, ?', [0, $locID, $checklist, $submit, $startDateFrom, $startDateTo, $endDateFrom, $endDateTo, $empID]);
        return $query;
    }

    /**
     * Get list of stores
     */
    public static function getStores($search)
    {
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_Store_Get] ?, ?', [0, $search]);
        return $query;
    }

    /**
     * add record of location audit
     */
    public static function insertAuditLocation($data)
    {
        $clID = $data['checklist'];
        $locID = $data['location'];
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_AuditLocation_Insert] ?, ?, ?', [$clID, $locID, $empID]);
        return $query;
    }

    /**
     * add record of location audit in answer checklist
     */
    public static function startAuditLocation($data)
    {
        $aclID = $data['audit'];
        $clID  = $data['checklist'];
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_AuditLoc_StartAnswer_Insert] ?, ?, ?', [$aclID, $clID, $empID]);
        return $query;
    }

    /**
     * Get location audit detail record
     */
    public static function getALAnswerChecklistDetail($answerCLID)
    {
        $query = DB::connection('dbChecklist')->select('EXEC [sp_AL_AnswerChecklist_Get] ?, ?', [0, $answerCLID]);
        return $query;
    }

    /**
     * Get audit location active checklists
     */
    public static function getALActiveChecklist($data)
    {
        $cl_TypeID = $data['type'];
        $search = $data['search'];
        $locID = $data['loc'];
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_AL_ActiveChecklist_Get] ?, ?, ?, ?, ?', [0, $cl_TypeID, $search, $locID, $empID]);
        return $query;
    }

    /**
     * Submit audit Location
     */
    public static function submitAuditLocation($answerCLID)
    {
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_AuditLocation_Submit] ?, ?', [$answerCLID, $empID]);
        return $query;
    }

    /**
     * Check if answer checklist is audit location
     */
    public static function checkACLAuditLoc($answerCLID)
    {
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_AuditAnswerChecklist_Check] ?, ?', [$answerCLID, 0]);
        return $query;
    }

    /**
     * Insert RCA Item / Update Findings, Response, Action
     */
    public static function insertRCAItem($data)
    {
        $anserItem_ID = $data['id'];
        $findings = $data['findings'];
        $response = $data['response'];
        $action = $data['action'];
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_RCA_Item_Insert] ?, ?, ?, ?, ?', [$anserItem_ID, $findings, $response, $action, $empID]);
        return $query;
    }

    /**
     * Submit store quality audit
     */
    public static function submitStoreQualityAudit($auditID)
    {
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_StoreQualityAudit_Submit] ?, ?', [$auditID, $empID]);
        return $query;
    }

    /**
     * Submit store quality audit
     */
    public static function updateAuditLocationRemarks($auditID, $remarks)
    {   
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_AuditLocationRemarks_Update] ?, ?, ?', [$auditID, $remarks, $empID]);
        return $query;
    }

    /**
     * Get Audit Location for acceptance
     */
    public static function getAuditLocationAcceptance($data)
    {   
        $isAccepted = $data['accepted'];
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_AuditLocation_Acceptance_Get] ?, ?, ?', [0, $isAccepted, $empID]);
        return $query;
    }

    /**
     * Get RCA for AC
     */
    public static function getRCA($data)
    {   
        $location = $data['location'];
        $acSubmit = $data['submit'];
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_RCA_AC_Get] ?, ?, ?, ?, ?', [0, config('app.store_quality_audit_ID'), $location, $acSubmit, $empID]);
        return $query;
    }

    /**
     * Accept audit from store
     */
    public static function updateAcceptAuditLocation($auditID)
    {   
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_AuditLocation_Acceptance_Submit] ?, ?', [$auditID, $empID]);
        return $query;
    }

    /**
     * AC Submit audit
     */
    public static function updateACSubmitAuditLocation($auditID)
    {   
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_AuditLocation_AC_Submit] ?, ?', [$auditID, $empID]);
        return $query;
    }

    /**
     * Insert record for approve/disapprove audit location
     */
    public static function insertAuditLocationApprove($data)
    {   
        $acl_ID = $data['id'];
        $isApprove = $data['approve'];
        $remarks = $data['remarks'];
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_StoreQualityAudit_Insert] ?, ?, ?, ?', [$acl_ID, $isApprove, $remarks, $empID]);
        return $query;
    }

    /**
     * Get AnswerChecklist_ID for Monitoring / Focus
     */
    public static function getAnswerCheckListID($auditID, $clID)
    {

        $query = DB::connection('dbChecklist')->select('EXEC [sp_RequisiteAnswerChecklistDetail_Get] ?, ?', [$auditID, $clID]);
        return $query;
    }

    /**
     * Get AnswerChecklist_ID for RCA
     */
    public static function getRCAAnswerCheckListID($auditID, $clID)
    {

        $query = DB::connection('dbChecklist')->select('EXEC [sp_RCAAnswerChecklistDetail_Get] ?, ?', [$auditID, $clID]);
        return $query;
    }

    /**
     * Get Audit Detail
     */
    public static function getAuditLocationDetail($auditID)
    {

        $query = DB::connection('dbChecklist')->select('EXEC [sp_AuditLocationDetail_Get] ?', [$auditID]);
        return $query;
    }

    /**
     * Get RCA Questions with Findings, Response, Action
     */
    public static function getRCAQuestions($answerCTGID)
    {
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_RCA_Item_Get] ?, ?, ?, ?', [0, 0, $answerCTGID, $empID]);
        return $query;
    }

    /**
     * Get list of location audit for approval of AM
     */
    public static function getAuditLocationAppAM($data)
    {
        $locID = $data['loc'];
        $appStatus = $data['status'];
        $startDateFrom = $data['sdf'];
        $startDateTo = $data['sdt'];
        $appDateFrom = $data['adf'];
        $appDateTo = $data['adt'];
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_AuditLocationApp_AM_Get] ?, ?, ?, ?, ?, ?, ?, ?', [0, $locID, $appStatus, $startDateFrom, $startDateTo, $appDateFrom, $appDateTo, $empID]);
        
        return $query;
    }

    /******************
     * Audit Department
     ******************/

    /**
     * Get list of department audit
     */
    public static function getAuditDepartment($data)
    {
        $locID = $data['loc'];
        $depID = $data['dep'];
        $checklist = $data['cl'];
        $submit = $data['submit'];
        $startDateFrom = $data['sdf'];
        $startDateTo = $data['sdt'];
        $endDateFrom = $data['edf'];
        $endDateTo = $data['edt'];
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_AuditDepartment_Get] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?', [0, $locID, $depID, $checklist, $submit, $startDateFrom, $startDateTo, $endDateFrom, $endDateTo, $empID]);
        return $query;
    }

    /**
     * Get list of backoffice departments
     */
    public static function getBODepartment($search)
    {
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_BackOffice_Get] ?, ?', [0, $search]);
        return $query;
    }

    /**
     * add record of department audit
     */
    public static function insertAuditDepartment($data)
    {
        $clID = $data['checklist'];
        $locID = $data['location'];
        $depID = $data['department'];
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_AuditDepartment_Insert] ?, ?, ?, ?', [$clID, $locID, $depID, $empID]);
        return $query;
    }

    /**
     * Get department audit detail record
     */
    public static function getADAnswerChecklistDetail($answerCLID)
    {
        $query = DB::connection('dbChecklist')->select('EXEC [sp_AD_AnswerChecklist_Get] ?, ?', [0, $answerCLID]);
        return $query;
    }

    /**
     * Get audit department active checklists
     */
    public static function getADActiveChecklist($data)
    {
        $cl_TypeID = $data['type'];
        $search = $data['search'];
        $locID = $data['loc'];
        $depID = $data['dep'];
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_AD_ActiveChecklist_Get] ?, ?, ?, ?, ?, ?', [0, $cl_TypeID, $search, $locID, $depID, $empID]);
        return $query;
    }

    /**
     * Submit audit Department
     */
    public static function submitAuditDep($answerCLID)
    {
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_AuditDepartment_Submit] ?, ?', [$answerCLID, $empID]);
        return $query;
    }

    /**
     * Check if answer checklist is audit department
     */
    public static function checkACLAuditDep($answerCLID)
    {
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_AuditAnswerChecklist_Check] ?, ?', [$answerCLID, 1]);
        return $query;
    }
    
}

/* End of file Audit.php
 * Location: ./app/Audit.php
 *
 * Author: Jose Lorenzo D. Tambagan
 * Created Date: August 08 2020
 * Project Name : Checklist v1.0.0
 *
 */
