@extends('layouts.admin')
@section('title','Đăng kí thi')
@section('maincontent')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><strong>Lớp học phần</strong></h1>
        </div>
        <div class="text-right col-sm-6">
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
              <h3 class="card-title">Danh sách lớp học phần</h3>
              <div class="text-right">
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="{{route('dangkithi.dangki')}}" method="POST">
                @csrf

                @if ($check == 1)
                <a class="btn btn-sm btn-danger disabled">Chưa thể đăng kí</a>
                @else
                <input class="btn btn-primary text-right" type="submit" value="Đăng kí">
                @endif
                <table id="example2" class="table table-bordered table-striped text-center">
                  <thead>
                    <tr>
                      <th><input type="checkbox" id="checkall" onchange="checkAll(this)"></th>
                      <th>STT</th>
                      <th>Mã lớp học phần</th>
                      <th>Học phần</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($all_lhp as $lhp)
                    <tr>
                      <td>
                        @if($lhp->dangki == 0)
                        <input type="checkbox" id="checkItem_.{{ $lhp->id }}" name="lhpid[{{ $lhp->id }}]"
                          value="{{ $lhp->id }}">
                        @else Đã đăng kí
                        @endif
                      </td>
                      <td>{{ $lhp->id }}</td>
                      <td>{{ $lhp->malhp }}</td>
                      <td>{{ $lhp->hocphan->tenhp }}</td>
                      <td class="text-center">
                        <a href="{{ URL::to('/admin/dangkithi/listsvlhp/'.$lhp->id) }}" class="btn btn-sm btn-warning">
                          <i class="fa fa-eye"> Danh sách</i></a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                  </tfoot>
                </table>
              </form>
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