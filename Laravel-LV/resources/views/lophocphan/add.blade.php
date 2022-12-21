<!-- Modal add -->
<div class="modal fade" id="add_lhp" centered="true" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm lớp học phần</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            <form method="post" id="add_new_lhp">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Mã lớp học phần</label>
                            <input type="text" class="form-control malhp" name="malhp">
                            <span class="text-danger font-weight-bold" id="malhpError"></span>
                        </div>
                        <div class="form-group">
                            <label>Học phần</label>
                            <select class="form-control text-center hocphan" id="hocphan" name="hocphan">
                                <option value="">---- Chọn học phần ----</option>
                                @foreach ($all_hp as $hp)
                                <option value="{{ $hp->id }}">
                                    {{ $hp->tenhp}}
                                </option>
                                @endforeach
                            </select>
                            <span class="text-danger font-weight-bold" id="hocphanError"></span>
                        </div>

                        <div class="form-group">
                            <label>Giảng viên</label>
                            <select class="form-control text-center giangvien" id="giangvien" name="giangvien">
                                <option value="">---- Chọn giảng viên ----</option>
                                @foreach ($all_gv as $gv)
                                <option value="{{ $gv->id }}">
                                    {{ $gv->tengv}}
                                </option>
                                @endforeach
                            </select>
                            <span class="text-danger font-weight-bold" id="giangvienError"></span>
                        </div>
                        <div class="form-group">
                            <label>Học kì</label>
                            <select class="form-control text-center" id="hocki" name="hocki">
                                <option value="">---- Chọn học kì ----</option>
                                @foreach ($all_hk as $hk)
                                <option value="{{ $hk->id }}">
                                    {{ $hk->hocki }}
                                </option>
                                @endforeach
                            </select>
                            <span class="text-danger font-weight-bold" id="hockiError"></span>
                        </div>
                        <div class="form-group">
                            <label>Niên khóa</label>
                            <select class="form-control text-center" id="nienkhoa" name="nienkhoa">
                                <option value="">---- Chọn niên khóa ----</option>
                                @foreach ($all_nk as $nk)
                                <option value="{{ $nk->id }}">
                                    {{ $nk->nienkhoa }}
                                </option>
                                @endforeach
                            </select>
                            <span class="text-danger font-weight-bold" id="nienkhoaError"></span>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary add_hp">Thêm mới</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end modal add-->