<?php
/* @var $this MeetingController */
/* @var $model Meeting */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'meeting-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'eventid'); ?>
		<?php echo $form->textField($model,'eventid'); ?>
		<?php echo $form->error($model,'eventid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'createdate'); ?>
		<?php echo $form->textField($model,'createdate'); ?>
		<?php echo $form->error($model,'createdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'startdatetime'); ?>
		<?php echo $form->textField($model,'startdatetime'); ?>
		<?php echo $form->error($model,'startdatetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'locationid'); ?>
		<?php echo $form->textField($model,'locationid'); ?>
		<?php echo $form->error($model,'locationid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'endingdatetime'); ?>
		<?php echo $form->textField($model,'endingdatetime'); ?>
		<?php echo $form->error($model,'endingdatetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'createdbyid'); ?>
		<?php echo $form->textField($model,'createdbyid'); ?>
		<?php echo $form->error($model,'createdbyid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'checkinstatus'); ?>
		<?php echo $form->textField($model,'checkinstatus'); ?>
		<?php echo $form->error($model,'checkinstatus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notes'); ?>
		<?php echo $form->textArea($model,'notes',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'notes'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->