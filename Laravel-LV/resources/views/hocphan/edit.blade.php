<!-- Modal -->
<div class="modal fade" id="edit_hp" centered="true" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sửa học phần</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            {{-- method="POST" action="{{ URL::to('/admin/cv/update')}}" --}}
            <form id="update_hp">
                {{-- @csrf --}}
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Mã học phần</label>
                            <input type="text" hidden class="form-control" value="" name="idhp" id="idhp">
                            <input type="text" class="form-control mahp" name="mahp" id="mahp"
                                placeholder="Mã học phần">
                            <span class="text-danger font-weight-bold" id="mahpErrorUpdate"></span>
                        </div>
                        <div class="form-group">
                            <label>Tên học phần</label>
                            <input type="text" class="form-control tenhp" name="tenhp" id="tenhp"
                                placeholder="Tên học phần">
                            <span class="text-danger font-weight-bold" id="tenhpErrorUpdate"></span>
                        </div>
                        <div class="form-group">
                            <label>Số tín chỉ</label>
                            <input type="number" class="form-control sotc" name="sotc" id="sotc" min="0" max="8">
                            <span class="text-danger font-weight-bold" id="sotcErrorUpdate"></span>
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