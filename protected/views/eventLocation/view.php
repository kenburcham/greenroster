<?php
/* @var $this EventLocationController */
/* @var $model EventLocation */

$this->breadcrumbs=array(
	'Group Locations'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Group Location', 'url'=>array('index')),
	array('label'=>'Create Group Location', 'url'=>array('create')),
	array('label'=>'Update Group Location', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Group Location', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Group Location', 'url'=>array('admin')),
);
?>

<h1>View Group Location #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
