<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use MyHelper;
use Redirect;
use Session;

class AuthController extends Controller
{
    public function index()
    {
	$id = request()->input('id');

        if($id == '') :
            abort(403);
        endif;

        $empID  = MyHelper::decryptSHA256($id);
        $result = Users::getUserDetails($empID);
        $uRole  = Users::userRole($result[0]->Usr_ID);

        Session::put('Usr_ID', base64_encode($result[0]->Usr_ID));
        Session::put('Emp_Id', base64_encode($result[0]->Emp_ID));
        Session::put('EmpNo', base64_encode($result[0]->EmployeeNo));
        Session::put('Role_ID', base64_encode($uRole[0]->Role_ID));
        Session::put('Emp_Name', base64_encode($result[0]->empl_name));
        Session::put('PositionLevelCode', base64_encode($uRole[0]->PositionLevelCode));
        Session::put('PositionLevel_ID', base64_encode($result[0]->PositionLevel_ID));
        Session::put('DivisionCode', base64_encode($uRole[0]->DivisionCode));
        Session::put('Division_ID', base64_encode($uRole[0]->Division_ID));
        Session::put('Company_ID', base64_encode($uRole[0]->Company_ID));
        Session::put('Department_ID', base64_encode($result[0]->Department_ID));
        Session::put('DepartmentCode', base64_encode($uRole[0]->DepartmentCode));
        Session::put('Department', base64_encode($result[0]->Department));
        Session::put('Location_ID', base64_encode($result[0]->Location_ID));
        Session::put('LocationCode', base64_encode($result[0]->LocationCode));
        Session::put('Location', base64_encode($result[0]->Location));
        Session::save();

        if (base64_decode(Session::get('Department_ID')) == config('app.qa_depID')) :
            if ((base64_decode(Session::get('PositionLevel_ID')) == config('app.am_pos_lvl_ID') || base64_decode(Session::get('PositionLevel_ID')) == config('app.sm_pos_lvl_ID'))) :
                return Redirect::to('/reports');
            else :
                return Redirect::to('/');
            endif;
        elseif (base64_decode(Session::get('Department_ID')) == config('app.store_ops_depID')) :
            if (base64_decode(Session::get('PositionLevel_ID')) == config('app.rnf_pos_lvl_ID')) :
                return Redirect::to('/acceptance');
            elseif (base64_decode(Session::get('PositionLevel_ID')) == config('app.sup_pos_lvl_ID')) :
                return Redirect::to('/rca');
            elseif (base64_decode(Session::get('PositionLevel_ID')) == config('app.am_pos_lvl_ID')) :
                return Redirect::to('/myapproval');
            else :
                return Redirect::to('/reports');
            endif;
        else :
            return Redirect::to('/');
        endif; 
    }

    /**
     *  Logout of MyHub
     */

    public function logout()
    {
        Session::flush();

        return Redirect::to(config('app.myhub_logout_url'));
    }

}

/* End of file AuthController.php
 * Location: ./app/Http/controllers/AuthController.php
 *
 * Author: Jose Lorenzo D. Tambagan
 * Created Date: August 08 2020
 * Project Name : Checklist v1.0.0
 *
 */