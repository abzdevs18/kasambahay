var URL_ROOT = "";

/*scripts Here*/
$(function(){
	$("#wizard").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "fade",
        enableAllSteps: true,
        transitionEffectSpeed: 500,
        labels: {
            finish: "Submit",
            next: "Forward",
            previous: "Backward"
        },
        onStepChanging:function(){
            return true;
            // var name = $("input[name='firstN']");
            // console.log($('input[name=gender]:checked', '#wizard').val());
            // var signup = $('#wizard').serializeArray();
            // if(signup['firstN']){
            //     alert(signup['firstN']);
            // }
            // console.log(signup);
        },
        onStepChanged:function(){
            // alert('d');
            console.log('One');
        },
        onFinishing:function(){
            var signup = $('#wizard').serializeArray();
            var work = $('.select .select-control').text();
                signup.push({name:'work_offer',value: work});
            if(emptyField("#fname") || emptyField("#lname") || emptyField("#email") || emptyField("#phone") || emptyField("#age") || emptyField("#address") || emptyField("#city") || emptyField("#zip") || emptyField("#username") || emptyField("#password") || emptyField("#bio")){
                alert("Please make sure you field out everything.");
                return false;
            }else{
                $.ajax({
                    url: URL_ROOT + '/Signup/signup',
                    type: 'POST',
                    dataType: 'json',
                    data: $.param(signup),
                    success:function(data){
                        if(data["status"]){
                            if(work == 'Home Owner'){
                                md.showNotification('bottom','right','success','Registration Successful!<br/> Redirecting to Login page!!');
                                setTimeout(function d(){window.location.href = URL_ROOT + "/Pages/login";},3000);
                            }else{
                                md.showNotification('bottom','right','success','Registration Successful!<br/> You\'re application will be reviewed by our Human Resource Manager.<br/>Thank You!!');
                                setTimeout(function d(){window.location.href = URL_ROOT + "/Pages/login";},3000);
                            }
                            // window.location.href =  URL_ROOT + "/Pages/login";
                        }else{
                            md.showNotification('bottom','right','danger','Sorry Something wen wrong!<br/>Make sure to fill out every field.');
                            // alert("Make sure to fill out every field.");
                        }
                        console.log(data);
                    },
                    error:function(err){
                        console.log(err);
                    }
                });
                console.log(signup);
                // console.log($('.select .select-control').text());
            }
        }
    });
    // Check input field during the sign up if something is empty
    function emptyField(field){
        if($.trim($(field).val()) == ''){
            return true;
        }else{
            return false;
        }
    }
    $('.wizard > .steps li a').click(function(){
    	$(this).parent().addClass('checked');
		$(this).parent().prevAll().addClass('checked');
		$(this).parent().nextAll().removeClass('checked');
    });
    // Custome Jquery Step Button
    $('.forward').click(function(){
        $("#wizard").steps('next');
    });
    $('.backward').click(function(){
        $("#wizard").steps('previous');
    });
    // Select Dropdown
    $('html').click(function() {
        $('.select .dropdown').hide(); 
    });
    $('.select').click(function(event){
        event.stopPropagation();
    });
    $('.select .select-control').click(function(){
        $(this).parent().next().toggle();
    });    
    $('.select .dropdown li').click(function(){
        $(this).parent().toggle();
        var text = $(this).attr('rel');
        $(this).parent().prev().find('div').text(text);
    });
});

$(document).on('click','.previewProfile',function(){
    var id = $(this).attr('data-id');
    $.ajax({
        url: URL_ROOT + '/Admin/user',
        type: 'POST',
        data: {
            id : id
        },
        success:function(data){
            // console.log(data);
            $('.main-panel').html(data);
            $("#bt-s").hide();
        },
        error:function(err){
            console.log(err);
        }
    });
});

$(document).on('click','.approve-application',function(){
    var id = $(this).attr('data-id');
    $.ajax({
        url: URL_ROOT + '/Admin/approve',
        type: 'POST',
        dataType: 'json',
        data: {
            id : id
        },
        success:function(data){
            if(data['status']){
                $.ajax({
                    url: URL_ROOT + '/Template/sendConfirmation',
                    type: 'POST',
                    data: {
                        id : id
                    },
                    success:function(data){
                        // md.showNotification('bottom','right');
                        md.showNotification('bottom','right','success','Application is approved.<br/>Email has been sent to the worker.');

                        function explode(){
                            window.location.href =  URL_ROOT + "/admin";
                          }
                          setTimeout(explode, 4000);
                    }
                });
            console.log(data);
            }
            console.log(data);
        },
        error:function(err){
            console.log(err);
        }
    });
});

