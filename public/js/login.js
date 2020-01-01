var URL_ROOT = "";

(function($) {
  "use strict";

  /*==================================================================
    [ Focus Contact2 ]*/
  $(".input100").each(function() {
    $(this).on("blur", function() {
      if (
        $(this)
          .val()
          .trim() != ""
      ) {
        $(this).addClass("has-val");
      } else {
        $(this).removeClass("has-val");
      }
    });
  });

  /*==================================================================
    [ Validate ]*/
  var input = $(".validate-input .input100");

  $(".validate-form").on("submit", function(e) {
    e.preventDefault();
    var check = true;

    for (var i = 0; i < input.length; i++) {
      if (validate(input[i]) == false) {
        showValidate(input[i]);
        check = false;
      }
    }

    if (check) {
      var loginData = $(".login100-form").serializeArray();
      var usrName = $("#uNameEmail").val();
      var usrPass = $("#uPassword").val();
      $.ajax({
        url: URL_ROOT + "/User/signin",
        type: "POST",
        dataType: "json",
        data: {
          uNameEmail: usrName,
          uPassword: usrPass
        },
        success: function(data) {
          // console.log(data['data']['status']);
          // console.log(data);
          if (data["data"]["status"] == 1) {
            md.showNotification(
              "bottom",
              "right",
              "success",
              "You got it right!<br/>Welcome! Successful login!!"
            );
            setTimeout(function red() {
              window.location.href = URL_ROOT + "/User";
            }, 2000);
            console.log(data);
          } else {
            md.showNotification(
              "bottom",
              "right",
              "danger",
              "Sorry Something wen wrong!<br/>Please check your input."
            );
            // alert("Something went wrong!!");
          }
        },
        error: function(err) {
          console.log(err);
        }
      });
      // console.log(usrName + ' ' + usrPass);
    }

    // return check;
  });

  $(".validate-form .input100").each(function() {
    $(this).focus(function() {
      hideValidate(this);
    });
  });

  function validate(input) {
    if ($(input).attr("type") == "email" || $(input).attr("name") == "email") {
      if (
        $(input)
          .val()
          .trim()
          .match(
            /^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/
          ) == null
      ) {
        return false;
      }
    } else {
      if (
        $(input)
          .val()
          .trim() == ""
      ) {
        return false;
      }
    }
  }

  function showValidate(input) {
    var thisAlert = $(input).parent();

    $(thisAlert).addClass("alert-validate");
  }

  function hideValidate(input) {
    var thisAlert = $(input).parent();

    $(thisAlert).removeClass("alert-validate");
  }
})(jQuery);
