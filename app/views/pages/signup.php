<?php require_once APP_ROOT . '/views/inc/signup_header.php'; ?>
    <div class="wrapper">
        <form action="" id="wizard">
            <!-- SECTION 1 -->
            <h2></h2>
            <section>
                <div class="inner">
                    <div class="image-holder" style="background:url('<?=URL_ROOT;?>/img/jan_01.jpg');background-size:cover;background-position:center;">
                        <!-- <img src="<?=URL_ROOT;?>/img/jan_01.jpg" alt=""> -->
                    </div>
                    <div class="form-content" >
                        <div class="form-header">
                            <h3>Registration</h3>
                        </div>
                        <p>Please fill with your details</p>
                        <div class="form-row">
                            <div class="form-holder">
                                <input type="text" id="fname" placeholder="First Name" name="firstN" class="form-control">
                            </div>
                            <div class="form-holder">
                                <input type="text" id="lname" placeholder="Last Name" name="lastN" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-holder">
                                <input type="text" id="email" placeholder="Your Email" name="emailAdd" class="form-control">
                            </div>
                            <div class="form-holder">
                                <input type="text" id="phone" placeholder="Phone Number" name="phoneNum" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-holder">
                                <input type="text" id="age" placeholder="Age" name="age" class="form-control">
                            </div>
                            <div class="form-holder" style="align-self: flex-end; transform: translateY(4px);">
                                <div class="checkbox-tick">
                                    <label class="male">
                                        <input type="radio" name="gender" value="male" checked> Male<br>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="female">
                                        <input type="radio" name="gender" value="female"> Female<br>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="checkbox-circle" style="padding-left:0px;">
                            <span> Please put in the your correct details for we will be conducting a background check for every Kasambahay that signs up. Thank you.</span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- SECTION 2 -->
            <h2></h2>
            <section>
                <div class="inner">
                    <div class="image-holder" style="background:url('<?=URL_ROOT;?>/img/jan_02.jpg');background-size:cover;background-position:center;">
                        <!-- <img src="<?=URL_ROOT;?>/img/jan_02.jpg" alt=""> -->
                    </div>
                    <div class="form-content">
                        <div class="form-header">
                            <h3>Registration</h3>
                        </div>
                        <p>Please fill with additional info</p>
                        <div class="form-row">
                            <div class="form-holder w-100">
                                <input type="text" id="address" placeholder="Address" name="address" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-holder">
                                <input type="text" id="city" placeholder="City" name="city" class="form-control">
                            </div>
                            <div class="form-holder">
                                <input type="text" id="zip" placeholder="Zip Code" name="zipCode" class="form-control">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="select">
                                <div class="form-holder">
                                    <div class="select-control">Select User Type</div>
                                    <i class="zmdi zmdi-caret-down"></i>
                                </div>
                                <ul class="dropdown">
                                    <li rel="Home Owner">Home Owner</li>
                                    <li rel="Laundry">Laundry</li>
                                    <li rel="Farming">Farming</li>
                                    <li rel="Yaya">Yaya</li>
                                </ul>
                            </div>
                            <div class="form-holder"></div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- SECTION 3 -->
            <h2></h2>
            <section>
                <div class="inner">
                    <div class="image-holder" style="background:url('<?=URL_ROOT;?>/img/jan_03.jpg');background-size:cover;background-position:right;">
                        <!-- <img src="<?=URL_ROOT;?>/img/form-wizard-3.jpg" alt=""> -->
                    </div>
                    <div class="form-content">
                        <div class="form-header">
                            <h3>Registration</h3>
                        </div>
                        <p>Send an optional message</p>
                        <div class="form-row">
                            <div class="form-holder">
                                <input type="text" id="username" placeholder="Username" name="username" class="form-control">
                            </div>
                            <div class="form-holder">
                                <input type="password" id="password" placeholder="Password" name="password" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-holder w-100">
                                <textarea name="bio" id="bio" placeholder="Your messagere here!" class="form-control" style="height: 69px;"></textarea>
                            </div>
                        </div>
                        <div class="checkbox-circle mt-24">
                            <label>
                                <input type="checkbox" checked>  Please accept <a href="#">terms and conditions ?</a>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </section>
        </form>
    </div>
<?php require_once APP_ROOT . '/views/inc/footer.php'; ?>