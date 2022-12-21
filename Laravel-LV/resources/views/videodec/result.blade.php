@extends('layouts.admin')
@section('title','Kết quả')
@section('maincontent')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><strong>Phát hiện hành vi</strong></h1>
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
              <div class="text-right">
                <form id="VideoFormss">
                  @csrf
                  <input type="text" hidden class="form-control idlthi" value="{{ $videodec->id }}" name="idlthi"
                    id="idlthi">
                  <input type="text" hidden class="form-control videodetec" value="{{ $videodec->video }}"
                    name="videodetec" id="videodetec">
                  <button type="submit" class="btn btn-primary text-right"> Kiểm tra
                  </button>
                </form>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="col-12">

                <div class="card card-primary">
                  <div class="text-center" id="loading">
                        <div class="spiner"></div>
                        <div class="bar">
                            <span class="dot1"></span>
                            <span class="dot2"></span>
                            <span class="dot3"></span>
                          </div>
                  </div>
                  <div class="card-body">
                    <div class="text-center">
                      <video height="600" width="700" src="/videos/{{$videodec->video }}" type="video/mp4" autoplay
                        controls></video>
                    </div>
                  </div>
                </div>
              </div>
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
@section('script-detection')

<script>
  $(document).ready(function() {
  $('#loading').hide();
  $("#VideoFormss").on('submit', function(event){
  event.preventDefault();
  $.ajaxSetup({
  headers: {
  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
  });
  $('#loading').show();
  $.ajax({
  type: 'POST',
  url: "{{route('video.detec')}}",
  data:new FormData(this),
  dataType:'JSON',
  contentType: false,
  cache: false,
  processData: false,
  success: function (data) {
  var jsondata = data.videodetection;

  $.ajax({
  url: 'http://127.0.0.1:8081/predict',
  type: 'POST',
  async: true,
  contentType: 'application/json;charset=UTF-8',
  data:JSON.stringify({'file':String(jsondata)}),
  success: function (data) {
  $('#loading').hide();
  top.location.href="{{route('video.index')}}";
  },
  error: function () {
  location.reload();
  $('#loading').hide();
  }
  });
  }
  });
  });
  });
</script>


@endsection
@section('style-detection')
<style>
  .spiner {
    margin-top: 50px;
    width: 100px;
    height: 100px;
    display: inline-block;
    border: 10px solid white;
    border-radius: 50%;
    border-top: 10px solid #ff8000;
    animation: spiner 1.5s linear infinite;
  }

  .bar {
    margin-top: 50px;
    display: inline-block;
    width: 100%;
  }

  .bar>span {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background-color: #ff8000;
    display: inline-block;
    animation: dot 1.5s ease-in-out infinite both;
  }

  .bar span.dot1 {
    animation-delay: -0.3s;
  }

  .bar span.dot2 {
    animation-delay: -0.15s;
  }

  .bar span.dot3 {
    animation-delay: 0s;
  }

  @keyframes spiner {
    to {
      transform: rotate(360deg);
    }
  }

  @keyframes dot {

    0%,
    80%,
    100% {
      transform: scale(0);
    }

    40% {
      transform: scale(1);
    }
  }
</style>
@endsection
@endsection