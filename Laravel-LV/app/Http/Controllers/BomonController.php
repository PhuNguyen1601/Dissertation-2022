<?php

namespace App\Http\Controllers;

use App\Models\Bomon;
use Illuminate\Http\Request;
use App\Imports\BomonImport;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;

session_start();
class BomonController extends Controller
{
    public function index()
    {

        $all_bm = Bomon::where('type', 0)->get();
        $manager_bm = view('bomon.index')->with('all_bm', $all_bm);
        return view('layouts.admin')->with('manager_bm', $manager_bm);
    }

    //Thêm bộ môn
    public function save(Request $request)
    {
        request()->validate(
            [
                'mabm' => 'required|unique:bomon',
                'tenbm' => 'required',
            ],
            [
                'mabm.required' => 'Vui lòng nhập mã bộ môn',
                'tenbm.required' => 'Vui lòng nhập tên bộ môn',
                'mabm.unique' => 'Mã bộ môn đã tồn tại',
            ]
        );
        $bm = new Bomon();
        $bm->mabm = $request->input('mabm');
        $bm->tenbm = $request->input('tenbm');
        $bm->save();
        $tb = Toastr::success('Thêm bộ môn thành công', 'Thành công');
        $html = Redirect::to('/admin/bomon')->with('tb', $tb);
        return response()->json(['success' => true, 'html' => $html]);
    }
    //Cập nhật bộ môn
    public function update(Request $request)
    {
        $bm = Bomon::find($request->input('idbm'));
        request()->validate(
            [
                'mabm' => 'required|unique:bomon,mabm,' . $bm->id . '',
                'tenbm' => 'required',
            ],
            [
                'mabm.required' => 'Vui lòng nhập mã bộ môn',
                'tenbm.required' => 'Vui lòng nhập tên bộ môn',
                'mabm.unique' => 'Mã bộ môn đã tồn tại',
            ]
        );
        $bm->mabm = $request->input('mabm');
        $bm->tenbm = $request->input('tenbm');
        $bm->update();
        $tb = Toastr::success('Cập nhật bộ môn thành công', 'Thành công');
        $html = Redirect::to('/admin/bomon')->with('tb', $tb);
        return response()->json(['success' => true, 'html' => $html]);
    }

    //Xóa bộ môn
    public function delete(Request $request)
    {
        $bmid = $request->bmid;
        $del = Bomon::whereIn('id', $bmid)->update(['type' => 1]);
        Toastr::success('Xóa thành công', 'Thành công');
        return Redirect::to('/admin/bomon');
    }

    public function uploadbm(Request $request)
    {
        try {
            $file = $request->file('file');
            Excel::import(new BomonImport, $file);
            $tb = Toastr::success('Import CSV bộ môn thành công', 'Thành công');
            return Redirect::to('/admin/bomon')->with('tb', $tb);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            return redirect()->back()->with('import_errors', $failures);
        }
    }
}