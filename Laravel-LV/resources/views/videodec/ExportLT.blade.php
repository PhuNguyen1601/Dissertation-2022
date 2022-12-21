<table id="example1" class="table table-bordered table-striped text-center">
    <thead>
        <tr>
            <th>STT</th>
            <th>Lớp học phần</th>
            <th>Mã CB</th>
            <th>Họ và tên CBGD</th>
            <th>Mã học phần</th>
            <th>Tên học phần</th>
            <th>Ngày thi</th>
            <th>Phòng thi</th>
            <th>Thời gian thi</th>
            <th>Bắt đầu thi</th>
        </tr>
    </thead>
    <tbody>
        @php
        $a = 1;
        @endphp
        @foreach ($all_ltt as $lt)

        <tr>
            <td>{{ $a = $a++ }}</td>
            <td>{{ $lt->malhp }}</td>
            <td>{{ $lt->magv }}</td>
            <td>{{ $lt->tengv }}</td>
            <td>{{ $lt->mahp }}</td>
            <td>{{ $lt->tenhp }}</td>
            <td>{{ date('d/m/Y', strtotime($lt->ngaythang)) }}</td>
            <td>{{ $lt->map }}</td>
            <td>{{ $lt->tgthi*30 }} Phút</td>
            <td>{{ $lt->tiet }}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
    </tfoot>
</table>