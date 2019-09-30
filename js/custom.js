/* FILTER TYRES */
function searchTyres(page){
		var widthTyres = $('#widthTyres').attr('data-value');
		var heightTyres = $('#heightTyres').attr('data-value');
		var diametrTyres = $('#diametrTyres').attr('data-value');
		var	brandTyres = $('#brandTyres').attr('data-value');

   	var widthTyresName = $('#widthTyres').html();
    var heightTyresName = $('#heightTyres').html();
    var diametrTyresName = $('#diametrTyres').html();
    var	brandTyresName = $('#brandTyres').html();

		var season_s = "";
		if($("#season_s").prop('checked')) { 
			season_s = "1";
		}
		
		var season_w = "";
		if($("#season_w").prop('checked')) { 
			season_w = "1";
		}
		
		var season_u = "";
		if($("#season_u").prop('checked')) { 
			season_u = "1";
		}

		var thorn_w = "";
		if($("#thorn_w").prop('checked')) { 
			thorn_w = "1";
		}

		var thorn_n = "";
			if($("#thorn_n").prop('checked')) { 
			thorn_n = "1";
		}
		var only4 = "0";
		if($("#only4").prop('checked')) {
            only4 = "1";
		}

		$("#resTyres").html("<div class='loadOver'>Загрузка...</div>");
		$.ajax({
			type: "POST",
			url: "/inc/apiTyres.inc.php",
			dataType: "html",
			data: "width="+widthTyres+"&height="+heightTyres+"&diametr="+diametrTyres+"&brand="+brandTyres+"&season_s="+season_s+"&season_w="+season_w+"&season_u="+season_u+"&thorn_w="+thorn_w+"&thorn_n="+thorn_n+"&page="+page+"&cat=tyres&only4="+only4,
			success: function (msg) {
				$("#resTyres").html(msg);
				set_cookie("width", widthTyres);
				if(widthTyresName == 'Ширина') widthTyresName ='0';
				if(widthTyresName == 'Все') widthTyresName ='all';
        set_cookie("widthName", widthTyresName);

				set_cookie("height", heightTyres);
        if(heightTyresName == 'Высота') heightTyresName ='0';
        if(heightTyresName == 'Все') heightTyresName ='all';
        set_cookie("heightName", heightTyresName);

				set_cookie("diametr", diametrTyres);
        if(diametrTyresName == 'Диаметр') diametrTyresName ='0';
        if(diametrTyresName == 'Все') diametrTyresName ='all';
				set_cookie("diametrName", diametrTyresName);

				set_cookie("brand", brandTyres);
        if(brandTyresName == 'Бренд') brandTyresName ='0';
        if(brandTyresName == 'Все') brandTyresName ='all';
        set_cookie("brandName", brandTyresName);

				set_cookie("season_s", season_s);
				set_cookie("season_w", season_w);
				set_cookie("season_u", season_u);
				set_cookie("thorn_w", thorn_w);
				set_cookie("thorn_n", thorn_n);
        set_cookie("only4", only4);
			}
		});
}
$(document).ready(function(){
	var contMenuHeight = $('.contMenu li').length;
	if(contMenuHeight > 5){ $('.btnShow').show(); }else{ $('.btnShow').hide(); }

	$('#buttonTyres').bind('click', function(){
		searchTyres(1);
	});
    $('body').on('click', '#listHeightTyres li', function(){
        var s = $(this).val();
        $('#heightTyres').attr('data-value', s);

    });
    $('body').on('click', '#listDiametrTyres li', function(){
        var s = $(this).val();
        $('#diametrTyres').attr('data-value', s);

    });
    $('body').on('click', '#listBrandTyres li', function(){
        var s = $(this).val();
        $('#brandTyres').attr('data-value', s);

    });
    $('body').on('click', '#listWidthDisk li', function(){
        var s = $(this).val();
        $('#widthDisk').attr('data-value', s);

    });
    $('body').on('click', '#listPcdDisk li', function(){
        var s = $(this).val();
        $('#pcdDisk').attr('data-value', s);

    });
    $('body').on('click', '#listBrandDisk li', function(){
        var s = $(this).val();
        $('#brandDisk').attr('data-value', s);

    });
    $('body').on('click', '#listEtDisk li', function(){
      var s = $(this).html();
      $('#etDisk').attr('data-value', s);

    });
    $('body').on('click', '#listDiaDisk li', function(){
      var s = $(this).html();
      $('#diaDisk').attr('data-value', s);

    });
    $('body').on('click', '#result_search_city li', function () {
        var id = $(this).attr('data-id');
        var rn = $(this).attr('data-rh');
        var name = $(this).html();
        addCityToDB(id, name, rn);
        changeAddress(id);
    });
    $('body').on('click', '#cityKladrReg li', function () {
        var id = $(this).attr('data-id');
        var rn = $(this).attr('data-rh');
        var name = $(this).html();
        addCityToDB(id, name, rn);
        changeAddress(id);
    });
    $('#cityUser').keyup(function () {
        var region = $('#cityUser').val();
        $.ajax({
            type: "POST",
            url: "/inc/kladr.inc.php",
            dataType: "html",
            data: {query: region, type: "city", parent: "1"},
            success: function (res) {
                $('#result_search_city').html(res);
                $('#block-search-result').show();
            }
        });
    });

});

