<?php
/**
 * TimelineFeeds
 * @var $this app\components\View
 * @var $this app\modules\newsfeed\components\TimelineFeeds
 *
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2020 OMMU (www.ommu.id)
 * @created date 12 February 2020, 14:30 WIB
 * @link https://github.com/ommu/mod-newsfeed
 *
 */

use yii\helpers\Url;
use app\themes\upgradid\assets\UpgradidAsset;
use \app\modules\newsfeed\components\TimelineFeedPost;
use \app\modules\newsfeed\components\TimelineFeedContent;
use yii\widgets\Pjax;
use app\components\widgets\ListView;

$urlAsset = UpgradidAsset::register($this);
?>

<?php if (Yii::$app->params['app_version'] == 'alpha') {?>
<div class="news-feed">
    <?php echo TimelineFeedPost::widget();

    Pjax::begin();

    echo ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            $index++;
            echo TimelineFeedContent::widget([
                'type' => $model->newsfeed_type,
                'model' => $model,
            ]);
            if ($index == 4) {
                echo TimelineFeedContent::widget([
                    'type' => 'ads',
                    'model' => $model,
                ]);
            }
        },
    ]);

    Pjax::end(); ?>
</div>
<div class="loading-feed"></div>
<div class="page-load-status p-2">
	<p class="infinite-scroll-last text-center">End of content</p>
	<p class="infinite-scroll-error text-center">No more pages to load</p>
</div>
<?php } else { ?>
	<h2 class="title text-center txt-orange py-5 bg-white box-shadow"><i class="fas fa-wrench mr-3"></i>UNDER CONSTRUCTION</h2>
<?php } ?>