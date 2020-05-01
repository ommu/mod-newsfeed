<?php
/**
 * TimelineFeeds
 * @var $this app\components\View
 * @var $this app\modules\newsfeed\components\FeedComments
 *
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2020 OMMU (www.ommu.id)
 * @created date 18 February 2020, 00:22 WIB
 * @link https://github.com/ommu/mod-newsfeed
 *
 */

use yii\helpers\Url;
?>

<div class="comments-box">
    <div class="post-comment p-1 bg-light prev-comment text-center">
        <button type="button" class="btn btn-sm text-primary btn-link" onclick="lastComment(this);"><small>See previous comment&nbsp;<i class="fas fa-chevron-down"></i></small></button>
    </div>
    <div class="post-comment d-flex p-3">
        <div class="profile-photo"><a href=""><img class="rounded-circle" src="<?php echo Url::base();?>/public/profile/rudi-gundul.png" alt="rudi-gundul.png" /></a></div>
        <div class="px-3">
            <h5 class="mb-1"><a href=""><strong>Muhammad adi</strong></a></h5>
            <p>Aku g pahan maksudmu iku apa loren ipsum?? geje</p>
        </div>
        <div class="ml-auto text-muted text-nowrap option">
            <span class="pr-3">3h ago</span>
            <div class="d-inline-block option-menu position-relative">
                <a href="javascript:void(0);"><i class="fas fa-ellipsis-h"></i></a>
                <div class="position-absolute">
                    <a href="">Delete</a>
                    <a href="">Block</a>
                </div>
            </div>
        </div>
    </div>
    <div class="post-comment d-flex p-3">
        <div class="profile-photo"><a href=""><img class="rounded-circle" src="<?php echo Url::base();?>/public/profile/rudi-gundul.png" alt="rudi-gundul.png" /></a></div>
        <div class="px-3">
            <h5 class="mb-1"><a href=""><strong>Muhammad adi</strong></a></h5>
            <p>Monggo yang minat lolohan burung: prenjak tamu, pentet, ciblek sawah, kacer Bali dan tengkek paruh hitam.</p>
        </div>
        <div class="ml-auto text-muted text-nowrap option">
            <span class="pr-3">24m ago</span>
            <div class="d-inline-block option-menu position-relative">
                <a href="javascript:void(0);"><i class="fas fa-ellipsis-h"></i></a>
                <div class="position-absolute">
                    <a href="">Delete</a>
                    <a href="">Block</a>
                </div>
            </div>
        </div>
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