<?php
/**
 * file: app/views/photos/photo_gallery.ctp
 *
 * Photos Gallery Page View
 */

//echo('<pre>');
//print_r($loginUrl);
//print_r($photos);
//echo('</pre>');
?>
<?php
	// Create an array of attendee names and attendee ids for the table
	$friend_ids = array();
	
	if(!empty($friend_list)) {	
		foreach($friend_list['data'] as $friend) {
			$friend_ids[] = $friend['id'];
		}
	}

?>



<script type="text/javascript" charset="utf-8">
  $(document).ready(function(){
    $(function(){ $("#thumb_gallery").pagination(); });
	$("a[rel^='prettyPhoto']").prettyPhoto();
  });
</script>


<style>

ul#thumb_gallery {
	height:333px;
}


ul#thumb_gallery a{
		display:inline-block; 
		float: left;
		width:92px;
		height:92px;
		line-height:100px;
		overflow:hidden;
		position:relative;
		z-index:1;
		vertical-align:top;
		border-color: #000;
		border-style: solid;
		border-width: 2px;
		-moz-border-radius: 5px; /*--CSS3 Rounded Corners--*/
		-khtml-border-radius: 5px; /*--CSS3 Rounded Corners--*/
		-webkit-border-radius: 5px; /*--CSS3 Rounded Corners--*/	
		margin-bottom: 10px;
		margin-right:0px;
		filter: alpha(opacity=75);
		-moz-opacity:0.75;
		-khtml-opacity:0.75;
		opacity: 0.75;
	
	}
ul#thumb_gallery a img{
		float:left;
		position:absolute;
		top:0px;
		left:0px;	
	}
	
ul#thumb_gallery li p{
		display:inline-block; 
		float: left;
		width:92px;
		height:92px;
		overflow:visible;
		position:relative;
		z-index:1;
		
		border-color: #999;
		border-style: solid;
		border-width: 2px;
		-moz-border-radius: 5px; /*--CSS3 Rounded Corners--*/
		-khtml-border-radius: 5px; /*--CSS3 Rounded Corners--*/
		-webkit-border-radius: 5px; /*--CSS3 Rounded Corners--*/	
		margin-bottom: 10px;
		margin-right:0px;
}

ul#thumb_gallery li p.in_box_text{
	font-size:12px;
}
	
ul#thumb_gallery a:hover{

	border-color: #000;
	border-style: solid;
	border-width: 2px;
	-moz-border-radius: 5px; /*--CSS3 Rounded Corners--*/
	-khtml-border-radius: 5px; /*--CSS3 Rounded Corners--*/
	-webkit-border-radius: 5px; /*--CSS3 Rounded Corners--*/	
	margin-bottom: 10px;
	
	filter: alpha(opacity=100);
	-moz-opacity:1.0;
	-khtml-opacity:1.00;
	opacity: 1.0;

}	 	

ul#thumb_gallery li{
		display: inline-block; 
}

div.paginator {
	margin-left:auto;
	margin-right:auto;
	text-align:center;
}
div.paginator.top a.active{
	color: #FFF; /* same color as the surrounding text */
  	text-decoration: none; /* to remove the underline */
  	cursor: text;
	
}

div.paginator.bottom a.inactive{
	color: #FFF; /* same color as the surrounding text */
  	text-decoration: none; /* to remove the underline */
  	cursor: text;
	
}

		

</style>




<div>		
		<ul id='thumb_gallery'>
			
<!-- Begin loop through photos -->
			<?php foreach($photos as $photo) :?>

<!-- Begin ensure photo has a source URL -->					
				<?php if (!empty($photo['Photo']['source_url'])) : ?>
					
<!-- Print thumbnail of public photos -->
					<?php if ($photo['Photo']['privacy'] === '0') : ?>

					<li>
						<a href = '<?php echo($photo['Photo']['source_url']) ?>' rel='prettyPhoto[event_gallery]' title='Contributed by <?php echo($photo['Attendee']['name']) ?>' target='<?php echo ($photo['Photo']['external_photo_link']) ?>'>
							<img src ='<?php echo ($photo['Photo']['thumb_url']) ?>' alt='' / >	 
			 			</a>	
					</li>
<!-- End thumbnail of public photo -->

<!-- Print thumbnail of private photo -->					
					<?php elseif ($photo['Photo']['privacy'] === '1'): ?>
					
<!-- Begin ensure user has Facebook friends and is logged into Facebook -->	
						<?php if(!empty($friend_ids)) :?>
							
<!-- Begin print thumbnail if uploaded photo came from Friend or from User  -->	
							<?php if( (in_array($photo['Attendee']['external_id'], $friend_ids)) || $photo['Attendee']['external_id'] === $me['id']) :?>
								
									<li>
										<a href ='<?php echo($photo['Photo']['source_url']) ?>' rel='prettyPhoto[event_gallery]' title='Contributed by <?php echo($photo['Attendee']['name']) ?>' target='<?php echo($photo['Photo']['external_photo_link']) ?>'>
											<img src = <?php echo($photo['Photo']['thumb_url']) ?> alt='' / >
											</a>
									</li> 
<!-- Continue print thumbnail if uploaded photo came from Friend or from User; if that condition fails, print out uploader -->	
							<?php else : ?>
									<li>
										<p>Visible to friends of <?php echo($photo['Attendee']['name']) ?></p>
									</li>
							
<!-- End print thumbnail if uploaded photo came from Friend or from User -->	
							<?php endif ?>

<!-- Continue ensure user has Facebook friends and is logged into Facebook; in this case, user is not logged into Facebook (or does not have Friends *corner case) -->	
						 <?php else : ?>
						 	<li>
								<p class="in_box_text">Locked by <?php echo($photo['Attendee']['name']) ?>. Please log in to Facebook.</p>
							</li>
<!-- End ensure user has Facebook friends and is logged into Facebook --> 
						<?php endif ?>
						
<!-- End thumbnail printing cases -->	
					<?php endif ?>					

<!-- Begin ensure photo has a source URL -->					
				<?php endif ?>

<!-- End loop through photos -->
			<?php endforeach ?>
			
		</ul>
</div>