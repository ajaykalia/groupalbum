<?php
/**
 * file: app/views/events/index.ctp
 *
 * Events Index View
 */
 ?>
 <div>
     <h2>Weddings Index</h2>
     <p>Displaying all Weddings in the database</p>
     
     <?php
     if(isset($events) && !empty($events)) :
     ?>
     
     <table>
         <thead>
             <tr>
                 <th>Id</th>
                 <th>Name</th>
                 <th>Photo Gallery</th>
                 <th>Attendees</th>
                 <th>Created</th>
                 <th>Modified</th>
             </tr>
         </thead>        
 
        <?php
          
          foreach($events as $event) :
            
        ?>
            <tr>
                <td><?php echo $event['Event']['id']; ?> </td>
                <td><?php echo $event['Event']['name']; ?> </td>
                <td><?php echo $html->link('View Gallery', '/events/gallery/'.$event['Event']['slug']);?></td> 
                <td><?php echo $html->link('View Wedding', '/events/view/'.$event['Event']['slug']);?></td>              
                <td><?php echo $event['Event']['created']; ?> </td>                
                <td><?php echo $event['Event']['modified']; ?> </td>
                
            </tr>
        <?php
            endforeach;
        ?>
        </tbody>
    </table>
        
        <?php
        else:
            echo 'There are no Events';
        endif;
        ?>        

 </div>
 