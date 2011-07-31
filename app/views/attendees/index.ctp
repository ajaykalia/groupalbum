<?php
/**
 * file: app/views/attendees/index.ctp
 *
 * Attendees Index
 */

//echo('<pre>');
//print_r($this); 
//echo('</pre>'>
?>

 <div>
     <h2>Attendees Index</h2>
     <p>Displaying all Attendees in the database</p>
              
     <?php
     if(isset($attendees) && !empty($attendees)) :
     ?>
     
     <table>
         <thead>
             <tr>
                 <th>Id</th>
                 <th>Name</th>
                 <th>Event</th>
                 <th>Created</th>
                 <th>Modified</th>
                 <th>View</th>
             </tr>
         </thead>        
 
        <?php
          
          foreach($attendees as $attendee) :
            
        ?>
            <tr>
                <td><?php echo $attendee['Attendee']['id']; ?> </td>
                <td><?php echo $attendee['Attendee']['name']; ?> </td>
                <td><?php echo $attendee['Event']['name']; ?> </td>                
                <td><?php echo $attendee['Attendee']['created']; ?> </td>                
                <td><?php echo $attendee['Attendee']['modified']; ?> </td>
                <td><?php echo $html->link('View', '/attendees/view/'.$attendee['Attendee']['id']);?></td>
            </tr>
        <?php
            endforeach;
        ?>
        </tbody>
    </table>
        
        <?php
        else:
            echo 'There are no Attendees';
        endif;
        ?>        

 </div>
