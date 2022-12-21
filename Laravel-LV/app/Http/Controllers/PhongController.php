<?php

namespace App\Http\Controllers;

use App\Models\Phong;
use Illuminate\Http\Request;
use App\Imports\PhongImport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Validators\Failure;

session_start();
class PhongController extends Controller
{
    public function index()
    {
        $all_p = Phong::where('type', 0)->get();
        $manager_p = view('phong.index')->with('all_p', $all_p);
        return view('layouts.admin')->with('manager_p', $manager_p);
    }

    //Thêm phòng
    public function save(Request $request)
    {
        request()->validate(
            [
                'map' => 'required|unique:phong',
                'succhua' => 'required',
            ],
            [
                'map.required' => 'Vui lòng nhập mã phòng',
                'succhua.required' => 'Vui lòng nhập sức chứa',
                'map.unique' => 'Mã phòng đã tồn tại',
            ]
        );
        $p = new Phong();
        $p->map = $request->input('map');
        $p->succhua = $request->input('succhua');
        $p->save();
        $tb = Toastr::success('Thêm phòng thành công', 'Thành công');
        $html = Redirect::to('/admin/phong')->with('tb', $tb);
        return response()->json(['success' => true, 'html' => $html]);
    }
    //Cập nhật phòng
    public function update(Request $request)
    {
        $p = Phong::find($request->input('idp'));
        request()->validate(
            [
                'map' => 'required|unique:phong,map,' . $p->id . '',
                'succhua' => 'required',
            ],
            [
                'map.required' => 'Vui lòng nhập mã phòng',
                'succhua.required' => 'Vui lòng nhập sức chứa',
                'map.unique' => 'Mã phòng đã tồn tại',

            ]
        );
        $p->map = $request->input('map');
        $p->succhua = $request->input('succhua');
        $p->update();
        $tb = Toastr::success('Cập nhật phòng thành công', 'Thành công');
        $html = Redirect::to('/admin/phong')->with('tb', $tb);
        return response()->json(['success' => true, 'html' => $html]);
    }

    //Xóa phòng
    public function delete(Request $request)
    {
        $phong = $request->phong;
        $del = Phong::whereIn('id', $phong)->update(['type' => 1]);
        Toastr::success('Xóa thành công!', 'Thành công');
        return Redirect::to('/admin/phong');
    }
    public function uploadP(Request $request)
    {
        try {
            $file = $request->file('file');
            Excel::import(new PhongImport, $file);
            $tb = Toastr::success('Import CSV phòng thành công', 'Thành công');
            return Redirect::to('/admin/phong')->with('tb', $tb);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            return redirect()->back()->with('import_errors', $failures);
        }
    }
}