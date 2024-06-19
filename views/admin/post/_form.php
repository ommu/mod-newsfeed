<?php
/**
 * Newsfeeds (newsfeeds)
 * @var $this app\components\View
 * @var $this ommu\newsfeed\controllers\admin\PostController
 * @var $model ommu\newsfeed\models\Newsfeeds
 * @var $form app\components\widgets\ActiveForm
 *
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)811-2540-432
 * @copyright Copyright (c) 2020 OMMU (www.ommu.id)
 * @created date 6 January 2020, 11:29 WIB
 * @link https://github.com/ommu/mod-newsfeed
 *
 */

use yii\helpers\Html;
use app\components\widgets\ActiveForm;
?>

<div class="newsfeeds-form">

<?php $form = ActiveForm::begin([
	'options' => ['class' => 'form-horizontal form-label-left'],
	'enableClientValidation' => false,
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
	->textInput(['maxlength' => true])
	->label($model->getAttributeLabel('app')); ?>

<?php echo $form->field($model, 'member_id')
	->textInput(['type' => 'number', 'min' => '1'])
	->label($model->getAttributeLabel('member_id')); ?>

<?php echo $form->field($model, 'user_id')
	->textInput(['type' => 'number', 'min' => '1'])
	->label($model->getAttributeLabel('user_id')); ?>

<?php echo $form->field($model, 'newsfeed_type')
	->textInput(['maxlength' => true])
	->label($model->getAttributeLabel('newsfeed_type')); ?>

<?php echo $form->field($model, 'newsfeed_post')
	->textarea(['rows' => 6, 'cols' => 50])
	->label($model->getAttributeLabel('newsfeed_post')); ?>

<?php /* echo $form->field($model, 'newsfeed_param')
	->textarea(['rows' => 6, 'cols' => 50])
	->label($model->getAttributeLabel('newsfeed_param')); */ ?>

<?php echo $form->field($model, 'privacy')
	->dropDownList($model::getPrivacy(), ['prompt' => ''])
	->label($model->getAttributeLabel('privacy')); ?>

<?php 
if ($model->isNewRecord && !$model->getErrors()) {
    $model->publish = 1;
}
echo $form->field($model, 'publish')
	->checkbox()
	->label($model->getAttributeLabel('publish')); ?>

<hr/>

<?php echo $form->field($model, 'submitButton')
	->submitButton(); ?>

<?php ActiveForm::end(); ?>

</div>