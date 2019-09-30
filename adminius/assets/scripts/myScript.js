$(document).ready(function () {
  $("#Cat").change(function () {
    if ($(this).val() == 0) return false;
    var val = $(this).val();
    $.ajax({
      type: "POST",
      url: "/adminius/inc/searchSubCat.php",
      data: "subcat=" + val,
      success: function (msg) {
        $("#subCat").html(msg);
      }
    });
  });
  
  $('#delivery_add').click(function () {
    var deli = $("#delivery_add option:selected").val();
    if(deli == '2'){
      $('#ord_address').attr('required', 'required');
    }else if(deli != '2'){
      $('#ord_address').removeAttr('required');
    }
  });

  $('body').on('click', '#result_search_city li', function () {
    var id = $(this).attr('data-id');
    var scope = $('#scopeModal').val();
    var weight = $('#weightModal').val();
    $('#block-search-result').hide();
    sCostDelivery(id, weight, scope);

  });
  $('#cityUser').keyup(function () {
    var region = $('#cityUser').val();
    $.ajax({
      type: "POST",
      url: "/adminius/inc/cityPEK.inc.php",
      dataType: "html",
      data: {query: region, type: "city", parent: "1"},
      success: function (res) {
        $('#result_search_city').html(res);
        $('#block-search-result').show();
      }
    });
  });

  /*$('#price_clear').keyup(function() {
    var price_clear = $('#price_clear').val();
    if(price_clear > 3){
      $('#otherProvider').removeAttr("disabled");
    }
  });*/

  $('[data-toggle="popoverGoodsMovement"]').popover({
    //Установление направления отображения popover
    placement : 'bottom',
    html: true,
    trigger: 'hover'
  });

});

function sRegionKladr(){
  var address = $('#address').html();
  address = address.replace(/\s/g, '');
  var scope = $('#scope').html();
  var weight = $('#weight').html();
  //alert(region+" | "+weight+" | "+scope);
  $.ajax({
    type: "POST",
    url: "/inc/adm.kladr.inc.php",
    dataType: "json",
    data: {query: address},
    success: function (res) {
      sCostDelivery(res.idCity, weight, scope);
    }
  });
}

function sCostDelivery(idCity, weight, scope) {
  //alert(idCity+" | "+weight+" | "+scope);
  $.ajax({
    type: "POST",
    url: "/adminius/inc/sCostDelivery.inc.php",
    dataType: "json",
    data: {region: idCity, weight: weight, scope: scope},
    success: function (res) {
      $('#pec_to').show();
      $('#pec_to').html(res.autonegabarit);
      $('#pec_to').append(res.deliver);
      $('#pec_to').append(res.periods);
    }
  });
}

function actionProduct() {
  var getCat = $("#getCat").val();
  var subcat = $("#subCat").val();

  var list = $('#sample_1 :checkbox:checked');
  var res = '';
  list.each(function (ind) {
    res += $(this).val();
    if (ind < list.length - 1) res += ','; // например через запятую
  });
  alert('Функция работает!');
  $.ajax({
    type: "POST",
    url: "/adminius/inc/replaceProduct.php",
    data: "getCat="+getCat+"&subcat="+subcat+"&res="+res,
    success: function(msg){
        alert(msg);
        window.location.href='/adminius/index.php?code=product&cat='+getCat;
    }
  });
}

function searchProd() {
  var input_search = $('#input-search').val();
  if (input_search.length >= 3 && input_search.length < 150 )
  {
    $.ajax({
      type: "POST",
      url: '/adminius/inc/searchProductCode.php' , // именно в нем будут выполнять какие то действия при нажатии на кнопку
      dataType: 'html',
      data: 'search='+input_search, // передаваемые параметры
      success: function(data){
        $('#result_search').html(data);
        $("#block-search-result").show();
      }
    });
  }else{
    // Если ничего не найдено, то скрываем выпадающий список.
    $("#block-search-result").hide();
  }
}

function checkSeason() {
  var sezon = $('input[name=sezon]:checked').val();
  var inp = $("#input-search").val();
  inp = inp.replace('Зимняя', "");
  inp = inp.replace('Летняя', "");
  inp = inp.replace('Всесезонная', "");
  $("#input-search").val(sezon+" "+inp);
  searchProd();
}

$(document).ready(function() {
  $("#check_all").click(function () {
    if (!$("#check_all").is(":checked")) {
      $(".checkbox").removeAttr("checked");
      $("div.checker span").removeClass();
    }else {
      $(".checkbox").attr("checked", "checked");
      $("div.checker span").addClass("checked");
    }
  });
});

