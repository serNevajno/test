$(function(){
	'use strict';
	//Slider
	var $owl = $('.owl');
	$owl.each( function() {
		var $carousel1 = $(this);
		$carousel1.owlCarousel({
			items : $carousel1.attr('data-items'),
			itemsDesktop : [1199,$carousel1.attr('data-itemsDesktop')],
			itemsDesktopSmall : [979,$carousel1.attr('data-itemsDesktopSmall')],
			itemsTablet:  [797,$carousel1.attr('data-itemsTablet')],
			itemsMobile :  [479,$carousel1.attr('data-itemsMobile')],
			navigation : JSON.parse($carousel1.attr('data-buttons')),
			pagination: JSON.parse($carousel1.attr('data-pag')),
			slideSpeed: 1000,
			paginationSpeed : 1000,
			navigationText : false
		});
	 });
	$(window).load(function()
	{
		$('.preloader p').fadeOut();
		$('.preloader').delay(500).fadeOut('slow');
		$('body').delay(600).css({'overflow':'visible'});
	});
	//Image zoom
	$('.image-zoom').magnificPopup({
		delegate: 'div a',
		type:'image',
		 gallery:{
			enabled:true
		}
	});
	//Counterup
	$('.counter').counterUp({
		delay: 10,
		time: 2000
	});
	//Menu
	$('.navbar-toggle').on('click',function(){
		height_w(); 
	});
	function height_w()
	{
		$('.navbar-nav').css('max-height',$(window).height()-165);
	}
	window.onresize = function()
	{
		height_w();
	}
	//Slider
	var price_val = $("#priceProduct").val();
	if(price_val){
		var price_mas = price_val.split(' - ');
	}else{
		var price_mas ="";
	}
	
	$( ".slider-range" ).slider({
      range: true,
      min: 0,
      max: price_mas[1],
			step: 100,
      values: [price_mas[0], price_mas[1]],
      slide: function( event, ui ) {
         $( ".slider_amount" ).val(ui.values[ 0 ].toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1") + " - " + ui.values[ 1 ].toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1") );
      }
    });
    $( ".slider_amount" ).val( $( ".slider-range" ).slider( "values", 0 ).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1") + " - " + $( ".slider-range" ).slider( "values", 1 ).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1") );
		
		/****************************************************/
		
		$( ".slider-range1" ).slider({
      range: true,
      min: -16,
      max: 115,
			step: 1,
      values: [-16, 115],
      slide: function( event, ui ) {
         $( ".slider_amount1" ).val(ui.values[ 0 ].toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1") + " - " + ui.values[ 1 ].toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1") );
      }
    });
    $( ".slider_amount1" ).val( $( ".slider-range1" ).slider( "values", 0 ).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1") + " - " + $( ".slider-range1" ).slider( "values", 1 ).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1") );
		
		/****************************************************/
		
		$( ".slider-range2" ).slider({
      range: true,
      min: 54,
      max: 160,
			step: 1,
      values: [54, 160],
      slide: function( event, ui ) {
         $( ".slider_amount2" ).val(ui.values[ 0 ].toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1") + " - " + ui.values[ 1 ].toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1") );
      }
    });
    $( ".slider_amount2" ).val( $( ".slider-range2" ).slider( "values", 0 ).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1") + " - " + $( ".slider-range2" ).slider( "values", 1 ).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1") );
	
	//Search
	$('.select-wrapper li').on('click',function(){
		$(this).parents('.select-wrapper').find('button').text($(this).text());
	});
});

$(function(){
  $("#phone").mask("+7 (999) 999-99-99");
  $("#phoneIPmask").mask("+7 (999) 999-99-99");
  $("#phoneUR").mask("+7 (999) 999-99-99");
});

