<?php
/**
 * TimelineFeeds
 * @var $this app\components\View
 * @var $this app\modules\newsfeed\components\FeedOption
 *
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2020 OMMU (www.ommu.id)
 * @created date 18 February 2020, 04:21 WIB
 * @link https://github.com/ommu/mod-newsfeed
 *
 */

use yii\helpers\Url;
use app\themes\upgradid\assets\UpgradidAsset;

$urlAsset = UpgradidAsset::register($this);
?>

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