<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'auth',
        'addchecklist',
        'addcategory',
        'deletecategory',
        'maintenance/question/show',
        'updatecategory',
        'additem',
        'updateitem',
        'requireitem',
        'addoption',
        'updateitemtype',
        'updateoption',
        'deleteoption',
        'updaterate',
        'deleteitem',
        'duplicateitem',
        'updateitemdesc',
        'updateitemportion',
        'maintenance/checklist/show',
        'answer/activechecklist/show',
        'startanswer',
        'answer/question/show',
        'updateinput',
        'updateselected',
        'updatechecked',
        'updateremarks',
        'answer/filter/show',
        'answer/answerchecklist/show',
        'submitanswer',
        'checkansweritems',
        'audit/submit',
        'audit/department/show',
        'audit/activedepcl/show',
        'auditdep/startanswer',
        'audit/store/show',
        'audit/activeloccl/show',
        'audit/rca/question/show',
        'audit/rca/insert',
        'auditloc/startanswer',
        'auditloc/filter/show',
        'auditloc/show',
        'auditdep/filter/show',
        'auditdep/show',
        'activatecl',
        'deletecl',
        'reports/loc/filter/show',
        'reports/dep/filter/show',
        'reports/loc/table/show',
        'reports/dep/table/show'
    ];
}
