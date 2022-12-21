@extends('layouts.admin')
@section('title','Học kì')
@section('maincontent')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><strong>Học kì</strong></h1>

        </div>
        {{-- <div class="text-right col-sm-6">
          <a href="{{route('hocki.import')}}" class="btn btn-success text-right"> Import CSV</a>
        </div> --}}
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
              <h3 class="card-title">Danh sách học kì</h3>
              <div class="text-right">
                <button class="btn btn-primary text-right" data-toggle="modal" data-target="#add_hk"> Thêm
                  mới</button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped text-center">
                <thead>
                  <tr>
                    <th width="50">STT</th>
                    <th>Học kì</th>
                    <th width="125"></th>
                  </tr>
                </thead>
                <tbody>
                  @php
                  $a = 0;
                  @endphp
                  @foreach ($all_hk as $hk)
                  <tr>
                    <td>{{ ++$a }}</td>
                    <td>{{ $hk->hocki }}</td>
                    <td class="text-center">
                      <button class="btn btn-sm btn-info" data-hocki="{{ $hk->hocki }}" data-idhk="{{ $hk->id }}"
                        data-toggle="modal" data-target="#edit_hk"><i class="fa fa-pen">
                          Sửa</i></button>
                      <a href="{{ URL::to('/admin/hocki/delete/'.$hk->id) }}"
                        onclick="return confirm('Bạn chắc chắn muốn xóa')" class="btn btn-sm btn-danger"> <i
                          class="fa fa-trash"> Xóa</i></a>

                    </td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                </tfoot>
              </table>
              @include('hocki.add')
              @include('hocki.edit')
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
  $('#edit_hk').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var idhk = button.data('idhk')
    var hocki = button.data('hocki')
    var modal = $(this)
    modal.find('.modal-body #hocki').val(hocki);
    modal.find('.modal-body #idhk').val(idhk);

    $("#update_hk").on('submit', function(event){
    event.preventDefault();
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
    type: 'POST',
    url: "{{route('hocki.update')}}",
    data:new FormData(this),
    dataType:'JSON',
    contentType: false,
    cache: false,
    processData: false,
    success: function (data) {
    location.reload();
    $('#edit_hk').modal('hide');
    },
    error: function (data) {
    $('#hockiErrorUpdate').addClass('d-none');
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
  $("#add_new_hk").on('submit', function(event){
        event.preventDefault();
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $.ajax({
        type: 'POST',
        url: "{{route('hocki.save')}}",
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
        location.reload();
        $('#add_hk').modal('hide');
        },
        error: function (data) {
        $('#hockiError').addClass('d-none');
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