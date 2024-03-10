<?php

class NewsGateway
{   

    private PDO $conn;
    /* take database connection*/
    public function __construct(Database $database)
    {
        $this -> conn = $database -> getConnection();
    }

    public function getAll(): array
    {   
        /*get information from database*/

        $sql = 'SELECT id, DATE_FORMAT(date, "%d.%m.%Y") as date,title,announce,content,image FROM news GROUP BY date DESC';

        $stmt = $this -> conn -> query($sql);

        $data = [];
        
        while ($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
            

            $data[] = $row;

        }
        
        return $data;

    }
    
}

