<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<h2>Please login.</h2>

<p>
	Welcome to Green Roster.  If you are
        an authorized leader, volunteer or administrator please
        login.  
</p>

<div id="loginModal" class="reveal-modal">
    <?php
  $form=$this->beginWidget('foundation.widgets.FounActiveForm', array(
    'id'=>'login-form',
      'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
    )); ?>
    <h3>Please Login.</h3>
    <p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="row">
            <div class="eight columns">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
            </div>
	</div>

	<div class="row">
            <div class="eight columns">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
            </div>
	</div>

	<div class="row rememberMe">
            <div class="eight columns">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
            </div>
	</div>

	<div class="row buttons">
            <div class="eight columns">
		<?php echo CHtml::submitButton('Login', array('class' => 'button')); ?>
            </div>
	</div>
    
    
<?php $this->endWidget(); ?>
    
</div>

<a href="#" class="button" data-reveal-id="loginModal">Login</a>



</div><!-- form -->
