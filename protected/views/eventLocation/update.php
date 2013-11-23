<?php
/* @var $this EventLocationController */
/* @var $model EventLocation */

$this->breadcrumbs=array(
	'Group Locations'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Group Location', 'url'=>array('index')),
	array('label'=>'Create Group Location', 'url'=>array('create')),
	array('label'=>'View Group Location', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Group Location', 'url'=>array('admin')),
);
?>

<h1>Update Group Location <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>