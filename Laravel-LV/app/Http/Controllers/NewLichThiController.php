<?php

namespace App\Http\Controllers;

use DateTime;
use DatePeriod;
use DateInterval;
use App\Models\Gio;
use App\Models\SV_LHP;
use App\Models\Kehoach;
use App\Models\Lichthi;
use App\Models\Ngaythi;
use App\Models\NewGraph;
use App\Models\Lophocphan;
use App\Exports\LichthiExport;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class NewLichThiController extends Controller
{
    public function xeplich()
    {
        try {
            $nienkhoa = Kehoach::where('type', 0)->get('nkid')->pluck('nkid')->toArray();
            $hocki = Kehoach::where('type', 0)->get('hkid')->pluck('hkid')->toArray();
            $ds_lophocphan    = Lophocphan::where('dangki', 1)->where('nkid', $nienkhoa)->where('hkid', $hocki)->get('id')->pluck('id')->toArray();
            $graph            = new NewGraph(count($ds_lophocphan), $ds_lophocphan);
            $ds_sv_lophocphan = SV_LHP::where('type', 0)->whereIn('lophocphan_id', $ds_lophocphan)->get();

            foreach ($ds_sv_lophocphan as $value) {
                foreach ($ds_sv_lophocphan as $value2) {
                    if ($value->sinhvien_id == $value2->sinhvien_id && $value->lophocphan_id != $value2->lophocphan_id) {
                        $graph->setEdge($value->lophocphan_id, $value2->lophocphan_id);
                    }
                }
            }
            Lichthi::where('type', 0)->delete();
            $graph->scheduleExamination();
            return redirect()->route('laplich.index');
        } catch (ModelNotFoundException $exception) {
            $tb = Toastr::error('Có lỗi xảy ra vui lòng kiểm tra lại', 'Thất bại');
            return back()->with('tb', $tb);
        }
    }

    public function xemLich()
    {
        $all_lt = Lichthi::where('type', 0)->where('phongid', request()->phong)->get();
        $all_phong
            = Lichthi::where('type', 0)->select('phongid')->distinct()->get();
        $all_nt = Ngaythi::where('type', 0)->orderBy('ngay_thi')->get();
        $all_th = Gio::where('type', 0)->orderBy('tiet')->get();
        return view('lichthi.index', [
            'all_nt' => $all_nt,
            'all_th' => $all_th,
            'all_phong' => $all_phong,
            'all_lt' => collect($all_lt),
        ]);
    }

    public function showlichthi($id)
    {
        $all_lt = Lichthi::where('type', 0)->where('phongid', $id)->get();
        $all_nt = Ngaythi::where('type', 0)->orderBy('ngay_thi')->get();
        $all_th = Gio::where('type', 0)->orderBy('tiet')->get();
        $html = Redirect::to('/admin/lichthi')->with('all_lt', $all_lt)->with('all_nt', $all_nt)->with('all_th', $all_th);
        return response()->json(['success' => true, 'html' => $html]);
    }
    public function export()
    {
        $all_ltt = Lophocphan::where('dangki', 1)
            ->join('lichthi', 'lichthi.lhpid', 'lophocphan.id')
            ->join('ngay', 'lichthi.ngayid', 'ngay.id')
            ->join('gio', 'lichthi.gioid', 'gio.id')
            ->join('phong', 'lichthi.phongid', 'phong.id')
            ->join('giangvien', 'lophocphan.gvid', 'giangvien.id')
            ->join('hocphan', 'lophocphan.hpid', 'hocphan.id')
            ->select('malhp', 'magv', 'tengv', 'mahp', 'tenhp', 'ngaythang', 'map', 'tgthi', 'tiet', 'video')
            ->get();

        return Excel::download(new LichthiExport($all_ltt), 'Lichthi.xlsx');
    }
}