<?php
/**
 * SpecificController
 * @var $this app\modules\newsfeed\controllers\admin\SpecificController
 * @var $model app\modules\newsfeed\models\NewsfeedSpecific
 *
 * SpecificController implements the CRUD actions for NewsfeedSpecific model.
 * Reference start
 * TOC :
 *	Index
 *	Manage
 *	View
 *	Delete
 *
 *	findModel
 *
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2020 OMMU (www.ommu.id)
 * @created date 6 January 2020, 13:10 WIB
 * @link https://github.com/ommu/mod-newsfeed
 *
 */

namespace app\modules\newsfeed\controllers\admin;

use Yii;
use app\components\Controller;
use mdm\admin\components\AccessControl;
use yii\filters\VerbFilter;
use app\modules\newsfeed\models\NewsfeedSpecific;
use app\modules\newsfeed\models\search\NewsfeedSpecific as NewsfeedSpecificSearch;

class SpecificController extends Controller
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
	 * Lists all NewsfeedSpecific models.
	 * @return mixed
	 */
	public function actionManage()
	{
		$searchModel = new NewsfeedSpecificSearch();
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
            $newsfeed = \app\modules\newsfeed\models\Newsfeeds::findOne($newsfeed);
        }

		$this->view->title = Yii::t('app', 'Specifics');
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
	 * Displays a single NewsfeedSpecific model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id)
	{
		$model = $this->findModel($id);
        $this->subMenuParam = $model->newsfeed_id;

		$this->view->title = Yii::t('app', 'Detail Specific: {newsfeed-id}', ['newsfeed-id' => $model->newsfeed->id]);
		$this->view->description = '';
		$this->view->keywords = '';
		return $this->oRender('admin_view', [
			'model' => $model,
		]);
	}

	/**
	 * Deletes an existing NewsfeedSpecific model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$model = $this->findModel($id);
		$model->delete();

		Yii::$app->session->setFlash('success', Yii::t('app', 'Newsfeed specific success deleted.'));
		return $this->redirect(Yii::$app->request->referrer ?: ['manage']);
	}

	/**
	 * Finds the NewsfeedSpecific model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return NewsfeedSpecific the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if(($model = NewsfeedSpecific::findOne($id)) !== null)
			return $model;

		throw new \yii\web\NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
	}
}