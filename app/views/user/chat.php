
        <!-- sidebar group -->
        <div class="sidebar-group mobile-open">

            <!-- Chats sidebar -->
            <div id="chats" class="sidebar active">
                <header>
                    <span>Chats</span>
                </header>
                <form>
                    <input type="text" class="form-control" placeholder="Search chats">
                </form>
                <div class="sidebar-body" style="overflow: hidden; outline: currentcolor none medium;" tabindex="2">
                    <ul class="list-group list-group-flush msgPrepend">
                    <?php if($data['users']):?>
						<?php foreach($data['users'] AS $userM) :?>
                        <!--  open-chat -->
                            <li class="list-group-item chatMsg" data-workerId="<?=$userM->id?>">
                                <figure class="avatar" style="background: #e6e6e6;text-align: center;vertical-align: middle;line-height: 2.3rem;font-weight: bold;color: #0a80ff;">
                                    <?php if($userM->img_path) : ?>
                                        <img src="<?=URL_ROOT;?>/img/profile/<?=$userM->img_path?>" class="rounded-circle" alt="image">
                                    <?php else : ?>
                                        <span class="avatar"><?=$userM->fname[0];?></span>
                                    <?php endif;?>
                                </figure>
                                <!-- <figure class="avatar avatar-state-success">
                                    <img src="<?=URL_ROOT;?>/img/dash/man_avatar1.jpg" class="rounded-circle" alt="image">
                                </figure> -->
                                <div class="users-list-body">
                                    <div>
                                        <h5 class="text-primary"><?=$userM->fname . ' ' . $userM->lname?></h5>
                                        <p><?=$userM->latestM?></p>
                                    </div>
                                    <div class="users-list-action">
                                        <!-- <div class="new-message-count">3</div> -->
                                        <small class="text-primary"><?=$userM->dateM?></small>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach;?>
                    <?php endif;?>
                        <!-- <li class="list-group-item">
                            <figure class="avatar avatar-state-warning">
                                <img src="<?=URL_ROOT;?>/img/dash/man_avatar4.jpg" class="rounded-circle" alt="image">
                            </figure>
                            <div class="users-list-body">
                                <div>
                                    <h5 class="text-primary">Forest Kroch</h5>
                                    <p>
                                        <i class="fa fa-camera mr-1"></i> Photo
                                    </p>
                                </div>
                                <div class="users-list-action">
                                    <div class="new-message-count">1</div>
                                    <small class="text-primary">Yesterday</small>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item open-chat">
                            <div>
                                <figure class="avatar">
                                    <img src="<?=URL_ROOT;?>/img/dash/man_avatar3.jpg" class="rounded-circle" alt="image">
                                </figure>
                            </div>
                            <div class="users-list-body">
                                <div>
                                    <h5>Byrom Guittet</h5>
                                    <p>I sent you all the files. Good luck with �</p>
                                </div>
                                <div class="users-list-action">
                                    <small class="text-muted">11:05 AM</small>
                                    <div class="action-toggle">
                                        <div class="dropdown">
                                            <a data-toggle="dropdown" href="#">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item">Open</a>
                                                <a href="#" data-navigation-target="contact-information" class="dropdown-item">Profile</a>
                                                <a href="#" class="dropdown-item">Add to archive</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item text-danger">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li> -->
                    </ul>
                </div>
            </div>
            <!-- ./ Chats sidebar -->   
        </div>
        <!-- ./ sidebar group -->

        <!-- chat -->
        <div class="chat messengerContent">
            <div class="chat-header headerChat">
                <?php foreach($data['header'] AS $im) : ?>
                        <div class="chat-header-user">
                            <figure class="avatar" style="background: #e6e6e6;text-align: center;vertical-align: middle;line-height: 2.3rem;font-weight: bold;color: #0a80ff;">
                                <?php if($im->imagePath) : ?>
                                    <img src="<?=URL_ROOT;?>/img/profile/<?=$im->imagePath?>" class="rounded-circle" alt="image">
                                <?php else : ?>
                                    <span class="avatar"><?=$im->firstN[0];?></span>
                                <?php endif;?>
                            </figure>
                            <div>
                                <h5 id="msgRecvrName"><?=ucfirst($im->firstN) . ' ' . ucfirst($im->lastN)?></h5>
                                <small class="text-success">
                                    <i id="visibilityStat"><?=$im->work_cat?></i>
                                </small>
                            </div>
                        </div>
                        <div class="chat-header-action">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="#" class="btn btn-outline-light" data-toggle="dropdown">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" data-navigation-target="contact-information" class="dropdown-item profId prv_prof" data-id="<?=$im->userId?>">Profile</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
				<?php endforeach;?>
            </div>
            <div class="chat-body" style="outline: currentcolor none medium;" tabindex="1">
                <div class="messages" style="display:flex;flex-direction:column-reverse">
                    <?php if($data['latestM']): ?>
                        <?php foreach($data['latestM'] AS $msg): ?>
                            <?php if($msg->receiverId == $_SESSION['uId']) : ?>
                                <div class="message-item">
                                    <div class="message-avatar">
                                        <figure class="avatar" style="background: #e6e6e6;text-align: center;vertical-align: middle;line-height: 2.3rem;font-weight: bold;color: #0a80ff;">
                                            <?php if($msg->sendIconImage) : ?>
                                                <img src="<?=URL_ROOT;?>/img/profile/<?=$msg->sendIconImage?>" class="rounded-circle" alt="image">
                                            <?php else : ?>
                                                <span class="avatar" style="padding-left:13px;"><?=$msg->firstN[0];?></span>
                                            <?php endif;?>
                                        </figure>
                                        <div>
                                            <h5><?=$msg->firstN . ' ' . $msg->lastN?></h5>
                                            <div class="time"><?=$msg->msgDate;?></div>
                                        </div>
                                    </div>
                                    <div class="message-content"><?=$msg->msgContent;?></div>
                                </div>
                            <?php else: ?>
                                <div class="message-item outgoing-message">
                                    <div class="message-avatar">
                                        <figure class="avatar" style="background: #e6e6e6;text-align: center;vertical-align: middle;line-height: 2.3rem;font-weight: bold;color: #0a80ff;">
                                            <?php if($msg->sendIconImage) : ?>
                                                <img src="<?=URL_ROOT;?>/img/profile/<?=$msg->sendIconImage?>" class="rounded-circle" alt="image">
                                            <?php else : ?>
                                                <span class="avatar" style="padding-left:13px;"><?=$msg->firstN[0];?></span>
                                            <?php endif;?>
                                        </figure>
                                        <div>
                                            <h5><?=$msg->firstN . ' ' . $msg->lastN?></h5>
                                            <div class="time"><?=$msg->msgDate;?></div>
                                        </div>
                                    </div>
                                    <div class="message-content"><?=$msg->msgContent;?></div>
                                </div>
                            <?php endif;?>
                        <?php endforeach;?>
                    <?php endif;?>
                    <!-- <div class="message-item">
                        <div class="message-avatar">
                            <figure class="avatar">
                                <img src="<?=URL_ROOT;?>/img/dash/man_avatar3.jpg" class="rounded-circle" alt="image">
                            </figure>
                            <div>
                                <h5>Byrom Guittet</h5>
                                <div class="time">11:05 AM</div>
                            </div>
                        </div>
                        <div class="message-content">
                            I sent you all the files. Good luck with �
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="chat-footer">
                <form class="msgIdWorker" data-sendr="<?=$_SESSION['uId']?>" data-id="<?=$data['usr']?>">
                    <input type="text" class="form-control" placeholder="Write a message.">
                    <div class="form-buttons">
                        <button class="btn btn-primary" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- ./ chat -->
    