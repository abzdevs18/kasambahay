
                <?php foreach($data['header'] AS $im) : ?>
                        <div class="chat-header-user">
                            <figure class="avatar avatar-state-success" style="background: #e6e6e6;text-align: center;vertical-align: middle;line-height: 2.3rem;font-weight: bold;color: #0a80ff;">
                                <?php if($im->imagePath) : ?>
                                    <img src="<?=URL_ROOT;?>/img/dash/man_avatar4.jpg" class="rounded-circle" alt="image">
                                <?php else : ?>
                                    <span class="avatar"><?=$im->firstN[0];?></span>
                                <?php endif;?>
                            </figure>
                            <div>
                                <h5 id="msgRecvrName"><?=ucfirst($im->firstN) . ' ' . ucfirst($im->lastN)?></h5>
                                <small class="text-success">
                                    <i id="visibilityStat"><?=($im->uStatus) ? 'Online' : 'Offline';?></i>
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