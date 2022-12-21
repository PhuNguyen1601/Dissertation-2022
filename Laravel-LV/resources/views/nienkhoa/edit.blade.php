<!-- Modal -->
<div class="modal fade" id="edit_nk" centered="true" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sửa niên khóa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            {{-- method="POST" action="{{ URL::to('/admin/p/update')}}" --}}
            <form id="update_nk">
                {{-- @csrf --}}
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" hidden class="form-control" value="" name="idnk" id="idnk">
                            <label>Niên khóa</label>
                            <input type="text" class="form-control nienkhoa" name="nienkhoa" id="nienkhoa"
                                placeholder="Niên khóa">
                            <span class="text-danger font-weight-bold" id="nienkhoaErrorUpdate"></span>
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