<div class="modal fade" id="modalKladr" tabindex="-1" role="dialog" aria-hidden="true" style="top:20px;">
  <input id="weight" value="" type="hidden">
  <input id="scope" value="" type="hidden">
  <div class="modal-dialog" style="margin: unset; width: unset; ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4>Расчет доставки по ПЭК: </h4>
      </div>
      <div class="modal-body" style="height: 350px;">
        <div>
          <input type="text" id="cityUser" placeholder="Пример: Челябинск" autocomplete="off" class="form-control form-item">
          <input type="hidden" id="weightModal" value="">
          <input type="hidden" id="scopeModal" value="">
          <div id="block-search-result" style="display: none; width: 90%; padding: 0 10px;">
            <ul id="result_search_city"></ul>
          </div>
          <div id="pec_to"></div>
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>