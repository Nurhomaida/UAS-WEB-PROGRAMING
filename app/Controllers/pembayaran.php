<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PembayaranModel;

class Pembayaran extends BaseController
{
    protected $pm;
    private $menu;
    private $rules;
    public function __construct()
    {
        $this->pm = new PembayaranModel();
        $menu = [
            'beranda' => [
                'title'=> 'Beranda',
                'link'=> base_url(),
                'icon'=> 'fa-duotone fa-house',
                'aktif'=> 'active',
            ],
            'siswa' => [
                'title'=> 'Siswa',
                'link'=> base_url(). '/siswa',
                'icon'=> 'fa-solid fa-users',
                'aktif'=> '',
            ],
            'pembayaran' => [
                'title'=> 'Pembayaran',
                'link'=> base_url(). '/pembayaran',
                'icon'=> 'fa-sharp fa-regular fa-money-from-bracket',
                'aktif'=> '',
            ],
        ];

        $this->rules = [
            'pembayran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'siswa tidak boleh kosong',
                ]
            ],
            'jenis_pembayaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'No_induk tidak boleh kosong',
                ]
            ],
            'tahun_ajaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong',
                ]
            ],
            'besar_pembayaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kelas tidak boleh kosong',
                ]
            ],
            'jumlahyg_dibayar' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kelas tidak boleh kosong',
                ]
            ],
        ];
    }

    public function index()
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Pembayaran</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href ="' . base_url() . '">Beranda</a></li>
                            <li class="breadcrumb-item active">Pembayaran</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumn'] = $breadcrumb;
        $data['title_card'] = "Data Pembayaran";

        $query = $this->pm->find();
        $data ['data_Pembayaran'] = $query;
        return view('pembayaran/content', $data);
    }

    public function tambah()
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Pembayaran</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href ="' . base_url() . '">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="' . base_url() . '/Pembayaran">Pembayaran</a></li>
                                <li class="breadcrumb-item active">Tambah Pembayaran</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = 'Tambah Pembayaran';
        $data['action'] = base_url() . '/Pembayaran/simpan';
        return view('pembayaran/input', $data);
    }

    public function simpan()
    {
        
        if (! $this->request->is('post')) {
            
            return redirect()->back()->withInput();
        }

        if (! $this->validate($this->rules)) {
            return redirect()->back()->withInput();
        }
        $dt = $this->request->getPost();
        try {
            $simpan = $this->pm->insert($dt);
            return redirect()->to('Pembayaran')->with('success', 'Data berhasil disimpan');

        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            
            session()->setFlashdata('error', $e->getMessage());
            return redirect()->back()->withInput();
        }    
    }

    public function hapus($id) 
    {
        if(empty($id)) {
            return redirect()->back()->with('error', 'Hapus data gagal dilakukan');
        }

        try {
            $this->pm->delete($id);
            return redirect()->to('pembayaran')->with('success', 'Data anggota dengan kode '.$id.'berhasil dihapus');

        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {

            return redirect()->to('pembayaran')->with('error', $e->getMessage());
        }
    }

    public function edit($id) {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Pembayaran</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href ="' . base_url() . '">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="' . base_url() . '/pembayaran">Pembayaran</a></li>
                                <li class="breadcrumb-item active">Edit Pembayaran</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = 'Edit Pembayaran';
        $data['action'] = base_url() . '/pembayaran/update';

        $data['edit_data'] =$this->pm->find($id);
        return view('pembayaran/input', $data);
    }

    public function update() {
        $dtEdit = $this->request->getPost();
        $param = $dtEdit['param'];
        unset($dtEdit['param']);
        unset($this->rules['password']);

        if (!$this->validate($this->rules)) {

            return redirect()->back()->withinput();
        }

        if (empty($dtEdit['password'])) {
            unset($dtEdit['password']);
        }

        try {
            $this->pm->update($param, $dtEdit);
            return redirect()->to('pembayaran')->with('success', 'Data berhasil di Update');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            session()->setFlashdata('error', $e->getMessage());
            return redirec()->back()->withInput();
        }
    }
}
