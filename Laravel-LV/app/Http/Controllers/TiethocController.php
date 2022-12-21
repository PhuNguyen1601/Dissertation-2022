<?php

namespace App\Http\Controllers;

use App\Models\Gio;
use App\Imports\PhongImport;
use Illuminate\Http\Request;
use App\Imports\TiethocImport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Validators\Failure;

session_start();
class TiethocController extends Controller
{
    public function index()
    {
        $all_th = Gio::where('type', 0)->get();
        $manager_th = view('tiethoc.index')->with('all_th', $all_th);
        return view('layouts.admin')->with('manager_th', $manager_th);
    }

    //Thêm tiết học
    public function save(Request $request)
    {
        request()->validate(
            [
                'tiethoc' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
            ],
            [
                'tiethoc.required' => 'Vui lòng nhập tiết học',
                'start_time.required' => 'Vui lòng nhập giờ bắt đầu',
                'end_time.required' => 'Vui lòng nhập giờ kết thúc',
            ]
        );
        $th = new Gio();
        $th->tiet = $request->input('tiethoc');
        $th->start_time = $request->input('start_time');
        $th->end_time = $request->input('end_time');
        $th->save();
        $tb = Toastr::success('Thêm tiết học thành công', 'Thành công');
        $html = Redirect::to('/admin/tiethoc')->with('tb', $tb);
        return response()->json(['success' => true, 'html' => $html]);
    }
    // //Cập nhật phòng
    // public function update(Request $request)
    // {
    //     $p = Phong::find($request->input('idp'));
    //     request()->validate(
    //         [
    //             'map' => 'required|unique:phong,map,' . $p->id . '',
    //             'succhua' => 'required',
    //         ],
    //         [
    //             'map.required' => 'Vui lòng nhập mã phòng',
    //             'succhua.required' => 'Vui lòng nhập sức chứa',
    //             'map.unique' => 'Mã phòng đã tồn tại',

    //         ]
    //     );
    //     $p->map = $request->input('map');
    //     $p->succhua = $request->input('succhua');
    //     $p->update();
    //     $tb = Toastr::success('Cập nhật phòng thành công', 'Thành công');
    //     $html = Redirect::to('/admin/phong')->with('tb', $tb);
    //     return response()->json(['success' => true, 'html' => $html]);
    // }

    //Xóa cộng tác viên
    public function delete($math)
    {
        $del = Gio::find($math);
        $del->type = 1;
        $del->update();
        Toastr::success('Xóa thành công', 'Thành công');
        return Redirect::to('/admin/tiethoc');
    }
    public function uploadTH(Request $request)
    {
        try {
            $file = $request->file('file');
            Excel::import(new TiethocImport, $file);
            $tb = Toastr::success('Import CSV tiết học thành công', 'Thành công');
            return Redirect::to('/admin/tiethoc')->with('tb', $tb);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            return redirect()->back()->with('import_errors', $failures);
        }
    }
}