<?php
/**
 * file: app/views/photos/index.ctp
 *
 * Photos Index View
 */
//echo('<pre>');
//print_r($photos);
//echo('</pre>');
?>
<div>
    <h2>Photos Index</h2>
    <p>Displaying all Photos in the database</p>
    
    <?php
    if(isset($photos) && !empty($photos)) :
    ?>
    
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Attendee</th>
                <th>Wedding</th>
                <th>View</th>
            </tr>
        </thead>        

       <?php
         
         foreach($photos as $photo) :
           
       ?>
           <tr>
               <td><?php echo $photo['Photo']['id']; ?> </td>
               <td><?php echo $photo['Attendee']['name']; ?> </td>
               <td><?php echo $photo['Event']['name']; ?> </td>                
               <td><?php echo $html->link('View', $photo['Photo']['url']);?></td>
           </tr>
       <?php
           endforeach;
       ?>
       </tbody>
   </table>
       
       <?php
       else:
           echo 'There are no Photos';
       endif;
       ?>
</div>