<?php
require_once '../connectData.php';
use QTDL\PROJECT\controlDeThi;
use QTDL\PROJECT\controlCauHoi;
use QTDL\PROJECT\controlTraLoi;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
		integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
		integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
		</script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
		</script>
</head>
<body>
<?php require_once '../Compoinent/header.php' ?>
<?php
    $maDT = isset($_REQUEST['maDT']) ?
    filter_var($_REQUEST['maDT']) : -1;
    $controlDeThi = new controlDeThi($PDO);
    $DeThi = $controlDeThi->getDeThiMaDeThi($maDT);
    $controlCauHoi = new controlCauHoi($PDO);
    $allCauHoi = $controlCauHoi->getCauHoiTheoDeThi($maDT);
    if(!empty($allCauHoi)):
?>
<div></div>

    <?php
    $demCauHoi = 1;
    foreach ($allCauHoi as $cauhoi):?>
        <div><?=htmlspecialchars($demCauHoi)?>/: <?=htmlspecialchars($cauhoi->ndCauHoi)?>:</div>
        <?php 
            $controlTraLoi = new controlTraLoi($PDO);
            $allTraLoi = $controlTraLoi->getTraLoiTheoCauHoi($cauhoi->maCH);
            foreach ($allTraLoi as $TraLoi):?>
            <?php $TraLoi->dapan==1 ? $colorDapAn = 'red' : $colorDapAn = '' ?>
            <div class="ml-4 m-1" style='color:  <?=$colorDapAn?>;'><?=htmlspecialchars($TraLoi->vitri)?>) <?=htmlspecialchars($TraLoi->ndTraLoi)?></div>
            <?php endforeach?>
            <?php $demCauHoi++?>
            <form class="delete" action="<?=BASE_URL_PATH.'deleteCauHoi.php'?>"					
		method="post" style="display: inline;">
        <input type="hidden" name="maDT"
		value="<?=$maDT?>">
        <input type="hidden" name="maCH"
		value="<?=$cauhoi->maCH?>">
            <?php if(isset($_SESSION['user_type'])&&$_SESSION['user_type']==='admin'||isset($_SESSION['user_type'])&&$_SESSION['user_type']==='teacher'):?>
            <a href="<?=BASE_URL_PATH . 'editCauHoi.php?maDT='.$cauhoi->maDT.'&maCH='.$cauhoi->maCH?>">Sửa</a>
            <button type='submit'>delete</button>
            <?php endif?>
        </form>
        <?php endforeach?>
        <script>console.log('<?=$_POST['maCH']?>')</script>
        <script>console.log('<?=$_POST['maDT']?>')</script>
    <?php else:?>
        <div>Đề Thi chưa có câu hỏi 
        <?php if(isset($_SESSION['user_type'])&&$_SESSION['user_type']==='admin'||isset($_SESSION['user_type'])&&$_SESSION['user_type']==='teacher'):?>
            <a href="<?=BASE_URL_PATH . 'addCauHoi.php?maDT=' . $DeThi->maDT ?>">thêm câu hỏi</a>
        <?php else:?>
            đợi admin thêm câu hỏi
            <?php endif?>    
        </div>
    <?php endif?>    
    <?php if(isset($_SESSION['user_type'])&&$_SESSION['user_type']==='admin'||isset($_SESSION['user_type'])&&$_SESSION['user_type']==='teacher'):?>
    <a href="<?=BASE_URL_PATH . 'addCauHoi.php?maDT=' . $DeThi->maDT ?>">thêm câu hỏi</a>
        <?php endif?>    
</body>
</html>