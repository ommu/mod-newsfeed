<?php
/**
 * Newsfeeds
 * 
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2020 OMMU (www.ommu.id)
 * @created date 5 January 2020, 23:13 WIB
 * @modified date 31 March 2020, 19:58 WIB
 * @link https://github.com/ommu/mod-newsfeed
 *
 * This is the model class for table "ommu_newsfeeds".
 *
 * The followings are the available columns in table "ommu_newsfeeds":
 * @property integer $id
 * @property integer $publish
 * @property string $app
 * @property integer $member_id
 * @property integer $user_id
 * @property integer $privacy
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
 * @property NewsfeedSpecific[] $specifics
 * @property Members $member
 * @property Users $user
 * @property Users $creation
 * @property Users $modified
 * @property Users $updated
 *
 */

namespace ommu\newsfeed\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;
use app\models\Users;
use ommu\member\models\Members;
use yii\helpers\ArrayHelper;

class Newsfeeds extends \app\components\ActiveRecord
{
	use \ommu\traits\UtilityTrait;

    public $gridForbiddenColumn = ['app', 'privacy', 'newsfeed_param', 'likes', 'comments', 'mentions', 'creationDisplayname', 'modified_date', 'modifiedDisplayname', 'updated_date', 'updatedDisplayname', 'specifics'];

    public $sync = false;
    public $mentions = [];
    public $oldMentions = [];

	public $memberDisplayname;
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
			[['publish', 'app', 'member_id', 'user_id', 'privacy'], 'required'],
			[['publish', 'member_id', 'user_id', 'privacy', 'likes', 'comments', 'creation_id', 'modified_id', 'updated_id'], 'integer'],
			[['newsfeed_type', 'newsfeed_post'], 'string'],
			//[['newsfeed_param'], 'json'],
			[['newsfeed_type', 'newsfeed_post', 'newsfeed_param'], 'safe'],
			[['newsfeed_type'], 'string', 'max' => 16],
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
			'privacy' => Yii::t('app', 'Privacy'),
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
			'specifics' => Yii::t('app', 'Specifics'),
			'memberDisplayname' => Yii::t('app', 'Member'),
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
        if ($count == false) {
            return $this->hasMany(NewsfeedComment::className(), ['newsfeed_id' => 'id'])
                ->alias('comments')
                ->andOnCondition([sprintf('%s.publish', 'comments') => $publish]);
        }

		$model = NewsfeedComment::find()
            ->alias('t')
            ->where(['newsfeed_id' => $this->id]);
        if ($publish == 0) {
            $model->unpublish();
        } else if ($publish == 1) {
            $model->published();
        } else if ($publish == 2) {
            $model->deleted();
        }
		$comments = $model->count();

