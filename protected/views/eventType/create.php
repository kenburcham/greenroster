<?php
/* @var $this EventTypeController */
/* @var $model EventType */

$this->breadcrumbs=array(
	'Event Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Group Types', 'url'=>array('index')),
	array('label'=>'Manage Group Types', 'url'=>array('admin')),
);
?>

<h1>Create Group Type</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>