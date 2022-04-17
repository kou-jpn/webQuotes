

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>test</title>
    <link rel="stylesheet" href="./homepage.css" />
</head>
<body>
    <div>Search Quotes</div>
    <p>単語数を指定して名言を検索しましょう！</p>
    <form action="" method="POST">
        <label>Keyword：</label>
        <input type="text" name="word" />　<input type="submit" value="Search" />
        <p>最小単語数:<input type="number" name="min" id="min" value="1"></p>
        <p>最大単語数:<input type="number" name="max" id="max" value="100"></p>

    </form>
    <?php
    $dsn = 'mysql:host=localhost;dbname=quotes';
    $username = 'root';
    $password = '';
   if ($_POST) {
        try {
            $dbh = new PDO($dsn, $username, $password);
            $search_word = $_POST['word'];
            if($search_word==""){
              echo "ERR:Please input search word";
            }
            else{
                $minC= $_POST['min'];
                $maxC= $_POST['max'];
                $sql ="select * from motivation where quote like '".$search_word."%'";
                $sth = $dbh->prepare($sql);
                $sth->execute();
                $result = $sth->fetchAll();
                if($result){
                    foreach ($result as $row) {
                        $cnt=str_word_count($row['quote']);
                        if($minC<=$cnt && $maxC>=$cnt){
                        //echo $minC;
                        //echo $maxC;
                        
                        echo $row['quote'];
                        echo ' by '. $row['name']." ";
                        echo '単語数'.'(' . $cnt .')';
                        
                        echo "<br />";
                        }
                    }
                }
                else{
                    echo "not found";
                }


            }
        }catch (PDOException $e) {
            echo  "<p>Failed : " . $e->getMessage()."</p>";
            exit();
        }
    }
    ?>

    <ul>
    <?php foreach($result as $row): ?>
        <li>
            
        </li>
    <?php endforeach; ?>
    </ul>
 


</html>