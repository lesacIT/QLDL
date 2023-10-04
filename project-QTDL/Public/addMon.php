<?php
    require_once '../connectData.php';
    use QTDL\PROJECT\controlMon;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm môn</title>
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
    <?php require_once '../Compoinent/header.php'?>
    <?php
    $makhoa= isset($_REQUEST['makhoa']) ?
    filter_var($_REQUEST['makhoa']) : -1;
    $errors = [];
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $controlMon = new controlMon($PDO);
        $Mon = $controlMon->fillMon($_POST);
        if($Mon->validate()){
            $Mon->saveMon()&&redirect(BASE_URL_PATH .'index.php');
        }
        $errors = $Mon->getValidationErrors();
    }
    ?>
    <form action="" method="post">
        <table>
            <tr>
                <td>
                    <label for="makhoa">Mã khoa</label>
                </td>
                <td>
                    <input type="text" name="makhoa" id="makhoa" value="<?=$makhoa?>">
                </td>  
                <td>
                    <?php if (isset($errors['makhoa'])) : ?>
                        <span class="help-block">
                            <strong><?= htmlspecialchars($errors['makhoa']) ?></strong>
                        </span>
                        <?php endif ?>
                </td> 
            </tr>
            <tr>
                <td>
                    <label for="mamon">Mã môn</label>
                </td>
                <td>
                    <input type="text" name="mamon" id="mamon">
                </td>
                <td>
                    <?php if (isset($errors['mamon'])) : ?>
                        <span class="help-block">
                            <strong><?= htmlspecialchars($errors['mamon']) ?></strong>
                        </span>
                        <?php endif ?>
                </td> 
            </tr>
            <tr>
                <td>
                    <label for="tenmon">Tên môn:</label>
                </td>
                <td>
                    <input type="text" name="tenmon" id="tenmon">
                </td>
                <td>
                    <?php if (isset($errors['tenmon'])) : ?>
                        <span class="help-block">
                            <strong><?= htmlspecialchars($errors['tenmon']) ?></strong>
                        </span>
                        <?php endif ?>
                </td> 
            </tr>
        </table>
            <button type="submit">Thêm</button>
    </form>
    <script >console.log("<?=$Mon->validate()?>")</script>
</body>
</html>