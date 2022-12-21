<?php

namespace App\Http\Controllers;

use App\Models\Hocki;
use App\Models\SV_LHP;
use App\Models\Hocphan;
use App\Models\Kehoach;
use App\Models\Nienkhoa;
use App\Models\Sinhvien;
use App\Models\Lophocphan;
use Illuminate\Http\Request;
use App\Imports\LophocphanImport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Validators\Failure;

class DangkithiController extends Controller
{
    public function index()
    {
        $id = Session::get('id');
        $all_kh = Kehoach::where('type', 0)->first();
        $today = date("Y-m-d");
        if (($today >= $all_kh->ngaybd_dk) && ($all_kh->ngaykt_dk >= $today)) {
            $check = 0;
        } else {
            $check = 1;
        }
        $hk = $all_kh->hkid;
        $nk = $all_kh->nkid;
        $all_lhp = Lophocphan::where('gvid', $id)->where('hkid', $hk)->where('nkid', $nk)->get();
        $manager_dkt = view('dangkithi.index')->with('all_lhp', $all_lhp)->with('all_kh', $all_kh)->with('check', $check);
        return view('layouts.admin')->with('manager_kh', $manager_dkt);
    }
    public function dangki(Request $request)
    {
        $lhpid = $request->lhpid;
        $del = Lophocphan::whereIn('id', $lhpid)->update(['dangki' => 1]);
        Toastr::success('Đăng kí thành công', 'Thành công');
        return Redirect::to('/admin/dangkithi');
    }
    public function svlhp($lhpid)
    {
        $all_sv_lhp = SV_LHP::where('lophocphan_id', $lhpid)->where('type', 0)->get();
        $all_ss_lhp = SV_LHP::where('lophocphan_id', $lhpid)->count();
        $all_lhp = Lophocphan::where('id', $lhpid)->where('type', 0)->get();
        $all_sv = Sinhvien::all();
        $manager_sv_lhp = view('dangkithi.dssv')->with('all_sv_lhp', $all_sv_lhp)
            ->with('all_ss_lhp', $all_ss_lhp)
            ->with('all_sv', $all_sv)->with('all_lhp', $all_lhp);
        return view('layouts.admin')->with('manager_sv_lhp', $manager_sv_lhp);
    }
}