$(function(){
  //элемент, к которому необходимо добавить маску
  $("#phonemasksearch").mask("7 (999) 999-99-99");
});

$(document).ready(function () {
  if($("#beznal").attr("checked") == 'checked') {
    $("#print").attr("disabled", "disabled");
    $("#prepayment").attr("disabled", "disabled");
    $("#savePrepayment").attr("disabled", "disabled");
    $("#statOk").attr("disabled","disabled");
  }
  if($("#upd").attr("checked") == 'checked') {
    //$("#iStatus").attr("disabled","disabled");
    $("#upd").attr("disabled","disabled");
    $("#beznal").attr("disabled","disabled");
  }
  $("#iStatus").change(function () {
        if($("#iStatus").val() == '11'){
            $("#expectation").show();
        }
  });
});

function checkBeznal() {
  if($("#beznal").attr("checked") == 'checked') {
    $("#print").attr("disabled","disabled");
    $("#prepayment").attr("disabled","disabled");
    $("#savePrepayment").attr("disabled","disabled");

    $("#statOk").attr("disabled","disabled");

    var val = $("#beznal").val();
    var id = $("#beznal").attr('data-id');

    $.ajax({
      type: "POST",
      url: "/adminius/inc/saveBeznal.php",
      data: "val="+val+"&id="+id,
      success: function (msg) {
        alert(msg);
      }
    });
  }else{
    var val = 0;
    var id = $("#beznal").attr('data-id');

    $.ajax({
      type: "POST",
      url: "/adminius/inc/saveBeznal.php",
      data: "val="+val+"&id="+id,
      success: function (msg) {
        alert(msg);
      }
    });

    $('#print').removeAttr("disabled");
    $('#prepayment').removeAttr("disabled");
    $('#savePrepayment').removeAttr("disabled");
  }
}

function checkUpd(){
  if($("#upd").attr("checked") == 'checked') {
    var val = $("#upd").val();
    var id = $("#upd").attr('data-id');
    var upd = $("#upd").attr('data-title');

    $.ajax({
      type: "POST",
      url: "/adminius/inc/saveBeznal.php",
      data: "val="+val+"&id="+id+"&upd="+upd,
      success: function (msg) {
        alert(msg);
        window.location.href='/adminius/index.php?code=orders&action=edit&id='+id;
      }
    });
  }
}

function questionCause(id) {
  var cause = prompt("Какая причина изминения суммы заказа?", "");
  if(cause){
    var summ = prompt("Укажите сумму заказа: ", "");
    $.ajax({
      type: "POST",
      url: "/adminius/inc/editorder.inc.php",
      data: "cause="+cause+"&id="+id+"&summ="+summ+"&name=editName",
      success: function (msg) {
        alert(msg);
        window.location.href='/adminius/index.php?code=orders&action=edit&id='+id;
      }
    });
  }
}

function changePosBascket(id, price, price_clear, logistic, id_provider, n){
  var val = $('#valInput'+n).val();
  $('#product-price'+n).html(price+" руб");
  $.ajax({
    type: "POST",
    url: "/adminius/inc/upPosBascket.inc.php",
    data: "price="+price+"&price_clear="+price_clear+"&logistic="+logistic+"&id_provider="+id_provider+"&id="+id,
    success: function () {
      $.ajax({
        type: "POST",
        url: "/inc/updateSumm.inc.php",
        dataType: "json",
        data: {id : id, val : val},
        success: function (msg) {
          $('#summProduct'+n).html(msg.price+' руб');
          $('#total').html(msg.summ+' руб');
        }
      });
    }
  });

}

function changePosOrder(id, price, price_clear, logistic, id_provider, product_id, region){
    var chPr =0;
    var chProv = $('#chProvider').val();
    if(confirm('Менять цену продажи товара?')){
        chPr = 1;
    }
  var quantity = $('#quantity').val();
  $.ajax({
    type: "POST",
    url: "/adminius/inc/upPosOrder.inc.php",
	  dataType: "json",
    data: {id: id, price: price, price_clear: price_clear, logistic: logistic, id_provider: id_provider, product_id: product_id, quantity: quantity, region: region, chPr: chPr},
    success: function (msg) {
      /*$.each(msg, function( key, value ) {
        console.log( 'Свойство: ' +key + '; Значение: ' + value );
      });*/
      if(msg){
        alert('Поставщик изменен!');
        if(chPr == 1){
            $("#price").val(price);
        }
        $("#price_clear").val(price_clear);
        $("#logistic").val(logistic);
        $("#trProvider12").removeAttr("style");
        $("#trProvider"+chProv).removeAttr("style");
        $("#chProvider").val(id_provider);
        $("#trProvider"+id_provider).css({"color":"#cb1010", "font-weight":"600"});
        $('#ctn'+msg.provider).html(msg.ctn);
      }
    }
  });

}

