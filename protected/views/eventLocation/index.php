<?php
/* @var $this EventLocationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Group Locations',
);

$this->menu=array(
	array('label'=>'Create Group Location', 'url'=>array('create')),
	array('label'=>'Manage Group Location', 'url'=>array('admin')),
);
?>

<h1>Group Locations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
