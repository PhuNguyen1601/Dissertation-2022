<!-- Modal add -->
<div class="modal fade" id="add_bm" centered="true" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm bộ môn</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            <form method="post" id="add_new_bm">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Mã bộ môn</label>
                            <input type="text" class="form-control mabm" name="mabm" placeholder="Mã bộ môn">
                            <span class="text-danger font-weight-bold" id="mabmError"></span>
                        </div>
                        <div class="form-group">
                            <label>Tên bộ môn</label>
                            <input type="text" class="form-control tenbm" name="tenbm" placeholder="Tên bộ môn">
                            <span class="text-danger font-weight-bold" id="tenbmError"></span>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary add_bm">Thêm mới</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end modal add-->