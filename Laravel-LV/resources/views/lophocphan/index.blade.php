a@extends('layouts.admin')
@section('title','Lớp học phần')
@section('maincontent')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><strong>Lớp học phần</strong></h1>
        </div>
        <div class="text-right col-sm-6">
          <form method="POST" action="{{route('lophocphan.upload')}}" enctype="multipart/form-data">
            @csrf
            <label for="upload-file" style="cursor: pointer;">Lớp học phần: </label>
            <input type="file" name="file" id="upload-file" accept=".xlsx,.xls"
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
              <h3 class="card-title">Danh sách lớp học phần</h3>
              <div class="text-right">
                <button class="btn btn-primary text-right" data-toggle="modal" data-target="#add_lhp"> Thêm
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
                    <th>Mã lớp học phần</th>
                    <th>Tên lớp học phần</th>
                    <th>Giảng viên</th>
                    <th>Học kì</th>
                    <th>Niên khóa</th>
                    <th width="250"></th>
                  </tr>
                </thead>
                <tbody>
                  @php
                  $a = 0;
                  @endphp
                  @foreach ($all_lhp as $lhp)
                  <tr>
                    <td>{{ ++$a }}</td>
                    <td>{{ $lhp->malhp }}</td>
                    <td>{{ $lhp->hocphan->tenhp }}</td>
                    <td>{{ $lhp->giangvien->tengv }}</td>
                    <td>{{ $lhp->hocki->hocki }}</td>
                    <td>{{
                      $lhp->nienkhoa->nienkhoa
                      }}</td>
                    <td class="text-center">

                      <button class="btn btn-sm btn-info" data-toggle="modal" data-malhp="{{ $lhp->malhp }}"
                        data-giangvien="{{ $lhp->gvid }}" data-hocphan="{{ $lhp->hpid }}"
                        data-nienkhoa="{{ $lhp->nkid }}" data-idlhp="{{ $lhp->id }}" data-hocki="{{ $lhp->hkid }}"
                        data-target="#edit_lhp"><i class="fa fa-pen">
                          Sửa</i></button>
                      <a href="{{ URL::to('/admin/lophocphan/listsv/'.$lhp->id) }}" class="btn btn-sm btn-warning"> <i
                          class="fa fa-list"> Danh sách</i></a>
                      <a href="{{ URL::to('/admin/lophocphan/delete/'.$lhp->id) }}"
                        onclick="return confirm('Bạn chắc chắn muốn xóa')" class="btn btn-sm btn-danger"> <i
                          class="fa fa-trash"> Xóa</i></a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                </tfoot>
              </table>
              @include('lophocphan.add')
              @include('lophocphan.edit')
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
  $('#edit_lhp').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var idlhp = button.data('idlhp')
    var malhp = button.data('malhp')
    var hocphan = button.data('hocphan')
    var giangvien = button.data('giangvien')
    var hocki = button.data('hocki')
    var nienkhoa = button.data('nienkhoa')
    var modal = $(this)
    modal.find('.modal-body #idlhp').val(idlhp);
    modal.find('.modal-body #malhp').val(malhp);
    modal.find('.modal-body #giangvien').val(giangvien);
    modal.find('.modal-body #hocphan').val(hocphan);
    modal.find('.modal-body #hocki').val(hocki);
    modal.find('.modal-body #nienkhoa').val(nienkhoa);

    $("#update_lhp").on('submit', function(event){
    event.preventDefault();
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
    type: 'POST',
    url: "{{route('lophocphan.update')}}",
    data:new FormData(this),
    dataType:'JSON',
    contentType: false,
    cache: false,
    processData: false,
    success: function (data) {
    location.reload();
    $('#edit_lhp').modal('hide');
    },
    error: function (data) {
   
    $('#malhpErrorUpdate').addClass('d-none');
    $('#hocphanErrorUpdate').addClass('d-none');
    $('#giangvienErrorUpdate').addClass('d-none');
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
  $("#add_new_lhp").on('submit', function(event){
        event.preventDefault();
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $.ajax({
        type: 'POST',
        url: "{{route('lophocphan.save')}}",
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
        location.reload();
        $('#add_lhp').modal('hide');
        },
        error: function (data) {
        $('#malhpError').addClass('d-none');
        $('#hocphanError').addClass('d-none');
        $('#giangvienError').addClass('d-none');
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

</script>

@endsection