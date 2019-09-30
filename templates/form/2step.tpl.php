<style>
    /* Базовый контейнер табов */
    .tabs {
        min-width: 320px;
        max-width: 800px;
        padding: 0px;
        margin: 0 auto;
    }
    /* стили секций с содержанием */
    .sectionClass {
        display: none;
        padding: 15px;
        background: #fff;
        border: 1px solid #ddd;
    }
    .tabs input {
        display: none;
    }
    /* стили вкладок (табов) */
    .tabs label {
        display: inline-block;
        margin: 0 0 -1px;
        padding: 15px 25px;
        font-weight: 600;
        text-align: center;
        color: #aaa;
        border: 1px solid #ddd;
        background: #f1f1f1;
        border-radius: 3px 3px 0 0;
    }
    /* шрифт-иконки от Font Awesome в формате Unicode */
    .tabs label:before {
        font-family: fontawesome;
        font-weight: normal;
        margin-right: 10px;
    }

    /* изменения стиля заголовков вкладок при наведении */
    .tabs label:hover {
        color: #888;
        cursor: pointer;
    }
    /* стили для активной вкладки */
    .tabs input:checked + label {
        color: #555;
        border: 1px solid #ddd;
        border-top: 2px solid #cb1010;
        border-bottom: 1px solid #fff;
        background: #fff;
    }
    /* активация секций с помощью переключателя :checked */
    #tab1:checked ~ #content1,
    #tab2:checked ~ #content2,
    #tab3:checked ~ #content3,
    #tab4:checked ~ #content4 {
        display: block;
    }
    #idIclass {
        display: none;
    }
    /* медиа запросы для различных типов носителей */
    @media screen and (max-width: 680px) {
        .tabs label {
            font-size: 0;
        }

        .tabs label:before {
            margin: 0;
            font-size: 18px;
        }
        #idIclass {
            font-size: 15px;
            display: block;
        }
    }
    @media screen and (max-width: 400px) {
        .tabs label {
            padding: 15px;
        }
        #idIclass {
            font-size: 15px;
            display: block;
        }
    }
    input.form-control{
        display:block !important;
    }