/* FILTER DISK */
function searchDisk(page){
		var widthDisk = $('#widthDisk').attr('data-value');
		var diametrDisk = $('#diametrDisk').attr('data-value');
		var pcdDisk = $('#pcdDisk').attr('data-value');
		var	brandDisk = $('#brandDisk').attr('data-value');
		//var	et = $('#et').val();
		var	et = $('#etDisk').attr('data-value');
		//var	dia = $('#dia').val();
		var	dia = $('#diaDisk').attr('data-value');

		var widthDiskName = $('#widthDisk').html();
		var diametrDiskName = $('#diametrDisk').html();
		var pcdDiskName = $('#pcdDisk').html();
		var	brandDiskName = $('#brandDisk').html();
    var	etDiskName = $('#etDisk').html();
    var	diaDiskName = $('#diaDisk').html();

		//console.log('et:'+et+' dia:'+dia);

		/*var page = page - 1;

		$("#resDisk").html("<div class='loadOver'>Загрузка...</div>");
		$.ajax({
			type: "POST",
			url: "/inc/apiDisk.inc.php",
			dataType: "html",
			data: "width="+widthDisk+"&diametr="+diametrDisk+"&pcd="+pcdDisk+"&brand="+brandDisk+"&et="+et+"&dia="+dia+"&page="+page,
			success: function (msg) {
				$("#resDisk").html(msg);
			}
		});*/
		if(page == 1){
			$("#resDisk").html("");
		}
		
		$("#pageDisk").html("");
		$("#loadDisk").show();
		$("#loadDisk").html("<div class='loadOver'>Загрузка...</div>");

		$.ajax({
			type: "POST",
			url: "/inc/apiDisk.inc.php",
			dataType: "json",
			data: {width : widthDisk, diametr : diametrDisk, pcd : pcdDisk, brand : brandDisk, et : et, dia : dia, page : page, cat : "disk"},
			success: function (msg) {
				$("#loadDisk").hide();
				$("#resDisk").append(msg.content);
				$("#pageDisk").html(msg.page);
				if(msg.kol<11 && msg.total>page){
					searchDisk(page+1);
					set_cookie("widthDisk", widthDisk);
					set_cookie("diametrDisk", diametrDisk);
					set_cookie("pcdDisk", pcdDisk);
					set_cookie("brandDisk", brandDisk);
					if(widthDiskName.trim() == 'Ширина') widthDiskName ='0';
					if(widthDiskName.trim() == 'Все') widthDiskName ='all';
          set_cookie("widthDiskName", widthDiskName);
					if(diametrDiskName.trim() == 'Диаметр') {
						diametrDiskName ='0';
					}
					if(diametrDiskName.trim() == 'Все') diametrDiskName ='all';
          set_cookie("diametrDiskName", diametrDiskName);
					if(pcdDiskName.trim() == 'Сверловка') {
						pcdDiskName ='0';
					}
					if(pcdDiskName.trim() == 'Все') pcdDiskName ='all';
					set_cookie("pcdDiskName", pcdDiskName);
					if(brandDiskName.trim() == 'Бренд') brandDiskName ='0';
					if(brandDiskName.trim() == 'Все') brandDiskName ='all';
          set_cookie("brandDiskName", brandDiskName);
					set_cookie("et", et);
					set_cookie("dia", dia);
					if(etDiskName.trim() == 'Вылет') etDiskName ='0';
					if(etDiskName.trim() == 'Все') etDiskName ='all';
          set_cookie("etDiskName", etDiskName);
					if(diaDiskName.trim() == 'Ступица') diaDiskName ='0';
					if(diaDiskName.trim() == 'Все') diaDiskName ='all';
          set_cookie("diaDiskName", diaDiskName);
				}
			}
		});
}
$(document).ready(function(){
	$('#buttonDisk').bind('click', function(){
		searchDisk(1);
	});
	$('#loadDiskForm').bind('click', function(){
		var first = $("#formDiskByAvtoFirst").html();
		$("#formDiskByAvtoFirst").html("");
		$("#formDiskByAvtoSecond").html(first);
		$("#buttonByAvtoMain").val("disk");
	});
	$('#loadTyresForm').bind('click', function(){
		var second = $("#formDiskByAvtoSecond").html();
		$("#formDiskByAvtoSecond").html("");
		$("#formDiskByAvtoFirst").html(second);
		$("#buttonByAvtoMain").val("tyres");
		$("#buttonByAvtoMain").hide();
	});
});

/*SearchAvto*/
$(document).ready(function(){
	$('body').on('click', '#listWidthTyres li', function(){
    var s = $(this).val();
    $('#widthTyres').attr('data-value', s);

		$('#buttonMarka').html("Марка");
		$('#buttonModel').html("Модель");
		$('#buttonYear').html("Год");
		$('#buttonModification').html("Модификация");			
	});
	$('body').on('click', '#listDiametrDisk li', function(){
    var s = $(this).val();
    $('#diametrDisk').attr('data-value', s);

		$('#buttonMarka').html("Марка");
		$('#buttonModel').html("Модель");
		$('#buttonYear').html("Год");
		$('#buttonModification').html("Модификация");	
	});
	$('body').on('click', '#listMarka li', function(){
		var valMarka = $(this).attr('value');
		$('#buttonMarka').html(valMarka);
		$('#buttonModel').html("Модель");
		$('#buttonYear').html("Год");
		$('#buttonModification').html("Модификация");
		
		$('#widthTyres').html("Ширина");
		$('#heightTyres').html("Высота");
		$('#diametrTyres').html("Диаметр");
		$('#brandTyres').html("Бренд");
		$("#season_u").removeAttr("checked");
		$("#season_s").removeAttr("checked");
		$("#season_w").removeAttr("checked");
		$("#thorn_w").removeAttr("checked");
		
		$('#diametrDisk').html("Диаметр");
		$('#widthDisk').html("Ширина");
		$('#pcdDisk').html("Сверловка");
		$('#brandDisk').html("Бренд");
		
		$.ajax({
		  type: "POST",
		  url: "/inc/searchAvto.inc.php",
		  data: "marka="+valMarka,
		  success: function(msg){
				$("#listModel").html(msg);
		  }
		});
	});
	$('body').on('click', '#listModel li', function(){
		var valModel = $(this).attr('value');
		$('#buttonModel').html(valModel);
		var marka = $('#buttonMarka').html();
		$('#buttonYear').html("Год");
		$('#buttonModification').html("Модификация");
		console.log(marka);
		$.ajax({
			type: "POST",
			url: "/inc/searchAvto.inc.php",
			data: "model="+valModel+"&marka="+marka,
			success: function(msg){
				console.log(msg);
				if(msg == "groupMod"){
					$("#buttonYear").attr("data-toggle", "disable");
					$("#buttonYear").css({'color':'#ccc'});
					$("#buttonModification").attr("data-toggle", "disable");
					$("#buttonModification").css({'color':'#ccc'});
					$("#groupMod").val('1');
					$("#noMod").show();
				}else {
					$("#listYear").html(msg);
					$("#groupMod").val('0');
					$("#buttonYear").attr("data-toggle", "dropdown");
					$("#buttonYear").css({'color':'#333'});
					$("#buttonModification").attr("data-toggle", "dropdown");
					$("#buttonModification").css({'color':'#333'});
					$("#noMod").hide();
				}
			}
		});
	});
	$('body').on('click', '#listYear li', function(){
		var valYear = $(this).attr('value');
		$('#buttonYear').html(valYear);
		var marka = $('#buttonMarka').html();
		var model = $('#buttonModel').html();
		$('#buttonModification').html("Модификация");
		
		$.ajax({
      type: "POST",
      url: "/inc/searchAvto.inc.php",
      data: "model="+model+"&marka="+marka+"&year="+valYear,
      success: function(msg){
        $("#listModification").html(msg);
      }
    });
	});
	$('body').on('click', '#listModification li', function(){
		var valModification = $(this).attr('value');
		$('#buttonModification').html(valModification);
		if($("#buttonTyresByAvto").val() == "tyres"){
			searchTyresByAvto(0);
		}
		if($("#buttonDiskByAvto").val() == "disk"){
			searchDiskByAvto(0);
		}
	});
});