function checkVal(id){
  if($("#"+id).val() == ""){
    $("#"+id+"_box").removeClass().addClass("error-inp form-elem");
    return "1";
  }else{
    $("#"+id+"_box").removeClass().addClass("default-inp form-elem");
  }
}
function sendCallBack(){
	
  var error_name = checkVal("name");
  var error_phone = checkVal("phone");
  var error_email = checkVal("email");
  var error_message = checkVal("message");
  var error_vin = checkVal("vin");
  var error_model = checkVal("listModel2");
  var error_year = checkVal("listYear2");
  var error_marka = checkVal("listMarka2");
  var error_mod = checkVal("listModification2");

  if(error_name || error_phone || error_email || error_message || error_vin || error_model || error_year || error_marka || error_mod)
  {
		$("#text_error").show();
		$("#text_error").html('<div class="row modal-body alert alert-danger" style="padding: 30px;"><i class="fa fa-info"></i> Заполните пожалуйста все поля.</div>');
    return false;
  }else{
    var formData = new FormData(document.getElementById("formCallBack"));
    $.ajax({
      type: "POST",
      processData: false,
      contentType: false,
      url: '/inc/callBack.inc.php',
      data: formData,
      success: function(msg)
      {
        if(msg == "send"){
          $("#modal-body").hide();
          $("#textOk").html('<div class="row modal-body" style="padding: 30px;"><i class="fa fa-info"></i>  Заявка успешно отправлена. В ближайшее время с Вами свяжеться наш менеджер.</div>');
        }
      }

    });
  }
}
////COOKIE//////
function set_cookie ( name, value, domain, secure )
{
  var cookie_string = name + "=" + escape ( value );
 
  var expires = new Date();
		
	//expires.setTime(expires.getTime()+36000);
  //cookie_string += "; expires=" + expires.toGMTString();
  cookie_string += "; path=/";
  if ( domain )
        cookie_string += "; domain=" + escape ( domain );
  
  if ( secure )
        cookie_string += "; secure";
  
  document.cookie = cookie_string;
}
function get_cookie ( cookie_name )
{
  var results = document.cookie.match ( '(^|;) ?' + cookie_name + '=([^;]*)(;|$)' );
 
  if ( results )
    return ( unescape ( results[2] ) );
  else
    return null;
}
function delete_cookie ( cookie_name )
{
  var cookie_date = new Date ( );  // Текущая дата и время
  cookie_date.setTime ( cookie_date.getTime() - 1 );
  cookie_name += "=; expires=" + cookie_date.toGMTString();
	cookie_name += "; path=/";
	document.cookie = cookie_name;
}

function changeAddress(n) {
  $.ajax({
    type: "POST",
    url: "/inc/changeAddress.inc.php",
    dataType: "json",
    data: {id_city_kladr : n},
    success: function (msg) {
      $('.f-14').html(msg.f14);
      $('#footerAddress').html(msg.footerAddress);
      $('#regionModal').modal('hide');
    }
  });
  /*if(n == 2) {
    set_cookie("region", 2);
    $('.f-14').html('<i class="fa fa-map-marker m-r-lg-5"></i><strong>Добрая шина</strong> - '+address);
    $('#footerAddress').html('<li><i class="fa fa-home"></i> '+address+'</li><li><i class="fa fa-phone"></i> +7 (347) 200-85-30</li><li><i class="fa fa-envelope-o"></i> dobroshina@yandex.ru</li><li><i class="fa fa-clock-o"></i> Пн-Вс  09:00 - 18:00</li> ');
    $('#regionModal').modal('hide');
  }else if(n == 1){
    set_cookie("region", 1);
  }*/
}

$(document).ready(function () {
  var id_reg = $('#region').val();
  if(id_reg == 2){
    checkRegion();
  }
})

