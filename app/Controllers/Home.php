<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
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
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Beranda</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active">Beranda</li>
                            </ol>
                        </div>';
                        $data['menu'] = $menu;
                        $data['breadcrumn'] = $breadcrumb;
                        $data['title_card'] = "Welcome to SMA Al-Fanisah";
                        $data['Selamat_datang'] = "Selamat Datang di Aplikasi pembayaran spp SMA Al-Fanisah ";
                        return view('template/content', $data);
    }
}
