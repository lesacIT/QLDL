<?php
namespace QTDL\PROJECT;
class controlKhoa{
    private $db;
    public $makhoa;
    public $tenkhoa;
    public function __construct($pdo)
    {
        $this->db = $pdo;
    }
    public function getIdKhoa(){
        return $this->makhoa;
    }   
    public function getKhoa(){
        $allMon = [];
        $statement = $this->db->prepare('select * from khoa');
        $statement->execute();
        while($row = $statement->fetch()){
            $khoa = new controlKhoa($this->db);
            $khoa->fillFromKhoa($row);
            $allKhoa[] =$khoa;
        }
        return $allKhoa;
    }
    protected function fillFromKhoa(array $row)
	{
		[   
			'makhoa' => $this->makhoa,
			'tenKhoa' => $this->tenkhoa,
		] = $row;
		return $this;
	}
}