function uploadPDZZ(id){
    var date = $('#pdzz').val();
    $.ajax({
        type: "POST",
        url: "/adminius/inc/uploadPDZZ.inc.php",
        data: "id="+id+"&date="+date,
    });
}

var isMobile = {
  Android: function() {
    return navigator.userAgent.match(/Android/i);
  },
  BlackBerry: function() {
    return navigator.userAgent.match(/BlackBerry/i);
  },
  iOS: function() {
    return navigator.userAgent.match(/iPhone|iPad|iPod/i);
  },
  Opera: function() {
    return navigator.userAgent.match(/Opera Mini/i);
  },
  Windows: function() {
    return navigator.userAgent.match(/IEMobile/i);
  },
  any: function() {
    return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
  }
};

function startWorkTime(n) {
  if (n == '1') {
    if(isMobile.any()){
      alert('Вы пытаетесь воспользоваться мобильным браузером что запрещено делать! Вы не зафексированы на рабочем месте.');
      $('#workTime').modal('hide');
      var date = new Date(new Date().getTime() + 86400 * 1000);
      document.cookie = "startWorkTime=1; path=/; expires=" + date.toUTCString();
    }else {
      $.ajax({
        type: "POST",
        url: "/adminius/inc/startWorkTime.inc.php",
        dataType: "json",
        success: function (msg) {
          if (msg.success == 'true') {
            $('#workTime').modal('hide');
          }
        }
      });
    }
  } else if (n == '2') {
    $('#workTime').modal('hide');
    var date = new Date(new Date().getTime() + 86400 * 1000);
    document.cookie = "startWorkTime=1; path=/; expires=" + date.toUTCString();
  }
}

function logout() {
  var date = new Date(new Date().getTime() - 86400 * 1000);
  document.cookie = "startWorkTime=0; path=/; expires=" + date.toUTCString();
  window.location.href = "/adminius/logout.php";
}

function endWorkTime() {
  $.ajax({
    type: "POST",
    url: "/adminius/inc/endWorkTime.inc.php",
    dataType: "json",
    success: function (msg) {
      if (msg.success == 'true') {
        alert('Спасибо за работу. Ваше рабочее время закрыто!');
        $('#workRealTime').hide();
      }
    }
  });
}

$(function () {
  setInterval(function () {
    $.ajax({
      type: "POST",
      url: "/adminius/inc/realWorkTime.inc.php",
      dataType: "json",
      success: function (msg) {
        var sec = msg.sec;
        if(sec > 0) {
          var h = sec / 3600 ^ 0;
          var m = (sec - h * 3600) / 60 ^ 0;
          var s = sec - h * 3600 - m * 60;
          var total = (h < 10 ? "0" + h : h) + " ч. " + (m < 10 ? "0" + m : m) + " мин. " + (s < 10 ? "0" + s : s) + " сек.";
          $('#workRealTime').html('<i class="fa fa-clock-o" style="color: #fff;"></i> ' + total + ' <a class="btn green btn-xs" onclick="endWorkTime();">Завершить работу</a>');
        }
      }
    });
  }, 1000);

  $('#rShip').hide();
  $('#sezon').click(function () {
    var sezon = $('#sezon option:selected').val();
    (sezon == 2) ? $('#rShip').show() : $('#rShip').hide();
  });
});

function sProdWorkPlace(form) {
  //var sezon = $('#sezon').val();
  var sezon = form.sezon.value;
  //var brend = $('#brend').val();
  var brend = form.brend.value;
  //var razmer = $('#razmer').val();
  var razmer = form.razmer.value;
  //var articul = $('#articul').val();
  var articul = form.articul.value;
  var ship = form.ship.value;
  /*var ship = 2;
  if($('#ship').attr("checked")){
    ship = 1;
  }*/
  $.ajax({
    type: "POST",
    url: "/adminius/inc/sProdWorkPlace.inc.php",
    dataType: "json",
    data: {sezon: sezon, brend: brend, razmer: razmer, articul: articul, ship: ship},
    success: function (msg) {
      if(msg){
        $('#resSearchProductWorkPlace').html(msg.res);
        $('#weightModal').val(msg.weight);
        $('#scopeModal').val(msg.scope);
      }else if(!msg){
        $('#resSearchProductWorkPlace').html('<h2>Результата нет</h2>');
      }
    }
  });
  return false;
}

