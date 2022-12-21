<?php

namespace App\Http\Controllers;

use DateTime;
use DatePeriod;
use DateInterval;
use App\Models\Hocki;
use App\Models\Kehoach;
use App\Models\Lichthi;
use App\Models\Ngaythi;
use App\Models\Nienkhoa;
use App\Models\Lophocphan;
use Illuminate\Http\Request;
use App\Imports\KehoachImport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Validators\Failure;

session_start();
class KehoachController extends Controller
{
    public function index()
    {
        $all_kh = Kehoach::all();
        $all_lkh = Kehoach::where('type', 1)->get();
        $all_nk = Nienkhoa::where('type', 0)->get();
        $all_hk = Hocki::where('type', 0)->get();
        $all_lhp = Lophocphan::where('type', 0)->get();
        $all_lhpp = Lophocphan::where('dangki', 1)->get('id')->pluck('id')->toArray();
        $today = date("Y-m-d");
        $manager_kh = view('kehoach.index')->with('today', $today)->with('all_lhpp', $all_lhpp)->with('all_lhp', $all_lhp)->with('all_kh', $all_kh)->with('all_lkh', $all_lkh)->with('all_hk', $all_hk)->with('all_nk', $all_nk);
        return view('layouts.admin')->with('manager_kh', $manager_kh);
    }

    //Thêm chức vụ
    public function save(Request $request)
    {
        request()->validate(
            [
                'tieude' => 'required',
                'ngaybd_dk' => 'required',
                'ngaykt_dk' => 'required|after:ngaybd_dk',
                'ngaybd_thi' => 'required|after:ngaykt_dk',
                'ngaykt_thi' => 'required|after:ngaybd_thi',
                'hocki' => 'required',
                'nienkhoa' => 'required',


            ],
            [
                'tieude.required' => 'Vui lòng nhập tiêu đề',
                'ngaybd_dk.required' => 'Vui lòng nhập ngày bắt đầu đăng kí',
                'ngaykt_dk.required' => 'Vui lòng nhập ngày kết thúc đăng kí',
                'ngaybd_thi.required' => 'Vui lòng nhập ngày bắt đầu thi',
                'ngaykt_thi.required' => 'Vui lòng nhập ngày kết thúc thi',
                'hocki.required' => 'Vui lòng chọn học kì',
                'nienkhoa.required' => 'Vui lòng chọn niên khóa',
                'ngaykt_dk.after' => 'Ngày kết thúc đăng kí phải sau ngày bắt đầu đăng kí',
                'ngaybd_thi.after' => 'Ngày bắt đầu thi phải sau ngày kết thúc đăng kí',
                'ngaykt_thi.after' => 'Ngày kết thúc thi phải sau ngày bắt đầu thi',
            ]
        );
        $kh = new Kehoach();
        $kh->tieude = $request->input('tieude');
        $kh->ngaybd_dk = $request->input('ngaybd_dk');
        $kh->ngaykt_dk = $request->input('ngaykt_dk');
        $kh->ngaybd_thi = $request->input('ngaybd_thi');
        $kh->ngaykt_thi = $request->input('ngaykt_thi');
        $kh->hkid = $request->input('hocki');
        $kh->nkid = $request->input('nienkhoa');
        $kh->save();
        $datelt = array();
        $format = 'Y-m-d';
        $interval = new DateInterval('P1D');
        $realEnd = new DateTime($request->input('ngaykt_thi'));
        $realEnd->add($interval);
        $period = new DatePeriod(new DateTime($request->input('ngaybd_thi')), $interval, $realEnd);
        foreach ($period as $date) {
            $array[] = $date->format($format);
        }
        $datelt = $array;
        $j = 1;
        for ($i = 0; $i <= 5; $i++) {
            $j++;
            $ngaythi = Ngaythi::find($j);
            $ngaythi->ngaythang = $datelt[$i];
            $ngaythi->update();
            if ($j == 7) break;
        }
        $tb = Toastr::success('Thêm kế hoạch thành công', 'Thành công');
        $html = Redirect::to('/admin/kehoach')->with('tb', $tb);
        return response()->json(['success' => true, 'html' => $html]);
    }
    //Cập nhật kế hoạch
    public function update(Request $request)
    {
        $kh = Kehoach::find($request->input('idkh'));
        request()->validate(
            [
                'tieude' => 'required',
                'ngaybd_dk' => 'required|after:yesterday',
                'ngaykt_dk' => 'required|after:ngaybd_dk',
                'ngaybd_thi' => 'required|after:ngaykt_dk',
                'ngaykt_thi' => 'required|after:ngaybd_thi',
                'hocki' => 'required',
                'nienkhoa' => 'required',
            ],
            [
                'tieude.required' => 'Vui lòng nhập tiêu đề',
                'ngaybd_dk.required' => 'Vui lòng nhập ngày bắt đầu đăng kí',
                'ngaykt_dk.required' => 'Vui lòng nhập ngày kết thúc đăng kí',
                'ngaybd_thi.required' => 'Vui lòng nhập ngày bắt đầu thi',
                'ngaykt_thi.required' => 'Vui lòng nhập ngày kết thúc thi',
                'hocki.required' => 'Vui lòng chọn học kì',
                'nienkhoa.required' => 'Vui lòng chọn niên khóa',
                'ngaybd_dk.after' => 'Ngày bắt đầu đăng kí phải sau hôm nay',
                'ngaykt_dk.after' => 'Ngày kết thúc đăng kí phải sau ngày bắt đầu đăng kí',
                'ngaybd_thi.after' => 'Ngày bắt đầu thi phải sau ngày kết thúc đăng kí',
                'ngaykt_thi.after' => 'Ngày kết thúc thi phải sau ngày bắt đầu thi',
            ]

        );
        $kh->tieude = $request->input('tieude');
        $kh->ngaybd_dk = $request->input('ngaybd_dk');
        $kh->ngaykt_dk = $request->input('ngaykt_dk');
        $kh->ngaybd_thi = $request->input('ngaybd_thi');
        $kh->ngaykt_thi = $request->input('ngaykt_thi');
        $kh->hkid = $request->input('hocki');
        $kh->nkid = $request->input('nienkhoa');
        $kh->update();
        $tb = Toastr::success('Cập nhật kế hoạch thành công', 'Thành công');
        $html = Redirect::to('/admin/kehoach')->with('tb', $tb);
        return response()->json(['success' => true, 'html' => $html]);
    }

    //Xóa kế hoạch
    public function hide($idkh)
    {

        $del = Kehoach::find($idkh);
        $del->type = 0;
        $del->update();
        return Redirect::to('/admin/kehoach');
    }
    //Xóa kế hoạch
    public function display($idkh)
    {

        $del = Kehoach::find($idkh);
        $del->type = 1;
        $del->update();
        return Redirect::to('/admin/kehoach');
    }

    public function importKH()
    {
        return view('kehoach.import');
    }
    public function uploadKH(Request $request)
    {
        try {
            Excel::import(new KehoachImport(), $request->file('file'));
            $tb = Toastr::success('Import CSV kế hoạch thành công', 'Thành công');
            return Redirect::to('/admin/kehoach')->with('tb', $tb);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            return redirect()->back()->with('import_errors', $failures);
        }
    }
}