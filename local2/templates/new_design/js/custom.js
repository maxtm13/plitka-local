/*310149*/
document.addEventListener("DOMContentLoaded", chigov_ready);
function chigov_ready() {
  var header_wrap = document.querySelector('body>.wrapper');
  var header = document.querySelector('body>.wrapper>header');
  var sort_brands = document.querySelector('body>.wrapper>header .sort-brands');
  var head_catalog = $('.is-head__catalog .depth-1>.sublevels-wrapper');
  var header_head = document.querySelector('body>.wrapper>header>.head');
  var is_head = document.querySelector('body>.wrapper>header>.is-head__catalog');
  var sort_brands = document.querySelector('header .sort-brands');
  var list_brands = $("header .sort-brands__wrap .sort-brands__sublist");

  //header_wrap.style.paddingTop = header.getBoundingClientRect().height + 'px';

  window.addEventListener('scroll', Ascroll, false);
  document.body.addEventListener('scroll', Ascroll, false);
  function Ascroll() {
    let height_header = header_head.getBoundingClientRect().height;
    let is_head_height = is_head.getBoundingClientRect().height;
    let sort_brands_height = 0;
    if (sort_brands != null) {
      sort_brands_height = sort_brands.getBoundingClientRect().height;
    }
    
    if (header_wrap.getBoundingClientRect().top < -height_header) {
      header_wrap.classList.add('sticky');
      head_catalog.css("height", "calc(100vh - " + (is_head_height + 50) + 'px)');
      list_brands.css(
        "max-height",
        "calc(100vh - " + (is_head_height + sort_brands_height + 10) + "px)"
      );
    } else {
      head_catalog.css(
        "height",
        "calc(100vh - " + (is_head_height + height_header + 50) + "px)"
      );
      list_brands.css(
        "max-height",
        "calc(100vh - " +
          (is_head_height + height_header + sort_brands_height + 10) +
          "px)"
      );
      header_wrap.classList.remove('sticky');
    }

    window.addEventListener('resize', function() {
      //header_wrap.style.paddingTop = header.getBoundingClientRect().height + 'px';
      if (document.querySelector("body>.wrapper").classList.contains("sticky")) {
        head_catalog.css(
          "height",
          "calc(100vh - " + (is_head_height + 50) + "px)"
        );
        list_brands.css(
          "max-height",
          "calc(100vh - " + (is_head_height + sort_brands_height + 10) + "px)"
        );
      } else {
        head_catalog.css(
          "height",
          "calc(100vh - " + (is_head_height + height_header + 50) + "px)"
        );
        list_brands.css(
          "max-height",
          "calc(100vh - " +
            (is_head_height + height_header + sort_brands_height + 10) +
            "px)"
        );
      }
    }, false);
  }

  $(".sort-brands .sort-brands__link").on("click", function () {
    if (window.matchMedia("(max-width: 1000px)").matches) {
      let sub = $(this).next(".sort-brands__sublist");
      if (sub.length > 0) {
        sub.css("right", "auto");
        if (sub.first().position().left + sub.first().width() > $("body").width()) {
          sub.css("right", 0);
        }
      }
    }
  });

  $('.select_page_count, .select_sort').change(function(){
    var getSort = $('[data-type="sort"]').val();
    var getInpage = $('select[data-type="inpage"]').val();
    $.ajax({
      url: '/ajax/set_sort_count.php',
      type: 'POST',
      dataType: 'json',
      data: {
        ajax: true,
        sort: getSort,
        inpage: getInpage,
      },
      async: true,
      success: function (data) {
        document.location.href = window.location.href;
      }
    });
  });
}
