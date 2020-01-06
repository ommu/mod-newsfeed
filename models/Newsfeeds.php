<?php
/**
 * Newsfeeds
 * 
 * @author Putra Sudaryanto <putra@ommu.co>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2020 Ommu Platform (www.ommu.co)
 * @created date 5 January 2020, 23:13 WIB
 * @link https://www.ommu.co
 *
 * This is the model class for table "ommu_newsfeeds".
 *
 * The followings are the available columns in table "ommu_newsfeeds":
 * @property integer $id
 * @property integer $publish
 * @property string $app
 * @property integer $member_id
 * @property integer $user_id
 * @property string $newsfeed_type
 * @property string $newsfeed_post
 * @property string $newsfeed_param
 * @property integer $likes
 * @property integer $comments
 * @property string $creation_date
 * @property integer $creation_id
 * @property string $modified_date
 * @property integer $modified_id
 * @property string $updated_date
 * @property integer $updated_id
 *
 * The followings are the available model relations:
 * @property NewsfeedComment[] $comments
 * @property NewsfeedLike[] $likes
 * @property NewsfeedMention[] $mentions
 * @property Members $member
 * @property Users $user
 * @property Users $creation
 * @property Users $modified
 * @property Users $updated
 *
 */

namespace app\modules\newsfeed\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;
use ommu\users\models\Users;
use ommu\member\models\Members;

class Newsfeeds extends \app\components\ActiveRecord
{
	use \ommu\traits\UtilityTrait;

	public $gridForbiddenColumn = [];

	public $memberDisplayname;
	public $userDisplayname;
	public $creationDisplayname;
	public $modifiedDisplayname;
	public $updatedDisplayname;

