<?php

namespace App\Imports;

use App\Models\Phong;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PhongImport implements ToModel, WithHeadingRow, WithValidation, WithMultipleSheets, SkipsUnknownSheets
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $phong = new Phong([
            "map" => $row['ma_phong'],
            "succhua" => $row['suc_chua'],
        ]);
        return $phong;
    }
    public function rules(): array
    {
        return [
            'ma_phong' => 'required|unique:phong,map',
            '*.ma_phong' => 'required|unique:phong,map',
            'suc_chua' => 'required',
            '*.suc_chua' => 'required',
        ];
    }
    public function sheets(): array
    {
        return [
            'Phòng' => new PhongImport(),
        ];
    }
    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }
}