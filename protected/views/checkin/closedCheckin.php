<?php
    echo CHtml::image(Yii::app()->baseUrl."/images/boom.png", 'boom', array('class' => 'center-image'));
?>
<h3>Oops, checkins are closed!</h3>
The Meeting ID you entered is closed for checkins.  Please ask the meeting leader if you still need to get checked in.
<br/><br/>
<?php
    echo CHtml::linkButton('Start over', array('class' => 'button radius', 'submit' => 'checkin'));
?>