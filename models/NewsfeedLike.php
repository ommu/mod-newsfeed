<?php
/**
 * NewsfeedLike
 * 
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)811-2540-432
 * @copyright Copyright (c) 2020 OMMU (www.ommu.id)
 * @created date 5 January 2020, 23:15 WIB
 * @link https://github.com/ommu/mod-newsfeed
 *
 * This is the model class for table "ommu_newsfeed_like".
 *
 * The followings are the available columns in table "ommu_newsfeed_like":
 * @property integer $newsfeed_id
 * @property integer $publish
 * @property integer $user_id
 * @property integer $like_react
 * @property string $likes_date
 * @property string $likes_ip
 * @property string $updated_date
 * @property integer $updated_id
 *
 * The followings are the available model relations:
 * @property Newsfeeds $newsfeed
 * @property Users $user
 * @property Users $updated
 *
 */

namespace ommu\newsfeed\models;

use Yii;
use yii\helpers\Url;
use app\models\Users;
use thamtech\uuid\helpers\UuidHelper;

class NewsfeedLike extends \app\components\ActiveRecord
{
	use \ommu\traits\UtilityTrait;

	public $gridForbiddenColumn = ['likes_ip', 'updated_date', 'updatedDisplayname'];

	public $userDisplayname;
	public $updatedDisplayname;

	/**
	 * @return string the associated database table name
	 */
	public static function tableName()
	{
		return 'ommu_newsfeed_like';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return [
			[['newsfeed_id', 'likes_ip'], 'required'],
			[['publish', 'user_id', 'like_react', 'updated_id'], 'integer'],
			[['newsfeed_id'], 'string'],
			[['user_id'], 'safe'],
			[['likes_ip'], 'string', 'max' => 20],
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
			'like_react' => Yii::t('app', 'Like React'),
			'likes_date' => Yii::t('app', 'Likes Date'),
			'likes_ip' => Yii::t('app', 'Likes Ip'),
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
	 * @return \ommu\newsfeed\models\query\NewsfeedLike the active query used by this AR class.
	 */
	public static function find()
	{
		return new \ommu\newsfeed\models\query\NewsfeedLike(get_called_class());
	}

	/**
	 * Set default columns to display
	 */
	public function init()
	{
        parent::init();

        if (!(Yii::$app instanceof \app\components\Application)) {
            return;
        }

        if (!$this->hasMethod('search')) {
            return;
        }

		$this->templateColumns['_no'] = [
			'header' => '#',
			'class' => 'app\components\grid\SerialColumn',
			'contentOptions' => ['class' => 'text-center'],
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
		$this->templateColumns['like_react'] = [
			'attribute' => 'like_react',
			'value' => function($model, $key, $index, $column) {
				return $this->filterYesNo($model->like_react);
			},
			'filter' => $this->filterYesNo(),
			'contentOptions' => ['class' => 'text-center'],
		];
		$this->templateColumns['likes_date'] = [
			'attribute' => 'likes_date',
			'value' => function($model, $key, $index, $column) {
				return Yii::$app->formatter->asDatetime($model->likes_date, 'medium');
			},
			'filter' => $this->filterDatepicker($this, 'likes_date'),
		];
		$this->templateColumns['likes_ip'] = [
			'attribute' => 'likes_ip',
			'value' => function($model, $key, $index, $column) {
				return $model->likes_ip;
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
        if ($column != null) {
            $model = self::find();
            if (is_array($column)) {
                $model->select($column);
            } else {
                $model->select([$column]);
            }
            $model = $model->where(['newsfeed_id' => $id])->one();
            return is_array($column) ? $model : $model->$column;

        } else {
            $model = self::findOne($id);
            return $model;
        }
	}

    /**
     * function getLikeReact
     */
    public static function getLikeReact($value=null)
    {
        $items = array(
            '1' => Yii::t('app', 'Like'),
            '2' => Yii::t('app', 'Happy'),
            '3' => Yii::t('app', 'Laugh'),
            '4' => Yii::t('app', 'Angry'),
            '5' => Yii::t('app', 'Sad'),
            '6' => Yii::t('app', 'Shock'),
        );

        if ($value !== null) {
            return $items[$value];
        } else {
            return $items;
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
        if (parent::beforeValidate()) {
            if ($this->isNewRecord) {
                $this->id = UuidHelper::uuid();

                if ($this->user_id == null) {
                    $this->user_id = !Yii::$app->user->isGuest ? Yii::$app->user->id : null;
                }
            } else {
                if ($this->updated_id == null) {
                    $this->updated_id = !Yii::$app->user->isGuest ? Yii::$app->user->id : null;
                }
            }
            $this->likes_ip = $_SERVER['REMOTE_ADDR'];
        }
        return true;
	}
}
