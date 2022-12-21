@extends('layouts.admin')
@section('title','Lịch thi')
@section('maincontent')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><strong>Lịch thi</strong></h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="text-right">
                <a href="{{ route('video.lichthi') }}" class="btn btn-primary">Xem chi tiết</a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

              <div class="row">
                <div class="col-1">
                  <table class="table table-bordered table-striped">
                    <thead>
                      <th>Phòng thi</th>
                    </thead>
                    <tbody>
                      <td>
                        @foreach ($all_phong as $phong)
                        <div>
                          <input type="checkbox" class="checkoption"
                            data-url="{{ route('lichthi.show',$phong->phongid) }}" data-value="{{ $phong->phongid }}"
                            @if($phong->phongid == request()->phong) checked="checked" @endif id="">
                          {{ $phong->phong->map }}
                        </div>
                        @endforeach
                      </td>
                    </tbody>
                  </table>
                </div>
                <div class="col-11">
                  <table class="table table-bordered  text-center">
                    <thead>
                      <th width="125">Tiết</th>
                      @foreach ($all_nt ?? '' as $date)
                      <th>{{ $date->ngay_thi}}<br>
                        {{date('d/m/Y', strtotime($date->ngaythang)) }}
                      </th>

                      @endforeach
                    </thead>
                    <tbody>
                      @php
                      $colspan = [];
                      @endphp
                      @foreach($all_th as $th)
                      <tr>
                        <td> {{ $th->tiet}}
                          <br>{{ "(".$th->start_time ."-" .$th->end_time.")" }}
                        </td>
                        @foreach($all_nt ?? '' as $nt)
                        @php
                        $ds_lichthi = $all_lt->where('ngayid', $nt->id)->where('gioid', $th->id);
                        @endphp
                        @if (count($ds_lichthi)> 0)
                        @php
                        $lichthi = $ds_lichthi->first();
                        $colspan[$nt->id] = $lichthi->lophocphan->tgthi - 1;
                        @endphp
                        <td class="align-middle text-center" rowspan="{{ $lichthi->lophocphan->tgthi }}"
                          style="background-color:#f0f0f0">
                          <p>
                            {{ $lichthi->lophocphan->malhp }}
                            </br>{{ $lichthi->lophocphan->giangvien->tengv }}
                            </br>Thời gian: {{ $lichthi->lophocphan->tgthi*30 }} Phút

                          </p>
                        </td>
                        @else
                        @if (isset($colspan[$nt->id]) && $colspan[$nt->id] > 0)
                        @php
                        $colspan[$nt->id] --;
                        @endphp
                        @else
                        <td></td>
                        @endif
                        @endif
                        @endforeach
                      </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
@section('js-lichthi')

<script>
  $(document).ready(function(){
  
  $('.checkoption').click(function() {
    $('.checkoption').not(this).prop('checked', false);
      var phongid = $(this).data('value');
      console.log(phongid);
      location.href = '?phong=' + phongid;
    });
  });
</script>
@endsection
@endsection