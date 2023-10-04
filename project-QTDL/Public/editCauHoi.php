<?php
    require_once '../connectData.php';
    require_once '../src/checkErrors.php';
    require_once '../src/functionAddQuest.php';
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
    $controlDeThi = new controlDeThi($PDO);
    $controlCauHoi = new controlCauHoi($PDO);
    $controlTraLoi = new controlTraLoi($PDO);
    $maDT= isset($_REQUEST['maDT']) ?
    filter_var($_REQUEST['maDT']) : -1;
    $maCH= isset($_REQUEST['maCH']) ?
    filter_var($_REQUEST['maCH']) : -1;
    $Dethi=$controlDeThi->getDeThiMaDeThi($maDT);
    $CauHoi=$controlCauHoi->getCauHoiTheoCauHoi($maCH);
    $allCauTL= $controlTraLoi->getTraLoiTheoCauHoi($maCH);
    $dem=1;
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $errors=checkErrors($_POST);
        if(empty($errors)){
           functionAddQuest($PDO,$_POST,$maDT)&&redirect(BASE_URL_PATH . 'Test.php?maDT='.$Dethi->maDT.'&tenDT='.$Dethi->tenDT );
       }
    } 
    ?>
    <form action="" method='post'>
        <input type="hidden" name="maCH" value="<?=$CauHoi->maCH?>">
        <label for="ndCauHoi">nhập nội dung câu hỏi:</label>
        <textarea name="ndCauHoi" id="ndCauHoi" cols="180" rows="10"><?=$CauHoi->ndCauHoi?></textarea>
        <?php if(isset($errors['ndCauHoi'])):?>
            <span><strong><?=htmlspecialchars($errors['ndCauHoi'])?></strong></span><br>
        <?php endif?>
        <?php foreach($allCauTL as $TraLoi):?>
        <input type="hidden" name="<?='maTL'.$dem?>" value="<?=$TraLoi->maTL?>">
        <label for="ndTraLoi1">nhập câu trả lời</label>
        <input type="text" name='<?='ndTraLoi'.$dem?>' id='<?='ndTraLoi'.$dem?>' value="<?=$TraLoi->ndTraLoi?>">
        <label for="<?='TL'.$dem?>">check nếu câu trả lời là đúng</label>
        <input <?php if($TraLoi->dapan==1):?> checked="checked" <?php endif?> type="radio" name='dapan' id='<?='TL'.$dem?>' value="<?=$dem?>"><br>
        <?php if(isset($errors['ndTraLoi'.$dem])):?>
            <span><strong><?=htmlspecialchars($errors['ndTraLoi'.$dem])?></strong></span><br>
        <?php endif?>
        <?php $dem++?>
        <?php endforeach?>
        <button type='submit'>thêm</button>
    </form>
    <script>console.log('<?=$_POST['dapan']?>')</script>
</body>
</html>