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
                    <?php echo $Selamat_datang; ?>
              </div>
              <!-- /.card-body -->

        </div>
        <!-- /.card -->

        <a href="#" class="btn btn-primary">About the Library</a>
    </div>
</div>


<?php
echo $this->endSection();