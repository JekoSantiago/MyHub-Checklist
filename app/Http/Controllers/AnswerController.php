<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Common;
use App\Models\Answer;
use App\Models\Audit;
use MyHelper;
use File;
use Storage;

class AnswerController extends Controller
{
    public function showFilter(Request $request)
    {
        $checklist = $request->cl;
        $datestart = $request->ds;
        $dateend = $request->de;
        $issubmit = $request->is;

        $data['checklist'] = $checklist;
        $data['datestart'] = $datestart;
        $data['dateend'] = $dateend;
        $data['issubmit'] = $issubmit;

        return view('pages.answer.modals.filter', $data);
    }

    public function showRegularActiveChecklist(Request $request)
    {
        $search = $request->search;
        $checklist = Common::getActiveChecklist(config('app.regular_ID'), $search);
        $count = count($checklist);

        if ($count > 0) :
            foreach ($checklist as $cl) :
                $cl->Checklist_ID = base64_encode($cl->Checklist_ID);
            endforeach;
        endif;

        $data['checklist'] = $checklist;

        return view('components.modals.active_checklist', $data);
    }

    public function showAnsweredChecklists(Request $request)
    {
        $checklist = $request->cl;
        $isSubmit = $request->submit;
        $startdatefrm = $request->sdf;
        $startdateto = $request->sdt;
        $enddatefrm = $request->edf;
        $enddateto = $request->edt;

        $search = [
            'cl'  => $checklist,
            'submit' => $isSubmit,
            'sdf' => $startdatefrm,
            'sdt' => $startdateto,
            'edf' => $enddatefrm,
            'edt' => $enddateto

        ];

        $result = Answer::getAnswerChecklist($search);
        $count = count($result);

        if ($count > 0) :
            foreach ($result as $cl) :
                $cl->AnswerChecklist_ID = base64_encode($cl->AnswerChecklist_ID);
            endforeach;
        endif;

        $data['checklist'] = $result;

        return view('pages.answer.tables.answer-checklist', $data);
    }

