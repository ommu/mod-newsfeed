<?php
/**
 * NewsfeedSpecific
 *
 * This is the ActiveQuery class for [[\app\modules\newsfeed\models\NewsfeedSpecific]].
 * @see \app\modules\newsfeed\models\NewsfeedSpecific
 * 
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2020 OMMU (www.ommu.id)
 * @created date 7 January 2020, 19:05 WIB
 * @link https://github.com/ommu/mod-newsfeed
 *
 */

namespace app\modules\newsfeed\models\query;

class NewsfeedSpecific extends \yii\db\ActiveQuery
{
	/*
	public function active()
	{
		return $this->andWhere('[[status]]=1');
	}
	*/

	/**
	 * {@inheritdoc}
	 * @return \app\modules\newsfeed\models\NewsfeedSpecific[]|array
	 */
	public function all($db = null)
	{
		return parent::all($db);
	}

	/**
	 * {@inheritdoc}
	 * @return \app\modules\newsfeed\models\NewsfeedSpecific|array|null
	 */
	public function one($db = null)
	{
		return parent::one($db);
	}
}