<?php
error_reporting(0);
header("Content-Type: text/html;charset=utf8");
include($_SERVER['DOCUMENT_ROOT'] . '/inc/redirect.inc.php');
session_start();
//////Подключение к базе
include($_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php');
/////Подключение библиотеки
include($_SERVER['DOCUMENT_ROOT'] . '/inc/function.inc.php');

$city = "Челябинск";
$rn = "";
$city_s= file_get_contents('https://pecom.ru/ru/calc/towns.php');
foreach (json_decode($city_s) as $val) {
    foreach ($val as $key => $item){
        if (($item != $city AND $item == $city . " (" . $rn . " р-н)") OR ($item == $city AND $item != $city . " (" . $rn . " р-н)")){
                $arRes[$key] = $item;
        }
    }
}

//echo unicode_to_utf8($city);
//echo utf8_encode($city);
//ar_dump(json_decode($city, true));
///echo json_decode($city);
//echo "<pre>".print_r(utf8_encode($city), true)."</pre>";

?>

<? include($_SERVER['DOCUMENT_ROOT'] . '/templates/header2.tpl.php'); ?>
<div>
  <input type='text' id='cityUser' placeholder='' autocomplete='off'>
  <div id='block-search-result' style="display: none;">
    <ul id='result_search'></ul>
  </div>
</div>

<script>
  var pec_goods = [],
      pec_informer_size = "horizontal", // тип информера
      pec_from = "-455", // город отправки
      pec_to = "<?=selectPEKID();?>", // город доставки
      pec_insurance = "", // сумма для страхования
      pec_packing = ""; // тип упаковки
      pec_goods[0] = "0/0/0/0.400/43.20"; // габариты, объем, вес
</script>
<script src="https://pecom.ru/business/developers/js_informer/get_informer.js" charset="utf-8"></script>
<? include($_SERVER['DOCUMENT_ROOT'] . '/templates/footer.tpl.php'); ?>
<script>
  $(document).ready(function () {
    $('body').on('click', '#result_search_city li', function () {
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
</script>
