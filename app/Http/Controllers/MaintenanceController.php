<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maintenance;
use App\Models\Common;
use MyHelper;

class MaintenanceController extends Controller
{

    /* CONTENT ~ MODALS SHOW */

    public function showAddChecklist()
    {
        $data['type'] = Common::getChecklistType();

        return view('pages.maintenance.modals.content.add_checklist', $data);
    }

    public function showChecklistTable(Request $request)
    {
        $search = $request->search;
        $checklist = Maintenance::getCheckList(0, $search);
        $count = count($checklist);

        if ($count > 0) :
            foreach ($checklist as $cl) :
                $cl->Checklist_ID = base64_encode($cl->Checklist_ID);
            endforeach;
        endif;

        $data['checklist'] = $checklist;

        return view('pages.maintenance.tables.checklist', $data);
    }

    public function showAddCategory()
    {
        return view('pages.maintenance.modals.content.add_category');
    }

    public function getSubCategory($clID, $ctgID)
    {
        $childCategory  = Maintenance::getChildCategory($clID, $ctgID);

        $categories = array();

        if (count($childCategory) > 0) :
            $i = 0;
            while ($i < count($childCategory)) :
                $row = $childCategory[$i];
                $categories[] = array(
                    'Category_ID' => $row->Category_ID,
                    'CategoryName' => $row->CategoryName,
                    'SubCategory' => $this->getSubCategory($clID, $row->Category_ID)
                );

                $i++;
            endwhile;
        endif;

        return $categories;
    }

    public function showCategory($id)
    {
        $clID = base64_decode($id);
        $parentCategory = Maintenance::getParentCategory($clID);
        $categories = array();

        $i = 0;
        while ($i < count($parentCategory)) :
            $row = $parentCategory[$i];
            $categories[] = array(
                'Category_ID' => $row->Category_ID,
                'CategoryName' => $row->CategoryName,
                'SubCategory' => $this->getSubCategory($clID, $row->Category_ID),
            );

            $i++;
        endwhile;

        $data['category'] = $categories;

        return view('pages.maintenance.content.category', $data);
    }

    public function showQuestions(Request $request)
    {
        $categoryID = $request->ctg;
        $clID = base64_decode($request->cl);

        $data['category'] = Maintenance::getCategoryDetail($categoryID);
        $data['question'] = Maintenance::getItem($clID, $categoryID);
        $data['option'] = Maintenance::getItemOption($clID, $categoryID);
        $data['type']   = Common::getItemType();

        return view('pages.maintenance.content.questions', $data);
    }

    /* CHECKLIST TRANSACTIONS */

    public function addChecklist(Request $request)
    {
        $title = $request->title;
        $desc  = $request->desc;
        $type  = $request->type;

        $data = [
            'title' => $title,
            'desc' => $desc,
            'type' => $type
        ];

        $add = Maintenance::insertChecklist($data);
        $num = $add[0]->RETURN;

        if ($num > 0) :
            $msg = 'Checklist successfully added!';
        else :
            $msg = MyHelper::errorMessages($num);
        endif;

        $result = array('num' => $num, 'msg' => $msg);
        return $result;
    }

    public function updateChecklist($id, Request $request)
    {
        $clID  = base64_decode($id);
        $title = $request->title;
        $desc  = $request->desc;
        $type  = $request->type;

        $data = [
            'id'    => $clID,
            'title' => $title,
            'desc'  => $desc,
            'type'  => $type
        ];

        $update = Maintenance::updateChecklist($data);
        $num = $update[0]->RETURN;

        if ($num > 0) :
            $msg = 'Checklist successfully updated!';
        else :
            $msg = MyHelper::errorMessages($num);
        endif;

        $result = array('num' => $num, 'msg' => $msg);
        return $result;
    }

    public function updateActiveChecklist(Request $request)
    {
        $clID  = base64_decode($request->id);
        $active = $request->active;

        $data = [
            'id'    => $clID,
            'active' => $active
        ];

        $update = Maintenance::updateActiveChecklist($data);
        $num = $update[0]->RETURN;

        if ($num > 0) :
            $msg = 'Checklist successfully updated!';
        else :
            $msg = MyHelper::errorMessages($num);
        endif;

        $result = array('num' => $num, 'msg' => $msg);
        return $result;
    }

    public function removeChecklist(Request $request)
    {
        $clID  = base64_decode($request->id);

        $update = Maintenance::deleteChecklist($clID);
        $num = $update[0]->RETURN;

        if ($num > 0) :
            $msg = 'Checklist successfully removed!';
        else :
            $msg = MyHelper::errorMessages($num);
        endif;

        $result = array('num' => $num, 'msg' => $msg);
        return $result;
    }

