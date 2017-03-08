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
<?php if ($error): ?>
<div class="alert alert-danger" id="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <?=$message?>
</div>
<?php endif;?>
    <!-- /. ALERT -->
    
    
    <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Add new Post</h3>
    </div>        
            <!-- form start -->
            <form class="form-horizontal" action="<?=base_url()?>cp_post/submit/" method="POST" enctype='multipart/form-data'>
               <div class="box-body">
                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">Post Title</label>
                  <div class="col-sm-10">
                    <input type="text" name="title" value="<?=set_value('title')?>" class="form-control" id="name" placeholder="Post title">
                    <span class="text-danger"><?=form_error('title')?></span>
                  </div>
                </div>
                   <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">Image</label>
                  <div class="col-sm-10">
                    <input type="file" name="img" value="wtf" class="form-control" id="img" accept="image/*">
                  </div>
                </div>
                <div class="form-group">
                  <label for="page" class="col-sm-2 control-label">Content</label>
                  <div class="col-sm-10">
                      <textarea class="form-control" name="content" id="desc" rows="15">
                        <?=set_value('content')?>
                      </textarea>
                      <span class="text-danger"><?=form_error('content')?></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="page" class="col-sm-2 control-label">Page Included</label>
                  <div class="col-sm-10">
                      <select name="page" class="form-control">
                          <?php                      foreach ($dropdown as $row): ?>
                          <option value="<?=$row->menu_id?>"><?=$row->name?></option>
                          <?php                          endforeach;?>
                      </select>
                  </div>
                </div>
                   <div class="form-group">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <button type="submit" value="draft" name="submit" class="btn btn-info">Save to draft</button>
                   <button type="submit" value="publish" name="submit" class="btn btn-primary">Publish</button>
                    </div></div>
               </div>
            </form> 
             <!-- /.form end -->      
    </div>
   
</section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->