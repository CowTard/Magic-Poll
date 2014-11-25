<?php

class poll {

	private $title;
	private $options;
	private $id;
	private $numberOfVotes;

	public function __construct($id){
		$this->id = $id;
		$this->numberOfVotes = 0;
		$this->options = new array();

		$db = new PDO('sqlite:../db/polls.db');
		$dbPrepared = $db->prepare('SELECT * FROM Poll WHERE ID = ?');
		$dbPrepared->execute(array($this->id));  
  		$item = $dbPrepared->fetch();

  		if(!item) echo "FAIL";
  		else {
  			$this->numberOfVotes = $item["Votes"];
  		}

  		unset($item);
  		unset($dbPrepared);
  		unset($db);
	}

	public function getInformationFromDatabase(){
		$db = new PDO('sqlite:../db/polls.db');
		$dbPrepared = $db->prepare('SELECT * FROM Options WHERE IDPoll = ?');
		$dbPrepared->execute(array($this->id));  
  		$item = $dbPrepared->fetch();

  		foreach( $item as $row) {
  			$this->options[] = new array($row["OptionText"],$row["Votes"]);
  		}
  		
  		unset($item);
  		unset($dbPrepared);
  		unset($db);
	}
} 

?>