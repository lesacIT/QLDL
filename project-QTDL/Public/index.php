<?php
    require_once '../connectData.php';
    use QTDL\PROJECT\controlMon;
    use QTDL\PROJECT\controlKhoa;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đề Thi CTU</title>
    <link rel="stylesheet" href="./css/main.css">
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
    
    <div class="main">
            <?php require_once '../Compoinent/header.php' ?>
            <?php 
            $controlKhoa= new controlKhoa($PDO);
            $allKhoa = $controlKhoa->getKhoa();
            foreach($allKhoa as $khoa): ?>
                    <div class='faculty-box' onclick="HandleClick(<?= $khoa->getIdKhoa() ?>)">
                        <div class='faculty'><?= htmlspecialchars($khoa->makhoa)?> - <?=htmlspecialchars($khoa->tenkhoa)?></div>
                        <div class='m-4 subject-box' id="<?= $khoa->getIdKhoa()?>">
                            <?php
                            $controlMon= new controlMon($PDO);
                            $makhoa = $khoa->makhoa;
                            $allMon = $controlMon->getMonTheoKhoa($makhoa);
                            if(!empty($allMon)):?>
                                <?php foreach($allMon as $mon): ?>
                                    <div><a href="<?=BASE_URL_PATH . 'allTest.php?makhoa='.$makhoa.'&mamon=' . $mon->getIdMon() ?>" class='subject'><?=htmlspecialchars($mon->mamon)?> - <?=htmlspecialchars($mon->tenmon)?></a></div> 
                                    <?php endforeach?>
                                <?php else:?>
                                    <div>Khoa này chưa có môn học</div>
                                <?php endif?>
                                <?php if(isset($_SESSION['user_type'])&&$_SESSION['user_type']==='admin'):?>
                                    <a href="<?=BASE_URL_PATH . 'addMon.php?makhoa=' . $khoa->makhoa ?>">thêm câu hỏi</a>
                                <?php endif?> 
                        </div>
                    </div>
            <?php endforeach?> 
            <script>console.log('<?=$_SESSION['id']?>')</script>
        </div>
            <div class="footer">
            </div>
            <script src="./js/main.js"></script>    
</body>
</html>