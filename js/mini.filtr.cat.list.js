$(function () {
  $('#optionstWidthTyres').on('change', function () {
    miniFilterCatList();
  });
  $('#optionstHeightTyres').on('change', function () {
    miniFilterCatList();
  });
  $('#optionstDiametrTyres').on('change', function () {
    miniFilterCatList();
  });
});

function miniFilterCatList() {
  var wi = $("#optionstWidthTyres").val();
  var hei = $("#optionstHeightTyres").val();
  var dia = $("#optionstDiametrTyres").val();
  var categories_code = $("#categories_code").val();
  //console.log(wi+' '+hei+' '+dia);

  $.ajax({
    type: "POST",
    url: "/inc/miniFilterCatList.inc.php",
    dataType: "json",
    data: {wi : wi, hei: hei, dia: dia, categories_code: categories_code},
    success: function (msg) {
      //console.log(msg.sql);
      //console.log(msg.arr);
      $('#res_categories_code').html(msg.txt);
    },
    error: function (msg) {
      console.log(msg);
    }
  });
}