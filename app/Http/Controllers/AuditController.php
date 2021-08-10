<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Common;
use App\Models\Audit;
use App\Models\Answer;
use App\Mail\SendQASubmitted;
use App\Mail\SendStoreAccepted;
use App\Mail\SendACSubmitted;
use App\Mail\SendQAApproval;
use App\Mail\SendAMApproval;
use MyHelper;
use Session;


class AuditController extends Controller
{
    public function showAuditDepFilter(Request $request)
    {
        $location = $request->loc;
        $department = $request->dep;
        $checklist = $request->cl;
        $datestart = $request->ds;
        $dateend = $request->de;
        $issubmit = $request->is;

        $data['location'] = $location;
        $data['department'] = $department;
        $data['checklist'] = $checklist;
        $data['datestart'] = $datestart;
        $data['dateend'] = $dateend;
        $data['issubmit'] = $issubmit;
        $data['office'] = Common::getBackOffice();
        $data['department'] = Common::getDepartment();

        return view('pages.audit.modals.content.department_filter', $data);
    }

    public function showAuditLocFilter(Request $request)
    {
        $location = $request->loc;
        $checklist = $request->cl;
        $datestart = $request->ds;
        $dateend = $request->de;
        $issubmit = $request->is;

        $data['location'] = $location;
        $data['checklist'] = $checklist;
        $data['datestart'] = $datestart;
        $data['dateend'] = $dateend;
        $data['issubmit'] = $issubmit;
        $data['stores'] = Audit::getStores('');

        return view('pages.audit.modals.content.location_filter', $data);
    }

    public function showModalFilterAppAuditAM(Request $request)
    {
        $location = $request->loc;
        $status = $request->status;
        $datestart = $request->ds;
        $dateapp = $request->da;
        

        $data['location'] = $location;
        $data['status'] = $status;
        $data['datestart'] = $datestart;
        $data['dateapp'] = $dateapp;
        $data['stores'] = Audit::getStores('');

        return view('pages.approval.modals.content.approval_filter', $data);
    }

    public function showTableAppAuditAM(Request $request)
    {
        $location = ($request->loc == '' ? 0 : $request->loc);
        $status = ($request->status == '' ? 0 : $request->status);
        $datestartFrom = $request->dsf;
        $datestartTo = $request->dst;
        $dateappFrom = $request->daf;
        $dateappTo = $request->dat;
        
        $search = [
            'loc' => $location,
            'status' => $status,
            'sdf' => $datestartFrom,
            'sdt' => $datestartTo,
            'adf' => $dateappFrom,
            'adt' => $dateappTo
        ];

        $result = Audit::getAuditLocationAppAM($search);
        $count = count($result);

        if ($count > 0) :
            foreach ($result as $al) :
                $al->AnswerChecklist_ID = base64_encode($al->AnswerChecklist_ID);
                $al->AuditLocation_ID = base64_encode($al->AuditLocation_ID);
            endforeach;
        endif;

        $data['auditapp'] = $result;

        return view('pages.approval.tables.approval', $data);
    }

    public function showAuditLocation(Request $request)
    {
        $locID = $request->loc;
        $checklist = $request->cl;
        $submit = $request->submit;
        $startdatefrm = $request->sdf;
        $startdateto = $request->sdt;
        $enddatefrm = $request->edf;
        $enddateto = $request->edt;

        $search = [
            'loc' => $locID,
            'cl'  => $checklist,
            'submit' => $submit,
            'sdf' => $startdatefrm,
            'sdt' => $startdateto,
            'edf' => $enddatefrm,
            'edt' => $enddateto
        ];

        $result = Audit::getAuditLocation($search);
        $count = count($result);

        if ($count > 0) :
            foreach ($result as $al) :
                $al->AnswerChecklist_ID = base64_encode($al->AnswerChecklist_ID);
                $al->AuditLocation_ID = base64_encode($al->AuditLocation_ID);
            endforeach;
        endif;

        $data['auditstore'] = $result;

        return view('pages.audit.tables.location', $data);
    }

