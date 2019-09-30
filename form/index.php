<?
error_reporting(0);
header("Content-Type: text/html;charset=utf8");
session_start();
//////Подключение к базе
include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
/////Подключение библиотеки
include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');

include($_SERVER['DOCUMENT_ROOT'].'/templates/header.tpl.php');?>
  <style>
    /*form styles*/
    #msform {
      max-width: 800px;
      margin: 50px auto;
      text-align: center;
      position: relative;
    }
    #msform fieldset {
      background: white;
      border: 0 none;
      border-radius: 3px;
      box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
      padding: 20px 30px;

      box-sizing: border-box;
      width: 80%;
      margin: 0 10%;

      /*stacking fieldsets above each other*/
      /*position: absolute;*/
    }
    /*Hide all except first fieldset*/
    #msform fieldset:not(:first-of-type) {
      display: none;
    }
    /*inputs*/
    #msform input, #msform textarea {
      padding: 15px;
      border: 1px solid #ccc;
      border-radius: 3px;
      margin-bottom: 10px;
      width: 100%;
      box-sizing: border-box;
      color: #2C3E50;
      font-size: 13px;
    }
    /*buttons*/
    #msform .action-button {
      width: 100px;
      background: #27AE60;
      font-weight: bold;
      color: white;
      border: 0 none;
      border-radius: 1px;
      cursor: pointer;
      padding: 10px 5px;
      margin: 10px 5px;
    }
    #msform .action-button:hover, #msform .action-button:focus {
      box-shadow: 0 0 0 2px white, 0 0 0 3px #27AE60;
    }
    /*headings*/
    .fs-title {
      font-size: 15px;
      text-transform: uppercase;
      color: #2C3E50;
      margin-bottom: 10px;
    }
    .fs-subtitle {
      font-weight: normal;
      font-size: 13px;
      color: #666;
      margin-bottom: 20px;
    }
    /*progressbar*/
    #progressbar {
      margin-bottom: 30px;
      overflow: hidden;
      /*CSS counters to number the steps*/
      counter-reset: step;
    }
    #progressbar li {
      list-style-type: none;
      color: white;
      text-transform: uppercase;
      font-size: 9px;
      width: 33.33%;
      float: left;
      position: relative;
    }
    #progressbar li:before {
      content: counter(step);
      counter-increment: step;
      width: 20px;
      line-height: 20px;
      display: block;
      font-size: 10px;
      color: #333;
      background: white;
      border-radius: 3px;
      margin: 0 auto 5px auto;
    }
    /*progressbar connectors*/
    #progressbar li:after {
      content: '';
      width: 100%;
      height: 2px;
      background: white;
      position: absolute;
      left: -50%;
      top: 9px;
      z-index: -1; /*put it behind the numbers*/
    }
    #progressbar li:first-child:after {
      /*connector not needed before the first step*/
      content: none;
    }
    /*marking active/completed steps green*/
    /*The number of the step and the connector before it = green*/
    #progressbar li.active:before,  #progressbar li.active:after{
      background: #27AE60;
      color: white;
    }

  </style>
  <div id="wrap-body" class="p-t-lg-30">
  <div class="container">
  <div class="wrap-body-inner">
  <!-- Product cart -->
  <div class="block-cart m-b-lg-0 m-t-lg-30 m-t-xs-0">
    <form id="msform">
      <!-- progressbar -->
      <ul id="progressbar">
        <li class="active">Account Setup</li>
        <li>Social Profiles</li>
        <li>Personal Details</li>
      </ul>
      <!-- fieldsets -->
      <fieldset>
        <h2 class="fs-title" style="margin: 0;">ШАГ 1 </h2>
        <?include_once $_SERVER['DOCUMENT_ROOT']."/form/1step.tpl.php";?>

        <input type="button" name="next" class="next action-button" value="Далее" />
      </fieldset>
      <fieldset>
        <h2 class="fs-title">ШАГ 2</h2>

        <?include_once $_SERVER['DOCUMENT_ROOT']."/form/2step.tpl.php";?>

        <input type="button" name="previous" class="previous action-button" value="Назад" />
        <input type="button" name="next" class="next action-button" value="Далее" />
      </fieldset>
      <fieldset>
        <h2 class="fs-title">ШАГ 3</h2>
        <?include_once $_SERVER['DOCUMENT_ROOT']."/form/3step.tpl.php";?>
        <input type="button" name="previous" class="previous action-button" value="Назад" />
        <input type="submit" name="submit" class="submit action-button" value="Submit" />
      </fieldset>
    </form>
  </div>
  </div>
  </div>
  </div>

<script>
    function checkDelivery2(type){
        $.ajax({
            type: "POST",
            url: "/form/delivery.inc.php",
            dataType: "html",
            data: {type : type},
            success: function (msg) {
                $('#resDeliv').html(msg);
            }
        });
    }
    function checkDivTransCom(type){
        $.ajax({
            type: "POST",
            url: "/form/deliveryTransCom.inc.php",
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
                                url: "/form/kladr.inc.php",
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
                                url: "/form/kladr.inc.php",
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
                                    url: "/form/kladr.inc.php",
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
    function checkOut2(){
        var type = $('input[name=delivery]:checked').val();
        var office = $('#samovivoz').val();
        var city = $('#city').val();
        var region = $('#region').val();

        var sTransCom = $('#sTransCom').val();
        if(sTransCom == '1') {
            sTransCom = $('#otherCompany').val()
        }
        var divTransCom = $('input[name=deliveryTransCom]:checked').val();

        alert(city);
        alert(region);
    }
    function otherCompany(){
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
</script>

<?
include($_SERVER['DOCUMENT_ROOT'].'/templates/footer.tpl.php');

?>
<script src="/js/index.js"></script>
