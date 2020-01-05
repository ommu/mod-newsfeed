<?php
/**
 * NewsfeedMention
 *
 * This is the ActiveQuery class for [[\app\modules\newsfeed\models\NewsfeedMention]].
 * @see \app\modules\newsfeed\models\NewsfeedMention
 * 
 * @author Putra Sudaryanto <putra@ommu.co>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2020 Ommu Platform (www.ommu.co)
 * @created date 5 January 2020, 23:14 WIB
 * @link https://www.ommu.co
 *
 */

namespace app\modules\newsfeed\models\query;

class NewsfeedMention extends \yii\db\ActiveQuery
{
	/*
	public function active()
	{
		return $this->andWhere('[[status]]=1');
	}
	*/

	/**
	 * {@inheritdoc}
	 * @return \app\modules\newsfeed\models\NewsfeedMention[]|array
	 */
	public function all($db = null)
	{
		return parent::all($db);
	}

	/**
	 * {@inheritdoc}
	 * @return \app\modules\newsfeed\models\NewsfeedMention|array|null
	 */
	public function one($db = null)
	{
		return parent::one($db);
	}
}
