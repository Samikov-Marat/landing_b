$((function(){$("body").on("click",".js-delete-confirm",(function(){let e=$(".js-delete-confirm-modal");e.find(".js-delete-confirm-form").prop("action",$(this).data("action")),e.find(".js-delete-confirm-id").val($(this).data("id")),e.find(".js-delete-confirm-text").html($(this).data("text")),e.modal("show")}))})),$((function(){var e=null;$(".js-admin-texts-line-page").on("click","td",(function(){$(".js-admin-texts-modal-dialog").empty(),$(".js-admin-texts-modal-content-dummy").find(".modal-content").clone().appendTo(".js-admin-texts-modal-dialog"),$("#id_modal_admin_texts_edit").modal("show");let t=$(this).closest("tr").data("url");e=$.ajax({url:t,method:"GET",dataType:"html"}).done((function(t){$(".js-admin-texts-modal-dialog").html(t),e=null}))})),$("#id_modal_admin_texts_edit").on("bs.modal.hide",(function(){null!==e&&e.abort()})),$(".js-admin-texts-filter").on("input",(function(){let e=$(this).val(),t=new RegExp(e.replace(/[.*+\-?^${}()|[\]\\]/g,"\\$&"),"i");$(".js-admin-texts-line-for-filter").each((function(){let a=!1;""!==e?$(this).find(".js-admin-texts-td-for-filter").each((function(){if(function(e,t){return-1!=e.search(t)}($(this).attr("data-text"),t))return a=!0,!1})):a=!0,$(this).toggle(a)}))})),$(".js-admin-texts-filter-clear").on("click",(function(){$(".js-admin-texts-filter").val(""),$(".js-admin-texts-filter").trigger("input"),$(".js-admin-texts-filter").focus()}))})),$((function(){$(".js-admin-role-permission-block").on("click",(function(){let e=$(this),t="on"==$(this).data("action");$(this).closest("form").find(".js-admin-role-permission").each((function(){e.data("block")==$(this).data("block")&&$(this).prop("checked",t)}))}))})),$((function(){$(".js-page-is-layout-checkbox").on("click",(function(){let e=$(this).data("url_field");$(e).prop("disabled",$(this).prop("checked"))}))}));let oldId=1;function generateId(){return oldId++,oldId}$((function(){$(".js-local-office-phone-add").click((function(){let e=$(".js-local-office-phone-template .js-local-office-phone-item").clone(),t=$(this).data("name")+"["+generateId()+"]";return e.find(".js-local-office-phone-text").prop("name",t+"[phone_text]"),e.find(".js-local-office-phone-value").prop("name",t+"[phone_value]"),$(".js-local-office-phone-block").append(e),!1})),$(".js-local-office-phone-block").on("click",".js-local-office-phone-delete",(function(){$(this).closest(".js-local-office-phone-item").remove()})),$(".js-local-office-email-add").click((function(){let e=$(".js-local-office-email-template .js-local-office-email-item").clone(),t=$(this).data("name")+"["+generateId()+"]";return e.find(".js-local-office-email-text").prop("name",t+"[email]"),$(".js-local-office-email-block").append(e),!1})),$(".js-local-office-email-block").on("click",".js-local-office-email-delete",(function(){$(this).closest(".js-local-office-email-item").remove()})),$(".js-select2-local-office-franchisee").select2({language:"ru"})})),$((function(){let e=$(".js-top-office-code-search");e.select2({language:"ru",ajax:{url:e.data("ajaxUrl"),dataType:"json",data:function(e){return{term:e.term,page:e.page||1}}},templateResult:function(e){return $('<div class="clearfix"><samp style="background: #9affc6">'+e.code+"</samp> "+e.full_address+"</div>")},templateSelection:function(e){void 0!==$(e.element).data("old")?office=$(e.element).data("old"):office=e;return $('<div class="clearfix"><samp style="background: #9affc6">'+office.code+"</samp> "+office.full_address+"</div>")}})})),$((function(){let e=$(".js-world-languages-code-search");e.select2({language:"ru",ajax:{url:e.data("ajaxUrl"),dataType:"json",data:function(e){return{term:e.term,page:e.page||1}}},templateResult:function(e){return $('<div class="clearfix"><samp style="background: #9affc6">'+e.code_iso+"</samp> "+e.name+"</div>")},templateSelection:function(e){void 0!==$(e.element).data("old")?office=$(e.element).data("old"):office=e;return $('<div class="clearfix"><samp style="background: #9affc6">'+office.code_iso+"</samp> "+office.name+"</div>")}})})),$((function(){let e=$(".js-languages-code-search");e.select2({language:"ru",ajax:{url:e.data("ajaxUrl"),dataType:"json",data:function(e){return{term:e.term,page:e.page||1}}},templateResult:function(e){return $('<div class="clearfix"><samp style="background: #9affc6">'+e.code_iso+"</samp> "+e.name+"</div>")},templateSelection:function(e){void 0!==$(e.element).data("old")?office=$(e.element).data("old"):office=e;return $('<div class="clearfix"><samp style="background: #9affc6">'+office.code_iso+"</samp> "+office.name+"</div>")}})})),$((function(){$(".image_file_autocomplete_from").on("change",(function(){$(".url_autocomplete_to").val("/"+$(this)[0].files[0].name)}))})),$((function(){let e=$(".js-statistics-sites-search");e.select2({language:"ru",width:"resolve",allowClear:!0,placeholder:"Любые",ajax:{url:e.data("ajaxUrl"),dataType:"json",data:function(e){return{term:e.term,page:e.page||1}}},templateResult:function(e){if(e.loading)return $('<div class="clearfix">Получение списка</div>');return $('<div class="clearfix">'+e.site+"</div>")},templateSelection:function(e){if(""==e.id)return e.text;void 0!==$(e.element).data("old")?stat=$(e.element).data("old"):stat=e;return $('<div class="clearfix">'+stat.site+"</div>")}})})),$((function(){let e=$(".js-statistics-utm-source-search");e.select2({language:"ru",width:"resolve",allowClear:!0,placeholder:"Любые",ajax:{url:e.data("ajaxUrl"),dataType:"json",data:function(e){return{term:e.term,page:e.page||1}}},templateResult:function(e){if(e.loading)return e.text;return $('<div class="clearfix">'+e.utm_source+"</div>")},templateSelection:function(e){if(""==e.id)return e.text;if(e.loading)return $('<div class="clearfix">Получение списка</div>');void 0!==$(e.element).data("old")?stat=$(e.element).data("old"):stat=e;return $('<div class="clearfix">'+stat.utm_source+"</div>")}})})),$((function(){let e=$(".js-statistics-utm-medium-search");e.select2({language:"ru",width:"resolve",allowClear:!0,placeholder:"Любые",ajax:{url:e.data("ajaxUrl"),dataType:"json",data:function(e){return{term:e.term,page:e.page||1}}},templateResult:function(e){if(e.loading)return $('<div class="clearfix">Получение списка</div>');return $('<div class="clearfix">'+e.utm_medium+"</div>")},templateSelection:function(e){if(""==e.id)return e.text;void 0!==$(e.element).data("old")?stat=$(e.element).data("old"):stat=e;return $('<div class="clearfix">'+stat.utm_medium+"</div>")}})})),$((function(){let e=$(".js-statistics-utm-campaign-search");e.select2({language:"ru",width:"resolve",allowClear:!0,placeholder:"Любые",ajax:{url:e.data("ajaxUrl"),dataType:"json",data:function(e){return{term:e.term,page:e.page||1}}},templateResult:function(e){if(e.loading)return $('<div class="clearfix">Получение списка</div>');return $('<div class="clearfix">'+e.utm_campaign+"</div>")},templateSelection:function(e){if(""==e.id)return e.text;void 0!==$(e.element).data("old")?stat=$(e.element).data("old"):stat=e;return $('<div class="clearfix">'+stat.utm_campaign+"</div>")}})})),$((function(){let e=$(".js-statistics-utm-term-search");e.select2({language:"ru",width:"resolve",allowClear:!0,placeholder:"Любые",ajax:{url:e.data("ajaxUrl"),dataType:"json",data:function(e){return{term:e.term,page:e.page||1}}},templateResult:function(e){if(e.loading)return $('<div class="clearfix">Получение списка</div>');return $('<div class="clearfix">'+e.utm_term+"</div>")},templateSelection:function(e){if(""==e.id)return e.text;void 0!==$(e.element).data("old")?stat=$(e.element).data("old"):stat=e;return $('<div class="clearfix">'+stat.utm_term+"</div>")}})})),$((function(){let e=$(".js-statistics-utm-content-search");e.select2({language:"ru",width:"resolve",allowClear:!0,placeholder:"Любые",ajax:{url:e.data("ajaxUrl"),dataType:"json",data:function(e){return{term:e.term,page:e.page||1}}},templateResult:function(e){if(e.loading)return $('<div class="clearfix">Получение списка</div>');return $('<div class="clearfix">'+e.utm_content+"</div>")},templateSelection:function(e){if(""==e.id)return e.text;void 0!==$(e.element).data("old")?stat=$(e.element).data("old"):stat=e;return $('<div class="clearfix">'+stat.utm_content+"</div>")}})})),$((function(){$(".js-statistics-sites-search").on("select2:select select2:unselect",(function(){$(this).closest("form").submit()})),$(".js-statistics-utm-source-search").on("select2:select select2:unselect",(function(){$(this).closest("form").submit()})),$(".js-statistics-utm-medium-search").on("select2:select select2:unselect",(function(){$(this).closest("form").submit()})),$(".js-statistics-utm-campaign-search").on("select2:select select2:unselect",(function(){$(this).closest("form").submit()})),$(".js-statistics-utm-term-search").on("select2:select select2:unselect",(function(){$(this).closest("form").submit()})),$(".js-statistics-utm-content-search").on("select2:select select2:unselect",(function(){$(this).closest("form").submit()})),$(".js-statistics-send-form").on("change",(function(){$(this).closest("form").submit()}))})),$((function(){$(".js-franchisees-user-handler").click((function(){$(".js-franchisees-user-hidden").toggleClass("d-none",!$(this).prop("checked"))}))}));
