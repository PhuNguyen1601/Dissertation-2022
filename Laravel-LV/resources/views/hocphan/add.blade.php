<!-- Modal add -->
<div class="modal fade" id="add_hp" centered="true" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm học phần</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            <form method="post" id="add_new_hp">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Mã học phần</label>
                            <input type="text" class="form-control mahp" name="mahp" placeholder="Mã học phần">
                            <span class="text-danger font-weight-bold" id="mahpError"></span>
                        </div>
                        <div class="form-group">
                            <label>Tên học phần</label>
                            <input type="text" class="form-control tenhp" name="tenhp" placeholder="Tên học phần">
                            <span class="text-danger font-weight-bold" id="tenhpError"></span>
                        </div>
                        <div class="form-group">
                            <label>Số tín chỉ</label>
                            <input type="number" class="form-control sotc" name="sotc" min="0" max="8">
                            <span class="text-danger font-weight-bold" id="sotcError"></span>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end modal add-->