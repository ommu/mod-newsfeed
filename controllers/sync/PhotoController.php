<?php
/**
 * PhotoController
 * @var $this app\components\View
 *
 * Reference start
 * TOC :
 *	Index
 *	Profile
 *
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2020 OMMU (www.ommu.id)
 * @created date 13 January 2020, 12:25 WIB
 * @link https://github.com/ommu/mod-newsfeed
 *
 */

namespace app\modules\newsfeed\controllers\sync;

use Yii;
use app\components\Controller;
use mdm\admin\components\AccessControl;
use ommu\member\models\Members;
use app\modules\album\models\Photos;
use app\modules\newsfeed\models\Newsfeeds;

class PhotoController extends Controller
{
    use \ommu\traits\FileTrait;

	/**
	 * {@inheritdoc}
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
			],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function allowAction(): array {
		return [];
	}

	/**
	 * Index Action
	 */
	public function actionIndex()
	{
        throw new \yii\web\NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
	}

	/**
	 * Profile Action
	 */
	public function actionProfile()
	{
        $model = Members::find()
            ->alias('t')
            ->select(['t.member_id', 't.photo_profile', 't.modified_date'])
            ->andWhere(['<>', 't.photo_profile', ''])
            // ->limit(10)
            ->all();

        $syncSuccess = 0;

        if ($model) {
            foreach ($model as $key => $val) {
                $photo = new Photos();
                $photo->publish = 1;
                $photo->member_id = $val->member_id;
                $photo->user_id = $val->userOwner->user_id;
                $photo->photo = $val->photo_profile;
                $photo->creation_date = $val->modified_date;

                $memberUploadPath = join('/', [Members::getUploadPath(), $val->member_id]);
                $memberPhotoProfile = join('/', [$memberUploadPath, $val->photo_profile]);

                $photoUploadPath = join('/', [Photos::getUploadPath(), $val->member_id]);
                $this->createUploadDirectory(Photos::getUploadPath(), $val->member_id);

                if ($val->photo_profile != '' && file_exists($memberPhotoProfile)) {
                    $photoProfile = join('/', [$photoUploadPath, $val->photo_profile]);
                    copy($memberPhotoProfile, $photoProfile);
                }

                if(!$photo->save()) {
                    echo '<pre>';
                    print_r($photo->getErrors());
                } else {
                    $syncSuccess = $syncSuccess + 1;
                }
            }
        }

        echo Yii::t('app', '{syncSuccess} success sync.', ['syncSuccess' => $syncSuccess]);
	}

}
