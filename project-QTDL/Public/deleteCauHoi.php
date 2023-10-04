
<?php
    require_once '../connectData.php';
    use QTDL\PROJECT\controlCauHoi;
    use QTDL\PROJECT\controlDeThi;
    $CauHoi = new controlCauHoi($PDO);
    $controlDeThi = new controlDeThi($PDO);
    if (
        $_SERVER['REQUEST_METHOD'] === 'POST'
        && isset($_POST['maCH'])
        && ($CauHoi->findCauHoi($_POST['maCH'])) !== null
    ) {
        $statement=$PDO->prepare('select delete_question( :maCH );');
        $statement->execute(array('maCH'=>$_POST['maCH']));
    }
    $maDT = $_POST['maDT'];
    $DeThi = $controlDeThi->getDeThiMaDeThi($maDT);
    redirect(BASE_URL_PATH . 'Test.php?maDT='.$DeThi->maDT.'&tenDT='.$DeThi->tenDT);