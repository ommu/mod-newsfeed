<?php
/**
 * CommentController
 * @var $this ommu\newsfeed\controllers\admin\CommentController
 * @var $model ommu\newsfeed\models\NewsfeedComment
 *
 * CommentController implements the CRUD actions for NewsfeedComment model.
 * Reference start
 * TOC :
 *	Index
 *	Manage
 *	Update
 *	View
 *	Delete
 *	RunAction
 *
 *	findModel
 *
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2020 OMMU (www.ommu.id)
 * @created date 6 January 2020, 11:32 WIB
 * @link https://github.com/ommu/mod-newsfeed
 *
 */

namespace ommu\newsfeed\controllers\admin;

use Yii;
use app\components\Controller;
use mdm\admin\components\AccessControl;
use yii\filters\VerbFilter;
use ommu\newsfeed\models\NewsfeedComment;
use ommu\newsfeed\models\search\NewsfeedComment as NewsfeedCommentSearch;

class CommentController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        if (Yii::$app->request->get('id') || Yii::$app->request->get('newsfeed')) {
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
	 * Lists all NewsfeedComment models.
	 * @return mixed
	 */
	public function actionManage()
	{
        $searchModel = new NewsfeedCommentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $gridColumn = Yii::$app->request->get('GridColumn', null);
        $cols = [];
        if ($gridColumn != null && count($gridColumn) > 0) {
            foreach ($gridColumn as $key => $val) {
                if ($gridColumn[$key] == 1) {
                    $cols[] = $key;
                }
            }
        }
        $columns = $searchModel->getGridColumn($cols);

        if (($newsfeed = Yii::$app->request->get('newsfeed')) != null) {
            $this->subMenuParam = $newsfeed;
            $newsfeed = \ommu\newsfeed\models\Newsfeeds::findOne($newsfeed);
        }

		$this->view->title = Yii::t('app', 'Comments');
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
	 * Updates an existing NewsfeedComment model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);
        $this->subMenuParam = $model->newsfeed_id;

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            // $postData = Yii::$app->request->post();
            // $model->load($postData);
            // $model->order = $postData['order'] ? $postData['order'] : 0;

            if ($model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Newsfeed comment success updated.'));
                if (!Yii::$app->request->isAjax) {
                    return $this->redirect(['manage']);
                }
                return $this->redirect(Yii::$app->request->referrer ?: ['manage']);

            } else {
                if (Yii::$app->request->isAjax) {
                    return \yii\helpers\Json::encode(\app\components\widgets\ActiveForm::validate($model));
                }
            }
        }

		$this->view->title = Yii::t('app', 'Update Comment: {newsfeed-id}', ['newsfeed-id' => $model->newsfeed->id]);
		$this->view->description = '';
		$this->view->keywords = '';
		return $this->oRender('admin_update', [
			'model' => $model,
		]);
	}

	/**
	 * Displays a single NewsfeedComment model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id)
	{
        $model = $this->findModel($id);
        $this->subMenuParam = $model->newsfeed_id;

		$this->view->title = Yii::t('app', 'Detail Comment: {newsfeed-id}', ['newsfeed-id' => $model->newsfeed->id]);
		$this->view->description = '';
		$this->view->keywords = '';
		return $this->oRender('admin_view', [
			'model' => $model,
		]);
	}

	/**
	 * Deletes an existing NewsfeedComment model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$model = $this->findModel($id);
		$model->publish = 2;

        if ($model->save(false, ['publish'])) {
			Yii::$app->session->setFlash('success', Yii::t('app', 'Newsfeed comment success deleted.'));
			return $this->redirect(Yii::$app->request->referrer ?: ['manage']);
		}
	}

	/**
	 * Finds the NewsfeedComment model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return NewsfeedComment the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
        if (($model = NewsfeedComment::findOne($id)) !== null) {
            return $model;
        }

		throw new \yii\web\NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
	}
}