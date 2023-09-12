$(function () {
  //Tout a été chargét il un sousis
  console.log("Dom chargé! ???");

  //Header
  $(".navbar-toggler").css("background-color", "white");

  //Body
  //***Validation des formulaires
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
        required: "Entrez une adresse email valide",
      },
      password: {
        required: "Entrez votre mot de passe",
      },
    },
    submitHandler: function (form) {
      form.submit();
    },
  });

  // $(document).ready(function () {
  //   $("#form").submit(function (event) {
  //     if ($("#contact_email").val().length === 0) {
  //       $("#contact_email").after("<span>Merci de remplir ce champ</span>");
  //       event.preventDefaut();
  //     }
  //   });
  // });
});
