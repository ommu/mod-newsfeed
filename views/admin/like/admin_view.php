<?php
/**
 * Newsfeed Likes (newsfeed-like)
 * @var $this app\components\View
 * @var $this app\modules\newsfeed\controllers\admin\LikeController
 * @var $model app\modules\newsfeed\models\NewsfeedLike
 *
 * @author Putra Sudaryanto <putra@ommu.co>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2020 Ommu Platform (www.ommu.co)
 * @created date 6 January 2020, 11:31 WIB
 * @link https://www.ommu.co
 *
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

if(!$small) {
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Likes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->newsfeed->id;

$this->params['menu']['content'] = [
	['label' => Yii::t('app', 'Update'), 'url' => Url::to(['update', 'id'=>$model->id]), 'icon' => 'pencil', 'htmlOptions' => ['class'=>'btn btn-primary']],
	['label' => Yii::t('app', 'Delete'), 'url' => Url::to(['delete', 'id'=>$model->id]), 'htmlOptions' => ['data-confirm'=>Yii::t('app', 'Are you sure you want to delete this item?'), 'data-method'=>'post', 'class'=>'btn btn-danger'], 'icon' => 'trash'],
];
} ?>

<div class="newsfeed-like-view">

<?php
$attributes = [
	[
		'attribute' => 'newsfeedId',
		'value' => function ($model) {
			$newsfeedId = isset($model->newsfeed) ? $model->newsfeed->id : '-';
			if($newsfeedId != '-')
				return Html::a($newsfeedId, ['admin/view', 'id'=>$model->newsfeed_id], ['title'=>$newsfeedId, 'class'=>'modal-btn']);
			return $newsfeedId;
		},
		'format' => 'html',
	],
	[
		'attribute' => 'userDisplayname',
		'value' => isset($model->user) ? $model->user->displayname : '-',
		'visible' => !$small,
	],
	[
		'attribute' => 'publish',
		'value' => $model->quickAction(Url::to(['publish', 'id'=>$model->primaryKey]), $model->publish),
		'format' => 'raw',
		'visible' => !$small,
	],
	[
		'attribute' => 'likes_date',
		'value' => Yii::$app->formatter->asDatetime($model->likes_date, 'medium'),
		'visible' => !$small,
	],
	[
		'attribute' => 'likes_ip',
		'value' => $model->likes_ip ? $model->likes_ip : '-',
		'visible' => !$small,
	],
	[
		'attribute' => 'updated_date',
		'value' => Yii::$app->formatter->asDatetime($model->updated_date, 'medium'),
		'visible' => !$small,
	],
	[
		'attribute' => 'updatedDisplayname',
		'value' => isset($model->updated) ? $model->updated->displayname : '-',
		'visible' => !$small,
	],
];

echo DetailView::widget([
	'model' => $model,
	'options' => [
		'class'=>'table table-striped detail-view',
	],
	'attributes' => $attributes,
]); ?>

</div>