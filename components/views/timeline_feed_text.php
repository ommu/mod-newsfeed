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
use app\themes\upgradid\assets\UpgradidAsset;
use app\modules\newsfeed\components\TimelineAuthor;

$urlAsset = UpgradidAsset::register($this);
?>

<!-- Type : Post text -->
<div id="posting-1" class="post-content box-shadow bg-white rounded mb-4">
    <?php echo TimelineAuthor::widget([
        'model' => $member,
        'postDate' => $model->creation_date,
    ]);?>

    <div class="post-text border-bottom p-2 mx-2">
        <?php echo $model->newsfeed_post;?>
        <div class="clearfix mb-3"></div>
        <a class="modal-btn mr-2 text-muted" data-target="#modallike" href="<?php echo Url::base();?>/newsfeed/site/postlike"><small>8 Reaction</small></a><a href="javascript:void(0);" onclick="lastComment(this);"><small>10 Komentar</small></a>
    </div>
    <div class="post-options d-flex px-3 py-2">
        <div class="option-menu emoticons top position-relative">
            <a href="javascript:void(0);"><img class="align-self-center" src="<?php echo $urlAsset->baseUrl;?>/images/icons/emoticon.png" alt="emoticon.png" /></a>
            <div class="position-absolute rounded">
                <a href="" class="emot-happy"></a>
                <a href="" class="emot-like"></a>
                <a href="" class="emot-laugh"></a>
                <a href="" class="emot-angry"></a>
                <a href="" class="emot-sad"></a>
                <a href="" class="emot-shock"></a>
            </div>
        </div>
        <a class="ml-4 comments-link" href="javascript:void(0);"><img class="align-self-center" src="<?php echo $urlAsset->baseUrl;?>/images/icons/comment.png" alt="comment.png" /></a>
        <div class="ml-4 option-menu position-relative">
            <a href="javascript:void(0);"><img class="align-self-center" src="<?php echo $urlAsset->baseUrl;?>/images/icons/share.png" alt="share.png" /></a>
            <div class="position-absolute">
                <a href="">Share friend</a>
                <a href="">Share</a>
                <a href="">Share as message</a>
            </div>
        </div>
        <div class="ml-auto option-menu position-relative">
            <a href="javascript:void(0);"><i class="fas fa-ellipsis-h"></i></a>
            <div class="position-absolute">
                <a href="">Hide</a>
                <a href="">Block</a>
                <a href="">Unfollow</a>
                <a href="">Report</a>
            </div>
        </div>
    </div>
    <div class="comments-box">
        <div class="post-comment p-1 bg-light prev-comment text-center">
            <button type="button" class="btn btn-sm text-primary btn-link" onclick="lastComment(this);"><small>See previous comment&nbsp;<i class="fas fa-chevron-down"></i></small></button>
        </div>
        <div class="post-comment d-flex p-3">
            <div class="profile-photo"><a href=""><img class="rounded-circle" src="<?php echo Url::base();?>/public/profile/rudi-gundul.png" alt="rudi-gundul.png" /></a></div>
            <div class="pl-3 w-100 comment-area">
                <div class="input-area">
                    <textarea id="comment-1-1" class="form-control" rows="1" placeholder="Add comment here"></textarea>
                    <input type="file" name="commentimage-1-1" id="commentimage-1-1" class="input-img-comment" onchange="readURLimg(this);"/>
                    <label for="commentimage-1-1"><i class="far fa-image"></i></label>
                </div>
                <div class="posting-btn text-right d-block mt-2">
                    <button type="submit" class="btn btn-xs btn-default text-white orange" onclick="postComment(this);">POST</button>
                </div>
            </div>
        </div>
    </div>
</div>