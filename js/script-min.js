jQuery(window).on("load",(function(){jQuery})),jQuery(document).ready((function(e){jQuery(document).ready((function(e){e(".radio-toggle .input-radio").change((function(){var t="0"===e(this).val();e("#ship-to-different-address-checkbox").prop("checked",t),e("#ship-to-different-address-checkbox").trigger("click")}))}));e("header.fixed-bottom");String.prototype.getDecimals||(String.prototype.getDecimals=function(){var e=(""+this).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);return e?Math.max(0,(e[1]?e[1].length:0)-(e[2]?+e[2]:0)):0}),e(document.body).on("click",".plus, .minus",(function(){console.log("1");var t=e(this).closest(".quantity").find(".qty"),s=parseFloat(t.val()),a=parseFloat(t.attr("max")),o=parseFloat(t.attr("min")),n=t.attr("step");s&&""!==s&&"NaN"!==s||(s=0),""!==a&&"NaN"!==a||(a=""),""!==o&&"NaN"!==o||(o=0),"any"!==n&&""!==n&&void 0!==n&&"NaN"!==parseFloat(n)||(n=1),e(this).is(".plus")?a&&s>=a?t.val(a):t.val((s+parseFloat(n)).toFixed(n.getDecimals())):o&&s<=o?t.val(o):s>0&&t.val((s-parseFloat(n)).toFixed(n.getDecimals())),t.trigger("change")}));const t=e("body"),s=e("main"),a=e(".js-menu");e(".js-toggle-menu").on("mouseenter",(function(){t.hasClass("menu-open")||(t.addClass("menu-open"),s.addClass("blur"),a.delay(0).fadeToggle(100,"swing"))})).on("click",(function(e){e.preventDefault(),t.toggleClass("menu-open"),s.toggleClass("blur"),a.delay(0).fadeToggle(100,"swing")})),e(".bg-overlay").on("mouseenter",(function(){t.hasClass("menu-open")&&(jQuery.ajax({type:"POST",url:artez_object.ajax_url,data:{action:"artez_random_bg",nonce:artez_object.nonce},success:function(e){jQuery(".bg-overlay").css("background-image","url("+e+")")},error:function(e){alert("Error on closing menu")}}),t.removeClass("menu-open"),s.toggleClass("blur"),a.delay(0).fadeToggle(100,"swing"))}));var o,n=document.getElementsByClassName("accordion-toggle");for(o=0;o<n.length;o++)n[o].addEventListener("click",(function(){this.classList.toggle("active");var e=this.nextElementSibling,t=e.firstElementChild;e.style.height?(t.style.height=null,e.style.height=null,e.classList.toggle("open")):(e.style.height=t.scrollHeight+64+"px",t.style.height=t.clientHeight+"px",setTimeout((()=>{e.classList.toggle("open")}),100))}));e(".owl-carousel").owlCarousel({items:1,loop:!0,autoplay:!0,dots:!0,lazyLoad:!0}),e(".wp-end-of-page").waypoint({handler:function(t){console.log("client height"),"down"===t?e(".main-menu-container").css({opacity:0}):e(".main-menu-container").css({opacity:1})},offset:"80%"}),document.addEventListener("click",(function(e){var t,s,a,o,n,i=[];for(t=document.getElementsByClassName("select-items"),s=document.getElementsByClassName("select-selected"),o=t.length,n=s.length,a=0;a<n;a++)e==s[a]?i.push(a):s[a].classList.remove("select-arrow-active");for(a=0;a<o;a++)i.indexOf(a)&&t[a].classList.add("select-hide")})),e(".js-filter-collapse").click((function(t){e(this).toggleClass("active")}));var i=e(".product"),l=[];e(".js-reset-filters").click((function(t){l=[],i.show(),e(".js-filter-item").removeClass("active")})),e(".js-filter-item").click((function(t){t.preventDefault();var s=e(this),a=(e(".products"),s.data("filter"));s.data("tag");if(s.toggleClass("active"),-1!==l.indexOf(a))return l=l.filter((e=>e!==a)),i.each((function(){-1!==e(this).data("filters").indexOf(a)&&e(this).hide()})),void(l.length||e(".js-reset-filters").click());l.push(a),a&&i.each((function(){var t=e(this);-1===t.data("filters").indexOf(a)?l.every((e=>!t.data("filters").includes(e)))&&t.hide():t.show()}))})),e(".js-main-search").on("submit",(function(t){t.preventDefault();var s=e(this).find("input[type=search]").val().toLowerCase();s?(i.each((function(){var t=e(this);-1===t.data("search").toLowerCase().indexOf(s)?t.hide():t.show()})),i.is(":visible")?e(".products__not-found").hide():e(".products__not-found").show()):l.length||i.show()})),e(window).on("scroll",(function(){var t=e(this).scrollTop(),s=e(".js-hide-onscroll"),a=e(".js-show-onscroll");t>=20?(s.removeClass("shown").addClass("hidden"),a.removeClass("hidden").addClass("shown")):(s.removeClass("hidden").addClass("shown"),a.removeClass("shown").addClass("hidden"))})),e(".js-search-toggle").click((function(){e(".js-hide-onscroll").removeClass("hidden").addClass("shown"),e(".js-show-onscroll").removeClass("shown").addClass("hidden")}));var r=document.querySelector(".js-tags-container"),c={offset:0,atStart:!0,atEnd:!1,containerWidthDiff:document.querySelector(".js-tags").scrollWidth-r.clientWidth};if(c.containerWidthDiff<=0)e(".js-tags-next").closest(".filter-tags__next").hide(),e(".js-tags-prev").closest(".filter-tags__prev").hide();else{function d(e){return Math.min(Math.max(e,0),c.containerWidthDiff)}function f(){c.atStart=0>=c.offset,c.atEnd=c.offset>=c.containerWidthDiff&&!c.atStart,c.offset=d(c.offset),e(".js-tags-next").closest(".filter-tags__next").css("display","flex"),e(".js-tags-prev").closest(".filter-tags__prev").css("display","flex"),c.atEnd&&(e(".js-tags-next").closest(".filter-tags__next").hide(),e(".js-tags-next").closest(".filter-tags__prev").css("display","flex")),c.atStart&&(e(".js-tags-prev").closest(".filter-tags__prev").hide(),e(".js-tags-next").closest(".filter-tags__next").css("display","flex"))}f(),e(".js-tags-prev").click((function(){c.offset=d(c.offset-320),e(".js-tags").css("transform","translateX(-"+c.offset+"px)"),f()})),e(".js-tags-next").click((function(){c.offset=d(c.offset+320),e(".js-tags").css("transform","translateX(-"+c.offset+"px)"),f()}))}}));