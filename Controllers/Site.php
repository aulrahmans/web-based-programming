<?php

namespace App\Controllers;

class Site extends BaseController
{
    public function __construct()
    {
//		parent::__construct();
		$this->db = \Config\Database::connect();			
		$this->email = \Config\Services::email();

		helper('form');
    }		
    public function login()
    {
        $data = [
            "title" => "Silahkan Login",
            "nameSistem" => "SISTEM AKADEMI",
        ];
        return view('site/login', $data);
    }

 public function dashboard()
    {
		$username44=$this->request->getPost('username44');
		$katakunci=$this->request->getPost('katakunci');
		$hashPassword = hash('sha512', $katakunci);
		$respon = $this->getUserName($username44, $hashPassword);
		
		if ($respon != '') {
            echo "<h3><a href=", base_url(), "/public/site/Logout> Logout </a></h3>";
            return "Selamat Datang ".$respon ;
           
		} else {
			
			return $this->login();
//			return
         } view('menu/login');
			
    }	
    
    public function getUserName($username44, $katakunci)
	{
//d('DATA SEND ='.$email.' = '.$password);

		$query = $this->db->query("select nama_user from tbl_guru_44 where username44 = '$username44' and katakunci = '$katakunci' ");
		$row   = $query->getRow();

		return isset($row->nama_user) ? $row->nama_user : '';
	}
    public function Logout()
    {
       
        return $this -> login();
    }
}
