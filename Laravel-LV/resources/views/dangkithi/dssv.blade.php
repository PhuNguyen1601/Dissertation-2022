a@extends('layouts.admin')
@section('title','Danh sách sinh viên')
@section('maincontent')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><strong>Danh sách sinh viên lớp học phần</strong></h1>
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
                            <h3 class="card-title">Lớp học phần có {{ $all_ss_lhp }} sinh viên
                            </h3>
                            <div class="text-right">
                                <a href="{{route('dangkithi.index')}}" class="btn btn-danger"> Trở về</a>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã sinh viên</th>
                                        <th>Tên sinh viên</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $a = 0;
                                    @endphp
                                    @foreach ($all_sv_lhp as $sv_lhp)
                                    <tr>
                                        <td>{{ ++$a }}</td>
                                        <td>{{ $sv_lhp->sv->masv }}</td>
                                        <td>{{ $sv_lhp->sv->tensv }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
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


@endsection