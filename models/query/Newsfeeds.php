<?php
/**
 * Newsfeeds
 *
 * This is the ActiveQuery class for [[\app\modules\newsfeed\models\Newsfeeds]].
 * @see \app\modules\newsfeed\models\Newsfeeds
 * 
 * @author Putra Sudaryanto <putra@ommu.co>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2020 Ommu Platform (www.ommu.co)
 * @created date 5 January 2020, 23:13 WIB
 * @link https://www.ommu.co
 *
 */

namespace app\modules\newsfeed\models\query;

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
	 * @return \app\modules\newsfeed\models\Newsfeeds[]|array
	 */
	public function all($db = null)
	{
		return parent::all($db);
	}

	/**
	 * {@inheritdoc}
	 * @return \app\modules\newsfeed\models\Newsfeeds|array|null
	 */
	public function one($db = null)
	{
		return parent::one($db);
	}
}
