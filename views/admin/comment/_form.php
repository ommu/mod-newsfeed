<?php
/**
 * Newsfeed Comments (newsfeed-comment)
 * @var $this app\components\View
 * @var $this app\modules\newsfeed\controllers\admin\CommentController
 * @var $model app\modules\newsfeed\models\NewsfeedComment
 * @var $form app\components\widgets\ActiveForm
 *
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2020 OMMU (www.ommu.id)
 * @created date 6 January 2020, 11:32 WIB
 * @modified date 3 April 2020, 13:09 WIB
 * @link https://github.com/ommu/mod-newsfeed
 *
 */

use yii\helpers\Html;
use app\components\widgets\ActiveForm;
?>

<div class="newsfeed-comment-form">

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

<?php echo $form->field($model, 'newsfeed_id')
	->textInput(['type'=>'number', 'min'=>'1'])
	->label($model->getAttributeLabel('newsfeed_id')); ?>

<?php echo $form->field($model, 'member_id')
	->textInput(['type'=>'number', 'min'=>'1'])
	->label($model->getAttributeLabel('member_id')); ?>

<?php echo $form->field($model, 'user_id')
	->textInput(['type'=>'number', 'min'=>'1'])
	->label($model->getAttributeLabel('user_id')); ?>

<?php echo $form->field($model, 'comment')
	->textarea(['rows'=>6, 'cols'=>50])
	->label($model->getAttributeLabel('comment')); ?>

<?php echo $form->field($model, 'comment_ip')
	->textInput(['maxlength'=>true])
	->label($model->getAttributeLabel('comment_ip')); ?>

<hr/>

<?php echo $form->field($model, 'submitButton')
	->submitButton(); ?>

<?php ActiveForm::end(); ?>

</div>