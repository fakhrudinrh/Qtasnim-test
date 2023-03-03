<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Qtasnim Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
</head>

<body>
    <div class="container text-center py-5">
        <div class="row mb-5">
            <h1>Qtasnim Technical Test</h1>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="row text-start mb-3">
                        <div class="col">
                            <a href="" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#tambahModal">
                                <i class="fa-solid fa-plus"></i> Tambah
                            </a>
                        </div>
                        <div class="col-3">
                            <form id="formSearch">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" placeholder="Cari nama barang" name="keyword" id="keyword">
                                    <button class="btn btn-outline-secondary" type="button" onclick="btnClick()" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <?php if (session()->getFlashData('success')) : ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?= session()->getFlashData('success') ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="row">
                        <?= $sortBarang == 'asc' ? 'desc' : 'asc' ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">
                                        Nama Barang
                                        <form action="<?= base_url(uri_string(true) . '/') ?>" method="get" class="d-inline">
                                            <input type="hidden" name="sortBarang" value="<?= $sortBarang == 'asc' ? 'desc' : 'asc' ?>" id="sortBarang">
                                            <button type="submit" class="btn">
                                                <i class="fa-solid fa-down-long <?= $sortBarang == 'desc' ? 'text-dark' : 'text-secondary' ?>"></i>
                                                <i class="fa-solid fa-up-long <?= $sortBarang == 'asc' ? 'text-dark' : 'text-secondary' ?>"></i>
                                            </button>
                                        </form>
                                    </th>
                                    <th scope="col">Stok</th>
                                    <th scope="col">Jumlah Terjual</th>
                                    <th scope="col">Tanggal Transaksi</th>
                                    <th scope="col">Jenis Barang</th>
                                    <th scope="col" colspan="3" style="width:2%">Opsi</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <?php $no = 1 + (5 * ($currentPage - 1));
                                foreach ($barang as $b) :
                                ?>
                                    <tr>
                                        <th scope="row"><?= $no ?></th>
                                        <td><?= $b['nama'] ?></td>
                                        <td><?= $b['stok'] ?></td>
                                        <td><?= $b['jumlah_terjual'] ?></td>
                                        <td><?= date('d-m-Y', strtotime($b['tanggal_transaksi'])) ?></td>
                                        <td><?= $b['jenis'] ?></td>
                                        <td><a href="" class="btn text-success" data-bs-toggle="modal" data-bs-target="#updateModal<?= $b['id'] ?>"><i class="fa-solid fa-pen-to-square"></i></a></td>
                                        <td><a class="text-secondary">|</a></td>
                                        <td>
                                            <form action="/barang/<?= $b['id'] ?>" class="d-inline" method="post">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn text-danger" onclick="return confirm('Yakin menghapus data?')"><i class="fa-solid fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    <!-- Modal Update -->
                                    <div class="modal fade" id="updateModal<?= $b['id'] ?>" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="updateModalLabel">Edit Barang</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="/barang/<?= $b['id'] ?>" method="post">
                                                    <div class="modal-body">
                                                        <?= csrf_field() ?>
                                                        <div class="form-floating mb-3">
                                                            <input type="text" class="form-control" id="namaBarang" name="nama_barang" value="<?= $b['nama'] ?>">
                                                            <label for="namaBarang">Nama Barang</label>
                                                        </div>
                                                        <div class="form-floating mb-3">
                                                            <input type="number" class="form-control" id="stokBarang" name="stok_barang" value="<?= $b['stok'] ?>">
                                                            <label for="stokBarang">Stok Barang</label>
                                                        </div>
                                                        <div class="form-floating mb-3">
                                                            <input type="number" class="form-control" id="jmlTerjual" name="jml_terjual" value="<?= $b['jumlah_terjual'] ?>">
                                                            <label for="jmlTerjual">Jumlah Terjual</label>
                                                        </div>
                                                        <div class="form-floating mb-3">
                                                            <input type="date" class="form-control" id="tglTransaksi" name="tgl_transaksi" value="<?= $b['tanggal_transaksi'] ?>">
                                                            <label for="tglTransaksi">Tanggal Transaksi</label>
                                                        </div>
                                                        <div class="form-floating mb-3">
                                                            <input type="text" class="form-control" id="jenis" name="jenis_barang" value="<?= $b['jenis'] ?>">
                                                            <label for="jenis">Jenis Barang</label>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-outline-primary">Save changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    $no++;
                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <?= $pager->links('barang', 'barang_pagination') ?>
                    </div>
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
                <form action="/barang" method="post">
                    <div class="modal-body">
                        <?= csrf_field() ?>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="namaBarang" name="nama_barang">
                            <label for="namaBarang">Nama Barang</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="stokBarang" name="stok_barang">
                            <label for="stokBarang">Stok Barang</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="jmlTerjual" name="jml_terjual">
                            <label for="jmlTerjual">Jumlah Terjual</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="tglTransaksi" name="tgl_transaksi">
                            <label for="tglTransaksi">Tanggal Transaksi</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="jenis" name="jenis_barang">
                            <label for="jenis">Jenis Barang</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <script>
        function btnClick() {
            var keyword = document.getElementById("keyword").value;
            var sortBarang = document.getElementById("sortBarang").value;

            $.ajax({
                url: "<?= site_url(uri_string()); ?>",
                type: "POST",
                dataType: 'json',
                data: {
                    'keyword': keyword,
                    'sortBarang': sortBarang
                },
                success: function(msg) {
                    alert(msg);
                },
                error: function(xhr, ajaxOptions, throwError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
                }
            })
        }
    </script>
</body>

</html>