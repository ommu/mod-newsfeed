<?php
/**
 * TimelineFeeds
 *
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2020 OMMU (www.ommu.id)
 * @created date 12 February 2020, 14:30 WIB
 * @link https://github.com/ommu/mod-newsfeed
 * 
 */

namespace app\modules\newsfeed\components;

use Yii;
use yii\data\ActiveDataProvider;
use app\modules\newsfeed\models\Newsfeeds;

class TimelineFeeds extends \yii\base\Widget
{
    /**
     * {@inheritdoc}
     */
    public function init()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Newsfeeds::find()
                ->alias('t')
                ->andWhere(['t.publish' => 1])
                ->andWhere(['t.app' => Yii::$app->id])
                ->orderBy('t.creation_date DESC, t.id DESC')
        ]);

        return $this->render('timeline_feeds', [
            'dataProvider' => $dataProvider,
        ]);
    }
}