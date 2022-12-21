a@extends('layouts.admin')
@section('title','Giảng viên')
@section('maincontent')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><strong>Giảng viên</strong></h1>
        </div>
        <div class="text-right col-sm-6">
          <form method="POST" action="{{route('giangvien.upload')}}" enctype="multipart/form-data">
            @csrf
            <label for="upload-file" style="cursor: pointer;">Giảng viên: </label>
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
              <h3 class="card-title">Danh sách giảng viên</h3>
              <div class="text-right">
                <button class="btn btn-primary text-right" data-toggle="modal" data-target="#add_gv"> Thêm
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
              <form action="{{route('giangvien.delete')}}" method="POST">
                @csrf
                <input class="btn btn-danger text-right" type="submit" value="Xóa">
                <table id="example1" class="table table-bordered table-striped text-center">
                  <thead>
                    <tr>
                      <th><input type="checkbox" id="checkallgv" onchange="checkAll(this)"></th>
                      <th>STT</th>
                      <th>Mã giảng viên</th>
                      <th>Tên giảng viên</th>
                      <th>Email</th>
                      <th>Ngày sinh</th>
                      <th>Bộ môn</th>
                      <th width="125"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                    $a = 0;
                    @endphp
                    @foreach ($all_gv as $gv)
                    <tr>
                      <td>
                        <input type="checkbox" name="gvid[{{ $gv->id }}]" value="{{ $gv->id }}">
                      </td>
                      <td>{{ ++$a }}</td>
                      <td>{{ $gv->magv }}</td>
                      <td>{{ $gv->tengv }}</td>
                      <td>{{ $gv->email }}</td>
                      <td>{{ date('d/m/Y', strtotime($gv->ngaysinh)) }}</td>
                      <td>{{ $gv->bomon->tenbm }}</td>
                      <td class="text-center">
                        <a class="btn btn-sm btn-info" data-toggle="modal" data-bmid="{{ $gv->bmid }}"
                          data-magv="{{ $gv->magv }}" data-ngaysinh="{{ $gv->ngaysinh }}" data-email="{{ $gv->email }}"
                          data-password="{{ $gv->password }}" data-tengv="{{ $gv->tengv }}" data-gvid="{{ $gv->id }}"
                          data-target="#edit_gv"><i class="fa fa-pen">
                            Sửa</i></a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                  </tfoot>
                </table>
              </form>
              @include('giangvien.add')
              @include('giangvien.edit')
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
  $('#edit_gv').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var gvid = button.data('gvid')
    var magv = button.data('magv')
    var tengv = button.data('tengv')
    var ngaysinh = button.data('ngaysinh')
    var email = button.data('email')
    var bmid = button.data('bmid')
    var modal = $(this)
    modal.find('.modal-body #magv').val(magv);
    modal.find('.modal-body #gvid').val(gvid);
    modal.find('.modal-body #tengv').val(tengv);
    modal.find('.modal-body #bomon').val(bmid);
    modal.find('.modal-body #email').val(email);
    modal.find('.modal-body #ngaysinh').val(ngaysinh);

    $("#update_gv").on('submit', function(event){
    event.preventDefault();
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
    type: 'POST',
    url: "{{route('giangvien.update')}}",
    data:new FormData(this),
    dataType:'JSON',
    contentType: false,
    cache: false,
    processData: false,
    success: function (data) {
    location.reload();
    $('#edit_gv').modal('hide');
    },
    error: function (data) {
      $('#magvErrorUpdate').addClass('d-none');
      $('#tengvErrorUpdate').addClass('d-none');
      $('#emailErrorUpdate').addClass('d-none');
      $('#ngaysinhErrorUpdate').addClass('d-none');
      $('#bomonErrorUpdate').addClass('d-none');
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
  $("#add_new_gv").on('submit', function(event){
        event.preventDefault();
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $.ajax({
        type: 'POST',
        url: "{{route('giangvien.save')}}",
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
        location.reload();
        $('#add_gv').modal('hide');
        },
        error: function (data) {
        $('#tengvError').addClass('d-none');
        $('#emailError').addClass('d-none');
        $('#ngaysinhError').addClass('d-none');
        $('#bomonError').addClass('d-none');
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
</script>

@endsection