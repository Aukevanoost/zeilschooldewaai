<?php
	
	namespace Models;

	use Core\Model;

	class Db extends Model 
	{
		protected $db;

		public function __construct()
		{
			parent::__construct();
		}

		public function getUser($id)
		{
			$result = $this->db->select("SELECT * FROM klanten WHERE klant_id = '$id'");
			
			return $result;
		}

		public function checkEmail($email)
		{
			$result = $this->db->select("SELECT email FROM klanten WHERE email = '$email'");
			
			return $result;
		}

		public function pushUsers($user)
		{
			$result = $this->db->select("SELECT wachtwoord, klant_id, priviledged FROM klanten WHERE email = '$user'");
			
			return $result;
		}
		public function insertUsers($geslacht, $voorletters, $voornaam, $tussenvoegsel, $achternaam, $adres, $postcode, $woonplaats, $telefoonnummer, $mobiel, $email, $niveau, $geboortedatum, $wachtwoord, $url)
		{
			$sql = "INSERT INTO `zeilschooldewaai`.`klanten` (`klant_id`, `geslacht`, `voorletters`, `voornaam`, `tussenvoegsel`, `achternaam`, `adres`, `postcode`, `woonplaats`, `telefoonnummer`, `mobiel`, `email`, `geboortedatum`, `niveau`, `wachtwoord`, `url`, `priviledged`)
			VALUES (NULL, '$geslacht', '$voorletters', '$voornaam', '$tussenvoegsel', '$achternaam', '$adres', '$postcode', '$woonplaats', '$telefoonnummer', '$mobiel', '$email', '$geboortedatum', '$niveau', '$wachtwoord', '$url', '0'); ";
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

		public function getAllCourses()
		{
			$result = $this->db->select("SELECT * FROM cursussen WHERE DATE(startdatum) >= CURDATE()");
			return $result;
		}

		public function getAllCoursesOverzicht(){
			$result = $this->db->select("SELECT * FROM cursussen WHERE MONTH(startdatum) = MONTH(CURDATE())");
			return $result;			
		}

		public function updateUser($id, $geslacht, $voorletters, $voornaam, $tussenvoegsel, $achternaam, $adres, $postcode, $woonplaats, $telefoonnummer, $mobiel, $geboortedatum, $niveau)
		{
			$result = $this->db->raw("UPDATE klanten SET geslacht='$geslacht', voorletters='$voorletters', voornaam='$voornaam', tussenvoegsel='$tussenvoegsel', achternaam='$achternaam', adres='$adres', postcode='$postcode', woonplaats='$woonplaats', telefoonnummer='$telefoonnummer', mobiel='$mobiel', geboortedatum='$geboortedatum', niveau='$niveau' WHERE klant_id='$id';");		

			return $result;
		}

		public function updateUserPassword($id, $wachtwoord)
		{
			$this->db->raw("UPDATE klanten SET wachtwoord='$wachtwoord' WHERE klant_id='$id';");
		}

		public function getCursus($id)
		{
			$result = $this->db->select("SELECT * FROM cursussen WHERE cursus_id = '$id'");

			return $result;
		}

		//Beheer controller database acties.
		public function userData($tabel)
		{
			$result = $this->db->select("SELECT * FROM $tabel");
			
			return $result;
		}

		public function insertData($tabel, $values)
		{
			$result = $this->db->raw("INSERT INTO $tabel VALUES ($values)");
		}

		public function updateData($tabel, $values)
		{
			$result = $this->db->raw("UPDATE $tabel SET $values");
		}

		public function deleteData($tabel, $where)
		{
			$result = $this->db->delete($tabel, $where);
		}

		public function getAllData($sql)
		{
			$result = $this->db->select($sql);

			return $result;
		}

		public function getInschrijvingen($id)
		{
			$result = $this->db->select("SELECT * FROM cursussen INNER JOIN inschrijvingen ON cursussen.cursus_id = inschrijvingen.cursus_id WHERE inschrijvingen.klant_id = $id ORDER BY cursussen.startdatum ASC");
			
			return $result;
		}

		public function getCursusWithCustomers(){
			//SELECT COUNT(column_name) FROM table_name;
			$qry = "SELECT cursus_id, cursusnaam, startdatum, niveau, (SELECT Count(*) FROM inschrijvingen WHERE inschrijvingen.cursus_id = cursussen.cursus_id) as inschrijvingen FROM cursussen ORDER BY startdatum";
			$result = $this->db->select($qry);

			return $result;
		}

	}