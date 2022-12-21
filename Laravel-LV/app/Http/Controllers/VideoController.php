<?php

namespace App\Http\Controllers;

use App\Models\Lichthi;
use App\Models\Lophocphan;
use App\Models\Video;
use App\Imports\PhongImport;
use Illuminate\Http\Request;
use App\Imports\TiethocImport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Validators\Failure;

session_start();
class VideoController extends Controller
{
    public function index()
    {
        $id = Session::get('id');
        $all_lt =
            Lophocphan::where('dangki', 1)
            ->join('lichthi', 'lichthi.lhpid', 'lophocphan.id')
            ->join('ngay', 'lichthi.ngayid', 'ngay.id')
            ->join('gio', 'lichthi.gioid', 'gio.id')
            ->join('phong', 'lichthi.phongid', 'phong.id')
            ->join('giangvien', 'lophocphan.gvid', 'giangvien.id')
            ->join('hocphan', 'lophocphan.hpid', 'hocphan.id')
            ->where('lophocphan.gvid', $id)
            ->select('lichthi.id', 'malhp', 'magv', 'tengv', 'mahp', 'tenhp', 'ngaythang', 'map', 'tgthi', 'tiet', 'video', 'videodec')
            ->get();
        // ->select('lichthi.*')
        $manager_th = view('videodec.index')->with('all_lt', $all_lt);
        return view('layouts.admin')->with('manager_th', $manager_th);
    }
    public function lichthi()
    {
        $all_ltt = Lophocphan::where('dangki', 1)
            ->join('lichthi', 'lichthi.lhpid', 'lophocphan.id')
            ->join('ngay', 'lichthi.ngayid', 'ngay.id')
            ->join('gio', 'lichthi.gioid', 'gio.id')
            ->join('phong', 'lichthi.phongid', 'phong.id')
            ->join('giangvien', 'lophocphan.gvid', 'giangvien.id')
            ->join('hocphan', 'lophocphan.hpid', 'hocphan.id')
            ->select('lichthi.id', 'malhp', 'magv', 'tengv', 'mahp', 'tenhp', 'ngaythang', 'map', 'tgthi', 'tiet', 'video')
            ->get();
        $manager_th = view('videodec.lichthi')->with('all_ltt', $all_ltt);
        return view('layouts.admin')->with('manager_th', $manager_th);
    }

    public function upload(Request $request)
    {
        request()->validate(
            [
                'file' => 'required',
            ],
            [
                'file.required' => 'Vui lòng chọn video!',
            ]
        );
        $fileName = time() . '.' . request()->file->getClientOriginalExtension();
        $request->file->move("D:/laragon/www/Demo-LV/Luanvan/public/videos", $fileName);
        $vd = Lichthi::find($request->input('lichthiid'));
        $vd->video = $fileName;
        $vd->update();
        $tb = Toastr::success('Tải lên video thành công', 'Thành công');
        $html = Redirect::back()->with('tb', $tb);
        return response()->json(['success' => true, 'html' => $html]);
    }
    public function detec(Request $request)
    {
        $vd = Lichthi::find($request->input('idlthi'));
        $vd->videodec = 'detection-' . $request->input('videodetec');
        $vd->update();
        $tb = Toastr::success('Kiểm tra thành công!', 'Thành công');
        $videodetection = $request->input('videodetec');
        $html = Redirect::back()->with('tb', $tb);
        return response()->json(['success' =>
        true, 'html' => $html, 'videodetection' => $videodetection]);
    }

    public function decvideo($id)
    {
        $videoModel = Lichthi::find($id);
        $manager_video = view('videodec.result')->with('videodec', $videoModel);
        return view('layouts.admin')->with('manager_video', $manager_video);
    }

    public function delete()
    {
        $file = new Filesystem;
        $file->cleanDirectory(public_path('ImagesTesting'));
        $tb = Toastr::success('Đã hoàn thành kiểm tra!', 'Thành công');
        $manager_th = view('dashboard')->with('tb', $tb);
        return view('layouts.admin')->with('manager_th', $manager_th);
    }
    public function download(Request $request)
    {
        $path = public_path('videos/') . $request->input('filevd');
        return response()->download($path);
    }
}