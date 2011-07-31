<?php
/**
 * file: app/views/attendees/view.ctp
 *
 * Attendees View View
 */
echo('<pre>');
print_r($id);
echo('</pre>');

?>  

<div>
    <h2>Attendee Information</h2>
        
    <dl>
    	<dt>Attendee:</dt>
        <dd><?php echo $id['Attendee']['name']; ?></dd>
        
    </dl>
     
        <?php if(!empty($id['Event'])): ?>
        
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Wedding Gallery</th>
                    </tr>
                </thead>
                
<!-- List weddings; will need to loop through Events when switch to HABTM -->               
                <tbody>    
                        <?php $event_name = $id['Event']['name']; ?>
                        <?php $event_slug = $id['Event']['slug']; ?>
                        
                        <?php  foreach($id['Photo'] as $photo):// ?>
                            <tr>
                                <td><?php echo $html->link($photo['url'], $photo['url']);  ?></td>
                                <td><?php echo $html->link($event_name, '/events/gallery/'.$event_slug);?></td>
                            </tr>
                        <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <?php endif; ?>
                    
        <ul>
            <li><?php echo $html->link('Back to Attendees', array('action'=>'index')); ?></li>
        </ul>                    
</div>
     