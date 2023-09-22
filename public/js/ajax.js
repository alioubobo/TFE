$(function () {
  console.log("ok");

  $("#invit-paiement").click(function () {
    $("#invitpaiement").html(
      "<p>Veillez-vous connecter pour acceder au bouton de paiement</p>"
    );
  });

  // $("#paiement-reussi").click(function () {
  //   let path = "{{ path('last_trainings') }}";
  //   $("#paiementreussi").load(path);
  // });
});
