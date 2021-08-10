<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maintenance;
use App\Models\Answer;
use App\Models\Audit;
use App\Models\Common;
use Redirect;
use Session;

class PageController extends Controller
{

    /**
     * Maintenance Page
     */
    public function maintenance()
    {
        $data['title'] = 'Maintenance';

        return view('pages.maintenance.index', $data);
    }

    /**
     * Maintenance ~ Checklist Edit Page
     */
    public function editChecklist($id)
    {
        $checklist_ID = base64_decode($id);
        $data['type'] = Common::getChecklistType();
        $data['info'] = Maintenance::getCheckListDetail($checklist_ID);
        $data['checklist'] = $id;
        $data['title'] = 'Edit Checklist';

        return view('pages.maintenance.edit', $data);
    }

    /**
     * Answer Checklist Page
     */
    public function answerChecklist($id)
    {
        $answerCLID = base64_decode($id);
        $data['answerCL'] = Answer::getAnswerCheckListDetail($answerCLID);
        $data['answerCLID'] = $id;
        $data['title'] = 'Answer Checklist';

        return view('pages.answer.answer', $data);
    }

    /**
     * MyAnswers Page
     */
    public function myanswer()
    {
        $data['title'] = 'My Answers';

        return view('pages.answer.index', $data);
    }

    /**
     * Reports Page
     */
    public function reports()
    {
        $data['title'] = 'Reports';

        return view('pages.reports.index', $data);
    }

    /**
     * MyAudit Page
     */
    public function myaudit()
    {
        $data['title'] = 'My Audit';

        return view('pages.audit.index', $data);
    }

    /**
     * Audit Store Page
     */
    public function auditstore()
    {
        $data['title'] = 'Audit Store';

        return view('pages.audit.new.location', $data);
    }

    /**
     * Audit Department Page
     */
    public function auditdepartment()
    {
        $data['title'] = 'Audit Department';

        return view('pages.audit.new.department', $data);
    }

    /**
     * My Approval Page
     */
    public function myapproval()
    {
        $data['title'] = 'My Approval';

        return view('pages.approval.index', $data);
    }

    /**
     * RCA Page
     */
    public function rca()
    {
        $data['stores'] = Audit::getStores('');
        $data['title'] = 'Response and Corrective Actions';

        return view('pages.rca.index', $data);
    }

    /**
     * Audit Acceptance Page
     */
    public function acceptance()
    {
        $data['title'] = 'Audit Acceptance';

        return view('pages.acceptance.index', $data);
    }

    /**
     * Audit Department Answer Checklist Page
     */
    public function auditDepAnswerChecklist($id)
    {
        $answerCLID = base64_decode($id);
        $data['answerCL'] = Audit::getADAnswerChecklistDetail($answerCLID);
        $data['answerCLID'] = $id;
        $data['title'] = 'Answer Checklist';

        return view('pages.audit.answer.department', $data);
    }

    /**
     * Audit Location Answer Checklist Page
     */
    public function auditLocAnswerChecklist($id)
    {
        $answerCLID = base64_decode($id);
        $data['answerCL'] = Audit::getALAnswerChecklistDetail($answerCLID);
        $data['answerCategory'] = Answer::getAnswerChecklistCategoy($answerCLID);
        $data['answerCLID'] = $id;
        $data['title'] = 'Answer Checklist';

        return view('pages.audit.answer.location', $data);
    }

    /**
     * Store Quality Audit Menu Page
     */
    public function storeQualityAuditMenu($id)
    {
        $auditID = base64_decode($id);
	/**var_dump($auditID);
        exit;*/
        $data['auditID'] = $auditID;
        $data['storeaudit'] = Audit::getRCAAnswerCheckListID($auditID, config('app.store_quality_audit_ID'));
        $data['monitoring'] = Audit::getAnswerCheckListID($auditID, config('app.monitoring_checklist_ID'));
        $data['focus'] = Audit::getAnswerCheckListID($auditID, config('app.focus_checklist_ID'));
        $data['info'] = Audit::getAuditLocationDetail($auditID);     
        $data['title'] = 'Store Quality Audit';

        return view('pages.audit.store_quality_checklist.index', $data);
    }

    /**
     * AuditLocation Answer Post-Requisite Checklists Page
     */
    public function postRequisiteChecklist($id)
    {
        $answerCLID = base64_decode($id);
        $data['answerCL'] = Audit::getALAnswerChecklistDetail($answerCLID);
        $data['answerCategory'] = Answer::getAnswerChecklistCategoy($answerCLID);
        $data['answerCLID'] = $id;
        $data['title'] = 'Monitoring / Checklist Implementation';

        return view('pages.audit.store_quality_checklist.answer.checklist', $data);
    }

    /**
     * AuditLocation Answer RCA Page
     */
    public function rcaChecklist($id)
    {
        if(base64_decode(Session::get('Department_ID')) == config('app.store_ops_depID')) :
            if (base64_decode(Session::get('PositionLevel_ID')) == config('app.sup_pos_lvl_ID')) :
                $user = 'ac';
            else :
                $user = 'am';
            endif;
        else :
            $user = 'qa';
        endif;

        $answerCLID = base64_decode($id);
        $data['answerCL'] = Audit::getALAnswerChecklistDetail($answerCLID);
        $data['answerCategory'] = Answer::getAnswerChecklistCategoy($answerCLID);
        $data['answerCLID'] = $id;
        $data['title'] = 'Response and Corrective Actions';

        return view('pages.audit.store_quality_checklist.answer.rca.'. $user, $data);
    }

    /**
     * Post view Answer Checklist Page
     */
    public function postviewACL($id)
    {
        $answerCLID = base64_decode($id);
        $data['answerCL'] = Answer::getAnswerCheckListDetail($answerCLID);
        $data['answerCLID'] = $id;
        $data['title'] = 'Answer Checklist';

        return view('pages.answer.disabled-answers', $data);
    }

    /**
     * Post view AuditLocation Answer Checklist Page
     */
    public function postviewALACL($id)
    {
        $answerCLID = base64_decode($id);
        $data['answerCL'] = Audit::getALAnswerChecklistDetail($answerCLID);
        $data['answerCategory'] = Answer::getAnswerChecklistCategoy($answerCLID);
        $data['answerCLID'] = $id;
        $data['title'] = 'View Answer Checklist';

        return view('pages.audit.post_view.location', $data);
    }

    /**
     * Post view AuditDepartment Answer Checklist Page
     */
    public function postviewADACL($id)
    {
        $answerCLID = base64_decode($id);
        $data['answerCL'] = Audit::getADAnswerChecklistDetail($answerCLID);
        $data['answerCLID'] = $id;
        $data['title'] = 'Answer Checklist';

        return view('pages.audit.post_view.department', $data);
    }

    public function invalidAccess()
    {
        return view('errors.403');
    }
}

/* End of file PageController.php
 * Location: ./app/Http/controllers/PageController.php
 *
 * Author: Jose Lorenzo D. Tambagan
 * Created Date: August 08 2020
 * Project Name : Checklist v1.0.0
 *
 */
