<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
  include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/function.inc.php');

  $id = clearData($_POST['id'], "i");
  $arr = array();

  $arr['modal'] = '
    <div id="modalOrder" class="modal fade in" tabindex="-1" aria-hidden="true" style="width: 800px; margin-left:-350px;">
    <div class="modal-dialog" style="margin: unset; width: unset; ">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        </div>
        <div class="modal-body">
        <script>
          $("#m").load("https://dobrayashina.ru/adminius/index.php?code=orders&action=edit&id='.$id.' #modalFrameOrder");
        </script>
        <div id="m"></div>
          <!--<iframe src="https://dobrayashina.ru/adminius/index.php?code=orders&action=edit&id='.$id.'#modalFrameOrder" scrolling="yes" frameborder="no" width="100%" style="min-height: 350px;" align="center">
            Ваш браузер не поддерживает плавающие фреймы!
          </iframe>-->
        </div>
      </div>
    </div>
    </div>
  ';

  echo json_encode($arr);
}