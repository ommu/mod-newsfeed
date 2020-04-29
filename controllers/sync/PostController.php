<?php
/**
 * PostController
 * @var $this app\components\View
 *
 * Reference start
 * TOC :
 *	Index
 *	Text
 *
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2020 OMMU (www.ommu.id)
 * @created date 21 April 2020, 23:27 WIB
 * @link https://github.com/ommu/mod-newsfeed
 *
 */

namespace app\modules\newsfeed\controllers\sync;

use Yii;
use app\components\Controller;
use mdm\admin\components\AccessControl;
use app\modules\newsfeed\models\Newsfeeds;

class PostController extends Controller
{
	/**
	 * {@inheritdoc}
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
			],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function allowAction(): array {
		return [];
	}

	/**
	 * Index Action
	 */
	public function actionIndex()
	{
        throw new \yii\web\NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
	}

	/**
	 * Text Action
	 */
	public function actionText()
	{
        // echo '<pre>';
        // print_r(\ommu\member\models\Members::getMemberUserId('admin_bo'));
        // exit();

        // $model = new Newsfeeds();
        $model = Newsfeeds::findOne(1);
		$model->publish = 1;
		$model->app = Yii::$app->id;
		$model->member_id = 2165;
		$model->user_id = 6;
		$model->privacy = 1;

        // if basic + mentions
		// $model->newsfeed_post = 'hi, kamu..';
        // $model->newsfeed_post = 'hi, kamu.. @admin_bo @s_adminsweeto @krowol @putra.s';
        $model->newsfeed_post = 'hi, kamu.. @admin_bo @s_adminsweeto @putra.s @krowol and @zorano607';

		if(!$model->save()) {
			echo '<pre>';
			print_r($model->getErrors());
		} else
			echo 'success';
	}

}
