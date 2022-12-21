<?php

namespace App\Http\Controllers;

use App\Models\Hocphan;
use Illuminate\Http\Request;
use App\Imports\HocphanImport;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;

session_start();
class HocphanController extends Controller
{
    public function index()
    {
        $all_hp = Hocphan::where('type', 0)->get();
        $manager_hp = view('hocphan.index')->with('all_hp', $all_hp);
        return view('layouts.admin')->with('manager_hp', $manager_hp);
    }

    //Thêm chức vụ
    public function save(Request $request)
    {
        request()->validate(
            [
                'mahp' => 'required|unique:hocphan',
                'tenhp' => 'required',
                'sotc' => 'required',

            ],
            [
                'mahp.required' => 'Vui lòng nhập mã học phần',
                'mahp.unique' => 'Mã học phần đã tồn tại',
                'tenhp.required' => 'Vui lòng nhập tên học phần',
                'sotc.required' => 'Vui lòng nhập số tín chỉ',
            ]
        );
        $hp = new Hocphan();
        $hp->mahp = $request->input('mahp');
        $hp->tenhp = $request->input('tenhp');
        $hp->sotc = $request->input('sotc');
        $hp->save();
        $tb = Toastr::success('Thêm học phần thành công', 'Thành công');
        $html = Redirect::to('/admin/hocphan')->with('tb', $tb);
        return response()->json(['success' => true, 'html' => $html]);
    }
    //Cập nhật chức vụ
    public function update(Request $request)
    {
        $hp = Hocphan::find($request->input('idhp'));
        request()->validate(
            [
                'mahp' => 'required|unique:hocphan,mahp,' . $hp->id . '',
                'tenhp' => 'required',
                'sotc' => 'required',

            ],
            [
                'mahp.required' => 'Vui lòng nhập mã học phần',
                'mahp.unique' => 'Mã học phần đã tồn tại',
                'tenhp.required' => 'Vui lòng nhập tên học phần',
                'sotc.required' => 'Vui lòng nhập số tín chỉ',
            ]
        );
        $hp->mahp = $request->input('mahp');
        $hp->tenhp = $request->input('tenhp');
        $hp->sotc = $request->input('sotc');
        $hp->update();
        $tb = Toastr::success('Cập nhật học phần thành công', 'Thành công');
        $html = Redirect::to('/admin/hocphan')->with('tb', $tb);
        return response()->json(['success' => true, 'html' => $html]);
    }

    //Xóa cộng tác viên
    public function delete(Request $request)
    {
        $hpid = $request->hpid;
        $del = Hocphan::whereIn('id', $hpid)->update(['type' => 1]);
        Toastr::success('Xóa thành công!', 'Thành công');
        return Redirect::to('/admin/hocphan');
    }

    public function uploadHP(Request $request)
    {
        try {
            $file = $request->file('file');

            Excel::import(new HocphanImport, $file);
            $tb = Toastr::success('Import CSV học phần thành công!', 'Thành công');
            return Redirect::to('/admin/hocphan')->with('tb', $tb);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            return redirect()->back()->with('import_errors', $failures);
        }
    }
}