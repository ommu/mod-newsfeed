<?php
/**
 * LikeController
 * @var $this ommu\newsfeed\controllers\admin\LikeController
 * @var $model ommu\newsfeed\models\NewsfeedLike
 *
 * LikeController implements the CRUD actions for NewsfeedLike model.
 * Reference start
 * TOC :
 *	Index
 *	Manage
 *	View
 *	Delete
 *	RunAction
 *
 *	findModel
 *
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2020 OMMU (www.ommu.id)
 * @created date 6 January 2020, 11:31 WIB
 * @link https://github.com/ommu/mod-newsfeed
 *
 */

namespace ommu\newsfeed\controllers\admin;

use Yii;
use app\components\Controller;
use mdm\admin\components\AccessControl;
use yii\filters\VerbFilter;
use ommu\newsfeed\models\NewsfeedLike;
use ommu\newsfeed\models\search\NewsfeedLike as NewsfeedLikeSearch;

class LikeController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        if(Yii::$app->request->get('id') || Yii::$app->request->get('newsfeed')) {
            $this->subMenu = $this->module->params['newsfeed_submenu'];
        }
    }

	/**
	 * {@inheritdoc}
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
			],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['POST'],
				],
			],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function actionIndex()
	{
		return $this->redirect(['manage']);
	}

	/**
	 * Lists all NewsfeedLike models.
	 * @return mixed
	 */
	public function actionManage()
	{
		$searchModel = new NewsfeedLikeSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		$gridColumn = Yii::$app->request->get('GridColumn', null);
		$cols = [];
		if($gridColumn != null && count($gridColumn) > 0) {
			foreach($gridColumn as $key => $val) {
				if($gridColumn[$key] == 1)
					$cols[] = $key;
			}
		}
		$columns = $searchModel->getGridColumn($cols);

        if(($newsfeed = Yii::$app->request->get('newsfeed')) != null) {
            $this->subMenuParam = $newsfeed;
            $newsfeed = \ommu\newsfeed\models\Newsfeeds::findOne($newsfeed);
        }

		$this->view->title = Yii::t('app', 'Likes');
		$this->view->description = '';
		$this->view->keywords = '';
		return $this->render('admin_manage', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
			'columns' => $columns,
			'newsfeed' => $newsfeed,
		]);
	}

	/**
	 * Displays a single NewsfeedLike model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id)
	{
		$model = $this->findModel($id);
        $this->subMenuParam = $model->newsfeed_id;

		$this->view->title = Yii::t('app', 'Detail Like: {newsfeed-id}', ['newsfeed-id' => $model->newsfeed->id]);
		$this->view->description = '';
		$this->view->keywords = '';
		return $this->oRender('admin_view', [
			'model' => $model,
		]);
	}

	/**
	 * Deletes an existing NewsfeedLike model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$model = $this->findModel($id);
		$model->publish = 2;

		if($model->save(false, ['publish'])) {
			Yii::$app->session->setFlash('success', Yii::t('app', 'Newsfeed like success deleted.'));
			return $this->redirect(Yii::$app->request->referrer ?: ['manage']);
		}
	}

	/**
	 * Finds the NewsfeedLike model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return NewsfeedLike the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if(($model = NewsfeedLike::findOne($id)) !== null)
			return $model;

		throw new \yii\web\NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
	}
}