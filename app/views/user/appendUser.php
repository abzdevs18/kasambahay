
<li class="list-group-item open-chat">
    <figure class="avatar avatar-state-success" style="background: #e6e6e6;text-align: center;vertical-align: middle;line-height: 2.3rem;font-weight: bold;color: #0a80ff;">
        <span class="avatar"><?=$data['user'][0]->firstname[0];?></span>
        <!-- <img src="<?=URL_ROOT;?>/img/dash/man_avatar4.jpg" class="rounded-circle" alt="image"> -->
    </figure>
    <div class="users-list-body">
        <div>
            <h5 class="text-primary userName" id="nameWorker"><?=$data['user'][0]->firstname . ' ' . $data['user'][0]->lastname;?></h5>
            <p>
                <!-- <i class="fa fa-camera mr-1"></i> Photo -->
            </p>
        </div>
        <div class="users-list-action">
            <!-- <div class="new-message-count">1</div> -->
            <!-- <small class="text-primary">Yesterday</small> -->
        </div>
    </div>
</li>
<span id="statusText" style="display:none;"><?=($data['user'][0]->visibility) ? 'Online' : 'Offline';?></span>