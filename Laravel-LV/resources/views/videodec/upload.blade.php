<!-- Modal add -->
<div class="modal fade" id="uploadvd" centered="true" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload video</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            <form method="POST" id="VideoForm" action="{{route('video.upload')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group row">
                            {{-- File Input --}}
                            <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                                <span style="color:red;">*</span>File video</label>
                                <input type="text" hidden class="form-control lichthiid" value="" name="lichthiid"
                                    id="lichthiid">
                                <input type="file"
                                    class="form-control form-control-user @error('file') is-invalid @enderror"
                                    id="exampleFile_video" name="file" accept="video/mp4,video/x-m4v,video/*"
                                    value="{{ old('file') }}" required>
                            </div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-user float-right mb-3">Tải lên
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end modal add-->