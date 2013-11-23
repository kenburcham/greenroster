<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('foundation.widgets.FounActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
        'type' => 'custom',
)); ?>
    
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
            <div class="six columns">
		<?php echo $form->labelEx($model,'firstname'); ?>
		<?php echo $form->textField($model,'firstname',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'firstname'); ?>
            </div>
            <div class="six columns">
                <?php echo $form->labelEx($model,'lastname'); ?>
		<?php echo $form->textField($model,'lastname',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'lastname'); ?>
            </div>
	</div>

        
        <div class="row">
            <div class="five columns">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'phone'); ?>
            </div>
            <div class="seven columns">
            <?php echo $form->labelEx($model,'school'); ?>
            <?php echo $form->textField($model,'school'); ?>
            <?php echo $form->error($model,'school'); ?>
            </div>
	</div>
        
        <div class ="row">
            <div class="twelve columns">
            Address
             <?php echo $form->textField($model, "address1", array('placeholder'=>"Street (e.g. 123 Main St.)")); ?>
            </div>
        </div>
        <div class="row">              
          <div class="six columns">
            <?php echo $form->textField( $model, "city", array("placeholder" => "City")); ?>
          </div>
          <div class="two columns">
            <?php echo $form->dropdownlist( $model, "state", array("OR" => "OR")); ?>
          </div>
          <div class="four columns">
            <?php echo $form->textField( $model, "zip", array("placeholder" => "ZIP")); ?>
          </div>
        </div>
        
         <div class="row">
             <div class="six columns">
		<?php echo $form->labelEx($model,'dateofbirth'); ?>
                <?php 
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $model,
                    'attribute' => 'dateofbirth',
                    'htmlOptions' => array(
                        'size' => '10',         // textField size
                        'maxlength' => '10',    // textField maxlength
                    ),
                ));
                ?>
		<?php echo $form->error($model,'dateofbirth'); ?>
             </div>
             <div class="six columns">
                 <?php echo $form->labelEx($model,'firstcontact'); ?>
                <?php 
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $model,
                    'attribute' => 'firstcontact',
                    'htmlOptions' => array(
                        'size' => '10',         // textField size
                        'maxlength' => '10',    // textField maxlength
                        'value'=>CTimestamp::formatDate('m/d/Y'), //default to today.
                    ),
                ));
                ?>
		<?php echo $form->error($model,'firstcontact'); ?>
             </div>
	</div>
        

        
        <div class="row">
            <div class="twelve columns">
		<?php echo $form->labelEx($model,'notes'); ?>
		<?php echo $form->textArea($model,'notes',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'notes'); ?>
            </div>
	</div>
        
	<div class="row buttons right">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'button radius')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->