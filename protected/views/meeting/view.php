<?php
/* @var $this MeetingController */
/* @var $model Meeting */

$this->breadcrumbs=array(
	'Meetings'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Meeting', 'url'=>array('index')),
	array('label'=>'Create Meeting', 'url'=>array('create')),
	array('label'=>'Update Meeting', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Meeting', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Meeting', 'url'=>array('admin')),
);
?>

<h1>View Meeting #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'eventid',
		'createdate',
		'startdatetime',
		'title',
		'description',
		'locationid',
		'endingdatetime',
		'createdbyid',
		'checkinstatus',
		'notes',
	),
)); ?>
