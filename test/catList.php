<?php
//////Подключение к базе
include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
/////Подключение библиотеки
include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');


$_GET["categories_code"] = 'continental';
$sCBC2 = selectCategoriesByCode2($_GET["categories_code"]);
$res = sort_nested_arrays($sCBC2, array('id_seeson' => 'ASC'));?>



<label>
  Ширина
  <select name="width" id="optionstWidthTyres">
    <option value="">Все</option>
    <option value="232">5</option>
    <option value="233">6.5</option>
    <option value="234">7</option>
    <option value="98">7.5</option>
    <option value="235">10</option>
    <option value="236">27</option>
    <option value="237">30</option>
    <option value="238">31</option>
    <option value="239">32</option>
    <option value="240">33</option>
    <option value="241">35</option>
    <option value="242">37</option>
    <option value="103">135</option>
    <option value="104">145</option>
    <option value="105">155</option>
    <option value="106">165</option>
    <option value="107">175</option>
    <option value="108">185</option>
    <option value="109">195</option>
    <option value="110">205</option>
    <option value="111">215</option>
    <option value="112">225</option>
    <option value="113">235</option>
    <option value="114">245</option>
    <option value="115">255</option>
    <option value="116">265</option>
    <option value="117">275</option>
    <option value="118">285</option>
    <option value="119">295</option>
    <option value="120">305</option>
    <option value="121">315</option>
    <option value="122">325</option>
    <option value="123">335</option>
    <option value="124">345</option>
    <option value="125">355</option>
  </select>
</label>

<label>
  Высота
  <select name="height" id="optionstHeightTyres">
    <option value="">Все</option>
    <option value="248">8.5</option>
    <option value="249">9.5</option>
    <option value="250">10.5</option>
    <option value="251">11.5</option>
    <option value="252">12.5</option>
    <option value="253">13.5</option>
    <option value="141">25</option>
    <option value="142">30</option>
    <option value="143">35</option>
    <option value="144">40</option>
    <option value="145">45</option>
    <option value="146">50</option>
    <option value="147">55</option>
    <option value="148">60</option>
    <option value="149">65</option>
    <option value="150">70</option>
    <option value="151">75</option>
    <option value="152">80</option>
    <option value="153">85</option>
  </select>
</label>

<label>
  Диаметр
  <select name="diameter" id="optionstDiametrTyres">
    <option value="">Все</option>
    <option value="126">R12</option>
    <option value="243">R12C</option>
    <option value="127">R13</option>
    <option value="244">R13C</option>
    <option value="128">R14</option>
    <option value="129">R14C</option>
    <option value="130">R15</option>
    <option value="131">R15C</option>
    <option value="132">R16</option>
    <option value="133">R16C</option>
    <option value="134">R17</option>
    <option value="231">R17C</option>
    <option value="135">R18</option>
    <option value="245">R18C</option>
    <option value="136">R19</option>
    <option value="246">R19C</option>
    <option value="137">R20</option>
    <option value="247">R20C</option>
    <option value="138">R21</option>
    <option value="139">R22</option>
    <option value="254">R22.5</option>
    <option value="140">R23</option>
  </select>
</label>

<div id="categories_code"><?=$_GET['categories_code']?></div>
<div id="res_categories_code">
<?php
$s = 0; $w = 0; $ws = 0;
foreach ($res as $item){

  if(($item['id_seeson'] == 156 and $w == 0) OR ($item['id_seeson'] == 155 and $s == 0) OR ($item['id_seeson'] == 157 and $ws == 0)){
    switch ($item['id_seeson']){
      case 155: $s = 1; break;
      case 156: $w = 1; break;
      case 157: $ws = 1; break;
    }
    echo "<h1>".$item['seeson_name']."</h1>";
  }

  echo $item['name']."<br>";
}

?>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
  $('#optionstWidthTyres').on('change', function () {
    var wi = $("#optionstWidthTyres").val();
    var hei = $("#optionstHeightTyres").val();
    var dia = $("#optionstDiametrTyres").val();
    var categories_code = $("#categories_code").html();
    console.log(wi+' '+hei+' '+dia);

    $.ajax({
      type: "POST",
      url: "/inc/miniFilterCatList.inc.php",
      dataType: "json",
      data: {wi : wi, hei: hei, dia: dia, categories_code: categories_code},
      success: function (msg) {
        //console.log(msg.sql);
        console.log(msg.arr);
        $('#res_categories_code').html(msg.txt);
      },
      error: function (msg) {
        console.log(msg);
      }
    });

  });
  $('#optionstHeightTyres').on('change', function () {
    var wi = $("#optionstWidthTyres").val();
    var hei = $("#optionstHeightTyres").val();
    var dia = $("#optionstDiametrTyres").val();
    var categories_code = $("#categories_code").html();
    console.log(wi+' '+hei+' '+dia);

    $.ajax({
      type: "POST",
      url: "/inc/miniFilterCatList.inc.php",
      dataType: "json",
      data: {wi : wi, hei: hei, dia: dia, categories_code: categories_code},
      success: function (msg) {
        //console.log(msg.sql);
        console.log(msg.arr);
        $('#res_categories_code').html(msg.txt);
      },
      error: function (msg) {
        console.log(msg);
      }
    });
  });
  $('#optionstDiametrTyres').on('change', function () {
    var wi = $("#optionstWidthTyres").val();
    var hei = $("#optionstHeightTyres").val();
    var dia = $("#optionstDiametrTyres").val();
    var categories_code = $("#categories_code").html();
    console.log(wi+' '+hei+' '+dia);

    $.ajax({
      type: "POST",
      url: "/inc/miniFilterCatList.inc.php",
      dataType: "json",
      data: {wi : wi, hei: hei, dia: dia, categories_code: categories_code},
      success: function (msg) {
        //console.log(msg.sql);
        console.log(msg.arr);
        $('#res_categories_code').html(msg.txt);
      },
      error: function (msg) {
        console.log(msg);
      }
    });
  });
</script>