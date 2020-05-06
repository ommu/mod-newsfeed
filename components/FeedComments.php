<?php
/**
 * FeedComments
 *
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2020 OMMU (www.ommu.id)
 * @created date 18 February 2020, 00:22 WIB
 * @link https://github.com/ommu/mod-newsfeed
 * 
 */

namespace app\modules\newsfeed\components;

use app\modules\newsfeed\models\NewsfeedComment;
use yii\data\ActiveDataProvider;

class FeedComments extends \yii\base\Widget
{
    /**
     * {@inheritdoc}
     */
    public $comment = false;
    /**
     * {@inheritdoc}
     */
    public $newsfeedId;

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $query = NewsfeedComment::find()
            ->alias('t')
            ->andWhere(['t.publish' => 1]);
        if ($this->newsfeedId) {
            $query->andWhere(['t.newsfeed_id' => $this->newsfeedId]);
        }
        $query->orderBy('t.comment_date DESC, t.id DESC');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 2,
            ],
        ]);

        return $this->render('feed_comments', [
            'comment' => $this->comment,
            'newsfeedId' => $this->newsfeedId,
            'dataProvider' => $dataProvider,
        ]);
    }
}