@extends('layouts.admin')
@section('title','Phòng')
@section('maincontent')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><strong>Phòng</strong></h1>
        </div>
        <div class="text-right col-sm-6">
          <form method="POST" action="{{route('phong.upload')}}" enctype="multipart/form-data">
            @csrf
            <label for="upload-file" style="cursor: pointer;">Phòng thi: </label>
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
              <h3 class="card-title">Danh sách phòng</h3>
              <div class="text-right">
                <button class="btn btn-primary text-right" data-toggle="modal" data-target="#add_p"> Thêm
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
              <form action="{{route('phong.delete')}}" method="POST">
                @csrf
                <input class="btn btn-danger text-right" type="submit" value="Xóa">
                <table id="example1" class="table table-bordered table-striped text-center">
                  <thead>
                    <tr>
                      <th><input type="checkbox" id="checkallp" onchange="checkAll(this)"></th>
                      <th>STT</th>
                      <th>Mã Phòng</th>
                      <th>Sức chứa</th>
                      <th width="125"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                    $a = 0;
                    @endphp
                    @foreach ($all_p as $p)
                    <tr>
                      <td>
                        <input type="checkbox" name="phong[{{ $p->id }}]" value="{{ $p->id }}">
                      </td>
                      <td>{{ ++$a }}</td>
                      <td>{{ $p->map }}</td>
                      <td>{{ $p->succhua }}</td>
                      <td class="text-center">
                        <a class="btn btn-sm btn-info" data-succhua="{{ $p->succhua }}" data-map="{{ $p->map }}"
                          data-idp="{{ $p->id }}" data-toggle="modal" data-target="#edit_p"><i class="fa fa-pen">
                            Sửa</i></a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                  </tfoot>
                </table>
              </form>
              @include('phong.add')
              @include('phong.edit')
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
  $('#edit_p').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var idp = button.data('idp')
    var map = button.data('map')
    var succhua = button.data('succhua')
    console.log(idp, map, succhua);
    var modal = $(this)
    modal.find('.modal-body #map').val(map);
    modal.find('.modal-body #succhua').val(succhua);
    modal.find('.modal-body #idp').val(idp);

    $("#update_p").on('submit', function(event){
    event.preventDefault();
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
    type: 'POST',
    url: "{{route('phong.update')}}",
    data:new FormData(this),
    dataType:'JSON',
    contentType: false,
    cache: false,
    processData: false,
    success: function (data) {
    location.reload();
    $('#edit_p').modal('hide');
    },
    error: function (data) {
    $('#mapErrorUpdate').addClass('d-none');
    $('#succhuaErrorUpdate').addClass('d-none');
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
  $("#add_new_p").on('submit', function(event){
        event.preventDefault();
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $.ajax({
        type: 'POST',
        url: "{{route('phong.save')}}",
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
        location.reload();
        $('#add_p').modal('hide');
        },
        error: function (data) {
        $('#mapError').addClass('d-none');
        $('#succhuaError').addClass('d-none');
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