<?php
/**
 * NewsfeedTag
 * 
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2020 OMMU (www.ommu.id)
 * @created date 13 July 2020, 07:12 WIB
 * @link https://github.com/ommu/mod-newsfeed
 *
 * This is the model class for table "ommu_newsfeed_tag".
 *
 * The followings are the available columns in table "ommu_newsfeed_tag":
 * @property integer $id
 * @property integer $newsfeed_id
 * @property integer $publish
 * @property integer $tag_id
 * @property string $creation_date
 * @property integer $creation_id
 *
 * The followings are the available model relations:
 * @property Newsfeeds $newsfeed
 * @property CoreTags $tag
 * @property Users $creation
 *
 */

namespace ommu\newsfeed\models;

use Yii;
use yii\helpers\Url;
use yii\helpers\Inflector;
use app\models\CoreTags;
use app\models\Users;
use thamtech\uuid\helpers\UuidHelper;

class NewsfeedTag extends \app\components\ActiveRecord
{
	use \ommu\traits\UtilityTrait;

	public $gridForbiddenColumn = [];

	public $tagBody;
	public $newsfeedId;
	public $creationDisplayname;

	/**
	 * @return string the associated database table name
	 */
	public static function tableName()
	{
		return 'ommu_newsfeed_tag';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return [
			[['newsfeed_id', 'publish', 'tagBody'], 'required'],
			[['publish', 'tag_id', 'creation_id'], 'integer'],
			[['newsfeed_id', 'tagBody'], 'string'],
			[['creation_date'], 'safe'],
			[['newsfeed_id'], 'exist', 'skipOnError' => true, 'targetClass' => Newsfeeds::className(), 'targetAttribute' => ['newsfeed_id' => 'id']],
		];
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t('app', 'ID'),
			'newsfeed_id' => Yii::t('app', 'Newsfeed'),
			'publish' => Yii::t('app', 'Publish'),
			'tag_id' => Yii::t('app', 'Tag'),
			'creation_date' => Yii::t('app', 'Creation Date'),
			'creation_id' => Yii::t('app', 'Creation'),
			'tagBody' => Yii::t('app', 'Tag'),
			'newsfeedId' => Yii::t('app', 'Newsfeed'),
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
	public function getTag()
	{
		return $this->hasOne(CoreTags::className(), ['tag_id' => 'tag_id']);
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
	 * @return \ommu\newsfeed\models\query\NewsfeedTag the active query used by this AR class.
	 */
	public static function find()
	{
		return new \ommu\newsfeed\models\query\NewsfeedTag(get_called_class());
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
		$this->templateColumns['newsfeedId'] = [
			'attribute' => 'newsfeedId',
			'value' => function($model, $key, $index, $column) {
				return isset($model->newsfeed) ? $model->newsfeed->id : '-';
				// return $model->newsfeedId;
			},
			'visible' => !Yii::$app->request->get('newsfeed') ? true : false,
		];
		$this->templateColumns['tagBody'] = [
			'attribute' => 'tagBody',
			'value' => function($model, $key, $index, $column) {
				return isset($model->tag) ? $model->tag->body : '-';
				// return $model->tagBody;
			},
			'visible' => !Yii::$app->request->get('tag') ? true : false,
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
		$this->templateColumns['publish'] = [
			'attribute' => 'publish',
			'value' => function($model, $key, $index, $column) {
				$url = Url::to(['publish', 'id' => $model->primaryKey]);
				return $this->quickAction($url, $model->publish);
			},
			'filter' => $this->filterYesNo(),
			'contentOptions' => ['class' => 'text-center'],
			'format' => 'raw',
			'visible' => !Yii::$app->request->get('trash') ? true : false,
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

		$this->tagBody = isset($this->tag) ? $this->tag->body : '';
		// $this->newsfeedId = isset($this->newsfeed) ? $this->newsfeed->id : '-';
		// $this->creationDisplayname = isset($this->creation) ? $this->creation->displayname : '-';
	}

	/**
	 * before validate attributes
	 */
	public function beforeValidate()
	{
        if (parent::beforeValidate()) {
            if ($this->isNewRecord) {
                $this->id = UuidHelper::uuid();
    
                if ($this->creation_id == null) {
                    $this->creation_id = !Yii::$app->user->isGuest ? Yii::$app->user->id : null;
                }
            }
        }
        return true;
	}

	/**
	 * after validate attributes
	 */
	public function afterValidate()
	{
		parent::afterValidate();

		// Create action
		
		return true;
	}

	/**
	 * before save attributes
	 */
	public function beforeSave($insert)
	{
        if (parent::beforeSave($insert)) {
            if ($insert) {
                if ($this->tag_id == 0) {
					$tag = CoreTags::find()
						->select(['tag_id'])
						->andWhere(['body' => Inflector::camelize($this->tagBody)])
						->one();
						
                    if ($tag != null) {
                        $this->tag_id = $tag->tag_id;
                    } else {
						$data = new CoreTags();
						$data->body = $this->tagBody;
                        if ($data->save()) {
                            $this->tag_id = $data->tag_id;
                        }
					}
				}
            }
        }
        return true;
	}

	/**
	 * After save attributes
	 */
	public function afterSave($insert, $changedAttributes)
	{
        parent::afterSave($insert, $changedAttributes);

		// Create action
	}

	/**
	 * Before delete attributes
	 */
	public function beforeDelete()
	{
        if (parent::beforeDelete()) {
			// Create action
        }
        return true;
	}

	/**
	 * After delete attributes
	 */
	public function afterDelete()
	{
        parent::afterDelete();

		// Create action
	}
}
