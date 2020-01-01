<link rel="stylesheet" href="<?=URL_ROOT;?>/css/preview_profile.css">
<div style="display:flex;flex-direction:column;">
    <div class="sidebar">
        <header>
            <span style="font-size:22px;font-weight:600;margin:20px 35px;display:block;">Home</span>
        </header>        
    </div>

    <div class="container-fluid">
        <div class="row" style="margin: 10px;">
            <!--================Home Banner Area =================-->
            <section class="profile_area" style="height:100vh;">
                <div class="container">
                    <div class="profile_inner">
                        <div class="row">
                            <div class="col-lg-5">
                                <?php if($data['info'][0]->img_path) : ?>
                                    <img class="img-fluid" src="<?=URL_ROOT . '/img/profile/' . $data['info'][0]->img_path?>" alt="">
                                <?php else : ?>
                                    <div style="box-shadow:0px 0px 5px 0px rgba(0, 0, 0, 0.2);width:458px;height:600px;font-size: 300px;line-height: 458px;text-align: center;background: #f3f3f3;border-radius: 5px;overflow: hidden;"><?=strtolower($data['info'][0]->firstname[0])?></div>
                                <?php endif;?>
                            </div>
                            <div class="col-lg-7">
                                <div class="personal_text">
                                    <h6>Hello Everybody, i am</h6>
                                    <h3><?=$data['info'][0]->firstname . ' ' . $data['info'][0]->lastname;?></h3>
                                    <h4><?=$data['info'][0]->work_cat?></h4>
                                    <p><?=$data['info'][0]->bio?></p>
                                    <ul class="list basic_info">
                                        <li><a href="#"><i class="lnr lnr-calendar-full"></i> 31st December, 1992</a></li>
                                        <li><a href="#"><i class="lnr lnr-phone-handset"></i> <?=$data['info'][0]->phone_number;?></a></li>
                                        <li><a href="#"><i class="lnr lnr-envelope"></i> <?=$data['info'][0]->email?></a></li>
                                        <li><a href="#"><i class="lnr lnr-home"></i> <?=$data['info'][0]->address . ', ' . $data['info'][0]->city . ', ' . $data['info'][0]->zip?></a></li>
                                    </ul>
                                    <ul class="list personal_social">
                                        <!-- <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li> -->
                                        <button class="btn btn-primary border-dark sendMsg" data-id="<?=$data['info'][0]->user_id?>" type="button">Send Message</button>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--================End Home Banner Area =================-->  
        </div> 
    </div>
</div>