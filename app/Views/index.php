<?= $this->extend('templates/body') ?>

<?= $this->section('content') ?>

<div class="row mb-5">
    <h1>Qtasnim Technical Test</h1>
</div>
<div class="row">
    <div class="card">
        <div class="card-body">
            <div class="row text-start mb-3">
                <div class="col text-start">
                    <button class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#tambahModal">
                        <i class="fa-solid fa-plus"></i> Tambah
                    </button>
                </div>
                <div class="col-2 text-start">
                    <select class="form-select form-select-sm" id="sortBy" onchange="loadData()">
                        <option selected disabled>Sort Nama Barang</option>
                        <option value="asc">Nama Barang Asc</option>
                        <option value="desc">Nama Barang Desc</option>
                    </select>
                </div>
                <div class="col-3">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" placeholder="Cari nama barang" id="keyword">
                        <button class="btn btn-outline-secondary" type="button" onclick="loadData()" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </div>
            </div>
            <div class="row text-start mb-2">
                <div class="col-3 text-start">
                    <select class="form-select form-select-sm" id="sortJmlTerjual" onchange="loadData()">
                        <option selected disabled>Sort Data Jumlah Terjual</option>
                        <option value="desc">Jumlah Terbanyak Terjual</option>
                        <option value="asc">Jumlah Terendah Terjual</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control form-control-sm" id="startDate" disabled>
                        <label for="startDate">Tanggal Mulai</label>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control form-control-sm" id="endDate" onchange="loadData()" disabled>
                        <label for="endDate">Tanggal Selesai</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Jumlah Terjual</th>
                            <th scope="col">Tanggal Transaksi</th>
                            <th scope="col">Jenis Barang</th>
                            <th scope="col" colspan="3" style="width:2%">Opsi</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider" id="dataBarang">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahModalLabel">Tambah Barang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?= csrf_field() ?>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="namaBarang">
                    <label for="namaBarang">Nama Barang</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="stokBarang">
                    <label for="stokBarang">Stok Barang</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="jmlTerjual">
                    <label for="jmlTerjual">Jumlah Terjual</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="tglTransaksi">
                    <label for="tglTransaksi">Tanggal Transaksi</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="jenis">
                    <label for="jenis">Jenis Barang</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline-primary" onclick="tambahData()">Tambah Data</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Update -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="updateModalLabel">Update Barang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?= csrf_field() ?>
                <div class="form-floating mb-3">
                    <input type="hidden" class="form-control" id="idBarang">
                    <input type="text" class="form-control" id="editNamaBarang">
                    <label for="namaBarang">Nama Barang</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="editStokBarang">
                    <label for="stokBarang">Stok Barang</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="editJmlTerjual">
                    <label for="jmlTerjual">Jumlah Terjual</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="editTglTransaksi">
                    <label for="tglTransaksi">Tanggal Transaksi</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="editJenis">
                    <label for="jenis">Jenis Barang</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline-primary" onclick="updateData()">Update Data</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Hapus Barang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" id="deleteIdBarang">
                <h4>Yakin akan menghapus data?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline-danger" onclick="deleteData()">Hapus Data</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        loadData();
    });

    $("#sortJmlTerjual").on('change', function() {
        $("#startDate").removeAttr("disabled");
    })

    $("#startDate").on('change', function() {
        $("#endDate").removeAttr("disabled");
    })

    $("#endDate").on('change', function() {
        $("#startDate").attr("disabled", "disabled");
        $("#endDate").attr("disabled", "disabled");
    })

    function loadData() {
        $("#dataBarang").html("");
        $.ajax({
            url: "/barang",
            method: "GET",
            data: {
                'keyword': $("#keyword").val(),
                'sort': $("#sortBy").val(),
                'sortJmlTerjual': $("#sortJmlTerjual").val(),
                'startDate': $("#startDate").val(),
                'endDate': $("#endDate").val(),
            },
            success: function(response) {
                // console.log(response.barang);
                let no = 1;
                $.each(response.barang, function(key, value) {
                    $('#dataBarang').append(
                        '<tr>\
                        <th scope="row">' + no + '</th>\
                        <td>' + value['nama'] + '</td>\
                        <td>' + value['stok'] + '</td>\
                        <td>' + value['jumlah_terjual'] + '</td>\
                        <td>' + value['tanggal_transaksi'] + '</td>\
                        <td>' + value['jenis'] + '</td>\
                        <td><a href="" class="btn text-success" onclick="editBtn(' + value['id'] + ')"><i class="fa-solid fa-pen-to-square"></i></a></td>\
                        <td><a class="text-secondary">|</a></td>\
                        <td><a href="" class="btn text-danger" onclick="deleteBtn(' + value['id'] + ')"><i class="fa-solid fa-trash"></i></a></td>\
                        </tr>'
                    )
                    no++;
                })
            }
        })
        event.preventDefault();
    }

    function tambahData() {
        $.ajax({
            url: "/barang",
            method: "POST",
            data: {
                'nama': $("#namaBarang").val(),
                'stok': $("#stokBarang").val(),
                'jumlah_terjual': $("#jmlTerjual").val(),
                'tanggal_transaksi': $("#tglTransaksi").val(),
                'jenis': $("#jenis").val(),
            },
            success: function(response) {
                $("#tambahModal").modal("hide");
                $("#dataBarang").html("");
                $("#tambahModal").find('input').val('');
                loadData();
                alert(response);
            }
        })
        event.preventDefault();
    }

    function editBtn(id) {
        $.ajax({
            url: "/edit",
            method: "POST",
            data: {
                'id': id
            },
            success: function(response) {
                $.each(response, function(key, value) {
                    $("#idBarang").val(value['id']);
                    $("#editNamaBarang").val(value['nama']);
                    $("#editStokBarang").val(value['stok']);
                    $("#editJmlTerjual").val(value['jumlah_terjual']);
                    $("#editTglTransaksi").val(value['tanggal_transaksi']);
                    $("#editJenis").val(value['jenis']);
                    $("#updateModal").modal("show");
                })
            }
        })
        event.preventDefault();
    }

    function updateData() {
        $.ajax({
            url: "/barang/" + $("#idBarang").val() + "",
            method: "POST",
            data: {
                'nama': $("#editNamaBarang").val(),
                'stok': $("#editStokBarang").val(),
                'jumlah_terjual': $("#editJmlTerjual").val(),
                'tanggal_transaksi': $("#editTglTransaksi").val(),
                'jenis': $("#editJenis").val(),
            },
            success: function(response) {
                $("#updateModal").modal("hide");
                $("#dataBarang").html("");
                loadData();
                alert(response);
            }
        })
        event.preventDefault();
    }

    function deleteBtn(id) {
        $("#deleteModal").modal("show");
        $("#deleteIdBarang").val(id);
        event.preventDefault();
    }

    function deleteData() {
        $.ajax({
            url: "/barang/" + $("#deleteIdBarang").val() + "",
            method: "DELETE",
            success: function(response) {
                $("#deleteModal").modal("hide");
                alert(response);
                $("#dataBarang").html("");
                loadData();
            }
        })
        event.preventDefault();
    }
</script>

<?= $this->endSection() ?>