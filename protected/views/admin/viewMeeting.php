
<div class="panel">
    <h3><?php echo $meeting->title; ?></h3>
    <?php echo ' [ ' . Yii::app()->dateFormatter->formatDateTime( $meeting->eventdate, 'medium', null) . ' @ ' . $meeting->starttime . ' ] '; ?>
    <?php echo $meeting->location->name; ?>

    <p><i><?php echo $meeting->description; ?></i></p>
    <p><?php echo $meeting->notes; ?></p>
</div>



<div id="checkin-list">
    <?php
    Yii::log("ready to render checkin list");
        echo $this->renderPartial('_checkinList', 
                array('meeting' => $meeting, 
                      'attendee_list'=>$meeting->getRecentLeaders(),
                      'current_list' => $meeting->leaders)
                ); 

    
        //output our checkin list for recent participants roster
        echo $this->renderPartial('_checkinList', 
                array('meeting' => $meeting, 
                      'attendee_list'=>$meeting->getRecentParticipants(),
                      'current_list' => $meeting->participants)
                ); 
    ?>
</div>

<div class="row">
    <div class="six columns">
        <div id="toggle-status">
            <?php
                if($meeting->checkinstatus == Meeting::CHECKIN_CLOSED)
                        echo "<div class='error'>Checkins are closed</div>";

                echo CHtml::ajaxButton(
                    ($meeting->checkinstatus == Meeting::CHECKIN_OPEN) ? 'Close Checkins' : 'Open Checkins' ,
                    array('admin/toggleMeetingStatus', 'id' => $meeting->id), 
                    array('update' => '#toggle-status'),
                    array('class' => 'button radius')
                );
            ?>
        </div>

         
        <div id="newUser">
            <a href="#" class="button radius" data-reveal-id="newUserModal">New User</a>
        </div>
    </div>
</div>


<div id="newUserModal" class="reveal-modal">
    <?php echo $this->renderPartial('//user/_form', array('model'=>new User())); ?>
</div>

<div id="userLookupModal" class="reveal-modal">
    <?php echo $this->renderPartial('userLookup', array('meeting' => $meeting));?>
</div>
