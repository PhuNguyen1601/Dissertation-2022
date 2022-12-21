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
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Import phòng</h6>
                            </div>
                            @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    {{-- File Input --}}
                                    <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
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
                                        <span style="color:red;">*</span>File CSV</label>
                                        <input type="file"
                                            class="form-control form-control-user @error('file') is-invalid @enderror"
                                            id="exampleFile" name="file" value="{{ old('file') }}">
                                        @error('file')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success btn-user float-right mb-3">Cập nhật
                                </button>

                            </div>
                            </form>
                        </div>

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