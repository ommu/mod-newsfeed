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
use yii\helpers\Html;
use app\modules\newsfeed\components\TimelineAuthor;
use app\modules\newsfeed\components\FeedOption;
use app\modules\newsfeed\components\FeedComments;
use app\modules\album\models\Photos;
?>

<!-- Type : Post mention image -->
<div id="posting-2" class="post-content box-shadow bg-white rounded mb-4">
    <?php echo TimelineAuthor::widget([
        'model' => $member,
        'postDate' => $model->creation_date,
    ]);?>

    <div class="post-text border-bottom p-2 mx-2">
        <?php if ($newsfeedPost) {
            echo $newsfeedPost;?>
            <div class="clearfix mb-3"></div>
        <?php }

        $photos = 0;
        if (isset($model->newsfeed_param['content'])) {
            $photos = count($model->newsfeed_param['content']);
        }
        
        if ($photos == 1) {
            foreach ($model->newsfeed_param['content'] as $key => $photo) {
                echo Html::img(join('/', ['@webpublic', $photo['photo']]), ['alt' => $photo['photo'], 'class' => 'mb-2 w-100']);

                $item = Photos::getInfo($photo['photo_id'], ['title', 'caption']);
                $titleCondition = false;
                if ($item->title || $item->caption) {
                    $titleCondition = true;
                }
                if ($titleCondition) {
                    echo $item->title ? $item->title : '';
                    echo $item->caption ? ($item->title ? '<br/>' : '').$item->caption : '';?>
                    <div class="clearfix mb-3"></div>
                <?php }
            } ?>

        <?php } else if ($photos > 1) {
            $i = 0;
            foreach ($model->newsfeed_param['content'] as $key => $photo) {
                $i++;
                if ($photos >= 5 && $i > 5) {
                    continue;
                }

                if ($i == 1 || ($photos >= 5 && $i == 3)) {?>
                <div class="row multiimage">
                <?php }

                if ($photos == 2 || ($photos == 4 && in_array($i, [1,3])) || ($photos >= 5 && in_array($i, [1,2]))) {?>
                <div class="col-6 p-0">
                <?php }
                if ($photos == 3 && $i == 1) {?>
                <div class="col-8 p-0">
                <?php }
                if (($photos == 3 && $i == 2)  || ($photos >= 5 && $i > 2)) {?>
                <div class="col-4 p-0 <?php echo $photos > 5 && $i == 5 ? 'moreimages' : ''?>">
                <?php }

                $image = Html::img(join('/', ['@webpublic', $photo['photo']]), ['alt' => $photo['photo'], 'class' => 'w-100']);
                if ($photos > 5 && $i == 5) {
                    $image = '<span><span>+'.($photos - 5).'</span></span>'.$image;
                }
                echo Html::a($image, '');

                if ($photos == 2 || ($photos == 3 && $i != 2) || ($photos == 4 && in_array($i, [2,4])) || $photos >= 5) {?>
                </div>
                <?php }

                if (($photos <= 5 && $i == $photos) || ($photos == 5 && $i == 2) || ($photos > 5 && in_array($i, [2,5]))) {?>
                </div>
                <?php }?>
            <?php }?>
            <div class="clearfix mb-3"></div>
        <?php } ?>
        <a class="modal-btn mr-2 text-muted" data-target="#modallike" href="<?php echo Url::base();?>/newsfeed/site/postlike" title="<?php echo Yii::t('app', 'Reaction');?>">
            <small><?php echo Yii::t('app', '{react} Reaction', ['react' => $model->likes]);?></small>
        </a>
        <a class="text-muted" href="javascript:void(0);" onclick="lastComment(this);" title="<?php echo Yii::t('app', 'Comment');?>">
            <small><?php echo Yii::t('app', '{comment} Comment', ['comment' => $model->comments]);?></small>
        </a>
    </div>
    <?php echo FeedOption::widget();?>
    <?php echo FeedComments::widget([
        'comment' => $model->comments ? true : false,
        'newsfeedId' => $model->id,
    ]);?>
</div>