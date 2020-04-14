<?php
/**
 * TimelineFeedContent
 *
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2020 OMMU (www.ommu.id)
 * @created date 12 February 2020, 15:10 WIB
 * @link https://github.com/ommu/mod-newsfeed
 * 
 */

namespace app\modules\newsfeed\components;

class TimelineFeedContent extends \yii\base\Widget
{
    /**
     * {@inheritdoc}
     */
    public $type;
    /**
     * {@inheritdoc}
     */
    public $model;

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $render = 'timeline_feed_text';
        if ($this->type == 'text') {
            $render = 'timeline_feed_text';
        } else if ($this->type == 'album') {
            $render = 'timeline_feed_album';
        } else if ($this->type == 'link') {
            $render = 'timeline_feed_link';
        } else if ($this->type == 'vacancy') {
            $render = 'timeline_feed_vacancy';
        } else if ($this->type == 'ads') {
            $render = 'timeline_feed_content';
        }

        return $this->render($render, [
            'model' => $this->model,
            'member' => $this->model->member,
        ]);
    }
}