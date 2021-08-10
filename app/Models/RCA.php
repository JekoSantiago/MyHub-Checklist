<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class RCA extends Model
{
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
     * Get all AnswerChecklist Categories
     */
    public static function getAnswerChecklistCategoy($aclID)
    {

        $query = DB::connection('dbChecklist')->select('EXEC [sp_AnswerChecklistCategory_Get] ?', [$aclID]);
        return $query;
    }
}
