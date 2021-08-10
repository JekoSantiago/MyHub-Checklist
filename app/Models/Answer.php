<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Answer extends Model
{

    /**
     * Get list of answer checklists
     */
    public static function getAnswerChecklist($data) 
    {   
        $checklist = $data['cl'];
        $isSubmit = $data['submit'];
        $startDateFrom = $data['sdf'];
        $startDateTo = $data['sdt'];
        $endDateFrom = $data['edf'];
        $endDateTo = $data['edt'];
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_AnswerChecklist_Get] ?, ?, ?, ?, ?, ?, ?, ?', [0, $checklist,$isSubmit, $startDateFrom, $startDateTo, $endDateFrom, $endDateTo, $empID]);
        return $query;
    }

    /**
     * Get answer checklist detail record
     */
    public static function getAnswerCheckListDetail($answerCLID) 
    {
        $query = DB::connection('dbChecklist')->select('EXEC [sp_AnswerChecklist_Get] ?', [$answerCLID]);
        return $query;
    }

    /**
     * Get answer checklist category next and previous
     */
    public static function getAnswerCheckListNav($answerCLID, $parentID) 
    {
        $query = DB::connection('dbChecklist')->select('EXEC [sp_AnswerCategoryNav_Get] ?, ?', [$answerCLID, $parentID]);
        return $query;
    }

    /**
     * Get answer category detail record
     */
    public static function getAnswerCategoryDetail($answerCTGID) 
    {
        $query = DB::connection('dbChecklist')->select('EXEC [sp_AnswerCategory_Get] ?', [$answerCTGID]);
        return $query;
    }

    /**
     * Get answer items
     */
    public static function getAnswerItem($answerCTGID) 
    {
        $query = DB::connection('dbChecklist')->select('EXEC [sp_AnswerItem_Get] ?, ?', [0, $answerCTGID]);
        return $query;
    } 
    
    /**
     * Get answer options
     */
    public static function getAnswerOption($answerCTGID) 
    {
        $query = DB::connection('dbChecklist')->select('EXEC [sp_AnswerItemOption_Get] ?, ?, ?', [0, 0, $answerCTGID]);
        return $query;
    } 

    /**
     * Insert record on answer checklist
     */
    public static function startAnswerChecklist($checklistID) 
    {
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_CL_StartAnswer_Insert] ?, ?', [$checklistID, $empID]);
        return $query;
    } 

    /**
     * Get parent answer categories
     */
    public static function getAnswerParentCategory($answerCLID) 
    {
        $query = DB::connection('dbChecklist')->select('EXEC [sp_AnswerParentCategory_Get] ?', [$answerCLID]);
        return $query;
    } 

    /**
     * Get child answer categories
     */
    public static function getAnswerChildCategory($answerCLID, $parentID) 
    {
        $query = DB::connection('dbChecklist')->select('EXEC [sp_AnswerChildCategory_Get] ?, ?', [$answerCLID, $parentID]);
        return $query;
    }

    /**
     * Update answer item text inputs
     */
    public static function updateAnswerInput($data)
    {

        $answerItemID = $data['answerItemID'];
        $answer = $data['answer'];
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_AnswerInputText_Update] ?, ?, ?', [$answerItemID, $answer, $empID]);
        return $query;
    }

    /**
     * Update answer item select/radio
     */
    public static function updateAnswerSelect($data)
    {

        $answerOptionID = $data['answerOptionID'];
        $answerItem_ID = $data['answerItemID'];
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_AnswerOptionRadio_Update] ?, ?, ?', [$answerOptionID, $answerItem_ID, $empID]);
        return $query;
    }

    /**
     * Update answer item checkbox
     */
    public static function updateAnswerCheck($data)
    {

        $answerOptionID = $data['answerOptionID'];
        $isChecked = $data['bool'];
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_AnswerOptionCheck_Update] ?, ?, ?', [$answerOptionID, $isChecked, $empID]);
        return $query;
    }

    /**
     * Update answer item other remarks
     */
    public static function updateAnswerItemRemarks($data)
    {

        $answerItemID = $data['answerItemID'];
        $remarks = $data['remarks'];
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_AnswerItemRemarks_Update] ?, ?, ?', [$answerItemID, $remarks, $empID]);
        return $query;
    }
    
    /**
     * Submit answer checklist
     */
    public static function submitAnswerChecklist($answerCLID)
    {
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_AnswerChecklist_Submit] ?, ?', [$answerCLID, $empID]);
        return $query;
    }

    /**
     * Get all AnswerChecklist Categories
     */
    public static function getAnswerChecklistCategoy($aclID)
    {

        $query = DB::connection('dbChecklist')->select('EXEC [sp_AnswerChecklistCategory_Get] ?', [$aclID]);
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

}

/* End of file Answer.php
 * Location: ./app/Answer.php
 *
 * Author: Jose Lorenzo D. Tambagan
 * Created Date: August 08 2020
 * Project Name : Checklist v1.0.0
 *
 */