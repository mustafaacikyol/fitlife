<?php
    function matchTrainerWithClient(){
        global $conn;
        $trainer_info = $conn->prepare("select t.id, t.name, t.surname, t.birthdate, t.gender, t.email, t.phone_number, t.state, e.profession from trainer as t inner join trainer_expertise as te on t.id=te.trainer_id inner join expertise as e on te.expertise_id=e.id order by t.id");
        $trainer_info->execute();
        
        while($trainer_results = $trainer_info->fetch(PDO::FETCH_ASSOC)){
            $client_info = $conn->prepare("select c.id, c.name, c.surname, c.birthdate, c.gender, c.email, c.phone_number, c.state, e.profession from client as c inner join client_target as ct on c.id=ct.client_id inner join expertise as e on ct.target_id=e.id order by c.id");
            $client_info->execute();
            $counter = 0;
            while($client_results = $client_info->fetch(PDO::FETCH_ASSOC)){
                echo $client_results["name"];
            }

        }
    }
    

    

    

    


?>
