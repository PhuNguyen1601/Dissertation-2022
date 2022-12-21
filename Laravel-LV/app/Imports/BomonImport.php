<?php

namespace App\Imports;

use App\Models\Bomon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class BomonImport implements ToModel, WithHeadingRow, WithValidation, WithMultipleSheets, SkipsUnknownSheets
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */


    public function model(array $row)
    {
        $bomon = new Bomon([
            "mabm" => $row['ma_bo_mon'],
            "tenbm" => $row['ten_bo_mon'],
        ]);
        return $bomon;
    }
    public function rules(): array
    {
        return [
            'ma_bo_mon' => 'required|unique:bomon,mabm',
            '*.ma_bo_mon' => 'required|unique:bomon,mabm',
            'ten_bo_mon' => 'required',
            '*.ten_bo_mon' => 'required',
        ];
    }
    public function sheets(): array
    {
        return [
            'Bộ môn' => new BomonImport(),
        ];
    }
    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }
}