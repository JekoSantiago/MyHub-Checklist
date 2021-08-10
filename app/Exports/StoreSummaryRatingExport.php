<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class StoreSummaryRatingExport implements FromView
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
        $items['stores'] = $result['stores'];

        return view('exports.excel.store_rating_summary', $items);
    }
}
