<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayranModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'siswa';
    protected $primaryKey       = 'No_induk';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['Jenis_pembayaran','Tahun_ajaran','Besar_pembayaran','Jumlahyg_dibayar'];
    
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];
    
    protected function hashPassword(array $data)
    {
        if (! isset($data['data']['password'])) {
            return $data;
        }

        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);

        return $data;
    }
}
