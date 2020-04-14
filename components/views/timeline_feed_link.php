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

<!-- Type : Careernews small image -->
<div id="posting-4" class="post-content box-shadow bg-white rounded mb-4">
    <?php echo TimelineAuthor::widget([
        'model' => $member,
        'postDate' => $model->creation_date,
    ]);?>

    <div class="post-text border-bottom p-2 mx-2">
        <p>Share link careernews dengan gambar kecil. <a href="">@juraganAyam</a> Lorem Ipsum is simply dummy text.</p>
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
        <a class="modal-btn mr-2 text-muted" data-target="#modallike" href="<?php echo Url::base();?>/newsfeed/site/postlike"><small>8 Reaction</small></a><a href="javascript:void(0);" onclick="lastComment(this);"><small>0 Komentar</small></a>
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
        <div class="post-comment d-flex p-3">
            <div class="profile-photo"><a href=""><img class="rounded-circle" src="<?php echo Url::base();?>/public/profile/rudi-gundul.png" alt="rudi-gundul.png" /></a></div>
            <div class="pl-3 w-100 comment-area">
                <div class="input-area">
                    <textarea id="comment-2-1" class="form-control" rows="1" placeholder="Add comment here"></textarea>
                    <input type="file" name="commentimage-2-1" id="commentimage-2-1" class="input-img-comment" onchange="readURLimg(this);"/>
                    <label for="commentimage-2-1"><i class="far fa-image"></i></label>
                </div>
                <div class="posting-btn text-right d-block mt-2">
                    <button type="submit" class="btn btn-xs btn-default text-white orange" onclick="postComment(this);">POST</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Type : Careernews large image -->
<div id="posting-5" class="post-content box-shadow bg-white rounded mb-4">
    <?php echo TimelineAuthor::widget([
        'model' => $member,
        'postDate' => $model->creation_date,
    ]);?>

    <div class="post-text border-bottom p-2 mx-2">
        <p>Share link careernews dengan gambar besar. <a href="">@juraganAyam</a> Lorem Ipsum is simply dummy text.</p>
        <div class="bg-light share-cn">
            <a href="" target="_blank"><img class="w-100" src="<?php echo Url::base();?>/public/article/media/1508825782_articles-2.jpg" alt="1508825782_articles-2.jpg" /></a>
            <div class="p-2">
                <a class="w-100" href="" target="_blank"><h5 class="font-weight-bold txt-orange text-truncate mb-1">Lorem ipsum dolor sit amet consectetur, adipisicing elit.</h5></a>
                <p class="mb-1">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repudiandae numquam veritatis sequi ex expedita non harum.</p>
                <a class="text-truncate text-primary w-100" href="https://careernews.id/event/view/4987-Kalau-Kamu-Sabar-Jeli-Jemput-Karier-Impianmu-Tinggal-Selangkah-Lagi-1" target="_blank">https://careernews.id/event/view/4987-Kalau-Kamu-Sabar-Jeli-Jemput-Karier-Impianmu-Tinggal-Selangkah-Lagi-1</a>
            </div>
        </div>
        <a class="modal-btn mr-2 text-muted" data-target="#modallike" href="<?php echo Url::base();?>/newsfeed/site/postlike"><small>8 Reaction</small></a><a href="javascript:void(0);" onclick="lastComment(this);"><small>0 Komentar</small></a>
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
        <div class="post-comment d-flex p-3">
            <div class="profile-photo"><a href=""><img class="rounded-circle" src="<?php echo Url::base();?>/public/profile/rudi-gundul.png" alt="rudi-gundul.png" /></a></div>
            <div class="pl-3 w-100 comment-area">
                <div class="input-area">
                    <textarea id="comment-2-1" class="form-control" rows="1" placeholder="Add comment here"></textarea>
                    <input type="file" name="commentimage-2-1" id="commentimage-2-1" class="input-img-comment" onchange="readURLimg(this);"/>
                    <label for="commentimage-2-1"><i class="far fa-image"></i></label>
                </div>
                <div class="posting-btn text-right d-block mt-2">
                    <button type="submit" class="btn btn-xs btn-default text-white orange" onclick="postComment(this);">POST</button>
                </div>
            </div>
        </div>
    </div>
</div>
