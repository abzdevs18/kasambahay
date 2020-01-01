var URL_ROOT = "/sf_kasambahay";
// $(function () {

//     /**
//      * Some examples of how to use features.
//      *
//      **/

//     var SohoExamle = {
//         Message: {
//             add: function (message, type) {
//                 var chat_body = $('.layout .content .chat .chat-body');
//                 if (chat_body.length > 0) {

//                     type = type ? type : '';
//                     message = message ? message : 'I did not understand what you said!';

//                     $('.layout .content .chat .chat-body .messages').append(`<div class="message-item ` + type + `">
//                         <div class="message-avatar">
//                             <figure class="avatar">
//                                 <img src="` + URL_ROOT + `/img/` + (type == 'outgoing-message' ? 'form-wizard-2.jpg' : 'form-wizard-2.jpg') + `" class="rounded-circle">
//                             </figure>
//                             <div>
//                                 <h5>` + (type == 'outgoing-message' ? 'Mirabelle Tow' : 'Byrom Guittet') + `</h5>
//                                 <div class="time">14:50 PM ` + (type == 'outgoing-message' ? '<i class="ti-check"></i>' : '') + `</div>
//                             </div>
//                         </div>
//                         <div class="message-content">
//                             ` + message + `
//                         </div>
//                     </div>`);

//                     setTimeout(function () {
//                         chat_body.scrollTop(chat_body.get(0).scrollHeight, -1).niceScroll({
//                             cursorcolor: 'rgba(66, 66, 66, 0.20)',
//                             cursorwidth: "4px",
//                             cursorborder: '0px'
//                         }).resize();
//                     }, 200);
//                 }
//             }
//         }
//     };

//     setTimeout(function () {
//         // $('#disconnected').modal('show');
//         // $('#call').modal('show');
//         // $('#videoCall').modal('show');
//         $('#pageTour').modal('show');
//     }, 1000);

//     $(document).on('submit', '.layout .content .chat .chat-footer form', function (e) {
//         e.preventDefault();

//         var input = $(this).find('input[type=text]');
//         var message = input.val();
//         var recvr = $(this).attr("data-id");
//         var sndr = $(this).attr("data-sendr");

//         message = $.trim(message);
//         $.ajax({
//             url: URL_ROOT + '/Admin/setMessage',
//             type: 'POST',
//             data: {
//                 msgContent : message,
//                 clientId : recvr,
//                 sessionId : sndr
//             },
//             success:function(data){
//                 console.log(recvr + data);
//                 // $('.main-panel').html(data);
//             },
//             error:function(err){
//                 console.log(err);
//             }
//         });
//         input.val('');

//         // if (message) {
//         //     SohoExamle.Message.add(message, 'outgoing-message');
//         //     $.ajax({
//         //         url: URL_ROOT + '/Admin/setMessage',
//         //         type: 'POST',
//         //         data: {
//         //             msgContent : message,
//         //             clientId : recvr,
//         //             sessionId : sndr
//         //         },
//         //         success:function(data){
//         //             console.log(recvr + data);
//         //             // $('.main-panel').html(data);
//         //         },
//         //         error:function(err){
//         //             console.log(err);
//         //         }
//         //     });
//         //     input.val('');

//         //     // setTimeout(function () {
//         //     //     SohoExamle.Message.add();
//         //     // }, 1000);
//         // } else {
//         //     input.focus();
//         // }
//     });

//     $(document).on('click', '.layout .content .sidebar-group .sidebar .list-group-item', function () {
//         if (jQuery.browser.mobile) {
//             $(this).closest('.sidebar-group').removeClass('mobile-open');
//         }
//     });

// });

$(function () {
var chat_body = $('.layout .content .chat .chat-body');
$(document).on('submit', '.layout .content .chat .chat-footer form', function (e) {
    e.preventDefault();

    var input = $(this).find('input[type=text]');
    var message = input.val();
    var recvr = $(this).attr("data-id");
    var sndr = $(this).attr("data-sendr");

    message = $.trim(message);
    setTimeout(function () {
        chat_body.scrollTop(chat_body.get(0).scrollHeight, -1).niceScroll({
            cursorcolor: 'rgba(66, 66, 66, 0.20)',
            cursorwidth: "4px",
            cursorborder: '0px'
        }).resize();
    }, 200);
    $.ajax({
        url: URL_ROOT + '/Admin/setMessage',
        type: 'POST',
        data: {
            msgContent : message,
            clientId : recvr,
            sessionId : sndr
        },
        success:function(data){
            // $.ajax({
            //     url: URL_ROOT + '/User/messenger',
            //     type: 'POST',
            //     data: {
            //         id: sndr
            //     },
            //     success:function(data){
            //         // if(data == "log"){
            //         //     window.location.href =  URL_ROOT + "/Pages/login";
            //         // }
            //         // $('.messengerContent').html(data);
            //     }
            // });
            // console.log(recvr + data);
            // $('.main-panel').html(data);

        },
        error:function(err){
            console.log(err);
        }
    });
    input.val('');
});
});