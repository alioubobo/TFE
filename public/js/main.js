$(function () {
  //Tout a été chargé!
  console.log("Dom chargé! ");
  console.log("test ajax");

  //Header
  $(".navbar-toggler").css("background-color", "white");

  //Body
  //***Form validation
  $("form").attr("id", "form");
  //Connexion, inscription, contact
  $("#form").validate({
    rules: {
      email: {
        required: true,
        email: true,
      },
      password: {
        password: true,
      },
    },
    messages: {
      email: {
        required: "Enter a valid email address",
      },
      password: {
        required: "Enter your password",
      },
    },
    submitHandler: function (form) {
      form.submit();
    },
  });
});
