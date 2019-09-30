<!-- Modal -->
<div class="modal fade" id="regionModal" tabindex="-1" role="document" aria-labelledby="myModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="p-lg-30 p-xs-15 bg-gray-f5 bg1-gray-15 but_reviews" style="text-align: center;">
          <p class="m-b-lg-15" style="font-weight: 900">Вы находитесь в Уфе?</p>

          <a onclick="changeAddress(2, '<?=addslashes($sRegionUfa["address"])?>')" class="btn btn-success" >ДА</a>
          <a onclick="changeAddress(1)" class="btn btn-warning" data-dismiss="modal">НЕТ</a>
          
        </div>
      </div>
    </div>
  </div>
</div>