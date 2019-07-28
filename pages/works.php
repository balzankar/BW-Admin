<?php 
$page_title='Works';
include_once('includes/load.php');  
page_require_level(2);
$all_works = find_all_desc('works');
?>
<?php include_once('common/header.php'); ?>
      <!-- End Navbar -->
      <div class="content">
       <?php echo display_msg($msg); ?>
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title d-inline">Works</h4>
              </div>
              <div class="card-body table-responsive">
                  <table class="table table-striped tablesorter" id="datatable">
                    <thead class=" text-primary">
                      <tr>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th>Works</th>
                        <th>Developer</th>
                        <th>Category</th>
                        <th class="text-center">Time Stamp</th>
                        <th class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody>                    
                     <?php foreach($all_works as $a_work): ?>
                      <tr>
                       <td class="text-center"><?php echo count_id();?></td>
                       <td><?php echo remove_junk(ucwords($a_work['title']))?><br><span class="text-info"><?php echo remove_junk(ucwords($a_work['author']))?></span></td>
                       <td><?php echo remove_junk(ucwords($a_work['developer']))?></td>
                       <td><?php echo $a_work['category'];?><br><span class="text-info"><?php echo remove_junk(ucwords($a_work['display_category']))?></span></td>
                       <td class="text-center"><?php echo remove_junk($a_work['date'])?></td>
                       <td class="text-center">                    
                        <a href="works_edit.php?id=<?php echo (int)$a_work['id'];?>">
                            <button class="btn btn-icon btn-primary btn-round"><i class="fa fa-edit"></i></button>
                        </a> 
                        <a href="../../work.php?id=<?php echo (int)$a_work['id'];?>" target="_blank">
                            <button class="btn btn-icon btn-primary btn-round"><i class="fa fa-eye"></i></button>
                        </a>  
                       </td>
                      </tr>
                     <?php endforeach;?>
                    </tbody>
                  </table>                
                </div>
              <div class="card-footer">
                  <a href="works_add.php"><button type="submit" class="btn btn-fill btn-primary">Add Work</button></a>
              </div>
            </div>
          </div>
         <?php include_once('profile.php');?>                 
        </div>
      </div>
<?php include_once('common/footer.php'); ?>