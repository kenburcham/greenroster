<h3>Checking in to:</h3>
<div class="panel">
    <h3><?php echo $meeting->title; ?></h3>
    <?php echo ' [ ' . Yii::app()->dateFormatter->formatDateTime($meeting->eventdate, 'medium', null) . ' @ ' . $meeting->starttime . ' ] '; ?>
    <?php echo $meeting->location->name; ?>

    <p><i><?php echo $meeting->description; ?></i></p>
    <p><?php echo $meeting->notes; ?></p>
    
</div>

<?php $form=$this->beginWidget('foundation.widgets.FounActiveForm', array(
	'id'=>'event-form',
	'enableAjaxValidation'=>false,
        'type' => 'custom',
)); ?>

Enter your phone number: <input name="phone" type="text" value="5419691748"/>

		<?php echo CHtml::submitButton("Check-in", array('class'=>'secondary button')); ?>

    <?php $this->endWidget(); ?>

