<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Common extends Model
{
    /**
     * Get checklist type
     */
    public static function getChecklistType()
    {
        $query = DB::connection('dbChecklist')->select('EXEC [sp_ChecklistType_Get]');
        return $query;
    }

    /**
     * Get item type
     */
    public static function getItemType()
    {
        $query = DB::connection('dbChecklist')->select('EXEC [sp_ItemType_Get]');
        return $query;
    }

    /**
     * Check if category is parent
     */
    public static function checkCategoryParent($category_ID)
    {
        $query = DB::connection('dbChecklist')->select('EXEC [sp_ParentCategory_Check] ?', [$category_ID]);
        return $query;
    }

    /**
     * Get checklists that are active per type
     */
    public static function getActiveChecklist($cl_TypeID, $search)
    {
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_ActiveChecklist_Get] ?, ?, ?, ?', [0, $cl_TypeID, $search, $empID]);
        return $query;
    }

    /**
     * Check if how many items are required
     */
    public static function checkAnswerItemRequired($answerCLID)
    {
        $query = DB::connection('dbChecklist')->select('EXEC [sp_AnswerItemRequired_Check] ?', [$answerCLID]);
        return $query;
    }

    /**
     * Check if answer category has items
     */
    public static function checkAnswerCategoryItem($answerctg_ID)
    {
        $query = DB::connection('dbChecklist')->select('EXEC [sp_AnswerCategoryItem_Check] ?', [$answerctg_ID]);
        return $query;
    }

    /**
     * Check if answer category required items are done
     */
    public static function checkAnswerCategoryRequiredItemDone($acl_ID, $answerctg_ID)
    {
        $query = DB::connection('dbChecklist')->select('EXEC [sp_AnswerItemRequiredDone_Check] ?, ?', [$acl_ID, $answerctg_ID]);
        return $query;
    }

    /**
     * Check if answer category is parent
     */
    public static function checkAnswerCategoryParent($answercl_ID, $answerctg_ID)
    {
        $query = DB::connection('dbChecklist')->select('EXEC [sp_AnswerParentCategory_Check] ?, ?', [$answercl_ID, $answerctg_ID]);
        return $query;
    }

    /**
     * Check if RCA answer category has findings
     */
    public static function checkRCAFindings($answerctg_ID)
    {
        $query = DB::connection('dbChecklist')->select('EXEC [sp_RCACategoryItem_Check] ?', [$answerctg_ID]);
        return $query;
    }

    /**
     * Check if RCA answer category is done
     */
    public static function checkRCAFindingsDone($answerctg_ID)
    {
        $query = DB::connection('dbChecklist')->select('EXEC [sp_RCACategoryItemDone_Check] ?', [$answerctg_ID]);
        return $query;
    }

    /**
     * Check if RCA items are done upon submit
     */
    public static function checkRCAFindingsDoneSubmit($aclID)
    {
        $query = DB::connection('dbChecklist')->select('EXEC [sp_RCAItemDone_Check] ?', [$aclID]);
        return $query;
    }

    /**
     * Get backoffices 
     */
    public static function getBackOffice()
    {
        $query = DB::connection('dbChecklist')->select('EXEC [sp_Location_Get]');
        return $query;
    }

    /**
     * Get all departments
     */
    public static function getDepartment()
    {
        $query = DB::connection('dbChecklist')->select('EXEC [sp_Department_Get]');
        return $query;
    }
}

/* End of file GlobalModel.php
 * Location: ./app/Models/Common.php
 *
 * Author: Jose Lorenzo D. Tambagan
 * Created Date: August 08 2020
 * Project Name : Checklist v1.0.0
 *
 */
