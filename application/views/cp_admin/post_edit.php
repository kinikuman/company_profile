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
            <form class="form-horizontal" action="<?=base_url()?>cp_post/submit_update/" method="POST" enctype='multipart/form-data'>
                <input type="hidden" name="id" value="<?=$id?>"/>
                <input type="hidden" name="img_src" value="<?=$konten->img?>"/>
                <input type="hidden" name="status" value="<?=$konten->status?>"/>
               <div class="box-body">
                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">Post Title</label>
                  <div class="col-sm-10">
                    <input type="text" name="title" value="<?=set_value('title',$konten->title)?>" class="form-control" id="name" placeholder="Post title">
                    <span class="text-danger"><?=form_error('title')?></span>
                  </div>
                </div>
                
                <?php if ($konten->img!='0'):?>
                <div class="form-group">
                  <div class="col-sm-2"></div>
                  <div class="col-sm-10">
                    <img src="<?=base_url().'assets/uploads/'.$konten->img?>" style="max-width: 500px;"class="img-responsive"/><br/>
                    <a href="<?=base_url().'cp_post/delete_img/'.$id.'/'.base64_encode($konten->img)?>" onClick="return confirm('Are you sure?');"class="btn btn-danger">Delete image</a>
                  </div>
                </div>
                   <?php endif;?>
                   
                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">Change Image</label>
                  <div class="col-sm-10">
                    <input type="file" name="img" value="wtf" class="form-control" id="img" accept="image/*"><br/>
                  </div>
                </div>   
                
                <div class="form-group">
                  <label for="page" class="col-sm-2 control-label">Content</label>
                  <div class="col-sm-10">
                      <textarea class="form-control" name="content" id="desc" rows="15">
                        <?=set_value('content',$konten->content)?>
                      </textarea>
                      <span class="text-danger"><?=form_error('content')?></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="page" class="col-sm-2 control-label">Page Included</label>
                  <div class="col-sm-10">
                      <select name="page" class="form-control">
                          <?php                      foreach ($dropdown as $row): ?>
                          <option 
                              <?php if ($row->menu_id==$konten->menu_id)$selected=TRUE; else $selected=FALSE; ?>
                              value="<?=$row->menu_id?>"
                                    <?=set_select('page',$row->menu_id,$selected)?>
                              
                              >
                              <?=$row->name?>
                          </option>
                          <?php                          endforeach;?>
                      </select>
                  </div>
                </div>
                   <div class="form-group">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <a href="<?=base_url().'cp_post/update/'.$id?>" class="btn btn-danger">Reset</a>
                      <button type="submit" value="draft" name="submit" class="btn btn-info">Save to draft</button>
                      <button type="submit" value="publish" name="submit" class="btn btn-primary">Publish</button>
                    </div></div>
               </div>
            </form> 
             <!-- /.form end -->      
    </div>
    <!-- /. div colom end -->
</section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->