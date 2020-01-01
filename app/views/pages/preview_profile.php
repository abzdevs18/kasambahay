<?php require_once APP_ROOT . '/views/inc/preview_header.php'; ?>
<div class="container-fluid" style="margin: 0px;padding: 20px;background-color: #ffffff;">
        <div class="row">
            <div class="col-2">
                <h1 class="text-capitalize" style="font-family: Roboto, sans-serif;font-weight: bold;font-size: 30px;">Kasambahay</h1>
            </div>
            <div class="col-8 text-center justify-content-center align-items-center align-content-center align-self-center" style="height: auto;padding-right: 0px;padding-left: 0px;">
                <ul class="list-inline d-xl-flex align-content-center align-self-center justify-content-xl-center align-items-xl-center navigation_list" style="margin: 0px;">
                    <li class="list-inline-item d-xl-flex align-self-center" style="font-family: Poppins, sans-serif;">Home</li>
                    <li class="list-inline-item">Category</li>
                    <li class="list-inline-item">Contact</li>
                </ul>
            </div>
            <div class="col-2 text-right align-self-center"><a href="<?=URL_ROOT;?>/pages/signup" style="font-family: Poppins, sans-serif;padding: 7px 12px;">Signup</a><a class="border rounded" href="<?=URL_ROOT;?>/pages/login" style="padding: 5px 20px;background-color: #26547c;color: rgb(255,255,255);border-radius: 10px !important;border: none;">Login</a></div>
        </div>
    </div>
        <!--================Home Banner Area =================-->
        <section class="profile_area">
           	<div class="container">
           		<div class="profile_inner p_120">
					<div class="row">
						<div class="col-lg-5">
							<img class="img-fluid" src="<?=URL_ROOT;?>/img/personal-2.jpg" alt="">
						</div>
						<div class="col-lg-7">
							<div class="personal_text">
								<h6>Hello Everybody, i am</h6>
								<h3>Donald McKinney</h3>
								<h4>Junior UI/UX Developer</h4>
								<p>You will begin to realise why this exercise is called the Dickens Pattern (with reference to the ghost showing Scrooge some different futures)</p>
								<ul class="list basic_info">
									<li><a href="#"><i class="lnr lnr-calendar-full"></i> 31st December, 1992</a></li>
									<li><a href="#"><i class="lnr lnr-phone-handset"></i> 44 (012) 6954 783</a></li>
									<li><a href="#"><i class="lnr lnr-envelope"></i> businessplan@donald</a></li>
									<li><a href="#"><i class="lnr lnr-home"></i> Santa monica bullevard</a></li>
								</ul>
								<ul class="list personal_social">
									<!-- <li><a href="#"><i class="fa fa-facebook"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li> -->
                                    <button class="btn btn-primary border-dark" type="button">Send Message</button>
								</ul>
							</div>
						</div>
					</div>
           		</div>
            </div>
        </section>
        <!--================End Home Banner Area =================-->       
<?php require_once APP_ROOT . '/views/inc/footer.php'; ?>