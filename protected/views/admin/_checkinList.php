<?php
/**
 * Need to send: 
 *  $meeting - the meeting the checkin list is for
 *  $attendee_list - the attendees list to display
 *  $current_list - the attendees actually checked in
 */

if(!isset($meeting) 
   || !isset($attendee_list)
        || !isset($current_list))
    throw new Exception("Error: you must call _checkinList with the proper parameters.");
Yii::log("Loading _checkingList for ".count($attendee_list)." attendees!");
?>
<table class="checked-in-table wide-table">
  <thead>
    <tr>
      <th>Name <?php echo '<a href="#" class="small button round" data-reveal-id="userLookupModal">+</a>' ?></th>
      <th width="180">Checked-in</th>
      <th width="80">Action</th>
    </tr>
  </thead>
  <tbody>
<?php     
Yii::log("iterating attendee_list");
    foreach ($attendee_list as $attendee)
    {
        $tr_class = "";
        
        //the attendee_user we will use
        if(is_a($attendee,'Attendee'))
            $attendee_user = $attendee->user;
        else if(is_a($attendee,'User'))
            $attendee_user = $attendee;

        $checkedInUser = (Meeting::getUserFrom($attendee_user->id, $current_list));
        
        if(!is_null($checkedInUser))
            $tr_class = ""; //checked-in-row";
        
        echo "<tr class='$tr_class'><td>";
        echo $attendee_user->firstname . ' ' . $attendee_user->lastname;
        echo "</td>";
        
        echo "<td>";
        echo (!is_null($checkedInUser)) ? Yii::app()->dateFormatter->formatDateTime($checkedInUser->createdate) : '<i>Not checked in.</i>';
        echo "</td>";
        echo "<td>";
        
     
        echo CHtml::ajaxLink(
                (!is_null($checkedInUser)) ? 'Clear' : 'Checkin' ,
                array('admin/toggleAttendeeStatus', 'id' => $meeting->id, 'userid' => $attendee_user->id), 
                array('update' => '#checkin-list')
        );

        
        echo "</td>";
        echo "</tr>";
    }
?>
  </tbody>
</table>