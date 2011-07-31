<?php
/**
 * file: app/views/photos/index.ctp
 *
 * Photos List Page View
 */
echo('<pre>');
print_r($photos);
echo('</pre>');
?>
<?php
// BEGIN ATTENDEE ADD & FACEBOOK

	//IS THE USER LOGGED INTO FACEBOOK?
	require $_SERVER['DOCUMENT_ROOT'].'files/config.php';           
   
?>

<div>
    <h2>Photos Pagination</h2>
    <p>Displaying pagination Photos in the database</p>
    
    <?php
    if(isset($photos) && !empty($photos)) :
    ?>
    <div id="pagination"> 
	<?php 
	      echo $paginator->prev();  
	      echo $paginator->numbers(array('separator'=>' - '));  
	      echo $paginator->next(); 
	?> 
	</div>
     <div id="Gallery">
         <table>
             <thead>
                 <tr>
                     <th>Photo</th>
                     <th>Attendee</th>
					 <th>Privacy setting</th>
					 <th>Facebook link</th>
					 <th>Mooch this</th>
                 </tr>
             </thead>

             <tbody>    
                    <?php  foreach($photos as $photo): ?>
                    <?php if (!empty($photo['Photo']['source_url'])): ?> 
				<tr>
                 <td><?php
				// Photo

				if ($photo['Photo']['privacy'] === '0')
				{
					echo("<a href = ".$photo['Photo']['source_url']."><img src =".$photo['Photo']['thumb_url']." alt='' / ></a>");
				} elseif ($photo['Photo']['privacy'] === '1')
				{
					if(!empty($friend_list))
					{
						if(in_array($photo['Photo']['Attendee']['external_id'], $friend_ids))
						{
							echo("<a href = ".$photo['Photo']['source_url']."><img src =".$photo['Photo']['thumb_url']." alt='' / ></a>");	
						} elseif ($photo['Attendee']['external_id'] === $me['id'])
						{
					   		echo("<a href = ".$photo['Photo']['source_url']."><img src =".$photo['Photo']['thumb_url']." alt='' / ></a>");	
						}
						else {
							echo("Private photo");
						}
					 } else {
						echo("Connect with Facebook");
					   }
					}

					
				?>		</td>
                        
				<td>
			<?php
			// Attendee name
			 echo($attendee_list[$photo['attendee_id']]);?>
			</td>
			
			<td>
			<?php
			// Privacy setting
			if(!empty($friend_list))
			{
				if ($photo['privacy'] === '0')
				{
					echo("Visible to all viewers");
				} elseif ($photo['privacy'] === '1')
				{
					echo("Visible to Facebook friends of ".$attendee_list[$photo['attendee_id']]);
				}
			} else {
				echo("Visible to Facebook friends of ".$attendee_list[$photo['attendee_id']]);
			}
			?>
			
			<td><?php
			// Link to Facebook
			echo $html->link('View photo on Facebook', $photo['external_photo_link'],array('target' => '_blank'));?>
			</td>
          	
			<td><?php
			// Mooch button
			echo $form->create('Photo', array('action'=>'get_album'));
			echo $form->end('Mooch');
			?>
		</tr>
		<?php endif;?>
                 <?php endforeach; ?>
             </tbody>
         </table>

     </div>
	<?php endif;?>
</div>