/*SearchAvto2*/
$(document).ready(function(){
	$('body').on('change', '#listMarka2', function(){
		var valMarka = $(this).val();
		
    $.ajax({
      type: "POST",
      url: "/inc/searchAvtoTwo.inc.php",
      data: "marka="+valMarka,
      success: function(msg){
        $("#listModel2").html(msg);
      }
    });
	});
	$('body').on('change', '#listModel2', function(){
		var valModel = $(this).val();
		var marka = $('#listMarka2').val();
		
		$.ajax({
      type: "POST",
      url: "/inc/searchAvtoTwo.inc.php",
      data: "model="+valModel+"&marka="+marka,
      success: function(msg){
        $("#listYear2").html(msg);
      }
    });
	});
	$('body').on('change', '#listYear2', function(){
		var valYear = $(this).val();
		var marka = $('#listMarka2').val();
		var model = $('#listModel2').val();
		
		$.ajax({
		  type: "POST",
		  url: "/inc/searchAvtoTwo.inc.php",
		  data: "model="+model+"&marka="+marka+"&year="+valYear,
		  success: function(msg){
			$("#listModification2").html(msg);
		  }
		});
	});

	$(".btnShow").on("click", function(){
			var val = $(this).data('val');
			if(val == 1){
					$(this).data('val', '0');
					$(this).text('Скрыть');
					//$( '.contMenu' ).css( 'height', '100%' );
					$( '.contMenu' ).animate({'height':'100%'},3000);
			}else{
					$(this).data('val', '1');
					$(this).text('Развернуть');
					//$( '.contMenu' ).css( 'height', '240px' );
        	$( '.contMenu' ).animate({'height':'240px'},3000);
			}
	});

});

/* FILTER TYRES AND DISK BY AVTO*/
function searchTyresByAvto(page){
	var marka = $('#buttonMarka').html();
	var model = $('#buttonModel').html();
	var year = $('#buttonYear').html();
	var	modification = $('#buttonModification').html();
	
	var season_s = "";
	if($("#AvtoSeason_s").prop('checked')) { 
		season_s = "1";
	}
		
	var season_w = "";
	if($("#AvtoSeason_w").prop('checked')) { 
		season_w = "1";
	}
	
	var season_u = "";
		if($("#AvtoSeason_u").prop('checked')) { 
		season_u = "1";
	}

	var thorn_w = "";
	if($("#AvtoThorn_w").prop('checked')) { 
		thorn_w = "1";
	}

	var thorn_n = "";
		if($("#AvtoThorn_u").prop('checked')) { 
		thorn_n = "1";
	}
	
	if(page>0){
		var page = page - 1;
	}
	$('#AvtoSeason').show();
	selectSizeTyres();
	/*$("#resTyres").html("<div class='loadOver'>Загрузка...</div>");
	$.ajax({
		type: "POST",
		url: "/inc/apiSearchTyresByAvto.inc.php",
		dataType: "html",
		data: "marka="+marka+"&model="+model+"&year="+year+"&modification="+modification+"&season_s="+season_s+"&season_w="+season_w+"&season_u="+season_u+"&thorn_w="+thorn_w+"&thorn_n="+thorn_n+"&page="+page,
		success: function (msg) {
			selectSizeTyres();
			$('#AvtoSeason').show();
			$("#resTyres").html(msg);
		}
	});*/
}

function searchDiskByAvto(page){
	var marka = $('#buttonMarka').html();
	var model = $('#buttonModel').html();
	var year = $('#buttonYear').html();
	var	modification = $('#buttonModification').html();
	if(page>0){
		var page = page - 1;
	}
		selectSizeDisk();
	/*$("#resDisk").html("<div class='loadOver'>Загрузка...</div>");
	$.ajax({
		type: "POST",
		url: "/inc/apiSearchDiskByAvto.inc.php",
		dataType: "html",
		data: "marka="+marka+"&model="+model+"&year="+year+"&modification="+modification+"&page="+page,
		success: function (msg) {
			selectSizeDisk();
			$("#resDisk").html(msg);
		}
	});*/
}
$(document).ready(function(){
	$('#buttonTyresByAvto').bind('click', function(){
		searchTyresByAvto(0);
	});
	$('#buttonDiskByAvto').bind('click', function(){
		searchDiskByAvto(0);
	});
});
/*Dop value*/
function valMinus(id, kol){
	var val = $('#valInput'+id).val();
	if(val>1){
		val--;
		$('#valInput'+id).val(val);
	}
}
function valPlus(id, kol){
	var val = $('#valInput'+id).val();
	if(val<kol){
		val++;
		$('#valInput'+id).val(val);
	}
}
/*ADD BASKET*/
function addBasket(code, type, id){
	var quantity = $('#valInput'+id).val();
    var availability = $('#availability'+id).html();

    /*if(availability>=quantity){*/
        $.ajax({
            type: "POST",
            url: "/inc/addBasket.inc.php",
            dataType: "html",
            data: "code=" + code + "&quantity=" + quantity + "&type=" + type,
            success: function (msg) {
                $("#resBasket").html(msg);
            }
        });
    /*}else{
    	alert("К сожалению в наличии нету требуемого количества.");
	}*/
}
/*DELETE BASKET*/
function delBasket(id){
	$.ajax({
		type: "POST",
		url: "/inc/delBasket.inc.php",
		dataType: "json",
		data: {id : id},
		success: function (msg) {
			$("#resBasket").html(msg.head);
			$("#resCart").html(msg.body);
            selectGift();
		}
	});
}
/*SEARCH FROM MAIN*/
$(document).ready(function(){
	$('#buttonTyresMain').bind('click', function(){
		var widthTyres = $('#widthTyres').html();
		var heightTyres = $('#heightTyres').html();
		var diametrTyres = $('#diametrTyres').html();
		var	brandTyres = $('#brandTyres').attr('data-value');
		var marka = $('#buttonMarka').html();
		var model = $('#buttonModel').html();
		var year = $('#buttonYear').html();
		var	modification = $('#buttonModification').html();

		var season_s = "";
		if($("#season_s").prop('checked')) { 
			season_s = "1";
		}
		
		var season_w = "";
		if($("#season_w").prop('checked')) { 
			season_w = "1";
		}
		
		var season_u = "";
		if($("#season_u").prop('checked')) { 
			season_u = "1";
		}

		var thorn_w = "";
		if($("#thorn_w").prop('checked')) { 
			thorn_w = "1";
		}

		var thorn_n = "";
			if($("#thorn_n").prop('checked')) { 
			thorn_n = "1";
		}

        var only4 = "0";
        if($("#only4").prop('checked')) {
            only4 = "1";
        }
		location.href="/tyres/?width="+widthTyres+"&height="+heightTyres+"&diametr="+diametrTyres+"&brand="+brandTyres+"&season_s="+season_s+"&season_w="+season_w+"&season_u="+season_u+"&thorn_w="+thorn_w+"&thorn_n="+thorn_n+"&marka="+marka+"&model="+model+"&year="+year+"&modification="+modification+"&only4="+only4;
	});
	$('#buttonDiskMain').bind('click', function(){
		var widthDisk = $('#widthDisk').html();
		var diametrDisk = $('#diametrDisk').html();
		var pcdDisk = $('#pcdDisk').html();
		var	brandDisk = $('#brandDisk').attr('data-value');
		var et = $('#etDisk').attr('data-value');
		var dia = $('#diaDisk').attr('data-value');
		var marka = $('#buttonMarka').html();
		var model = $('#buttonModel').html();
		var year = $('#buttonYear').html();
		var	modification = $('#buttonModification').html();
		
		location.href="/disk/?width="+widthDisk+"&diametr="+diametrDisk+"&pcd="+pcdDisk+"&brand="+brandDisk+"&et="+et+"&dia="+dia+"&marka="+marka+"&model="+model+"&year="+year+"&modification="+modification;;

	});
	$('body').on('click', '#buttonByAvtoMain', function(){
		var marka = $('#buttonMarka').html();
		var model = $('#buttonModel').html();
		var year = $('#buttonYear').html();
		var	modification = $('#buttonModification').html();
		var cat = $("#buttonByAvtoMain").val();
		if(cat == ""){
			cat = "tyres";
		}
		location.href="/"+cat+"/?marka="+marka+"&model="+model+"&year="+year+"&modification="+modification;

	});
});

