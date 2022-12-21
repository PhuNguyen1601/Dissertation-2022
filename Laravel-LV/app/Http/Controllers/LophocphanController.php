<?php

namespace App\Http\Controllers;

use App\Models\Lophocphan;
use App\Models\Nienkhoa;
use App\Models\Hocki;
use App\Models\Hocphan;
use App\Models\Giangvien;
use Illuminate\Http\Request;
use App\Imports\LophocphanImport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\SV_LHP;
use Maatwebsite\Excel\Validators\Failure;

class LophocphanController extends Controller
{
    public function index()
    {
        $all_lhp = Lophocphan::where('type', 0)->get();
        $all_nk = Nienkhoa::where('type', 0)->get();
        $all_hk = Hocki::where('type', 0)->get();
        $all_gv = Giangvien::where('type', 0)->get();
        $all_hp = Hocphan::where('type', 0)->get();
        $manager_lhp = view('lophocphan.index')->with('all_lhp', $all_lhp)->with('all_hk', $all_hk)->with('all_gv', $all_gv)->with('all_hp', $all_hp)->with('all_nk', $all_nk);
        return view('layouts.admin')->with('manager_lhp', $manager_lhp);
    }
    //Thêm chức vụ
    public function save(Request $request)
    {
        request()->validate(
            [
                'malhp' => 'required|unique:lophocphan',
                'hocphan' => 'required',
                'giangvien' => 'required',
                'hocki' => 'required',
                'nienkhoa' => 'required',
            ],
            [
                'malhp.required' => 'Vui lòng nhập mã lớp học phần',
                'malhp.unique' => 'Mã lớp học phần đã tồn tại',
                'hocphan.required' => 'Vui lòng chọn học phần',
                'giangvien.required' => 'Vui lòng chọn giảng viên',
                'hocki.required' => 'Vui lòng chọn học kì',
                'nienkhoa.required' => 'Vui lòng chọn niên khóa',
            ]
        );
        $hp = Hocphan::where('type', 0)->where('id', $request->input('hocphan'))->first();
        $lhp = new Lophocphan();
        $lhp->malhp = $request->input('malhp');
        $lhp->hpid = $request->input('hocphan');
        $lhp->gvid = $request->input('giangvien');
        $lhp->hkid = $request->input('hocki');
        $lhp->nkid = $request->input('nienkhoa');
        $lhp->tgthi = ($hp->sotc === 1) ? 1 : (($hp->sotc === 2) ? 2 : (($hp->sotc === 3) ? 2 : (($hp->sotc === 4) ? 3 : 4)));
        $lhp->save();
        $tb = Toastr::success('Thêm lớp học phần thành công', 'Thành công');
        $html = Redirect::to('/admin/lophocphan')->with('tb', $tb);
        return response()->json(['success' => true, 'html' => $html]);
    }

    //Cập nhật lớp học phần
    public function update(Request $request)
    {
        $lhp = Lophocphan::find($request->input('idlhp'));
        request()->validate(
            [
                'malhp' => 'required|unique:lophocphan,malhp,' . $lhp->id . '',
                'hocphan' => 'required',
                'giangvien' => 'required',
                'hocki' => 'required',
                'nienkhoa' => 'required',
            ],
            [
                'malhp.required' => 'Vui lòng nhập mã lớp học phần',
                'malhp.unique' => 'Mã lớp học phần đã tồn tại',
                'hocphan.required' => 'Vui lòng chọn học phần',
                'giangvien.required' => 'Vui lòng chọn giảng viên',
                'hocki.required' => 'Vui lòng chọn học kì',
                'nienkhoa.required' => 'Vui lòng chọn niên khóa',
            ]
        );
        $hp = Hocphan::where('type', 0)->where('id', $request->input('hocphan'))->first();
        $lhp->malhp = $request->input('malhp');
        $lhp->hpid = $request->input('hocphan');
        $lhp->gvid = $request->input('giangvien');
        $lhp->hkid = $request->input('hocki');
        $lhp->nkid = $request->input('nienkhoa');
        $lhp->tgthi = ($hp->sotc === 1) ? 1 : (($hp->sotc === 2) ? 2 : (($hp->sotc === 3) ? 2 : (($hp->sotc === 4) ? 3 : 4)));
        $lhp->update();
        $tb = Toastr::success('Cập nhật lớp học phần thành công', 'Thành công');
        $html = Redirect::to('/admin/lophocphan')->with('tb', $tb);
        return response()->json(['success' => true, 'html' => $html]);
    }
    //Xóa kế hoạch
    public function delete($idlhp)
    {
        $del = Lophocphan::find($idlhp)->delete();
        $del->type = 1;
        $del->update();
        Toastr::success('Xóa thành công', 'Thành công');
        return Redirect::to('/admin/lophocphan');
    }

    public function uploadLHP(Request $request)
    {
        try {
            Excel::import(new LophocphanImport(), $request->file('file'));
            $tb = Toastr::success('Import CSV lớp học phần thành công', 'Thành công');
            return Redirect::to('/admin/lophocphan')->with('tb', $tb);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            return redirect()->back()->with('import_errors', $failures);
        }
    }
}