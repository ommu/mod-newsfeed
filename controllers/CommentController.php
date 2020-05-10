<?php
/**
 * CommentController
 * @var $this app\modules\newsfeed\controllers\CommentController
 * @var $model app\modules\newsfeed\models\NewsfeedComment
 *
 * CommentController implements the CRUD actions for NewsfeedComment model.
 * Reference start
 * TOC :
 *	Index
 *	Create
 *	View
 *	Delete
 *
 *	findModel
 *
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2020 OMMU (www.ommu.id)
 * @created date 21 February 2020, 12:58 WIB
 * @link https://github.com/ommu/mod-newsfeed
 *
 */

namespace app\modules\newsfeed\controllers;

use Yii;
use app\components\Controller;
use mdm\admin\components\AccessControl;
use yii\filters\VerbFilter;
use app\modules\newsfeed\models\NewsfeedComment;
use yii\data\ActiveDataProvider;

class CommentController extends Controller
{
    public static $backoffice = false;

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
        $query = NewsfeedComment::find()
            ->alias('t')
            ->andWhere(['t.publish' => 1]);
        if (($newsfeed = Yii::$app->request->get('newsfeed')) != null) {
            $query->andWhere(['t.newsfeed_id' => $newsfeed]);
        }
        $query->orderBy('t.comment_date DESC, t.id DESC');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 2,
            ],
        ]);

        return $this->oRender('front_index', [
            'dataProvider' => $dataProvider,
            'newsfeed' => $newsfeed,
            'page' => Yii::$app->request->get('page') ? Yii::$app->request->get('page') : 0,
        ]);
    }

    /**
     * Creates a new NewsfeedComment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new NewsfeedComment();
        if (($newsfeed = Yii::$app->request->get('newsfeed')) != null) {
            $model = new NewsfeedComment(['newsfeed_id' => $newsfeed]);
        }

        if(Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            // $postData = Yii::$app->request->post();
            // $model->load($postData);
            // $model->order = $postData['order'] ? $postData['order'] : 0;

            if($model->save()) {
                return $this->oRender('front_view', [
                    'model' => $model,
                ]);

            } else {
                if(Yii::$app->request->isAjax)
                    return \yii\helpers\Json::encode(\app\components\widgets\ActiveForm::validate($model));
            }
        }
    }

    /**
     * Displays a single NewsfeedComment model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->oRender('front_view', [
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

        $return = [
            'status' => 'error',
        ];

        if($model->save(false, ['publish'])) {
            $return = [
                'status' => 'success',
                'type' => 'commentDelete',
            ];
        }

        return \yii\helpers\Json::encode($return);
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
		if(($model = NewsfeedComment::findOne($id)) !== null)
			return $model;

		throw new \yii\web\NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
	}
}