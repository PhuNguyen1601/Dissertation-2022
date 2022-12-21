@extends('layouts.admin')
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
                <div class="text-right col-sm-12">
                    <form method="POST" action="{{route('lophocphan.upload_csvsv')}}" enctype="multipart/form-data">
                        @csrf
                        <label for="upload-file" style="cursor: pointer;">Sinh viên: </label>
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
                            <h3 class="card-title">Lớp học phần có {{ $all_ss_lhp }} sinh viên
                            </h3>
                            <div class="text-right">
                                <a href="{{route('lophocphan.index')}}" class="btn btn-danger"> Trở về</a>
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
                                        <th>Mã sinh viên</th>
                                        <th>Tên sinh viên</th>
                                        <th></th>
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
                                        <td class="text-center">
                                            <a href="{{ URL::to('/admin/lophocphan/delete_svlhp/'.$sv_lhp->id) }}"
                                                onclick="return confirm('Bạn chắc chắn muốn xóa')"
                                                class="btn btn-sm btn-danger"> <i class="fa fa-trash"> Xóa</i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                            @include('lophocphan.add_sv')
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