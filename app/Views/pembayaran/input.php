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

            <form action="<?php echo $action; ?>" method="post">
                <div class="card-body">
                    <?php if(validation_errors()){
                    ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-ban"></i> Alert!</h5>  
                            <?php echo validation_list_errors() ?>
                        </div>
                    <?php
                    }
                    ?>

                    <?php
                    if(session()->getFlashdata('error')){
                        ?>
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-warning"></i> Error</h5>  
                                <?php echo session()->getFlashdata('error'); ?>
                            </div>
                        <?php
                    }
                    ?>

                    <?php echo csrf_field() ?>
                    <?php 
                        if (current_url(true)->getSegment(2) == 'edit') {
                            ?>
                            <input type="hidden" name="param" id="param" value="<?php echo $edit_data ['pembayaran']; ?>">
                            <?php
                        }
                    ?>
                    <div class="form-group">
                        <label for="pembayaran">Pembayaran</label>
                        <input type="text" name="pembayaran" id="pembayaran" value="<?php echo empty(set_value('pembayaran')) ? (empty($edit_data['pembayaran']) ? "":$edit_data['pembayaran']) : set_value('pembayaran') ; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="jenis_pembayaran">Jenis_pembayaran</label>
                        <input type="text" name="jenis_pembayaran" id="jenis_pembayaran" value="<?php echo empty(set_value('jenis_pembayaran')) ? (empty($edit_data['jenis_pembayaran']) ? "":$edit_data['jenis_pembayaran']) : set_value('jenis_pembayaran') ; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="tahun_ajaran">Tahun_Ajaran</label>
                        <input type="text" name="tahun_ajaran" id="tahun_ajaran" value="<?php echo empty(set_value('tahun_ajaran')) ? (empty($edit_data['tahun_ajaran']) ? "":$edit_data['tahun_ajaran']) : set_value('tahun_ajaran') ; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="besar_pembayaran">Besar_pembayaran</label>
                        <input type="text" name="besar_pembayaran" id="besar_pembayaran" value="<?php echo empty(set_value('besar_pembayaran')) ? (empty($edit_data['besar_pembayaran']) ? "":$edit_data['besar_pembayaran']) : set_value('besar_pembayaran') ; ?>" class="form-control">
                    </div>                              
                    <div class="form-group">
                        <label for="jumlahyg_dibayar">Jumlahyg_dibayar</label>
                        <input type="text" name="jumlahyg_dibayar" id="jumlahyg_dibayar" value="<?php echo empty(set_value('jumlahyg_dibayar')) ? (empty($edit_data['jumlahyg_dibayar']) ? "":$edit_data['jumlahyg_dibayar']) : set_value('jumlahyg_dibayar') ; ?>" class="form-control">
                    </div>                              
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>        
    </div>
</div>
<?php
echo $this->endSection();
