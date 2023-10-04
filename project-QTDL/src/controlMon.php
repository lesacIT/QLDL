<?php
namespace QTDL\PROJECT;
class controlMon{

// khai báo
    private $db;
    public $mamon;
    public $tenmon;
    public $makhoa;
    public $errors = [];

// khai báo

    public function __construct($pdo)
	    {
    		$this->db = $pdo;
	    }
        public function getValidationErrors()
	    {
		    return $this->errors;
	    }
        public function validate(){
            if(!$this->mamon){
                $this->errors['mamon']='Mã môn không được trống.';
            }
            if(!$this->makhoa){
                $this->errors['makhoa']='Mã khoa không được trống.';
            }
            if(!$this->tenmon){
                $this->errors['tenmon']='Tên môn thi không được trống.';
            }
            return empty($this->errors);
            }
        public function fillMon(array $Data){
            if(isset($Data['tenmon'])){
                $this->tenmon = trim($Data['tenmon']);
            }
            if(isset($Data['makhoa'])){
                $this->makhoa = trim($Data['makhoa']);
            }
            if(isset($Data['mamon'])){
                $this->mamon = trim($Data['mamon']);
            }
            return $this;
        }
    public function getIdMon(){
        return $this->mamon;
    }
    public function getMon(){
        $allMon = [];
        $statement = $this->db->prepare('select * from mon');
        $statement->execute();
        while($row = $statement->fetch()){
            $mon = new controlMon($this->db);
            $mon->fillFromMon($row);
            $allMon[] =$mon;
        }
        return $allMon;
    }
    public function getMonTheoKhoa($khoa){
        $allMon = [];
        $statement = $this->db->prepare('select * from mon where makhoa like :khoa');
        $statement->execute(array('khoa'=>$khoa));
        while($row = $statement->fetch()){
            $mon = new controlMon($this->db);
            $mon->fillFromMon($row);
            $allMon[] =$mon;
        }
        return $allMon;
    }
    protected function fillFromMon(array $row)
	{
		[
			'mamon' => $this->mamon,
			'tenmon' => $this->tenmon,
			'makhoa' => $this->makhoa
		] = $row;
		return $this;
	}
    public function saveMon(){
        $result = false;
            $statement = $this->db->prepare(
                'insert into mon values(:mamon,:tenmon,:makhoa);'
            );
            $result = $statement->execute([
                'mamon' => $this->mamon,
			    'tenmon' => $this->tenmon,
			    'makhoa' => $this->makhoa
            ]);
        return $result;
    }
}