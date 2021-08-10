<?php

class MyHelper
{

    /**
     * Error codes
     */
    public static function errorMessages($return)
    {
        $error = array(
            -11 => 'Answer checklist does not exist.',
            -12 => 'Answer checklist does not exist.',
            -13 => 'Invalid user.',
            -14 => 'Invalid user.',
            -15 => 'Database transaction error.',
            -16 => 'Answer item does not exist.',
            -17 => 'Answer item does not exist.',
            -18 => 'Invalid user.',
            -19 => 'Invalid user.',
            -20 => 'Database transaction error.',
            -21 => 'Answer item does not exist.',
            -22 => 'Answer item does not exist.',
            -23 => 'Invalid user.',
            -24 => 'Invalid user.',
            -25 => 'Database transaction error.',
            -26 => 'Answer Option does not exist.',
            -27 => 'Answer Option does not exist.',
            -28 => 'Invalid user.',
            -29 => 'Invalid user.',
            -30 => 'Database transaction error.',
            -31 => 'Answer Item does not exist.',
            -32 => 'Answer Item does not exist.',
            -33 => 'Answer Option does not exist.',
            -34 => 'Answer Option does not exist.',
            -35 => 'Invalid user.',
            -36 => 'Invalid user.',
            -37 => 'Database transaction error.',
            -38 => 'Audit Department does not exist.',
            -39 => 'Audit Department does not exist.',
            -40 => 'Checklist does not exist.',
            -41 => 'Checklist does not exist.',
            -42 => 'Database transaction error.',
            -43 => 'Database transaction error.',
            -44 => 'Audit Department currently in-progress.',
            -45 => 'Audit Department currently in-progress.',
            -46 => 'Department does not exist.',
            -47 => 'Department does not exist.',
            -48 => 'Location does not exist.',
            -49 => 'Location does not exist.',
            -50 => 'Invalid user.',
            -51 => 'Invalid user.',
            -52 => 'Database transaction error.',
            -53 => 'Audit Department does not exist.',
            -54 => 'Answer Checklist does not exist.',
            -55 => 'Answer Checklist does not exist.',
            -56 => 'Invalid user.',
            -57 => 'Invalid user.',
            -58 => 'Database transaction error.',
            -59 => 'Audit Location does not exist.',
            -60 => 'Audit Location does not exist.',
            -61 => 'Checklist does not exist.',
            -62 => 'Checklist does not exist.',
            -63 => 'Database transaction error.',
            -64 => 'Database transaction error.',
            -65 => 'Audit Location currently in-progress.',
            -66 => 'Audit Location currently in-progress.',
            -67 => 'Location does not exist.',
            -68 => 'Location does not exist.',
            -69 => 'Invalid user.',
            -70 => 'Invalid user.',
            -71 => 'Database transaction error.',
            -72 => 'Audit Location does not exist.',
            -73 => 'Answer Checklist does not exist.',
            -74 => 'Answer Checklist does not exist.',
            -75 => 'Invalid user.',
            -76 => 'Invalid user.',
            -77 => 'Database transaction error.',
            -78 => 'Audit Location does not exist.',
            -79 => 'Audit Location does not exist.',
            -80 => 'Audit Location does not exist.',
            -81 => 'Invalid user.',
            -82 => 'Invalid user.',
            -83 => 'Database transaction error.',
            -84 => 'Category does not exist.',
            -85 => 'Category does not exist.',
            -86 => 'Invalid user.',
            -87 => 'Invalid user.',
            -88 => 'Database transaction error.',
            -89 => 'Category already exists.',
            -90 => 'Category already exists.',
            -91 => 'Parent Category does not exist.',
            -92 => 'Parent Category does not exist.',
            -93 => 'Invalid user.',
            -94 => 'Invalid user.',
            -95 => 'Database transaction error.',
            -96 => 'Category already exists.',
            -97 => 'Category already exists.',
            -98 => 'Category does not exist.',
            -99 => 'Category does not exist.',
            -100 => 'Invalid user.',
            -101 => 'Invalid user.',
            -102 => 'Database transaction error.',
            -103 => 'Checklist does not exist.',
            -104 => 'Checklist does not exist.',
            -105 => 'Invalid user.',
            -106 => 'Invalid user.',
            -107 => 'Database transaction error.',
            -108 => 'Checklist Type does not exist.',
            -109 => 'Checklist Type does not exist.',
            -110 => 'Checklist already exists.',
            -111 => 'Checklist already exists.',
            -112 => 'Checklist already exists.',
            -113 => 'Checklist already exists.',
            -114 => 'Invalid user.',
            -115 => 'Invalid user.',
            -116 => 'Database transaction error.',
            -117 => 'Checklist Type does not exist.',
            -118 => 'Checklist Type does not exist.',
            -119 => 'Checklist already exists.',
            -120 => 'Checklist already exists.',
            -121 => 'Checklist already exists.',
            -122 => 'Checklist already exists.',
            -123 => 'Invalid user.',
            -124 => 'Invalid user.',
            -125 => 'Database transaction error.',
            -126 => 'Checklist does not exist.',
            -127 => 'Checklist does not exist.',
            -128 => 'Invalid user.',
            -129 => 'Invalid user.',
            -130 => 'Database transaction error.',
            -131 => 'Answer checklist currently in-progress.',
            -132 => 'Answer checklist currently in-progress.',
            -133 => 'Checklist does not exist.',
            -134 => 'Checklist does not exist.',
            -135 => 'Invalid user.',
            -136 => 'Invalid user.',
            -137 => 'Database transaction error.',
            -138 => 'Database transaction error.',
            -139 => 'Item does not exist.',
            -140 => 'Item does not exist.',
            -141 => 'Invalid user.',
            -142 => 'Invalid user.',
            -143 => 'Database transaction error.',
            -144 => 'Category does not exist.',
            -145 => 'Category does not exist.',
            -146 => 'Item type does not exist.',
            -147 => 'Item type does not exist.',
            -148 => 'Invalid user.',
            -149 => 'Invalid user.',
            -150 => 'Database transaction error.',
            -151 => 'Database transaction error.',
            -152 => 'Item does not exist.',
            -153 => 'Item does not exist.',
            -154 => 'Invalid user.',
            -155 => 'Invalid user.',
            -156 => 'Database transaction error.',
            -157 => 'Item does not exist.',
            -158 => 'Item does not exist.',
            -159 => 'Item does not exist.',
            -160 => 'Item does not exist.',
            -161 => 'Invalid user.',
            -162 => 'Invalid user.',
            -163 => 'Database transaction error.',
            -164 => 'Database transaction error.',
            -165 => 'Database transaction error.',
            -166 => 'Item does not exist.',
            -167 => 'Item does not exist.',
            -168 => 'Item already exists.',
            -169 => 'Item already exists.',
            -170 => 'Invalid user.',
            -171 => 'Invalid user.',
            -172 => 'Database transaction error.',
            -173 => 'Item option does not exist.',
            -174 => 'Item option does not exist.',
            -175 => 'Invalid user.',
            -176 => 'Invalid user.',
            -177 => 'Database transaction error.',
            -178 => 'Item does not exist.',
            -179 => 'Item does not exist.',
            -180 => 'Invalid user.',
            -181 => 'Invalid user.',
            -182 => 'Database transaction error.',
            -183 => 'Item option does not exist.',
            -184 => 'Item option does not exist.',
            -185 => 'Invalid user.',
            -186 => 'Invalid user.',
            -187 => 'Database transaction error.',
            -188 => 'Item option does not exist.',
            -189 => 'Item option does not exist.',
            -190 => 'Invalid user.',
            -191 => 'Invalid user.',
            -192 => 'Database transaction error.',
            -193 => 'Item does not exist.',
            -194 => 'Item does not exist.',
            -195 => 'Invalid user.',
            -196 => 'Invalid user.',
            -197 => 'Database transaction error.',
            -198 => 'Item does not exist.',
            -199 => 'Item does not exist.',
            -200 => 'Invalid user.',
            -201 => 'Invalid user.',
            -202 => 'Database transaction error.',
            -203 => 'Item does not exist.',
            -204 => 'Item does not exist.',
            -205 => 'Invalid user.',
            -206 => 'Invalid user.',
            -207 => 'Database transaction error.',
            -208 => 'Database transaction error.',
            -209 => 'Item does not exist.',
            -210 => 'Item does not exist.',
            -211 => 'Invalid user.',
            -212 => 'Invalid user.',
            -213 => 'Database transaction error.',
            -214 => 'Database transaction error.',
            -215 => 'Answer Item does not exist.',
            -216 => 'Answer Item does not exist.',
            -217 => 'Invalid user.',
            -218 => 'Invalid user.',
            -219 => 'Database transaction error.',
            -220 => 'Database transaction error.',
            -221 => 'Audit Location does not exist.',
            -222 => 'Audit Location does not exist.',
            -223 => 'Audit Location does not exist.',
            -224 => 'Invalid user.',
            -225 => 'Invalid user.',
            -226 => 'Database transaction error.',
            -227 => 'Audit Location does not exist.',
            -228 => 'Audit Location does not exist.',
            -229 => 'Audit Location does not exist.',
            -230 => 'Invalid user.',
            -231 => 'Invalid user.',
            -232 => 'Database transaction error.',
            -233 => 'Audit Location does not exist.',
            -234 => 'Audit Location does not exist.',
            -235 => 'Audit Location does not exist.',
            -236 => 'Invalid user.',
            -237 => 'Invalid user.',
            -238 => 'Database transaction error.',
            -239 => 'Audit Location does not exist.',
            -240 => 'Audit Location does not exist.',
            -241 => 'Audit Location does not exist.',
            -242 => 'Invalid user.',
            -243 => 'Invalid user.',
            -244 => 'Database transaction error.',

        );

        if(!empty($error[$return])) :
            $result = $error[$return] . ' (Error Code: ' . $return . ')';
        else :
            $result = 'Database Error. (Error Code: ' . $return . ')';
        endif;

        return $result;
    }