function sProdWorkPlaceDisk(form) {
    var brand = form.brand_disk.value;
    var razmer = form.razmer_disk.value;
    var articul = form.articul_disk.value;

    $.ajax({
        type: "POST",
        url: "/adminius/inc/sProdWorkPlaceDisk.inc.php",
        dataType: "json",
        data: {brand: brand, razmer: razmer, articul: articul},
        success: function (msg) {
            if(msg){
                $('#resSearchProductWorkPlace').html(msg.res);
                $('#weightModal').val(msg.weight);
                $('#scopeModal').val(msg.scope);
            }else if(!msg){
                $('#resSearchProductWorkPlace').html('<h2>Результата нет</h2>');
            }
        }
    });
    return false;
}

function combineProdModal(id){
  var sezon = $('#sezon').val();
  var brend = $('#brend').val();
  var razmer = $('#razmer').val();
  var articul = $('#articul').val();
  var ship = $('#rShip').val();
  $.ajax({
    type: "POST",
    url: "/adminius/inc/sProdCombine.inc.php",
    dataType: "json",
    data: {id: id, sezon:sezon, brend:brend, razmer:razmer, articul:articul, ship:+ship},
    success: function (msg) {
      $('#combineNameProd').html(msg.combineName);
      $('#resSearchProductCombine').html(msg.res);
    }
  });
}
function combineProdModalDisk(id){
  var brend = $('#brand_disk').val();
  var razmer = $('#razmer_disk').val();
  var articul = $('#articul_disk').val();

  $.ajax({
    type: "POST",
    url: "/adminius/inc/sProdCombineDisk.inc.php",
    dataType: "json",
    data: {id: id, brend:brend, razmer:razmer, articul:articul},
    success: function (msg) {
      $('#combineNameProd').html(msg.combineName);
      $('#resSearchProductCombine').html(msg.res);
    }
  });
}
function combineProd(id_main, id_second){
  $.ajax({
    type: "POST",
    url: "/adminius/inc/prodCombine.inc.php",
    dataType: "json",
    data: {id_main: id_main, id_second:id_second},
    success: function (msg) {
      if(msg.mess == 'OK'){
        $('#actionCombine'+id_second).html('<i class="fa fa-check-circle-o" style="color: #0a8120;"></i>');
        setTimeout()(function () {
          sProdWorkPlace();
        }, 10);
      }else{
        console.log(msg.mess);
      }
    }
  });
}
function combineProdDisk(id_main, id_second){
  $.ajax({
    type: "POST",
    url: "/adminius/inc/prodCombineDisk.inc.php",
    dataType: "json",
    data: {id_main: id_main, id_second:id_second},
    success: function (msg) {
      if(msg.mess == 'OK'){
        $('#actionCombine'+id_second).html('<i class="fa fa-check-circle-o" style="color: #0a8120;"></i>');
        setTimeout()(function () {
          sProdWorkPlaceDisk();
        }, 10);
      }else{
        console.log(msg.mess);
      }
    }
  });
}
function addBasketWorkPlace(id, id_provider){
  $.ajax({
    type: "POST",
    url: "/adminius/inc/sProdModal.inc.php",
    dataType: "json",
    data: {id: id, id_provider: id_provider},
    success: function (msg) {
      /*$.each(msg, function( key, value ) {
        console.log( 'Свойство: ' +key + '; Значение: ' + value );
      });*/
      $('#modalName').val(msg.name+' ('+msg.article+' )');
      $('#modalProvider').val(msg.name_provider);
      $('#modalPrice').val(msg.price);
      $('#modalPriceClear').val(msg.price_clear);
      $('#modalIdProd').val(msg.id);
      $('#modalIdProvider').val(msg.id_provider);
      if(msg.availability <= 3){
        $('#modalQuantity').val(msg.availability);
        var total = msg.price * msg.availability;
      }else if(msg.availability >= 4){
        $('#modalQuantity').val(4);
        var total = msg.price * 4;
      }
      $('#modalSumm').html(total);
      $('#modalQuantity').data('availability', msg.availability);
    }
  });

}

