<form class="form-horizontal" role="form" method="post">
  <input type="hidden" name="func" value="providerExtraCharge">
  <div class="form-body">
    <?foreach (selectProvider() as $item){?>
      <div class="form-group">
        <input type="hidden" value="<?=$item['id']?>" name="id[]">
        <label class="col-md-1"><b><?=$item['name']?></b></label>
        <div class="col-md-1">
          <input type="text" name="extra_charge[]" class="form-control" placeholder="Введите процент" value="<?=$item['extra_charge']?>">
        </div>
        <div class="col-md-1">руб.</div>
      </div>
    <?}?>
  </div>
  <div class="form-actions fluid">
    <div class="col-md-offset-3 col-md-9">
      <button type="submit" class="btn green">Сохронить</button>
    </div>
  </div>
</form>

<script>
  var anc = window.location.hash.replace("#","");
  if (anc == "true") {
    alert("Данные успешно сохранены");
    //$('#responsive').modal('show');
  }else if(anc == "false"){
    alert("Данные не сохранены");
  }
</script>
<!-- Modal -->
<!--<div id="responsive" class="modal fade" tabindex="-1" data-width="760">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">Данные успешно сохранены</h4>
  </div>
</div>-->