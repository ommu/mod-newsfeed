<?php
/**
 * TimelineFeeds
 * @var $this app\components\View
 * @var $this app\modules\newsfeed\components\TimelineFeeds
 *
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2020 OMMU (www.ommu.id)
 * @created date 12 February 2020, 14:30 WIB
 * @link https://github.com/ommu/mod-newsfeed
 *
 */

use yii\helpers\Url;
?>

<div class="post-author d-flex p-2">
    <div class="px-2 align-self-center"><a href=""><img class="rounded-circle" src="<?php echo $model['photo'];?>" alt="<?php echo $model['displayname'];?>" width="50" /></a></div>
    <div class="p-2">
        <h5 class="mb-1"><a href=""><strong><?php echo $model['displayname'];?></strong></a></h5>
        <p class="text-muted"><?php echo $model['position'];?> <a href="" class="txt-orange"><?php echo $model['employee'];?></a></p>
    </div>
    <div class="ml-auto p-2 text-muted align-self-center"><?php echo $model['postDate'];?></div>
</div>

<div class="post-author d-flex p-2 border-bottom">
    <div class="px-2 align-self-center"><a href=""><img class="rounded-circle" src="<?php echo $model['photo'];?>" alt="<?php echo $model['displayname'];?>" width="50" /></a></div>
    <div class="p-2">
        <h5 class="mb-1"><a href=""><strong><?php echo $model['displayname'];?></strong></a></h5>
        <p class="text-muted"><?php echo $model['position'];?></p>
    </div>
    <div class="ml-auto p-2 text-muted small"><i><?php echo $model['postDate'];?></i></div>
</div>