    /**
     * Check if category is parent
     */
    public static function checkCategoryParent($ctg_ID)
    {
        $data = App\Models\Common::checkCategoryParent($ctg_ID);
        $result = $data[0]->isParent;

        return $result;
    }

    /**
     * Append Subcategories
     */
    public static function showSubCategory($categories)
    {
        $li_class = 'parent-category';

        $html     = '<ul class="sub-category">';
        foreach ($categories as $category) {

            $data = MyHelper::checkCategoryParent($category['Category_ID']);
            if ($data > 0) :
                $icon = 'fa fa-minus-square';
            else :
                $icon = '';
            endif;

            $ctg_menu = '<div class="category-action-menu">
                            <a href="#" class="add-subcategory waves-effect waves-light" title="Add Subcategory" data-placement="top" data-id="' . $category['Category_ID'] . '" data-toggle="modal" data-target="#modal_newcategory"><i class="fa fa-plus" aria-hidden="true"></i></a>
                            <a href="#" class="remove-category waves-effect waves-light" title="Remove Category" data-placement="top" data-id="' . $category['Category_ID'] . '"><i class="fa fa-minus" aria-hidden="true"></i></a>
                         </div>';
                        //  <a href="#" class="arrange-category waves-effect waves-light" title="Arrange Subcategories" data-placement="top" data-id="' . $category['Category_ID'] . '"><i class="fa fa-random" aria-hidden="true"></i></a>

            $html .= '<li class="' . $li_class . '"><span class="span-'. $category['Category_ID'] . '"><i class="toggle-tree ' . $icon . '"></i><a class="ctg-link" data-id="' . $category['Category_ID'] . '">' . $category['CategoryName'] . '</a></span>&nbsp;';
            $html .= $ctg_menu;

            if (!empty($category['SubCategory'])) {
                $html .= MyHelper::showSubCategory($category['SubCategory']);
            }

            $html .= '</li>';
        }
        $html .= '</ul>';

        return $html;
    }

