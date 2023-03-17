<?php

interface iRadovi{
    
    public function create($data);
    public function read();
    public function save($data);
}
class diplomskiRadovi implements iRadovi{
    private $naziv_rada;
    private $tekst_rada;
    private $link_rada;
    private $oib_tvrtke;

    function __construct($oib, $text, $link, $title) {
        $this->oib_tvrtke = $oib;
        $this->tekst_rada = $text;
        $this->link_rada = $link;
        $this->naziv_rada = $title;
    }
        
    function create($data) {
        self::__construct($data);
    }
    
    function read() {
        $pdo = new PDO('mysql:dbname=radovi;host=localhost','root', '');
        $sql = "SELECT * FROM diplomski_radovi";
        $statement = $pdo->query($sql);
        $articles = $statement->fetchAll(PDO::FETCH_ASSOC);
        if (count($articles) > 0) {
            echo "<ul>";
            foreach ($articles as $article) {
                echo "<li>";
                echo $article['id'] . '<br>';
                echo $article['title'] . '<br>';
                echo $article['oib'] . '<br>';
                echo $article['texts'] . '<br>';
                echo $article['link'] . '<br><br>';
                echo "</li>";
            }
            echo "</ul>";
        } else {
            echo "No data found.";
        }
    } 

    
    public function save($data_size) {
        try {
            $allData = getAll();
            $pdo = new PDO('mysql:dbname=radovi;host=localhost','root', '');
            for($i=0; $i<$data_size; $i++){
                $id = uniqid();
                $sql = "INSERT INTO diplomski_radovi (id, title, oib, texts, link) VALUES ('{$id}' , '{$allData[$i]['title']}', '{$allData[$i]['oib']}','{$allData[$i]['text']}','{$allData[$i]['link']}')";
                $pdo->exec($sql);
            }
            unset($pdo);
        } catch (PDOException $e) {
            echo '<p>Dogodila se iznimka: ' . $e->getMessage() . '</p>';
        }
    }
}


?>