		return $comments ? $comments : 0;
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getLikes($count=false, $publish=1)
	{
        if ($count == false) {
            return $this->hasMany(NewsfeedLike::className(), ['newsfeed_id' => 'id'])
                ->alias('likes')
                ->andOnCondition([sprintf('%s.publish', 'likes') => $publish]);
        }

		$model = NewsfeedLike::find()
            ->alias('t')
            ->where(['newsfeed_id' => $this->id]);
        if ($publish == 0) {
            $model->unpublish();
        } else if ($publish == 1) {
            $model->published();
        } else if ($publish == 2) {
            $model->deleted();
        }
		$likes = $model->count();

		return $likes ? $likes : 0;
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getMentions($count=false, $publish=1)
	{
        if ($count == false) {
            return $this->hasMany(NewsfeedMention::className(), ['newsfeed_id' => 'id'])
                ->alias('mentions')
                ->andOnCondition([sprintf('%s.publish', 'mentions') => $publish]);
        }

		$model = NewsfeedMention::find()
            ->alias('t')
            ->where(['newsfeed_id' => $this->id]);
        if ($publish == 0) {
            $model->unpublish();
        } else if ($publish == 1) {
            $model->published();
        } else if ($publish == 2) {
            $model->deleted();
        }
		$mentions = $model->count();

		return $mentions ? $mentions : 0;
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getSpecifics($count=false)
	{
        if ($count == false) {
            return $this->hasMany(NewsfeedSpecific::className(), ['newsfeed_id' => 'id']);
        }

		$model = NewsfeedSpecific::find()
            ->alias('t')
            ->where(['newsfeed_id' => $this->id]);
		$specifics = $model->count();

		return $specifics ? $specifics : 0;
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
	 * @return \ommu\newsfeed\models\query\Newsfeeds the active query used by this AR class.
	 */
	public static function find()
	{
		return new \ommu\newsfeed\models\query\Newsfeeds(get_called_class());
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
		$this->templateColumns['app'] = [
			'attribute' => 'app',
			'value' => function($model, $key, $index, $column) {
				return $model->app;
			},
		];
		$this->templateColumns['memberDisplayname'] = [
			'attribute' => 'memberDisplayname',
			'value' => function($model, $key, $index, $column) {
                $memberDisplayname = isset($model->member) ? $model->member->displayname : '-';
                $userDisplayname = isset($model->user) ? $model->user->displayname : '-';
                if ($userDisplayname != '-' && $memberDisplayname != $userDisplayname) {
                    return $memberDisplayname.'<br/>'.$userDisplayname;
                }
                return $memberDisplayname;
				// return $model->memberDisplayname;
			},
            'format' => 'html',
			'visible' => !Yii::$app->request->get('member') ? true : false,
		];
		$this->templateColumns['newsfeed_type'] = [
			'attribute' => 'newsfeed_type',
			'value' => function($model, $key, $index, $column) {
                $newsfeedType = $model->newsfeed_type ? $model->newsfeed_type : 'text';
                return $model::getType($newsfeedType);
			},
            'filter' => self::getType(),
            'contentOptions' => ['class' => 'text-center'],
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
                if (is_array($model->newsfeed_param) && empty($model->newsfeed_param)) {
                    return '-';
                }
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
				return Html::a($comments, ['comment/manage', 'newsfeed' => $model->primaryKey, 'publish' => 1], ['title' => Yii::t('app', '{count} comments', ['count' => $comments]), 'data-pjax' => 0]);
			},
			'filter' => false,
			'contentOptions' => ['class' => 'text-center'],
			'format' => 'raw',
		];
		$this->templateColumns['likes'] = [
			'attribute' => 'likes',
			'value' => function($model, $key, $index, $column) {
				$likes = $model->getLikes(true);
				return Html::a($likes, ['like/manage', 'newsfeed' => $model->primaryKey, 'publish' => 1], ['title' => Yii::t('app', '{count} likes', ['count' => $likes]), 'data-pjax' => 0]);
			},
			'filter' => false,
			'contentOptions' => ['class' => 'text-center'],
			'format' => 'raw',
		];
		$this->templateColumns['mentions'] = [
			'attribute' => 'mentions',
			'value' => function($model, $key, $index, $column) {
				$mentions = $model->getMentions(true);
				return Html::a($mentions, ['mention/manage', 'newsfeed' => $model->primaryKey, 'publish' => 1], ['title' => Yii::t('app', '{count} mentions', ['count' => $mentions]), 'data-pjax' => 0]);
			},
			'filter' => false,
			'contentOptions' => ['class' => 'text-center'],
			'format' => 'raw',
		];
		$this->templateColumns['specifics'] = [
			'attribute' => 'specifics',
			'value' => function($model, $key, $index, $column) {
				$specifics = $model->getSpecifics(true);
				return Html::a($specifics, ['specific/manage', 'newsfeed' => $model->primaryKey], ['title' => Yii::t('app', '{count} specifics', ['count' => $specifics]), 'data-pjax' => 0]);
			},
			'filter' => false,
			'contentOptions' => ['class' => 'text-center'],
			'format' => 'raw',
		];
		$this->templateColumns['privacy'] = [
			'attribute' => 'privacy',
			'value' => function($model, $key, $index, $column) {
                if (!$model->privacy) {
                    return '-';
                }
				return $model::getPrivacy($model->privacy);
			},
			'filter' => self::getPrivacy(),
			'contentOptions' => ['class' => 'text-center'],
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
	 * function getPrivacy
	 */
	public static function getPrivacy($value=null)
	{
		$items = array(
			1 => Yii::t('app', 'Everyone'),
			2 => Yii::t('app', 'All Registered Users'),
			5 => Yii::t('app', 'Only My Friends'),
			3 => Yii::t('app', 'Friends Except'),
			4 => Yii::t('app', 'Specific Friends'),
			6 => Yii::t('app', 'Only Me'),
			7 => Yii::t('app', 'Custom'),
		);

        if ($value !== null) {
            return $items[$value];
        } else {
            return $items;
        }
	}

    /**
     * function getType
     */
    public static function getType($value=null)
    {
        $items = array(
            'text' => Yii::t('app', 'Text (default)'),
            'album' => Yii::t('app', 'Album Photo'),
            'link' => Yii::t('app', 'Share Link'),
            'vacancy' => Yii::t('app', 'Vacancy'),
        );

        if ($value !== null) {
            return $items[$value];
        }  else {
            return $items;
        }
    }

    /**
     * function setMentions
     */
    public function setMentions()
    {
        preg_match_all('#@([\\d\\w_.-]+)#', $this->newsfeed_post, $mentions, PREG_SET_ORDER);

        $return = [];
        if (!empty($mentions)) {
            if (!$this->isNewRecord) {
                $oldMentions = $this->oldMentions;
            }

            foreach ($mentions as $key => $val) {
                if ($this->isNewRecord) {
                    $return[$val[1]] = Members::getMemberUserId($val[1]);
                } else {
                    if (array_key_exists($key, $oldMentions)) {
                        $return[$val[1]] = $oldMentions($val[1]);
                    } else {
                        $return[$val[1]] = Members::getMemberUserId($val[1]);
                    }
                }
            }
        }

        $this->mentions = $return;

        return $return;
    }

	/**
	 * after find attributes
	 */
	public function afterFind()
	{
		parent::afterFind();

        if ($this->newsfeed_param == '') {
            $this->newsfeed_param = [];
        } else {
            $this->newsfeed_param = Json::decode($this->newsfeed_param);
        }

        if (isset($this->newsfeed_param['mention'])) {
            $this->oldMentions = $this->newsfeed_param['mention'];
        }
		// $this->memberDisplayname = isset($this->member) ? $this->member->displayname : '-';
		// $this->creationDisplayname = isset($this->creation) ? $this->creation->displayname : '-';
		// $this->modifiedDisplayname = isset($this->modified) ? $this->modified->displayname : '-';
		// $this->updatedDisplayname = isset($this->updated) ? $this->updated->displayname : '-';
	}

	/**
	 * before validate attributes
	 */
	public function beforeValidate()
	{
        if (parent::beforeValidate()) {
			$this->setMentions();
            if ($this->isNewRecord) {
                if ($this->user_id == null) {
                    $this->user_id = !Yii::$app->user->isGuest ? Yii::$app->user->id : null;
                }

                if ($this->creation_id == null) {
                    $this->creation_id = !Yii::$app->user->isGuest ? Yii::$app->user->id : null;
                }
            } else {
                if ($this->modified_id == null) {
                    $this->modified_id = !Yii::$app->user->isGuest ? Yii::$app->user->id : null;
                }

                if ($this->updated_id == null) {
                    $this->updated_id = !Yii::$app->user->isGuest ? Yii::$app->user->id : null;
                }
            }
        }
        return true;
	}

        /**
         * before save attributes
         */
        public function beforeSave($insert)
        {
            if (parent::beforeSave($insert)) {
                // set and change mentions
            if ($insert && !is_array($this->newsfeed_param)) {
                $this->newsfeed_param = [];
            }

            // set mentions
            if (!empty(($mentions = $this->mentions))) {
                if (isset($this->newsfeed_param['mention'])) {
                    unset($this->newsfeed_param['mention']);
                }
                $this->newsfeed_param = ['mention' => $mentions];
            } else {
                unset($this->newsfeed_param['mention']);
            }

            // set newsfeed param in json data
            if (is_array($this->newsfeed_param))
            	$this->newsfeed_param = Json::encode($this->newsfeed_param);
        }

        return true;
    }

    /**
     * After save attributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if ($insert) {
            // set mentions
            if (!empty(($mentions = $this->mentions))) {
                foreach ($mentions as $key => $val) {
                    if ($val['member_id'] != '') {
                        $model = new NewsfeedMention();
                        $model->newsfeed_id = $this->id;
                        $model->member_id = $val['member_id'];
                        if ($val['user_id'] != '') {
                            $model->user_id = $val['user_id'];
                        }
                        $model->save();
                    }
                }
            }

        } else {
            // insert difference mentions
            $oldMentions = $this->oldMentions;
            if (!empty(($mentions = $this->mentions))) {
                foreach ($mentions as $key => $val) {
                    if (array_key_exists($key, $oldMentions)) {
                        unset($oldMentions[$key]);
                        continue;
                    }

                    if ($val['member_id'] != '') {
                        $model = new NewsfeedMention();
                        $model->newsfeed_id = $this->id;
                        $model->member_id = $val['member_id'];
                        if ($val['user_id'] != '') {
                            $model->user_id = $val['user_id'];
                        }
                        $model->save();
                    }
                }
            }

            // drop difference mentions
            if (!empty($oldMentions)) {
                foreach ($oldMentions as $key => $val) {
                    $data = NewsfeedMention::find()
                        ->select(['id'])
                        ->where(['newsfeed_id' => $this->id, 'member_id' => $val['member_id']])
                        ->one();
                    if ($data) {
                        $data->delete();
                    }
                }
            }
        }
    }
}
