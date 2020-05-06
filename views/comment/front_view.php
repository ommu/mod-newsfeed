<?php
/**
 * Newsfeed Comments (newsfeed-comment)
 * @var $this app\components\View
 * @var $this app\modules\newsfeed\controllers\CommentController
 * @var $model app\modules\newsfeed\models\NewsfeedComment
 *
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2020 OMMU (www.ommu.id)
 * @created date 21 February 2020, 12:58 WIB
 * @link https://github.com/ommu/mod-newsfeed
 *
 */

use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="post-comment d-flex p-3">
    <div class="profile-photo"><a href=""><img class="rounded-circle" src="<?php echo Url::base();?>/public/profile/rudi-gundul.png" alt="rudi-gundul.png" /></a></div>
    <div class="px-3">
        <h5 class="mb-1"><a href=""><strong><?php echo $model->user->displayname; ?></strong></a></h5>
        <?php echo $model->comment; ?>
    </div>
    <div class="ml-auto text-muted text-nowrap option">
        <span class="pr-3"><?php echo $model->comment_date; ?></span>
        <div class="d-inline-block option-menu position-relative">
            <a href="javascript:void(0);"><i class="fas fa-ellipsis-h"></i></a>
            <div class="position-absolute">
                <a href="<?php echo Url::to(['/newsfeed/comment/delete', 'id' => $model->id]);?>"><?php echo Yii::t('app', 'Delete');?></a>
                <a href=""><?php echo Yii::t('app', 'Block');?></a>
            </div>
        </div>
    </div>
</div>