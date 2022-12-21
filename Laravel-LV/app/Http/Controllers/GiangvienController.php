<?php

namespace App\Http\Controllers;

use App\Models\Bomon;
use App\Models\Giangvien;
use Illuminate\Http\Request;
use App\Imports\GiangvienImport;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Validators\Failure;

class GiangvienController extends Controller
{
    public function index()
    {
        $all_gv = Giangvien::where('type', 0)->get();
        $all_bm = Bomon::where('type', 0)->get();
        $manager_gv = view('giangvien.index')->with('all_gv', $all_gv)->with('all_bm', $all_bm);
        return view('layouts.admin')->with('manager_lhp', $manager_gv);
    }
    //Thêm chức vụ
    public function save(Request $request)
    {
        request()->validate(
            [
                'magv' => 'required|unique:giangvien',
                'tengv' => 'required',
                'email' => 'required|unique:giangvien',
                'ngaysinh' => 'required|before:yesterday',
                'bomon' => 'required'
            ],
            [
                'magv.unique' => 'Mã giảng viên đã tồn tại',
                'magv.required' => 'Vui lòng mã giảng viên giảng viên',
                'tengv.required' => 'Vui lòng nhập tên giảng viên',
                'email.unique' => 'email giảng viên đã tồn tại',
                'email.required' => 'Vui lòng email giảng viên',
                'ngaysinh.required' => 'Vui lòng nhập ngày sinh',
                'ngaysinh.before' => 'Vui lòng nhập ngày sinh nhỏ hơn hôm nay',
                'bomon.required' => 'Vui lòng chọn bộ môn',
            ]
        );
        $gv = new Giangvien();
        $gv->magv = $request->input('magv');
        $gv->tengv = $request->input('tengv');
        $gv->email = $request->input('email');
        $gv->ngaysinh = $request->input('ngaysinh');
        $gv->password = md5('123');
        $gv->bmid = $request->input('bomon');
        $gv->save();
        $tb = Toastr::success('Thêm giảng viên phần thành công', 'Thành công');
        $html = Redirect::to('/admin/giangvien')->with('tb', $tb);
        return response()->json(['success' => true, 'html' => $html]);
    }
    //Cập nhật lớp học phần
    public function update(Request $request)
    {
        $gv = Giangvien::find($request->input('gvid'));
        // request()->validate(
        //     [
        //         [
        //             'tengv' => 'required',
        //             'email' => 'required|unique:giangvien,email,' . $gv->id . '',
        //             'ngaysinh' => 'required|before:yesterday',
        //             'bomon' => 'required',
        //         ],
        //         [
        //             'tengv.required' => 'Vui lòng nhập tên giảng viên',
        //             'email.required' => 'Vui lòng email giảng viên',
        //             'email.unique' => 'Email giảng viên đã tồn tại',
        //             'ngaysinh.required' => 'Vui lòng nhập ngày sinh',
        //             'ngaysinh.before' => 'Vui lòng nhập ngày sinh nhỏ hơn hôm nay',
        //             'bomon.required' => 'Vui lòng chọn bộ môn',
        //         ],
        //     ],
        // );
        $gv->magv = $request->input('magv');
        $gv->tengv = $request->input('tengv');
        $gv->email = $request->input('email');
        $gv->ngaysinh = $request->input('ngaysinh');
        $gv->bmid = $request->input('bomon');
        $gv->update();
        $tb = Toastr::success('Cập nhật giảng viên thành công', 'Thành công');
        $html = Redirect::to('/admin/giangvien')->with('tb', $tb);
        return response()->json(['success' => true, 'html' => $html]);
    }
    //Xóa kế hoạch
    public function delete(Request $request)
    {
        $gvid = $request->gvid;
        $del = Giangvien::whereIn('id', $gvid)->update(['type' => 1]);
        Toastr::success('Xóa thành công', 'Thành công');
        return Redirect::to('/admin/giangvien');
    }
    public function importGV()
    {
        return view('giangvien.import');
    }
    public function uploadGV(Request $request)
    {
        // dd($request);
        try {
            Excel::import(new GiangvienImport(), $request->file('file'));
            $tb = Toastr::success('Import CSV giảng viên thành công', 'Thành công');
            return Redirect::to('/admin/giangvien')->with('tb', $tb);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            return redirect()->back()->with('import_errors', $failures);
        }
    }
}