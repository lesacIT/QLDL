<?php session_start();?>
<div class="header bg-primary">
        <div class="navbar-nav nav navbar-expand-md ml-3">
			<a href="<?=BASE_URL_PATH . 'index.php'?>" class="nav-link mr-3 text-white">Trang chủ</a>
			<a href="<?=BASE_URL_PATH . 'allTest.php?makhoa='.'&mamon='?>" class="nav-link mr-3 text-white ">Đề Thi</a>
			<?php if(empty($_SESSION['id'])):?>
				<a href="<?=BASE_URL_PATH.'login.php'?>" class="nav-link mr-3 text-white ">Đăng nhập</a>
				<a href="<?=BASE_URL_PATH.'register.php'?>" class="nav-link mr-3 text-white ">Đăng ký</a>
				<?php elseif($_SESSION['user_type']==='admin') :?>
					<a href="<?=BASE_URL_PATH.'admin.php'?>" class="nav-link mr-3 text-white "><?=htmlspecialchars($_SESSION['hoten'])?></a>
					<a href="<?=BASE_URL_PATH.'logout.php'?>" class="nav-link mr-3 text-white ">Đăng xuất</a>
					<?php else :?>
						<a href="<?=BASE_URL_PATH.'index.php'?>" class="nav-link mr-3 text-white "><?=htmlspecialchars($_SESSION['hoten'])?></a>
						<a href="<?=BASE_URL_PATH.'logout.php'?>" class="nav-link mr-3 text-white ">Đăng xuất</a>

					<?php endif?>
			
		</div>
</div>