</style>
<div class="tabs" style="text-align: left !important;">
    <input id="tab1" type="radio" name="tabs" value="1" checked>
    <label for="tab1" title="ФИЗИЧЕСКОЕ ЛИЦО"><i class="fa fa-user" id="idIclass"></i> ФИЗИЧЕСКОЕ ЛИЦО</label>

    <input id="tab2" type="radio" name="tabs" value="2">
    <label for="tab2" title="ИП"><i class="fa fa-user" id="idIclass"></i> ИП</label>

    <input id="tab3" type="radio" name="tabs" value="3">
    <label for="tab3" title="ЮРИДИЧЕСКОЕ ЛИЦО"><i class="fa fa-users" id="idIclass"></i> ЮРИДИЧЕСКОЕ ЛИЦО</label>

    <section id="content1" class="sectionClass">
        <div class="row">
            <div class="col-md-12 form-group">
                <div class="col-md-3">
                    <span style="margin-right: 10px;">Фамилия<span style="color: #cb1010">*</span> :</span>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control form-item" id="famFIZ" placeholder="например Иванов" style="display:block" required>
                </div>
            </div>
            <div class="col-md-12 form-group">
                <div class="col-md-3">
                    <span style="margin-right: 10px;">Имя<span style="color: #cb1010">*</span> :</span>
                </div>
                <div class="col-md-9">
                    <input type="text" id="nameFIZ" class="form-control form-item" placeholder="например Сергей" style="display:block;" required>
                </div>
            </div>
            <div class="col-md-12 form-group">
                <div class="col-md-3">
                    <span style="margin-right: 10px;">Отчество<span style="color: #cb1010">*</span> :</span>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control form-item" id="midNameFIZ" placeholder="например Алексеевич" style="display: unset;" required>
                    <span style="margin-left: 10px;color: #c1c6ce;">
            <input type="checkbox" value="1" id="check0" style="display: unset; width: unset;" class="inputCheckBox">
            Отчество не указано в паспорте
          </span>
                </div>
            </div>
            <div class="col-md-12 form-group">
                <div class="col-md-3">
                    <span style="margin-right: 10px;">Телефон<span style="color: #cb1010">*</span> :</span>
                </div>
                <div class="col-md-9">
                    <div id="phoneFIZ">
                        <div style="margin: 10px 0;">
                            <input type="text" class="form-control form-item" id="phone" name="phoneFiz" placeholder="например 9124545322" style="display: unset;">
                        </div>
                    </div>
                    <div id="newPhone"> </div>
                    <textarea class="form-control form-item" style="display: none;" id="commPhoneFiz" placeholder="комментарий к телефону"></textarea>
                    <?/*<div style="margin-top: 5px;">
                        <a class="btn btn-default" onclick="clonePhoneInput()" style="cursor: pointer;">Добавить еще один телефон</a>
                        <a onclick="viewCommPhone()" style="cursor: pointer;float: right; border-bottom: dashed;color: #c1c6ce;"> добавить комментарий к телефону</a>
                    </div>*/?>
                </div>
            </div>

            <div class="col-md-12 form-group">
                <div class="col-md-3">
                    <span style="margin-right: 10px;">Email<span style="color: #cb1010">*</span> :</span>
                </div>
                <div class="col-md-9">
                    <input type="email" class="form-control form-item" id="emailFiz" placeholder="например mail@mail.ru" style="display: unset;" required>
                </div>
            </div>

            <div class="col-md-12 form-group">
                <div class="col-md-3">
                </div>
                <div class="col-md-9">
                    <div style="font-size: 14px;">
                        <input type="checkbox" value="1" id="infoFiz" style="display: unset; width: unset;" class="inputCheckBox">
                        Я хочу получать новости и информацию о новинках, распродажах и акциях на свой Email
                    </div>
                </div>
            </div>

            <div class="col-md-12 form-group">
                <div class="col-md-3">
                    <span style="margin-right: 10px;">Примечание:</span>
                </div>
                <div class="col-md-9">
                    <textarea class="form-control form-item" id="commentsFiz" placeholder="начните писать своё примечание к заказу, если оно есть"></textarea>
                </div>
            </div>
            <div class="col-md-12 form-group">
                <div class="col-md-3">
                </div>
                <div class="col-md-9">
                    <div style="font-size: 14px;">
                        <input type="checkbox" value="1" id="polKonf" style="display: unset; width: unset;" class="inputCheckBox">
                        я согласен на обработку <a href="/politika-konfidentsialnosti.html" target="_blank" style="text-decoration: underline;">персональных данных</a><span style="color: #cb1010;">*</span>
                    </div>
                    <div style="margin-top: 10px;">
                        <span style="color: #cb1010;">*</span> - обязательны для заполнения
                    </div>
                </div>
            </div>

        </div>
    </section>
    <section id="content2" class="sectionClass">
        <div class="row">
            <div class="col-md-12 form-group">
                <div class="col-md-3">
                    <span style="margin-right: 10px;">Название ИП<span style="color: #cb1010">*</span> :</span>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control form-item" id="nameIP" placeholder="например - ИП Иванов Сергей Алексеевич" style="display: unset;" required>
                </div>
            </div>
            <div class="col-md-12 form-group">
                <div class="col-md-3">
                    <span style="margin-right: 10px;">ИНН<span style="color: #cb1010">*</span> :</span>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control form-item" id="inn" placeholder="например - 165037811710" style="display: unset;" required>
                </div>
            </div>
            <div class="col-md-12 form-group">
                <div class="col-md-3">
                    <span style="margin-right: 10px;">Юр адрес<span style="color: #cb1010">*</span> :</span>
                </div>
                <div class="col-md-9">
                    <textarea type="text" class="form-control form-item" id="addressIP" placeholder="например - 423815, Республика Татарстан, г.Набережные Челнны, пр.Московский, д 138, кв 171 " style="display: unset;" required></textarea>
                </div>
            </div>

            <div class="col-md-12 form-group">
                <div class="col-md-3">
                    <span style="margin-right: 10px;">Контактное лицо<span style="color: #cb1010">*</span> :</span>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control form-item" id="nameContact" placeholder="например - Иванов Сергей Алексеевич" style="display: unset;" required>
                </div>
            </div>

            <div class="col-md-12 form-group">
                <div class="col-md-3">
                    <span style="margin-right: 10px;">Телефон<span style="color: #cb1010">*</span> :</span>
                </div>
                <div class="col-md-9">
                    <div id="phoneIP">
                        <div style="margin: 10px 0;">
                            <input type="text" class="form-control form-item" id="phoneIPmask" name="phoneIP" placeholder="например 9124545322" style="display: unset;" required>
                        </div>
                    </div>
                    <div id="newPhoneIP"> </div>
                    <textarea class="form-control form-item" style="display: none;" id="commPhoneIP" placeholder="комментарий к телефону"></textarea>
                    <?/*<div style="margin-top: 5px;">
                        <a class="btn btn-default" onclick="clonePhoneInputIP()" style="cursor: pointer;">Добавить еще один телефон</a>
                        <a onclick="viewCommPhoneIP()" style="cursor: pointer;float: right; border-bottom: dashed;color: #c1c6ce;"> добавить комментарий к телефону</a>
                    </div>*/?>
                </div>
            </div>

            <div class="col-md-12 form-group">
                <div class="col-md-3">
                    <span style="margin-right: 10px;">Email<span style="color: #cb1010">*</span> :</span>
                </div>
                <div class="col-md-9">
                    <input type="email" class="form-control form-item" id="emailIP" placeholder="например mail@mail.ru" style="display: unset;" required>
                </div>
            </div>

            <div class="col-md-12 form-group">
                <div class="col-md-3">
                </div>
                <div class="col-md-9">
                    <div style="font-size: 14px;">
                        <input type="checkbox" value="1" id="infoIP" style="display: unset;width: unset;" class="inputCheckBox">
                        Я хочу получать новости и информацию о новинках, распродажах и акциях на свой Email
                    </div>
                </div>
            </div>

            <div class="col-md-12 form-group">
                <div class="col-md-3">
                    <span style="margin-right: 10px;">Примечание:</span>
                </div>
                <div class="col-md-9">
                    <textarea class="form-control form-item" id="commentsIP" placeholder="начните писать своё примечание к заказу, если оно есть"></textarea>
                </div>
            </div>
            <div class="col-md-12 form-group">
                <div class="col-md-3">
                </div>
                <div class="col-md-9">
                    <div style="font-size: 14px;">
                        <input type="checkbox" value="1" id="polKonf" style="display: unset; width: unset;" class="inputCheckBox">
                        я согласен на обработку <a href="/politika-konfidentsialnosti.html" target="_blank" style="text-decoration: underline;">персональных данных</a><span style="color: #cb1010;">*</span>
                    </div>
                    <div style="margin-top: 10px;">
                        <span style="color: #cb1010;">*</span> - обязательны для заполнения
                    </div>
                </div>
            </div>

        </div>
    </section>
    <section id="content3" class="sectionClass">
        <div class="row">
            <div class="col-md-12 form-group">
                <div class="col-md-3">
                    <span style="margin-right: 10px;">Название юр.лица<span style="color: #cb1010">*</span> :</span>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control form-item" id="nameUR" placeholder="например - ООО 'ЭГО174'" style="display: unset;" required>
                </div>
            </div>
            <div class="col-md-12 form-group">
                <div class="col-md-3">
                    <span style="margin-right: 10px;">ИНН<span style="color: #cb1010">*</span> :</span>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control form-item" id="innUR" placeholder="например - 7451376873" style="display: unset;" required>
                </div>
            </div>
            <div class="col-md-12 form-group">
                <div class="col-md-3">
                    <span style="margin-right: 10px;">КПП<span style="color: #cb1010">*</span> :</span>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control form-item" id="kpp" placeholder="например - 745101001" style="display: unset;" required>
                </div>
            </div>
            <div class="col-md-12 form-group">
                <div class="col-md-3">
                    <span style="margin-right: 10px;">Юр адрес<span style="color: #cb1010">*</span> :</span>
                </div>
                <div class="col-md-9">
                    <textarea type="text" class="form-control form-item" id="addressUR" placeholder="например - 454091, г.Челябинск, ул.Тимирязева, д 29, кв 7 " style="display: unset;" required></textarea>
                </div>
            </div>

            <div class="col-md-12 form-group">
                <div class="col-md-3">
                    <span style="margin-right: 10px;">Контактное лицо<span style="color: #cb1010">*</span> :</span>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control form-item" id="nameContactUR" placeholder="например - Иванов Сергей Алексеевич" style="display: unset;" required>
                </div>
            </div>

            <div class="col-md-12 form-group">
                <div class="col-md-3">
                    <span style="margin-right: 10px;">Телефон<span style="color: #cb1010">*</span> :</span>
                </div>
                <div class="col-md-9">
                    <div id="phoneYR">
                        <div style="margin: 10px 0;">
                            <input type="text" class="form-control form-item" id="phoneUR" name="phoneUR" placeholder="например 9124545322" style="display: unset;" required>
                        </div>
                    </div>
                    <div id="newPhoneYR"> </div>
                    <textarea class="form-control form-item" style="display: none;" id="commPhoneYR" placeholder="комментарий к телефону"></textarea>
                    <?/*<div style="margin-top: 5px;">
                        <a class="btn btn-default" onclick="clonePhoneInputYR()" style="cursor: pointer;">Добавить еще один телефон</a>
                        <a onclick="viewCommPhoneYR()" style="cursor: pointer;float: right; border-bottom: dashed;color: #c1c6ce;"> добавить комментарий к телефону</a>
                    </div>*/?>
                </div>
            </div>

            <div class="col-md-12 form-group">
                <div class="col-md-3">
                    <span style="margin-right: 10px;">Email<span style="color: #cb1010">*</span> :</span>
                </div>
                <div class="col-md-9">
                    <input type="email" class="form-control form-item" id="emailUR" placeholder="например mail@mail.ru" style="display: unset;" required>
                </div>
            </div>

            <div class="col-md-12 form-group">
                <div class="col-md-3">
                </div>
                <div class="col-md-9">
                    <div style="font-size: 14px;">
                        <input type="checkbox" value="1" id="infoUR" style="display: unset;width: unset;" class="inputCheckBox">
                        Я хочу получать новости и информацию о новинках, распродажах и акциях на свой Email
                    </div>
                </div>
            </div>

            <div class="col-md-12 form-group">
                <div class="col-md-3">
                    <span style="margin-right: 10px;">Примечание:</span>
                </div>
                <div class="col-md-9">
                    <textarea class="form-control form-item" id="commentsUR" placeholder="начните писать своё примечание к заказу, если оно есть"></textarea>
                </div>
            </div>
            <div class="col-md-12 form-group">
                <div class="col-md-3">
                </div>
                <div class="col-md-9">
                    <div style="font-size: 14px;">
                        <input type="checkbox" value="1" id="polKonf" style="display: unset; width: unset;" class="inputCheckBox">
                        я согласен на обработку <a href="/politika-konfidentsialnosti.html" target="_blank" style="text-decoration: underline;">персональных данных</a><span style="color: #cb1010;">*</span>
                    </div>
                    <div style="margin-top: 10px;">
                        <span style="color: #cb1010;">*</span> - обязательны для заполнения
                    </div>
                </div>
            </div>

        </div> 
    </section>
</div>