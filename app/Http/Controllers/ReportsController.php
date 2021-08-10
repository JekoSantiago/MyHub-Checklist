<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AnswersExport;
use App\Exports\AuditDepartmentExport;
use App\Exports\AuditLocationExport;
use App\Exports\StoreQualityAuditExport;
use App\Exports\StoreSummaryRatingExport;
use App\Models\Report;
use App\Models\Answer;
use App\Models\Audit;
use App\Models\Common;
use MyHelper;
use PDF;


class ReportsController extends Controller
{
    public function showRPTAuditLocation(Request $request)
    {
        $locID = $request->loc;
        $checklist = $request->cl;
        $startdatefrm = $request->sdf;
        $startdateto = $request->sdt;
        $enddatefrm = $request->edf;
        $enddateto = $request->edt;

        $search = [
            'loc' => $locID,
            'cl'  => $checklist,
            'sdf' => $startdatefrm,
            'sdt' => $startdateto,
            'edf' => $enddatefrm,
            'edt' => $enddateto

        ];

        $result = Report::getAuditLocation($search);
        $count = count($result);

        if ($count > 0) :
            foreach ($result as $al) :
                $al->AnswerChecklist_ID = base64_encode($al->AnswerChecklist_ID);
                $al->AuditLocation_ID = base64_encode($al->AuditLocation_ID);
            endforeach;
        endif;

        $data['auditstore'] = $result;

        return view('pages.reports.tables.audit_location', $data);
    }

    public function showRPTAuditDepartment(Request $request)
    {
        $locID = $request->loc;
        $depID = $request->dep;
        $checklist = $request->cl;
        $startdatefrm = $request->sdf;
        $startdateto = $request->sdt;
        $enddatefrm = $request->edf;
        $enddateto = $request->edt;

        $search = [
            'loc' => $locID,
            'dep' => $depID,
            'cl'  => $checklist,
            'sdf' => $startdatefrm,
            'sdt' => $startdateto,
            'edf' => $enddatefrm,
            'edt' => $enddateto

        ];

        $result = Report::getAuditDepartment($search);
        $count = count($result);

        if ($count > 0) :
            foreach ($result as $al) :
                $al->AnswerChecklist_ID = base64_encode($al->AnswerChecklist_ID);
                $al->AuditDepartment_ID = base64_encode($al->AuditDepartment_ID);
            endforeach;
        endif;

        $data['auditdep'] = $result;

        return view('pages.reports.tables.audit_department', $data);
    }

    public function showAuditDepFilter(Request $request)
    {
        $location = $request->loc;
        $department = $request->dep;
        $checklist = $request->cl;
        $datestart = $request->ds;
        $dateend = $request->de;

        $data['location'] = $location;
        $data['dept'] = $department;
        $data['checklist'] = $checklist;
        $data['datestart'] = $datestart;
        $data['dateend'] = $dateend;
        $data['office'] = Common::getBackOffice();
        $data['department'] = Common::getDepartment();

        return view('pages.reports.modals.content.audit_department_filter', $data);
    }

    public function showAuditLocFilter(Request $request)
    {
        $location = $request->loc;
        $checklist = $request->cl;
        $datestart = $request->ds;
        $dateend = $request->de;

        $data['location'] = $location;
        $data['checklist'] = $checklist;
        $data['datestart'] = $datestart;
        $data['dateend'] = $dateend;
        $data['stores'] = Audit::getStores('');

        return view('pages.reports.modals.content.audit_location_filter', $data);
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
                    'AnswerCategory_ID' => $row->AnswerCategory_ID,
                    'Category_ID' => $row->Category_ID,
                    'CategoryName' => $row->CategoryName,
                    'Portion' => $row->Portion,
                    'Score' => $row->Score,
                    'SubCategory' => $this->getAnswerSubCategory($answerCLID, $row->Category_ID),
                    'Items' => $this->getItemsOptions($row->AnswerCategory_ID),
                );

