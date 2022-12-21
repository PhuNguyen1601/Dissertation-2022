@extends('layouts.admin')
@section('title','Học phần')
@section('maincontent')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><strong>Học phần</strong></h1>

        </div>
        <div class="text-right col-sm-6">
          <form method="POST" action="{{route('hocphan.upload')}}" enctype="multipart/form-data">
            @csrf
            <label for="upload-file" style="cursor: pointer;">Học phần: </label>
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
              <h3 class="card-title">Danh sách học phần</h3>
              <div class="text-right">
                <button class="btn btn-primary text-right" data-toggle="modal" data-target="#add_hp"> Thêm
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
              <form action="{{route('hocphan.delete')}}" method="POST">
                @csrf
                <input class="btn btn-danger text-right" type="submit" value="Xóa">
                <table id="example1" class="table table-bordered table-striped text-center">
                  <thead>
                    <tr>
                      <th><input type="checkbox" id="checkallhp" onchange="checkAll(this)"></th>
                      <th>STT</th>
                      <th>Mã học phần</th>
                      <th>Tên học phần</th>
                      <th>Số tín chỉ</th>
                      <th width="125"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                    $a = 0;
                    @endphp
                    @foreach ($all_hp as $hp)
                    <tr>
                      <td>
                        <input type="checkbox" name="hpid[{{ $hp->id }}]" value="{{ $hp->id }}">
                      </td>
                      <td>{{ ++$a }}</td>
                      <td>{{ $hp->mahp }}</td>
                      <td>{{ $hp->tenhp }}</td>
                      <td>{{ $hp->sotc }}</td>
                      <td class="text-center">
                        <a class="btn btn-sm btn-info" data-tenhp="{{ $hp->tenhp }}" data-sotc="{{ $hp->sotc }}"
                          data-mahp="{{ $hp->mahp }}" data-idhp="{{ $hp->id }}" data-toggle="modal"
                          data-target="#edit_hp"><i class="fa fa-pen">
                            Sửa</i></a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                  </tfoot>
                </table>
              </form>
              @include('hocphan.add')
              @include('hocphan.edit')
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
  $('#edit_hp').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var idhp = button.data('idhp')
    var mahp = button.data('mahp')
    var tenhp = button.data('tenhp')
    var sotc = button.data('sotc')
    var modal = $(this)
    
    modal.find('.modal-body #mahp').val(mahp);
    modal.find('.modal-body #tenhp').val(tenhp);
    modal.find('.modal-body #idhp').val(idhp);
    modal.find('.modal-body #sotc').val(sotc);
    

    $("#update_hp").on('submit', function(event){
    event.preventDefault();
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
    type: 'POST',
    url: "{{route('hocphan.update')}}",
    data:new FormData(this),
    dataType:'JSON',
    contentType: false,
    cache: false,
    processData: false,
    success: function (data) {
    location.reload();
    $('#edit_hp').modal('hide');
    },
    error: function (data) {
    $('#mahpErrorUpdate').addClass('d-none');
    $('#tenhpErrorUpdate').addClass('d-none');
    $('#sotcErrorUpdate').addClass('d-none');
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
  $("#add_new_hp").on('submit', function(event){
        event.preventDefault();
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $.ajax({
        type: 'POST',
        url: "{{route('hocphan.save')}}",
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
        location.reload();
        $('#add_hp').modal('hide');
        },
        error: function (data) {
        $('#mahpError').addClass('d-none');
        $('#tenhpError').addClass('d-none');
        $('#sotcError').addClass('d-none');
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