    /* CATEGORY TRANSACTIONS */

    public function addCategory(Request $request)
    {
        $clID     = $request->id;
        $category = $request->ctg;
        $parent   = $request->parent;

        $data = [
            'checklist' => base64_decode($clID),
            'category' => $category,
            'parent' => $parent
        ];

        $add = Maintenance::insertCategory($data);
        $num = $add[0]->RETURN;

        if ($num > 0) :
            $msg = 'Category successfully added!';
        else :
            $msg = MyHelper::errorMessages($num);
        endif;

        $result = array('num' => $num, 'msg' => $msg);
        return $result;
    }

    public function updateCategory(Request $request)
    {
        $clID  = $request->clID;
        $ctgID = $request->ctgID;
        $category = $request->category;
        $portion = $request->portion;

        $data = [
            'clID'     => base64_decode($clID),
            'ctgID'    => $ctgID,
            'category' => $category,
            'portion'  => $portion,
        ];

        $update = Maintenance::updateCategory($data);
        $num = $update[0]->RETURN;

        if ($num > 0) :
            $msg = 'Category successfully updated!';
        else :
            $msg = MyHelper::errorMessages($num);
        endif;

        $result = array('num' => $num, 'msg' => $msg);
        return $result;
    }

    public function removeCategory(Request $request)
    {
        $id = $request->id;

        $remove = Maintenance::deleteCategory($id);
        $num = $remove[0]->RETURN;

        if ($num > 0) :
            $msg = 'Category successfully removed!';
        else :
            $msg = MyHelper::errorMessages($num);
        endif;

        $result = array('num' => $num, 'msg' => $msg);
        return $result;
    }

    /* ITEM TRANSACTIONS */

    public function addItem(Request $request)
    {
        $ctgID  = $request->ctg;
        $defaultType = 3;
        $defaultItem = 'New Question';
        $defaultDesc = '';

        $data = [
            'category' => $ctgID,
            'type' => $defaultType,
            'item' => $defaultItem,
            'desc' => $defaultDesc
        ];

        $add = Maintenance::insertItem($data);
        $num = $add[0]->RETURN;

        if ($num > 0) :
            $msg = 'Item successfully added!';
        else :
            $msg = MyHelper::errorMessages($num);
        endif;

        $result = array('num' => $num, 'msg' => $msg);
        return $result;
    }

    public function duplicateItem(Request $request)
    {
        $itemID   = $request->id;
        $ctgID    = $request->ctg;

        $data = [
            'id'       => $itemID,
            'category' => $ctgID
        ];

        $add = Maintenance::insertDuplicateItem($data);
        $num = $add[0]->RETURN;

        if ($num > 0) :
            $msg = 'Item successfully inserted!';
        else :
            $msg = MyHelper::errorMessages($num);
        endif;

        $result = array('num' => $num, 'msg' => $msg);
        return $result;
    }

    public function updateItem(Request $request)
    {
        $itemID   = $request->itemID;
        $ctgID    = $request->ctgID;
        $itemName = $request->name;

        $data = [
            'id'       => $itemID,
            'category' => $ctgID,
            'item' => $itemName
        ];

        $update = Maintenance::updateItem($data);
        $num = $update[0]->RETURN;

        if ($num > 0) :
            $msg = 'Item successfully updated!';
        else :
            $msg = MyHelper::errorMessages($num);
        endif;

        $result = array('num' => $num, 'msg' => $msg);
        return $result;
    }

    public function updateItemDesc(Request $request)
    {
        $itemID   = $request->itemID;
        $desc = $request->desc;

        $data = [
            'id'   => $itemID,
            'desc' => $desc
        ];

        $update = Maintenance::updateItemDesc($data);
        $num = $update[0]->RETURN;

        if ($num > 0) :
            $msg = 'Item successfully updated!';
        else :
            $msg = MyHelper::errorMessages($num);
        endif;

        $result = array('num' => $num, 'msg' => $msg);
        return $result;
    }

    public function updateItemPortion(Request $request)
    {
        $itemID   = $request->itemID;
        $portion = $request->portion;

        $data = [
            'id'   => $itemID,
            'portion' => $portion
        ];

        $update = Maintenance::updateItemPortion($data);
        $num = $update[0]->RETURN;

        if ($num > 0) :
            $msg = 'Item successfully updated!';
        else :
            $msg = MyHelper::errorMessages($num);
        endif;

        $result = array('num' => $num, 'msg' => $msg);
        return $result;
    }

