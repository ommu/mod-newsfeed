<?php
/**
 * Newsfeed Likes (newsfeed-like)
 * @var $this app\components\View
 * @var $this app\modules\newsfeed\controllers\admin\LikeController
 * @var $model app\modules\newsfeed\models\search\NewsfeedLike
 * @var $form yii\widgets\ActiveForm
 *
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2020 OMMU (www.ommu.id)
 * @created date 6 January 2020, 11:31 WIB
 * @link https://github.com/ommu/mod-newsfeed
 *
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="newsfeed-like-search search-form">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
		'options' => [
			'data-pjax' => 1
		],
	]); ?>

		<?php echo $form->field($model, 'newsfeedId');?>

		<?php echo $form->field($model, 'userDisplayname');?>

		<?php echo $form->field($model, 'likes_date')
			->input('date');?>

		<?php echo $form->field($model, 'likes_ip');?>

		<?php echo $form->field($model, 'updated_date')
			->input('date');?>

		<?php echo $form->field($model, 'updatedDisplayname');?>

		<?php echo $form->field($model, 'publish')
			->dropDownList($model->filterYesNo(), ['prompt'=>'']);?>

		<div class="form-group">
			<?php echo Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']); ?>
			<?php echo Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']); ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>