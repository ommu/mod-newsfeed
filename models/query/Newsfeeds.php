<?php
/**
 * Newsfeeds
 *
 * This is the ActiveQuery class for [[\ommu\newsfeed\models\Newsfeeds]].
 * @see \ommu\newsfeed\models\Newsfeeds
 * 
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2020 OMMU (www.ommu.id)
 * @created date 5 January 2020, 23:13 WIB
 * @link https://github.com/ommu/mod-newsfeed
 *
 */

namespace ommu\newsfeed\models\query;

class Newsfeeds extends \yii\db\ActiveQuery
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
	 * @return \ommu\newsfeed\models\Newsfeeds[]|array
	 */
	public function all($db = null)
	{
		return parent::all($db);
	}

	/**
	 * {@inheritdoc}
	 * @return \ommu\newsfeed\models\Newsfeeds|array|null
	 */
	public function one($db = null)
	{
		return parent::one($db);
	}
}
