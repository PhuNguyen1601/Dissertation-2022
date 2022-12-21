<?php

namespace App\Imports;

use App\Models\Hocki;
use App\Models\Giangvien;
use App\Models\Lophocphan;
use App\Models\Nienkhoa;
use App\Models\Hocphan;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class LophocphanImport implements ToModel, WithHeadingRow, WithValidation, WithMultipleSheets, SkipsUnknownSheets
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    private $hocki;
    private $nienkhoa;
    private $giangvien;
    private $hocphan;

    public function __construct()
    {
        $this->hocki = Hocki::select('id', 'hocki')->get();
        $this->hocphan = Hocphan::select('id', 'tenhp', 'sotc')->get();
        $this->giangvien = Giangvien::select('id', 'tengv')->get();
        $this->nienkhoa = Nienkhoa::select('id', 'nienkhoa')->get();
    }

    public function model(array $row)
    {
        $hk = $this->hocki->where('hocki', $row['hoc_ki'])->first();
        $gv = $this->giangvien->where('tengv', $row['giang_vien'])->first();
        $nk = $this->nienkhoa->where('nienkhoa', $row['nien_khoa'])->first();
        $hp = $this->hocphan->where('tenhp', $row['hoc_phan'])->first();
        $lophocphan = Lophocphan::updateOrCreate([
            'malhp' => $row['ma_lop_hoc_phan'],
            'tgthi' => ($hp->sotc === 1) ? 1 : (($hp->sotc === 2) ? 2 : (($hp->sotc === 3) ? 2 : (($hp->sotc === 4) ? 3 : 4))),
            'hpid' => $hp->id,
            'hkid' => $hk->id,
            'nkid' => $nk->id,
            'gvid' => $gv->id,
        ]);
        return $lophocphan;
    }
    public function rules(): array
    {
        return [
            'ma_lop_hoc_phan' => 'required|unique:lophocphan,malhp',
            '*.ma_lop_hoc_phan' => 'required|unique:lophocphan,malhp',
            'hoc_phan' => 'required|exists:hocphan,tenhp',
            '*.hoc_phan' => 'required|exists:hocphan,tenhp',
            'giang_vien' => 'required|exists:giangvien,tengv',
            '*.giang_vien' => 'required|exists:giangvien,tengv',
            'hoc_ki' => 'required|exists:hocki,hocki',
            '*.hoc_ki' => 'required|exists:hocki,hocki',
            'nien_khoa' => 'required|exists:nienkhoa,nienkhoa',
            '*.nien_khoa' => 'required|exists:nienkhoa,nienkhoa',

        ];
    }
    public function sheets(): array
    {
        return [
            'Lớp học phần' => new LophocphanImport(),
        ];
    }
    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }
}