function checkDeliveryNew(type){
    $('#resDelivTransCom').html('');
    $.ajax({
        type: "POST",
        url: "/inc/delivery.inc.php",
        dataType: "html",
        data: {type : type},
        success: function (msg) {
            if(type == '1'){
                $('#resDelivSam').html(msg);
                $('#resDelivNash').html('');
                $('#resDelivNew').html('');
            }else if(type == '2'){
                $('#resDelivSam').html('');
                $('#resDelivNash').html(msg);
                $('#resDelivNew').html('');
            }else if(type == '3'){
                $('#resDelivSam').html('');
                $('#resDelivNash').html('');
                $('#resDelivNew').html(msg);
            }
        }
    });
}
function checkDivTransCom(type){
    $.ajax({
        type: "POST",
        url: "/inc/deliveryTransCom.inc.php",
        dataType: "html",
        data: {type : type},
        success: function (msg) {
            $('#resDelivTransCom').html(msg);
            $('#region').keyup(function () {
                $("#block-search-result").remove();
                $('#region').after("<div id='block-search-result' style='display: none;'><ul id='result_search'></ul></div>");
                var country = $('#country').val();
                if(country == '1') {
                    var region = $('#region').val();
                    $.ajax({
                        type: "POST",
                        url: "/inc/kladr.inc.php",
                        dataType: "html",
                        data: {query: region, type: "region"},
                        success: function (res) {
                            $('#result_search').html(res);
                            $('#block-search-result').show();
                        }
                    });
                }
            });
            $('body').on('click', '#result_search li', function () {
                var id = $(this).attr("data-id");
                var type = $(this).attr("data-type");
                var b = $(this).children().html();

                $('#block-search-result').hide();
                if(type == "region"){
                    $('#region').val(b);
                    $('#regionId').val(id);
                    $('#city').attr("disabled", false);
                }else if(type == "city"){
                    $('#city').val(b);
                    $('#cityId').val(id);
                    $('#addressDev').attr("disabled", false);
                    $('#dom').attr("disabled", false);
                    $('#kv').attr("disabled", false);
                }else if(type == "street"){
                    $('#addressDev').val(b);
                }
            });
            $('#city').keyup(function () {
                $("#block-search-result").remove();
                $('#city').after("<div id='block-search-result' style='display: none;'><ul id='result_search'></ul></div>");
                var country = $('#country').val();
                if(country == '1') {
                    var city = $('#city').val();
                    var regionId = $('#regionId').val();
                    $.ajax({
                        type: "POST",
                        url: "/inc/kladr.inc.php",
                        dataType: "html",
                        data: {query: city, id: regionId, type: "city"},
                        success: function (res) {
                            $('#result_search').html(res);
                            $('#block-search-result').show();
                        }
                    });
                }
            });
            if(type == '2'){
                $('#addressDev').keyup(function () {
                    $("#block-search-result").remove();
                    $('#addressDev').after("<div id='block-search-result' style='display: none;'><ul id='result_search'></ul></div>");

                    var address = $('#addressDev').val();
                    var cityId = $('#cityId').val();
                    $.ajax({
                        type: "POST",
                        url: "/inc/kladr.inc.php",
                        dataType: "html",
                        data: {query: address, id: cityId, type: "street"},
                        success: function (res) {
                            $('#result_search').html(res);
                            $('#block-search-result').show();
                        }
                    });
                });
            }
        }
    });
}

