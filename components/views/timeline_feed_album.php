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

<!-- Type : Post image -->
<div id="posting-2" class="post-content box-shadow bg-white rounded mb-4">
    <?php echo TimelineAuthor::widget([
        'model' => $member,
        'postDate' => $model->creation_date,
    ]);?>

    <div class="post-text border-bottom p-2 mx-2">
        <img class="mb-2 w-100" src="<?php echo Url::base();?>/public/article/media/1508825782_articles-2.jpg" alt="1508825782_articles-2.jpg" />
        <p>Posting image with text. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's  standard dummy text</p>
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