    public function showAuditDepartment(Request $request)
    {
        $locID = $request->loc;
        $depID = $request->dep;
        $checklist = $request->cl;
        $submit = $request->submit;
        $startdatefrm = $request->sdf;
        $startdateto = $request->sdt;
        $enddatefrm = $request->edf;
        $enddateto = $request->edt;

        $search = [
            'loc' => $locID,
            'dep' => $depID,
            'cl'  => $checklist,
            'submit' => $submit,
            'sdf' => $startdatefrm,
            'sdt' => $startdateto,
            'edf' => $enddatefrm,
            'edt' => $enddateto

        ];

        $result = Audit::getAuditDepartment($search);
        $count = count($result);

        if ($count > 0) :
            foreach ($result as $al) :
                $al->AnswerChecklist_ID = base64_encode($al->AnswerChecklist_ID);
                $al->AuditDepartment_ID = base64_encode($al->AuditDepartment_ID);
            endforeach;
        endif;

        $data['auditdep'] = $result;

        return view('pages.audit.tables.department', $data);
    }

    public function showDepartmentTable(Request $request)
    {
        $search = $request->search;
        $department = Audit::getBODepartment($search);

        $data['department'] = $department;

        return view('pages.audit.new.tables.department', $data);
    }

    public function showStoresTable(Request $request)
    {
        $search = $request->search;
        $department = Audit::getStores($search);

        $data['store'] = $department;

        return view('pages.audit.new.tables.location', $data);
    }

    public function showDepActiveChecklist(Request $request)
    {
        $search = $request->search;
        $locID = $request->loc;
        $depID = $request->dep;

        $param = [
            'type' => config('app.department_audit_ID'),
            'search' => $search,
            'loc' => $locID,
            'dep' => $depID
        ];

        $checklist = Audit::getADActiveChecklist($param);
        $count = count($checklist);

        if ($count > 0) :
            foreach ($checklist as $cl) :
                $cl->Checklist_ID = base64_encode($cl->Checklist_ID);
            endforeach;
        endif;

        $data['checklist'] = $checklist;

        return view('components.modals.active_checklist', $data);
    }

    public function showLocActiveChecklist(Request $request)
    {
        $search = $request->search;
        $locID = $request->loc;

        $param = [
            'type' => config('app.store_audit_ID'),
            'search' => $search,
            'loc' => $locID
        ];

        $checklist = Audit::getALActiveChecklist($param);
        $count = count($checklist);

        if ($count > 0) :
            foreach ($checklist as $cl) :
                $cl->Checklist_ID = base64_encode($cl->Checklist_ID);
            endforeach;
        endif;

        $data['checklist'] = $checklist;

        return view('components.modals.active_checklist', $data);
    }

    public function startAuditDepAnswer(Request $request)
    {
        $clID = base64_decode($request->cl);
        $locID = $request->loc;
        $depID = $request->dep;

        $data = [
            'checklist' => $clID,
            'location' => $locID,
            'department' => $depID
        ];

        $add = Audit::insertAuditDepartment($data);
        $num = $add[0]->RETURN;

        if ($num > 0) :
            $msg = 'Audit Department answer Checklist successfully added!';
        else :
            $msg = MyHelper::errorMessages($num);
        endif;

        $result = array('num' => $num, 'msg' => $msg);
        return $result;
    }

    public function startAuditLocAnswer(Request $request)
    {
        $clID = base64_decode($request->cl);
        $locID = $request->loc;

        $data = [
            'checklist' => $clID,
            'location' => $locID,
        ];

        $add = Audit::insertAuditLocation($data);
        $num = $add[0]->RETURN;

        if ($num > 0) :
            $msg = 'Audit Location answer Checklist successfully added!';
        else :
            $msg = MyHelper::errorMessages($num);
        endif;

        $result = array('num' => $num, 'msg' => $msg);
        return $result;
    }

