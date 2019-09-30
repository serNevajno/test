<div class="modal fade" id="modalKladr" tabindex="-1" role="dialog" aria-hidden="true" style="top:20px;">
  <div class="modal-dialog" style="margin: unset; width: unset; ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
      </div>
      <div class="modal-body">
        <script>
          var pec_goods = [],
            pec_informer_size = "horizontal", // тип информера
            pec_from = "-455", // город отправки
            pec_to = "auto", // город доставки
            pec_insurance = "", // сумма для страхования
            pec_packing = ""; // тип упаковки
          pec_goods[0] = "0/0/0/<?=$_GET['scope']?>/<?=$_GET['weight']?>"; // габариты, объем, вес
        </script>
        <script src="https://pecom.ru/business/developers/js_informer/get_informer.js" charset="utf-8"></script>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>