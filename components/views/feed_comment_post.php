<?php
/**
 * FeedCommentPost
 * @var $this app\components\View
 * @var $this app\modules\newsfeed\components\FeedCommentPost
 *
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2020 OMMU (www.ommu.id)
 * @created date 18 February 2020, 02:14 WIB
 * @link https://github.com/ommu/mod-newsfeed
 *
 */

use yii\helpers\Html;
use yii\helpers\Url;
use app\components\widgets\ActiveForm;
?>

<div class="post-comment d-flex p-3">
    <div class="profile-photo">
        <a href="<?php echo Url::to(['/member/profile/view', 'id' => Yii::$app->user->identity->username]);?>" title="<?php echo Yii::$app->user->identity->displayname;?>">
            <img class="rounded-circle" src="<?php echo Yii::$app->user->identity->photos;?>" alt="<?php echo Yii::$app->user->identity->displayname;?>" />
        </a>
    </div>
    <div class="pl-3 w-100 comment-area">
        <?php $form = ActiveForm::begin([
            'action' => Url::to(['/newsfeed/comment/create', 'newsfeed' => $newsfeedId]),
            'enableClientValidation' => false,
            'enableAjaxValidation' => false,
            //'enableClientScript' => false,
        ]); ?>
            <div class="input-area">
                <?php echo Html::textarea('comment', '', ['id' => 'field-comment', 'class' => 'form-control', 'placeholder' => Yii::t('app', 'Add comment here')]);?>
                <input type="file" name="commentimage-1-1" id="commentimage-1-1" class="input-img-comment" onchange="readURLimg(this);"/>
                <label for="commentimage-1-1"><i class="far fa-image"></i></label>
            </div>
            <div class="posting-btn text-right d-block mt-2">
                <button type="submit" class="btn btn-xs btn-default text-white orange" onclick="postComment(this);"><?php echo Yii::t('app', 'POST');?></button>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>