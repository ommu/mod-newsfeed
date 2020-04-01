<?php
/**
 * Newsfeeds (newsfeeds)
 * @var $this app\components\View
 * @var $this app\modules\newsfeed\controllers\admin\PostController
 * @var $model app\modules\newsfeed\models\search\Newsfeeds
 * @var $form yii\widgets\ActiveForm
 *
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2020 OMMU (www.ommu.id)
 * @created date 6 January 2020, 11:29 WIB
 * @link https://github.com/ommu/mod-newsfeed
 *
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="newsfeeds-search search-form">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
		'options' => [
			'data-pjax' => 1
		],
	]); ?>

		<?php echo $form->field($model, 'app');?>

		<?php echo $form->field($model, 'memberDisplayname');?>

		<?php echo $form->field($model, 'newsfeed_type');?>

		<?php echo $form->field($model, 'newsfeed_post');?>

		<?php echo $form->field($model, 'newsfeed_param');?>

		<?php echo $form->field($model, 'likes');?>

		<?php echo $form->field($model, 'comments');?>

		<?php echo $form->field($model, 'creation_date')
			->input('date');?>

		<?php echo $form->field($model, 'creationDisplayname');?>

		<?php echo $form->field($model, 'modified_date')
			->input('date');?>

		<?php echo $form->field($model, 'modifiedDisplayname');?>

		<?php echo $form->field($model, 'updated_date')
			->input('date');?>

		<?php echo $form->field($model, 'updatedDisplayname');?>

		<?php echo $form->field($model, 'privacy')
			->dropDownList($model::getPrivacy(), ['prompt'=>'']);?>

		<?php echo $form->field($model, 'publish')
			->dropDownList($model->filterYesNo(), ['prompt'=>'']);?>

		<div class="form-group">
			<?php echo Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']); ?>
			<?php echo Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']); ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>