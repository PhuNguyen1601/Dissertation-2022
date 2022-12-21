<!-- Modal -->
<div class="modal fade" id="edit_gv" centered="true" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sửa giảng viên</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            <form id="update_gv">
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" class="form-control " value="" name="gvid" id="gvid" hidden>
                            <label>Mã giảng viên</label>
                            <input type="text" class="form-control magv" name="magv" id="magv">
                            <span class="text-danger font-weight-bold" id="magvErrorUpdate"></span>
                        </div>
                        <div class="form-group">
                            <label>Tên giảng viên</label>
                            <input type="text" class="form-control tengv" name="tengv" id="tengv">
                            <span class="text-danger font-weight-bold" id="tengvErrorUpdate"></span>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control email" id="email" name="email">
                            <span class="text-danger font-weight-bold" id="emailErrorUpdate"></span>
                        </div>
                        <div class="form-group">
                            <label>Ngày sinh</label>
                            <input type="date" class="form-control ngaysinh" id="ngaysinh" name="ngaysinh">
                            <span class="text-danger font-weight-bold" id="ngaysinhErrorUpdate"></span>
                        </div>
                        <div class="form-group">
                            <label>Bộ môn</label>
                            <select class="form-control text-center bomon" id="bomon" name="bomon">
                                <option value="">---- Chọn bộ môn ----</option>
                                @foreach ($all_bm as $bm)
                                <option value="{{ $bm->id }}">
                                    {{ $bm->tenbm }}
                                </option>
                                @endforeach
                            </select>
                            <span class="text-danger font-weight-bold" id="bomonErrorUpdate"></span>
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