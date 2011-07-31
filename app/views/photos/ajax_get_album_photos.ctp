<?php
/**
 * file: app/views/photos/ajax_get_album_photos
 *
 * AJAX view to display photos from an external album
 */
//echo('<pre>');
//print_r($this->viewVars);
//echo('</pre>');
?>
<style>



ul#new_album_gallery a{
		display:inline-block;
		float:left;
		width:96px;
		height:96px;
		line-height:100px;
		overflow:hidden;
		position:relative;
		z-index:1;
		vertical-align:top;
		
		border-color: #999;
		border-style: solid;
		border-width: 2px;
		-moz-border-radius: 5px; /*--CSS3 Rounded Corners--*/
		-khtml-border-radius: 5px; /*--CSS3 Rounded Corners--*/
		-webkit-border-radius: 5px; /*--CSS3 Rounded Corners--*/	
		margin-bottom: 10px;

	
	}
ul#new_album_gallery p{
	float-top:auto;
	float-bottom:auto;
}
	
	
	
}	
ul#new_album_gallery a img{
		float:left;
		position:absolute;
		top:0px;
		left:0px;
	
	}
	


</style>

	


<div>	
	<ul id="new_album_gallery">
		<div class="grid_10">
		<?php
			$limit=0;
			$album_size=count($photos["data"]);	
		?>
		
		<?php foreach($photos["data"] as $photo) : ?> 
			
			<?php if ($limit==4) :?> 	
					<div class="clear"></div>
					<p>... plus <?php echo($album_size-$limit) ?> more</p>
				<?php break; ?>
			<?php else: ?>
				<div class='grid_2'>
					<a><img src ='<?php echo($photo['picture']) ?>' alt='' / ></a>
					<?php $limit++; ?>
				</div>	
	
			<?php endif?>
		
		<?php endforeach?>
	</ul>

</div>
   