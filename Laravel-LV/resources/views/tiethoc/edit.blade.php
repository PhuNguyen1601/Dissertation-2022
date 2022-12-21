<!-- Modal -->
<div class="modal fade" id="edit_bm" centered="true" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sửa bộ môn</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            {{-- method="POST" action="{{ URL::to('/admin/bm/update')}}" --}}
            <form id="update_bm">
                {{-- @csrf --}}
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" hidden class="form-control" value="" name="idbm" id="idbm">
                            <label>Mã bộ môn</label>
                            <input type="text" class="form-control mabm" name="mabm" id="mabm"
                                placeholder="Mã số bộ môn">
                            <span class="text-danger font-weight-bold" id="mabmErrorUpdate"></span>
                        </div>
                        <div class="form-group">
                            <label>Tên bộ môn</label>
                            <input type="text" class="form-control tenbm" name="tenbm" id="tenbm"
                                placeholder="Tên bộ môn">
                            <span class="text-danger font-weight-bold" id="tenbmErrorUpdate"></span>
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