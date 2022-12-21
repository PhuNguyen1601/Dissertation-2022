<!-- Modal add -->
<div class="modal fade" id="add_th" centered="true" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm bộ môn</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            <form method="post" id="add_new_th">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Tiết học</label>
                            <input type="text" class="form-control tiethoc" name="tiethoc" placeholder="Tiết học">
                            <span class="text-danger font-weight-bold" id="tiethocError"></span>
                        </div>
                        <div class="form-group">
                            <label>Giờ bắt đầu</label>
                            <input type="text" class="form-control datetimepicker-input start_time"
                                placeholder="HH:mm AM/PM" name="start_time" id="start_time_add">
                            <span class="text-danger font-weight-bold" id="start_timeError"></span>
                        </div>
                        <div class="form-group">
                            <label>Giờ kết thúc</label>
                            <input type="text" class="form-control datetimepicker-input end_time"
                                placeholder="HH:mm AM/PM" name="end_time" id="end_time_add">
                            <span class="text-danger font-weight-bold" id="end_timeError"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary add_th">Thêm mới</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end modal add-->