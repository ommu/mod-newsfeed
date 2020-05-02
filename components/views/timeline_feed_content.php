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

$urlAsset = UpgradidAsset::register($this);
?>


<!-- Type : Recommended mentor -->
<div id="posting-8" class="people-list post-content box-shadow bg-white rounded mb-4 card">
    <div class="card-header text-muted bg-white">
        <strong>Recommended Career Buddies</strong>
        <a class="text-primary float-right" href="">View More</a>
    </div>
    <div class="card-body p-3">
        <div class="row">
            <div class="col-6 col-sm-3 col-md-3 text-center p-2">
                <div data-toggle="tooltip" data-html="true" title="<small><strong>Astra Daihatsu</strong><br/>Graphic Designer</small>">
                    <img class="rounded-circle" src="<?php echo Url::base();?>/public/profile/rudi-gundul.png" alt="rudi-gundul.png" />
                    <h6 class="mb-1 mt-1 text-truncate"><a href=""><strong>Astra Daihatsu</strong></a></h6>
                    <small class="text-truncate">Graphic Designer</small>
                </div>
                <a href="" class="mt-2 btn text-white orange btn-xs">Follow</a>
            </div>
            <div class="col-6 col-sm-3 col-md-3 text-center p-2">
                <div data-toggle="tooltip" data-html="true" title="<small><strong>Astra Daihatsu</strong><br/>Marketing Officer</small>">
                    <img class="rounded-circle" src="<?php echo Url::base();?>/public/profile/rudi-gundul.png" alt="rudi-gundul.png" />
                    <h6 class="mb-1 mt-1 text-truncate"><a href=""><strong>Astra Daihatsu</strong></a></h6>
                    <small class="text-truncate">Marketing Officer</small>
                </div>
                <a href="" class="mt-2 btn text-white orange btn-xs">Follow</a>
            </div>
            <div class="col-6 col-sm-3 col-md-3 text-center p-2">
                <div data-toggle="tooltip" data-html="true" title="<small><strong>Astra Daihatsu</strong><br/>Programmer</small>">
                    <img class="rounded-circle" src="<?php echo Url::base();?>/public/profile/rudi-gundul.png" alt="rudi-gundul.png" />
                    <h6 class="mb-1 mt-1 text-truncate"><a href=""><strong>Astra Daihatsu</strong></a></h6>
                    <small class="text-truncate">Programmer</small>
                </div>
                <a href="" class="mt-2 btn text-white orange btn-xs">Follow</a>
            </div>
            <div class="col-6 col-sm-3 col-md-3 text-center p-2">
                <div data-toggle="tooltip" data-html="true" title="<small><strong>Astra Daihatsu</strong><br/>Programmer</small>">
                    <img class="rounded-circle" src="<?php echo Url::base();?>/public/profile/rudi-gundul.png" alt="rudi-gundul.png" />
                    <h6 class="mb-1 mt-1 text-truncate"><a href=""><strong>Astra Daihatsu</strong></a></h6>
                    <small class="text-truncate">Programmer</small>
                </div>
                <a href="" class="mt-2 btn text-white orange btn-xs">Follow</a>
            </div>
        </div>
    </div>
</div>

<!-- Type : Community -->
<div id="posting-9" class="community-list post-content box-shadow bg-white rounded mb-4 card">
    <div class="card-header text-muted bg-white">
        <strong>Community</strong>
        <a class="text-primary float-right" href="">View More</a>
    </div>
    <div class="card-body pr-3 pl-3 py-2">
        <div class="row">
            <?php for ($i = 1; $i <= 3; $i++) { ?>
                <div class="col-sm-4 col-md-4 text-center p-2">
                    <div class="profile-card card text-center box-shadow">
                        <img class="card-img-top" src="<?php echo Url::base();?>/public/profile/background-profile.png" alt="background-profile.png" />
                        <div class="container">
                            <div class="profile-img">
                                <img class="rounded-circle" src="<?php echo Url::base();?>/public/profile/rudi-gundul.png" alt="rudi-gundul.png" />
                            </div>
                            <h5 class="mb-1 text-truncate"><a href=""><strong>Kopi Jos</strong></a></h5>
                            <span class="text-truncate d-block">1000 Member</span>
                            <a href="" class="mt-1 mb-2 pr-3 pl-3 btn orange btn-xs text-white">Join</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<!-- Type : Vacancy -->
<div id="posting-10" class="vacancy-list post-content box-shadow bg-white rounded mb-4 card">
    <div class="card-header text-muted bg-white">
        <strong>Vacancy</strong>
        <a class="text-primary float-right" href="">View More</a>
    </div>
    <div class="card-body pr-3 pl-3 py-2">
        <div class="row">
            <div class="col-6 col-sm-3 col-md-3 text-center p-2">
                <a class="d-block" href=""><img src="<?php echo Url::base();?>/public/company-logo/astra.png" alt="astra.png" /></a>
                <a href="" class="mt-1 pr-2 pl-2 btn green btn-xs text-white">3 Lowongan</a>
            </div>
            <div class="col-6 col-sm-3 col-md-3 text-center p-2">
                <a class="d-block" href=""><img src="<?php echo Url::base();?>/public/company-logo/wings.png" alt="wings.png" /></a>
                <a href="" class="mt-1 pr-2 pl-2 btn green btn-xs text-white">2 Lowongan</a>
            </div>
            <div class="col-6 col-sm-3 col-md-3 text-center p-2">
                <a class="d-block" href=""><img src="<?php echo Url::base();?>/public/company-logo/epson.png" alt="epson.png" /></a>
                <a href="" class="mt-1 pr-2 pl-2 btn green btn-xs text-white">1 Lowongan</a>
            </div>
            <div class="col-6 col-sm-3 col-md-3 text-center p-2">
                <a class="d-block" href=""><img src="<?php echo Url::base();?>/public/company-logo/cartenz.png" alt="cartenz.png" /></a>
                <a href="" class="mt-1 pr-2 pl-2 btn green btn-xs text-white">312 Lowongan</a>
            </div>
        </div>
    </div>
</div>

<!-- Type : Event -->
<div id="posting-11" class="events post-content box-shadow bg-white rounded mb-4">
    <div class="row m-0">
        <div class="col-sm-8 col-md-8 p-0">
            <a href="">
                <img class="w-100" src="<?php echo Url::base();?>/public/event/event-banner-1.jpg" alt="event-banner-1.jpg" />
            </a>
        </div>
        <div class="col-sm-4 col-md-4 p-0">
            <a href="">
                <img class="w-100" src="<?php echo Url::base();?>/public/event/event-banner-2.jpg" alt="event-banner-2.jpg" />
            </a>
            <a href="">
                <img class="w-100" src="<?php echo Url::base();?>/public/event/event-banner-3.jpg" alt="event-banner-3.jpg" />
            </a>
        </div>
    </div>
</div>