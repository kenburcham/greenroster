<?php
/* @var $this EventController */
/* @var $data Event */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('typeid')); ?>:</b>
	<?php echo CHtml::encode($data->type->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('defaultlocationid')); ?>:</b>
	<?php echo CHtml::encode($data->defaultLocation->name); ?>
	<br />


        
        
</div>