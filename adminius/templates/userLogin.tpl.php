<!-- BEGIN USER LOGIN DROPDOWN -->
<?$login = selectWhatUserLogin()["login"]?>
<li class="dropdown user">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
	<span class="username">
		<?=$login?>
	</span>
	<i class="fa fa-angle-down"></i>
	</a>
	<ul class="dropdown-menu">
		<?if($access["admin"] == 1){?>
			<li>
				<a href="/adminius/index.php?code=adminUser"><i class="fa fa-user"></i> Администраторы</a>
			</li>
		<?}?>
    <?if(sLastUserAdmin(selectIdUserAdminSession()) > 0){?>
      <li>
        <a onclick="endWorkTime();" style="cursor: pointer;"><i class="fa fa-clock-o"></i> Завершить рабочий день</a>
      </li>
    <?}?>
		<li>
			<a onclick="logout()" style="cursor: pointer;"><i class="fa fa-key"></i> Выйти</a>
		</li>
	</ul>
</li>
<!-- END USER LOGIN DROPDOWN -->