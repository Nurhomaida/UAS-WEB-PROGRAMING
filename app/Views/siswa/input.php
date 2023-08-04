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
                            <input type="hidden" name="param" id="param" value="<?php echo $edit_data ['siswa']; ?>">
                            <?php
                        }
                    ?>
                    <div class="form-group">
                        <label for="siswa">Siswa</label>
                        <input type="text" name="siswa" id="siswa" value="<?php echo empty(set_value('siswa')) ? (empty($edit_data['siswa']) ? "":$edit_data['siswa']) : set_value('siswa') ; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="no_induk">No_induk</label>
                        <input type="text" name="no_induk" id="no_induk" value="<?php echo empty(set_value('no_induk')) ? (empty($edit_data['no_induk']) ? "":$edit_data['no_induk']) : set_value('no_induk') ; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" value="<?php echo empty(set_value('nama')) ? (empty($edit_data['nama']) ? "":$edit_data['nama']) : set_value('nama') ; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <input type="text" name="kelas" id="kelas" value="<?php echo empty(set_value('kelas')) ? (empty($edit_data['kelas']) ? "":$edit_data['kelas']) : set_value('kelas') ; ?>" class="form-control">
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
