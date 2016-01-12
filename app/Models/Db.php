<?php
	
	namespace Models;

	use Core\Model;

	class Db extends Model {
		protected $db;

		public function __construct(){
			parent::__construct();
		}

		public function getUser($id){
			$result = $this->db->select("SELECT * FROM klanten WHERE klant_id = '$id'");
			
			return $result;
		}

		public function pushUsers($user)
		{
			$result = $this->db->select("SELECT wachtwoord, klant_id, priviledged FROM klanten WHERE email = '$user'");
			
			return $result;
		}
		public function insertUsers($geslacht, $voorletters, $voornaam, $tussenvoegsel, $achternaam, $adres, $postcode, $woonplaats, $telefoonnummer, $mobiel, $email, $niveau, $geboortedatum, $wachtwoord, $url)
		{
			$sql = "INSERT INTO `deb67958_zeilschooldewaai`.`klanten` (`klant_id`, `geslacht`, `voorletters`, `voornaam`, `tussenvoegsel`, `achternaam`, `adres`, `postcode`, `woonplaats`, `telefoonnummer`, `mobiel`, `email`, `geboortedatum`, `niveau`, `wachtwoord`, `url`, `priviledged`) 
			VALUES (NULL, '$geslacht', '$voorletters', '$voornaam', '$tussenvoegsel', '$achternaam', '$adres', '$postcode', '$woonplaats', 'telefoonnummer', '$mobiel', '$email', '$geboortedatum', '$niveau', '$wachtwoord', '$url', '0'); ";
			$this->db->raw($sql);
		}

		public function validateUser($hash)
		{
			$result = $this->db->select("SELECT klant_id FROM klanten WHERE url = '$hash'");

			return $result;
		}

		public function givePrivilage($id)
		{
			$result = $this->db->raw("UPDATE klanten SET priviledged=1, url=NULL WHERE klant_id='$id';");
		}
		public function getAllCourses(){
			$result = $this->db->select("SELECT * FROM cursussen");
			return $result;
		}

		//Beheer controller database acties.
		public function userData($tabel){
			$result = $this->db->select("SELECT * FROM $tabel");
			
			return $result;
		}

		public function insertData($tabel, $values){
			$result = $this->db->raw("INSERT INTO $tabel VALUES ($values)");
			
			return $result;
		}

		public function updateData($tabel, $values){
			$result = $this->db->raw("UPDATE $tabel SET $values");
			
			return $result;
		}

		public function deleteData($tabel, $where){
			$result = $this->db->delete($tabel, $where);
			
			return $result;
		}
	}