<?php
/**
 * Newsfeeds (newsfeeds)
 * @var $this app\components\View
 * @var $this app\modules\newsfeed\controllers\admin\PostController
 * @var $model app\modules\newsfeed\models\Newsfeeds
 * @var $form app\components\widgets\ActiveForm
 *
 * @author Putra Sudaryanto <putra@ommu.co>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2020 Ommu Platform (www.ommu.co)
 * @created date 6 January 2020, 11:29 WIB
 * @link https://www.ommu.co
 *
 */

use yii\helpers\Html;
use app\components\widgets\ActiveForm;
?>

<div class="newsfeeds-form">

<?php $form = ActiveForm::begin([
	'options' => ['class'=>'form-horizontal form-label-left'],
	'enableClientValidation' => true,
	'enableAjaxValidation' => false,
	//'enableClientScript' => true,
	'fieldConfig' => [
		'errorOptions' => [
			'encode' => false,
		],
	],
]); ?>

<?php //echo $form->errorSummary($model);?>

<?php echo $form->field($model, 'app')
	->textInput(['maxlength'=>true])
	->label($model->getAttributeLabel('app')); ?>

<?php echo $form->field($model, 'member_id')
	->textInput(['type'=>'number', 'min'=>'1'])
	->label($model->getAttributeLabel('member_id')); ?>

<?php echo $form->field($model, 'user_id')
	->textInput(['type'=>'number', 'min'=>'1'])
	->label($model->getAttributeLabel('user_id')); ?>

<?php echo $form->field($model, 'newsfeed_type')
	->textarea(['rows'=>6, 'cols'=>50])
	->label($model->getAttributeLabel('newsfeed_type')); ?>

<?php echo $form->field($model, 'newsfeed_post')
	->textarea(['rows'=>6, 'cols'=>50])
	->label($model->getAttributeLabel('newsfeed_post')); ?>

<?php echo $form->field($model, 'newsfeed_param')
	->textarea(['rows'=>6, 'cols'=>50])
	->label($model->getAttributeLabel('newsfeed_param')); ?>

<?php echo $form->field($model, 'likes')
	->textInput(['type'=>'number', 'min'=>'1'])
	->label($model->getAttributeLabel('likes')); ?>

<?php echo $form->field($model, 'comments')
	->textInput(['type'=>'number', 'min'=>'1'])
	->label($model->getAttributeLabel('comments')); ?>

<?php if($model->isNewRecord && !$model->getErrors())
	$model->publish = 1;
echo $form->field($model, 'publish')
	->checkbox()
	->label($model->getAttributeLabel('publish')); ?>

<hr/>

<?php echo $form->field($model, 'submitButton')
	->submitButton(); ?>

<?php ActiveForm::end(); ?>

</div>