    /**
     * Check if category has items
     */
    public static function checkAnswerCategoryItem($answerctg_ID)
    {
        $data = App\Models\Common::checkAnswerCategoryItem($answerctg_ID);
        $result = $data[0]->hasItem;

        return $result;
    }

    /**
     * Check if answer category is parent
     */
    public static function checkAnswerCategoryParent($answercl_ID, $answerctg_ID)
    {
        $data = App\Models\Common::checkAnswerCategoryParent($answercl_ID, $answerctg_ID);
        $result = $data[0]->isParent;

        return $result;
    }

    /**
     * Check if RCA answer category has findings
     */
    public static function checkAnswerCategoryFindings($answerctg_ID)
    {
        $data = App\Models\Common::checkRCAFindings($answerctg_ID);
        $result = $data[0]->hasFindings;

        return $result;
    }

    /**
     * Check if RCA answer category is Done
     */
    public static function checkAnswerCategoryFindingsDone($answerctg_ID)
    {
        $data = App\Models\Common::checkRCAFindingsDone($answerctg_ID);
        $result = $data[0]->isDone;

        return $result;
    }

    /**
     * Check if answer category required items are done
     */
    public static function checkAnswerCategoryRequiredItemsDone($acl_ID, $answerctg_ID)
    {
        $data = App\Models\Common::checkAnswerCategoryRequiredItemDone($acl_ID, $answerctg_ID);
        $result = $data[0]->Return;

        return $result;
    }