    public function getAnswerSubCategory($answerCLID, $parentID)
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
                    'SubCategory' => $this->getAnswerSubCategory($answerCLID, $row->Category_ID)
                );

                $i++;
            endwhile;
        endif;

        return $categories;
    }

    public function showAnswerCategory($id)
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
                'SubCategory' => $this->getAnswerSubCategory($answerCLID, $row->Category_ID),
            );

            $i++;
        endwhile;

        $data['category'] = $categories;

        return view('components.navigation.answer_category', $data);
    }

    public function showQuestions(Request $request)
    {
        $answerCTGID = $request->actg;
        $answrCLID = base64_decode($request->acl);

        $data['category'] = Answer::getAnswerCategoryDetail($answerCTGID);
        $data['questions'] = Answer::getAnswerItem($answerCTGID);
        $data['option'] = Answer::getAnswerOption($answerCTGID);

        if (is_null($data['category'][0]->ParentCategory_ID)) :
            $parentCTG = 0;
        else :
            $parentCTG = $data['category'][0]->ParentCategory_ID;
        endif;

        $data['navigation']  = Answer::getAnswerCheckListNav($answrCLID, $parentCTG);

        return view('pages.answer.content.answer_form', $data);
    }

    public function startAnswer(Request $request)
    {
        $clID = base64_decode($request->id);
        $add = Answer::startAnswerChecklist($clID);
        $num = $add[0]->RETURN;

        if ($num > 0) :
            $msg = 'Answer Checklist successfully added!';
        else :
            $msg = MyHelper::errorMessages($num);
        endif;

        $result = array('num' => $num, 'msg' => $msg);
        return $result;
    }

    public function answerTextUpdate(Request $request)
    {
        $answerItemID = $request->id;
        $answer = $request->answer;
        $data = [
            'answerItemID' => $answerItemID,
            'answer' => $answer
        ];

        $update = Answer::updateAnswerInput($data);
        $num = $update[0]->RETURN;

        if ($num > 0) :
            $msg = 'Answer input successfully updated!';
        else :
            $msg = MyHelper::errorMessages($num);
        endif;

        $result = array('num' => $num, 'msg' => $msg);
        return $result;
    }

    public function answerSelectUpdate(Request $request)
    {
        $answerOptionID = $request->oid;
        $answerItemID = $request->aid;
        $data = [
            'answerOptionID' => $answerOptionID,
            'answerItemID' => $answerItemID
        ];

        $update = Answer::updateAnswerSelect($data);
        $num = $update[0]->RETURN;

        if ($num > 0) :
            $msg = 'Answer select/radio successfully updated!';
        else :
            $msg = MyHelper::errorMessages($num);
        endif;

        $result = array('num' => $num, 'msg' => $msg);
        return $result;
    }

    public function answerCheckUpdate(Request $request)
    {
        $answerOptionID = $request->oid;
        $isChecked = $request->bool;
        $data = [
            'answerOptionID' => $answerOptionID,
            'bool' => $isChecked
        ];

        $update = Answer::updateAnswerCheck($data);
        $num = $update[0]->RETURN;

        if ($num > 0) :
            $msg = 'Answer check successfully updated!';
        else :
            $msg = MyHelper::errorMessages($num);
        endif;

        $result = array('num' => $num, 'msg' => $msg);
        return $result;
    }

    public function answerItemRemarksUpdate(Request $request)
    {
        $answerItemID = $request->id;
        $remarks = $request->remarks;
        $data = [
            'answerItemID' => $answerItemID,
            'remarks' => $remarks
        ];

        $update = Answer::updateAnswerItemRemarks($data);
        $num = $update[0]->RETURN;

        if ($num > 0) :
            $msg = 'Item remarks successfully updated!';
        else :
            $msg = MyHelper::errorMessages($num);
        endif;

        $result = array('num' => $num, 'msg' => $msg);
        return $result;
    }

    public function checkAnswerItemRequired(Request $request)
    {
        $answerCLID = base64_decode($request->id);

        $result = Common::checkAnswerItemRequired($answerCLID);

        return $result;
    }

    public function checkAnswerItemDoneRequired(Request $request)
    {
        $answerCLID = base64_decode($request->id);
        $aCTGID = $request->category;

        $data = Common::checkAnswerCategoryRequiredItemDone($answerCLID, $aCTGID);
        $num = $data[0]->Return;

        $result = array('num' => $num);

        return $result;
    }

    public function submitAnswerChecklist(Request $request)
    {
        $answerCLID = base64_decode($request->id);
        $auditLocID = Audit::checkACLAuditLoc($answerCLID);
        $auditDepID = Audit::checkACLAuditDep($answerCLID);
        $auditID = base64_encode($auditLocID[0]->RETURN);

        $monitoring = [
            'audit' => $auditLocID[0]->RETURN,
            'checklist' => config('app.monitoring_checklist_ID')
        ];
        $focus = [
            'audit' => $auditLocID[0]->RETURN,
            'checklist' => config('app.focus_checklist_ID')
        ];

        if (count($auditLocID) > 0) :
            if ($auditLocID[0]->CL == config('app.store_quality_audit_ID')) :
                $update = Answer::submitAnswerChecklist($answerCLID);
                $insert_monitoring = Audit::startAuditLocation($monitoring);
                $insert_focus = Audit::startAuditLocation($focus);
                $route = '/sqa/menu/' . $auditID;
            else :
                $update = Audit::submitAuditLocation($answerCLID);
                $route = '/myaudit';
            endif;
        elseif (count($auditDepID) > 0) :
            $update = Audit::submitAuditDep($answerCLID);
            $route = '/myaudit';
        else :
            $update = Answer::submitAnswerChecklist($answerCLID);
            $route = '/myanswers';
        endif;
        $num = $update[0]->RETURN;

        if ($num > 0) :
            $msg = 'Checklist successfully submitted!';
        else :
            $msg = MyHelper::errorMessages($num);
        endif;

        $result = array('num' => $num, 'msg' => $msg, 'route' => $route);
        return $result;
    }

    public function checklistFileUpload(Request $request)
    {
        $message = "";
        $status = true;

        $image = $request->file('file');
        $filename = $image->getClientOriginalName();
        $folderName = $request->segment(4);
        $path = public_path().'/storage/Store_Quality_Audit/'. $folderName.'/';

        if(!File::exists($path)):
            File::makeDirectory($path);
        endif;

        $count = static::countMaxFiles($path);
        if($count['status'] == false) :
            $message = $count['message'];
            $status = $count['status'];
        endif;

        if($status) : 
            $save = $image->move($path, $filename);
        endif;
        
        $result = array('status'=>$status, 'message'=>$message);

        return $result;              
    }

    private static function countMaxFiles($path) {

        $files = File::files($path);
        $filecount = 0;
        $filecount = count($files);
        $status = true;
        $message = '';

        if($filecount >= 5) :
            $message = 'Limit reached on uploading images for this item.';
            $status = false;
        endif;

        return array('status'=>$status, 'message'=>$message);
        
    }

    public function deleteFile(Request $request) {

        $folderName = $request->id;
        $fileName = $request->name;
        $path = public_path().'/storage/Store_Quality_Audit/' . $folderName . '/' . $fileName;

        $status = true;
        $message = 'Successfully deleted!';
        
        if(File::exists($path)) :
            $delete = File::delete($path);
            if(!$delete) :
                $message = "Failed to delete file. Please report this error to our system administrator.";
                $status  = false;
            endif;
        else :
            $message = "Our server did not find your current directory. Please report it to our system administrator.";
            $status  = false;
        endif;

        return array('status'=>$status, 'message'=>$message);
        
    }

    public function getChecklistItemFiles($answerItem_ID)
    {
        $file_list = array();
        $folderName = $answerItem_ID;
        $folderpath = public_path().'/storage/Store_Quality_Audit/' . $folderName . '/';

        if (is_dir($folderpath)) {

            if ($dh = opendir($folderpath)) {

                // Read files
                while (($file = readdir($dh)) !== false) {

                    if ($file != '' && $file != '.' && $file != '..') {

                        // File path
                        $file_path = $folderpath . $file;

                        // Check its not folder
                        if (!is_dir($file_path)) {

                            $size = filesize($file_path);
                            
                            $file_list[] = array('name' => $file, 'size' => $size, 'path' => 'storage/Store_Quality_Audit/' . $folderName . '/' . $file);
                        }
                    }
                }
                closedir($dh);
            }
        }

        return json_encode($file_list); 
    }
}

/* End of file AnswerController.php
 * Location: ./app/Http/controllers/AnswerController.php
 *
 * Author: Jose Lorenzo D. Tambagan
 * Created Date: August 08 2020
 * Project Name : Checklist v1.0.0
 *
 */
