<?php

/* The Admin Class */


class Admin
		{
			private $firstName;
			private $lastName;
			private $userName;
			private $password;
 

			function __construct($firstName, $lastName, $userName, $password)
			{
				$this->firstName = $firstName;
				$this->lastName = $lastName;
				$this->userName = $userName;
				$this->password = $password;
			}

            public function setUserName($userName)
            {
                $this->userName = $userName;
            }

            public function setPassword($password)
            {
                $this->password = $password;
            }

			public function getFirstName()
            {
				return $this->firstName;
			}

			public function getLastName()
            {
				return $this->lastName;
			}

			public function getUserName()
            {
				return $this->userName;
			}

			public function getPassword()
            {
				return $this->password;
			}

           /* public function add_card($card_name, $card_price, $card_description, $card_rarity)
            {



            }*/
		}

?>