    public function showRCAQuestions(Request $request)
    {
        $answerCTGID = $request->actg;
        $answrCLID = base64_decode($request->acl);
        $result = Audit::getALAnswerChecklistDetail($answrCLID);

        $auditee_disabled = $result[0]->InsertBy != base64_decode(Session::get('Emp_Id')) ? 'disabled' : '';
        $ac_disabled = $result[0]->AC_ID != base64_decode(Session::get('Emp_Id')) ?  'disabled' : '';

        $data['auditee_disabled'] = $auditee_disabled;
        $data['ac_disabled'] = $ac_disabled;
        $data['category'] = Answer::getAnswerCategoryDetail($answerCTGID);
        $data['questions'] = Audit::getRCAQuestions($answerCTGID);

        if (is_null($data['category'][0]->ParentCategory_ID)) :
            $parentCTG = 0;
        else :
            $parentCTG = $data['category'][0]->ParentCategory_ID;
        endif;

        $data['navigation']  = Answer::getAnswerCheckListNav($answrCLID, $parentCTG);

        return view('pages.audit.store_quality_checklist.answer.rca.content.rca_form', $data);
    }

    public function updateInsertItemRCA(Request $request)
    {
        $id = $request->id;
        $findings = ($request->f == '' ? '' : $request->f);
        $response = ($request->r == '' ? '' : $request->r);
        $action   = ($request->a == '' ? '' : $request->a);

        $data = [
            'id' => $id,
            'findings' => $findings,
            'response' => $response,
            'action' => $action
        ];

        $result = Audit::insertRCAItem($data);

        $res = $result[0]->RETURN;
        if ($res > 0) :
            $msg = 'Answer record successfully added!';
        else :
            $msg = $this->mylibrary->errorMessages($res);
        endif;

        echo json_encode(array('num' => $res, 'msg' => $msg));
    }

    public function submitStoreQualityAudit(Request $request)
    {
        $id = $request->id;
        $auditDetail = Audit::getAuditLocationDetail($id);

        $dataToQA = array(
            'info' => $auditDetail,
            'type' => 1
        );

        $dataToStore = array(
            'info' => $auditDetail,
            'type' => 2
        );

        $result = Audit::submitStoreQualityAudit($id);

        $res = $result[0]->RETURN;
        if ($res > 0) :

            Mail::to($auditDetail[0]->AuditByEmail)->send(new SendQASubmitted($dataToQA));
            Mail::to($auditDetail[0]->StoreEmail)->send(new SendQASubmitted($dataToStore));
            $msg = 'Audit successfully submitted!';
        else :
            $msg = $this->mylibrary->errorMessages($res);
        endif;

        echo json_encode(array('num' => $res, 'msg' => $msg));
    }

    public function updateAuditLocationRemarks(Request $request)
    {
        $id = $request->id;
        $remarks = $request->remarks;

        $result = Audit::updateAuditLocationRemarks($id, $remarks);

        $res = $result[0]->RETURN;
        if ($res > 0) :
            $msg = 'Audit Location remarks successfully updated!';
        else :
            $msg = $this->mylibrary->errorMessages($res);
        endif;

        echo json_encode(array('num' => $res, 'msg' => $msg));
    }

    /**
     * FOR TRANSFERING OF CONTROLLERS
     */

    public function showAuditAcceptanceTable(Request $request)
    {
        $accepted = 0;

        $search = [
            'accepted' => $accepted
        ];

        $result = Audit::getAuditLocationAcceptance($search);
        $count = count($result);

        if ($count > 0) :
            foreach ($result as $al) :
                $al->AuditLocation_ID = base64_encode($al->AuditLocation_ID);
            endforeach;
        endif;

        $data['auditlocation'] = $result;

        return view('pages.acceptance.tables.audit_location', $data);
    }

