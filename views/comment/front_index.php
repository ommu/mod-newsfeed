<?php
/**
 * Newsfeed Comments (newsfeed-comment)
 * @var $this app\components\View
 * @var $this app\modules\newsfeed\controllers\CommentController
 * @var $model app\modules\newsfeed\models\NewsfeedComment
 *
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2020 OMMU (www.ommu.id)
 * @created date 21 February 2020, 12:58 WIB
 * @link https://github.com/ommu/mod-newsfeed
 *
 */

use yii\helpers\Html;
use yii\helpers\Url;

$model = array_reverse($dataProvider->getModels());
$pager = $dataProvider->getPagination();

$nextPager = false;
$pageCount = $page * $pager->pageSize;
if ($pageCount < $dataProvider->totalCount) {
    $nextPager = true;
}

if ($nextPager == true) {?>
    <div class="post-comment p-1 bg-light prev-comment text-center">
        <a class="btn-sm text-primary" href="<?php echo Url::to(['index', 'newsfeed' => $newsfeed, 'page' => ($page + 1)]);?>"><small><?php echo Yii::t('app', 'See previous comment');?>&nbsp;<i class="fas fa-chevron-down"></i></small></a>
    </div>
<?php }

foreach ($model as $val) {
    echo $this->render('/comment/front_view', [
        'model' => $val,
    ]);
}?>