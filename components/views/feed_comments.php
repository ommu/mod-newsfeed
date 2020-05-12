<?php
/**
 * FeedComments
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
use app\modules\newsfeed\components\FeedCommentPost;
?>

<div class="comments-box">
    <?php if ($comment == true) {
        $model = array_reverse($dataProvider->getModels());
        $pager = $dataProvider->getPagination();

        $nextPager = false;
        if ($dataProvider->totalCount != 0 && $dataProvider->totalCount > $dataProvider->count) {
            $nextPager = true;
        } ?>
        <?php if ($nextPager == true) {?>
            <div class="post-comment p-1 bg-light prev-comment text-center">
                <a class="btn-sm text-primary" href="<?php echo Url::to(['/newsfeed/comment/index', 'newsfeed' => $newsfeedId, 'page' => 2]);?>" title="<?php echo Yii::t('app', 'See previous comment');?>">
                    <small><?php echo Yii::t('app', 'See previous comment');?>&nbsp;<i class="fas fa-chevron-down"></i></small>
                </a>
            </div>
        <?php }

        foreach ($model as $val) {?>
            <div class="post-comment d-flex p-3">
                <div class="profile-photo">
                    <a href="<?php echo Url::to(['/member/profile/view', 'id' => $val->user->username]);?>" title="<?php echo $val->user->displayname; ?>">
                        <img class="rounded-circle" src="<?php echo $val->user->photos; ?>" alt="<?php echo $val->user->displayname; ?>" />
                    </a>
                </div>
                <div class="px-3">
                    <h5 class="mb-1">
                        <a href="<?php echo Url::to(['/member/profile/view', 'id' => $val->user->username]);?>" title="<?php echo $val->user->displayname; ?>">
                            <strong><?php echo $val->user->displayname; ?></strong>
                        </a>
                    </h5>
                    <?php echo $val->comment; ?>
                </div>
                <div class="ml-auto text-muted text-nowrap option">
                    <span class="pr-3"><?php echo $val->comment_date; ?></span>
                    <div class="d-inline-block option-menu position-relative">
                        <a href="javascript:void(0);"><i class="fas fa-ellipsis-h"></i></a>
                        <div class="position-absolute">
                            <a href="<?php echo Url::to(['/newsfeed/comment/delete', 'id' => $val->id]);?>"><?php echo Yii::t('app', 'Delete');?></a>
                            <a href=""><?php echo Yii::t('app', 'Block');?></a>
                        </div>
                    </div>
                </div>
            </div>
    <?php }
    }

    echo FeedCommentPost::widget([
        'newsfeedId' => $newsfeedId,
    ]);?>
</div>