<?php
/* @var $this EventController */
/* @var $model Event */
/* @var $form CActiveForm */
?>

<div class="form">

    
<?php $form=$this->beginWidget('foundation.widgets.FounActiveForm', array(
	'id'=>'event-form',
	'enableAjaxValidation'=>false,
        'type' => 'custom',
));     

    echo CHtml::hiddenField('Event[statusid]', '1'); //all are active

    ?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'typeid'); ?>
                <?php echo $form->dropDownList($model,'typeid', CHtml::listData(EventType::model()->findAll(array('order' => 'name')), 'id', 'name'), array('empty'=>'---Select Type---')); ?>
		<?php echo $form->error($model,'typeid'); ?>
	</div>
<?php
//Yii::log("here 1");
//$list = EventLocation::model()->findAll(array('order' => 'name'));
//$dd = CHtml::listData( $list, 'id','name' );
//CHtml::listData(Modelname::model()->findAll(),'id','name')

?>
        
	<div class="row">
		<?php echo $form->labelEx($model,'defaultlocationid'); ?>
                <?php echo $form->dropDownList($model,'defaultlocationid', CHtml::listData(EventLocation::model()->findAll(array('order' => 'name')), 'id', 'name'), array('empty'=>'---Select Location---')); ?>
		<?php echo $form->error($model,'defaultlocationid'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'secondary button')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->