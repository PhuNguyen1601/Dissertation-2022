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
                            <div class="text-center" id="loading">
                                    <div class="spiner"></div>
                                    <div class="bar">
                                          <span class="dot1"></span>
                                          <span class="dot2"></span>
                                          <span class="dot3"></span>
                                        </div>
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
                                    $a = 1;
                                    @endphp
                                    @foreach ($all_lt as $lt)
                                    <tr>
                                        <td>{{ $a = $a++ }}</td>
                                        <td>{{ $lt->malhp }}</td>
                                        <td>{{ $lt->magv }}</td>
                                        <td>{{ $lt->tengv }}</td>
                                        <td>{{ $lt->tenhp }}</td>
                                        <td>{{ date('d/m/Y', strtotime($lt->ngaythang)) }}</td>
                                        <td>{{ $lt->map }}</td>
                                        <td>{{ $lt->tgthi*30 }} Phút</td>
                                        <td>{{ $lt->tiet }}</td>
                                        @if ($lt->video != '0' && $lt->videodec == '0')
                                        <td><iframe height="150" width="200" src="/videos/{{$lt->video }}"></iframe>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ URL::to('/admin/video/detection/'.$lt->id) }}"
                                                class="btn btn-sm btn-warning"> <i class="fa fa-eye"> Kiểm tra</i></a>
                                        </td>
                                        @elseif($lt->videodec != '0' && $lt->video != '0' )
                                        <form action="{{ route('video.download') }}" method="POST">
                                            @csrf
                                            <td class="text-center">
                                                <input type="text" name="filevd" value="{{ $lt->videodec }}" hidden>
                                                <img height="100" width="150" src="{{ asset('dist/img/imgvd.jpg')}}"
                                                    alt="Video">
                                            </td>
                                            <br>
                                            <td>
                                                <button class="btn btn-success btn-user float-center mb-3">Tải
                                                    xuống</button>
                                            </td>
                                        </form>
                                        @else
                                        <td>Chưa có video</td>
                                        <td class="text-center">
                                            <a href="#" class="btn btn-sm btn-danger"> Kiểm
                                                tra</a>
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
@endsection