$(document).on('click','.chatMsg',function(){
    $('.msgPrepend li').removeClass('open-chat');
    var chat_body = $('.layout .content .chat .chat-body .messages');
    $(this).addClass('open-chat');

    // var chat_body = $('.messages');

    var id = $(this).attr('data-workerId');
    $('.msgIdWorker').attr('data-id',id);
    $.ajax({
        url: URL_ROOT + '/User/messenger',
        type: 'POST',
        data: {
            id: id
        },
        success:function(data){
            $('.messengerContent').html(data);
            $(".chat-body").animate({ scrollTop: $('.chat-body').prop("scrollHeight")}, 1000);
            // $(".messages").animate({ scrollTop: $(".messages").height() }, "slow");
            // return false;
        }
    });
});

$(document).on('click','.m_side',function(){
    $("#nav_ li a").removeClass('active');
    $(this).addClass('active');
    var panel = $(this).attr("data-ui");

    if(panel == "Home"){
        $('body').css('overflow','auto');
        $.ajax({
            url: URL_ROOT + '/User/home',
            success:function(data){
                $('.content').html(data);
            }
        });
    }else if(panel == "Chat"){
        var styles = {
            overflow : "hidden !important",
            overflowY: "hidden !important"
          };
        $("#bBody").css("overflow","hidden !important");
        $.ajax({
            url: URL_ROOT + '/User/chat',
            success:function(data){
                $('.content').html(data);
            }
        });
        
    }
});

$(document).on('click','.sendMsg',function(){
    var id = $(this).attr('data-id');
    $("#nav_ li a").removeClass('active');
    $('.msgM').addClass('active');
    $.ajax({
        url: URL_ROOT + '/User/chat',
        success:function(data){
            $('.content').html(data);
            $.ajax({
                url: URL_ROOT + '/User/append',
                type: 'POST',
                data: {
                    id:id
                },
                success:function(data){
                    $('.list-group li').removeClass('open-chat');
                    $('.msgPrepend').prepend(data);
                    // // $.ajax({
                    // //     url: URL_ROOT + '/User/appendheader',
                    // //     type: 'POST',
                    // //     data: {
                    // //         id:id
                    // //     },
                    // //     success:function(data){
                    // //         $('.headerChat').html(data);
                    // //     }
                    // // });

                    // var id = $(this).attr('data-id');
                    // $.ajax({
                    // url: URL_ROOT + '/User/messenger',
                    // type: 'POST',
                    // data: {
                    //     id: id
                    // },
                    // success:function(data){
                    //     $('.messengerContent').html(data);
                    //     $(".chat-body").animate({ scrollTop: $('.chat-body').prop("scrollHeight")}, 1000);
                    //     // $(".messages").animate({ scrollTop: $(".messages").height() }, "slow");
                    //     // return false;
                    // }
                    // });
                    // var stat = $('#statusText').text();
                    // var name = $('#nameWorker').text();
                    // $('#msgRecvrName').text(name);
                    // $('#visibilityStat').text(stat);
                    $('.msgIdWorker').attr("data-id", id);
                    $('.profId').attr("data-id", id);
                    $(".chat-body").animate({ scrollTop: $('.chat-body').prop("scrollHeight")}, 1000);
                }
            });
        }
    });
});

$(document).on('click','.updateSave',function(){

    var id = $(this).attr('data-id');
    // var signup = $('#personalUpdate').serializeArray();

    var fd = new FormData();
    var photo_data = $('#imgInp').prop('files')[0];
    var firstname = $("#firstname").val();
    var lastname = $("#lastname").val();
    var address = $("#address").val();
    var city = $("#city").val();
    var phone = $("#phone").val();
    fd.append('profilePhoto',photo_data);
    fd.append('firstname',firstname);
    fd.append('lastname',lastname);
    fd.append('address',address);
    fd.append('city',city);
    fd.append('phone',phone);
    fd.append('id',id);
    $.ajax({
        url: URL_ROOT + '/Signup/update',
        type: 'POST',
        dataType: 'json',
        processData: false, // important
        contentType: false, // important
        data: fd,
        success:function(data){
            if(data['status']){
                // md.showNotification('bottom','right','success','Record Successfully!<br/> Redirecting to Login page!!');
                alert("Account has been Update!!");
                // setTimeout(function d(){window.location.href = URL_ROOT + '/User';},2000);
                console.log(data);
            }
            // $('.content').html(data);
            // console.log(data);
        },
        error:function(err){
            console.log(err);
        }
    });
});

$(document).on('click','.prv_prof',function(){
    var id = $(this).attr('data-id');
    $.ajax({
        url: URL_ROOT + '/User/preview',
        type: 'POST',
        data: {
            id: id
        },
        success:function(data){
            if(data == "log"){
                window.location.href =  URL_ROOT + "/Pages/login";
            }
            $('.content').html(data);
        }
    });
});

$(document).on('click','.admin-out',function(){
    $.ajax({
        url: URL_ROOT + '/User/signout',
        success:function(data){
        }
    });
});
