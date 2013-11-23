<?php
/* @var $this EventController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Groups',
);

$this->menu=array(
	array('label'=>'Create Group', 'url'=>array('create')),
	array('label'=>'Manage Groups', 'url'=>array('admin')),
);
?>

<h1>Events</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
