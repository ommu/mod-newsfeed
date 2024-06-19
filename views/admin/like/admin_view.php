<?php
/**
 * Newsfeed Likes (newsfeed-like)
 * @var $this app\components\View
 * @var $this ommu\newsfeed\controllers\admin\LikeController
 * @var $model ommu\newsfeed\models\NewsfeedLike
 *
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)811-2540-432
 * @copyright Copyright (c) 2020 OMMU (www.ommu.id)
 * @created date 6 January 2020, 11:31 WIB
 * @modified date 3 April 2020, 13:09 WIB
 * @link https://github.com/ommu/mod-newsfeed
 *
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

if (!$small) {
    $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Likes'), 'url' => ['index']];
    $this->params['breadcrumbs'][] = $model->newsfeed->id;

    $this->params['menu']['content'] = [
        ['label' => Yii::t('app', 'Delete'), 'url' => Url::to(['delete', 'id' => $model->newsfeed_id]), 'htmlOptions' => ['data-confirm' => Yii::t('app', 'Are you sure you want to delete this item?'), 'data-method' => 'post', 'class' => 'btn btn-danger'], 'icon' => 'trash'],
    ];
} ?>

<div class="newsfeed-like-view">

<?php
$attributes = [
	[
		'attribute' => 'newsfeed_id',
		'value' => function ($model) {
			$newsfeed_id = isset($model->newsfeed) ? $model->newsfeed->id : '-';
            if ($newsfeed_id != '-') {
                return Html::a($newsfeed_id, ['admin/view', 'id' => $model->newsfeed_id], ['title' => $newsfeed_id, 'class' => 'modal-btn']);
            }
			return $newsfeed_id;
		},
		'format' => 'html',
	],
	[
		'attribute' => 'userDisplayname',
		'value' => isset($model->user) ? $model->user->displayname : '-',
		'visible' => !$small,
	],
	[
		'attribute' => 'like_react',
		'value' => $model->filterYesNo($model->like_react),
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
		'class' => 'table table-striped detail-view',
	],
	'attributes' => $attributes,
]); ?>

</div>