function summProduct(id, action, num){
	if(action == 'minus'){
		var val = $('#valInput'+num).val();
		if(val>1){
			val--;
			$.ajax({
				type: "POST",
				url: "/inc/updateSumm.inc.php",
				dataType: "json",
				data: {id : id, val : val},
				success: function (msg) {
					$('#valInput'+num).val(msg.quantity);
					$('#summProduct'+num).html(msg.price+' руб');
					$('#total').html(msg.summ+' руб');
				}
			});
		}
	}else{
		var val = $('#valInput'+num).val();
			val++;
			$.ajax({
				type: "POST",
				url: "/inc/updateSumm.inc.php",
				dataType: "json",
				data: {id : id, val : val},
				success: function (msg) {
					$('#valInput'+num).val(msg.quantity);
					$('#summProduct'+num).html(msg.price+' руб');
					$('#total').html(msg.summ+' руб');
				}
			});
	}
    selectGift();
}

function regUser(){
		var name = $('#name').val();
		var email = $('#email').val();
		var pass = $('#password').val();
		var rpass = $('#comfirm_pass').val();
		var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
		 
		if(name == "" || email == "" || pass == "" || rpass == ""){
			if(name == ""){
				$('#name').css({"border":"#cb1010 1px solid"});
				$('#name').attr('placeholder', 'Введите ваше имя');
			}else{
				$('#name').css({"border":"green 1px solid"});
			}
			if(email == ""){
				$('#email').css({"border":"#cb1010 1px solid"});
				$('#email').attr('placeholder', 'Введите ваш email');
			}else{
				if(pattern.test(email)){
					$('#email').css({"border":"green 1px solid"});
				}else{
					$('#email').css({"border":"#cb1010 1px solid"});
					$('#email').attr('placeholder', 'не коректный E-mail');
				}
			}
			if(pass == ""){
				$('#password').css({"border":"#cb1010 1px solid"});
				$('#password').attr('placeholder', 'Введите ваш пароль');
			}else{
				$('#password').css({"border":"green 1px solid"});
			}
			if(rpass == ""){
				$('#comfirm_pass').css({"border":"#cb1010 1px solid"});
				$('#comfirm_pass').attr('placeholder', 'Повторите ваш пароль');
			}else{
				$('#comfirm_pass').css({"border":"green 1px solid"});
			}
		}else{
			$.ajax({
				type: "POST",
				url: "/inc/regUser.inc.php",
				dataType: "json",
				data: {name : name, email : email, password : pass, comfirm_pass : rpass},
				success: function (msg) {
					$('#error_email').html(msg.error_email);
					$('#error_name').html(msg.error_name);
					$('#error_pass').html(msg.error_pass);
					$('#error_rpass').html(msg.error_rpass);
					$('#regOk').html(msg.regOk);
				}
			});
		}
}

function loginUser(){
	var email = $('#emailLogin').val();
	var pass = $('#passwordLogin').val();
	if(email == "" || pass == ""){
		if(email == ""){
			$('#emailLogin').css({"border":"#cb1010 1px solid"});
			$('#emailLogin').attr('placeholder', 'Введите ваш email');
		}else{
			$('#emailLogin').css({"border":"green 1px solid"});
		}
		if(pass == ""){
			$('#passwordLogin').css({"border":"#cb1010 1px solid"});
			$('#passwordLogin').attr('placeholder', 'Введите ваш пароль');
		}else{
			$('#passwordLogin').css({"border":"green 1px solid"});
		}
	}else{
		$.ajax({
			type: "POST",
			url: "/inc/loginUser.inc.php",
			dataType: "json",
			data: {email : email, password : pass},
			success: function (msg) {
				if(msg.ok == "ok"){
					$('#loginModal').modal('hide');
					$('#loginModal').on('hidden.bs.modal', function () {
						$('#loginForm').html('<li><a href="/orders.html" class="icon-1"><i class="fa fa-user"></i><span>Мои заказы</span></a></li><li><a href="/profile.html" class="icon-1"><i class="fa fa-user"></i><span>Профиль</span></a></li>');
					});
					//$('#loginForm').html('<li><a href="/orders/" class="icon-1"><i class="fa fa-user"></i><span>Мои заказы</span></a></li>');
				}else{
					if(msg.error_active){
						$('#errorActive').html(msg.error_active);
						$('#errorActive').addClass("bs-callout bs-callout-warning");
					}
					if(msg.error_login){
						$('#errorLogin').html(msg.error_login);
						$('#errorLogin').addClass("bs-callout bs-callout-warning");
					}
				}
			}
		});
	}
}
function loginUserCheckout(){
	var email = $('#email').val();
	var pass = $('#password').val();
	if(email == "" || pass == ""){
		if(email == ""){
			$('#email').css({"border":"#cb1010 1px solid"});
			$('#email').attr('placeholder', 'Введите ваш email');
		}else{
			$('#email').css({"border":"green 1px solid"});
		}
		if(pass == ""){
			$('#password').css({"border":"#cb1010 1px solid"});
			$('#password').attr('placeholder', 'Введите ваш пароль');
		}else{
			$('#password').css({"border":"green 1px solid"});
		}
	}else{
		$.ajax({
			type: "POST",
			url: "/inc/loginUser.inc.php",
			dataType: "json",
			data: {email : email, password : pass},
			success: function (msg) {
				if(msg.ok == "ok"){
					location.href="/checkout.html";
				}else{
					if(msg.error_active){
						$('#error_active').html(msg.error_active);
						$('#error_active').addClass("bs-callout bs-callout-warning");
					}
					if(msg.error_login){
						$('#error_login').html(msg.error_login);
						$('#error_login').addClass("bs-callout bs-callout-warning");
					}
				}
			}
		});
	}
}

