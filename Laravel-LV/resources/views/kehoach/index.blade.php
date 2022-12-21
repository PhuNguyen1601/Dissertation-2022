a@extends('layouts.admin')
@section('title','Kế hoạch')
@section('maincontent')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><strong>Kế hoạch</strong></h1>
        </div>
        <div class="text-right col-sm-6">
          <form method="POST" action="{{route('lophocphan.upload')}}" enctype="multipart/form-data">
            @csrf
            <label for="upload-file" style="cursor: pointer;">Kế hoạch: </label>
            <input type="file" name="file" id="upload-file" accept=".xlsx"
              style="opacity: 0; position: absolute; z-index: -1;" />
            <button class="btn btn-success text-right"> Import</button>
          </form>
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
              <h3 class="card-title">Danh sách kế hoạch</h3>
              <div class="text-right">
                <button class="btn btn-primary text-right" data-toggle="modal" data-target="#add_kh"> Thêm
                  mới</button>
              </div>
              <div class="text-center">
                @if (Session::has("import_errors"))
                <h5 class="text-center" style="color:red">Có lỗi import CSV! Vui lòng kiểm
                  tra lại file CSV</h5>
                <ol>
                  @foreach (Session::get('import_errors') as $failure)
                  <li type="none" class="text-center" style="color:red">Có lỗi trên dòng
                    {{$failure->row() }} file CSV</li>
                  @endforeach
                </ol>
                @endif
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped text-center">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Tiêu đề</th>
                    <th>Ngày bắt đầu đăng kí</th>
                    <th>Ngày kết thúc đăng kí</th>
                    <th>Ngày bắt đầu thi</th>
                    <th>Ngày kết thúc thi</th>
                    <th>Học kì</th>
                    <th>Niên khóa</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @php
                  $a = 0;
                  @endphp
                  @foreach ($all_kh as $kh)
                  <tr>
                    <td>{{ ++$a }}</td>
                    <td>{{ $kh->tieude }}</td>
                    <td>{{ date('d/m/Y', strtotime($kh->ngaybd_dk)) }}</td>
                    <td>{{ date('d/m/Y', strtotime($kh->ngaykt_dk)) }}</td>
                    <td>{{ date('d/m/Y', strtotime($kh->ngaybd_thi)) }}</td>
                    <td>{{ date('d/m/Y', strtotime($kh->ngaykt_thi)) }}</td>
                    <td>{{ $kh->hocki->hocki }}</td>
                    <td>{{
                      $kh->nienkhoa->nienkhoa
                      }}</td>
                    <td class="text-center">
                      <button class="btn btn-sm btn-info" data-hocki="{{ $kh->hkid }}" data-tieude="{{ $kh->tieude }}"
                        data-ngaybd_dk="{{ $kh->ngaybd_dk }}" data-ngaykt_dk="{{ $kh->ngaykt_dk }}"
                        data-ngaybd_thi="{{ $kh->ngaybd_thi }}" data-ngaykt_thi="{{ $kh->ngaykt_thi }}"
                        data-nienkhoa="{{ $kh->nkid }}" data-idkh="{{ $kh->id }}" data-toggle="modal"
                        data-target="#edit_kh"><i class="fa fa-pen">
                          Sửa</i></button>
                      @if ($kh->ngaybd_dk <= $today && $today < $kh->ngaybd_thi && $all_lhpp != [] && $kh->type == 0)
                        <a href="{{route('lichthi.xeplich')}}" class="btn btn-sm btn-success text-right"> Lập Lịch</a>
                        @else
                        @endif
                        <?php if($kh->type == 1){ ?>
                        <a href="{{ URL::to('/admin/kehoach/hide/'.$kh->id) }}" class="btn btn-sm btn-danger"> <i
                            class="fa fa-eye-slash">
                            Ẩn</i></a>
                        <?php }else{ ?>
                        <a href="{{ URL::to('/admin/kehoach/display/'.$kh->id) }}" class="btn btn-sm btn-primary"> <i
                            class="fa fa-eye">
                            Hiện</i></a>
                        <?php }?>


                    </td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>

                </tfoot>
              </table>
              @include('kehoach.add')
              @include('kehoach.edit')
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
<script src="{{asset('dist/js/modal.js')}}"></script>
<script>
  $('#edit_kh').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var idkh = button.data('idkh')
    var ngaybd_dk = button.data('ngaybd_dk')
    var ngaykt_dk = button.data('ngaykt_dk')
    var ngaybd_thi = button.data('ngaybd_thi')
    var ngaykt_thi = button.data('ngaykt_thi')
    var tieude = button.data('tieude')
    var hocki = button.data('hocki')
    var nienkhoa = button.data('nienkhoa')
    var modal = $(this)
    modal.find('.modal-body #tieude').val(tieude);
    modal.find('.modal-body #ngaybd_dk').val(ngaybd_dk);
    modal.find('.modal-body #ngaykt_dk').val(ngaykt_dk);
    modal.find('.modal-body #ngaybd_thi').val(ngaybd_thi);
    modal.find('.modal-body #ngaykt_thi').val(ngaykt_thi);
    modal.find('.modal-body #idkh').val(idkh);
    modal.find('.modal-body #hkidkh').val(hocki);
    modal.find('.modal-body #nkidkh').val(nienkhoa);

    $("#update_kh").on('submit', function(event){
    event.preventDefault();
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
    type: 'POST',
    url: "{{route('kehoach.update')}}",
    data:new FormData(this),
    dataType:'JSON',
    contentType: false,
    cache: false,
    processData: false,
    success: function (data) {
    location.reload();
    $('#edit_kh').modal('hide');
    },
    error: function (data) {
    $('#tieudeErrorUpdate').addClass('d-none');
            $('#ngaybd_dkErrorUpdate').addClass('d-none');
            $('#ngaykt_dkErrorUpdate').addClass('d-none');
            $('#ngaybd_thiErrorUpdate').addClass('d-none');
            $('#ngaykt_thiErrorUpdate').addClass('d-none');
            $('#hockiErrorUpdate').addClass('d-none');
            $('#nienkhoaErrorUpdate').addClass('d-none');
    var errors = data.responseJSON;
    if($.isEmptyObject(errors) == false) {
    $.each(errors.errors,function (key, value) {
    var ErrorID = '#' + key +'ErrorUpdate';
    $(ErrorID).removeClass("d-none");
    $(ErrorID).text(value);
    })
    }
    }
    });
    });
    });


  //create record with ajax post method
  $("#add_new_kh").on('submit', function(event){
        event.preventDefault();
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $.ajax({
        type: 'POST',
        url: "{{route('kehoach.save')}}",
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
        location.reload();
        $('#add_kh').modal('hide');
        },
        error: function (data) {
        $('#tieudeError').addClass('d-none');
        $('#ngaybd_dkError').addClass('d-none');
        $('#ngaykt_dkError').addClass('d-none');
        $('#ngaybd_thiError').addClass('d-none');
        $('#ngaykt_thiError').addClass('d-none');
        $('#hockiError').addClass('d-none');
        $('#nienkhoaError').addClass('d-none');
        var errors = data.responseJSON;
        if($.isEmptyObject(errors) == false) {
        $.each(errors.errors,function (key, value) {
        var ErrorID = '#' + key +'Error';
        $(ErrorID).removeClass("d-none");
        $(ErrorID).text(value);
        })
        }
        }
        });
        });

        $("#laplich").on('submit', function(event){
          event.preventDefault();
          $.ajaxSetup({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
          });
          $.ajax({
          type: 'POST',
          url: "{{route('laplich.save')}}",
          data:new FormData(this),
          dataType:'JSON',
          contentType: false,
          cache: false,
          processData: false,
          success: function (data) {
          location.reload();
          }
          });
          });

</script>

@endsection