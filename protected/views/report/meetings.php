<h2>Meeting Report</h2>

<dl class="sub-nav">
  <dt>Filter:</dt>
  <dd<?php if($type==2) echo " class='active'"?>><a href="<?=$url?>?type=2">All</a></dd>
  <dd<?php if($type==1) echo " class='active'"?>><a href="<?=$url?>?type=1">SLPs Only</a></dd>
</dl> 

<dl class="sub-nav">
  <dt>Period:</dt>
  <dd class='active'><a href="<?=$url?>?period=1">YTD</a></dd>
</dl>  

<h4>Meetings:</h4>
<table class="open-meetings-table wide-table">
  <thead>
    <tr>
      <th>#</th>
      <th>Date</th>
      <th>Location</th>
      <th>Leaders</th>
      <th>Total Adults</th>
      <th>Total Youth</th>
      <th>Code</th>
      <th>Topic</th>
      <th>Time In</th>
      <th>Time Out</th>
      <th>Total Hrs</th>
      <th>Adult Hrs<br/>(# staff * # hrs)</th>
      <th>Youth Hrs<br/>(# youth * # hrs)</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $cnt = 1;

    foreach ($meetings as $meeting)
    {
        $leadercnt = count($meeting->leaders);
        $participantcnt = count($meeting->participants);
        ?>
         <tr>
             <td><?=$cnt?></td>
             <td><?php echo Yii::app()->dateFormatter->formatDateTime($meeting['eventdate'],'medium',null)?></td>
             <td><?php echo $meeting->location->name; ?></td>
             <td><?php echo $meeting->getLeadersAsString();?></td>
             <td><?php echo $leadercnt; ?></td>
             <td><?php echo $participantcnt; ?></td>
             <td><?php echo $meeting->event->type->name; ?></td>
             <td><?php echo $meeting->title; ?></td>
             <td><?php echo $meeting->starttime; ?></td>
             <td><?php echo $meeting->endtime; ?></td>
             <td><?php echo $meeting->numhours; ?></td>
             <td><?php echo $meeting->numhours * $leadercnt; ?></td>
             <td><?php echo $meeting->numhours * $participantcnt; ?></td>
          </tr>
        <?php
        //update totals
        $cnt++;
        $participant_total += $participantcnt;
        $leader_total      += $leadercnt;
        $meetinghrs_total  += $meeting->numhours;
        $participanthrs_total += $participantcnt * $meeting->numhours;
        $leaderhrs_total      += $leadercnt * $meeting->numhours;
        
    }
            //totals:
    ?>
          <tr>
             <td></td>
             <td></td>
             <td></td>
             <td></td>
             <td><?php echo $leader_total; ?></td>
             <td><?php echo $participant_total; ?></td>
             <td></td>
             <td></td>
             <td></td>
             <td></td>
             <td><?php echo $meetinghrs_total; ?></td>
             <td><?php echo $leaderhrs_total; ?></td>
             <td><?php echo $participanthrs_total ?></td>
          </tr>
  </tbody>
</table>

<?php //var_dump($dataprovider);