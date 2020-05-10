<?php
/**
 * FeedCommentPost
 *
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2020 OMMU (www.ommu.id)
 * @created date 18 February 2020, 02:14 WIB
 * @link https://github.com/ommu/mod-newsfeed
 * 
 */

namespace app\modules\newsfeed\components;

class FeedCommentPost extends \yii\base\Widget
{
    /**
     * {@inheritdoc}
     */
    public $newsfeedId;

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        return $this->render('feed_comment_post', [
            'newsfeedId' => $this->newsfeedId,
        ]);
    }
}