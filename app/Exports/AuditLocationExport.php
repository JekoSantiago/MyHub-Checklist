<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AuditLocationExport implements FromView
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
        $items['category'] = $result['category'];
        $items['checklist'] = $result['checklist'];

        return view('exports.excel.audit-location', $items);
    }
}
