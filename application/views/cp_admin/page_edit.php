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
    <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Page</h3>
    </div>        
            <!-- form start -->
            <form class="form-horizontal" action="<?=base_url()?>cp_pages/update/" method="POST">
                <input type="hidden" name="submit" value="update"/>
                <input type="hidden" name="id" value="<?=$id?>"/>
               <div class="box-body">
                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Page name" value="<?=$konten->name;?>">
                  </div>
                </div>
                   <button type="submit" class="btn btn-info pull-right">Submit</button>
               </div>
            </form> 
             <!-- /.form end -->      
    </div>
    <!-- /. div colom end -->
</section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->