                $i++;
            endwhile;
        endif;
        return $categories;
    }

    public function getSubCategory($clID, $parentID)
    {
        $childCategory  = Report::getChilCategory($clID, $parentID);

        $categories = array();

        if (count($childCategory) > 0) :
            $i = 0;
            while ($i < count($childCategory)) :
                $row = $childCategory[$i];
                $categories[] = array(
                    'Category_ID' => $row->Category_ID,
                    'CategoryName' => $row->CategoryName,
                    'Portion' => $row->Portion,
                    'SubCategory' => $this->getSubCategory($clID, $row->Category_ID),
                    'Items' => $this->getItems($row->Category_ID),
                );

                $i++;
            endwhile;
        endif;
        return $categories;
    }

    public function getItemsOptions($answerCTGID)
    {
        $result = Answer::getAnswerItem($answerCTGID);
        $items = array();

        if (count($result) > 0) :
            $i = 0;
            while ($i < count($result)) :
                $row = $result[$i];
                $items[] = array(
                    'AnswerItem_ID' => $row->AnswerItem_ID,
                    'Item_ID' => $row->Item_ID,
                    'ItemName' => $row->ItemName,
                    'ItemType_ID' => $row->ItemType_ID,
                    'ItemScore' => $row->ItemScore,
                    'Answer' => $row->Answer,
                    'Portion' => $row->Portion,
                    'OtherRemarks' => $row->OtherRemarks,
                    'Options' => Report::getAnswerOption($row->AnswerItem_ID)
                );

                $i++;
            endwhile;
        endif;

        return $items;
    }

    public function getItems($ctg_ID)
    {
        $result = Report::getItem($ctg_ID);
        $items = array();

        if (count($result) > 0) :
            $i = 0;
            while ($i < count($result)) :
                $row = $result[$i];
                $items[] = array(
                    'Item_ID' => $row->Item_ID,
                    'ItemName' => $row->ItemName,
                    'ItemType_ID' => $row->ItemType_ID,
                    'Portion' => $row->Portion,
                    'Options' => Report::getItemOption($row->Item_ID)
                );

                $i++;
            endwhile;
        endif;

        return $items;
    }

    public function getAuditLocationAnswer($audit_ID)
    {
        $result = Report::getAuditLocationAnswer($audit_ID);
        $items = array();

        if (count($result) > 0) :
            $i = 0;
            while ($i < count($result)) :
                $row = $result[$i];
                $items[] = array(
                    'AuditLocation_ID' => $row->AuditLocation_ID,
                    'Item_ID' => $row->Item_ID,
                    'RateCode' => $row->RateCode,
                );

                $i++;
            endwhile;
        endif;

        return $items;
    }

    public function exportAnswers($answerCLID)
    {
        $ID = base64_decode($answerCLID);
        $maxOpt = Report::getMaxItemOption($ID);
        $parent = Report::getAnswerParentCategory($ID);
        $categories = array();

        $i = 0;
        while ($i < count($parent)) :
            $row = $parent[$i];
            $categories[] = array(
                'AnswerCategory_ID' => $row->AnswerCategory_ID,
                'Category_ID' => $row->Category_ID,
                'CategoryName' => $row->CategoryName,
                'Portion' => $row->Portion,
                'Score' => $row->Score,
                'SubCategory' => $this->getAnswerSubCategory($ID, $row->Category_ID),
                'Items' => $this->getItemsOptions($row->AnswerCategory_ID),
            );
            $i++;
        endwhile;

        $data['category'] = $categories;
        $data['checklist'] = Report::getAnswerCheckListDetail($ID);
        $data['max'] = $maxOpt[0]->Max;

        return Excel::download(new AnswersExport($data), 'invoices.xls');
    }

    public function exportAuditDepartment($answerCLID)
    {
        $ID = base64_decode($answerCLID);
        $maxOpt = Report::getMaxItemOption($ID);
        $parent = Report::getAnswerParentCategory($ID);
        $detail = Report::getADAnswerChecklistDetail($ID);
        $file_name = $detail[0]->LocationCode . '_' . str_replace(' ', '_', $detail[0]->Location) .'_' . MyHelper::formatDate($detail[0]->InsertDate);
        $categories = array();

        $i = 0;
        while ($i < count($parent)) :
            $row = $parent[$i];
            $categories[] = array(
                'AnswerCategory_ID' => $row->AnswerCategory_ID,
                'Category_ID' => $row->Category_ID,
                'CategoryName' => $row->CategoryName,
                'Portion' => $row->Portion,
                'Score' => $row->Score,
                'SubCategory' => $this->getAnswerSubCategory($ID, $row->Category_ID),
                'Items' => $this->getItemsOptions($row->AnswerCategory_ID),
            );
            $i++;
        endwhile;

        $data['category'] = $categories;
        $data['checklist'] = $detail;
        $data['max'] = $maxOpt[0]->Max;

        return Excel::download(new AuditDepartmentExport($data), $file_name . '.xlsx');
    }

    public function exportAuditLocation($answerCLID)
    {
        $ID = base64_decode($answerCLID);
        $maxOpt = Report::getMaxItemOption($ID);
        $parent = Report::getAnswerParentCategory($ID);
        $detail = Report::getALAnswerChecklistDetail($ID);
        $file_name = $detail[0]->LocationCode . '_' . str_replace(' ', '_', $detail[0]->Location) . '_' . MyHelper::formatDate($detail[0]->InsertDate);
        $categories = array();

        $i = 0;
        while ($i < count($parent)) :
            $row = $parent[$i];
            $categories[] = array(
                'AnswerCategory_ID' => $row->AnswerCategory_ID,
                'Category_ID' => $row->Category_ID,
                'CategoryName' => $row->CategoryName,
                'Portion' => $row->Portion,
                'Score' => $row->Score,
                'SubCategory' => $this->getAnswerSubCategory($ID, $row->Category_ID),
                'Items' => $this->getItemsOptions($row->AnswerCategory_ID)
            );
            $i++;
        endwhile;

        $data['category'] = $categories;
        $data['checklist'] = Report::getALAnswerChecklistDetail($ID);
        $data['max'] = $maxOpt[0]->Max;

        return Excel::download(new AuditLocationExport($data), $file_name . '.xlsx');
    }

    public function exportSQA($answerCLID, $monitoring_ID, $focus_ID)
    {
        $ID = base64_decode($answerCLID);
        $m_ID = base64_decode($monitoring_ID);
        $f_ID = base64_decode($focus_ID);

        $maxOpt = Report::getMaxItemOption($ID);
        $sqa_parent = Report::getAnswerParentCategory($ID);
        $sqa_detail = Report::getALAnswerChecklistDetail($ID);
        $m_parent = Report::getAnswerParentCategory($m_ID);
        $f_parent = Report::getAnswerParentCategory($f_ID);
        $file_name = $sqa_detail[0]->LocationCode . '_' . str_replace(' ', '_', $sqa_detail[0]->Location) . '_' . MyHelper::formatDate($sqa_detail[0]->InsertDate);
        $sqa_categories = array();
        $m_categories = array();
        $f_categories = array();

        $i = 0;
        while ($i < count($sqa_parent)) :
            $row = $sqa_parent[$i];
            $sqa_categories[] = array(
                'AnswerCategory_ID' => $row->AnswerCategory_ID,
                'Category_ID' => $row->Category_ID,
                'CategoryName' => $row->CategoryName,
                'Portion' => $row->Portion,
                'Score' => $row->Score,
                'SubCategory' => $this->getAnswerSubCategory($ID, $row->Category_ID),
                'Items' => $this->getItemsOptions($row->AnswerCategory_ID)
            );
            $i++;
        endwhile;

        $m = 0;
        while ($m < count($m_parent)) :
            $row = $m_parent[$m];
            $m_categories[] = array(
                'AnswerCategory_ID' => $row->AnswerCategory_ID,
                'Category_ID' => $row->Category_ID,
                'CategoryName' => $row->CategoryName,
                'Items' => $this->getItemsOptions($row->AnswerCategory_ID)
            );
            $m++;
        endwhile;

        $f = 0;
        while ($f < count($f_parent)) :
            $row = $f_parent[$f];
            $f_categories[] = array(
                'AnswerCategory_ID' => $row->AnswerCategory_ID,
                'Category_ID' => $row->Category_ID,
                'CategoryName' => $row->CategoryName,
                'Items' => $this->getItemsOptions($row->AnswerCategory_ID)
            );
            $f++;
        endwhile;

        $data['sqacategory'] = $sqa_categories;
        $data['mcategory'] = $m_categories;
        $data['fcategory'] = $f_categories;
        $data['checklist'] = Report::getALAnswerChecklistDetail($ID);
        $data['max'] = $maxOpt[0]->Max;

        return Excel::download(new StoreQualityAuditExport($data), $file_name . '.xlsx');
    }

    /**
     * PDF view of RCA
     */

    public function exportPdfRCA($id)
    {
        $auditID = base64_decode($id);
        $info = Report::getAuditLocationDetail($auditID);
        $category = Report::getRCACategory($info[0]->AnswerChecklist_ID);
        $items = Report::getRCAItems($info[0]->AnswerChecklist_ID);
        $gpd    = date("Y-m-d");
        $pdf = \App::make('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $rca_images = array();

        $i = 0;
        while ($i < count($items)) :
            $row = $items[$i];
            $rca_images[] = array(
                'AnswerItem_ID' => $row->AnswerItem_ID,
                'ParentCategory_ID' => $row->ParentCategory_ID,
                'ItemName' => $row->ItemName,
                'Images' => $this->getImages($row->AnswerItem_ID)
            );
            $i++;
        endwhile;

        $pdf->loadView('exports.pdf.rca', [
            'info'   => $info,
            'category' => $category,
            'items' => $items,
            'gpd'    => $gpd,
            'images' => $rca_images
        ])->setPaper('letter', 'portrait');

        return $pdf->stream('Return.pdf');
    }

    /**
     * PDF view of Store Quality Audit
     */

    public function exportPdfSQA($answerCLID, $monitoring_ID, $focus_ID)
    {
        $ID = base64_decode($answerCLID);
        $m_ID = base64_decode($monitoring_ID);
        $f_ID = base64_decode($focus_ID);

        $maxOpt = Report::getMaxItemOption($ID);
        $sqa_parent = Report::getAnswerParentCategory($ID);
        $sqa_detail = Report::getALAnswerChecklistDetail($ID);
        $m_parent = Report::getAnswerParentCategory($m_ID);
        $f_parent = Report::getAnswerParentCategory($f_ID);
        $file_name = $sqa_detail[0]->LocationCode . '_' . str_replace(' ', '_', $sqa_detail[0]->Location) . '_' . MyHelper::formatDate($sqa_detail[0]->InsertDate);
        $sqa_categories = array();
        $m_categories = array();
        $f_categories = array();

        $i = 0;
        while ($i < count($sqa_parent)) :
            $row = $sqa_parent[$i];
            $sqa_categories[] = array(
                'AnswerCategory_ID' => $row->AnswerCategory_ID,
                'Category_ID' => $row->Category_ID,
                'CategoryName' => $row->CategoryName,
                'Portion' => $row->Portion,
                'Score' => $row->Score,
                'SubCategory' => $this->getAnswerSubCategory($ID, $row->Category_ID),
                'Items' => $this->getItemsOptions($row->AnswerCategory_ID)
            );
            $i++;
        endwhile;

        $m = 0;
        while ($m < count($m_parent)) :
            $row = $m_parent[$m];
            $m_categories[] = array(
                'AnswerCategory_ID' => $row->AnswerCategory_ID,
                'Category_ID' => $row->Category_ID,
                'CategoryName' => $row->CategoryName,
                'Items' => $this->getItemsOptions($row->AnswerCategory_ID)
            );
            $m++;
        endwhile;

        $f = 0;
        while ($f < count($f_parent)) :
            $row = $f_parent[$f];
            $f_categories[] = array(
                'AnswerCategory_ID' => $row->AnswerCategory_ID,
                'Category_ID' => $row->Category_ID,
                'CategoryName' => $row->CategoryName,
                'Items' => $this->getItemsOptions($row->AnswerCategory_ID)
            );
            $f++;
        endwhile;

        $data['category'] = $sqa_categories;
        $data['mcategory'] = $m_categories;
        $data['fcategory'] = $f_categories;
        $data['checklist'] = Report::getALAnswerChecklistDetail($ID);
        $data['max'] = $maxOpt[0]->Max;
        $data['filename'] = $file_name;
        $pdf = \App::make('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);

        $pdf->loadView('exports.pdf.store_quality_audit', $data)->setPaper('letter', 'portrait');

        return $pdf->stream($file_name.'.pdf');
    }

    /**
     * Export Excel Rating Summary
     */
    public function exportRatingSummary($dateFrom, $dateTo)
    {
        $ID = config('app.store_quality_audit_ID');
        $stores = Report::getAuditLocationSummary($ID, $dateFrom, $dateTo);
        $maxOpt = Report::getMaxItemOptionChecklist($ID);
        $parent = Report::getParentCategory($ID);
        $detail = Report::getCheckListDetail($ID);
        $file_name = 'Store_Rating_Summary_' . $dateFrom . '_' . $dateTo;
        $categories = array();
        $loc = array();

        $i = 0;
        while ($i < count($parent)) :
            $row = $parent[$i];
            $categories[] = array(
                'Category_ID' => $row->Category_ID,
                'CategoryName' => $row->CategoryName,
                'Portion' => $row->Portion,
                'SubCategory' => $this->getSubCategory($ID, $row->Category_ID),
                'Items' => $this->getItems($row->Category_ID),
            );
            $i++;
        endwhile;

        $l = 0;
        while($l < count($stores)) :
            $row = $stores[$l];
            $loc[] = array(
                'AuditLocation_ID' => $row->AuditLocation_ID,
                'LocationCode' => $row->LocationCode,
                'Location' => $row->Location,
                'Items' => $this->getAuditLocationAnswer($row->AuditLocation_ID),
            );
            $l++;
        endwhile;

        $data['category'] = $categories;
        $data['checklist'] = $detail;
        $data['max'] = $maxOpt[0]->Max;
        $data['stores'] = $loc;

        return Excel::download(new StoreSummaryRatingExport($data), $file_name . '.xlsx');
    }

    /**
     * Get Images per Item
     */
    public function getImages($answerItem_ID) 
    {
        $file_list = array();
        $folderName = $answerItem_ID;
        $folderpath = 'storage/Store_Quality_Audit/' . $folderName . '/';

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

                            $file_list[] = array(
                                'name' => $file, 
                                'size' => $size, 
                                'path' => $file_path
                            );
                        }
                    }
                }
                closedir($dh);
            }
        }

        return $file_list; 
    }
}

/* End of file ReportsController.php
 * Location: ./app/Http/controllers/ReportsController.php
 *
 * Author: Jose Lorenzo D. Tambagan
 * Created Date: August 08 2020
 * Project Name : Checklist v1.0.0
 *
 */
