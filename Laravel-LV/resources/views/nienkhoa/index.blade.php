@extends('layouts.admin')
@section('title','Niên khóa')
@section('maincontent')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><strong>Niên khóa</strong></h1>
        </div>
        <div class="text-right col-sm-6">
          <form method="POST" action="{{route('nienkhoa.upload')}}" enctype="multipart/form-data">
            @csrf
            <label for="upload-file" style="cursor: pointer;">Niên khóa: </label>
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
              <h3 class="card-title">Danh sách niên khóa</h3>
              <div class="text-right">
                <button class="btn btn-primary text-right" data-toggle="modal" data-target="#add_nk"> Thêm
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
                    <th width="50">STT</th>
                    <th>Niên khóa</th>
                    <th width="125"></th>
                  </tr>
                </thead>
                <tbody>
                  @php
                  $a = 0;
                  @endphp
                  @foreach ($all_nk as $nk)
                  <tr>
                    <td>{{ ++$a }}</td>
                    <td>{{ $nk->nienkhoa }}</td>
                    <td class="text-center">
                      <button class="btn btn-sm btn-info" data-nienkhoa="{{ $nk->nienkhoa }}" data-idnk="{{ $nk->id }}"
                        data-toggle="modal" data-target="#edit_nk"><i class="fa fa-pen">
                          Sửa</i></button>
                      <a href="{{ URL::to('/admin/nienkhoa/delete/'.$nk->id) }}"
                        onclick="return confirm('Bạn chắc chắn muốn xóa')" class="btn btn-sm btn-danger"> <i
                          class="fa fa-trash"> Xóa</i></a>

                    </td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                </tfoot>
              </table>
              @include('nienkhoa.add')
              @include('nienkhoa.edit')
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
  $('#edit_nk').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var idnk = button.data('idnk')
    var nienkhoa = button.data('nienkhoa')
    var modal = $(this)
    modal.find('.modal-body #idnk').val(idnk);
    modal.find('.modal-body #nienkhoa').val(nienkhoa);

    $("#update_nk").on('submit', function(event){
    event.preventDefault();
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
    type: 'POST',
    url: "{{route('nienkhoa.update')}}",
    data:new FormData(this),
    dataType:'JSON',
    contentType: false,
    cache: false,
    processData: false,
    success: function (data) {
    location.reload();
    $('#edit_nk').modal('hide');
    },
    error: function (data) {
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
  $("#add_new_nk").on('submit', function(event){
        event.preventDefault();
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $.ajax({
        type: 'POST',
        url: "{{route('nienkhoa.save')}}",
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
        location.reload();
        $('#add_nk').modal('hide');
        },
        error: function (data) {
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