<h2>Start a meeting</h2>

<div class="form">
    

    
<?php $form=$this->beginWidget('foundation.widgets.FounActiveForm', array(
	'id'=>'event-form',
	'enableAjaxValidation'=>false,
        'type' => 'custom',
)); 

echo $form->hiddenField($meeting, 'eventid');

?>
    

    
    <div class="panel">
        <h3><?php echo CHtml::encode($model->name) ?></h3>
        
        <p class="note">Fields with <span class="required">*</span> are required.</p>
	<?php echo $form->errorSummary($meeting); ?>

	<div class="row">
		<?php echo $form->labelEx($meeting,'title'); ?>
		<?php echo $form->textField($meeting,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($meeting,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($meeting,'description'); ?>
		<?php echo $form->textArea($meeting,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($meeting,'description'); ?>
	</div>

        <div class="row">
		<?php echo $form->labelEx($meeting,'locationid'); ?>
            <?php echo $form->dropDownList($meeting,'locationid', CHtml::listData(EventLocation::model()->findAll(), 'id', 'name'), 
                    array('empty'=>'---Select Location---',
                          'options' => array($meeting->event->defaultlocationid => array('selected' => 'true')))); ?>

	</div>
        
        <div class="row">
		<?php echo $form->labelEx($meeting,'eventdate'); ?>
                <?php 
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $meeting,
                    'attribute' => 'eventdate',
                    'htmlOptions' => array(
                        'size' => '10',         // textField size
                        'maxlength' => '10',    // textField maxlength
                        'value'=>CTimestamp::formatDate('m/d/Y'), //default to today.
                    ),
                ));
                
                
                ?>
		<?php echo $form->error($meeting,'eventdate'); ?>
	</div>

        <div class="row">
		<?php echo $form->labelEx($meeting,'starttime'); ?>
		<?php echo $form->dropDownList($meeting,'starttime',$timearray); ?>
		<?php echo $form->error($meeting,'starttime');  ?>
	</div>
        
        
        <div class="row">
		<?php echo $form->labelEx($meeting,'endtime'); ?>
		<?php echo $form->dropDownList($meeting,'endtime', $timearray); ?>
		<?php echo $form->error($meeting,'endtime'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($meeting,'numhours'); ?>
		<?php echo $form->textField($meeting,'numhours'); ?>
		<?php echo $form->error($meeting,'numhours'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($meeting,'notes'); ?>
		<?php echo $form->textArea($meeting,'notes',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($meeting,'notes'); ?>
	</div>
        
        <div class="row">
            <?php //echo $form->labelEx($meeting, 'checkinstatus'); ?>
            <?php //echo $form->dropDownList( $meeting, "checkinstatus", array('1' => 'Open', '0' => 'Closed')); ?>
        </div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($meeting->isNewRecord ? 'Create' : 'Save', array('class'=>'secondary button')); ?>
	</div>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->



