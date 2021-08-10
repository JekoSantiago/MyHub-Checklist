<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Report extends Model
{
    /**
     * Get list of location audit
     */
    public static function getAuditLocation($data) 
    {   
        $locID = $data['loc'];
        $checklist = $data['cl'];
        $startDateFrom = $data['sdf'];
        $startDateTo = $data['sdt'];
        $endDateFrom = $data['edf'];
        $endDateTo = $data['edt'];
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_RPT_AuditLocation_Get] ?, ?, ?, ?, ?, ?, ?, ?, ?', [0, $locID, 0, $checklist, $startDateFrom, $startDateTo, $endDateFrom, $endDateTo, $empID]);
        return $query;
    }

    /**
     * Get list of location audit
     */
    public static function getAuditLocationSummary($clID, $dateFrom, $dateTo) 
    {   

        $query = DB::connection('dbChecklist')->select('EXEC [sp_RPT_AuditLocation_Get] ?, ?, ?, ?, ?, ?', [0, 0, $clID, '', $dateFrom, $dateTo]);
        return $query;
    }

    /**
     * Get list of location audit answers
     */
    public static function getAuditLocationAnswer($auditLocationID) 
    {   

        $query = DB::connection('dbChecklist')->select('EXEC [sp_RPT_AuditAnswerChecklist_Get] ?', [$auditLocationID]);
        return $query;
    }

    /**
     * Get list of department audit
     */
    public static function getAuditDepartment($data) 
    {   
        $locID = $data['loc'];
        $depID = $data['dep'];
        $checklist = $data['cl'];
        $startDateFrom = $data['sdf'];
        $startDateTo = $data['sdt'];
        $endDateFrom = $data['edf'];
        $endDateTo = $data['edt'];
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_RPT_AuditDepartment_Get] ?, ?, ?, ?, ?, ?, ?, ?, ?', [0, $locID, $depID, $checklist, $startDateFrom, $startDateTo, $endDateFrom, $endDateTo, $empID]);
        return $query;
    }

    /**
     * Get max number of options in answer checklist
     */
    public static function getMaxItemOption($answerCLID) 
    {
        $query = DB::connection('dbChecklist')->select('EXEC [sp_AnswerChecklistMaxOpt_Get] ?', [$answerCLID]);
        return $query;
    }

     /**
     * Get max number of options in a checklist
     */
    public static function getMaxItemOptionChecklist($cl_ID) 
    {
        $query = DB::connection('dbChecklist')->select('EXEC [sp_RPT_ChecklistMaxOpt_Get] ?', [$cl_ID]);
        return $query;
    }

    /**
     * Get detail record of answer checklist
     */
    public static function getAnswerCheckListDetail($answerCLID) 
    {
        $query = DB::connection('dbChecklist')->select('EXEC [sp_RPT_AnswerChecklist_Get] ?', [$answerCLID]);
        return $query;
    }

    /**
     * Get detail record of checklist
     */
    public static function getCheckListDetail($clID) 
    {
        $query = DB::connection('dbChecklist')->select('EXEC [sp_RPT_Checklist_Get] ?', [$clID]);
        return $query;
    }

    /**
     * Get all parent category in a checklist
     */
    public static function getParentCategory($clID) 
    {
        $query = DB::connection('dbChecklist')->select('EXEC [sp_RPT_ParentCategory_Get] ?', [$clID]);
        return $query;
    }

    /**
     * Get all sub category in a checklist
     */
    public static function getChilCategory($clID, $ctg_ID) 
    {
        $query = DB::connection('dbChecklist')->select('EXEC [sp_RPT_ChildCategory_Get] ?, ?', [$clID, $ctg_ID]);
        return $query;
    }

     /**
     * Get all items in a category
     */
    public static function getItem($ctg_ID) 
    {
        $query = DB::connection('dbChecklist')->select('EXEC [sp_RPT_Item_Get] ?', [$ctg_ID]);
        return $query;
    }

    /**
     * Get all item options in an item
     */
    public static function getItemOption($item_ID) 
    {
        $query = DB::connection('dbChecklist')->select('EXEC [sp_RPT_ItemOption_Get] ?', [$item_ID]);
        return $query;
    }

    /**
     * Get all answer parent category in a checklist
     */
    public static function getAnswerParentCategory($answerCLID) 
    {
        $query = DB::connection('dbChecklist')->select('EXEC [sp_AnswerParentCategory_Get] ?', [$answerCLID]);
        return $query;
    }

    /**
     * Get options per item in a checklist
     */
    public static function getAnswerOption($answerItemID) 
    {
        $query = DB::connection('dbChecklist')->select('EXEC [sp_AnswerItemOption_Get] ?, ?', [0, $answerItemID]);
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
     * Get location audit detail record
     */
    public static function getALAnswerChecklistDetail($answerCLID)
    {
        $query = DB::connection('dbChecklist')->select('EXEC [sp_AL_AnswerChecklist_Get] ?, ?', [0, $answerCLID]);
        return $query;
    }

    /**
     * Get RCA Item and answers
     */
    public static function getRCAItems($answerCLID)
    {
        $query = DB::connection('dbChecklist')->select('EXEC [sp_RPT_RCA_Item_Get] ?', [$answerCLID]);
        return $query;
    }

    /**
     * Get RCA Categories
     */
    public static function getRCACategory($answerCLID)
    {
        $query = DB::connection('dbChecklist')->select('EXEC [sp_RPT_RCA_Category_Get] ?', [$answerCLID]);
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

}

/* End of file Reports.php
 * Location: ./app/Reports.php
 *
 * Author: Jose Lorenzo D. Tambagan
 * Created Date: August 08 2020
 * Project Name : Checklist v1.0.0
 *
 */