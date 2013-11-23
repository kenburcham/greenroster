
<h4>Lookup user by name:</h4>

<?php

$form=$this->beginWidget('foundation.widgets.FounActiveForm', array(
	'id'=>'checkin-user-form',
	'enableAjaxValidation'=>false,
        'type' => 'custom',
        'action' => Yii::app()->createUrl('admin/checkinExistingUser'),
));     

echo CHtml::hiddenField('meetingid', $meeting->id); 

echo CHtml::textField('user-lookup','',array('id'=>'user-lookup'));
echo "<br/><br/>";
echo CHtml::submitButton('Check user in', array('class'=>'secondary button'));
echo CHtml::submitButton('Cancel', array('class'=>'secondary button'));

$this->widget('ESelect2',
                      array(
                           'selector' => "#user-lookup",
                           'options'  => array(
                               'width'              => '100%',
                               'height'             => '500px',
                               'placeholder'        => 'Type a name',
                               'minimumInputLength' => 0,
                               'ajax'               => array(
                                   'url'      => Yii::app()->controller->createUrl('admin/searchUser'),
                                   'dataType' => 'jsonp',
                                   'data'     => 'js: function(term,page) {
                                                        return {
                                                            q: term,
                                                            page_limit: 10,
                                                        };
                                                  }',
                                   'results'  => 'js: function(data,page){
                                                      return {results: data};
                                                  }',
                               ),
                               'formatResult'       => 'js:function(data){
                                    var markup = data.firstname + " " + data.lastname;
                                    
                                    return markup;
                                }',
                               'formatSelection'    => 'js: function(data) {
                                    return data.firstname + " " + data.lastname;
                                }',
                               'initSelection'      => 'js: function(element, callback) {
                                    var elementText = $(element).data("init-text");
                                    callback({"title":elementText});
                               }'
                           ),
                      ));

 $this->endWidget(); 
 
 ?>