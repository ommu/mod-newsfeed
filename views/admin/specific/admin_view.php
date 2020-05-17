<?php
/**
 * Newsfeed Specifics (newsfeed-specific)
 * @var $this app\components\View
 * @var $this app\modules\newsfeed\controllers\admin\SpecificController
 * @var $model app\modules\newsfeed\models\NewsfeedSpecific
 *
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2020 OMMU (www.ommu.id)
 * @created date 6 January 2020, 13:10 WIB
 * @link https://github.com/ommu/mod-newsfeed
 *
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

if(!$small) {
    $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Specifics'), 'url' => ['index']];
    $this->params['breadcrumbs'][] = $model->newsfeed->id;

    $this->params['menu']['content'] = [
        ['label' => Yii::t('app', 'Delete'), 'url' => Url::to(['delete', 'id'=>$model->newsfeed_id]), 'htmlOptions' => ['data-confirm'=>Yii::t('app', 'Are you sure you want to delete this item?'), 'data-method'=>'post', 'class'=>'btn btn-danger'], 'icon' => 'trash'],
    ];
} ?>

<div class="newsfeed-specific-view">

<?php
$attributes = [
	[
		'attribute' => 'newsfeed_id',
		'value' => function ($model) {
			$newsfeed_id = isset($model->newsfeed) ? $model->newsfeed->id : '-';
			if($newsfeed_id != '-')
				return Html::a($newsfeed_id, ['admin/view', 'id'=>$model->newsfeed_id], ['title'=>$newsfeed_id, 'class'=>'modal-btn']);
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
		'attribute' => 'except',
		'value' => $model->filterYesNo($model->except),
		'visible' => !$small,
	],
	[
		'attribute' => 'creation_date',
		'value' => Yii::$app->formatter->asDatetime($model->creation_date, 'medium'),
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