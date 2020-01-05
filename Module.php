<?php
/**
 * newsfeed module definition class
 *
 * @author Putra Sudaryanto <putra@ommu.co>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2020 Ommu Platform (www.ommu.co)
 * @created date 5 January 2020, 23:14 WIB
 * @link https://www.ommu.co
 *
 */

namespace app\modules\newsfeed;

use Yii;

class Module extends \app\components\Module
{
	public $layout = 'main';

	/**
	 * {@inheritdoc}
	 */
	public $controllerNamespace = 'app\modules\newsfeed\controllers';

	/**
	 * {@inheritdoc}
	 */
	public function init()
	{
		parent::init();

		// custom initialization code goes here
	}
}
