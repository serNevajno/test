<div id="wrap-body" class="p-t-lg-30">
	<div class="container">
		<div class="wrap-body-inner">
			<!-- Breadcrumb-->
			<?include($_SERVER['DOCUMENT_ROOT']).'/templates/breadcrumbs.tpl.php';?>
			<!-- Register -->
			<section class="block-login m-t-lg-30 m-t-xs-0 m-b-lg-50">
				<div class="">
					<div class="row">
						<div class="col-md-8 col-lg-6 col-md-offset-2 col-lg-offset-3">
							<div class="heading">
								<h3><?=$meta_item['name']?></h3>
							</div>
							<div class="p-lg-30 p-xs-15 bg-gray-f5 bg1-gray-15" id="regOk">
								<form>
									<p class="m-b-lg-15">Создание учетной записи!</p>
										<div class="form-group">
											<span id="error_email" style="color:#cb1010;font-weight: 900;"></span>
											<input id="email" type="email" class="form-control form-item" placeholder="Email" required>
										</div>
										<div class="form-group">
											<span id="error_name" style="color:#cb1010;font-weight: 900;"></span>
											<input id="name" type="text" class="form-control form-item" placeholder="Имя" required>
										</div>
										<div class="form-group">
											<span id="error_pass" style="color:#cb1010;font-weight: 900;"></span>
											<input id="password" type="password" class="form-control form-item" placeholder="Пароль" required>
										</div>
										<div class="form-group">
											<span id="error_rpass" style="color:#cb1010;font-weight: 900;"></span>
											<input id="comfirm_pass" type="password" class="form-control form-item" placeholder="Повторите пароль" required>
										</div>
										
										<a onClick="regUser()" class="ht-btn ht-btn-default" style="width:100%; text-align: center;cursor:pointer;">Регистрация</a>
								</form>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>