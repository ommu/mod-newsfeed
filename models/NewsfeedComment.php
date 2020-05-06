<?php
/**
 * NewsfeedComment
 * 
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2020 OMMU (www.ommu.id)
 * @created date 5 January 2020, 23:14 WIB
 * @link https://github.com/ommu/mod-newsfeed
 *
 * This is the model class for table "ommu_newsfeed_comment".
 *
 * The followings are the available columns in table "ommu_newsfeed_comment":
 * @property integer $newsfeed_id
 * @property integer $publish
 * @property integer $user_id
 * @property string $comment
 * @property string $comment_date
 * @property string $comment_ip
 * @property string $updated_date
 * @property integer $updated_id
 *
 * The followings are the available model relations:
 * @property Newsfeeds $newsfeed
 * @property Users $user
 * @property Users $updated
 *
 */

namespace app\modules\newsfeed\models;

use Yii;
use yii\helpers\Url;
use ommu\users\models\Users;

class NewsfeedComment extends \app\components\ActiveRecord
{
	use \ommu\traits\UtilityTrait;

	public $gridForbiddenColumn = ['comment_ip', 'updated_date', 'updatedDisplayname'];

	public $userDisplayname;
	public $updatedDisplayname;

	/**
	 * @return string the associated database table name
	 */
	public static function tableName()
	{
		return 'ommu_newsfeed_comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return [
			[['newsfeed_id', 'comment'], 'required'],
			[['newsfeed_id', 'publish', 'user_id', 'updated_id'], 'integer'],
			[['comment'], 'string'],
			[['user_id'], 'safe'],
			[['comment_ip'], 'string', 'max' => 20],
			[['newsfeed_id'], 'exist', 'skipOnError' => true, 'targetClass' => Newsfeeds::className(), 'targetAttribute' => ['newsfeed_id' => 'id']],
		];
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return [
			'newsfeed_id' => Yii::t('app', 'Newsfeed'),
			'publish' => Yii::t('app', 'Publish'),
			'user_id' => Yii::t('app', 'User'),
			'comment' => Yii::t('app', 'Comment'),
			'comment_date' => Yii::t('app', 'Comment Date'),
			'comment_ip' => Yii::t('app', 'Comment Ip'),
			'updated_date' => Yii::t('app', 'Updated Date'),
			'updated_id' => Yii::t('app', 'Updated'),
			'userDisplayname' => Yii::t('app', 'User'),
			'updatedDisplayname' => Yii::t('app', 'Updated'),
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getNewsfeed()
	{
		return $this->hasOne(Newsfeeds::className(), ['id' => 'newsfeed_id']);
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
	public function getUpdated()
	{
		return $this->hasOne(Users::className(), ['user_id' => 'updated_id']);
	}

	/**
	 * {@inheritdoc}
	 * @return \app\modules\newsfeed\models\query\NewsfeedComment the active query used by this AR class.
	 */
	public static function find()
	{
		return new \app\modules\newsfeed\models\query\NewsfeedComment(get_called_class());
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
			'class' => 'app\components\grid\SerialColumn',
			'contentOptions' => ['class'=>'text-center'],
		];
		$this->templateColumns['newsfeed_id'] = [
			'attribute' => 'newsfeed_id',
			'value' => function($model, $key, $index, $column) {
				return $model->newsfeed_id;
			},
			'visible' => !Yii::$app->request->get('newsfeed') ? true : false,
		];
		$this->templateColumns['userDisplayname'] = [
			'attribute' => 'userDisplayname',
			'value' => function($model, $key, $index, $column) {
				return isset($model->user) ? $model->user->displayname : '-';
				// return $model->userDisplayname;
			},
			'visible' => !Yii::$app->request->get('user') ? true : false,
		];
		$this->templateColumns['comment'] = [
			'attribute' => 'comment',
			'value' => function($model, $key, $index, $column) {
				return $model->comment;
			},
		];
		$this->templateColumns['comment_date'] = [
			'attribute' => 'comment_date',
			'value' => function($model, $key, $index, $column) {
				return Yii::$app->formatter->asDatetime($model->comment_date, 'medium');
			},
			'filter' => $this->filterDatepicker($this, 'comment_date'),
		];
		$this->templateColumns['comment_ip'] = [
			'attribute' => 'comment_ip',
			'value' => function($model, $key, $index, $column) {
				return $model->comment_ip;
			},
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
			$model = $model->where(['newsfeed_id' => $id])->one();
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

		// $this->userDisplayname = isset($this->user) ? $this->user->displayname : '-';
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
			} else {
				if($this->updated_id == null)
					$this->updated_id = !Yii::$app->user->isGuest ? Yii::$app->user->id : null;
			}
			$this->comment_ip = $_SERVER['REMOTE_ADDR'];
		}
		return true;
	}
}
