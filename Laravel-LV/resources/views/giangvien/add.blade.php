<!-- Modal add -->
<div class="modal fade" id="add_gv" centered="true" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm lớp học phần</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            <form method="post" id="add_new_gv">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Mã giảng viên</label>
                            <input type="text" class="form-control magv" name="magv">
                            <span class="text-danger font-weight-bold" id="magvError"></span>
                        </div>
                        <div class="form-group">
                            <label>Tên giảng viên</label>
                            <input type="text" class="form-control tengv" name="tengv">
                            <span class="text-danger font-weight-bold" id="tengvError"></span>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control email" name="email">
                            <span class="text-danger font-weight-bold" id="emailError"></span>
                        </div>
                        <div class="form-group">
                            <label>Ngày sinh</label>
                            <input type="date" class="form-control ngaysinh" name="ngaysinh">
                            <span class="text-danger font-weight-bold" id="ngaysinhError"></span>
                        </div>
                        <div class="form-group">
                            <label>Bộ môn</label>
                            <select class="form-control text-center" id="bomon" name="bomon">
                                <option value="">---- Chọn bộ môn ----</option>
                                @foreach ($all_bm as $bm)
                                <option value="{{ $bm->id }}">
                                    {{ $bm->tenbm }}
                                </option>
                                @endforeach
                            </select>
                            <span class="text-danger font-weight-bold" id="bomonError"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary add_gv">Thêm mới</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end modal add-->