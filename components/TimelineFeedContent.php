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

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

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
            'newsfeedPost' => $this->parsePost($this->model->newsfeed_post),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getProfileUrl($username)
    {
        return Url::to(['/member/profile/view', 'id' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function getMentionHyperlink($data)
    {
        return Html::a($data[0], $this->getProfileUrl($data[1]));
    }

    /**
     * {@inheritdoc}
     */
    public function parseUrl($data)
    {
        return preg_replace('@((https?|ftp)://([-\w\.]+)+(/([\w/_\.]*(\?\S+)?(#\S+)?)?)?)@', '<a href="$1" target="_blank">$1</a>', $data);
    }

    /**
     * {@inheritdoc}
     */
    public function parseMention($data)
    {
        $oldMentions = $this->model->oldMentions;

        if (!empty($oldMentions)) {
            // $return = preg_replace('#@([\\d\\w_.-]+)#', '<a href="https://twitter.com/$1">$0</a>', $return);
            preg_match_all('#@([\\d\\w_.-]+)#', $data, $matches, PREG_SET_ORDER);
    
            if (!empty($matches)) {
                foreach ($matches as $var) {
                    if (ArrayHelper::keyExists($var[1], $oldMentions) && $oldMentions[$var[1]]['member_id'] != '') {
                        $data = str_replace($var[0], $this->getMentionHyperlink($var), $data);
                    }
                }
            }
        }

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function parseHastag($data)
    {
        // $return = preg_replace('/#([\\d\\w]+)/', '<a href="https://twitter.com/hashtag/$1?src=hash">$0</a>', $return);
        preg_match_all('/#([\\d\\w]+)/', $data, $matches, PREG_SET_ORDER);

        if (!empty($matches)) {
            foreach ($matches as $var) {
                $data = str_replace($var[0], $this->getMentionHyperlink($var), $data);
            }
        }

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function parsePost($data)
    {
        $data = $this->parseUrl($data);
        $data = $this->parseMention($data);
        $data = $this->parseHastag($data);

        return $data;
    }
}