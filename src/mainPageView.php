<?php

class mainPageView {
      
    
    public function newsDisplay (int $bubbleButtonsSect, int $bubbleButtonNum, array $groupFirstLevel, array $groupSecondLevel, string $adressPrefix, string $postfix): void {

echo '

<!DOCTYPE html>
<html>
<head>
<script type="text/javascript">
window.onbeforeunload = function() {
    sessionStorage.setItem("scrollPosition", window.scrollY.toString());
};
// After refreshing the page, set the scroll position
window.onload = function() {
    if(sessionStorage.getItem("scrollPosition") !== null) {
      window.scrollTo(0, parseInt(sessionStorage.getItem("scrollPosition")));
    }
};
</script>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<link href="/src/mainPageView.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="container">
<div class="top_panel">
<div class="logo"> 
    <object data="/src/Vector.svg"></object>
</div> <div> <a>ГАЛАКТИЧЕСКИЙ </br> ВЕСТНИК</a> </div>

</div>

<!-- <div class="maintext">
  <h2> Book room </h2>
  <p> some content</p>
</div> -->


<div class="last_news">
  <div><h1>' . $groupSecondLevel[0][0][0]['title'] . '</h1><p>'  .  $groupSecondLevel[0][0][0]['announce'] . '</div>
</div>
<div class="news_label">
<h1>Новости</h1>
</div>


<div class="news_list">

';
$i = 0;

/* generate 4 news panel */

foreach($groupSecondLevel[$bubbleButtonsSect][$bubbleButtonNum] as $newsSection) {
	
echo '
<div class="news_content">
<a href="' . $adressPrefix . 'group=' . $bubbleButtonsSect . '&newseg=' . $bubbleButtonNum .$postfix . (string) $newsSection['id']  . '" class="news_content_button_link">
<div class="data">' . $newsSection['date'] . '</div>
<div class="news_content_level_II">
<div class="news_title"><h3>' . $newsSection['title'] . '</h3></div>
<div class="news_content_level_III"><p>' . $newsSection['announce'] . '</p></div>
 
</div>
<div class="open_news_button"><div class="open_news_button_textcontent">ПОДРОБНЕЕ </div><div class="arrow_form">&#8594</div></div>
</a>
</div>

';
	$i++;
};









echo '

</div>




<div class="switch_line">

<div class="news_switch_section"> ';


/* enerate switch news lower bar buttons*/

/*generate next/previous button*/

if ($bubbleButtonsSect > 0) {
		echo '<a href="' . $adressPrefix . 'group='. (string)($bubbleButtonsSect - 1) .'&newseg=0" class="next_previous_button_link"><div class="next_previous_button">&#8592</div></a>';
	};

	$segIndex = 0;


for($x = $bubbleButtonsSect*3; $x < $bubbleButtonsSect*3 + count($groupSecondLevel[$bubbleButtonsSect]); $x++) {
	
	
	$buttonText = $x+1;
	
/* Generates links*/	
	
    if ((int) $buttonText == 3*$bubbleButtonsSect + $bubbleButtonNum + 1) {
    echo '<a href="' . $adressPrefix .'group='. $bubbleButtonsSect .'&newseg=' .        $segIndex . '" class = "bubbleButtonHypLink"><div    class="next_previous_button_selected"><div   class="bubbleButtonText">' . $buttonText . '</div></div></a>';
} else { echo '<a href="' . $adressPrefix . 'group='. $bubbleButtonsSect .'&newseg='. $segIndex . '" class = "bubbleButtonHypLink"><div class="news_switch_section_switch_I"><div class="bubbleButtonText">'. $buttonText .'</div></div></a>';
};
    

    $segIndex++;
	
};


/*generate next/previous button*/

if ($bubbleButtonsSect == 0) {
		echo '<a href="' . $adressPrefix . 'group='. (string)($bubbleButtonsSect + 1) .'&newseg=0" class="next_previous_button_link"><div class="next_previous_button"> &#8594 </div></a>';
} elseif  ($bubbleButtonsSect > 0 and $bubbleButtonsSect < count($groupSecondLevel)-1) {
		echo '<a href="' . $adressPrefix . 'group='. (string)($bubbleButtonsSect + 1) .'&newseg=0" class="next_previous_button_link><div class="next_previous_button"> &#8594 </div></a>';
	};




echo '
</div>

</div> 
';





echo '
<div class="footer_line"></div>
<div>
<footer class = "footer_content">
<div>
  <p>&copy 2023-2412 <q>Галактический вестник</q></p>
</div>
</footer>

</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
        $(document).ready(function() {
            $(".last_news").css("backgroundImage", "url(/src/images/' . $groupSecondLevel[0][0][0]['image'] . ')");
        });
</script>




</body>
</html>
';








}


}