function checkOut(){
	var fio = $('#fio').val();
	var phone = $('#phone').val();
	var address = $('#address').val();
	var delivery = $('input[name=delivery]:checked').val();
	var comment = $('#comment').val();
    var region = $('#region').val();

	if(phone == "" || fio == "" || (address == "" && delivery == "2")){
		if(fio == ""){
			$('#fio').css({"border":"#cb1010 1px solid"});
			$('#fio').attr('placeholder', 'Введите Ваше имя и фамилию');
		}else{
			$('#fio').css({"border":"green 1px solid"});
		}
		if(phone == ""){
			$('#phone').css({"border":"#cb1010 1px solid"});
			$('#phone').attr('placeholder', 'Введите ваш телефон');
		}else{
			$('#phone').css({"border":"green 1px solid"});
		}
		if(address == "" && delivery == "2"){
			$('#address').css({"border":"#cb1010 1px solid"});
			$('#address').attr('placeholder', 'Введите адрес доставки');
		}else{
			$('#address').css({"border":"green 1px solid"});
		}
	}else{
		$.ajax({
			type: "POST",
			url: "/inc/addOrder.inc.php",
			dataType: "html",
			data: "fio="+fio+"&phone="+phone+"&address="+address+"&delivery="+delivery+"&comment="+comment+"&region="+region,
			success: function (msg) {
				if(msg>0){
					$('#formOrder').html("");
					$('#resOrder').html('<div class="cart-total" style="text-align:center;"><i class="fa fa-shopping-cart"></i> Спасибо, Ваш заказ №'+msg+' принят к обработке! Наш менеджер свяжется с Вами в ближайшее время по указанным контактам.</div>');
				}else{
					$('#formOrder').html("");
					$('#resOrder').html('<div class="cart-total" style="text-align:center;"><i class="fa fa-warning"></i> Ошибка, заказ не отправлен.</div>');
				}
			}
		});
	}
}

function userEdit(){
	var email = $('#email').val();
	var name = $('#name').val();
	var phone = $('#phone').val();
	/*var date_birth = $('#date_birth').val();
	var city = $('#city').val();
	var address = $('#address').val();
	var country = $('#country').val();
	var sex = $('#sex').val();*/
	var password = $('#password').val();
	var info = "";
	
	if($("#info").prop('checked')) { 
		info = "1";
	}
	
	
	if(email == "" || name == ""  || phone == ""){
		if(email == ""){
			$('#email').css({"border":"#cb1010 1px solid"});
			$('#email').attr('placeholder', 'Введите ваш email');
		}else{
			$('#email').css({"border":"green 1px solid"});
		}
		if(name == ""){
			$('#name').css({"border":"#cb1010 1px solid"});
			$('#name').attr('placeholder', 'Введите ваше имя');
		}else{
			$('#name').css({"border":"green 1px solid"});
		}
		/*if(date_birth == ""){
			$('#date_birth').css({"border":"#cb1010 1px solid"});
			$('#date_birth').attr('placeholder', 'Введите вашу дату рождения');
		}else{
			$('#date_birth').css({"border":"green 1px solid"});
		}*/
		if(phone == ""){
			$('#phone').css({"border":"#cb1010 1px solid"});
			$('#phone').attr('placeholder', 'Введите ваш телефон');
		}else{
			$('#phone').css({"border":"green 1px solid"});
		}
		/*if(city == ""){
			$('#city').css({"border":"#cb1010 1px solid"});
			$('#city').attr('placeholder', 'Введите ваш город');
		}else{
			$('#city').css({"border":"green 1px solid"});
		}
		if(address == ""){
			$('#address').css({"border":"#cb1010 1px solid"});
			$('#address').attr('placeholder', 'Введите ваш адрес');
		}else{
			$('#address').css({"border":"green 1px solid"});
		}
		if(country == "0"){
			$('#country').css({"border":"#cb1010 1px solid"});
			$('#country').attr('placeholder', 'Выбирите вашу страну');
		}else{
			$('#country').css({"border":"green 1px solid"});
		}
		if(sex == "0"){
			$('#sex').css({"border":"#cb1010 1px solid"});
			$('#sex').attr('placeholder', 'Выбирите ваш пол');
		}else{
			$('#sex').css({"border":"green 1px solid"});
		}*/
	}else{
		$.ajax({
			type: "POST",
			url: "/inc/editUser.inc.php",
			dataType: "json",
			data: {email : email, password : password, name : name, phone : phone, info : info},
			success: function (msg) {
				$('#error_pass').html(msg.error_pass);
				 if(msg.updateOk == "true"){
					$('#updateUser').modal('show');
				 }
			}
		});
	}
}

$(function() {
    $( "#date_birth" ).datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
    changeYear: true
	});
});
function selectProduct(page){
	var list = null, res = '';
	var code = $("#categoriesCode").val();
	var sort = $("#sortProduct").html();
	var price = $("#priceProduct").val();

	list = $('#filter :checkbox:checked');
	list.each( function(ind) {
	  res += $(this).val();
	  if (ind < list.length - 1) res +=','; // например через запятую
	});
	$.ajax({
		type: "POST",
		url: "/inc/filter.inc.php",
		dataType: "json",
		data: {id : res, code : code, sort : sort, price : price, page : page},
		success: function (msg) {
			$("#resProduct").html(msg.product);
			$("#resPagination").html(msg.pagination);
		}
	});
}
function selectProductNew(page){
	var list = null, res = '';
	var code = $("#categoriesCode").val();
	var sort = $("#sortProduct").html();
	var price = $("#priceProduct").val();

	list = $('#filter select');
	list.each( function(ind) {
		res += $(this).val();
		if ($(this).val()){
			if (ind < list.length - 1) res += ','; // например через запятую
		}
	});
	$.ajax({
		type: "POST",
		url: "/inc/filter.inc.php",
		dataType: "json",
		data: {id : res, code : code, sort : sort, price : price, page : page},
		success: function (msg) {
			$("#resProduct").html(msg.product);
			$("#resPagination").html(msg.pagination);
		}
	});
}

