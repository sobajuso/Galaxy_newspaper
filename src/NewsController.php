<?php

class NewsController {


    public function __construct(private NewsGateway $gateway, private mainPageView $view, private showNewsView $newsView) {

    
    }

    /* pass data to main or particular news page depend on passed arguments */

    public function processRequest(string $method, ?int $par1, ?int $par2, ?string $prefix, ?string $postfix, ?string $newsID): void
    {
        if ($newsID){
        
            $this -> showParticularPage($par1,$par2,$newsID,$prefix,$postfix); /* fuction passing data to particular news page */
        
        } else {
        
        $this -> processCollectionRequest($method, $par1, $par2, $prefix,$postfix); /* function passing data to main page*/
        
        }
            
    }
    

    private function processCollectionRequest(string $method, int $par1, int $par2, string $prefix, string $postfix): void
      {
        switch ($method) {
                case "GET":
                    /* splitting data from datamodel to groups*/
                    $content = $this->gateway->getAll();
                    $groupFirstLevel = array_chunk($content,4);
                    $groupSecondLevel = array_chunk($groupFirstLevel,3);

                 /*check request values*/   
                 if ($par1 >= count($groupSecondLevel)) {
	
	                echo "More button groups than exist";
                    exit;
	
                 };

                 if ($par2 >= count($groupSecondLevel[$par1])) {
	
	                echo "not existing button";
                    exit;
	
                 };
                    $response = $this -> view -> newsDisplay($par1,$par2,$groupFirstLevel,$groupSecondLevel,$prefix,$postfix);

                    echo $response;
                    break;

            } 
      } 



    public function showParticularPage(int $par1, int $par2, string $newsID,string $prefix, string $postfix):void {
        $content = $this->gateway->getAll();
        $particulNews = [];
        
        /*check request values*/        

        for ($i=0; $i < count($content); $i++) {
            
            if ((string) $content[$i]['id'] == (string) $newsID) {
            
                  $particulNews =  $content[$i];     

            }
        

        };
        if ($particulNews == Null) { echo 'sorry we dont have news with such id'; exit;}
        echo $response = $this -> newsView -> displayParticularNews($par1,$par2,$newsID,$prefix,$postfix,$particulNews);
    }

}


