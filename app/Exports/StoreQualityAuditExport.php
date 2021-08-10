<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class StoreQualityAuditExport implements FromView
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        $result = $this->data;
        $items['max'] = $result['max'];
        $items['category'] = $result['sqacategory'];
        $items['mcategory'] = $result['mcategory'];
        $items['fcategory'] = $result['fcategory'];
        $items['checklist'] = $result['checklist'];

        return view('exports.excel.store_quality_audit', $items);
    }
}
