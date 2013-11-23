<h1>Checking in to:</h1>

<?php $form=$this->beginWidget('foundation.widgets.FounActiveForm', array(
	'id'=>'event-form',
	'enableAjaxValidation'=>false,
        'type' => 'custom',
        'method' => 'get',
)); ?>

Enter Meeting ID: <input name="id" type="text" value=""/>

		<?php echo CHtml::submitButton("Start Check-in", array('class'=>'secondary button')); ?>

    <?php $this->endWidget(); ?>