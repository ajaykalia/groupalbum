<?php
/**
 * file: app/views/events/view.ctp
 *
 * Events View View
 */
echo('<pre>');
print_r($event);
echo('</pre>');

 ?>

<div>
    <h2>Wedding Attendees</h2>
        
    <dl>
    	<dt>Wedding:</dt>
        <dd><?php echo $event['Event']['name']; ?></dd>

    </dl>
     
        <?php if(!empty($event['Attendee'])): ?>
        
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Attendee</th>
                        <th>View Attendee</th>
                        <th>Add Photos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $event_name = $event['Event']['name'] ?>
                    <?php $event_slug = $event['Event']['slug'] ?>
                    <?php foreach($event['Attendee'] as $attendee): ?>
                    <tr>
                        <td><?php echo $attendee['name']; ?></td>
                        <td><?php echo $html->link('View', '/attendees/view/'.$attendee['id']);?></td>
                        <td><?php
                            echo $form->create('Photo', array('action'=>'get_album'));
                            echo $form->input('event_id',
                                 array('label'=>'event_id', 'type'=>'hidden', 'value'=>$attendee['event_id']));
                            echo $form->input('event_name', array('label'=>'event_name', 'type'=>'hidden', 'value'=>$event_name));
                            echo $form->input('event_slug', array('label'=>'event_slug', 'type'=>'hidden', 'value'=>$event_slug));
                            
                            echo $form->input('attendee_id',
                                 array('label'=>'attendee_id', 'type'=>'hidden', 'value'=>$attendee['id']));
                            echo $form->input('attendee_name',
                                  array('label'=>'attendee_name', 'type'=>'hidden', 'value'=>$attendee['name']));
                            
                                
                            
                            echo $form->end('Add');?>
                    
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <?php endif; ?>
        
        <div>            
            <?php echo $form->create('Attendee', array('action'=>'add'));?>
                    <h3>Were you there? Add yourself</h3>
                    <?php
                     echo $form->input('event_id',
                         array('label'=>'event_id', 'type'=>'hidden', 'value'=>$event['Event']['id']));
                     echo $form->input('event_name',
                         array('label'=>'event_name', 'type'=>'hidden', 'value'=>$event['Event']['name']));
                     echo $form->input('event_slug',
                         array('label'=>'event_slug', 'type'=>'hidden', 'value'=>$event['Event']['slug'])); ?>
                     
            <?php echo $form->end('Add');?>
        </div>
    
        
        <ul>    
            <li><?php echo $html->link('Back to Weddings', array('action'=>'index')); ?></li>
        </ul>                    
        </div>
     