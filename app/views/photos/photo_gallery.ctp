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

<script>
$(document).ready(function () {
	$('a#gallery_link').text('Event Gallery');	
	$("a[rel^='prettyPhoto']").prettyPhoto();
	
});


</script>

<style>

ul#thumb_gallery li {
/*	border-style: solid; */
}

ul#thumb_gallery {
	/*height:430px;*/
	margin-bottom:0px;
	padding-left:0px;
}


ul#thumb_gallery a{
		background: #000;
		float: left;
		width:92px;
		height:92px;
		line-height:100px;
		overflow:hidden;
		position:relative;
		vertical-align:top;
		border: double #CCC;
	/*	-moz-border-radius: 5px; /*--CSS3 Rounded Corners--*/
	/*	-khtml-border-radius: 5px; /*--CSS3 Rounded Corners--*/
	/*	-webkit-border-radius: 5px; /*--CSS3 Rounded Corners--*/	
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
		display: inline-block;
		
		float: left;
		width:92px;
		height:92px;
		overflow:visible;
		position:relative;
		z-index:1;
		border-color: #CCC;
		border-style: double;
	/*	-moz-border-radius: 5px; /*--CSS3 Rounded Corners--*/
	/*	-khtml-border-radius: 5px; /*--CSS3 Rounded Corners--*/
	/*	-webkit-border-radius: 5px; /*--CSS3 Rounded Corners--*/	
		margin-bottom: 10px;
		margin-right:0px;
}

ul#thumb_gallery li p.in_box_text{
	font-size:12px;
}
	
ul#thumb_gallery a:hover{

	border-color: #000;
	border-style: double;
/*	-moz-border-radius: 5px; /*--CSS3 Rounded Corners--*/
/*	-khtml-border-radius: 5px; /*--CSS3 Rounded Corners--*/
/*	-webkit-border-radius: 5px; /*--CSS3 Rounded Corners--*/	
	margin-bottom: 10px;
	
	filter: alpha(opacity=100);
	-moz-opacity:1.0;
	-khtml-opacity:1.00;
	opacity: 1.0;

}	 	

ul#thumb_gallery li{
	display: inline-block;
}
	
ul#thumb_gallery p.inner_thumb{
	border-color: #000;
	border-style: double;
	border-width: 1px;	
}

#infscr-loading {
	text-align:center;
}

</style>




<div id="content">		
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

<div class='infinite_navigation'>
		<a id="next" href="/photos/photo_gallery/2?event_id=<?php echo($event_id) ?>">Next</a>

</div>

<script type ="text/javascript" src="/js/scroll.js"></script>


<script>


$('#content').infinitescroll({

	// callback		: function () { console.log('using opts.callback'); },
	navSelector  	: "a#next:last",
	nextSelector 	: "a#next:last",
	itemSelector 	: "#content ul",
	dataType	 	: 'html',
	// behavior		: 'twitter',
	// appendCallback	: false, // USE FOR PREPENDING
	// pathParse     	: function( pathStr, nextPage ){ return pathStr.replace('2', nextPage ); }
}, function(newElements){

	//USE FOR PREPENDING
	// $(newElements).css('background-color','#ffef00');
	// $(this).prepend(newElements);
	//
	//END OF PREPENDING
	
	window.console && console.log('context: ',this);
	window.console && console.log('returned: ', newElements);
	
});

</script>