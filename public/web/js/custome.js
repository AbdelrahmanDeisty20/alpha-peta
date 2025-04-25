

$(".remove_mune").click(function () {
    $("#menu-div").removeClass("active");
    $(".bg_menu").removeClass("active");
  });
  
  function open() {
    $(".navicon").addClass("is-active");
    $("#menu-div").addClass("active");
    $("#times-ican").addClass("active");
    $(".bg_menu").addClass("active");
  }
  
  function close() {
    $(".navicon").removeClass("is-active");
    $("#menu-div").removeClass("active");
    $("#times-ican").removeClass("active");
    $(".bg_menu").removeClass("active");
    $(".dropdowm-language").slideUp();
    $(".dropdowm-language-mune").slideUp();
    $(".dropdowm-element").slideUp();
    $(".dropdowm-element-mune").slideUp();
  
    $(".remove-mune").click(function () {
      $("#menu-div").removeClass("active");
      $(".bg_menu").removeClass("active");
      $(".times-ican").removeClass("active");
    });
  }
  
  $("#times-ican").click(function () {
    if ($(this).hasClass("active")) {
      close();
    } else {
      open();
    }
  });
  
  $(".btns_menu_responsive").click(function (e) {
    close();
  });
  
  $(".remove-mune").click(function () {
    $("#menu-div").removeClass("active");
    $(".bg_menu").removeClass("active");
    $(".times-ican").removeClass("active");
    $(".navicon").removeClass("is-active");
  });
  
  $("#menu-div a").click(function () {
    e.preventDefault();
  });
  
  
var $winl = $(window); // or $box parent container
var $boxl = $(
  "#menu-div, #times-ican , .click-element   , .dropdowm-element-mune"
);
$winl.on("click.Bst", function (event) {
  if (
    $boxl.has(event.target).length === 0 && //checks if descendants of $box was clicked
    !$boxl.is(event.target) //checks if the $box itself was clicked
  ) {
    close();
  }
});