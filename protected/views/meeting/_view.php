<?php
/* @var $this MeetingController */
/* @var $data Meeting */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('eventid')); ?>:</b>
	<?php echo CHtml::encode($data->eventid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createdate')); ?>:</b>
	<?php echo CHtml::encode($data->createdate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('startdatetime')); ?>:</b>
	<?php echo CHtml::encode($data->startdatetime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('locationid')); ?>:</b>
	<?php echo CHtml::encode($data->locationid); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('endingdatetime')); ?>:</b>
	<?php echo CHtml::encode($data->endingdatetime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createdbyid')); ?>:</b>
	<?php echo CHtml::encode($data->createdbyid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('checkinstatus')); ?>:</b>
	<?php echo CHtml::encode($data->checkinstatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notes')); ?>:</b>
	<?php echo CHtml::encode($data->notes); ?>
	<br />

	*/ ?>

</div>