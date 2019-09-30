<?php
function selectAllOffice($page, $num, $search){
  global $posts;
  global $start;
  $search = clearData($search);
  if ($search != "") {
    $query_search .= ' WHERE `address` LIKE "%'.$search.'%"';
  }
  $posts = selectCount("slider $query_search");
  $start = strNav($page, $num, $posts);

  return db2array("SELECT id, address, phone, email, time_work FROM office_contact $query_search ORDER BY id DESC LIMIT $start, $num", 2);
}

function selectOffice($id) {
  return db2array("SELECT address, phone, email, time_work, maps, region, summ_delivery, img FROM office_contact WHERE id='$id'");
}