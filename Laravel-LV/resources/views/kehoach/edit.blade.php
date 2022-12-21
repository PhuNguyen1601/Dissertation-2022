<!-- Modal -->
<div class="modal fade" id="edit_kh" centered="true" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sửa học kì</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            <form id="update_hk">
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input type="text" class="form-control idkh" name="idkh" id="idkh" hidden>
                            <input type="text" class="form-control tieude" name="tieude" id="tieude"
                                placeholder="Tiêu đề">
                            <span class="text-danger font-weight-bold" id="tieudeErrorUpdate"></span>
                        </div>
                        <div class="form-group">
                            <label>Ngày bắt đầu đăng kí</label>
                            <input type="date" class="form-control ngaybd_dk" name="ngaybd_dk" id="ngaybd_dk">
                            <span class="text-danger font-weight-bold" id="ngaybd_dkErrorUpdate"></span>
                        </div>
                        <div class="form-group">
                            <label>Ngày kết thúc đăng kí</label>
                            <input type="date" class="form-control ngaykt_dk" name="ngaykt_dk" id="ngaykt_dk">
                            <span class="text-danger font-weight-bold" id="ngaykt_dkErrorUpdate"></span>
                        </div>
                        <div class="form-group">
                            <label>Ngày bắt đầu thi</label>
                            <input type="date" class="form-control ngaybd_thi" name="ngaybd_thi" id="ngaybd_thi">
                            <span class="text-danger font-weight-bold" id="ngaybd_thiErrorUpdate"></span>
                        </div>
                        <div class="form-group">
                            <label>Ngày kết thúc thi</label>
                            <input type="date" class="form-control ngaykt_thi" name="ngaykt_thi" id="ngaykt_thi">
                            <span class="text-danger font-weight-bold" id="ngaykt_thiErrorUpdate"></span>
                        </div>

                        <div class="form-group">
                            <label>Học kì</label>
                            <select class="form-control text-center hkidkh" name="hkidkh" id="hkidkh">
                                <option value="">---- Chọn học kì ----</option>
                                @foreach ($all_hk as $hk)
                                <option value="{{ $hk->id }}">
                                    {{ $hk->hocki }}
                                </option>
                                @endforeach
                            </select>
                            <span class="text-danger font-weight-bold" id="hockiErrorUpdate"></span>
                        </div>
                        <div class="form-group">
                            <label>Niên khóa</label>
                            <select class="form-control text-center nkidkh" name="nkidkh" id="nkidkh">
                                <option value="">---- Chọn niên khóa ----</option>
                                @foreach ($all_nk as $nk)
                                <option value="{{ $nk->id }}">
                                    {{ $nk->nienkhoa }}
                                </option>
                                @endforeach
                            </select>
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