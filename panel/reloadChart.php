<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$db = new PDO('sqlite:../db/polls.db');
		$dbPrepared = $db->prepare('SELECT * FROM Poll where EncodedID = ?');
		$dbPrepared->execute(array($_POST['id']));
		$teste = $dbPrepared->fetch();

		$numberOfVotes = $teste['Votes'];
		$realID = $teste['ID'];


		$db = new PDO('sqlite:../db/polls.db');
		$dbPrepared = $db->prepare('SELECT * FROM Options where IDPoll = ?');
		$dbPrepared->execute(array($realID));
		$teste = $dbPrepared->fetchAll();

		$arrTableData = array();
		array_push($arrTableData,array('Task',     'Hours per Day'));
		foreach ($teste as $row){
				$votesOfthisOption = $row['Votes'];
				if ( $numberOfVotes == 0)
					$var = array( $row['OptionText'] . ' [votes: ' . $votesOfthisOption . ']', ($row['Votes']+1 * 100) / 1 );
				else $var = array( $row['OptionText']. ' [votes: ' . $votesOfthisOption . ']', ($row['Votes'] * 100) / $numberOfVotes );
				array_push($arrTableData, $var);
			};

		echo json_encode($arrTableData);

	}
	else {

		$arrTableData = array(
        array('Error',     'Type of error'),
        array('Error',     0),
        array('Error',      1),
    	);

    	echo json_encode($arrTableData);
	    }
?>
