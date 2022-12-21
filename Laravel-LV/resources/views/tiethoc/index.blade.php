@extends('layouts.admin')
@section('title','Tiết học')
@section('maincontent')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><strong>Tiết học</strong></h1>
        </div>
        <div class="text-right col-sm-6">
          <form method="POST" action="{{route('tiethoc.upload')}}" enctype="multipart/form-data">
            @csrf
            <label for="upload-file" style="cursor: pointer;">Chọn file...</label>
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
              <h3 class="card-title">Danh sách tiết học</h3>
              <div class="text-right">
                <button class="btn btn-primary text-right" data-toggle="modal" data-target="#add_th"> Thêm
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
                    <th>Tiết học</th>
                    <th>Giờ bắt đầu</th>
                    <th>Giờ kết thúc</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>

                  @foreach ($all_th as $th)
                  <tr>
                    <td>
                      {{ $th->id }}
                    </td>
                    <td>{{ $th->tiet }}</td>
                    <td>{{ $th->start_time }}</td>
                    <td>{{ $th->end_time }}</td>
                    <td class="text-center">
                      <a href="{{ URL::to('/admin/tiethoc/delete/'.$th->id) }}"
                        onclick="return confirm('Bạn chắc chắn muốn xóa')" class="btn btn-sm btn-danger"> <i
                          class="fa fa-trash"> Xóa</i></a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                </tfoot>
              </table>
              @include('tiethoc.add')
              @include('tiethoc.edit')
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
  $(document).ready(function(){ 
  $('#start_time_add').datetimepicker({
  format: 'LT'
  })
  $('#end_time_add').datetimepicker({
  format: 'LT'
  })
  })
  $('#edit_bm').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var idbm = button.data('idbm')
    var mabm = button.data('mabm')
    var tenbm = button.data('tenbm')
    console.log(idbm, mabm, tenbm);
    var modal = $(this)
    modal.find('.modal-body #mabm').val(mabm);
    modal.find('.modal-body #tenbm').val(tenbm);
    modal.find('.modal-body #idbm').val(idbm);

    $("#update_bm").on('submit', function(event){
    event.preventDefault();
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
    type: 'POST',
    url: "{{route('bomon.update')}}",
    data:new FormData(this),
    dataType:'JSON',
    contentType: false,
    cache: false,
    processData: false,
    success: function (data) {
    location.reload();
    $('#edit_bm').modal('hide');
    },
    error: function (data) {
    $('#mabmErrorUpdate').addClass('d-none');
    $('#tenbmErrorUpdate').addClass('d-none');
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
  $("#add_new_th").on('submit', function(event){
        event.preventDefault();
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $.ajax({
        type: 'POST',
        url: "{{route('tiethoc.save')}}",
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
        location.reload();
        $('#add_th').modal('hide');
        },
        error: function (data) {
        $('#tiethocError').addClass('d-none');
        $('#start_timeError').addClass('d-none');
        $('#end_timeError').addClass('d-none');
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