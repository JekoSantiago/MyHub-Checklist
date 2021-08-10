<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Maintenance extends Model
{
    /**
     * Get list of checklist
     */
    public static function getCheckList($checklist_ID, $search)
    {
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_Checklist_Get] ?, ?, ?', [$checklist_ID, $search, $empID]);
        return $query;
    }

    /**
     * Get checklist detail record
     */
    public static function getCheckListDetail($checklist_ID)
    {
        $query = DB::connection('dbChecklist')->select('EXEC [sp_ChecklistDetail_Get] ?', [$checklist_ID]);
        return $query;
    }

    /**
     * Get checklist category details record
     */
    public static function getCategoryDetail($category_ID)
    {
        $query = DB::connection('dbChecklist')->select('EXEC [sp_CategoryDetail_Get] ?', [$category_ID]);
        return $query;
    }

    /**
     * Get checklist parent categories
     */
    public static function getParentCategory($checklist_ID)
    {
        $query = DB::connection('dbChecklist')->select('EXEC [sp_ParentCategory_Get] ?', [$checklist_ID]);
        return $query;
    }

    /**
     * Get checklist child categories
     */
    public static function getChildCategory($checklist_ID, $category_ID)
    {
        $query = DB::connection('dbChecklist')->select('EXEC [sp_ChildCategory_Get] ?, ?', [$checklist_ID, $category_ID]);
        return $query;
    }

    /**
     * Get checklist items
     */
    public static function getItem($checklist_ID, $category_ID)
    {
        $query = DB::connection('dbChecklist')->select('EXEC [sp_Item_Get] ?, ?, ?', [$checklist_ID, 0, $category_ID]);
        return $query;
    }

    /**
     * Get checklist item options
     */
    public static function getItemOption($checklist_ID, $category_ID)
    {
        $query = DB::connection('dbChecklist')->select('EXEC [sp_ItemOption_Get] ?, ?', [$checklist_ID, $category_ID]);
        return $query;
    }

    /**
     * Add checklist record
     */
    public static function insertChecklist($data)
    {
        $title = $data['title'];
        $desc  = $data['desc'];
        $type  = $data['type'];
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_Checklist_Insert] ?, ?, ?, ?', [$title, $desc, $type, $empID]);
        return $query;
    }

    /**
     * Update checklist record
     */
    public static function updateChecklist($data)
    {
        $id    = $data['id'];
        $title = $data['title'];
        $desc  = $data['desc'];
        $type  = $data['type'];
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_Checklist_Update] ?, ?, ?, ?, ?', [$id, $title, $desc, $type, $empID]);
        return $query;
    }

    /**
     * Update checklist isActive
     */
    public static function updateActiveChecklist($data)
    {
        $id    = $data['id'];
        $active = $data['active'];
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_ChecklistActive_Update] ?, ?, ?', [$id, $active, $empID]);
        return $query;
    }

    /**
     * Update checklist isDeleted
     */
    public static function deleteChecklist($id)
    {
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_Checklist_Delete] ?, ?', [$id, $empID]);
        return $query;
    }

    /**
     * Insert checklist category
     */
    public static function insertCategory($data)
    {
        $clID     = $data['checklist'];
        $category = $data['category'];
        $parent   = $data['parent'];
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_Category_Insert] ?, ?, ?, ?', [$clID, $category, $parent, $empID]);
        return $query;
    }

    /**
     * Update checklist category
     */
    public static function updateCategory($data)
    {
        $clID = $data['clID'];
        $categoryID = $data['ctgID'];
        $category = $data['category'];
        $portion = $data['portion'];
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_Category_Update] ?, ?, ?, ?, ?', [$clID, $categoryID, $category, $portion, $empID]);
        return $query;
    }

    /**
     * Update checklist category isDeleted
     */
    public static function deleteCategory($id)
    {
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_Category_Delete] ?, ?', [$id, $empID]);
        return $query;
    }

    /**
     * Insert checklist item
     */
    public static function insertItem($data)
    {
        $categoryID = $data['category'];
        $typeID = $data['type'];
        $item = $data['item'];
        $desc = $data['desc'];
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_Item_Insert] ?, ?, ?, ?, ?', [$categoryID, $typeID, $item, $desc, $empID]);
        return $query;
    }

    /**
     * Update checklist item
     */
    public static function updateItem($data)
    {
        $itemID = $data['id'];
        $categoryID = $data['category'];
        $item = $data['item'];
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_ItemName_Update] ?, ?, ?, ?', [$itemID, $categoryID, $item, $empID]);
        return $query;
    }

    /**
     * Update checklist item description
     */
    public static function updateItemDesc($data)
    {
        $itemID = $data['id'];
        $desc = $data['desc'];
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_ItemDescription_Update] ?, ?, ?', [$itemID, $desc, $empID]);
        return $query;
    }

    /**
     * Update checklist item portion
     */
    public static function updateItemPortion($data)
    {
        $itemID = $data['id'];
        $portion = $data['portion'];
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_ItemPortion_Update] ?, ?, ?', [$itemID, $portion, $empID]);
        return $query;
    }

    /**
     * Update checklist item isRequired
     */
    public static function updateItemRequired($data)
    {
        $itemID = $data['id'];
        $required = $data['required'];
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_ItemRequired_Update] ?, ?, ?', [$itemID, $required, $empID]);
        return $query;
    }

    /**
     * Update checklist item type
     */
    public static function updateItemType($data)
    {
        $itemID = $data['id'];
        $type = $data['type'];
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_ItemType_Update] ?, ?, ?', [$itemID, $type, $empID]);
        return $query;
    }

    /**
     * Update checklist item type and remove options
     */
    public static function updateItemTypeOptionDelete($data)
    {
        $itemID = $data['id'];
        $type = $data['type'];
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_ItemTypeUpdateOption_Delete] ?, ?, ?', [$itemID, $type, $empID]);
        return $query;
    }

    /**
     * Update checklist item isDeleted
     */
    public static function deleteItemUpdate($data)
    {
        $itemID = $data['id'];
        $deleted = $data['bool'];
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_Item_Delete] ?, ?, ?', [$itemID, $deleted, $empID]);
        return $query;
    }

    /**
     * Insert duplicate item
     */
    public static function insertDuplicateItem($data)
    {
        $itemID = $data['id'];
        $categoryID = $data['category'];
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_ItemDuplicate_Insert] ?, ?, ?', [$itemID, $categoryID, $empID]);
        return $query;
    }

    /**
     * Insert checklist item option
     */
    public static function insertItemOption($itemID)
    {
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_ItemOption_Insert] ?, ?', [$itemID, $empID]);
        return $query;
    }

    /**
     * Update checklist item option
     */
    public static function updateItemOptionName($data)
    {
        $optionID = $data['id'];
        $option = $data['option'];
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_ItemOptionName_Update] ?, ?, ?', [$optionID, $option, $empID]);
        return $query;
    }

    /**
     * Update checklist item option rate
     */
    public static function updateItemOptionRate($data)
    {
        $optionID = $data['id'];
        $rate = $data['rate'];
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_ItemOptionRate_Update] ?, ?, ?', [$optionID, $rate, $empID]);
        return $query;
    }

    /**
     * Update checklist item option rate code
     */
    public static function updateItemOptionRateCode($data)
    {
        $optionID = $data['id'];
        $rate = $data['rate'];
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_ItemOptionRateCode_Update] ?, ?, ?', [$optionID, $rate, $empID]);
        return $query;
    }

    /**
     * Update checklist item option isDeleted
     */
    public static function deleteItemOption($optionID)
    {
        $empID = base64_decode(Session::get('Emp_Id'));

        $query = DB::connection('dbChecklist')->select('EXEC [sp_ItemOption_Delete] ?, ?', [$optionID, $empID]);
        return $query;
    }
}

/* End of file Maintenance.php
 * Location: ./app/Maintenance.php
 *
 * Author: Jose Lorenzo D. Tambagan
 * Created Date: August 08 2020
 * Project Name : Checklist v1.0.0
 *
 */
