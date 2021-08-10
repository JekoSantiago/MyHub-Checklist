<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Users extends Model
{
    public static function getUserDetails($id)
    {
        $result = DB::connection('dbUserMgt')->select('EXEC sp_User_Get ?, ?, ?, ?', [ 0, '', 1, $id ]);

        return $result;
    }

    public static function userRole($usrID)
    {
        $result = DB::connection('dbUserMgt')->select('EXEC sp_User_UserRole_Get ?, ?, ?', [ 0, 0, $usrID ]);

        return $result;
    }
}

/* End of file Users.php
 * Location: ./app/Users.php
 *
 * Author: Jose Lorenzo D. Tambagan
 * Created Date: August 08 2020
 * Project Name : Checklist v1.0.0
 *
 */
