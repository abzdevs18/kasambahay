<?php require_once 'inc/header.php'; ?>
<div style="display:flex;flex-direction:column;width:100%;">
    <div class="sidebar">
        <header>
            <span style="font-size:22px;font-weight:600;margin:20px 35px;display:block;">Home</span>
        </header>        
        <div style="margin: 0px;margin-top: 20px;padding: 20px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 align-items-center align-content-center align-self-center" style="padding-left: 30px;">
                        <div class="row align-items-center" style="width: auto;">
                            <div class="col-6 d-md-flex align-items-md-center" style="width: auto;min-width: 50%;background-color: #ffffff;border-radius: 5px;padding: 10px;box-shadow: 0px 0px 15px #999;"><i class="fa fa-search d-xl-flex align-items-center align-self-center justify-content-xl-center align-items-xl-center" style="color: #999;"></i><input class="border rounded" type="search" name="search" style="width: 100%;border: none !important;padding-left: 10px;background: none !important;outline: none;"></div>
                        </div>
                    </div>
                    <div class="col-md-6 text-right align-self-center">
                        <div class="row">
                            <div class="col-6 offset-6 text-left d-md-flex justify-content-between align-items-start align-self-start align-items-md-center" style="padding: 5px 10px;background-color: #ffffff;margin-right: 10px;height: auto;border-radius: 5px;box-shadow: 0px 0px 15px #999;"><label class="text-left" style="font-family: Poppins, sans-serif;margin-bottom: 0px;">Sort By:&nbsp;</label><select class="border rounded d-xl-flex justify-content-between align-items-end align-content-end align-self-start" style="padding: 5px;padding-left: 25px;font-family: Poppins, sans-serif;background-color: rgba(255,255,255,0);border: none !important;width: 75%;"><optgroup label="This is a group"><option value="12" selected="">This is item 1</option><option value="13">This is item 2</option><option value="14">This is item 3</option></optgroup></select></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row" style="margin: 10px;">
            <!-- <div class="col-3" style="/*margin: 0px;*//*padding: 20px;*//*border-radius: 10px;*//*border: 1px solid #999;*//*box-shadow: 0px 5px 22px #999;*/padding-right: 10px;padding-left: 10px;">
                <section class="hover_worker" style="margin: 0px;padding: 10px 10px;border-radius: 10px;/*border: 1px solid #999;*/box-shadow: 0px 5px 22px #999;"><img style="background-image: url('<?=URL_ROOT;?>/img/clinth.png');width: 80px;display: block;" src="<?=URL_ROOT;?>/img/clinth.png"><span class="border rounded d-xl-flex justify-content-xl-start" style="background-color: #234f33;color: rgb(249,249,249);padding: 0px 15px;font-size: 13px;/*width: 100px !important;*/display: inline-block !important;margin: 5px auto;border-radius: 10px !important;">Laundry</span>
                    <h2>Digital Ocean</h2>
                    <p style="margin-bottom: 5px;"><i class="fa fa-map-marker" style="padding-right: 10px;"></i>Dumaguete CIty</p>
                    <hr style="border-top: 1px solid #fff;">
                    <p style="margin-bottom: 5px;">Nunc ac lacus dignissim, semper arcu quis, tincidunt elit. Aenean quam <br>velit, ultrices id dolor ac, vestibulum scelerisque felis.&nbsp;<br><br></p><button class="btn btn-primary border-dark prv_prof" type="button" style="background-color: #333333;">View profile</button></section>
            </div> -->
            <?php foreach($data['worker'] AS $worker):?>
                <div class="col-3" style="margin-bottom: 20px;/*margin: 0px;*//*padding: 20px;*//*border-radius: 10px;*//*border: 1px solid #999;*//*box-shadow: 0px 5px 22px #999;*/padding-right: 10px;padding-left: 10px;">
                    <section style="margin: 0px;padding: 10px 10px;background:#fff;border-radius: 10px;box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.2);">
                        <?php if($worker->img_path) :?>
                        <img style="width:80px;height:80px;border-radius:50%;display: block;" src="<?=URL_ROOT;?>/img/profile/<?=$worker->img_path?>">
                        <?php else : ?>
                            <span style="width:80px;height:80px;text-align:center; line-height:80px;border-radius:50%;background-color:#ebeeef;display: block;font-size: 30px;"><?=strtoupper($worker->firstname[0])?></span>
                        <?php endif;?>
                            <span class="border rounded d-xl-flex justify-content-xl-start" style="background-color: #234f33;color: rgb(249,249,249);padding: 0px 15px;font-size: 13px;/*width: 100px !important;*/display: inline-block !important;margin: 5px auto;border-radius: 10px !important;"><?=$worker->work_cat?></span>
                        <h2><?=$worker->firstname . ' ' . $worker->lastname?></h2>
                        <p style="margin-bottom: 5px;"><i class="fa fa-map-marker" style="padding-right: 10px;"></i><?=$worker->address?></p>
                        <hr>
                        <p style="margin-bottom: 5px;"><?=$worker->bio?></p>
                        <button class="btn btn-primary border-dark prv_prof" data-id="<?=$worker->user_id?>" type="button" style="background-color: #333333;">View profile</button>
                    </section>
                </div>
            <?php endforeach;?>
        </div>
    </div>

</div>
<?php require_once 'inc/footer.php'; ?> 
    