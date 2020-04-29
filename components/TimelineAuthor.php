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
use ommu\member\models\Members;

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
    public $separator = false;
    /**
     * {@inheritdoc}
     */
    public $memberContent = [];

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        $model = $this->model;
        if ($model) {
            $photo = join('/', [Url::base(), 'public/member/unisex.png']);
            $uploadPath = join('/', [Members::getUploadPath(), $model->member_id]);
            if ($model->photo_profile != '' && file_exists(join('/', [$uploadPath, $model->photo_profile]))) {
                $uploadPath = join('/', [Members::getUploadPath(false), $model->member_id]);
                $photo = join('/', [Url::base(), $uploadPath, $model->photo_profile]);
            }

            $this->memberContent = [
                'photo' => $photo,
                'displayname' => $model->displayname,
                'position' => 'HRD',
                'employee' => 'Unilever',
                'postDate' => $this->postDate,
                'profileUrl' => Url::to(['/member/profile/view', 'id' => $model->username]),
            ];

        } else {
            $this->memberContent = [
                'photo' => join('/', [Url::base(), 'public/profile/rudi-gundul.png']),
                'displayname' => 'Muhammad adi',
                'position' => 'HRD',
                'employee' => 'Unilever',
                'postDate' => '3h ago',
            ];
        }
    }

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        return $this->render('timeline_author', [
            'model' => $this->memberContent,
            'separator' => $this->separator,
        ]);
    }
}