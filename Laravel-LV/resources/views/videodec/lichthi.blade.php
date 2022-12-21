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
                            <h3 class="card-title">Danh sách lịch thi</h3>
                            <div class="text-right">
                                <a href="{{ route('lichthi.export') }}" class="btn btn-primary">Export Lịch thi</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Lớp học phần</th>
                                        <th>Mã CB</th>
                                        <th>Họ và tên CBGD</th>
                                        <th>Tên học phần</th>
                                        <th>Ngày thi</th>
                                        <th>Phòng thi</th>
                                        <th>Thời gian thi</th>
                                        <th>Bắt đầu thi</th>
                                        <th>Video</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $a = 0;
                                    @endphp
                                    @foreach ($all_ltt as $lt)
                                    <tr>
                                        <td>{{ ++$a }}</td>
                                        <td>{{ $lt->malhp }}</td>
                                        <td>{{ $lt->magv }}</td>
                                        <td>{{ $lt->tengv }}</td>
                                        <td>{{ $lt->tenhp }}</td>
                                        <td>{{ date('d/m/Y', strtotime($lt->ngaythang)) }}</td>
                                        <td>{{ $lt->map }}</td>
                                        <td>{{ $lt->tgthi*30 }} Phút</td>
                                        <td>{{ $lt->tiet }}</td>
                                        @if ($lt->video != 0)
                                        <td><iframe height="150" width="200" src="/videos/{{$lt->video }}"></iframe>
                                        </td>
                                        <td class="text-center">
                                            Đã thêm video
                                        </td>
                                        @else
                                        <td>Chưa có video</td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-info" data-lichthiid="{{ $lt->id }}"
                                                data-toggle="modal" data-target="#uploadvd"><i class="fa fa-pen">
                                                    Thêm video</i></button>
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                            @include('videodec.upload')
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

@section('script-video')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"
    integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous">
</script>
<script>
    //upload video
       $('#uploadvd').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var lichthiid = button.data('lichthiid')
        var modal = $(this)
        modal.find('.modal-body #lichthiid').val(lichthiid);
        $("#VideoForm").on('submit', function(event){
        event.preventDefault();
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $.ajax({
        xhr: function() {
        var xhr = new window.XMLHttpRequest();
        xhr.upload.addEventListener("progress", function(evt) {
        if (evt.lengthComputable) {
        var percentComplete = ((evt.loaded / evt.total) * 100);
        $(".progress-bar").width(percentComplete + '%');
        $(".progress-bar").html(percentComplete+'%');
        }
        }, false);
        return xhr;
        },
        type: 'POST',
        url: "{{route('video.upload')}}",
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
        location.reload();
        $('#uploadvd').modal('hide');
        }
        });
        });
        });

</script>
@endsection
@endsection