function selectFilterTyres(page){
  var list = null, res = '';
  var code = $("#categoriesCode").val();
  var sort = $("#sortProduct").html();
  var price = $("#priceProduct").val();

  list = $('#filterTyres select');
  list.each( function(ind) {
    res += $(this).val();
    if ($(this).val()){
      if (ind < list.length - 1) res += ','; // например через запятую
    }
  });
  $.ajax({
    type: "POST",
    url: "/inc/filter.inc.php",
    dataType: "json",
    data: {id : res, code : code, sort : sort, price : price, page : page},
    success: function (msg) {
      $("#resProduct").html(msg.product);
      $("#resPagination").html(msg.pagination);
    }
  });
}

function selectProductShowMore(page){
    var list = null, res = '';
    var code = $("#categoriesCode").val();
    var sort = $("#sortProduct").html();
    var price = $("#priceProduct").val();

    list = $('#filter :checkbox:checked');
    list.each( function(ind) {
        res += $(this).val();
        if (ind < list.length - 1) res +=','; // например через запятую
    });
    if(page == 1){
        $("#resProduct").html("");
    }
    $("#loadDisk").show();
    $("#loadDisk").html("<div class='loadOver'>Загрузка...</div>");
    $.ajax({
        type: "POST",
        url: "/inc/filter.inc.php",
        dataType: "json",
        data: {id : res, code : code, sort : sort, price : price, page : page, showmore: '1'},
        success: function (msg) {
        		///console.log(msg.sql);
            $("#loadDisk").hide();
            $("#resProduct").append(msg.product);
            if (+msg.total>+page) {
                page = +page+1;
                var button = '<nav aria-label="Page navigation"><ul class="pagination ht-pagination"><li><a onclick="selectProductShowMore('+page+')" class="showMore" style="width:100%; height:100%;">Показать еще</a></li></ul></nav>';
           	 	$("#resPagination").html(button);
        	}else{
                $("#resPagination").html('');
			}
        }
    });
}
$(document).ready(function(){
	$('#filter input:checkbox').bind('click', function(){
	   selectProduct(1);
	});
	$('#filter select').bind('change', function(){
		selectProductNew(1);
	});
	$('#filterTyres select').bind('change', function(){
    selectFilterTyres(1);
	});
	$('#listSort li').bind('click', function(){
		var sortProduct = $(this).html();
		$('#sortProduct').html(sortProduct);
	   selectProduct(1);
	});
	$('#buttonFilter').bind('click', function(){
	   selectProduct(1);
	});
});

function checkOutFast(code, type, id){
	var fio = $('#fio').val();
	var phone = $('#phone').val();
	var address = $('#address').val();
	var delivery = $('input[name=delivery]:checked').val();
	var comment = $('#comment').val();
	var quantity = $('#valInput'+id).val();
    var region = $('#region').val();
    var polKonf = $('#polKonf:checked').val();

	if(phone == "" || fio == "" || (address == "" && delivery == "2") || polKonf!=1){
		if(fio == ""){
			$('#fio').css({"border":"#cb1010 1px solid"});
			$('#fio').attr('placeholder', 'Введите Ваше имя и фамилию');
		}else{
			$('#fio').css({"border":"green 1px solid"});
		}
		if(phone == ""){
			$('#phone').css({"border":"#cb1010 1px solid"});
			$('#phone').attr('placeholder', 'Введите ваш телефон');
		}else{
			$('#phone').css({"border":"green 1px solid"});
		}
		if(address == "" && delivery == "2"){
			$('#address').css({"border":"#cb1010 1px solid"});
			$('#address').attr('placeholder', 'Введите адрес доставки');
		}else{
			$('#address').css({"border":"green 1px solid"});
		}
        if(polKonf!=1){
            $('#polKonfDiv').css({"color":"#cb1010"});
        }else{
            $('#polKonfDiv').css({"color":"green"});
        }
	}else{
		$.ajax({
			type: "POST",
			url: "/inc/fastBuy.inc.php",
			dataType: "html",
			data: "fio="+fio+"&phone="+phone+"&address="+address+"&delivery="+delivery+"&comment="+comment+"&code="+code+"&quantity="+quantity+"&type="+type+"&region="+region,
			success: function (msg) {
				if(msg>0){
					$('#regOk').html('<div class="cart-total" style="text-align:center;"><i class="fa fa-shopping-cart"></i> Спасибо, Ваш заказ №'+msg+' принят к обработке! Наш менеджер свяжется с Вами в ближайшее время по указанным контактам.</div>');
				}else{
					$('#regOk').html('<div class="cart-total" style="text-align:center;"><i class="fa fa-warning"></i> Ошибка, заказ не отправлен.</div>');
				}
			}
		});
	}

}

function addRating(x, id){
	$.ajax({
		type: "POST",
		url: "/inc/addRating.inc.php",
		dataType: "html",
		data: "x="+x+"&id="+id,
		success: function (msg) {
			if(msg){
				$('#rRatingId').html(msg);
			}
		}
	});
}

function selectOrders(page){
	$.ajax({
		type: "POST",
		url: "/inc/selectOrders.inc.php",
		dataType: "html",
		data: "page="+page,
		success: function (msg) {
			$('#sOrders').html(msg);
		}
	});
}

function showMore(id){
	var c = $('#moreFilter'+id).attr("class");
	if(c == "buttonMore"){
		$('#filter'+id).removeClass();
		$("#moreFilter"+id).html("Скрыть");
		$('#moreFilter'+id).removeClass();
		$('#moreFilter'+id).addClass("buttonHide");
	}else{
		$('#filter'+id).addClass("hiddenFilter");
		$("#moreFilter"+id).html("Еще");
		$('#moreFilter'+id).removeClass();
		$('#moreFilter'+id).addClass("buttonMore");
	}
}

function selectNews(page){
	$.ajax({
		type: "POST",
		url: "/inc/selectNews.inc.php",
		dataType: "html",
		data: "page="+page+"&section_code=news",
		success: function (msg) {
			$('#sNews').html(msg);
		}
	});
}