    public function acceptAuditLocation(Request $request)
    {
        $id = base64_decode($request->id);

        $result = Audit::updateAcceptAuditLocation($id);

        $res = $result[0]->RETURN;
        if ($res > 0) :
            $auditDetail = Audit::getAuditLocationDetail($id);

            $dataToQA = array(
                'info' => $auditDetail,
                'type' => 1
            );

            $dataToStore = array(
                'info' => $auditDetail,
                'type' => 2
            );

            $dataToAC = array(
                'info' => $auditDetail,
                'type' => 3
            );

            $dataToCurrAC = array(
                'info' => $auditDetail,
                'type' => 4
            );

            Mail::to($auditDetail[0]->AuditByEmail)->send(new SendStoreAccepted($dataToQA));
            Mail::to($auditDetail[0]->AcceptedByEmail)->send(new SendStoreAccepted($dataToStore));
            Mail::to($auditDetail[0]->SavedACEmail)->send(new SendStoreAccepted($dataToAC));
            
            if($auditDetail[0]->SavedACEmail != $auditDetail[0]->CurrACEmail):
                Mail::to($auditDetail[0]->CurrACEmail)->send(new SendStoreAccepted($dataToCurrAC));                
            endif;

            $msg = 'Audit successfully accepted!';
        else :
            $msg = $this->mylibrary->errorMessages($res);
        endif;

        echo json_encode(array('num' => $res, 'msg' => $msg));
    }

    public function showAuditRCATable(Request $request)
    {
        $location = $request->store;
        $submit = $request->submit;

        $search = [
            'location' => $location,
            'submit' => $submit
        ];

        $result = Audit::getRCA($search);
        $count = count($result);

        if ($count > 0) :
            foreach ($result as $al) :
                $al->AuditLocation_ID = base64_encode($al->AuditLocation_ID);
            endforeach;
        endif;

        $data['auditlocation'] = $result;

        return view('pages.rca.tables.audit_location', $data);
    }

    public function submitACAuditLocation(Request $request)
    {
        $id = $request->id;

        $result = Audit::updateACSubmitAuditLocation($id);

        $res = $result[0]->RETURN;
        if ($res > 0) :
            $auditDetail = Audit::getAuditLocationDetail($id);

            $dataToQA = array(
                'info' => $auditDetail,
                'type' => 1
            );

            $dataToAC = array(
                'info' => $auditDetail,
                'type' => 2
            );

            $dataToAM = array(
                'info' => $auditDetail,
                'type' => 3
            );

            Mail::to($auditDetail[0]->AuditByEmail)->send(new SendACSubmitted($dataToQA));
            Mail::to($auditDetail[0]->SavedACEmail)->send(new SendACSubmitted($dataToAC));
            if($auditDetail[0]->AMAppDate != '') :
                Mail::to($auditDetail[0]->SavedACEmail)->send(new SendACSubmitted($dataToAM));
            endif;

            $msg = 'RCA successfully submitted!';
        else :
            $msg = $this->mylibrary->errorMessages($res);
        endif;

        echo json_encode(array('num' => $res, 'msg' => $msg));
    }

    public function getRCAAnswerSubCategory($answerCLID, $parentID)
    {
        $childCategory  = Answer::getAnswerChildCategory($answerCLID, $parentID);

        $categories = array();

        if (count($childCategory) > 0) :
            $i = 0;
            while ($i < count($childCategory)) :
                $row = $childCategory[$i];
                $categories[] = array(
                    'AnswerChecklist_ID' => $row->AnswerChecklist_ID,
                    'AnswerCategory_ID' => $row->AnswerCategory_ID,
                    'Category_ID' => $row->Category_ID,
                    'CategoryName' => $row->CategoryName,
                    'SubCategory' => $this->getRCAAnswerSubCategory($answerCLID, $row->Category_ID)
                );

                $i++;
            endwhile;
        endif;

        return $categories;
    }

