

  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Category Section
      
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Masters</a></li>
        <li><a href="#">Category</a></li>
        
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         

          <div class="box">
		
            <div class="box-header">
              <h3 class="box-title"><a href="<?php echo base_url();?>Category/addCategory"><button type="button" class="btn btn-block btn-primary">Add Category</button></a></h3>
			    <span style="float:middle; margin-left:190px;"><?php echo $this->session->flashdata('message');?></span>
            </div>
			
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Category Name</th>
                  <th>Category Image</th>
                  <th>Category Detail</th>
                  <th>Action</th>
                  
                </tr>
                </thead>
                <tbody>
               <?php $i=0;foreach($categories as $category){$i++;?>
                <tr>
			
                  <td><?php echo $i;?></td>
                  <td><?php echo $category->category_name;?></td>
                  <td><img height="40px;" width="40px;" src="<?php echo base_url();?>images/articles/<?php echo $category->category_image; ?>"></td>
                  <td><?php echo $category->category_detail;?></td>
                  <td>
				    <div class="btn-group" style="float:righttt;">
					<a class="btn btn-info" href="<?php echo site_url('Category/updateCategory/'.$category->id); ?>"><i class="fa fa-pencil"></i> Edit</a><a class="btn btn-danger" href="<?php echo site_url('Category/deleteCategory/'.$category->id); ?>" onclick="return areyousure();"><i class="fa fa-trash-o"></i> Delete</a>
					</div>
				  </td>
				 
                  
                </tr>
				<?php }?>
				
               
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 

 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->


<!-- DataTables -->
<script src="<?php echo base_url();?>assets/admin/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->


<script>
 
 
  
  function areyousure(){
	return confirm('Are you sure you want to delete?');
}
</script>

<script>
	$(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>

