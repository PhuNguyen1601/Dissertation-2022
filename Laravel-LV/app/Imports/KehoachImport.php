<?php

namespace App\Imports;

use App\Models\Hocki;
use App\Models\Kehoach;
use App\Models\Nienkhoa;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class KehoachImport implements ToModel, WithHeadingRow, WithValidation, WithMultipleSheets, SkipsUnknownSheets
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    private $hocki;
    private $nienkhoa;

    public function __construct()
    {
        $this->hocki = Hocki::select('id', 'hocki')->get();
        $this->nienkhoa = Nienkhoa::select('id', 'nienkhoa')->get();
    }
    public function headingRow(): int
    {
        return 1;
    }

    public function model(array $row)
    {
        $hk = $this->hocki->where('hocki',  $row['hoc_ki'])->first();
        $nk = $this->nienkhoa->where('nienkhoa', $row['nien_khoa'])->first();
        $kehoach = new Kehoach([
            'tieude' => $row['tieu_de'],
            'ngaybd_dk' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['ngay_bat_dau_dang_ki'])->format('Y-m-d'),
            'ngaykt_dk' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['ngay_ket_thuc_dang_ki'])->format('Y-m-d'),
            'ngaybd_thi' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['ngay_bat_dau_thi'])->format('Y-m-d'),
            'ngaykt_thi' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['ngay_ket_thuc_thi'])->format('Y-m-d'),
            'hkid' => $hk->id,
            'nkid' => $nk->id,
        ]);
        return $kehoach;
    }
    public function rules(): array
    {
        return [
            'tieu_de' => 'required',
            '*.tieu_de' => 'required',
            'ngay_bat_dau_dang_ki' => 'required',
            '*.ngay_bat_dau_dang_ki' => 'required',
            'ngay_ket_thuc_dang_ki' => 'required|after:ngay_bat_dau_dang_ki',
            '*.ngay_ket_thuc_dang_ki' => 'required|after:ngay_bat_dau_dang_ki',
            'ngay_bat_dau_thi' => 'required|after:ngay_ket_thuc_dang_ki',
            '*.ngay_bat_dau_thi' => 'required|after:ngay_ket_thuc_dang_ki',
            'ngay_ket_thuc_thi' => 'required|after:ngay_bat_dau_thi',
            '*.ngay_ket_thuc_thi' => 'required|after:ngay_bat_dau_thi',
            'hoc_ki' => 'required|exists:hocki,hocki',
            '*.hoc_ki' => 'required|exists:hocki,hocki',
            'nien_khoa' => 'required|exists:nienkhoa,nienkhoa',
            '*.nien_khoa' => 'required|exists:nienkhoa,nienkhoa',

        ];
    }
    public function sheets(): array
    {
        return [
            'Kế hoạch' => new KehoachImport(),
        ];
    }
    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }
}