function recoveryPass(){
	var email = $('#emailRec').val();
	$.ajax({
		type: "POST",
		url: "/inc/recovery.inc.php",
		dataType: "html",
		data: "email="+email,
		success: function (msg) {
			if(msg == "1"){
				$('#recoveryBlock').hide();
				$('#resRecovery').html("Электронное письмо с запросом на изменение пароля было выслано на Ваш электронный адрес.");
			}else{
				$('#errorRecovery').html("Такой E-mail в базе не найден.");
			}
		}
	});
}
function selectSizeTyres(){
	var year = $('#buttonYear').html();
  var marka = $('#buttonMarka').html();
  var model = $('#buttonModel').html();
	var modification = $('#buttonModification').html();

		$.ajax({
				type: "POST",
				url: "/inc/recTyres.inc.php",
				dataType: "json",
				data: {model : model, marka : marka, year : year, modification : modification},
				success: function(msg){
					if(msg.error){
						$("#resTyres").html(msg.error);
					}else{
						$("#recTyres").show();
						$("#recTyres").html(msg.content);
						checkSizeTyres(msg.width, msg.profile, msg.diameter, msg.widthId, msg.heigthId, msg.diametrId);
						set_cookie("model", model);
						set_cookie("marka", marka);
						set_cookie("year", year);
						set_cookie("modification", modification);
					}
				}
		});

}

function selectSizeDisk(){
	var year = $('#buttonYear').html();
    var marka = $('#buttonMarka').html();
    var model = $('#buttonModel').html();
	var modification = $('#buttonModification').html();

		$.ajax({
				type: "POST",
				url: "/inc/recDisk.inc.php",
				dataType: "json",
				data: {model : model, marka : marka, year : year, modification : modification},
				success: function(msg){
					if(msg.error){
						$("#resDisk").html(msg.error);
					}else{
						$("#recTyres").show();
						$("#recTyres").html(msg.content);
						checkSizeDisk(msg.width, msg.diametr, msg.pcd, msg.et, msg.dia, msg.widthId, msg.diametrId, msg.pcdId);
						set_cookie("model", model);
						set_cookie("marka", marka);
						set_cookie("year", year);
						set_cookie("modification", modification);
					}
				}
		});

}
function checkSizeTyres(width, height, diametr, widthId, heightId, diametrId){
	$('#widthTyres').html(width);
	$('#heightTyres').html(height);
	$('#diametrTyres').html("R"+diametr);
  $('#widthTyres').attr('data-value', widthId);
  $('#heightTyres').attr('data-value', heightId);
  $('#diametrTyres').attr('data-value' ,diametrId);

	if($("#AvtoSeason_s").prop('checked')) {
		$("#season_s").attr("checked",true);
	}
	if($("#AvtoSeason_w").prop('checked')) {
		$("#season_w").attr("checked",true);
	}
	if($("#AvtoSeason_u").prop('checked')) {
		$("#season_u").attr("checked",true);
	}
	if($("#AvtoThorn_w").prop('checked')) {
		$("#thorn_w").attr("checked",true);
	}
	if($("#AvtoThorn_n").prop('checked')) {
		$("#thorn_n").attr("checked",true);
	}
	searchTyres(1);
}
function checkSizeDisk(width, diametr, pcd, et, dia,  widthId, diametrId, pcdId){
		var widthDisk = $('#widthDisk').html(width);
		var diametrDisk = $('#diametrDisk').html("R"+diametr);
		var pcdDisk = $('#pcdDisk').html(pcd);
    var	et = $('#etDisk').attr('data-value', et);
    var	dia = $('#diaDisk').attr('data-value', dia);

    $('#etDisk').html(et);
    $('#diaDisk').html(dia);
		$('#widthDisk').attr('data-value', widthId);
		$('#diametrDisk').attr('data-value', diametrId);
		$('#pcdDisk').attr('data-value', pcdId);

		searchDisk(1);
}
function selectTyresFromCookie(){
	///////SearshAvto
	var model = get_cookie("model");
	var marka = get_cookie("marka");
	var year = get_cookie("year");
	var modification = get_cookie("modification");

	var season_s = get_cookie("season_s");
	if(season_s == 1) {
		$("#season_s").attr("checked",true);
	}

	var season_w = get_cookie("season_w");
	if(season_w == 1) {
		$("#season_w").attr("checked",true);
	}

	var thorn_w = get_cookie("thorn_w");
	if(thorn_w == 1) {
		$("#thorn_w").attr("checked",true);
	}

	var thorn_n = get_cookie("thorn_n");
	if(thorn_n == 1) {
		$("#thorn_n").attr("checked",true);
	}


	if(model && marka && year && modification){
		var model = get_cookie("model");
		if(model){
			$('#buttonModel').html(modelName);
		}
		var marka = get_cookie("marka");
		if(marka){
			$('#buttonMarka').html(marka);
		}
		var year = get_cookie("year");
		if(year){
			$('#buttonYear').html(year);
		}
		var modification = get_cookie("modification");
		if(modification){
			$('#buttonModification').html(modification);
		}
		searchTyresByAvto(0);
	}else{
		var width = get_cookie("width");
        var widthName = get_cookie("widthName");
		if(width){
			$('#widthTyres').html(widthName);
            $('#widthTyres').attr('data-value', width);
		}

		var height = get_cookie("height");
        var heightName = get_cookie("heightName");
		if(height){
			$('#heightTyres').html(heightName);
            $('#heightTyres').attr('data-value', height);
		}

		var diametr = get_cookie("diametr");
        var diametrName = get_cookie("diametrName");
        if(diametrName == 'all') diametrName ="Все";
		if(diametr){
			$('#diametrTyres').html(diametrName);
            $('#diametrTyres').attr('data-value', diametr);
		}

		var brand = get_cookie("brand");
        var brandName = get_cookie("brandName");
		if(brand){
			$('#brandTyres').html(brandName);
            $('#brandTyres').attr('data-value', brand);
		}
		if(width || height || diametr || brand){
			searchTyres(0);
		}
	}
}
function selectDiskFromCookie(){
	///////SearshAvto
	var model = get_cookie("model");
	var marka = get_cookie("marka");
	var year = get_cookie("year");
	var modification = get_cookie("modification");

	var	et = get_cookie("et");
	if(et){
		$('#et').val(et)
	}

	var	dia = get_cookie("dia");
	if(dia){
		$('#dia').val(dia)
	}

	if(model && marka && year && modification){
		var model = get_cookie("model");
		if(model){
			$('#buttonModel').html(model);
		}
		var marka = get_cookie("marka");
		if(marka){
			$('#buttonMarka').html(marka);
		}
		var year = get_cookie("year");
		if(year){
			$('#buttonYear').html(year);
		}
		var modification = get_cookie("modification");
		if(modification){
			$('#buttonModification').html(modification);
		}
		searchDiskByAvto(0);
	}else{
		var widthDisk = get_cookie("widthDisk");
    var widthDiskName = get_cookie("widthDiskName");

		if(widthDisk){
			$('#widthDisk').html(widthDisk);
      $('#widthDisk').attr('data-value', widthDiskName);
		}
		var diametrDisk = get_cookie("diametrDisk");
    var diametrDiskName = get_cookie("diametrDiskName");
		if(diametrDisk){
			$('#diametrDisk').html(diametrDiskName);
      $('#diametrDisk').attr('data-value', diametrDisk);
		}
		var pcdDisk = get_cookie("pcdDisk");
    var pcdDiskName = get_cookie("pcdDiskName");
		if(pcdDisk){
			$('#pcdDisk').html(pcdDisk);
      $('#pcdDisk').attr('data-value', pcdDiskName);
		}
		var brandDisk = get_cookie("brandDisk");
    var brandDiskName = get_cookie("brandDiskName");
		if(brandDisk){
			$('#brandDisk').html(brandDisk);
      $('#brandDisk').attr('data-value', brandDiskName);
		}
		if(widthDisk || diametrDisk || pcdDisk || brandDisk){
			searchDisk(0);
		}
	}
}
function delCookie(code){
	delete_cookie("model");
	delete_cookie("marka");
	delete_cookie("year");
	delete_cookie("modification");
	delete_cookie("width");
  delete_cookie("widthName");
	delete_cookie("height");
  delete_cookie("heightName");
	delete_cookie("diametr");
  delete_cookie("diametrName");
	delete_cookie("brand");
  delete_cookie("brandName");
	delete_cookie("season_s");
	delete_cookie("season_w");
	delete_cookie("thorn_w");
	delete_cookie("thorn_n");
	delete_cookie("widthDisk");
	delete_cookie("diametrDisk");
	delete_cookie("pcdDisk");
	delete_cookie("brandDisk");
  delete_cookie("widthDiskName");
  delete_cookie("diametrDiskName");
  delete_cookie("pcdDiskName");
  delete_cookie("brandDiskName");
	delete_cookie("et");
	delete_cookie("dia");
  delete_cookie("etDiskName");
  delete_cookie("diaDiskName");
	window.location.href='/'+code+'/';
}


