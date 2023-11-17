<?php 

class user{
	

	public $idUser;
	public $loginName;
	public $mdp;

	
	function __construct($idUser,$loginName,$mdp){

		$this->idUser = $idUser;
		$this->$loginName = $loginName;
		$this->mdp = $mdp;
		
	}
}





?>