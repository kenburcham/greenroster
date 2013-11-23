<h2>Attendance Report</h2>

<dl class="sub-nav">
  <dt>Filter:</dt>
  <dd<?php if($type==2) echo " class='active'"?>><a href="<?=$url?>?type=2">Participants</a></dd>
  <dd<?php if($type==1) echo " class='active'"?>><a href="<?=$url?>?type=1">Leaders</a></dd>
</dl> 

<dl class="sub-nav">
  <dt>Period:</dt>
  <dd class='active'><a href="<?=$url?>?period=1">YTD</a></dd>
  <dd<?php if($period==2) echo " class='active'"?>><a href="<?=$url?>?period=2">Last Month</a></dd>
  <dd<?php if($period==3) echo " class='active'"?>><a href="<?=$url?>?period=3">This Month</a></dd>
  <dd<?php if($period==4) echo " class='active'"?>><a href="<?=$url?>?period=4">By Quarter</a></dd>
</dl>  

<h4>Participant Attendance:</h4>
<table class="open-meetings-table wide-table">
  <thead>
    <tr>
      <th>Name</th>
      <th>Initial Contact</th>
      <th>Number Meetings</th>
      <th>Number Hours</th>
    </tr>
  </thead>
  <tbody>
      <?php 
      
      if($dataprovider)
      foreach($dataprovider as $user)
      {
          ?>
          <tr>
              <td><a href="<?=$baseUrl?>/user/<?php echo $user['id']?>"><?php echo $user['firstname'] . ' '. $user['lastname']?></a></td>
              <td><?php echo Yii::app()->dateFormatter->formatDateTime($user['firstcontact'],'medium',null)?></td>
              <td><?php echo $user['num_meetings']?></td>
              <td>0</td>
          </tr>
          <?php
      }
      
      ?>
  </tbody>
</table>

<?php //var_dump($dataprovider);