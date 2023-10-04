<?php
namespace QTDL\PROJECT;
class controlCauHoi{
    private $db;
    public $maCH;
    public $maDT;
    public $ndCauHoi;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }
public function getCauHoiTheoCauHoi($maCH){
    $statement = $this->db->prepare('select * from cauhoi where maCH like :maCH');
    $statement->execute(array('maCH'=>$maCH));
    if($row = $statement->fetch()){
        $this->fillFromCH($row);
    }
    return $this;
}
public function getCauHoiTheoDeThi($maDT){
    $allCauHoi = [];
    $statement = $this->db->prepare('select * from cauhoi where maDT like :maDT');
    $statement->execute(array('maDT'=>$maDT));
    while($row = $statement->fetch()){
        $CauHoi = new controlCauHoi($this->db);
        $CauHoi->fillFromCH($row);
        $allCauHoi[] =$CauHoi;
    }
    return $allCauHoi;
}
protected function fillFromCH(array $row)
{
    [
        'maCH' => $this->maCH,
        'maDT' => $this->maDT,
        'ndCauHoi'=>$this->ndCauHoi
    ] = $row;
    return $this;
}
public function  findCauHoi($maCH){
    $statement = $this->db->prepare('select * from cauhoi where maCH like :maCH');
    $statement->execute(array('maCH'=>$maCH));
    if($row = $statement->fetch()){
        $this->fillFromCH($row);
			return $this;
    }
    return null;
}
}