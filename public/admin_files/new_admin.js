$((function(){$("body").on("click",".js-delete-confirm",(function(){let e=$(".js-delete-confirm-modal");e.find(".js-delete-confirm-form").prop("action",$(this).data("action")),e.find(".js-delete-confirm-id").val($(this).data("id")),e.find(".js-delete-confirm-text").html($(this).data("text")),e.find('input[name="_method"]').val($(this).data("method")||"post"),e.modal("show")}))})),$((function(){$("body").on("click",".js-delete-country",(function(){let e=$(".js-delete-confirm-modal");e.find(".js-delete-confirm-form").prop("action",$(this).find(".btn").data("action")),e.find("input[name='_method']").val("delete"),e.find(".js-delete-confirm-text").html($(this).data("text")),e.modal("show")}))})),$((function(){var e=null;$(".js-admin-texts-line-page").on("click","td",(function(){$(".js-admin-texts-modal-dialog").empty(),$(".js-admin-texts-modal-content-dummy").find(".modal-content").clone().appendTo(".js-admin-texts-modal-dialog"),$("#id_modal_admin_texts_edit").modal("show");let t=$(this).closest("tr").data("url");e=$.ajax({url:t,method:"GET",dataType:"html"}).done((function(t){$(".js-admin-texts-modal-dialog").html(t),e=null}))})),$("#id_modal_admin_texts_edit").on("bs.modal.hide",(function(){null!==e&&e.abort()})),$(".js-admin-texts-filter").on("input",(function(){let e=$(this).val(),t=new RegExp(e.replace(/[.*+\-?^${}()|[\]\\]/g,"\\$&"),"i");$(".js-admin-texts-line-for-filter").each((function(){let a=!1;""!==e?$(this).find(".js-admin-texts-td-for-filter").each((function(){if(function(e,t){return-1!=e.search(t)}($(this).attr("data-text"),t))return a=!0,!1})):a=!0,$(this).toggle(a)}))})),$(".js-admin-texts-filter-clear").on("click",(function(){$(".js-admin-texts-filter").val(""),$(".js-admin-texts-filter").trigger("input"),$(".js-admin-texts-filter").focus()}))})),$((function(){$(".js-admin-role-permission-block").on("click",(function(){let e=$(this),t="on"==$(this).data("action");$(this).closest("form").find(".js-admin-role-permission").each((function(){e.data("block")==$(this).data("block")&&$(this).prop("checked",t)}))}))})),$((function(){$(".js-page-is-layout-checkbox").on("click",(function(){let e=$(this).data("url_field");$(e).prop("disabled",$(this).prop("checked"))}))}));let oldId=1;function generateId(){return oldId++,oldId}function initYandexMap(e){let t=e.data("mapState"),a=new ymaps.Map(e[0],t),n=e.data("urlTemplate"),i=new ymaps.LoadingObjectManager(n,{clusterize:!0,clusterHasBalloon:!1,geoObjectOpenBalloonOnClick:!0});a.geoObjects.add(i),a.events.add("boundschange",(function(e){let t=e.get("newBounds"),n=!1;return t&&t[0][0]<-85&&(n=!0),t&&t[1][0]>85&&(n=!0),!n||(setTimeout((function(){a.setBounds(e.get("oldBounds")),a.setZoom(e.get("oldZoom"))}),1),!1)})),a.events.add("boundschange",(function(e){const t={center:e.get("newCenter"),zoom:e.get("newZoom")};$("[name='state']").val(JSON.stringify(t))}))}function initOpenStreetMap($map){let mymap,loadDataStatus="normal",alreadyAddedOffices=[],mapState=$map.data("mapState"),urlTemplate=$map.data("urlTemplate");mymap=L.map($map[0],mapState);let copyright=new L.tileLayer("http://{s}.tile.osm.org/{z}/{x}/{y}.png",{attribution:'&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'});copyright.addTo(mymap),mymap.addControl(new L.Control.Fullscreen);let officeLayer=L.markerClusterGroup();function outputPart(e,t){let a=new Date,n=e.length;for(i=t;i<n;i++){if((new Date).getTime()-a.getTime()>45){setTimeout((function(){outputPart(e,i)}),1);break}if(office=e[i],!alreadyAddedOffices.includes(office.id)){alreadyAddedOffices.push(office.id),L.marker(office.geometry.coordinates).addTo(officeLayer).bindTooltip(office.properties.hintContent).bindPopup(office.properties.balloonContent)}}let o="queue"==loadDataStatus;loadDataStatus="normal",o&&fillOpenStreetMap()}function output(e){outputPart(e.features,0)}function fillOpenStreetMap(){if("normal"!=loadDataStatus)return void(loadDataStatus="queue");loadDataStatus="stop";let bounds=mymap.getBounds(),bbox=[bounds.getSouth(),bounds.getWest(),bounds.getNorth(),bounds.getEast()].join(","),url=urlTemplate.replace("%b",bbox);$.get(url).done((function(t){eval("output"+t)}))}mymap.addLayer(officeLayer),fillOpenStreetMap(),mymap.on("zoomend",fillOpenStreetMap),mymap.on("moveend",fillOpenStreetMap)}$((function(){$(".js-local-office-phone-add").click((function(){let e=$(".js-local-office-phone-template .js-local-office-phone-item").clone(),t=$(this).data("name")+"["+generateId()+"]";return e.find(".js-local-office-phone-text").prop("name",t+"[phone_text]"),e.find(".js-local-office-phone-value").prop("name",t+"[phone_value]"),e.find(".js-local-office-phone-show_at_footer").prop("name",t+"[show_at_footer]"),$(".js-local-office-phone-block").append(e),!1})),$(".js-local-office-phone-block").on("click",".js-local-office-phone-delete",(function(){$(this).closest(".js-local-office-phone-item").remove()})),$(".js-local-office-email-add").click((function(){let e=$(".js-local-office-email-template .js-local-office-email-item").clone(),t=$(this).data("name")+"["+generateId()+"]";return e.find(".js-local-office-email-text").prop("name",t+"[email]"),e.find(".js-local-office-email-show_at_footer").prop("name",t+"[show_at_footer]"),$(".js-local-office-email-block").append(e),!1})),$(".js-local-office-email-block").on("click",".js-local-office-email-delete",(function(){$(this).closest(".js-local-office-email-item").remove()})),$(".js-select2-local-office-franchisee").select2({language:"ru"})})),$((function(){let e=$(".js-top-office-code-search");e.select2({language:"ru",ajax:{url:e.data("ajaxUrl"),dataType:"json",data:function(e){return{term:e.term,page:e.page||1}}},templateResult:function(e){return $('<div class="clearfix"><samp style="background: #9affc6">'+e.code+"</samp> "+e.full_address+"</div>")},templateSelection:function(e){void 0!==$(e.element).data("old")?office=$(e.element).data("old"):office=e;return $('<div class="clearfix"><samp style="background: #9affc6">'+office.code+"</samp> "+office.full_address+"</div>")}})})),$((function(){let e=$(".js-world-languages-code-search");e.select2({language:"ru",ajax:{url:e.data("ajaxUrl"),dataType:"json",data:function(e){return{term:e.term,page:e.page||1}}},templateResult:function(e){return $('<div class="clearfix"><samp style="background: #9affc6">'+e.code_iso+"</samp> "+e.name+"</div>")},templateSelection:function(e){void 0!==$(e.element).data("old")?office=$(e.element).data("old"):office=e;return $('<div class="clearfix"><samp style="background: #9affc6">'+office.code_iso+"</samp> "+office.name+"</div>")}})})),$((function(){let e=$(".js-languages-code-search");e.select2({language:"ru",ajax:{url:e.data("ajaxUrl"),dataType:"json",data:function(e){return{term:e.term,page:e.page||1}}},templateResult:function(e){return $('<div class="clearfix"><samp style="background: #9affc6">'+e.code_iso+"</samp> "+e.name+"</div>")},templateSelection:function(e){void 0!==$(e.element).data("old")?office=$(e.element).data("old"):office=e;return $('<div class="clearfix"><samp style="background: #9affc6">'+office.code_iso+"</samp> "+office.name+"</div>")}})})),$((function(){$(".image_file_autocomplete_from").on("change",(function(){$(".url_autocomplete_to").val("/"+$(this)[0].files[0].name)}))})),$((function(){let e=$(".js-statistics-sites-search");e.select2({language:"ru",width:"resolve",allowClear:!0,placeholder:"Любые",ajax:{url:e.data("ajaxUrl"),dataType:"json",data:function(e){return{term:e.term,page:e.page||1}}},templateResult:function(e){if(e.loading)return $('<div class="clearfix">Получение списка</div>');return $('<div class="clearfix">'+e.site+"</div>")},templateSelection:function(e){if(""==e.id)return e.text;void 0!==$(e.element).data("old")?stat=$(e.element).data("old"):stat=e;return $('<div class="clearfix">'+stat.site+"</div>")}})})),$((function(){let e=$(".js-statistics-utm-source-search");e.select2({language:"ru",width:"resolve",allowClear:!0,placeholder:"Любые",ajax:{url:e.data("ajaxUrl"),dataType:"json",data:function(e){return{term:e.term,page:e.page||1}}},templateResult:function(e){if(e.loading)return e.text;return $('<div class="clearfix">'+e.utm_source+"</div>")},templateSelection:function(e){if(""==e.id)return e.text;if(e.loading)return $('<div class="clearfix">Получение списка</div>');void 0!==$(e.element).data("old")?stat=$(e.element).data("old"):stat=e;return $('<div class="clearfix">'+stat.utm_source+"</div>")}})})),$((function(){let e=$(".js-statistics-utm-medium-search");e.select2({language:"ru",width:"resolve",allowClear:!0,placeholder:"Любые",ajax:{url:e.data("ajaxUrl"),dataType:"json",data:function(e){return{term:e.term,page:e.page||1}}},templateResult:function(e){if(e.loading)return $('<div class="clearfix">Получение списка</div>');return $('<div class="clearfix">'+e.utm_medium+"</div>")},templateSelection:function(e){if(""==e.id)return e.text;void 0!==$(e.element).data("old")?stat=$(e.element).data("old"):stat=e;return $('<div class="clearfix">'+stat.utm_medium+"</div>")}})})),$((function(){let e=$(".js-statistics-utm-campaign-search");e.select2({language:"ru",width:"resolve",allowClear:!0,placeholder:"Любые",ajax:{url:e.data("ajaxUrl"),dataType:"json",data:function(e){return{term:e.term,page:e.page||1}}},templateResult:function(e){if(e.loading)return $('<div class="clearfix">Получение списка</div>');return $('<div class="clearfix">'+e.utm_campaign+"</div>")},templateSelection:function(e){if(""==e.id)return e.text;void 0!==$(e.element).data("old")?stat=$(e.element).data("old"):stat=e;return $('<div class="clearfix">'+stat.utm_campaign+"</div>")}})})),$((function(){let e=$(".js-statistics-utm-term-search");e.select2({language:"ru",width:"resolve",allowClear:!0,placeholder:"Любые",ajax:{url:e.data("ajaxUrl"),dataType:"json",data:function(e){return{term:e.term,page:e.page||1}}},templateResult:function(e){if(e.loading)return $('<div class="clearfix">Получение списка</div>');return $('<div class="clearfix">'+e.utm_term+"</div>")},templateSelection:function(e){if(""==e.id)return e.text;void 0!==$(e.element).data("old")?stat=$(e.element).data("old"):stat=e;return $('<div class="clearfix">'+stat.utm_term+"</div>")}})})),$((function(){let e=$(".js-statistics-utm-content-search");e.select2({language:"ru",width:"resolve",allowClear:!0,placeholder:"Любые",ajax:{url:e.data("ajaxUrl"),dataType:"json",data:function(e){return{term:e.term,page:e.page||1}}},templateResult:function(e){if(e.loading)return $('<div class="clearfix">Получение списка</div>');return $('<div class="clearfix">'+e.utm_content+"</div>")},templateSelection:function(e){if(""==e.id)return e.text;void 0!==$(e.element).data("old")?stat=$(e.element).data("old"):stat=e;return $('<div class="clearfix">'+stat.utm_content+"</div>")}})})),$((function(){$(".js-statistics-sites-search").on("select2:select select2:unselect",(function(){$(this).closest("form").submit()})),$(".js-statistics-utm-source-search").on("select2:select select2:unselect",(function(){$(this).closest("form").submit()})),$(".js-statistics-utm-medium-search").on("select2:select select2:unselect",(function(){$(this).closest("form").submit()})),$(".js-statistics-utm-campaign-search").on("select2:select select2:unselect",(function(){$(this).closest("form").submit()})),$(".js-statistics-utm-term-search").on("select2:select select2:unselect",(function(){$(this).closest("form").submit()})),$(".js-statistics-utm-content-search").on("select2:select select2:unselect",(function(){$(this).closest("form").submit()})),$(".js-statistics-send-form").on("change",(function(){$(this).closest("form").submit()}))})),$((function(){$(".js-franchisees-user-handler").click((function(){$(".js-franchisees-user-hidden").toggleClass("d-none",!$(this).prop("checked"))}))})),$(".js-open-street-map").each((function(){initOpenStreetMap($(this))})),$((function(){$(".js-yandex-map").each((function(){let e=$(this);ymaps.ready((function(){initYandexMap(e)}))}))}));
