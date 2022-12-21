<?php

namespace App\Http\Controllers;

use App\Models\SV_LHP;
use App\Models\Sinhvien;
use App\Models\Lophocphan;
use App\Imports\SVLHPImport;
use App\Imports\SinhvienImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Validators\Failure;

class SVLHPController extends Controller
{
    public function index($lhpid)
    {
        $all_sv_lhp = SV_LHP::where('lophocphan_id', $lhpid)->where('type', 0)->get();
        $all_ss_lhp = SV_LHP::where('lophocphan_id', $lhpid)->count();
        $all_lhp = Lophocphan::where('id', $lhpid)->where('type', 0)->get();
        $all_sv = Sinhvien::all();
        $manager_sv_lhp = view('lophocphan.listsv')->with('all_sv_lhp', $all_sv_lhp)
            ->with('all_ss_lhp', $all_ss_lhp)
            ->with('all_sv', $all_sv)->with('all_lhp', $all_lhp);
        return view('layouts.admin')->with('manager_sv_lhp', $manager_sv_lhp);
    }
    public function save(Request $request)
    {
        request()->validate(
            [
                'sinhvien' => 'required',
            ],
            [
                'sinhvien.required' => 'Vui lòng chọn sinh viên',
            ]
        );
        $sv_lhp = new SV_LHP();
        $sv_lhp->lophocphan_id = $request->input('lophocphan');
        $sv_lhp->sinhvien_id = $request->input('sinhvien');
        $sv_lhp->save();
        $tb = Toastr::success('Thêm sinh viên vào lớp học phần thành công', 'Thành công');
        $html = Redirect::to('/admin/lophocphan')->with('tb', $tb);
        return response()->json(['success' => true, 'html' => $html]);
    }
    public function delete($idlhp)
    {
        $del = SV_LHP::find($idlhp);
        $del->type = 1;
        $del->update();
        Toastr::success('Xóa thành công', 'Thành công');
        return back();
    }

    public function uploadSVLHP(Request $request)
    {
        try {
            Excel::import(new SVLHPImport,  $request->file('file'));
            $tb = Toastr::success('Import CSV sinh viên vào lớp thành công', 'Thành công');
            return back()->with('tb', $tb);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failuress = $e->failures();
            return redirect()->back()->with('import_errorss', $failuress);
        }
    }
}