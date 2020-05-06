<?php
/**
 * TimelineFeedContent
 * @var $this app\components\View
 * @var $this app\modules\newsfeed\components\TimelineFeedContent
 *
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2020 OMMU (www.ommu.id)
 * @created date 12 February 2020, 15:10 WIB
 * @link https://github.com/ommu/mod-newsfeed
 *
 */

use yii\helpers\Url;
use app\modules\newsfeed\components\TimelineAuthor;
use app\modules\newsfeed\components\FeedOption;
use app\modules\newsfeed\components\FeedComments;
?>

<!-- Type : Careernews small image -->
<div id="posting-4" class="post-content box-shadow bg-white rounded mb-4">
    <?php echo TimelineAuthor::widget([
        'model' => $member,
        'postDate' => $model->creation_date,
    ]);?>

    <div class="post-text border-bottom p-2 mx-2">
        <?php if ($newsfeedPost) {
            echo $newsfeedPost;?>
            <div class="clearfix mb-3"></div>
        <?php }?>
        <div class="row bg-light m-0 share-cn">
            <div class="col-3 p-2">
                <a href="" target="_blank"><img class="w-100" src="<?php echo Url::base();?>/public/article/media/1508825782_articles-2.jpg" alt="1508825782_articles-2.jpg" /></a>
            </div>
            <div class="col-9 p-2">
                <a class="w-100" href="" target="_blank"><h5 class="font-weight-bold txt-orange text-truncate mb-1">Lorem ipsum dolor sit amet consectetur, adipisicing elit.</h5></a>
                <p class="mb-1">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repudiandae numquam veritatis sequi ex expedita non harum.</p>
                <a class="text-truncate text-primary w-100" href="https://careernews.id/event/view/4987-Kalau-Kamu-Sabar-Jeli-Jemput-Karier-Impianmu-Tinggal-Selangkah-Lagi-1" target="_blank">https://careernews.id/event/view/4987-Kalau-Kamu-Sabar-Jeli-Jemput-Karier-Impianmu-Tinggal-Selangkah-Lagi-1</a>
            </div>
        </div>
        <a class="modal-btn mr-2 text-muted" data-target="#modallike" href="<?php echo Url::base();?>/newsfeed/site/postlike"><small><?php echo Yii::t('app', '{react} Reaction', ['react' => $model->likes]);?></small></a>
        <a class="text-muted" href="javascript:void(0);" onclick="lastComment(this);"><small><?php echo Yii::t('app', '{comment} Comment', ['comment' => $model->comments]);?></small></a>
    </div>
    <?php echo FeedOption::widget();?>
    <?php echo FeedComments::widget([
        'comment' => $model->comments ? true : false,
        'newsfeedId' => $model->id,
    ]);?>
</div>

<!-- Type : Careernews large image -->
<div id="posting-5" class="post-content box-shadow bg-white rounded mb-4">
    <?php echo TimelineAuthor::widget([
        'model' => $member,
        'postDate' => $model->creation_date,
    ]);?>

    <div class="post-text border-bottom p-2 mx-2">
        <?php if ($newsfeedPost) {
            echo $newsfeedPost;?>
            <div class="clearfix mb-3"></div>
        <?php }?>
        <div class="bg-light share-cn">
            <a href="" target="_blank"><img class="w-100" src="<?php echo Url::base();?>/public/article/media/1508825782_articles-2.jpg" alt="1508825782_articles-2.jpg" /></a>
            <div class="p-2">
                <a class="w-100" href="" target="_blank"><h5 class="font-weight-bold txt-orange text-truncate mb-1">Lorem ipsum dolor sit amet consectetur, adipisicing elit.</h5></a>
                <p class="mb-1">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repudiandae numquam veritatis sequi ex expedita non harum.</p>
                <a class="text-truncate text-primary w-100" href="https://careernews.id/event/view/4987-Kalau-Kamu-Sabar-Jeli-Jemput-Karier-Impianmu-Tinggal-Selangkah-Lagi-1" target="_blank">https://careernews.id/event/view/4987-Kalau-Kamu-Sabar-Jeli-Jemput-Karier-Impianmu-Tinggal-Selangkah-Lagi-1</a>
            </div>
        </div>
        <a class="modal-btn mr-2 text-muted" data-target="#modallike" href="<?php echo Url::base();?>/newsfeed/site/postlike"><small><?php echo Yii::t('app', '{react} Reaction', ['react' => $model->likes]);?></small></a>
        <a class="text-muted" href="javascript:void(0);" onclick="lastComment(this);"><small><?php echo Yii::t('app', '{comment} Comment', ['comment' => $model->comments]);?></small></a>
    </div>
    <?php echo FeedOption::widget();?>
    <?php echo FeedComments::widget([
        'comment' => $model->comments ? true : false,
        'newsfeedId' => $model->id,
    ]);?>
</div>
