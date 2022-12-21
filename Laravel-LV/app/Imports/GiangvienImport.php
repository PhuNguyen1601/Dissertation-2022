<?php

namespace App\Imports;

use App\Models\Giangvien;
use App\Models\Bomon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class GiangvienImport implements ToModel, WithHeadingRow, WithValidation, WithMultipleSheets, SkipsUnknownSheets
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    private $bomon;

    public function __construct()
    {
        $this->bomon = Bomon::select('id', 'tenbm')->get();
    }

    public function model(array $row)
    {
        $bm = $this->bomon->where('tenbm', $row['bo_mon'])->first();
        $giangvien = new Giangvien([
            'magv' => $row['ma_giang_vien'],
            'tengv' => $row['ten_giang_vien'],
            'email' => $row['email'],
            'ngaysinh' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['ngay_sinh'])->format('Y-m-d'),
            'bmid' => $bm->id,
            'password' => md5('123'),

        ]);
        return $giangvien;
    }
    public function rules(): array
    {
        return [
            'ma_giang_vien' => 'required',
            '*.ma_giang_vien' => 'required',
            'ten_giang_vien' => 'required',
            '*.ten_giang_vien' => 'required',
            'email' => 'required|unique:giangvien',
            '*.email' => 'required|unique:giangvien',
            'ngay_sinh' => 'required|before:yesterday',
            '*.ngay_sinh' => 'required|before:yesterday',
            'bo_mon' => 'required|exists:bomon,tenbm',
            '*.bo_mon' => 'required|exists:bomon,tenbm'
        ];
    }
    public function sheets(): array
    {
        return [
            'Giảng viên' => new GiangvienImport(),
        ];
    }
    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }
}