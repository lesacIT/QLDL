<?php
namespace QTDL\PROJECT;
class controlTraLoi{
private $db;

public $maTL;
public $maCH;
public $dapan;
public $ndTraLoi;
public $vitri;

public function __construct($pdo)
{
    $this->db = $pdo;
}

public function getTraLoiTheoCauHoi($maCH){
    $allTraLoi = [];
    $statement = $this->db->prepare('select * from traloi where maCH like :maCH');
    $statement->execute(array('maCH'=>$maCH));
    while($row = $statement->fetch()){
        $TraLoi = new controlTraLoi($this->db);
        $TraLoi->fillFromDT($row);
        $allTraLoi[] =$TraLoi;
    }
    return $allTraLoi;
}
protected function fillFromDT(array $row)
{
    [
        'maTL' => $this->maTL,
        'maCH' => $this->maCH,
        'dapan'=>$this->dapan,
        'ndTraLoi'=>$this->ndTraLoi,
        'vitri'=>$this->vitri
    ] = $row;
    return $this;
}
}