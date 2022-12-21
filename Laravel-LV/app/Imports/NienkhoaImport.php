<?php

namespace App\Imports;

use App\Models\Nienkhoa;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class NienkhoaImport implements ToModel, WithHeadingRow, WithValidation, WithMultipleSheets, SkipsUnknownSheets
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $nienkhoa = new Nienkhoa([
            'nienkhoa' => $row['nien_khoa']
        ]);
        return $nienkhoa;
    }
    public function rules(): array
    {
        return [
            'nien_khoa' => 'required',
            '*.nien_khoa' => 'required',
        ];
    }
    public function sheets(): array
    {
        return [
            'Niên khóa' => new NienkhoaImport(),
        ];
    }
    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }
}