	/**
	 * @return string the associated database table name
	 */
	public static function tableName()
	{
		return 'ommu_newsfeeds';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return [
			[['publish', 'app', 'member_id', 'user_id', 'newsfeed_type', 'newsfeed_param'], 'required'],
			[['publish', 'member_id', 'user_id', 'likes', 'comments', 'creation_id', 'modified_id', 'updated_id'], 'integer'],
			[['newsfeed_type', 'newsfeed_post'], 'string'],
			//[['newsfeed_param'], 'json'],
			[['app'], 'string', 'max' => 32],
		];
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t('app', 'ID'),
			'publish' => Yii::t('app', 'Publish'),
			'app' => Yii::t('app', 'App'),
			'member_id' => Yii::t('app', 'Member'),
			'user_id' => Yii::t('app', 'User'),
			'newsfeed_type' => Yii::t('app', 'Newsfeed Type'),
			'newsfeed_post' => Yii::t('app', 'Newsfeed Post'),
			'newsfeed_param' => Yii::t('app', 'Newsfeed Param'),
			'likes' => Yii::t('app', 'Likes'),
			'comments' => Yii::t('app', 'Comments'),
			'creation_date' => Yii::t('app', 'Creation Date'),
			'creation_id' => Yii::t('app', 'Creation'),
			'modified_date' => Yii::t('app', 'Modified Date'),
			'modified_id' => Yii::t('app', 'Modified'),
			'updated_date' => Yii::t('app', 'Updated Date'),
			'updated_id' => Yii::t('app', 'Updated'),
			'comments' => Yii::t('app', 'Comments'),
			'likes' => Yii::t('app', 'Likes'),
			'mentions' => Yii::t('app', 'Mentions'),
			'memberDisplayname' => Yii::t('app', 'Member'),
			'userDisplayname' => Yii::t('app', 'User'),
			'creationDisplayname' => Yii::t('app', 'Creation'),
			'modifiedDisplayname' => Yii::t('app', 'Modified'),
			'updatedDisplayname' => Yii::t('app', 'Updated'),
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getComments($count=false, $publish=1)
	{
		if($count == false)
			return $this->hasMany(NewsfeedComment::className(), ['newsfeed_id' => 'id'])
			->alias('comments')
			->andOnCondition([sprintf('%s.publish', 'comments') => $publish]);

		$model = NewsfeedComment::find()
			->alias('t')
			->where(['newsfeed_id' => $this->id]);
		if($publish == 0)
			$model->unpublish();
		elseif($publish == 1)
			$model->published();
		elseif($publish == 2)
			$model->deleted();
		$comments = $model->count();

		return $comments ? $comments : 0;
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getLikes($count=false, $publish=1)
	{
		if($count == false)
			return $this->hasMany(NewsfeedLike::className(), ['newsfeed_id' => 'id'])
			->alias('likes')
			->andOnCondition([sprintf('%s.publish', 'likes') => $publish]);

		$model = NewsfeedLike::find()
			->alias('t')
			->where(['newsfeed_id' => $this->id]);
		if($publish == 0)
			$model->unpublish();
		elseif($publish == 1)
			$model->published();
		elseif($publish == 2)
			$model->deleted();
		$likes = $model->count();

		return $likes ? $likes : 0;
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getMentions($count=false)
	{
		if($count == false)
			return $this->hasMany(NewsfeedMention::className(), ['newsfeed_id' => 'id']);

		$model = NewsfeedMention::find()
			->alias('t')
			->where(['newsfeed_id' => $this->id]);
		$mentions = $model->count();

		return $mentions ? $mentions : 0;
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getMember()
	{
		return $this->hasOne(Members::className(), ['member_id' => 'member_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUser()
	{
		return $this->hasOne(Users::className(), ['user_id' => 'user_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCreation()
	{
		return $this->hasOne(Users::className(), ['user_id' => 'creation_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getModified()
	{
		return $this->hasOne(Users::className(), ['user_id' => 'modified_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUpdated()
	{
		return $this->hasOne(Users::className(), ['user_id' => 'updated_id']);
	}

	/**
	 * {@inheritdoc}
	 * @return \app\modules\newsfeed\models\query\Newsfeeds the active query used by this AR class.
	 */
	public static function find()
	{
		return new \app\modules\newsfeed\models\query\Newsfeeds(get_called_class());
	}

	/**
	 * Set default columns to display
	 */
	public function init()
	{
		parent::init();

		if(!(Yii::$app instanceof \app\components\Application))
			return;

		if(!$this->hasMethod('search'))
			return;

		$this->templateColumns['_no'] = [
			'header' => '#',
			'class' => 'yii\grid\SerialColumn',
			'contentOptions' => ['class'=>'center'],
		];
		$this->templateColumns['app'] = [
			'attribute' => 'app',
			'value' => function($model, $key, $index, $column) {
				return $model->app;
			},
		];
		$this->templateColumns['memberDisplayname'] = [
			'attribute' => 'memberDisplayname',
			'value' => function($model, $key, $index, $column) {
				return isset($model->member) ? $model->member->displayname : '-';
				// return $model->memberDisplayname;
			},
			'visible' => !Yii::$app->request->get('member') ? true : false,
		];
		$this->templateColumns['userDisplayname'] = [
			'attribute' => 'userDisplayname',
			'value' => function($model, $key, $index, $column) {
				return isset($model->user) ? $model->user->displayname : '-';
				// return $model->userDisplayname;
			},
			'visible' => !Yii::$app->request->get('user') ? true : false,
		];
		$this->templateColumns['newsfeed_type'] = [
			'attribute' => 'newsfeed_type',
			'value' => function($model, $key, $index, $column) {
				return $model->newsfeed_type;
			},
		];
		$this->templateColumns['newsfeed_post'] = [
			'attribute' => 'newsfeed_post',
			'value' => function($model, $key, $index, $column) {
				return $model->newsfeed_post;
			},
		];
		$this->templateColumns['newsfeed_param'] = [
			'attribute' => 'newsfeed_param',
			'value' => function($model, $key, $index, $column) {
				return Json::encode($model->newsfeed_param);
			},
		];
		$this->templateColumns['likes'] = [
			'attribute' => 'likes',
			'value' => function($model, $key, $index, $column) {
				return $model->likes;
			},
		];
		$this->templateColumns['comments'] = [
			'attribute' => 'comments',
			'value' => function($model, $key, $index, $column) {
				return $model->comments;
			},
		];
		$this->templateColumns['creation_date'] = [
			'attribute' => 'creation_date',
			'value' => function($model, $key, $index, $column) {
				return Yii::$app->formatter->asDatetime($model->creation_date, 'medium');
			},
			'filter' => $this->filterDatepicker($this, 'creation_date'),
		];
		$this->templateColumns['creationDisplayname'] = [
			'attribute' => 'creationDisplayname',
			'value' => function($model, $key, $index, $column) {
				return isset($model->creation) ? $model->creation->displayname : '-';
				// return $model->creationDisplayname;
			},
			'visible' => !Yii::$app->request->get('creation') ? true : false,
		];
		$this->templateColumns['modified_date'] = [
			'attribute' => 'modified_date',
			'value' => function($model, $key, $index, $column) {
				return Yii::$app->formatter->asDatetime($model->modified_date, 'medium');
			},
			'filter' => $this->filterDatepicker($this, 'modified_date'),
		];
		$this->templateColumns['modifiedDisplayname'] = [
			'attribute' => 'modifiedDisplayname',
			'value' => function($model, $key, $index, $column) {
				return isset($model->modified) ? $model->modified->displayname : '-';
				// return $model->modifiedDisplayname;
			},
			'visible' => !Yii::$app->request->get('modified') ? true : false,
		];
		$this->templateColumns['updated_date'] = [
			'attribute' => 'updated_date',
			'value' => function($model, $key, $index, $column) {
				return Yii::$app->formatter->asDatetime($model->updated_date, 'medium');
			},
			'filter' => $this->filterDatepicker($this, 'updated_date'),
		];
		$this->templateColumns['updatedDisplayname'] = [
			'attribute' => 'updatedDisplayname',
			'value' => function($model, $key, $index, $column) {
				return isset($model->updated) ? $model->updated->displayname : '-';
				// return $model->updatedDisplayname;
			},
			'visible' => !Yii::$app->request->get('updated') ? true : false,
		];
		$this->templateColumns['comments'] = [
			'attribute' => 'comments',
			'value' => function($model, $key, $index, $column) {
				$comments = $model->getComments(true);
				return Html::a($comments, ['comment/manage', 'newsfeed'=>$model->primaryKey, 'publish'=>1], ['title'=>Yii::t('app', '{count} comments', ['count'=>$comments]), 'data-pjax'=>0]);
			},
			'filter' => false,
			'contentOptions' => ['class'=>'center'],
			'format' => 'raw',
		];
		$this->templateColumns['likes'] = [
			'attribute' => 'likes',
			'value' => function($model, $key, $index, $column) {
				$likes = $model->getLikes(true);
				return Html::a($likes, ['like/manage', 'newsfeed'=>$model->primaryKey, 'publish'=>1], ['title'=>Yii::t('app', '{count} likes', ['count'=>$likes]), 'data-pjax'=>0]);
			},
			'filter' => false,
			'contentOptions' => ['class'=>'center'],
			'format' => 'raw',
		];
		$this->templateColumns['mentions'] = [
			'attribute' => 'mentions',
			'value' => function($model, $key, $index, $column) {
				$mentions = $model->getMentions(true);
				return Html::a($mentions, ['mention/manage', 'newsfeed'=>$model->primaryKey], ['title'=>Yii::t('app', '{count} mentions', ['count'=>$mentions]), 'data-pjax'=>0]);
			},
			'filter' => false,
			'contentOptions' => ['class'=>'center'],
			'format' => 'raw',
		];
		$this->templateColumns['publish'] = [
			'attribute' => 'publish',
			'value' => function($model, $key, $index, $column) {
				$url = Url::to(['publish', 'id'=>$model->primaryKey]);
				return $this->quickAction($url, $model->publish);
			},
			'filter' => $this->filterYesNo(),
			'contentOptions' => ['class'=>'center'],
			'format' => 'raw',
			'visible' => !Yii::$app->request->get('trash') ? true : false,
		];
	}

	/**
	 * User get information
	 */
	public static function getInfo($id, $column=null)
	{
		if($column != null) {
			$model = self::find();
			if(is_array($column))
				$model->select($column);
			else
				$model->select([$column]);
			$model = $model->where(['id' => $id])->one();
			return is_array($column) ? $model : $model->$column;
			
		} else {
			$model = self::findOne($id);
			return $model;
		}
	}

	/**
	 * after find attributes
	 */
	public function afterFind()
	{
		parent::afterFind();

		$this->newsfeed_param = Json::decode($this->newsfeed_param);
		// $this->memberDisplayname = isset($this->member) ? $this->member->displayname : '-';
		// $this->userDisplayname = isset($this->user) ? $this->user->displayname : '-';
		// $this->creationDisplayname = isset($this->creation) ? $this->creation->displayname : '-';
		// $this->modifiedDisplayname = isset($this->modified) ? $this->modified->displayname : '-';
		// $this->updatedDisplayname = isset($this->updated) ? $this->updated->displayname : '-';
	}

	/**
	 * before validate attributes
	 */
	public function beforeValidate()
	{
		if(parent::beforeValidate()) {
			if($this->isNewRecord) {
				if($this->user_id == null)
					$this->user_id = !Yii::$app->user->isGuest ? Yii::$app->user->id : null;

				if($this->creation_id == null)
					$this->creation_id = !Yii::$app->user->isGuest ? Yii::$app->user->id : null;
			} else {
				if($this->modified_id == null)
					$this->modified_id = !Yii::$app->user->isGuest ? Yii::$app->user->id : null;

				if($this->updated_id == null)
					$this->updated_id = !Yii::$app->user->isGuest ? Yii::$app->user->id : null;
			}
		}
		return true;
	}

	/**
	 * before save attributes
	 */
	public function beforeSave($insert)
	{
		if(parent::beforeSave($insert)) {
			$this->newsfeed_param = Json::encode($this->newsfeed_param);
		}
		return true;
	}
}