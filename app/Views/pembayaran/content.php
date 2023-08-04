<?php
echo $this->extend('template/index');
echo $this->section('content');
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?php echo $title_card; ?></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <?php
                if(session()->getFlashdata('success')){
                    ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-check"></i> Success</h5>  
                            <?php echo session()->getFlashdata('success'); ?>
                        </div>
                    <?php
                }
                ?>

                <a class="btn btn-sm btn-primary" href="<?php echo base_url(); ?>/pembayaran/tambah"><i class="fa-solid fa-plus"></i>Tambah Data</a>
            <table class="table">
                    <thead>
                        <tr>
                        <th style="width: 10px">#</th>
                        <th>Beranda</th>
                        <th>Jenis_pembayaran</th>
                        <th>Tahun_ajaran</th>
                        <th>Besar_pembayaran</th>
                        <th>Jumlahyg_dibayar</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no=1;
                        foreach ($data_pembayaran as $r) {

                        ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $r['Jenis_pembayaran']; ?></td>
                                <td><?php echo $r['Tahun_ajaran']; ?></td>
                                <td><?php echo $r['Besar_pembayaran']; ?></td>
                                <td><?php echo $r['Jumlahyg_dibayar']; ?></td>
                                <td><a class="btn btn-outline-success btn-sm" href="<?php echo base_url(); ?>/pembayaran/edit/<?php echo $r['Pembayaran']; ?>"><i class="fa-regular fa-pen-to-square"></i></a> 
                                    <a class="btn btn-outline-danger btn-sm" href="#" onclick="return hapusconfig(<?php echo $r['Pembayaran']; ?>);"><i class="fa-solid fa-trash-can"></i></a>
                                </td>
                             </tr>
                        <?php
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
               
        </div>
        <!-- /.card -->
    </div>
</div>

<script>
    function hapusconfig(){
        Swal.fire({
            title: 'Anda yakin ingin menghapus data ini?',
            text: "Data akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus Data!'
        }).then((result) => {
            if (result.isConfirmed) {
                windows.location.href='<?php echo base_url(); ?>/anggotpembayaran/hapus' +id;
            }
        })
    }
</script>
<?php
echo $this->endSection();