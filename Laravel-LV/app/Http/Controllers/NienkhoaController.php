<?php

namespace App\Http\Controllers;

use App\Models\Nienkhoa;
use Illuminate\Http\Request;
use App\Imports\NienkhoaImport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Validators\Failure;

session_start();
class NienkhoaController extends Controller
{
    public function index()
    {
        $all_nk = Nienkhoa::where('type', 0)->get();
        $manager_nk = view('nienkhoa.index')->with('all_nk', $all_nk);
        return view('layouts.admin')->with('manager_nk', $manager_nk);
    }

    //Thêm niên khóa
    public function save(Request $request)
    {
        request()->validate(
            [
                'nienkhoa' => 'required',
            ],
            [
                'nienkhoa.required' => 'Vui lòng nhập niên khóa',
            ]
        );
        $nk = new Nienkhoa();
        $nk->nienkhoa = $request->input('nienkhoa');
        $nk->save();
        $tb = Toastr::success('Thêm niên khóa thành công', 'Thành công');
        $html = Redirect::to('/admin/nienkhoa')->with('tb', $tb);
        return response()->json(['success' => true, 'html' => $html]);
    }
    //Cập nhật niên khóa
    public function update(Request $request)
    {
        $nk = Nienkhoa::find($request->input('idnk'));
        request()->validate(
            [
                'nienkhoa' => 'required',
            ],
            [
                'nienkhoa.required' => 'Vui lòng nhập niên khóa',

            ]
        );
        $nk->nienkhoa = $request->input('nienkhoa');
        $nk->update();
        $tb = Toastr::success('Cập nhật niên khóa thành công', 'Thành công');
        $html = Redirect::to('/admin/nienkhoa')->with('tb', $tb);
        return response()->json(['success' => true, 'html' => $html]);
    }

    //Xóa niên khóa
    public function delete($idnk)
    {
        $del = Nienkhoa::find($idnk);
        $del->type = 1;
        $del->update();
        Toastr::success('Xóa thành công', 'Thành công');
        return Redirect::to('/admin/nienkhoa');
    }

    public function uploadNK(Request $request)
    {
        try {
            $file = $request->file('file');

            Excel::import(new NienkhoaImport, $file);
            $tb = Toastr::success('Import CSV niên khóa thành công', 'Thành công');
            return Redirect::to('/admin/nienkhoa')->with('tb', $tb);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            return redirect()->back()->with('import_errors', $failures);
        }
    }
}