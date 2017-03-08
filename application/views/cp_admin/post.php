<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="box box-info">
            <div class="box-body">
                
            </div>
        </div>
    </section>

    <!-- Main content -->
<section class="content">
     <!-- ALERT -->
<?php if ($this->session->flashdata('message')): 
        if($this->session->flashdata('status')=='success') $class='alert alert-success';
        elseif ($this->session->flashdata('status')=='fail') $class='alert alert-danger';?>
<div class="<?=$class?>" id="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <?=$this->session->flashdata('message')?>
</div>
<?php endif;?>
    <!-- /. ALERT -->    
    
    
    <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">All Post</h3>
      <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 200px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
    </div>
    <div class="box-body table-responsive">
        <table class="table table-hover">
            <tr>
                <th style="width: 50px;">No.</th>
                <th>Title</th>
                <th>Page</th>
                <th>Date</th>
                <th>Status</th>
                <th  class="text-left" style="width: 100px;">Action</th>
            </tr>
            <?php 
                $x=1;
                foreach ($konten as $row):
            ?>
            <tr>
                <td><?=$x?>.</td>
                <td><strong><?=$row->title?></strong></td>
                <td><?=$row->name?></td>
                <td><?=$row->date?></td>
                <td><?=$row->status?></td>
                <td>
                    <a class="btn" data-toggle="tooltip" data-placement="bottom" title="update" href="<?=base_url()?>cp_post/update/<?=base64_encode($row->post_id);?>"><i class="fa fa-pencil"></i>  </a>
                    <a class="btn" data-toggle="tooltip" data-placement="bottom" title="delete" href="<?=base_url()?>cp_pages/delete/<?=base64_encode($row->post_id);?>" onClick="return confirm('Are you sure want to delete this item?')"><i class="fa fa-trash text-danger"></i>  </a>
                </td>
            </tr>
            <?php
                $x++;
                endforeach;
            ?>
        </table>
    </div>           
    </div>
    <!-- /. div colom end -->
</section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->