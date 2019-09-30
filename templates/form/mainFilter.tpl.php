<!-- Search option-->
<div <?if(!$_GET["categories_code"]) echo 'class="search-2" style="margin-top:30px;"';?>>
    <div <?if(!$_GET["categories_code"]) echo 'class="container"';?>>
        <input type="hidden" id="categoriesCode" value="<?=$_GET["categories_code"]?>">
        <ul class="nav nav-tabs ht-tabs" role="tablist">
            <?if($_GET["categories_code"] == "tyres" OR !$_GET["categories_code"]){?>
                <li role="presentation" class="active pull-left">
                    <a href="#tire" aria-controls="tire" role="tab" data-toggle="tab" id="loadTyresForm">
                        <span class="tire-img"></span>
                        Подбор Шин
                    </a>
                </li>
            <?}?>
            <?if($_GET["categories_code"] == "disk" OR !$_GET["categories_code"]){?>
                <li role="presentation" class="<?if($_GET["categories_code"] == "disk") echo "active ";?>pull-left">
                    <a href="#wheels" aria-controls="wheels" role="tab" data-toggle="tab" id="loadDiskForm">
                        <span class="disk-img"></span>
                        Подбор Дисков
                    </a>
                </li>
            <?}?>
            <li role="presentation" class="pull-left">
                <a href="#filterAuto" aria-controls="auto" role="tab" data-toggle="tab" id="loadAutoForm">
                    <span class="auto-img"></span>
                    Подбор по авто
                </a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">

            <!-- Tab panes item -->
            <?if($_GET["categories_code"] == "tyres" OR !$_GET["categories_code"]){?>
                <div role="tabpanel" class="tab-pane active" id="tire">
                    <div class="search-option p-lg-30 p-b-lg-15 p-b-sm-30" style="padding-top:5px !important;">
                        <div class="row">
                            <?include($_SERVER['DOCUMENT_ROOT'].'/templates/form/filterTyres.tpl.php');?>
                        </div>
                    </div>
                </div>
            <?}?>
            <?if($_GET["categories_code"] == "disk" OR !$_GET["categories_code"]){?>
                <div role="tabpanel" class="tab-pane<?if($_GET["categories_code"] == "disk") echo " active";?>" id="wheels">
                    <div class="search-option p-lg-30 p-b-lg-15 p-b-sm-30" style="padding-top:5px !important;">
                        <div class="row">
                            <?include($_SERVER['DOCUMENT_ROOT'].'/templates/form/filterDisk.tpl.php');?>
                        </div>
                    </div>
                </div>
            <?}?>
            <div role="tabpanel" class="tab-pane" id="filterAuto">
                <div class="search-option p-lg-30 p-b-lg-15 p-b-sm-30" style="padding-top:5px !important;">
                    <div class="row">
                        <?include($_SERVER['DOCUMENT_ROOT'].'/templates/form/filterAuto.tpl.php');?>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>