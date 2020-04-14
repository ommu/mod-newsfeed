<?php
/**
 * TimelineFeedPost
 *
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2020 OMMU (www.ommu.id)
 * @created date 12 February 2020, 15:10 WIB
 * @link https://github.com/ommu/mod-newsfeed
 * 
 */

namespace app\modules\newsfeed\components;

class TimelineFeedPost extends \yii\base\Widget
{
    /**
     * {@inheritdoc}
     */
    public function run() {
        return $this->render('timeline_feed_post');
    }
}