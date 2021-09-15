



<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/a17a6a2519.js" crossorigin="anonymous"></script>
<style type="text/css">
<?php	include( WPBAW_DIR . '/public/css/admin.css');?>
</style>
<!------ Include the above in your HEAD tag ---------->
<div class="tabs">
	<div class="tab-button-outer">
		<ul id="tab-button">
			<li><a href="#tab01">Translation</a></li>
			<!-- <li><a href="#tab02">Images</a></li> -->
			<li><a href="#tab03">Videos</a></li>
		</ul>
	</div>
	<div class="tab-select-outer">
		<select id="tab-select">
			<option value="#tab01">Translation</option>
			<!-- <option value="#tab02">Images</option> -->
			<option value="#tab03">Videos</option>
		</select>
	</div>
	<div class="d-none admin_url" value="<?php echo admin_url('admin-ajax.php'); ?>"></div>
	<div class="d-none post_id" value="<?php echo get_the_ID(); ?>"></div>
	
	<div id="tab01" class="tab-contents">
		<div class="container">
			<table class="table table-striped">
				<thead>
					<tr>
						<th class="text-center">US Phrases <img height="25" width="25" src="<?= get_site_url().IMAGES.'/usa.png' ?>"></th>
						<th class="text-center">UK Phrases <img height="25" width="25" src="<?= get_site_url().IMAGES.'/uk.png' ?>"></th>
					</tr>
				</thead>
				<tbody class="append">
					<div class="page_id d-none" ><?php echo $page;?></div>
					<div class="count d-none"><?php echo $check;?></div>
<!--  -->
					<?php if($check== 0)
					{   ?>
						<tr id="R1">
							<td>
								<div class="ml-2 mb-2 d-flex">
									<span class="strong"> </span>
									<input type="text" class="form-control" name="us[]">
								</div>
								<p style=" margin-top: -29px;"> 1. </p>
							</td>
							<td>
								<div class="mb-2 d-flex">
									<input type="text" class="form-control mr-2" name="uk[]">
								</div>
							</td>
						</tr>
						<!--  -->
					<?php
					}
					else
					{
						for ($i=0; $i < $check; $i++)
						{   ?>

							<tr id="R<?php echo $i+1;?>">
								<td>
									<div class="ml-2 mb-2 d-flex">
										<span class="strong"></span>
										<input type="text" class="form-control" name="us[]" value="<?php echo $us[0][$i] ?>">
									</div>
									<p style=" margin-top: -29px;"><?php echo $i+1;?>.</p>
								</td>
								<td>
									<div class="mb-2 d-flex">
										<input type="text" class="form-control mr-2" name="uk[]" value="<?php echo $uk[0][$i] ?>">
										<a href="javascript:void(0)" class="btn btn-sm btn-danger delete">&times;</a>
									</div>
								</td>
							</tr>
						<?php
						}
					}
					?>
				</tbody>
				<tfoot>
				<tr>
					<td class="text-center">
						<button class="btn btn-sm button-primary font add"><i class="fas fa-plus"></i> Add Phrase</button>
					</td>
					<td class="text-center">
						<button onclick="$('#post').submit();" class="btn btn-sm font button-primary">Save List <i class="fas fa-check"></i></button>
					</td>
				</tr>
				</tfoot>
			</table>
		</div>
	</div>
	<!-- <div id="tab02" class="tab-contents ">
			fgsdkfgjdkfk							-----------
	</div> -->
	<div id="tab03" class="tab-contents">
		<div class="container">
			<table class="table table-striped deletes-record">
				<thead>
					<tr>
						<th class="text-center"><strong style="color: coral;padding: 8px 10px;"> DEFAULT</strong></th>
						<th class="text-center"><strong style="color: coral;padding: 8px 10px;"> LEFT HANDED</strong></th>
						<?php if($vcheck!=0) { ?>
							<th class="text-center"><strong style="color: coral;padding: 8px 10px;"> SHORTCODE</strong></th>
						<?php } ?>
						
					</tr>
				</thead>
				<tbody class="vappend">

					<div class="vcount d-none"><?php echo $vcheck;?></div>
				<?php
					if($vcheck== 0)
					{ ?>
						 <td>
							
							<div class="mb-2 d-flex">
								<span class="strong">1.</span>
								<div class="custom-file">
									<input type="file" class="hide_file	form-control" title="Choose File" name="default_video[]" accept=" video/*">
								</div>
							</div>
						</td>
						<td>
							<div class="mb-2 d-flex">
								<div class="custom-file">
									<input type="file" class="hide_file form-control" title="Choose File" name="left_handed_video[]" accept=" video/*">
								</div>
							</div>
						</td> 
				<?php }
				
				    
					else

					{ for ($i=0; $i <$vcheck; $i++)
						{  
							?>
							<tr id="V<?php echo $i+1;?>">
								<td style="display: flex;">
									<span class="strong"><?php echo $i+1;?>.</span>
									<div class="mb-2 d-flex">
										<video class="video_data" controls>
											<source src="<?php echo $default_video[$i]; ?>" type="video/mp4" >
										</video>

									</div>

								</td>
								<td>
									<div class="mb-2 d-flex">
										<video class="video_data" controls>
											<source src="<?php echo $left_handed_video[$i]; ?>" type="video/mp4">
										</video>
									</div>
								</td>
								<td style="vertical-align: inherit;">
									<div class="mb-2 d-flex">								
											<button value="<?php echo "[default width='260' height='200' videoid=".$i."]" ?>"  class="btn btn-sm btn-primary" onclick="copy(event)">Copy to clipboard</button>&nbsp;

											<a href="javascript:void(0)" class="btn btn-sm btn-danger deletes" data-id="<?php echo $i;?>">&times;</a>
									</div>
								</td>
							</tr>

					   <?php } 
					   }	?>
           
				</tbody>
				<tfoot>
					<tr>
						<td  class="text-center">
							<button class="btn btn-sm button-primary font video"><i class="fas fa-plus"></i> Add Video</button>
						</td>
						<td class="text-center">

							<button id="save_videos" class="btn btn-sm button-primary font"> Save <i class="fas fa-check"></i></button>
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	function copy(e) {
     e.preventDefault();
     copyToClipboard(e.target.value);
   }

   function copyToClipboard(text) {
    var dummy = document.createElement("textarea");
    document.body.appendChild(dummy);
    dummy.value = text;
    dummy.select();
    document.execCommand("copy");
    document.body.removeChild(dummy);
}

	
<?php include( WPBAW_DIR . '/public/js/jquery.min.js');?>
<?php include( WPBAW_DIR . '/public/js/admin.js');?>
</script>
<!--  -->

