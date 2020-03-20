<?php
/**
 * NewsfeedComment
 *
 * This is the ActiveQuery class for [[\app\modules\newsfeed\models\NewsfeedComment]].
 * @see \app\modules\newsfeed\models\NewsfeedComment
 * 
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2020 OMMU (www.ommu.id)
 * @created date 5 January 2020, 23:14 WIB
 * @link https://github.com/ommu/mod-newsfeed
 *
 */

namespace app\modules\newsfeed\models\query;

class NewsfeedComment extends \yii\db\ActiveQuery
{
	/*
	public function active()
	{
		return $this->andWhere('[[status]]=1');
	}
	*/

	/**
	 * {@inheritdoc}
	 */
	public function published() 
	{
		return $this->andWhere(['t.publish' => 1]);
	}

	/**
	 * {@inheritdoc}
	 */
	public function unpublish() 
	{
		return $this->andWhere(['t.publish' => 0]);
	}

	/**
	 * {@inheritdoc}
	 */
	public function deleted() 
	{
		return $this->andWhere(['t.publish' => 2]);
	}

	/**
	 * {@inheritdoc}
	 * @return \app\modules\newsfeed\models\NewsfeedComment[]|array
	 */
	public function all($db = null)
	{
		return parent::all($db);
	}

	/**
	 * {@inheritdoc}
	 * @return \app\modules\newsfeed\models\NewsfeedComment|array|null
	 */
	public function one($db = null)
	{
		return parent::one($db);
	}
}
