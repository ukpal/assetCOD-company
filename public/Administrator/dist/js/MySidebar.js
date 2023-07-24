function theme_variant() {
  $(".navbar").addClass(localStorage.getItem('theme_navbar_variants'));
  $('body').addClass(localStorage.getItem('theme_mode'));


  // $('.nav-link .active').addClass(localStorage.getItem('dark_sidebar_variants'));
  // $('.nav-link .active').addClass(localStorage.getItem('dark_sidebar_variants'));
  // http://localhost/assetCOD-company/public/Administrator/images/logo/20221121000811.jpg
  $('select[name="theme_mode"] option[class="' + localStorage.getItem('theme_mode') + '"]').attr("selected", "selected");
  $('select[name="navbar_variants"] option[class="' + localStorage.getItem('theme_navbar_variants') + '"]').attr("selected", "selected");

  

}



theme_variant();



$(document).ready(function () {

  $('select[name="navbar_variants"]').on('change', function () {
    var nav_variant = $('select[name="navbar_variants"] option:selected').attr('class');
    $('.navbar').removeClass(localStorage.getItem('theme_navbar_variants'));
    localStorage.setItem('theme_navbar_variants', nav_variant);
    theme_variant();
  });


  // $('select[name="dark_sidebar_variants"]').on('change', function () {
  //   var dark_sidebar_variants = $('select[name="dark_sidebar_variants"] option:selected').attr('class');
  //   $('.nav-link .active').removeClass(localStorage.getItem('dark_sidebar_variants'));
  //   localStorage.setItem('dark_sidebar_variants', dark_sidebar_variants);
  //   theme_variant();
  // });


  $('select[name="theme_mode"]').on('change', function () {
    var theme_mode = $('select[name="theme_mode"] option:selected').attr('class');
    $('body').removeClass(localStorage.getItem('theme_mode'));
    localStorage.setItem('theme_mode', theme_mode);
    theme_variant();
  });

})