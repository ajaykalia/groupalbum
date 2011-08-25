<?php
/**
 * file: app/views/photos/display_albums.ctp
 *
 * Photos Display Albums View
 */

?>

<script type="text/javascript" src="/js/display_albums.js"></script>

<style>
.add_steps {
	font-size: 2em;
	margin-top: 0px;
}

#visibility_options_box {
	background: #99CCFF;
	height: 100px;
	margin-top: 10px;
	margin-bottom:10px;
}

.visibility_radio {
	height:40px;
	vertical-align:middle;
}

.box_sub_text {
	margin-bottom: 20px;
	margin-left: 20px;
	margin-top: 0px;
	
}

p.box_header_text {
	font-size: 1.25em;
	color: #666666;
	margin-top: 10px;
	margin-bottom: 5px;
}

p.page_instructions {
	font-size: 1.5em;
	color: #000;
	margin-left: 0px;
	border-bottom: solid 1px #CCC;
}

.finished {
	text-decoration: line-through;
}

ul.album_rows {
	padding: 0px;
	margin: 0px;
	list-style-type: none;
	
}
li.album_row {
	margin-left:0px;
	border-top: 1px solid #CCC;
/*	border-bottom: 1px solid #CCC; */
	padding-left:0px;
	padding-top: 10px;
	padding-bottom: 0px;
	height: 110px;
	}
}

span.album_row_anchor:hover {
	border:1px solid #000;
}


p.album_name {
	font-size:1em;
	font-weight:bold;
	margin-bottom: 0px;
}

p.album_count {
	font-size:1em;
	margin-top:0px;
	
}

div.submit input {
	height:45px;
	width: 125px;
	background: #FF6666;
	border: 1px solid #CCC;
	font-size: 1.25em;
	margin-top: 15px;
	font-weight: 100;
	color: #CCC;
}

div.submit input:hover {
	background: #FF0000;
}

a.album_image_anchor {
		background: #000;
		float: left;
		width:100px;
		height:100px;
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
}

.album_image_image {
	float:left;
	position:absolute;
	top:0px;
	left:0px;
}


</style>

	

	<div>
		<div class = "grid_13">
			<p class="page_instructions">Add an album to the Stack</p>
		</div>
	    <?php if ($me): ?>
		
		<div class="clear"></div>
		
		<div class= "grid_1 add_steps">1</div>
		<div class="grid_11">
			<p class="box_header_text <?php if($me) echo('finished') ?>" ?>Connect to a photo service</p>

			<p class="box_sub_text">You are currently logged into Facebook as <strong><?php print_r($me['name']); ?></strong></p>
		
		<!-- Form create -->
		<?php echo $form->create('Event', array('action'=>'ajax_add_album')); ?>
		</div>
		
		<div class="clear"></div>
		
		<div id="visibility_options_box">
			<div class="grid_1 add_steps">2</div>
			<div class="grid_11 visibility_radio">
				<p class="box_header_text">Choose your visibility settings</p>

				<p class="box_sub_text">
				<input type="radio" name="data[Event][privacy]" id="EventPrivacy0" value="0">
				<label for="EventPrivacy0">Share these photos with everyone</label>
			
				<br />
			
				<input type="radio" name="data[Event][privacy]" id="EventPrivacy1" value="1" checked="checked">
				<label for="EventPrivacy1">Only visible to Facebook friends</label></fieldset></div>
				</p>
			</div>
		</div>
		<div class="clear"></div>
		
		
		<div class= "grid_1 add_steps">3</div>
		<div id = "album_list" class="grid_11">
			<p class="box_header_text">Add your album</p>
		
		<ul class="album_rows grid_12">
		<?php foreach($album_list as $album) :?>
			<div class="clear"></div>
			<li class="album_row">
				<div class="grid_2 album_image">
				
					<a class = "album_image_anchor">
						<img src="<?php echo($album['album_photo']) ?>" class="album_image_image"/>
					</a>
					
				</div>
				<div class="grid_7">
					<p class="album_name"><?php echo($album['name']) ?></p>
					<p class="album_count"><?php echo($album["pic_count"])?> photo<?php if ($album["pic_count"] != 1) {echo('s');} ?></p>
				</div>
				
				<div class="grid_2">
				<?php
					
				// info to pass along
				echo $form->input('event_id',
		           			array('label'=>'event_id', 'type'=>'hidden', 'value'=>$eid));			
				echo $form->input('external_user_id', array('label'=>'name', 'value'=>$me['id'], 'type'=>'hidden'));
				echo $form->input('fb_session_token', array('label'=>'fb_session_token', 'value' => $session['access_token'], 'type'=>'hidden'));
				echo $form->input('attendee_name', array('label'=>'attendee_name', 'type'=>'hidden', 'value'=>$me['name']));
				echo $form->input('external_id', array('label'=>'external_album_id', 'type'=>'hidden', 'value'=>$album['external_id']));
				?>
				
				<?php echo $form->end('Add to Stack');?>
			</div>
				
			</li>
		<?php endforeach?>
		</ul>
		</div>
		
		</div>
	
	<?php else: ?>
    	<div>
      		Start by connecting your Facebook account:
			<fb:login-button perms="publish_stream, user_photos"></fb:login-button>
    	</div>
  	<?php endif ?>
 