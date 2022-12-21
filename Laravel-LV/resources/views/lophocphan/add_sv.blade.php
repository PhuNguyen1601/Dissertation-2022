<!-- Modal add -->
<div class="modal fade" id="add_sv_lhp" centered="true" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm sinh viên vào lớp</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            <form method="post" id="add_new_sv_lhp">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Lớp học phần</label>
                            @foreach ($all_lhp as $lhp)
                            <input type="text" class="form-control lophocphan" value="{{ $lhp->id }}" name="lophocphan"
                                placeholder="{{ $lhp->malhp }}" hidden>
                            <input type="text" class="form-control" name="lophocphan" placeholder="{{ $lhp->malhp }}"
                                disabled>
                            @endforeach
                            <span class="text-danger font-weight-bold" id="lophocphanError"></span>
                        </div>
                        <div class="form-group">
                            <label>Mã sinh viên</label>
                            <input type="text" class="form-control masv" name="masv" placeholder="Niên khóa">
                            <span class="text-danger font-weight-bold" id="masvError"></span>
                        </div>
                        <div class="form-group">
                            <label>Niên khóa</label>
                            <input type="text" class="form-control nienkhoa" name="nienkhoa" placeholder="Niên khóa">
                            <span class="text-danger font-weight-bold" id="nienkhoaError"></span>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary add_sv_lhp">Thêm mới</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end modal add-->