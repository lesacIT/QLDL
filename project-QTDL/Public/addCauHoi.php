<?php
    require_once '../connectData.php';
    require_once '../src/checkErrors.php';
    require_once '../src/functionAddQuest.php';
    use QTDL\PROJECT\controlDeThi;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm câu hỏi</title>
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
    $maDT= isset($_REQUEST['maDT']) ?
    filter_var($_REQUEST['maDT']) : -1;
    $Dethi=$controlDeThi->getDeThiMaDeThi($maDT);
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $errors=checkErrors($_POST);
        if(empty($errors)){
           functionAddQuest($PDO,$_POST,$maDT)&&redirect(BASE_URL_PATH . 'Test.php?maDT='.$Dethi->maDT.'&tenDT='.$Dethi->tenDT );
       }
    } 
    ?>
    <form action="" method='post'>
        <label for="ndCauHoi">nhập nội dung câu hỏi:</label>
        <textarea name="ndCauHoi" id="ndCauHoi" cols="180" rows="10"></textarea>
        <?php if(isset($errors['ndCauHoi'])):?>
            <span><strong><?=htmlspecialchars($errors['ndCauHoi'])?></strong></span><br>
        <?php endif?>
        <label for="ndTraLoi1">nhập câu trả lời</label>
        <input type="text" name='ndTraLoi1' id='ndTraLoi1'>
        <label for="TL1">check nếu câu trả lời là đúng</label>
        <input type="radio" name='dapan' id='TL1' value="1"><br>
        <?php if(isset($errors['ndTraLoi1'])):?>
            <span><strong><?=htmlspecialchars($errors['ndTraLoi1'])?></strong></span><br>
        <?php endif?>
        <label for="ndTraLoi2">nhập câu trả lời</label>
        <input type="text" name='ndTraLoi2' id='ndTraLoi2'>
        <label for="TL2">check nếu câu trả lời là đúng</label>
        <input type="radio" name='dapan' id='TL2' value="2"><br>
        <?php if(isset($errors['ndTraLoi2'])):?>
            <span><strong><?=htmlspecialchars($errors['ndTraLoi2'])?></strong></span><br>
        <?php endif?>
        <label for="ndTraLoi3">nhập câu trả lời</label>
        <input type="text" name='ndTraLoi3' id='ndTraLoi3'>
        <label for="TL3">check nếu câu trả lời là đúng</label>
        <input type="radio" name='dapan' id='TL3' value="3"><br>
        <?php if(isset($errors['ndTraLoi3'])):?>
            <span><strong><?=htmlspecialchars($errors['ndTraLoi3'])?></strong></span><br>
        <?php endif?>
        <label for="ndTraLoi4">nhập câu trả lời</label>
        <input type="text" name='ndTraLoi4' id='ndTraLoi4'>
        <label for="TL4">check nếu câu trả lời là đúng</label>
        <input type="radio" name='dapan' id='TL4' value="4"><br>
        <?php if(isset($errors['ndTraLoi4'])):?>
            <span><strong><?=htmlspecialchars($errors['ndTraLoi4'])?></strong></span><br>
        <?php endif?>
        <button type='submit'>thêm</button>
    </form>
    <script>console.log('<?=$_POST['dapan']?>')</script>
</body>
</html>