<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$title?>
      </h1>
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
    
    <div class="col-sm-5">
    <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">All pages</h3>
    </div>
    <div class="box-body">
        <table class="table table-bordered">
            <tr>
                <th  class="text-center" style="width: 20px;">No.</th>
                <th  class="text-center">Name</th>
                <th  class="text-center" style="width: 100px;">Action</th>
            </tr>
            <?php 
                $x=1;
                foreach ($table as $row):
            ?>
            <tr>
                <td><?=$x?></td>
                <td><?=$row->name?></td>
                <td>
                    <a class="btn" data-toggle="tooltip" data-placement="bottom" title="update" href="<?=base_url()?>cp_pages/update/<?=base64_encode($row->menu_id);?>"><i class="fa fa-pencil"></i>  </a>
                    <?php if($row->menu_id!=1):?>
                    <a class="btn" data-toggle="tooltip" data-placement="bottom" title="delete" href="<?=base_url()?>cp_pages/delete/<?=base64_encode($row->menu_id);?>" onClick="return confirm('Are you sure want to delete this item?')"><i class="fa fa-trash text-danger"></i>  </a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php
                $x++;
                endforeach;
            ?>
        </table>
    </div>           
    </div>
    </div>
    
    <div class="col-sm-7">
    <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">Add new page</h3>
    </div>        
            <!-- form start -->
            <form class="form-horizontal" action="<?=base_url()?>cp_pages/add/" method="POST">
               <div class="box-body">
                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Page name">
                  </div>
                </div>
                   <button type="submit" class="btn btn-info pull-right">Submit</button>
               </div>
            </form> 
             <!-- /.form end -->      
    </div>
    </div>
    <!-- /. div colom end -->
</section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->