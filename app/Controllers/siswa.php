<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SiswaModel;

class Siswa extends BaseController
{
    protected $sm;
    private $menu;
    private $rules;
    public function __construct()
    {
        $this->sm = new SiswaModel();
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
            'siswa' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'siswa tidak boleh kosong',
                ]
            ],
            'no_induk' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'No_induk tidak boleh kosong',
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'Nama tidak boleh kosong',
                ]
            ],
            'kelas' => [
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
                            <h1 class="m-0">Siswa</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href ="' . base_url() . '">Beranda</a></li>
                            <li class="breadcrumb-item active">Siswa</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumn'] = $breadcrumb;
        $data['title_card'] = "Data Siswa";

        $query = $this->sm->find();
        $data ['data_Siswa'] = $query;
        return view('siswa/content', $data);
    }

    public function tambah()
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Siswa</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href ="' . base_url() . '">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="' . base_url() . '/Siswa">Siswa</a></li>
                                <li class="breadcrumb-item active">Tambah data Siswa</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = 'Tambah Data Siswa';
        $data['action'] = base_url() . '/Siswa/simpan';
        return view('siswa/input', $data);
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
            $simpan = $this->sm->insert($dt);
            return redirect()->to('siswa')->with('success', 'Data berhasil disimpan');

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
            $this->sm->delete($id);
            return redirect()->to('siswa')->with('success', 'Data anggota dengan kode '.$id.'berhasil dihapus');

        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {

            return redirect()->to('siswa')->with('error', $e->getMessage());
        }
    }
    public function edit($id) {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Siswa</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href ="' . base_url() . '">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="' . base_url() . '/siswa">Siswa</a></li>
                                <li class="breadcrumb-item active">Edit Siswa</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = 'Edit Siswa';
        $data['action'] = base_url() . '/siswa/update';

        $data['edit_data'] =$this->sm->find($id);
        return view('siswa/input', $data);
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
            $this->sm->update($param, $dtEdit);
            return redirect()->to('siswa')->with('success', 'Data berhasil di Update');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            session()->setFlashdata('error', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
}
