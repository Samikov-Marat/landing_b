let tariffNames={7:{name:"Международный экспресс документы",description:"доставка документов для бизнеса и частных лиц",type:"дверь-дверь"},181:{name:"Международный экспресс документы",description:"доставка документов для бизнеса и частных лиц",type:"склад-склад"},182:{name:"Международный экспресс документы",description:"доставка документов для бизнеса и частных лиц",type:"склад-дверь"},183:{name:"Международный экспресс документы",description:"доставка документов для бизнеса и частных лиц",type:"дверь-склад"},291:{name:"CDEK-Express",description:"доставка только от интернет-магазинов клиентам",type:"склад-склад"},293:{name:"CDEK-Express",description:"доставка только от интернет-магазинов клиентам",type:"дверь-дверь"},294:{name:"CDEK-Express",description:"доставка только от интернет-магазинов клиентам",type:"склад-дверь"},295:{name:"CDEK-Express",description:"доставка только от интернет-магазинов клиентам",type:"дверь-склад"},352:{name:"CDEK-Express",description:"доставка только от интернет-магазинов клиентам",type:"терминал-терминал"},342:{name:"My Express",description:"доставка только между частными лицами: подарки и личные вещи",type:"дверь-дверь"},343:{name:"My Express",description:"доставка только между частными лицами: подарки и личные вещи",type:"дверь-склад"},344:{name:"My Express",description:"доставка только между частными лицами: подарки и личные вещи",type:"склад-дверь"},345:{name:"My Express",description:"доставка только между частными лицами: подарки и личные вещи",type:"склад-склад"},8:{name:"Международный экспресс грузы",description:"доставка образцов и другой продукции для бизнеса",type:"дверь-дверь"},178:{name:"Международный экспресс грузы",description:"доставка образцов и другой продукции для бизнеса",type:"склад-склад"},179:{name:"Международный экспресс грузы",description:"доставка образцов и другой продукции для бизнеса",type:"склад-дверь"},180:{name:"Международный экспресс грузы",description:"доставка образцов и другой продукции для бизнеса",type:"дверь-склад"}};$(document).ready(function(){sliders(),menu(),$(".js-form").on("submit",function(){return $(this).hide(),$(".js-form-result").show(),!1}),$(".js-calculator-step1-button").click(function(){let e=$(this).closest("form"),n=!1,o=e.find("input[name=from_id]");if(""===o.val()&&(o.closest(".form-field").addClass("form-field_error"),n=!0),""===(o=e.find("input[name=to_id]")).val()&&(o.closest(".form-field").addClass("form-field_error"),n=!0),o=e.find("input[name=mass]"),(isNaN(o.val())||o.val()<=0)&&(o.closest(".form-field").addClass("form-field_error"),n=!0),o=e.find("input[name=length]"),(isNaN(o.val())||o.val()<=0)&&(o.closest(".form-field").addClass("form-field_error"),n=!0),o=e.find("input[name=width]"),(isNaN(o.val())||o.val()<=0)&&(o.closest(".form-field").addClass("form-field_error"),n=!0),o=e.find("input[name=height]"),(isNaN(o.val())||o.val()<=0)&&(o.closest(".form-field").addClass("form-field_error"),n=!0),n)return!1;$(".calculator__content_step1").addClass("calculator__content_loading"),$(".js-calculator-header-from").html(e.find("input[name=from]").val()),$(".js-calculator-header-to").html(e.find("input[name=to]").val()),$(".js-calculator-header-mass").html(e.find("input[name=mass]").val());let i=e.find("input[name=length]").val()/100*e.find("input[name=width]").val()/100*e.find("input[name=height]").val()/100;return $(".js-calculator-header-volume").html(i.toFixed(3)),function(){let e={count:0},n=t.getTariffCodes(),o={orderType:1,senderCity:{id:t.getCityCodeFrom()},receiverCity:{id:t.getCityCodeTo()},idCurrency:t.getUsedCurrency(),idInterface:3,idServiceType:291,goodsList:[{weight:t.getMass(),height:t.getHeight(),width:t.getWidth(),length:t.getLength()}],lang:t.getLanguage()},i=[];for(let t in n)i[t]=null;for(let t in n)o.idServiceType=n[t],a(t,o,i,e)}(),!1});let t=new function(t){this.form=t,this.step=1,this.getTariffCodes=function(){return[7,8,291,344,345,291,293,294,295,352]},this.getUsedCurrency=function(){return 1},this.getUsedCurrencyName=function(){return"₽"},this.getCityCodeFrom=function(){return $(".js-calculator-from-id").val()},this.getCityCodeTo=function(){return $(".js-calculator-to-id").val()},this.getMass=function(){return $(".form-field__input[name=mass]").val()},this.getLength=function(){return $(".form-field__input[name=length]").val()},this.getWidth=function(){return $(".form-field__input[name=width]").val()},this.getHeight=function(){return $(".form-field__input[name=height]").val()},this.getLanguage=function(){return"rus"},this.getStep=function(){return this.step},this.setStep=function(t){return this.step=t,this}}("div.calculator"),e=new function(){this.url="https://webproxy.cdek.ru/calculator",this.getSettings=function(t){return{method:"post",url:this.url,headers:{"access-control-allow-origin":"*",accept:"application/json, text/plain, */*","content-type":"application/x-www-form-urlencoded"},data:{json:JSON.stringify(t)},xhrFields:{withCredentials:!0}}}};function a(a,n,o,i){let r=t.getTariffCodes();$.ajax(e.getSettings(n)).done(function(t){t.result.hasOwnProperty("error")||(o[a]={id:r[a],price:t.result.price})}).always(function(){i.count++,i.count==r.length&&function(e){let a=$(".js-calculator-tariff-template").find(".calculator__tariff-item"),n=$(".calculator__tariff-list");n.empty(),$.each(e,function(e,o){if(null!==o){let e=a.clone(),i=tariffNames[o.id];e.find(".calculator__tariff-item-input").attr("id",o.id).prop("id",o.id),e.find(".calculator__tariff-item-input").val(o.id+" ("+i.name+") "+o.price+t.getUsedCurrencyName()),e.find(".calculator__tariff-item-input").data("price",o.price),e.find(".calculator__tariff-item-label").html(i.name).attr("for",o.id).prop("for",o.id),e.find(".calculator__tariff-item-description").html(i.description),e.find(".calculator__tariff-item-type").html(i.type),e.find(".calculator__tariff-item-price").html(o.price),n.append(e)}}),$(".calculator__content_step1").hide(),$(".calculator__content_step2").removeClass("calculator__content_loading").show(),t.setStep(2)}(o)})}function n(e){$(".calculator__content").has(e).addClass("calculator__content_loading"),$(".calculator__content_step2").hide(),$(".js-calculator-header-price").html($(e).data("price")+" "+t.getUsedCurrencyName()),$(".calculator__content_step3").removeClass("calculator__content_loading").show(),t.setStep(3)}function o(t){t.val(""),t.autocomplete("clear");let e=t.data("for");$(e).val("")}$(".calculator__content_step2 .calculator__step-link_back").click(function(){return $(".calculator__content_step2").hide(),$(".calculator__content_step1").removeClass("calculator__content_loading").show(),t.setStep(1),!1}),$(".calculator__content_step2").on("change",".calculator__tariff-item-input",function(){return n(this),!1}),$(".calculator__content_step2").on("click",".calculator__tariff-item-input:checked",function(){n(this)}),$(".calculator__content_step3 .calculator__step-link_back").click(function(){return $(".calculator__content_step3").hide(),$(".calculator__content_step2").removeClass("calculator__content_loading").show(),t.setStep(2),!1}),$(".calculator__content .calculator__step-link_repeat").click(function(){return o($(".js-calculator-form input[name=from]")),o($(".js-calculator-form input[name=to]")),$(".js-calculator-form input[name=mass]").val(""),$(".js-calculator-form input[name=length]").val(""),$(".js-calculator-form input[name=width]").val(""),$(".js-calculator-form input[name=height]").val(""),$(".calculator__content_step2 .calculator__tariff-item-input").prop("checked",!1),t.setStep(1),$(".calculator__content").css("display","none"),$(".calculator__content_step1").removeClass("calculator__content_loading").show(),!1}),$(".js-calculator-form").submit(function(){if(1==t.getStep())return $(".js-calculator-step1-button").trigger("click"),!1;if(2==t.getStep())return!1;let e=$(this),a=!1,n=e.find("input[name=name]");if(""===n.val()&&(n.closest(".form-field").addClass("form-field_error"),a=!0),""===(n=e.find("input[name=phone]")).val()&&(n.closest(".form-field").addClass("form-field_error"),a=!0),""===(n=e.find("input[name=email]")).val()&&(n.closest(".form-field").addClass("form-field_error"),a=!0),(n=e.find("input[name=agree]")).prop("checked")||(n.closest(".form__row").addClass("form-field_error"),a=!0),a)return!1;var o=$(".calculator__content").has(this);o.addClass("calculator__content_loading");let i={url:e.prop("action"),data:e.serialize()};return $.post(i).done(function(){$(".calculator__content_step3").hide(),$(".js-calculator__content_step-result-ok").css("height",o.css("height")).removeClass("calculator__content_loading").show()}).fail(function(){$(".calculator__content_step3").hide(),$(".js-calculator__content_step-result-error").css("height",o.css("height")).removeClass("calculator__content_loading").show()}),!1}),$(".form-field__input[name=from],.form-field__input[name=to]").autocomplete({minChars:1,deferRequestBy:0,serviceUrl:"https://webproxy.cdek.ru/city",type:"POST",dataType:"json",autoSelectFirst:!0,ajaxSettings:{contentType:"application/json; charset=utf-8",processData:!1,beforeSend:function(t,e){e.data=JSON.stringify(e.data)}},onSearchStart:function(t){t.limit=5,t.field="term",t.value=$.trim(t.query)+"%",t.lang="rus"},transformResult:function(t){return{suggestions:$.map(t.items,function(t){return{value:t.name,data:t.code}})}},onSelect:function(t){$(this).val(t.value);let e=$(this).data("for");$(e).val(t.data)},onInvalidateSelection:function(){let t=$(this).data("for");$(t).val("")}}),$(".form-field__input[name=from],.form-field__input[name=to]").on("blur.autocomplete",function(){let t=$(this).data("for");""===$(t).val()&&$(this).val("")}),$(".js-calculator-form, .js-feedback-form").on("focus","input",function(){$(this).closest(".form-field").removeClass("form-field_error")}),$(".js-calculator-form, .js-feedback-form").on("click","input",function(){$(this).closest(".form-field_error").removeClass("form-field_error")}),modalOpen=function(t){$(".modal-opened").length&&modalClose($(".modal-opened")),0==$(".modal-bg").length&&$("<div></div>").addClass("modal-bg").css("width",$(document).width()).css("height",$(document).height()).prependTo("body");var e=document.all?document.scrollTop:window.pageYOffset;$(".modal-container").has(t).css("display","flex").css("padding-top",e+"px"),t.addClass("modal-opened").css("display","block"),$(window).width()<=480&&$("body").css("height","100vh").css("position","relative").css("overflow","hidden")},modalClose=function(t){t.removeClass("modal-opened").css("display","none"),$(".modal-container").has(t).css("display","none").css("padding-top",0),$(".modal-bg").remove(),$("body").css("height","auto").css("overflow","auto")},$(".js-feedback-open").click(function(){return $(".js-modal-result-ok").hide(),$(".js-modal-result-error").hide(),$(".modal__content_form").removeClass("modal__content_loading").show(),$(".modal__content_form").find("textarea[name=message]").val(""),modalOpen($("#feedback-modal")),!1}),$(".modal__close").click(function(){modalClose($(".modal").has(this))}),$(".js-feedback-form").submit(function(){let t=$(this),e=!1,a=t.find("input[name=name]");if(""===a.val()&&(a.closest(".form-field").addClass("form-field_error"),e=!0),""===(a=t.find("input[name=phone]")).val()&&(a.closest(".form-field").addClass("form-field_error"),e=!0),""===(a=t.find("input[name=email]")).val()&&(a.closest(".form-field").addClass("form-field_error"),e=!0),(a=t.find("input[name=agree]")).prop("checked")||(a.closest(".form__row").addClass("form-field_error"),e=!0),e)return!1;let n={url:t.prop("action"),data:t.serialize()};var o=$(".modal__content").has(this);return o.addClass("modal__content_loading"),$.post(n).done(function(){o.hide(),$(".js-modal-result-ok").css("height",o.css("height")).removeClass("modal__content_loading").show()}).fail(function(){o.hide(),$(".js-modal-result-error").css("height",o.css("height")).removeClass("modal__content_loading").show()}),!1}),$(".js-partners-more").click(function(){return $(".js-parners-other").show(400),$(this).closest(".js-partners-more-block").hide(),!1})}),function(t,e){function a(){e(".js-menu-container").removeClass("opened"),e(".js-fade_background").removeClass("opened")}t.menu=function(){e(".js-menu-open-button").click(function(){return e(".js-menu-container").addClass("opened"),e(".js-fade_background").addClass("opened"),!1}),e(".js-menu-close-button").click(function(){return a(),!1}),e(".js-fade_background").click(function(){return a(),!1})}}(window,jQuery),function(t,e){t.activateSlider=function(t,e){t.hasClass("activated")||(t.addClass("activated"),setTimeout(function(){t.owlCarousel(e)},100))},t.destroySlider=function(t){t.hasClass("activated")&&(t.removeClass("activated"),t.trigger("destroy.owl.carousel"))}}(window,jQuery),function(t,e){t.sliders=function(){var a=e(".js-company-advantages"),n={nav:!0,dots:!0,items:1,loop:!0,autoplay:!1,autoplayTimeout:5e3,autoplayHoverPause:!0,margin:0,autoHeight:!0};e(t).resize(function(){t.innerWidth>=481?destroySlider(a):activateSlider(a,n)}),e(t).trigger("resize")}}(window,jQuery),$(function(){$(".js-faq-tab").click(function(){$(".js-faq-tab").removeClass("submenu__item_active"),$(this).addClass("submenu__item_active");let t=$(this).data("for");return $(".faq__faq-list").addClass("hidden"),$(t).removeClass("hidden"),!1}),$(".faq-list__faq-question").click(function(){$(this).closest(".faq-list__faq").toggleClass("faq-list__faq_opened")}),$(".js-how-it-works-tab").click(function(){$(".js-how-it-works-tab").removeClass("submenu__item_active"),$(this).addClass("submenu__item_active");let t=$(this).data("for");$(".js-how-it-works-content").each(function(){$(this).data("for")==t?$(this).removeClass("hidden"):$(this).addClass("hidden")})})});