<?php
/* @var $this MeetingController */
/* @var $model Meeting */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'eventid'); ?>
		<?php echo $form->textField($model,'eventid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'createdate'); ?>
		<?php echo $form->textField($model,'createdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'startdatetime'); ?>
		<?php echo $form->textField($model,'startdatetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'locationid'); ?>
		<?php echo $form->textField($model,'locationid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'endingdatetime'); ?>
		<?php echo $form->textField($model,'endingdatetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'createdbyid'); ?>
		<?php echo $form->textField($model,'createdbyid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'checkinstatus'); ?>
		<?php echo $form->textField($model,'checkinstatus'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'notes'); ?>
		<?php echo $form->textArea($model,'notes',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->