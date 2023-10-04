<?php
    require_once '../connectData.php';
    use QTDL\PROJECT\controlCauHoi;
    use QTDL\PROJECT\controlDeThi;
    $controlCauHoi = new controlCauHoi($PDO);
    $controlDeThi = new controlDeThi($PDO);
    if (
        $_SERVER['REQUEST_METHOD'] === 'POST'
        && isset($_POST['maDT'])
        && ($controlCauHoi->getCauHoiTheoDeThi($_POST['maDT'])) !== null
    ) {
        $allCauHoi = $controlCauHoi->getCauHoiTheoDeThi($_POST['maDT']);
        foreach ($allCauHoi as $CauHoi){
            $statement=$PDO->prepare('delete from traloi where maCH = :maCH');
            $statement->execute(array('maCH'=>$CauHoi->maCH));
        }
        $statement=$PDO->prepare('delete from dethi where maDT = :maDT');
        $statement->execute(array('maDT'=>$_POST['maDT']));
    }
    redirect(BASE_URL_PATH . 'allTest.php?makhoa='.$_POST['makhoa'].'&mamon=' . $_POST['mamon'] );