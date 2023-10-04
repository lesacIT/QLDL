<?php require_once '../connectData.php';
    use QTDL\PROJECT\controlUser;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
		integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
		integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
		</script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
		</script>
    <title>Đăng Ký</title>
</head>
<body>
    <?php require_once '../Compoinent/header.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $errors = [];
       $User = new controlUser($PDO);
       $User->fillUser($_POST);
       if($User->validate()){
           $User->saveUser()&&redirect(BASE_URL_PATH . 'login.php' );
       }
       $errors = $User->getValidationErrors();
    } 
    ?>
    <div>Đăng ký</div>
    <form action="" method='post'>
    <table>
        <tr>
            <td>
                <label for="taikhoan">Họ và tên:</label> 
            </td>
            <td>
                <input type="text" name='hoten' id='hoten'>
            </td>
            <td>
                <?php if (isset($errors['hotem'])) : ?>
                    <span class="help-block">
                        <strong><?= htmlspecialchars($errors['hoten']) ?></strong>
                    </span>
                    <?php endif ?>
                </td>
        </tr>
        <tr>
            <td>
                <label for="taikhoan">Tài Khoản:</label> 
            </td>
            <td>
                <input type="text" name='taikhoan' id='taikhoan'>
            </td>
            <td>
                    <?php if (isset($errors['taikhoan'])) : ?>
                        <span class="help-block">
                            <strong><?= htmlspecialchars($errors['taikhoan']) ?></strong>
                        </span>
                        <?php endif ?>
                </td>
        </tr>
        <tr>
            <td>
                <label for="matkhau">Mật Khẩu:</label>
            </td>
            <td>
                <input type="password" name='matkhau' id='matkhau' autocomplete="on">
            </td>
            <td>
                    <?php if (isset($errors['matkhau'])) : ?>
                        <span class="help-block">
                            <strong><?= htmlspecialchars($errors['matkhau']) ?></strong>
                        </span>
                        <?php endif ?>
                </td>
        </tr>
    </table>
    <button type='submit'>Đăng ký</button>
    </form>
    <script>console.log("<?=$_POST['taikhoan']?>")</script>
</body>
</html>