 <section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<div class="panel-group category-products" id="myDIV"><!--category-->
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
				
				<div class="col-sm-9 padding-right">
					<div class="product-details">
						<div class="col-sm-5">
							<div class="view-product">
								<img src="<?php echo base_url();?>images/articles/<?php echo $detail->article_image; ?>" alt="">
							</div>
					</div>
						<div class="col-sm-7">
							<div class="product-information">
							    
								<span style="margin-left:80%"><a href="<?php echo base_url();?>Home/view_gallery/<?php echo $detail->category_id;?>" >Back</a></span>
								<h2><?php echo $detail->article_title;?></h2>
								
								<p><?php echo $detail->article_details;?></p>
								
							</div>
						</div>
					</div>
				</div>
				
				
			</div>
		</div>
	</section>
	<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
	