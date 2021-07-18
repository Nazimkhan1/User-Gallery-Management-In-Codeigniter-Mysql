	
<section>
		<div class="container">
			<div class="row">
	<div class="col-sm-3 " id="left_side">
					<div class="left-sidebar header ">
						
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
						
						<?php foreach($categories as $catValue){?>
						
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#sportswear_<?php echo $catValue->cat_id;?>" onclick="getSubCategory('<?php echo $catValue->cat_id;?>');">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											<?php echo $catValue->cat_name;?>
										</a>
									</h4>
								</div>
								<div id="sportswear_<?php echo $catValue->cat_id;?>"" class="panel-collapse collapse" style="margin-top: -20px;">
									<div class="panel-body">
										<ul id="test_<?php echo $catValue->cat_id;?>">
											
										</ul>
									</div>
								</div>
							</div>
						<?php } ?>
							<!--<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#mens">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											MYSQL
										</a>
									</h4>
								</div>
								<div id="mens" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
											<li><a href="#">introduction</a></li>
											<li><a href="#">select</a></li>
											<li><a href="#">insert</a></li>
											<li><a href="#">delete</a></li>
											<li><a href="#">update</a></li>
											<li><a href="#">truncate</a></li>
											<li><a href="#">join</a></li>
											<li><a href="#">find_in_set</a></li>
											<li><a href="#">in</a></li>
											
										</ul>
									</div>
								</div>
							</div>
							
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#womens">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											JAVASCRIPT
										</a>
									</h4>
								</div>
								<div id="womens" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
											<li><a href="#">introduction</a></li>
											<li><a href="#">varaiable</a></li>
											<li><a href="#">function</a></li>
											
										</ul>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Codeigniter Crude</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Laravel Crude with mysql</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Core Php Crude with mysql</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Angular Crude with mysql</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Nodejs Crude with mysql</a></h4>
								</div>
							</div>-->
							
						</div><!--/category-products-->
					
						
					
					</div>
				</div>