    public function showRCAAnswerCategory($id)
    {
        $answerCLID = base64_decode($id);
        $parentCategory = Answer::getAnswerParentCategory($answerCLID);
        $categories = array();

        $i = 0;
        while ($i < count($parentCategory)) :
            $row = $parentCategory[$i];
            $categories[] = array(
                'AnswerChecklist_ID' => $row->AnswerChecklist_ID,
                'AnswerCategory_ID' => $row->AnswerCategory_ID,
                'Category_ID' => $row->Category_ID,
                'CategoryName' => $row->CategoryName,
                'SubCategory' => $this->getRCAAnswerSubCategory($answerCLID, $row->Category_ID),
            );

            $i++;
        endwhile;

        $data['category'] = $categories;

        return view('components.navigation.rca_category', $data);
    }

    public function checkRCAItemDone(Request $request)
    {
        $answerCLID = base64_decode($request->id);

        $result = Common::checkRCAFindingsDoneSubmit($answerCLID);

        return $result;
    }

    public function approveAuditLocation(Request $request)
    {
        $id = base64_decode($request->id);
        $approve = $request->approve;
        $remarks = $request->remarks;

        if (base64_decode(Session::get('Department_ID')) == config('app.qa_depID')) :
            $rd = '/myaudit';
        else:
            $rd = '/myapproval';
        endif; 

        $data = [
            'id' => $id,
            'approve' => $approve,
            'remarks' => $remarks
        ];

        $result = Audit::insertAuditLocationApprove($data);

        $res = $result[0]->RETURN;
        if ($res > 0) :
            $auditDetail = Audit::getAuditLocationDetail($id);

                $dataToQA = array(
                    'info' => $auditDetail,
                    'type' => 1
                );

                $dataToAC = array(
                    'info' => $auditDetail,
                    'type' => 2
                );

                $dataToAM = array(
                    'info' => $auditDetail,
                    'type' => 3
                );

                $dataToBM = array(
                    'info' => $auditDetail,
                    'type' => 4
                );

                if (base64_decode(Session::get('Department_ID')) == config('app.qa_depID')) :
                    if($approve == 0):
                        Mail::to($auditDetail[0]->AuditByEmail)->send(new SendQAApproval($dataToQA));
                        Mail::to($auditDetail[0]->SavedACEmail)->send(new SendQAApproval($dataToAC));
                    else :
                        Mail::to($auditDetail[0]->AuditByEmail)->send(new SendQAApproval($dataToQA));
                        Mail::to($auditDetail[0]->SavedACEmail)->send(new SendQAApproval($dataToAC));
                        Mail::to($auditDetail[0]->AMEmail)->send(new SendQAApproval($dataToAM));
                    endif;
                else:
                    Mail::to($auditDetail[0]->AuditByEmail)->send(new SendAMApproval($dataToQA));
                    Mail::to($auditDetail[0]->SavedACEmail)->send(new SendAMApproval($dataToAC));
                    Mail::to($auditDetail[0]->AMAppEmail)->send(new SendAMApproval($dataToAM));
                    Mail::to($auditDetail[0]->BMEmail)->send(new SendAMApproval($dataToBM));
                endif; 

            if ($approve == 1):

                $msg = 'RCA successfully approved!';
            else :

                $msg = 'RCA successfully disapproved!';
            endif;
        else :
            $msg = $this->mylibrary->errorMessages($res);
        endif;

        echo json_encode(array('num' => $res, 'msg' => $msg, 'red' => $rd));
    } 

    public function showModalDisapprove()
    {
        return view('pages.audit.store_quality_checklist.modals.content.disapprove_remarks');
    }

}

/* End of file AuditController.php
 * Location: ./app/Http/controllers/AuditController.php
 *
 * Author: Jose Lorenzo D. Tambagan
 * Created Date: August 08 2020
 * Project Name : Checklist v1.0.0
 *
 */
