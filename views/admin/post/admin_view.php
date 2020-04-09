<?php
/**
 * Newsfeeds (newsfeeds)
 * @var $this app\components\View
 * @var $this app\modules\newsfeed\controllers\admin\PostController
 * @var $model app\modules\newsfeed\models\Newsfeeds
 *
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2020 OMMU (www.ommu.id)
 * @created date 6 January 2020, 11:30 WIB
 * @link https://github.com/ommu/mod-newsfeed
 *
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\helpers\Json;

if(!$small) {
    $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Newsfeeds'), 'url' => ['index']];
    $this->params['breadcrumbs'][] = $model->id;
} ?>

<div class="newsfeeds-view">

<?php
$attributes = [
	[
		'attribute' => 'id',
		'value' => $model->id ? $model->id : '-',
		'visible' => !$small,
	],
	[
		'attribute' => 'publish',
		'value' => $model->quickAction(Url::to(['publish', 'id'=>$model->primaryKey]), $model->publish),
		'format' => 'raw',
		'visible' => !$small,
	],
	[
		'attribute' => 'app',
		'value' => $model->app ? $model->app : '-',
		'visible' => !$small,
	],
	[
		'attribute' => 'memberDisplayname',
        'value' => function ($model) {
            $memberDisplayname = isset($model->member) ? $model->member->displayname : '-';
            $userDisplayname = isset($model->user) ? $model->user->displayname : '-';
            if ($userDisplayname != '-' && $memberDisplayname != $userDisplayname) {
                return $memberDisplayname.'<br/>'.$userDisplayname;
            }
            return $memberDisplayname;
        },
        'format' => 'html',
	],
	[
		'attribute' => 'newsfeed_type',
		'value' => $model->newsfeed_type ? $model->newsfeed_type : '-',
	],
	[
		'attribute' => 'privacy',
		'value' => function ($model) {
			if(!$model->privacy)
				return '-';
			return $model::getPrivacy($model->privacy);
		},
		'visible' => !$small,
	],
	[
		'attribute' => 'newsfeed_post',
		'value' => $model->newsfeed_post ? $model->newsfeed_post : '-',
		'visible' => !$small,
	],
	[
		'attribute' => 'newsfeed_param',
		'value' => function ($model) {
            if (is_array($model->newsfeed_param) && empty($model->newsfeed_param))
                return '-';
            return Json::encode($model->newsfeed_param);
		},
		'visible' => !$small,
	],
	[
		'attribute' => 'likes',
		'value' => $model->likes ? $model->likes : '-',
		'visible' => !$small,
	],
	[
		'attribute' => 'comments',
		'value' => $model->comments ? $model->comments : '-',
		'visible' => !$small,
	],
	[
		'attribute' => 'creation_date',
		'value' => Yii::$app->formatter->asDatetime($model->creation_date, 'medium'),
		'visible' => !$small,
	],
	[
		'attribute' => 'creationDisplayname',
		'value' => isset($model->creation) ? $model->creation->displayname : '-',
		'visible' => !$small,
	],
	[
		'attribute' => 'modified_date',
		'value' => Yii::$app->formatter->asDatetime($model->modified_date, 'medium'),
		'visible' => !$small,
	],
	[
		'attribute' => 'modifiedDisplayname',
		'value' => isset($model->modified) ? $model->modified->displayname : '-',
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
	[
		'attribute' => 'comments',
		'value' => function ($model) {
			$comments = $model->getComments(true);
			return Html::a($comments, ['comment/manage', 'newsfeed'=>$model->primaryKey, 'publish'=>1], ['title'=>Yii::t('app', '{count} comments', ['count'=>$comments])]);
		},
		'format' => 'html',
		'visible' => !$small,
	],
	[
		'attribute' => 'likes',
		'value' => function ($model) {
			$likes = $model->getLikes(true);
			return Html::a($likes, ['like/manage', 'newsfeed'=>$model->primaryKey, 'publish'=>1], ['title'=>Yii::t('app', '{count} likes', ['count'=>$likes])]);
		},
		'format' => 'html',
		'visible' => !$small,
	],
	[
		'attribute' => 'mentions',
		'value' => function ($model) {
			$mentions = $model->getMentions(true);
			return Html::a($mentions, ['mention/manage', 'newsfeed'=>$model->primaryKey, 'publish'=>1], ['title'=>Yii::t('app', '{count} mentions', ['count'=>$mentions])]);
		},
		'format' => 'html',
		'visible' => !$small,
	],
	[
		'attribute' => 'specifics',
		'value' => function ($model) {
			$specifics = $model->getSpecifics(true);
			return Html::a($specifics, ['specific/manage', 'newsfeed'=>$model->primaryKey], ['title'=>Yii::t('app', '{count} specifics', ['count'=>$specifics])]);
		},
		'format' => 'html',
		'visible' => !$small,
	],
	[
		'attribute' => '',
		'value' => Html::a(Yii::t('app', 'Update'), ['update', 'id'=>$model->primaryKey], ['title'=>Yii::t('app', 'Update'), 'class'=>'btn btn-success btn-sm']),
		'format' => 'html',
		'visible' => !$small && Yii::$app->request->isAjax ? true : false,
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