<?php

namespace App\Http\Controllers;

use App\Models\Hocki;
use Illuminate\Http\Request;
use App\Imports\HockiImport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Validators\Failure;

session_start();
class HockiController extends Controller
{
    public function index()
    {
        $all_hk = Hocki::where('type', 0)->get();
        $manager_hk = view('hocki.index')->with('all_hk', $all_hk);
        return view('layouts.admin')->with('manager_hk', $manager_hk);
    }

    //Thêm học kì
    public function save(Request $request)
    {
        request()->validate(
            [
                'hocki' => 'required',
            ],
            [
                'hocki.required' => 'Vui lòng nhập học kì',
            ]
        );
        $hk = new Hocki();
        $hk->hocki = $request->input('hocki');
        $hk->save();
        $tb = Toastr::success('Thêm học kì thành công', 'Thành công');
        $html = Redirect::to('/admin/hocki')->with('tb', $tb);
        return response()->json(['success' => true, 'html' => $html]);
    }
    //Cập nhật học kì
    public function update(Request $request)
    {
        $hk = Hocki::find($request->input('idhk'));
        request()->validate(
            [
                'hocki' => 'required',
            ],
            [
                'hocki.required' => 'Vui lòng nhập học kì',

            ]
        );
        $hk->hocki = $request->input('hocki');
        $hk->update();
        $tb = Toastr::success('Cập nhật học kì thành công', 'Thành công');
        $html = Redirect::to('/admin/hocki')->with('tb', $tb);
        return response()->json(['success' => true, 'html' => $html]);
    }

    //Xóa học kì
    public function delete($idhk)
    {

        $del = Hocki::find($idhk);
        $del->type = 1;
        $del->update();
        Toastr::success('Xóa thành công', 'Thành công');
        return Redirect::to('/admin/hocki');
    }
    // public function importCV()
    // {
    //     return view('chucvu.import');
    // }
    // public function uploadCV(Request $request)
    // {
    //     try {
    //         $file = $request->file('file');

    //         Excel::import(new ChucvuImport, $file);
    //         $tb = Toastr::success('Import CSV chức vụ thành công', 'Thành công');
    //         return Redirect::to('/admin/chucvu')->with('tb', $tb);
    //     } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
    //         $failures = $e->failures();
    //         return redirect()->back()->with('import_errors', $failures);
    //         // foreach ($failures as $failure) {
    //         //     $failure->row(); // row that went wrong
    //         //     $failure->attribute(); // either heading key (if using heading row concern) or column index
    //         //     $failure->errors(); // Actual error messages from Laravel validator
    //         //     $failure->values(); // The values of the row that has failed.
    //     }
    // }
}