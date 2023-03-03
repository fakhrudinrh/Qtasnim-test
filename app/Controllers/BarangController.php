<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;

class BarangController extends BaseController
{
    protected $barangModel;

    public function __construct()
    {
        $this->barangModel = new BarangModel();;
    }

    public function index()
    {
        // $currentPage = $this->request->getVar('page_barang') ? $this->request->getVar('page_barang') : 1;
        // $currentPage = $page ? $page : 1;

        // $keyword = $this->request->getPost('keyword');
        // // echo $keyword;
        // if ($this->request->isAjax()) {
        //     $keyword = $this->request->getPost('keyword');
        //     echo json_encode($keyword);
        //     // $query = service('request')->getVar('keyword');
        //     // $querys = service('request')->getVar('sortBarang');
        //     // echo $query . $querys;
        // } else {
        //     echo "adasa";
        // }


        // if ($keyword) {
        //     $barang = $this->barangModel->search($keyword);
        // } else {
        //     $barang = $this->barangModel;
        // }
        // // dd($barang);
        // // $barang = $barang->orderBy('nama', 'asc');
        // $sortBarang = $this->request->getVar('sortBarang');

        // echo $keyword . $sortBarang;
        // if ($sortBarang) {
        //     $barang = $barang->orderBy('nama', $sortBarang);
        // }

        // $data = [
        //     // 'barang' => $barang->findAll(),
        //     'barang' => $barang->paginate(2, 'barang', null, 1),
        //     'pager'  => $this->barangModel->pager,
        //     'currentPage' => $currentPage,
        //     'sortBarang' => $sortBarang
        // ];

        // return view('index', $data);
        $data = [
            'barang' => $this->barangModel->findAll()
        ];

        return view('index', $data);
    }

    public function read()
    {
        $keyword = $this->request->getVar('keyword');
        $sort = $this->request->getVar('sort');
        $sortJmlTerjual = $this->request->getVar('sortJmlTerjual');
        $startDate = $this->request->getVar('startDate');
        $endDate = $this->request->getVar('endDate');

        if ($keyword) {
            $barang = $this->barangModel->search($keyword);
        } else {
            $barang = $this->barangModel;
        }

        if ($sort) {
            $barang = $barang->orderBy('nama', $sort);
        } else {
            $barang = $this->barangModel;
        }

        if ($sortJmlTerjual) {
            $barang = $barang->orderBy('jumlah_terjual', $sortJmlTerjual);
        } else {
            $barang = $this->barangModel;
        }

        if ($startDate && $endDate) {
            $barang = $barang->where(['tanggal_transaksi >=' => $startDate, 'tanggal_transaksi <=' => $endDate]);
        } else {
            $barang = $this->barangModel;
        }

        $data = [
            'barang' => $barang->findAll()
        ];

        return $this->response->setJSON($data);
    }

    public function create()
    {
        $data = [
            'nama'              => $this->request->getVar('nama'),
            'stok'              => $this->request->getVar('stok'),
            'jumlah_terjual'    => $this->request->getVar('jumlah_terjual'),
            'tanggal_transaksi' => $this->request->getVar('tanggal_transaksi'),
            'jenis'             => $this->request->getVar('jenis'),
        ];

        $this->barangModel->insert($data);
        $data = [
            'success', 'Tambah data barang berhasil'
        ];
        return $this->response->setJSON($data);
    }

    public function edit()
    {
        $id = $this->request->getVar('id');
        $data['barang'] = $this->barangModel->find($id);
        return $this->response->setJSON($data);
    }

    public function update($id)
    {
        $data = [
            'nama'              => $this->request->getVar('nama'),
            'stok'              => $this->request->getVar('stok'),
            'jumlah_terjual'    => $this->request->getVar('jumlah_terjual'),
            'tanggal_transaksi' => $this->request->getVar('tanggal_transaksi'),
            'jenis'             => $this->request->getVar('jenis'),
        ];
        $this->barangModel->update($id, $data);
        $data = [
            'success', 'Update data barang berhasil'
        ];

        return $this->response->setJSON($data);
    }

    public function delete($id)
    {
        $this->barangModel->delete($id);
        $data = [
            'success', 'Hapus data barang berhasil'
        ];

        return $this->response->setJSON($data);
    }
}