function modalSummProduct(action){
  var price = $('#modalPrice').val();
  var availability =  $('#modalQuantity').data('availability');
  if(action == 'minus'){
    var val = $('#modalQuantity').val();
    if(+val>1){
      val--;
    }
  }else{
    var val = $('#modalQuantity').val();
    if(+val < +availability) {
      val++;
    }
  }
  var total = price * val;
  $('#modalQuantity').val(val);
  $('#modalSumm').html(total);
}

function chechStatusFortochki(nzsp){
  $.ajax({
    type: "POST",
    url: "/adminius/inc/checkStatusFortochki.inc.php",
    dataType: "html",
    data: {order: nzsp},
    success: function (msg) {
      if(msg){
        alert(msg);
      }
    }
  });
}

function returnOrder(id){
  var prom = prompt('Укажите причину возврата','');
  if(prom && prom != null) {
    $.ajax({
      type: "POST",
      url: "/adminius/inc/returnOrderById.inc.php",
      dataType: "html",
      data: {prom: prom, id: id},
      success: function (msg) {
        alert('Операция выполнена '+msg);
        location.href = '/adminius/index.php?code=orders&action=edit&id='+id;
      }
    });
  }
}

function addOrderKolesaDarom(id){
  $('#modalIKDid').val(id);
}

function sAddressKD() {
  var dev_id = $('#deliveryKD').val();
  $.ajax({
    type: "POST",
    url: "/adminius/inc/deliveryKD.inc.php",
    dataType: "html",
    data: {delivery: dev_id},
    success: function (msg) {
      $('#resKD').html(msg);
    }
  });
}
function checkStatusKD(nzsp){
    $.ajax({
        type: "POST",
        url: "/adminius/inc/checkStatusKD.inc.php",
        dataType: "html",
        data: {order: nzsp},
        success: function (msg) {
            if(msg){
                alert(msg);
            }
        }
    });
}
function tempSms(){
  var tempSms = $('#tempSms option:selected').html();
  $('#tempSmsText').html(tempSms);
}

function createDoubleOrders(id) {
  $.ajax({
    type: "POST",
    url: "/adminius/inc/createDoubleOrders.inc.php",
    dataType: "json",
    data: {id: id},
    success: function (msg) {
      if(msg.true = 'true'){
        alert('Дубликат заказа №'+id+' успешно создан!');
        window.location.reload();
      }
    }
  });
}

function changeOtherProvider(id_order){
  var logistic = $('#logistic').val();
  var price_clear = $('#price_clear').val();
  var price = $('#price').val();
  var chProv = $('#chProvider').val();
  if(!price_clear){ alert('Введите чистую цену'); }
  else if(!logistic){ alert('Введите дни поставки'); }
  else{
    $.ajax({
      type: "POST",
      url: "/adminius/inc/upOtherProvider.inc.php",
      dataType: "json",
      data: {id: id_order, price_clear: price_clear, logistic: logistic, price: price},
      success: function (msg) {
        /*$.each(msg, function( key, value ) {
          console.log( 'Свойство: ' +key + '; Значение: ' + value );
        });*/
        if(msg){
          alert(msg.res);
          /*$("#trProvider"+chProv).removeAttr("style");
          $("#trProvider12").css({"color":"#cb1010", "font-weight":"600"});*/
        }
      }
    });
  }
}

function checkStatusAPI(){
  var from = $('#from').val();
  var to = $('#to').val();
  var provider = $('#provider').val();
  if($('#fulfilled').attr("checked")){
    var fulfilled = 1;
  }
  if($('#canceled').attr("checked")){
    var canceled = 1;
  }
  if(!provider){
   alert('Выберите поставщика! ');
  }else{
    $.ajax({
      type: "POST",
      url: "/adminius/inc/checkStatusFortochkiAll.inc.php",
      dataType: "json",
      data: {provider: provider, from: from, to: to, fulfilled: fulfilled, canceled: canceled},
      beforeSend: function () {
        $('#resCountryStat').show();
        $('#resCountryStat').html('<div style="text-align: center;"><img src="https://3.bp.blogspot.com/-9HuFK1wXmoM/Wwbzr18E5lI/AAAAAAAASoc/hTnKRNMlSJUVj1swo9OMThxeJXREnpiDQCLcBGAs/s640/progressbar2.gif" style=" max-width: 300px;"></div>');
      },
      success: function (msg) {
        if(msg){
          $('#resTr').html(msg.tr);
          $('#resCountryStat').hide();
        }
      }
    });
  }
}

