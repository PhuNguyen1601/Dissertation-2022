<?php

namespace App\Imports;

use App\Models\Gio;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TiethocImport implements ToModel, WithHeadingRow, WithValidation, WithMultipleSheets, SkipsUnknownSheets
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $tiethoc = new Gio([
            "tiet" => $row['tiet_hoc'],
            "start_time" => $row['gio_bat_dau'],
            "end_time" => $row['gio_ket_thuc'],

        ]);
        return $tiethoc;
    }
    public function rules(): array
    {
        return [
            'tiet_hoc' => 'required|unique:gio,tiet',
            '*.tiet_hoc' => 'required|unique:gio,tiet',
            'gio_bat_dau' => 'required',
            '*.gio_bat_dau' => 'required',
            'gio_ket_thuc' => 'required',
            '*.gio_ket_thuc' => 'required',
        ];
    }
    public function sheets(): array
    {
        return [
            'Tiết học' => new TiethocImport(),
        ];
    }
    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }
}