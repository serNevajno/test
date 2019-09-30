<div class="row">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Рабочий стол
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                </div>
            </div>
            <div class="portlet-body flip-scroll">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#tab_0" data-toggle="tab">Шины</a>
                    </li>
                    <li>
                        <a href="#tab_1" data-toggle="tab">Диски</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active fontawesome-demo" id="tab_0">
                        <?include $_SERVER['DOCUMENT_ROOT']."/adminius/templates/form/workplace.tpl.php"?>
                    </div>
                    <div class="tab-pane glyphicons-demo" id="tab_1">
                        <div class="row">
                            <div class="col-md-12">

                                <form method="post" action="" onsubmit="return sProdWorkPlaceDisk(this);">
                                    <div class="form-body">

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="articul_disk" placeholder="введите артикул">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="razmer_disk" placeholder="введите размерность диска">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <select class="form-control" name="brand" id="brand_disk">
                                                    <option value="">Выберите бренд</option>
                                                    <?foreach (selectDiskBrand() as $brand){?>
                                                        <option value="<?=$brand['id']?>"><?=$brand['name']?></option>
                                                    <?}?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <button  type="submit" class="btn green" onclick="sProdWorkPlaceDisk()" >Поиск</button>
                                        </div>


                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped table-condensed flip-content">
                    <thead class="flip-content">
                    <tr>
                        <th>
                            Артикул
                        </th>
                        <th>
                            Название
                        </th>
                        <th >
                            Поставщики
                        </th>
                    </tr>
                    </thead>
                    <tbody id="resSearchProductWorkPlace">

                    </tbody>
                </table>
            </div>
        </div>
        <!-- END SAMPLE TABLE PORTLET-->
        <?include $_SERVER['DOCUMENT_ROOT']."/adminius/templates/modals/newOrderWorkPlace.tpl.php"?>
    </div>

</div>