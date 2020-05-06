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

<!-- Type : Post text -->
<div id="posting-1" class="post-content box-shadow bg-white rounded mb-4">
    <?php echo TimelineAuthor::widget([
        'model' => $member,
        'postDate' => $model->creation_date,
    ]);?>

    <div class="post-text border-bottom p-2 mx-2">
        <?php if ($newsfeedPost) {
            echo $newsfeedPost;?>
            <div class="clearfix mb-3"></div>
        <?php }?>
        <a class="modal-btn mr-2 text-muted" data-target="#modallike" href="<?php echo Url::base();?>/newsfeed/site/postlike"><small><?php echo Yii::t('app', '{react} Reaction', ['react' => $model->likes]);?></small></a>
        <a class="text-muted" href="javascript:void(0);" onclick="lastComment(this);"><small><?php echo Yii::t('app', '{comment} Comment', ['comment' => $model->comments]);?></small></a>
    </div>
    <?php echo FeedOption::widget();?>
    <?php echo FeedComments::widget([
        'comment' => $model->comments ? true : false,
        'newsfeedId' => $model->id,
    ]);?>
</div>