    /**
     * Append RCA Subcategories
     */
    public static function showRCASubCategory($categories)
    {
        $li_class = 'parent-category';

        $html     = '<ul class="sub-category">';
        foreach ($categories as $category) {

            $isParent = MyHelper::checkAnswerCategoryParent($category['AnswerChecklist_ID'], $category['AnswerCategory_ID']);
            $hasItem = MyHelper::checkAnswerCategoryItem($category['AnswerCategory_ID']);
            $hasFindings = MyHelper::checkAnswerCategoryFindings($category['AnswerCategory_ID']);
            $isDone = MyHelper::checkAnswerCategoryFindingsDone($category['AnswerCategory_ID']);
            
            if ($isParent > 0) :
                $icon = 'fa fa-minus-square';
            else :
                $icon = '';
            endif;

            if($hasItem < 1) :
                $disable = 'disabled';
            else :
                $disable = '';
            endif;

            if($hasFindings > 0) :
                if($isDone == $hasFindings) :
                    $alert = 'fas fa-check-circle text-success';
                else :
                    $alert = 'fas fa-exclamation-circle text-danger';
                endif;
            else :
                $alert = '';
            endif;

            $html .= '<li class="' . $li_class . '">
                        <span class="span-' . $category['AnswerCategory_ID'] . '">
                            <i class="toggle-tree  ' . $icon . '"></i>&nbsp;
                            <a class="ctg-link ' . $disable . '" data-id="' . $category['AnswerCategory_ID'] . '">' . $category['CategoryName'] . '</a>
                            <i class="alert-' . $category['AnswerCategory_ID'] . ' ' . $alert . '"></i>
                        </span>';

            if (!empty($category['SubCategory'])) {
                $html .= MyHelper::showAnswerSubCategory($category['SubCategory']);
            }

            $html .= '</li>';
        }
        $html .= '</ul>';

        return $html;
    }

    /**
     * Append Answer Subcategories
     */
    public static function showAnswerSubCategory($categories)
    {
        $li_class = 'parent-category';

        $html     = '<ul class="sub-category">';
        foreach ($categories as $category) {

            $isParent = MyHelper::checkAnswerCategoryParent($category['AnswerChecklist_ID'], $category['AnswerCategory_ID']);
            $hasItem = MyHelper::checkAnswerCategoryItem($category['AnswerCategory_ID']);
            $isDone = MyHelper::checkAnswerCategoryRequiredItemsDone($category['AnswerChecklist_ID'], $category['AnswerCategory_ID']);
            $icon = '';
            $disable = '';
            $done = '';
            
            if ($isParent > 0) :
                $icon = 'fa fa-minus-square';
            else :
                $icon = '';
            endif;

            if ($hasItem < 1) :
                $disable = 'disabled';
            else :
                $disable = '';
                if($isDone == 0) :
                    $done = 'required-items-done';
                else:
                    $done = '';
                endif;
            endif;

            $html .= '<li class="' . $li_class . '"><span class="span-' . $category['AnswerCategory_ID'] . ' ' . $done . '"><i class="toggle-tree ' . $icon . '"></i>&nbsp;<a class="ctg-link ' . $disable . '" data-id="' . $category['AnswerCategory_ID'] . '">' . $category['CategoryName'] . '</a></span>';

            if (!empty($category['SubCategory'])) {
                $html .= MyHelper::showAnswerSubCategory($category['SubCategory']);
            }

            $html .= '</li>';
        }
        $html .= '</ul>';

        return $html;
    }

