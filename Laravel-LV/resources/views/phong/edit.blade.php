<!-- Modal -->
<div class="modal fade" id="edit_p" centered="true" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sửa phòng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            {{-- method="POST" action="{{ URL::to('/admin/p/update')}}" --}}
            <form id="update_p">
                {{-- @csrf --}}
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" hidden class="form-control" value="" name="idp" id="idp">
                            <label>Mã phòng</label>
                            <input type="text" class="form-control map" name="map" id="map" placeholder="Mã số phòng">
                            <span class="text-danger font-weight-bold" id="mapErrorUpdate"></span>
                        </div>
                        <div class="form-group">
                            <label>Sức chứa</label>
                            <input type="number" class="form-control succhua" name="succhua" id="succhua">
                            <span class="text-danger font-weight-bold" id="succhuaErrorUpdate"></span>
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