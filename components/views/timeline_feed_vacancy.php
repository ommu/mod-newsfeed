<?php
/**
 * TimelineFeedContent
 * @var $this app\components\View
 * @var $this app\modules\newsfeed\components\TimelineFeedContent
 *
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2020 OMMU (www.ommu.id)
 * @created date 12 February 2020, 15:10 WIB
 * @link https://github.com/ommu/mod-newsfeed
 *
 */

use yii\helpers\Url;
use app\themes\upgradid\assets\UpgradidAsset;
use app\modules\newsfeed\components\TimelineAuthor;

$urlAsset = UpgradidAsset::register($this);
?>

<!-- Type : Lowongan Single -->
<div id="posting-6" class="post-content box-shadow bg-white rounded mb-4">
    <?php echo TimelineAuthor::widget([
        'model' => $member,
        'postDate' => $model->creation_date,
        'separator' => true,
    ]);?>

    <div class="post-text border-bottom py-2 px-3">
        <div class="row m-0">
            <div class="col-9 col-md-8 p-0">
                <a href=""><h5 class="txt-orange font-weight-bold">Lowongan Single</h5></a>
                <div class="form-group row mb-0">
                    <div class="col-4"><label class="colon mb-1">Tingkat Lulus</label></div>
                    <div class="col-8">Minimal S2</div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-4"><label class="colon mb-1">Jurusan</label></div>
                    <div class="col-8">Teknik Akuntansi</div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-4"><label class="colon mb-1">Kategori Posisi</label></div>
                    <div class="col-8">Akunting/Accounting</div>
                </div>
            </div>
            <div class="col-3 col-md-4 text-center p-0 align-self-center">
                <h1 class="font-weight-bold m-0">87</h1>
                <strong class="d-block">Pelamar</strong>
                <i>Valid 29 hari lagi</i>
            </div>
        </div>
        <strong class="mt-2 d-block">Persyaratan</strong>
        <div class="form-group row mb-0">
            <div class="col-3"><label class="colon mb-1">Job Description</label></div>
            <div class="col-9">
                <p class="text-truncate w-100">1. Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati soluta aut ab aspernatur!</p>
            </div>
        </div>
    </div>
    <div class="row m-0 vac-post-nav">
        <div class="col-4 text-center p-2">
            <a href=""><i class="far fa-copy mr-1"></i>Detail</a>
        </div>
        <div class="col-4 text-center p-2">
            <a href=""><i class="fas fa-star mr-1"></i>Bookmark</a>
        </div>
        <div class="col-4 text-center p-2">
            <a href=""><i class="far fa-check-square mr-1"></i>Lamar</a>
        </div>
    </div>
    <div class="row m-0 vac-post-nav">
        <div class="col-4 text-center p-2">
            <a href=""><i class="far fa-copy mr-1"></i>Detail</a>
        </div>
        <div class="col-4 text-center p-2">
            <a href="" class="active"><i class="fas fa-star mr-1"></i>Bookmark</a>
        </div>
        <div class="col-4 text-center p-2">
            <a href="" class="active"><i class="far fa-check-square mr-1"></i>Lamar</a>
        </div>
    </div>
</div>

<!-- Type : Lowongan Group -->
<div id="posting-7" class="post-content box-shadow bg-white rounded mb-4">
    <?php echo TimelineAuthor::widget([
        'model' => $member,
        'postDate' => $model->creation_date,
        'separator' => true,
    ]);?>

    <div class="post-text">
        <?php for ($x = 1; $x <= 4; $x++) { ?>
            <div class="row m-0 px-3 py-2 border-bottom">
                <div class="col-8 p-0">
                    <a href=""><h5 class="txt-orange font-weight-bold m-0">Lowongan Group <?php echo $x; ?></h5></a>
                    <div class="row m-0">
                        <div class="col-6 p-0">
                            <span class="text-muted small"><i class="fas fa-user-friends mr-1"></i>14 pelamar</span>
                        </div>
                        <div class="col-6 p-0">
                            <span class="text-muted small"><i class="fas fa-stopwatch mr-1"></i>14 hari lagi</span>
                        </div>
                    </div>
                </div>
                <div class="col-4 p-0">
                    <div class="row m-0 vac-post-nav align-items-center h-100">
                        <div class="col-6 text-center p-2">
                            <a href=""><i class="far fa-copy mr-1"></i>Detail</a>
                        </div>
                        <div class="col-6 text-center p-2">
                            <a href=""><i class="far fa-check-square mr-1"></i>Lamar</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="vac-post-nav">
        <div class="px-3 py-2">
            <a href=""><i class="fas fa-star mr-1"></i>Bookmark</a>
        </div>
    </div>
</div>