<?php
/* @var $this EventTypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Group Types',
);

$this->menu=array(
	array('label'=>'Create Group Types', 'url'=>array('create')),
	array('label'=>'Manage Group Types', 'url'=>array('admin')),
);
?>

<h1>Group Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