function errorCheckout(step){
    $('#step'+step).show();
}
function checkOutNew(){
   var step1 = checkStep(1);
   var step2 = checkStep(2);
   var step3= checkStep(3);

   if(step1 && step2 && step3){
        var type = $('input[name=delivery]:checked').val();
        var office = $('#samovivoz').val();
        var addressDevFull = $('#addressDevFull').val();
        var sTransCom = $('#sTransCom').val();
        var divTransCom = $('input[name=deliveryTransCom]:checked').val();
        var city = $('#city').val();
        var region = $('#region').val();
        var addressDev = $('#addressDev').val();
        var dom = $('#dom').val();
        var kv = $('#kv').val();
        var typeUser = $('input[name=tabs]:checked').val();
        var famFIZ = $('#famFIZ').val();
        var nameFIZ = $('#nameFIZ').val();
        var midNameFIZ = $('#midNameFIZ').val();
        var listFiz = $('input[name=phoneFiz]');
        var resFiz = "";
        listFiz.each( function(ind) {
            resFiz += $(this).val();
           if (ind < listFiz.length - 1) resFiz +=','; // например через запятую
        });
        var emailFiz = $('#emailFiz').val();
        var commPhoneFiz = $('#commPhoneFiz').val();
        var commentsFiz = $('#commentsFiz').val();
        var infoFiz = $('#infoFiz:checked').val();
        var nameIP = $('#nameIP').val();
        var emailIP = $('#emailIP').val();
        var inn = $('#inn').val();
        var addressIP = $('#addressIP').val();
        var nameContact = $('#nameContact').val();
        var listIP = $('input[name=phoneIP]');
        var resIP = "";
        listIP.each( function(ind) {
           resIP += $(this).val();
           if (ind < listIP.length - 1) resIP +=','; // например через запятую
        });
        var commPhoneIP = $('#commPhoneIP').val();
        var commentsIP = $('#commentsIP').val();
        var infoIP = $('#infoIP:checked').val();
        var nameUR = $('#nameUR').val();
        var innUR = $('#innUR').val();
        var kpp = $('#kpp').val();
        var addressUR = $('#addressUR').val();
        var nameContactUR = $('#nameContactUR').val();
        var listUR = $('input[name=phoneUR]');
        var resUR = "";
        listUR.each( function(ind) {
           resUR += $(this).val();
           if (ind < listUR.length - 1) resUR +=','; // например через запятую
        });
        var emailUR = $('#emailUR').val();
        var commPhoneYR = $('#commPhoneYR').val();
        var commentsUR = $('#commentsUR').val();
        var infoUR = $('#infoUR:checked').val();
        var pay = $('input[name=pay]:checked').val();

        $.ajax({
            type: "POST",
            url: "/inc/addOrderNew.inc.php",
            dataType: "html",
            data: {type: type, office: office, addressDevFull: addressDevFull, sTransCom: sTransCom, divTransCom: divTransCom, city: city, region: region, addressDev: addressDev, dom: dom, kv: kv, typeUser: typeUser, famFIZ: famFIZ, nameFIZ: nameFIZ, midNameFIZ: midNameFIZ, resFiz: resFiz, emailFiz: emailFiz, commPhoneFiz: commPhoneFiz, commentsFiz: commentsFiz, infoFiz: infoFiz, nameIP: nameIP, emailIP: emailIP, inn: inn, addressIP: addressIP, nameContact: nameContact, resIP: resIP, commPhoneIP: commPhoneIP, commentsIP: commentsIP, infoIP: infoIP, nameUR: nameUR, innUR: innUR, kpp: kpp, addressUR: addressUR, nameContactUR: nameContactUR, resUR: resUR, emailUR: emailUR, commPhoneYR: commPhoneYR, commentsUR: commentsUR, infoUR: infoUR, pay: pay},
            success: function (res) {
                alert("Спасибо ваш заказ №"+res+" принят, в скором времени будет обработан менеджером!");
                window.location.replace("http://dobrayashina.ru");
            }
        });
   }
}
function checkStep(step){
    if(step == 1){
        var type = $('input[name=delivery]:checked').val();
        if(type>0) {
            if (type == '1') {
                var office = $('#samovivoz').val();
                if (office == '0') {
                    errorCheckout(1);
                    return;
                }
            }
            if(type == '2') {
                var addressDevFull = $('#addressDevFull').val();
                if (addressDevFull == '') {
                    errorCheckout(1);
                    return;
                }
            }

            if(type == '3') {
                var sTransCom = $('#sTransCom').val();
                if (sTransCom == '1') {
                    sTransCom = $('#otherCompany').val()
                    if (!sTransCom) {
                        errorCheckout(1);
                        return;
                    }
                }
                var divTransCom = $('input[name=deliveryTransCom]:checked').val();
                if (!divTransCom) {
                    errorCheckout(1);
                    return;
                }
                var city = $('#city').val();
                if (!city) {
                    errorCheckout(1);
                    return;
                }
                var region = $('#region').val();
                if (!region) {
                    errorCheckout(1);
                    return;
                }
                if (divTransCom == '2') {
                    var addressDev = $('#addressDev').val();
                    if (addressDev == '') {
                        errorCheckout(1);
                        return;
                    }
                    var dom = $('#dom').val();
                    if (dom == '') {
                        errorCheckout(1);
                        return;
                    }
                    var kv = $('#kv').val();
                    if (kv == '') {
                        errorCheckout(1);
                        return;
                    }
                }
            }
        }else{
            errorCheckout(1);
            return;
        }
    }else if(step == 2){
        var typeUser = $('input[name=tabs]:checked').val();
        if(typeUser == '1'){
            var famFIZ = $('#famFIZ').val();
            if (famFIZ == '') {
                errorCheckout(2);
                return;
            }
            var nameFIZ = $('#nameFIZ').val();
            if (nameFIZ == '') {
                errorCheckout(2);
                return;
            }
            var midNameFIZ = $('#midNameFIZ').val();
            var check0 = $('#check0:checked').val();
            if(check0 != "1"){
                if (midNameFIZ == '') {
                    errorCheckout(2);
                    return;
                }
            }
            var values = {};
            var coP = 0;
            $.each($('input[name=phoneFiz]').serializeArray(), function(i, field) {
                values[field.name] = field.value;
                if(i == 0 && field.value == ''){
                    coP = 1;
                }
            });
            if(coP == 1){
                errorCheckout(2);
                return;
            }
            var emailFiz = $('#emailFiz').val();
            if (emailFiz == '') {
                errorCheckout(2);
                return;
            }
            var polKonf = $('#polKonf:checked').val();
            if(polKonf!=1){
                errorCheckout(2);
                return;
            }
            var commPhoneFiz = $('#commPhoneFiz').val();
            var commentsFiz = $('#commentsFiz').val();
            var infoFiz = $('#infoFiz:checked').val();
        }else if(typeUser == '2'){
            var nameIP = $('#nameIP').val();
            if (nameIP == '') {
                errorCheckout(2);
                return;
            }
            var emailIP = $('#emailIP').val();
            if (emailIP == '') {
                errorCheckout(2);
                return;
            }
            var inn = $('#inn').val();
            if (inn == '') {
                errorCheckout(2);
                return;
            }
            var addressIP = $('#addressIP').val();
            if (addressIP == '') {
                errorCheckout(2);
                return;
            }
            var nameContact = $('#nameContact').val();
            if (nameContact == '') {
                errorCheckout(2);
                return;
            }
            var values = {};
            var coP = 0;
            $.each($('input[name=nameIP]').serializeArray(), function(i, field) {
                values[field.name] = field.value;
                if(i == 0 && field.value == ''){
                    coP = 1;
                }
            });
            if(coP == 1){
                errorCheckout(2);
                return;
            }
            var polKonf = $('#polKonf:checked').val();
            if(polKonf!=1){
                errorCheckout(2);
                return;
            }
            var commPhoneIP = $('#commPhoneIP').val();
            var commentsIP = $('#commentsIP').val();
            var infoIP = $('#infoIP:checked').val();
        }else if(typeUser == '3'){
            var nameUR = $('#nameUR').val();
            if (nameUR == '') {
                errorCheckout(2);
                return;
            }
            var innUR = $('#innUR').val();
            if (innUR == '') {
                errorCheckout(2);
                return;
            }
            var kpp = $('#kpp').val();
            if (kpp == '') {
                errorCheckout(2);
                return;
            }
            var addressUR = $('#addressUR').val();
            if (addressUR == '') {
                errorCheckout(2);
                return;
            }
            var nameContactUR = $('#nameContactUR').val();
            if (nameContactUR == '') {
                errorCheckout(2);
                return;
            }
            var values = {};
            var coP = 0;
            $.each($('input[name=phoneUR]').serializeArray(), function(i, field) {
                values[field.name] = field.value;
                if(i == 0 && field.value == ''){
                    coP = 1;
                }
            });
            if(coP == 1){
                errorCheckout(2);
                return;
            }
            var emailUR = $('#emailUR').val();
            if (emailUR == '') {
                errorCheckout(2);
                return;
            }
            var polKonf = $('#polKonf:checked').val();
            if(polKonf!=1){
                errorCheckout(2);
                return;
            }
            var commPhoneYR = $('#commPhoneYR').val();
            var commentsUR = $('#commentsUR').val();
            var infoUR = $('#infoUR:checked').val();
        }
    }else if(step == 3){
        var pay = $('input[name=pay]:checked').val();
        if (!pay) {
            errorCheckout(3);
            return;
        }
    }
    return 1;
}
function otherTransCom(){
    var sTransCom = $('#sTransCom').val();
    if(sTransCom == '1'){
        $('#otherCompany').show();
    }else{
        $('#otherCompany').hide();
    }
}
function checkCountry() {
    var country = $('#country').val();
    if (country != '1') {
        $('#block-search-result').hide();
    }
}
function clonePhoneInput() {
    $( "#phoneFIZ" ).clone().prependTo( "#newPhone" );
}
function viewCommPhone() {
    $('#commPhoneFiz').show();
}
function clonePhoneInputIP() {
    $( "#phoneIP" ).clone().prependTo( "#newPhoneIP" );
}
function viewCommPhoneIP() {
    $('#commPhoneIP').show();
}
function clonePhoneInputYR() {
    $( "#phoneYR" ).clone().prependTo( "#newPhoneYR" );
}
function viewCommPhoneYR() {
    $('#commPhoneYR').show();
}
function sStepPay(){
    var typeUser = $('input[name=tabs]:checked').val();
    var type = $('input[name=delivery]:checked').val();

    $.ajax({
        type: "POST",
        url: "/inc/payList.inc.php",
        dataType: "html",
        data: {typeUser: typeUser, type: type},
        success: function (res) {
            $('#payList').html(res);
        }
    });
}