    public function updateItemDeleted(Request $request)
    {
        $itemID = $request->id;
        $isdeleted = $request->bool;

        $data = [
            'id'   => $itemID,
            'bool' => $isdeleted
        ];

        $update = Maintenance::deleteItemUpdate($data);
        $num = $update[0]->RETURN;

        if ($num > 0) :
            $msg = 'Item successfully updated!';
        else :
            $msg = MyHelper::errorMessages($num);
        endif;

        $result = array('num' => $num, 'msg' => $msg);
        return $result;
    }

    public function updateItemRequired(Request $request)
    {
        $itemID   = $request->id;
        $required = $request->require;

        $data = [
            'id'       => $itemID,
            'required' => $required
        ];

        $update = Maintenance::updateItemRequired($data);
        $num = $update[0]->RETURN;

        if ($num > 0) :
            $msg = 'Item successfully updated!';
        else :
            $msg = MyHelper::errorMessages($num);
        endif;

        $result = array('num' => $num, 'msg' => $msg);
        return $result;
    }

    public function updateItemType(Request $request)
    {
        $itemID = $request->id;
        $type   = $request->type;

        $data = [
            'id'   => $itemID,
            'type' => $type
        ];

        if (in_array($type, config('app.group_type'))) :
            $update = Maintenance::updateItemType($data);
        else :
            $update = Maintenance::updateItemTypeOptionDelete($data);
        endif;
        $num = $update[0]->RETURN;

        if ($num > 0) :
            $msg = 'Item successfully updated!';
        else :
            $msg = MyHelper::errorMessages($num);
        endif;

        $result = array('num' => $num, 'msg' => $msg);
        return $result;
    }

    /* ITEM OPTION TRANSACTIONS */

    public function addItemOption(Request $request)
    {
        $itemID = $request->id;
        $option = '';

        $add = Maintenance::insertItemOption($itemID);
        $num = $add[0]->RETURN;

        if ($num > 0) :
            $option = $add[0]->OPTION;
        endif;

        if ($num > 0) :
            $msg = 'Item successfully added!';
        else :
            $msg = MyHelper::errorMessages($num);
        endif;

        $result = array('num' => $num, 'msg' => $msg, 'option' => $option);
        return $result;
    }

    public function updateItemOption(Request $request)
    {
        $optionID = $request->id;
        $option   = $request->option;

        $data = [
            'id'   => $optionID,
            'option' => $option
        ];

        $update = Maintenance::updateItemOptionName($data);
        $num = $update[0]->RETURN;

        if ($num > 0) :
            $msg = 'Option successfully updated!';
        else :
            $msg = MyHelper::errorMessages($num);
        endif;

        $result = array('num' => $num, 'msg' => $msg);
        return $result;
    }

    public function updateOptionRate(Request $request)
    {
        $optionID = $request->id;
        $rate   = $request->rate;

        $data = [
            'id'   => $optionID,
            'rate' => $rate
        ];

        $update = Maintenance::updateItemOptionRate($data);
        $num = $update[0]->RETURN;

        if ($num > 0) :
            $msg = 'Rate successfully updated!';
        else :
            $msg = MyHelper::errorMessages($num);
        endif;

        $result = array('num' => $num, 'msg' => $msg);
        return $result;
    }

    public function updateOptionRateCode(Request $request)
    {
        $optionID = $request->id;
        $rate   = $request->rate;

        $data = [
            'id'   => $optionID,
            'rate' => $rate
        ];

        $update = Maintenance::updateItemOptionRateCode($data);
        $num = $update[0]->RETURN;

        if ($num > 0) :
            $msg = 'Rate Code successfully updated!';
        else :
            $msg = MyHelper::errorMessages($num);
        endif;

        $result = array('num' => $num, 'msg' => $msg);
        return $result;
    }

    public function removeItemOption(Request $request)
    {
        $optionID = $request->id;

        $update = Maintenance::deleteItemOption($optionID);
        $num = $update[0]->RETURN;

        if ($num > 0) :
            $msg = 'Option successfully removed!';
        else :
            $msg = MyHelper::errorMessages($num);
        endif;

        $result = array('num' => $num, 'msg' => $msg);
        return $result;
    }

    /* ARRANGE ORDER TRANSACTIONS */
}

/* End of file MaintenanceController.php
 * Location: ./app/Http/controllers/MaintenanceController.php
 *
 * Author: Jose Lorenzo D. Tambagan
 * Created Date: August 08 2020
 * Project Name : Checklist v1.0.0
 *
 */
