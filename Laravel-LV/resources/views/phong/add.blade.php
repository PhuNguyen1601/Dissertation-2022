<!-- Modal add -->
<div class="modal fade" id="add_p" centered="true" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm phòng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            <form method="post" id="add_new_p">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Mã phòng</label>
                            <input type="text" class="form-control map" name="map" placeholder="Mã phòng">
                            <span class="text-danger font-weight-bold" id="mapError"></span>
                        </div>
                        <div class="form-group">
                            <label>Sức chứa</label>
                            <input type="number" class="form-control succhua" name="succhua" min="0" max="100">
                            <span class="text-danger font-weight-bold" id="succhuaError"></span>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary add_p">Thêm mới</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end modal add-->