$(function() {
  checkRegion();
  selectGift();
});

function checkRegion(){
    var region = $('#region').val();
    var delivery = $('input[name=delivery]:checked').val();

	$.ajax({
		type: "POST",
		url: "/inc/selectSummTextDelivery.inc.php",
		dataType: "html",
		data: {region : region, delivery : delivery},
		success: function(msg){
				$('#resDeliv').html(msg);
		}
	});
}
function checkDelivery(a){
  var region = $('#region').val();
  var delivery = a;

  if(a == "2"){
    $("#region option[value=2]").attr('disabled','disabled');
    $("#region option[value=3]").attr('disabled','disabled');
  }else{
      $("#region option[value=2]").removeAttr('disabled');
      $("#region option[value=3]").removeAttr('disabled');
  }

  $.ajax({
    type: "POST",
    url: "/inc/selectSummTextDelivery.inc.php",
    dataType: "html",
    data: {region : region, delivery : delivery},
    success: function(msg){
      $('#resDeliv').html(msg);
    }
  });
}
function selectGift(){
    $.ajax({
        type: "POST",
        url: "/inc/gift/sGift.inc.php",
        dataType: "html",
        success: function(msg){
            $('#resGift').html(msg);
        }
    });
}
function addCityToDB(id, name, rn) {
    $.ajax({
        type: "POST",
        url: "/inc/addCityToDB.inc.php",
        dataType: "html",
        data: {id: id, name: name, rn: rn},
        success: function (res) {
            $('#block-search-result').hide();
            $('#regionModal').modal('hide');
        }
    });
}
function sAutoTyresDisk(){
    var year = $('#buttonYear').html();
    var marka = $('#buttonMarka').html();
    var model = $('#buttonModel').html();
    var modification = $('#buttonModification').html();
    var cat = $('#categoriesCode').val();

    $.ajax({
        type: "POST",
        url: "/inc/recTyresDisk.inc.php",
        dataType: "json",
        data: {model : model, marka : marka, year : year, modification : modification, cat: cat},
        success: function(msg){
            $('#resAuto').html(msg.cont);
        }
    });
}
function sAutoTyresDiskV2(){
	console.log('aa');
	var year = $('#buttonYear').html();
	var marka = $('#buttonMarka').html();
	var model = $('#buttonModel').html();
	var modification = $('#buttonModification').html();
	var cat = $('#categoriesCode').val();
	var group = $('#groupMod').val();
	console.log('year '+year+' marka '+marka+' model '+model+' modification '+modification+' cat '+cat+' group '+group);
	$.ajax({
		type: "POST",
		url: "/inc/recTyresDiskV2.inc.php",
		dataType: "json",
		data: {model : model, marka : marka, year : year, modification : modification, cat: cat, group: group},
		success: function(msg){
			$('#resAuto').html(msg.cont);
		}
	});
}
function selectCityByRegionKladr(id){
    $.ajax({
        type: "POST",
        url: "/inc/regionKladr.inc.php",
        dataType: "html",
        data: {id: id},
        success: function (res) {
        	$('#cityKladrReg').html(res);
          $('.layer li').removeClass('selected');
          $('#'+id).addClass('selected');
        }
    });
}
function kdkdkdkkd(){
	alert("ss");
    $('#et').val('49 - 49');
    $('#dia').val('56.6 - 56.6');
}

function checkAvailability(id){
    var availability = $('#availability'+id).html();
    var val = $('#valInput'+id).val();

    if(availability < val){
        $('#valInput'+id).val(availability);
    	alert("Неверное количество! В наличии только "+ availability);
	}
}
function sModel(){
	var valModel = $('#buttonModel').html();
	var marka = $('#buttonMarka').html();
	$('#buttonYear').html("Год");
	$('#buttonModification').html("Модификация");
	console.log('model');
	$.ajax({
		type: "POST",
		url: "/inc/searchAvto.inc.php",
		data: "model="+valModel+"&marka="+marka,
		success: function(msg){
			console.log(msg);
			if(msg == "groupMod"){
				$("#buttonYear").attr("data-toggle", "disable");
				$("#buttonYear").css({'color':'#ccc'});
				$("#buttonModification").attr("data-toggle", "disable");
				$("#buttonModification").css({'color':'#ccc'});
				$("#groupMod").val('1');
				$("#noMod").show();
			}else {
				$("#listYear").html(msg);
				$("#groupMod").val('0');
				$("#buttonYear").attr("data-toggle", "dropdown");
				$("#buttonYear").css({'color':'#333'});
				$("#buttonModification").attr("data-toggle", "dropdown");
				$("#buttonModification").css({'color':'#333'});
				$("#noMod").hide();
			}
		}
	});
}