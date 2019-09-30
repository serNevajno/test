<form id="msform">
    <!-- progressbar -->
    <ul id="progressbar">
        <li class="active">x </li>
        <li> x</li>
        <li> x</li>
        <?if(!$session){?><li>Personal Details</li><?}?>
    </ul>
    <!-- fieldsets -->
    <?if(!$session){?>
        <fieldset>
            <h2 class="fs-title" style="margin: 0;">Вход</h2>
            <div class="col-md-12 col-lg-12">
                <div class="p-lg-30 p-xs-15 bg-gray-f5 bg1-gray-15">

                        <p class="m-b-lg-15">Войдите используя существующий аккаунт!</p>
                        <div id="error_active"></div>
                        <div id="error_login"></div>
                        <div class="form-group">
                            <span id="error_email" style="color:#cb1010;font-weight: 900;"></span>
                            <input id="email" type="email" class="form-control form-item" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <span id="error_pass" style="color:#cb1010;font-weight: 900;"></span>
                            <input id="password" type="password" class="form-control form-item" placeholder="Пароль" required>
                        </div>
                </div>
            </div>

                <?/*<a onClick="loginUserCheckout()" class="ht-btn ht-btn-default" style="width:100%; text-align: center;cursor:pointer;">Войти</a>*/?>
             <input type="button" onClick="loginUserCheckout()" class="action-button" value="Войти"/>
            <input type="button" name="next" data-step="0" class="next action-button" value="Продолжить без регистрации"/>
        </fieldset>
    <?}?>
    <fieldset>
        <h2 class="fs-title" style="margin: 0;">ШАГ 1 </h2>
        <div class="alert alert-danger" id="step1" style="display: none;">
            <strong>Ошибка!</strong> Заполните все обязательные поля.
        </div>
        <?include_once $_SERVER['DOCUMENT_ROOT']."/templates/form/1step.tpl.php";?>
        <input type="button" name="next" data-step="1" class="next action-button" value="Далее"/>
    </fieldset>
    <fieldset>
        <h2 class="fs-title">ШАГ 2</h2>
        <div class="alert alert-danger" id="step2" style="display: none;">
            <strong>Ошибка!</strong> Заполните все обязательные поля.
        </div>
        <?include_once $_SERVER['DOCUMENT_ROOT']."/templates/form/2step.tpl.php";?>
        <input type="button" name="previous" class="previous action-button" value="Назад" />
        <input type="button" name="next" data-step="2" class="next action-button" value="Далее" />
    </fieldset>
    <fieldset>
        <h2 class="fs-title">ШАГ 3</h2>
        <div class="alert alert-danger" id="step3" style="display: none;">
            <strong>Ошибка!</strong> Заполните все обязательные поля.
        </div>
        <?include_once $_SERVER['DOCUMENT_ROOT']."/templates/form/3step.tpl.php";?>
        <input type="button" name="previous" class="previous action-button" value="Назад" />
        <input type="submit" name="submit" class="submit action-button" value="Оформить" />
    </fieldset>
</form>