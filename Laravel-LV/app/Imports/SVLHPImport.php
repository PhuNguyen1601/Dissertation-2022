<?php

namespace App\Imports;

use App\Models\SV_LHP;
use App\Models\Sinhvien;
use App\Models\Lophocphan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SVLHPImport implements ToCollection, WithHeadingRow, WithValidation, WithMultipleSheets, SkipsUnknownSheets
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    // private $listsv;
    private $lophocphan;

    public function __construct()
    {
        $this->lophocphan = Lophocphan::select('id', 'malhp')->get();
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            $lhp = $this->lophocphan->where('malhp', $row['ma_lop_hoc_phan'])->first();

            $sinhvien = Sinhvien::updateOrCreate([
                "masv" => $row['ma_so_sinh_vien'],
                "tensv" => $row['ten_sinh_vien'],
            ]);
            $sv_lhp =  SV_LHP::updateOrCreate([
                "lophocphan_id" => $lhp->id,
                "sinhvien_id" => $sinhvien->id,
            ]);
        }
    }
    public function rules(): array
    {
        return [
            'ma_so_sinh_vien' => 'required',
            '*.ma_so_sinh_vien' => 'required',
            'ten_sinh_vien' => 'required',
            '*.ten_sinh_vien' => 'required',
            'ma_lop_hoc_phan' => 'required',
            '*.ma_lop_hoc_phan' => 'required',
        ];
    }
    public function sheets(): array
    {
        return [
            'Sinh viên lớp học phần' => new SVLHPImport(),
        ];
    }
    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }
}