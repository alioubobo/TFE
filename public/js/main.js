$(function () {
  //Tout a été chargét il un sousis
  console.log("Dom chargé!");
  //Header
  $(".navbar-toggler").css("background-color", "white");

  //Body
  //***Validation des formulaires
  $("form").attr("id", "form");
  //Connexion
  $("#form").validate({
    rules: {
      email: {
        minlength: 2,
      },
    },
    messages: {
      email: {
        required: "Entrez une adresse email valide",
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
