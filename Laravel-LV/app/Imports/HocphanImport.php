<?php

namespace App\Imports;

use App\Models\Hocphan;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class HocphanImport implements ToModel, WithHeadingRow, WithValidation, WithMultipleSheets, SkipsUnknownSheets
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $hocphan = new Hocphan([
            "mahp" => $row['ma_hoc_phan'],
            "tenhp" => $row['ten_hoc_phan'],
            "sotc" => $row['so_tin_chi'],
        ]);
        return $hocphan;
    }
    public function rules(): array
    {
        return [
            'ma_hoc_phan' => 'required|unique:hocphan,mahp',
            '*.ma_hoc_phan' => 'required|unique:hocphan,mahp',
            'ten_hoc_phan' => 'required',
            '*.ten_hoc_phan' => 'required',
            'so_tin_chi' => 'required',
            '*.so_tin_chi' => 'required',
        ];
    }
    public function sheets(): array
    {
        return [
            'Học phần' => new HocphanImport(),
        ];
    }
    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }
}