    /**
     * Append PDF RPT Answer Subcategories 
     */
    public static function showPDFRPTAnswerSubCategory($categories, $colspan, $max)
    {
        $data['category'] = $categories;
        $data['colspan'] = $colspan;
        $data['max'] = $max;

        return view('exports.helper.pdf.subcategory', $data);
    }

    /**
     * Append RPT Answer Subcategories
     */
    public static function showRPTAnswerSubCategory($categories, $colspan, $max)
    {
        $data['category'] = $categories;
        $data['colspan'] = $colspan;
        $data['max'] = $max;

        return view('exports.helper.subcategory', $data);
    }

    /**
     * Append RPT Answer Subcategories
     */
    public static function showRPTSubCategory($categories, $stores, $colspan, $max)
    {
        $data['category'] = $categories;
        $data['colspan'] = $colspan;
        $data['stores'] = $stores;
        $data['max'] = $max;

        return view('exports.helper.main_subcategory', $data);
    }

    /**
     * Append RPT Answer Subcategories Rate code total count zero
     */
    public static function showRPTRateCodeCount($categories, $stores, $ratecode)
    {
        $rateCodeCount = 0;
        $rateCodeTotal = 0;

        foreach ($categories as $p):
            foreach ($p['Items'] as $i):
                foreach ($stores as $s):
                    foreach ($s['Items'] as $ai):
                            if($i['Item_ID'] == $ai['Item_ID']):
                                if($ai['RateCode'] == $ratecode):
                                    $rateCodeCount+= 1;
                                endif;
                            endif;
                    endforeach;
                endforeach;
                $rateCodeTotal += $rateCodeCount;
                $rateCodeCount = 0;
            endforeach;
            if (!empty($p['SubCategory'])) :
                $rateCodeTotal += MyHelper::showRPTRateCodeCount($p['SubCategory'], $stores, $ratecode);
            endif;
        endforeach;

        return $rateCodeTotal;
    }


    /**
     * Append RPT Answer Subcategories
     */
    public static function getSubCategoriesScore($categories)
    {
        $sumRate = 0;
        foreach ($categories as $category) {
            foreach ($category['Items'] as $i) {
                if (in_array($i['Item_ID'], config('app.expired_item_ID')) && $i['ItemScore'] == 0) {
                    $sumRate = 10;
                    return $sumRate;
                } else {
                    $sumRate  += $i['ItemScore'];
                }
            }
            // $sumRate  += $category['Score'];
            
            if (!empty($category['SubCategory'])) {
                $sumRate += MyHelper::getSubCategoriesScore($category['SubCategory']);
            }
        }

        return $sumRate;
    }

    /**
     * Encrypt SHA256 with hashkey
     */
    public static function encryptSHA256($content, $hashKey = null)
    {
        if ($hashKey == null || $hashKey == '') {
            $hashKey = 'atp_dev';
        }

        $METHOD = 'aes-256-cbc';
        $IV = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
        $key = substr(hash('sha256', $hashKey, true), 0, 32);
        $encrypt = base64_encode(openssl_encrypt($content, $METHOD, $key, OPENSSL_RAW_DATA, $IV));

        return $encrypt;
    }

    /**
     * Decrypt SHA256 with hashkey
     */
    public static function decryptSHA256($content, $hashKey = null)
    {
        if ($hashKey == null || $hashKey == '') {
            $hashKey = 'atp_dev';
        }

        $METHOD = 'aes-256-cbc';
        $IV = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
        $key = substr(hash('sha256', $hashKey, true), 0, 32);
        $decrypted = openssl_decrypt(base64_decode($content), $METHOD, $key, OPENSSL_RAW_DATA, $IV);

        return $decrypted;
    }

    /**
     * Format date
     */
    public static function formatDate($date)
    {
        return date('Y-m-d', strtotime($date));
    }

    /**
     * RCA Format date
     */
    public static function RCAformatDate($date)
    {
        return date('d/m/Y', strtotime($date));
    }

    /**
     * Format date time
     */
    public static function formatDateTime($date)
    {
        return date('Y-m-d h:i a', strtotime($date));
    }
}


/* End of file MyHelper.php
 * Location: ./app/MyHelper.php
 *
 * Author: Jose Lorenzo D. Tambagan
 * Created Date: August 08 2020
 * Project Name : Checklist v1.0.0
 *
 */