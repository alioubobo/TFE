$(function () {
  //Tout a été chargé!
  console.log("Dom chargé! ");

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
        required: "Entrez une adresse électronique valide",
      },
      password: {
        required: "Entrez votre mot de passe",
      },
    },
    submitHandler: function (form) {
      form.submit();
    },
  });
});
