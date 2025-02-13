<html>
    <head>
        <link rel="stylesheet" href="./style.css">
    </head>
    <body>
        <div>

            <form method="post">
                <div id="placement1">
                    <div class="placement2">
                            <input type="text"  name="login" placeholder="login" value="<?php if (!empty ($_POST['login'])) echo $_POST['login'];?>">
                    </div>
                    <div class="placement2">
                        <input type="password" value="<?php if (!empty ($_POST['interdis'])) echo $_POST['interdis'];?>" name="interdis" placeholder="password"> 
                    </div>
               </div>
                <input type="submit" value="envoyer" class="center">
            </form>
                <?php
                    if (!empty($_POST)){   
                        echo $_POST['login'];
                        echo "<br>";
                    $hash_mdp = password_hash($_POST['interdis'], PASSWORD_DEFAULT);
                    echo $hash_mdp;
                    echo "<br>";
                    if ( password_verify($_POST['interdis'], $hash_mdp) ){
                        echo "MDP CORRECT";
                    }
                    }
                    $ide = $_POST['login'];
                    $servername = "mysql:host=127.0.0.1;dbname=login";
                    $username = "root";
                    $password = "root";
                    $PDO = new PDO($servername, $username, $password);
                    $sqlz = $PDO->prepare("INSERT INTO utilisateur (user, pass) VALUES (?,?)");
                    $sqlz->execute([$ide,$hash_mdp]);
                    $verifu = $PDO->prepare("SELECT pass From utilisateur where utilisateur.user = ? ");
                    $verifu->bindvalue(1,$ide);
                    $verifu->execute();
                    $resultat = $verifu->fetch();
                    foreach ($resultat as $result) {
                        ?>
                            <p><?php echo $resultat['pass']; ?></p>
                        <?php
                        }
 
                ?>
            </div>
    </body> 
</html>


