<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kasambahay-Dashboard</title>
	<link rel="stylesheet" type="text/css" href="https://cdndevelopment.blob.core.windows.net/cdn/fa/css/all.min.css">

    <!-- Favicon -->
    <!-- <link rel="icon" href="<?=URL_ROOT;?>/js/dash/favicon.png" type="image/png"> -->

    <!-- Bundle Styles -->
    <link rel="stylesheet" href="<?=URL_ROOT;?>/css/dash/bundle.css">

    <link rel="stylesheet" href="<?=URL_ROOT;?>/css/dash/enjoyhint.css">

    <!-- App styles -->
    <link rel="stylesheet" href="<?=URL_ROOT;?>/css/dash/app.min.css">
    <link rel="stylesheet" href="<?=URL_ROOT;?>/css/linericon/style.css">


    
	<link rel="stylesheet" type="text/css" href="<?=URL_ROOT;?>/css/main.css">
    <link rel="stylesheet" href="<?=URL_ROOT;?>/kasambahay/css/kasambahay.min.css">
    <link rel="stylesheet" href="<?=URL_ROOT;?>/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="<?=URL_ROOT;?>/fonts/ionicons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Quicksand">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">

    <!-- MATERIAL DESIGN ICONIC FONT -->
    <link rel="stylesheet" href="<?=URL_ROOT;?>/fonts/material-design-iconic-font/css/material-design-iconic-font.css">
    <link rel="stylesheet" href="<?=URL_ROOT;?>/css/Footer-Basic.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            /* overflow: hidden !important; */
            overflow-y: scroll !important;
        }
        .form-control:focus {
            box-shadow: none !important;
        }
    </style>
</head>
<body data-gr-c-s-loaded="true" cz-shortcut-listen="true" class="mx-auto" id="bBody">

<!-- edit profile modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 mr-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg> Edit Profile
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fal fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#personal" role="tab" aria-controls="personal" aria-selected="true">Personal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="false">About</a>
                    </li>
                  
                </ul>
                <div class="tab-content">
                    <div class="tab-pane show active" id="personal" role="tabpanel">
                        <form id="personalUpdate">
                            <div class="form-group">
                                <label for="fullname" class="col-form-label">Firstname</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="<?=$data['data'][0]->firstname;?>" id="firstname">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="fullname" class="col-form-label">Lastname</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="<?=$data['data'][0]->lastname;?>" id="lastname">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Avatar</label>
                                <div class="d-flex align-items-center">
                                    <div>
                                        <figure class="avatar mr-3 item-rtl">
                                            <img src="man_avatar4.jpg" class="rounded-circle" alt="image">
                                        </figure>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="profImage" id="imgInp">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="city" class="col-form-label">Address</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="<?=$data['data'][0]->address;?>" id="address" name="address">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-target"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="city" class="col-form-label">City</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="<?=$data['data'][0]->city;?>" id="city" name="city">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-target"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="phone" class="col-form-label">Phone</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="<?=$data['data'][0]->phone_number;?>" id="phone" placeholder="(555) 555 55 55">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="about" role="tabpanel">
                        <form id="bioUpdate">
                            <div class="form-group">
                                <label for="about-text" class="col-form-label">Write a few words that describe
                                    you</label>
                                <textarea class="form-control" id="about-text"><?=$data['data'][0]->bio;?></textarea>
                            </div>
                            <!-- <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" checked="" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">View profile</label>
                            </div> -->
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary updateSave" data-id="<?=$data['data'][0]->user_id;?>">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- ./ edit profile modal -->

<!-- layout -->
<div class="layout">
    <!-- navigation -->
    <nav class="navigation" style="position:fixed;">
        <div class="nav-group">
            <ul id="nav_">
                <li class="logo">
                    <a href="#">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="612px" height="612px" viewBox="0 0 612 612" style="enable-background:new 0 0 612 612;" xml:space="preserve">
                            <g>
                                <g id="_x32__26_">
                                    <g>
                                    <path d="M401.625,325.125h-191.25c-10.557,0-19.125,8.568-19.125,19.125s8.568,19.125,19.125,19.125h191.25
                                    c10.557,0,19.125-8.568,19.125-19.125S412.182,325.125,401.625,325.125z M439.875,210.375h-267.75
                                    c-10.557,0-19.125,8.568-19.125,19.125s8.568,19.125,19.125,19.125h267.75c10.557,0,19.125-8.568,19.125-19.125
                                    S450.432,210.375,439.875,210.375z M306,0C137.012,0,0,119.875,0,267.75c0,84.514,44.848,159.751,114.75,208.826V612
                                    l134.047-81.339c18.552,3.061,37.638,4.839,57.203,4.839c169.008,0,306-119.875,306-267.75C612,119.875,475.008,0,306,0z
                                    M306,497.25c-22.338,0-43.911-2.601-64.643-7.019l-90.041,54.123l1.205-88.701C83.5,414.133,38.25,345.513,38.25,267.75
                                    c0-126.741,119.875-229.5,267.75-229.5c147.875,0,267.75,102.759,267.75,229.5S453.875,497.25,306,497.25z"></path>
                                    </g>
                                </g>
                            </g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                        </svg>
                    </a>
                </li>
                <li>
                    <a class="active m_side" href="#" data-ui="Home" title="" data-placement="right" data-original-title="Home">
                        <!-- <span class="badge badge-warning"></span> -->
                        <i class="fal fa-home"></i>
                    </a>
                </li>
                <li class="brackets">
                    <a class="m_side msgM" data-navigation-target="chats" href="#" data-ui="Chat" title="" data-placement="right" data-original-title="Chats">
                        <!-- <span class="badge badge-warning"></span> -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-circle"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                    </a>
                </li>
                <li title="" data-placement="right" data-original-title="User menu" class="show">
                    <a href="./login.html" data-toggle="dropdown" aria-expanded="true">
                        <figure class="avatar">
                            <?php if($data['data'][0]->img_path) :?>
                            <img style=";width: 36.8px;height:36.8px;border-radius:50%;display: block;" src="<?=URL_ROOT;?>/img/profile/<?=$data['data'][0]->img_path?>">
                            <?php else : ?>
                                <span style="width:36.8px;height:36.8px;text-align:center; line-height:36.8px;border-radius:50%;background-color:#ebeeef;display: block;font-size: 20px;"><?=strtoupper($data['account'][0]->firstname[0])?></span>
                            <?php endif;?>
                            <!-- <img src="<?=URL_ROOT;?>/img/dash/women_avatar5.jpg" class="rounded-circle" alt="image"> -->
                        </figure>
                    </a>
                    <div class="dropdown-menu" x-placement="top-start" style="position: absolute; transform: translate3d(20px, 417px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#editProfileModal">Edit
                            profile</a>
                        <!-- <a href="#" class="dropdown-item" data-toggle="modal" data-target="#settingModal">Settings</a> -->
                        <div class="dropdown-divider"></div>
                        <a href="<?=URL_ROOT;?>/User/signout" class="dropdown-item text-danger">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!-- ./ navigation -->
    
    <!-- content -->
    <div class="content" style="margin-left:120px;">