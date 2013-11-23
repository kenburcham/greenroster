<?php
/* @var $this EventLocationController */
/* @var $model EventLocation */

$this->breadcrumbs=array(
	'Group Locations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Group Location', 'url'=>array('index')),
	array('label'=>'Manage Group Location', 'url'=>array('admin')),
);
?>

<h1>Create Group Location</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>