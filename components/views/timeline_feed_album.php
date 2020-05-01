<?php
/**
 * TimelineFeeds
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

<!-- Type : Post mention image -->
<div id="posting-2" class="post-content box-shadow bg-white rounded mb-4">
    <?php echo TimelineAuthor::widget([
        'model' => $member,
        'postDate' => $model->creation_date,
    ]);?>

    <div class="post-text border-bottom p-2 mx-2">
        <?php echo $newsfeedPost;?>
        <div class="clearfix mb-3"></div>
        <img class="mb-2 w-100" src="<?php echo Url::base();?>/public/article/media/1508825782_articles-2.jpg" alt="1508825782_articles-2.jpg" />
        <a class="modal-btn mr-2 text-muted" data-target="#modallike" href="<?php echo Url::base();?>/newsfeed/site/postlike"><small>8 Reaction</small></a>
        <a class="text-muted" href="javascript:void(0);" onclick="lastComment(this);"><small>10 Komentar</small></a>
    </div>
    <?php echo FeedOption::widget();?>
    <?php echo FeedComments::widget();?>
</div>

<!-- Type : Post image -->
<div id="posting-2" class="post-content box-shadow bg-white rounded mb-4">
    <?php echo TimelineAuthor::widget([
        'model' => $member,
        'postDate' => $model->creation_date,
    ]);?>

    <div class="post-text border-bottom p-2 mx-2">
        <img class="mb-2 w-100" src="<?php echo Url::base();?>/public/article/media/1508825782_articles-2.jpg" alt="1508825782_articles-2.jpg" />
        <p>Posting image with text. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's  standard dummy text</p>
        <a class="modal-btn mr-2 text-muted" data-target="#modallike" href="<?php echo Url::base();?>/newsfeed/site/postlike"><small>8 Reaction</small></a>
        <a class="text-muted" href="javascript:void(0);" onclick="lastComment(this);"><small>10 Komentar</small></a>
    </div>
    <?php echo FeedOption::widget();?>
    <?php echo FeedComments::widget();?>
</div>

<!-- Type : Post multiple image -->
<div id="posting-3" class="post-content box-shadow bg-white rounded mb-4">
    <?php echo TimelineAuthor::widget([
        'model' => $member,
        'postDate' => $model->creation_date,
    ]);?>

    <div class="post-text border-bottom p-2 mx-2">
        <?php echo $newsfeedPost;?>
        <div class="clearfix mb-3"></div>
        <!-- image size : 800 x 600 / 480 x 360 -->
        <!-- 2 image -->
        <div class="row multiimage">
            <div class="col-6 p-0">
                <a href="">
                    <img class="w-100" src="<?php echo Url::base();?>/public/event/event-banner-1.jpg" alt="event-banner-1.jpg" />
                </a>
            </div>
            <div class="col-6 p-0">
                <a href="">
                    <img class="w-100" src="<?php echo Url::base();?>/public/event/event-banner-2.jpg" alt="event-banner-2.jpg" />
                </a>
            </div>
        </div>
        <br/>
        <!-- 3 image -->
        <div class="row multiimage">
            <div class="col-8 p-0">
                <a href="">
                    <img class="w-100" src="<?php echo Url::base();?>/public/event/event-banner-1.jpg" alt="event-banner-1.jpg" />
                </a>
            </div>
            <div class="col-4 p-0">
                <a href="">
                    <img class="w-100" src="<?php echo Url::base();?>/public/event/event-banner-2.jpg" alt="event-banner-2.jpg" />
                </a>
                <a href="">
                    <img class="w-100" src="<?php echo Url::base();?>/public/event/event-banner-3.jpg" alt="event-banner-3.jpg" />
                </a>
            </div>
        </div>
        <br/>
        <!-- 4 image -->
        <div class="row multiimage">
            <div class="col-6 p-0">
                <a href="">
                    <img class="w-100" src="<?php echo Url::base();?>/public/event/event-banner-1.jpg" alt="event-banner-1.jpg" />
                </a>
                <a href="">
                    <img class="w-100" src="<?php echo Url::base();?>/public/event/event-banner-2.jpg" alt="event-banner-2.jpg" />
                </a>
            </div>
            <div class="col-6 p-0">
                <a href="">
                    <img class="w-100" src="<?php echo Url::base();?>/public/event/event-banner-2.jpg" alt="event-banner-2.jpg" />
                </a>
                <a href="">
                    <img class="w-100" src="<?php echo Url::base();?>/public/event/event-banner-3.jpg" alt="event-banner-3.jpg" />
                </a>
            </div>
        </div>
        <br/>
        <!-- 5 image -->
        <div class="row multiimage">
            <div class="col-6 p-0">
                <a href="">
                    <img class="w-100" src="<?php echo Url::base();?>/public/event/event-banner-1.jpg" alt="event-banner-1.jpg" />
                </a>
            </div>
            <div class="col-6 p-0">
                <a href="">
                    <img class="w-100" src="<?php echo Url::base();?>/public/event/event-banner-2.jpg" alt="event-banner-2.jpg" />
                </a>
            </div>
        </div>
        <div class="row multiimage">
            <div class="col-4 p-0">
                <a href="">
                    <img class="w-100" src="<?php echo Url::base();?>/public/event/event-banner-2.jpg" alt="event-banner-2.jpg" />
                </a>
            </div>
            <div class="col-4 p-0">
                <a href="">
                    <img class="w-100" src="<?php echo Url::base();?>/public/event/event-banner-3.jpg" alt="event-banner-3.jpg" />
                </a>
            </div>
            <div class="col-4 p-0">
                <a href="">
                    <img class="w-100" src="<?php echo Url::base();?>/public/event/event-banner-1.jpg" alt="event-banner-1.jpg" />
                </a>
            </div>
        </div>
        <br/>
        <!-- more than 5 image -->
        <div class="row multiimage">
            <div class="col-6 p-0">
                <a href="">
                    <img class="w-100" src="<?php echo Url::base();?>/public/event/event-banner-1.jpg" alt="event-banner-1.jpg" />
                </a>
            </div>
            <div class="col-6 p-0">
                <a href="">
                    <img class="w-100" src="<?php echo Url::base();?>/public/event/event-banner-2.jpg" alt="event-banner-2.jpg" />
                </a>
            </div>
        </div>
        <div class="row multiimage">
            <div class="col-4 p-0">
                <a href="">
                    <img class="w-100" src="<?php echo Url::base();?>/public/event/event-banner-2.jpg" alt="event-banner-2.jpg" />
                </a>
            </div>
            <div class="col-4 p-0">
                <a href="">
                    <img class="w-100" src="<?php echo Url::base();?>/public/event/event-banner-3.jpg" alt="event-banner-3.jpg" />
                </a>
            </div>
            <div class="col-4 p-0 moreimages">
                <a href="">
                    <span><span>+3</span></span>
                    <img class="w-100" src="<?php echo Url::base();?>/public/event/event-banner-1.jpg" alt="event-banner-1.jpg" />
                </a>
            </div>
        </div>
        <br/>
        <a class="modal-btn mr-2 text-muted" data-target="#modallike" href="<?php echo Url::base();?>/newsfeed/site/postlike"><small>8 Reaction</small></a><a href="javascript:void(0);" onclick="lastComment(this);"><small>0 Komentar</small></a>
    </div>
    <?php echo FeedOption::widget();?>
    <?php echo FeedComments::widget();?>
</div>