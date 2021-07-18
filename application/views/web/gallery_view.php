 <section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						
						
						
						<div class="panel-group category-products" id="myDIV">
						
							
							
						<?php $color='';foreach($categories as $row) {
								if($this->uri->segment(3)==$row->id) {

								$color="#e94925";
								}
								else {
								$color="black";
								}

							?>
							<div class="panel panel-default">
								<div class="panel-heading" >
									<a href="<?php echo base_url();?>Home/view_gallery/<?php echo $row->id;?>"><h4 style="color:<?php echo $color;?>" class="panel-title anchor color_default " ><?php echo $row->category_name;?></h4></a>
								</div>
							</div>
						<?php } ?>
							
						
						</div>
					
						
						
					
					</div>
				</div>
				
				
				
				<div class="col-sm-9 padding-right append_div">
					
					<h2 class="title text-center" id="cat_name"><?php echo $cat_row->category_name;?></h2>
					<div class="features_items article_list">
						<?php foreach($articles as $value) {
							
							
							?>
						 <div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
										  
											<a href="<?php echo base_url();?>Home/article_details/<?php echo $value->category_id;?>/<?php echo $value->id;?>" ><img src="<?php echo base_url();?>images/articles/<?php echo $value->article_image;?>" alt="" /></a>
										</div>
										
								</div>
							</div>
						</div>
						<?php } ?>
						
				
						
					</div>
					
					
					
				</div>
				
				
				
			</div>
		</div>
	</section>
	<br/><br/><br/><br/><br/>
	
	