function changeStorage(id, region){
    $('#storageProductOrder').val(id);
    $('#storageRegion').val(region);
}

function modalOrder(id){
  $.ajax({
    type: "POST",
    url: "/adminius/inc/modalOrder.inc.php",
    dataType: "json",
    data: {id: id},
    success: function (msg) {
      if(msg){
        $('#resModal').html(msg.modal);
        $('#modalOrder').modal('show');
      }
    }
  });
}

function questionClearPrice(id) {
  var cause = prompt("для подтверждения напишите (yes)", "");
  if(cause == 'yes'){
    var price_clear = prompt("Укажите новую цену поставщика: ", "");
    $.ajax({
      type: "POST",
      url: "/adminius/inc/editPriceProvider.inc.php",
      dataType: "json",
      data: {cause: cause, id: id, price_clear : price_clear},
      success: function (msg) {
        if(msg.res == 'yes'){
          $('#price_clear').html(price_clear+' за шт.');
        }else{
          alert('error!');
        }
      }
    });
  }else{
    alert('error!');
  }
}

$(document).ready(function () {
  var id_order_prod = $('#id_order_prod').val();
  $('#quantityGoodsMove'+id_order_prod).keyup(function () {
    var quantity = $('#quantityGoodsMove'+id_order_prod).val();
    var summPriceClear = $('#summPriceClearGoodsMove'+id_order_prod).val();
    //alert(id_order_prod+' | '+quantity+' | '+summPriceClear);
    $.ajax({
      type: "POST",
      url: "/adminius/inc/goodsMove.inc.php",
      dataType: "json",
      data: {quantity: quantity, id_order_prod: id_order_prod, summPriceClear: summPriceClear},
      success: function (res) {
        if(res.res == 'yes') {
          $('#price_clear').html(res.price_clear);
        }
      }
    });
  });

  $('#summPriceClearGoodsMove'+id_order_prod).keyup(function () {
    var quantity = $('#quantityGoodsMove'+id_order_prod).val();
    var summPriceClear = $('#summPriceClearGoodsMove'+id_order_prod).val();
    $.ajax({
      type: "POST",
      url: "/adminius/inc/goodsMove.inc.php",
      dataType: "json",
      data: {quantity: quantity, id_order_prod: id_order_prod, summPriceClear: summPriceClear},
      success: function (res) {
        if(res.res == 'yes') {
          $('#price_clear').html(res.price_clear);
        }
      }
    });
  });
});

function changeProvider(id, id_provider, id_order) {
  //alert('id: '+id+' id_prov: '+id_provider);
  $.ajax({
    type: "POST",
    url: "/adminius/inc/changeProviderGoodsMovement.inc.php",
    dataType: "json",
    data: {id: id, id_provider : id_provider, id_order: id_order},
    success: function (msg) {
      if(msg.prov == 'yes'){
        $('#btnGroupVerticalDrop7'+id).html('Оприходован');
        $('#ulGroupVerticalDrop7'+id).hide();
      }
    }
  });
}

function otherTransCom(){
    var sTransCom = $('#sTransCom').val();
    if(sTransCom == '1'){
        $('#otherCompany').show();
    }else{
        $('#otherCompany').hide();
    }
}

function confirmPrepayment(id){
    $.ajax({
        type: "POST",
        url: "/adminius/inc/confirmPrepayment.inc.php",
        dataType: "html",
        data: {id: id},
        success: function (msg) {
            $('#btnConfirmPrepayment'+id).html('Утвержден');
        }
    });
}

function confirmCashless(id){
    $('#idOrderCashless').val(id);
}

function clearPriceProduct(id) {
  $.ajax({
    type: "POST",
    url: "/adminius/inc/delProdProvider.inc.php",
    dataType: "json",
    data: {id: id},
    success: function (msg) {
      if(msg.code == "2000"){
        alert('Прайс отчищен');
      }
    },
    error: function (msg) {
      console.log(msg);
    }
  });
}
function changeStatus(){
  var iStatus = $('#iStatus').val();
  if(iStatus == '1'){
    $('#sms').val(1);
    refform.submit();
  }else {
    if (confirm('Отправить SMS?')) {
      $('#sms').val(1);
      refform.submit();
    } else {
      $('#sms').val(0);
      refform.submit();
    }
  }
}