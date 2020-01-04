<?php  
/*
用户类

*/

class Act{
	private $uid;
	private $uname;
	private $upwd;
	private $utime;
	private $ustatus;
	private $uemail;
	
	public function __construct($uid,$uname,$upwd,$utime,$ustatus,$uemail)
    {
        $this->uid = $uid;
        $this->uname=$uname;
		$this->upwd = $upwd;
		$this->utime = $utime;
		$this->ustatus = $ustatus;
		$this->uemail = $uemail;
    }
	
	public function getUid()
    {
        return $this->uid;
    }
	
	public function getUname()
    {
        return $this->uname;
    }
	
	public function getUpwd()
    {
        return $this->upwd ;
    }
	
	public function getUtime()
    {
        return $this->utime;
    }
	
	public function getUstatus()
    {
        return $this->ustatus;
    }
	
	public function getUemail()
    {
        return $this->uemail;
    }
	
	public function getAll()
    {
		$user = array(
			"uid" => $this->uid,
			"uname" => $this->uname,
			"upwd" => $this->upwd,
			"utime" => $this->utime,
			"ustatus" => $this->ustatus,
			"uemail" => $this->uemail,
		);
        return $user;
    }
}
?>