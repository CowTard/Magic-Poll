<!--?php echo('Hello World!'); ?-->
<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
		$search_string = preg_replace("/[^A-Za-z0-9]/", " ", $_POST['query']);


		$db = new PDO('sqlite:../db/polls.db');
		$dbPrepared = $db->prepare('SELECT * FROM Poll where Closed != 1 AND Private != 1');
		$dbPrepared->execute();
		$results = $dbPrepared->fetchAll();

		$html = '';
		foreach ($results as $row) {
			$similar = similar_text(strtoupper($search_string), strtoupper($row['Title']));
			if ( ($similar * 100) / strlen($row['Title']) > 8){
				$html .= '<li class="result">';
				$html .= '<a href="viewpoll.php?id=' . $row['EncodedID'] . '">';
				$html .= '<p >' . $row['Title'] . '</p>';
				$html .= '</a>';
				$html .= '</li>';
			}
		}
		if ($html == '') {
			$html .= '<li class="result">';
			$html .= '<a href="#">';
			$html = 'There\' s nothing to show';
			$html .= '</a>';
			$html .= '</li>';
		}
		echo $html;
	}
?>