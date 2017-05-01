;(function () {

  $(".showPassword").mousedown(function (e) {
    $("#password").removeAttr("type")
  })
  
  $(".showPassword").mouseup(function (e) {
    $("#password").attr("type", "password")
  })

  $(".showPasswordRepeat").mousedown(function (e) {
    $("#passwordRepeat").removeAttr("type")
  })
  
  $(".showPasswordRepeat").mouseup(function (e) {
    $("#passwordRepeat").attr("type", "password")
  })

})()