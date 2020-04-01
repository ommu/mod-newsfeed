<?php
/**
 * Newsfeeds (newsfeeds)
 * @var $this app\components\View
 * @var $this app\modules\newsfeed\controllers\admin\PostController
 * @var $model app\modules\newsfeed\models\Newsfeeds
 * @var $form app\components\widgets\ActiveForm
 *
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2020 OMMU (www.ommu.id)
 * @created date 6 January 2020, 11:30 WIB
 * @link https://github.com/ommu/mod-newsfeed
 *
 */

use yii\helpers\Url;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Newsfeeds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id'=>$model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<div class="newsfeeds-update">

<?php echo $this->render('_form', [
	'model' => $model,
]); ?>

</div>