<h2>Welcome!</h2>

<h4>Open meetings:</h4>
<table class="open-meetings-table wide-table">
  <thead>
    <tr>
      <th>Name</th>
      <th>Date</th>
      <th>Check ins</th>
    </tr>
  </thead>
  <tbody>
<?php
foreach ($openmeetings as $meeting)
{
    echo '<tr><td>';
    echo CHtml::link($meeting->title, array('viewMeeting', 'id' => $meeting->id));
    echo '  (<i>'.$meeting->notes.'</i>)';
    echo '</td><td>';
    echo Yii::app()->dateFormatter->formatDateTime($meeting->eventdate,'medium',null);
    echo '</td><td>';
    echo count($meeting->participants);
    echo '</td></tr>';
}
?>
 </tbody>
</table>


<h4>Closed meetings:</h4>
<table class="open-meetings-table wide-table">
  <thead>
    <tr>
      <th>Name</th>
      <th>Date</th>
      <th>Check ins</th>
    </tr>
  </thead>
  <tbody>
<?php
foreach ($closedmeetings as $meeting)
{
    echo '<tr><td>';
    echo CHtml::link($meeting->title, array('viewMeeting', 'id' => $meeting->id));
    echo '  (<i>'.$meeting->notes.'</i>)';
    echo '</td><td>';
    echo Yii::app()->dateFormatter->formatDateTime($meeting->eventdate,'medium',null);
    echo '</td><td>';
    echo count($meeting->participants);
    echo '</td></tr>';
}
?>
 </tbody>
</table>

<?php 
    //easy as pie:
    //$sms = new TxtSender();
    //$sms->send('5419691748', 'This is a test!');
?>