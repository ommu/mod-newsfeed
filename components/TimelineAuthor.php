<?php
/**
 * TimelineAuthor
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
use yii\helpers\Url;

class TimelineAuthor extends \yii\base\Widget
{
    /**
     * {@inheritdoc}
     */
    public $model;
    /**
     * {@inheritdoc}
     */
    public $postDate;
    /**
     * {@inheritdoc}
     */
    public $memberContent = [];

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        // if(isset($this->model)) {

        // } else {
            $this->memberContent = [
                'photo' => join('/', [Url::base(), 'public/profile/rudi-gundul.png']),
                'displayname' => 'Muhammad adi',
                'position' => 'HRD',
                'employee' => 'Unilever',
                'postDate' => '3h ago',
            ];
        // }
    }

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        return $this->render('timeline_author', [
            'model' => $this->memberContent,
        ]);
    }
}