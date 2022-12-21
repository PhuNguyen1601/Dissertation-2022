<?php

namespace App\Exports;

use App\Models\Lichthi;
use App\Models\Lophocphan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class LichthiExport implements FromView, ShouldAutoSize
{
    use Exportable;
    public function __construct($all_ltt)
    {
        $this->all_ltt = $all_ltt;
    }
    public function view(): View
    {
        return view('videodec.ExportLT', [
            'all_ltt' => $this->all_ltt,
        ]);
    }
}