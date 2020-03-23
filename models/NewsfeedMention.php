<?php
/**
 * NewsfeedMention
 * 
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2020 OMMU (www.ommu.id)
 * @created date 5 January 2020, 23:14 WIB
 * @modified date 19 March 2020, 14:23 WIB
 * @link https://github.com/ommu/mod-newsfeed
 *
 * This is the model class for table "ommu_newsfeed_mention".
 *
 * The followings are the available columns in table "ommu_newsfeed_mention":
 * @property integer $newsfeed_id
 * @property integer $publish
 * @property integer $member_id
 * @property integer $user_id
 * @property string $creation_date
 * @property integer $creation_id
 * @property string $updated_date
 *
 * The followings are the available model relations:
 * @property Newsfeeds $newsfeed
 * @property Members $member
 * @property Users $user
 * @property Users $creation
 *
 */

namespace app\modules\newsfeed\models;

use Yii;
use yii\helpers\Url;
use yii\helpers\Json;
use ommu\users\models\Users;
use ommu\member\models\Members;

class NewsfeedMention extends \app\components\ActiveRecord
{
	use \ommu\traits\UtilityTrait;

	public $gridForbiddenColumn = [];

	public $memberDisplayname;
	public $userDisplayname;
	public $creationDisplayname;

	/**
	 * @return string the associated database table name
	 */
	public static function tableName()
	{
		return 'ommu_newsfeed_mention';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return [
			[['newsfeed_id'], 'required'],
			[['newsfeed_id', 'publish', 'member_id', 'user_id', 'creation_id'], 'integer'],
			[['member_id', 'user_id'], 'safe'],
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
			'member_id' => Yii::t('app', 'Member'),
			'user_id' => Yii::t('app', 'User'),
			'creation_date' => Yii::t('app', 'Creation Date'),
			'creation_id' => Yii::t('app', 'Creation'),
			'updated_date' => Yii::t('app', 'Updated Date'),
			'memberDisplayname' => Yii::t('app', 'Member'),
			'userDisplayname' => Yii::t('app', 'User'),
			'creationDisplayname' => Yii::t('app', 'Creation'),
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
	 * {@inheritdoc}
	 * @return \app\modules\newsfeed\models\query\NewsfeedMention the active query used by this AR class.
	 */
	public static function find()
	{
		return new \app\modules\newsfeed\models\query\NewsfeedMention(get_called_class());
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
		$this->templateColumns['updated_date'] = [
			'attribute' => 'updated_date',
			'value' => function($model, $key, $index, $column) {
				return Yii::$app->formatter->asDatetime($model->updated_date, 'medium');
			},
			'filter' => $this->filterDatepicker($this, 'updated_date'),
		];
		$this->templateColumns['publish'] = [
			'attribute' => 'publish',
			'value' => function($model, $key, $index, $column) {
				$url = Url::to(['publish', 'id'=>$model->primaryKey]);
				return $this->quickAction($url, $model->publish);
			},
			'filter' => $this->filterYesNo(),
			'contentOptions' => ['class'=>'text-center'],
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

		// $this->memberDisplayname = isset($this->member) ? $this->member->displayname : '-';
		// $this->userDisplayname = isset($this->user) ? $this->user->displayname : '-';
		// $this->creationDisplayname = isset($this->creation) ? $this->creation->displayname : '-';
	}

	/**
	 * before validate attributes
	 */
	public function beforeValidate()
	{
		if(parent::beforeValidate()) {
			if($this->isNewRecord) {
				if($this->creation_id == null)
					$this->creation_id = !Yii::$app->user->isGuest ? Yii::$app->user->id : null;
			}
		}
		return true;
	}
}
