<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="document" aria-labelledby="myModalLabel">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="p-lg-30 p-xs-15 bg-gray-f5 bg1-gray-15 but_reviews">
					<p class="m-b-lg-15" style="text-align:center;">Пожалуйста, введите ваш адрес электронной почты и пароль для входа!</p>
					<form>
						<div id="errorActive"></div>
						<div id="errorLogin"></div>
						<div class="form-group">
							<input id="emailLogin" type="email" class="form-control form-item" placeholder="Email">
						</div>
						<div class="form-group">
							<input id="passwordLogin" type="password" class="form-control form-item" placeholder="Пароль">
						</div>
						<a onClick="loginUser()" class="ht-btn ht-btn-default" style="width:100%;text-align:center;cursor:pointer;">Войти</a>
						<div style="text-align: right;font-size:14px;color:#cb1010;margin: 10px 10px 0px 0;cursor:pointer;" onClick="$('.but_reviews').hide();$('.select_reviews').show();$('input, select').trigger('refresh');">Забыл пароль?</div>
					</form>
				</div>
				<div class="p-lg-30 p-xs-15 bg-gray-f5 bg1-gray-15 select_reviews" style="display:none;">
					<div id="resRecovery"></div>
					<div id="recoveryBlock">
						<p class="m-b-lg-15" style="text-align:center;">Введите ваш емейл для восстановления пароля!</p>
						<form>
							<div id="errorRecovery" style="color:#cb1010;"></div>
							<div class="form-group">
								<input id="emailRec" type="email" class="form-control form-item" placeholder="Email">
							</div>
							<a onClick="recoveryPass()" class="ht-btn ht-btn-default" style="width:100%;text-align:center;cursor:pointer;">Востановить</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>