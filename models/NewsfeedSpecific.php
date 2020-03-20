<?php
/**
 * NewsfeedSpecific
 * 
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2020 OMMU (www.ommu.id)
 * @created date 7 January 2020, 19:05 WIB
 * @link https://github.com/ommu/mod-newsfeed
 *
 * This is the model class for table "ommu_newsfeed_specific".
 *
 * The followings are the available columns in table "ommu_newsfeed_specific":
 * @property integer $newsfeed_id
 * @property integer $user_id
 * @property integer $except
 * @property string $creation_date
 *
 * The followings are the available model relations:
 * @property Newsfeeds $newsfeed
 * @property Users $user
 *
 */

namespace app\modules\newsfeed\models;

use Yii;
use ommu\users\models\Users;

class NewsfeedSpecific extends \app\components\ActiveRecord
{
	use \ommu\traits\UtilityTrait;

	public $gridForbiddenColumn = [];

	public $newsfeedId;
	public $userDisplayname;

	/**
	 * @return string the associated database table name
	 */
	public static function tableName()
	{
		return 'ommu_newsfeed_specific';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return [
			[['newsfeed_id', 'user_id'], 'required'],
			[['newsfeed_id', 'user_id', 'except'], 'integer'],
			[['creation_date'], 'safe'],
			[['newsfeed_id', 'user_id'], 'unique', 'targetAttribute' => ['newsfeed_id', 'user_id']],
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
			'user_id' => Yii::t('app', 'User'),
			'except' => Yii::t('app', 'Except'),
			'creation_date' => Yii::t('app', 'Creation Date'),
			'newsfeedId' => Yii::t('app', 'Newsfeed'),
			'userDisplayname' => Yii::t('app', 'User'),
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
	 * {@inheritdoc}
	 * @return \app\modules\newsfeed\models\query\NewsfeedSpecific the active query used by this AR class.
	 */
	public static function find()
	{
		return new \app\modules\newsfeed\models\query\NewsfeedSpecific(get_called_class());
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
		$this->templateColumns['newsfeedId'] = [
			'attribute' => 'newsfeedId',
			'value' => function($model, $key, $index, $column) {
				return isset($model->newsfeed) ? $model->newsfeed->id : '-';
				// return $model->newsfeedId;
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
		$this->templateColumns['creation_date'] = [
			'attribute' => 'creation_date',
			'value' => function($model, $key, $index, $column) {
				return Yii::$app->formatter->asDatetime($model->creation_date, 'medium');
			},
			'filter' => $this->filterDatepicker($this, 'creation_date'),
		];
		$this->templateColumns['except'] = [
			'attribute' => 'except',
			'value' => function($model, $key, $index, $column) {
				return $this->filterYesNo($model->except);
			},
			'filter' => $this->filterYesNo(),
			'contentOptions' => ['class'=>'text-center'],
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

		// $this->newsfeedId = isset($this->newsfeed) ? $this->newsfeed->id : '-';
		// $this->userDisplayname = isset($this->user) ? $this->user->displayname : '-';
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
			}
		}
		return true;
	}
}
