<!-- Modal -->
<div class="modal fade" id="edit_hk" centered="true" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sửa học kì</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            {{-- method="POST" action="{{ URL::to('/admin/p/update')}}" --}}
            <form id="update_hk">
                {{-- @csrf --}}
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" hidden class="form-control" value="" name="idhk" id="idhk">
                            <label>Học kì</label>
                            <input type="text" class="form-control hocki" name="hocki" id="hocki" placeholder="Học kì">
                            <span class="text-danger font-weight-bold" id="hockiErrorUpdate"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end modal edit-->