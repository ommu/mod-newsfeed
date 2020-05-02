<?php
/**
 * TimelineFeedContent
 * @var $this app\components\View
 * @var $this app\modules\newsfeed\components\TimelineFeedPost
 *
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2020 OMMU (www.ommu.id)
 * @created date 12 February 2020, 15:10 WIB
 * @link https://github.com/ommu/mod-newsfeed
 *
 */

use yii\helpers\Url;
?>

<div id="posting-0" class="post-content box-shadow bg-white rounded mb-4">
    <div class="comments-box create-post">
        <div class="post-comment d-flex p-3">
            <div class="w-100 comment-area">
                <div class="input-area">
                    <textarea id="post-1" class="form-control" rows="1" placeholder="Tulis postingan kamu disini"></textarea>
                </div>
                <div class="posting-btn d-block mt-2">
                    <div class="row align-items-center">
                        <div class="col-md-8 mb-2">
                            <input type="file" name="postfile-1" id="postfile-1" class="input-file-post" onchange="readURLpostfile(this);" href="<?php echo Url::base();?>/newsfeed/site/postdialog" data-target="#modalpost" multiple accept="image/*" />
                            <label for="postfile-1" class="text-muted btn-xs mr-1"><i class="far fa-image mr-1"></i>Image</label>
                            <input type="file" name="postfile-2" id="postfile-2" class="input-file-post" onchange="readURLpostfile(this);" href="<?php echo Url::base();?>/newsfeed/site/postdialog" data-target="#modalpost" multiple accept="video/*,  video/x-m4v, video/webm, video/x-ms-wmv, video/x-msvideo, video/3gpp, video/flv, video/x-flv, video/mp4, video/quicktime, video/mpeg, video/ogv, .ts, .mkv" />
                            <label for="postfile-2" class="text-muted btn-xs mr-1"><i class="fas fa-video mr-1"></i>Video</label>
                            <button type="button" id="share-location" class="modal-btn-post btn btn-xs btn-link text-muted align-baseline" onclick="" data-target="#modalpost" href="<?php echo Url::base();?>/newsfeed/site/postdialog"><i class="fas fa-map-marker-alt mr-1"></i>Location</button>
                            <button type="button" class="btn btn-xs btn-link text-muted align-baseline" onclick=""><i class="fas fa-share-alt mr-1"></i>Share</button>
                        </div>
                        <div class="col-md-4 text-right d-flex justify-content-end">
                            <select class="custom-select mr-1 btn-xs">
                                <option selected>Public</option>
                                <option value="1">Teman</option>
                                <option value="2">Hanya saya</option>
                            </select>
                            <button type="submit" class="btn btn-xs btn-default text-white orange" onclick="">POST</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>