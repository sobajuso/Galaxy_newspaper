<?php

class showNewsView {

     public function displayParticularNews(int $prevGroup, int $prevButton, string $newsID,string $prefix, string $postfix, $particulNews): void {
echo '
        <!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<link href="/src/styleNewsView.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="container">
  <div class="top_panel">
    <div class="logo"> 
        <object data="/src/Vector.svg"></object>
    </div> 
    <div> 
        <a>ГАЛАКТИЧЕСКИЙ </br> ВЕСТНИК</a> 
    </div>
  </div>
  <div class = "header_line"></div>


  <div class = "path_style"> 
        <div class = "path_style_text_part_1"> <a href="' . $prefix . '" class = "path_style_link"> <div class="test_path">Главная /&nbsp </div> </a> </div>
        <div class = "path_style_text_part_2"> ' . $particulNews['title'] . '</div>
  </div>
  
  <div>

    <div class="title_style"> 
        <div class="title_style_content">
            '. $particulNews['title'] . '
        </div>
    </div>

    <div class="date">' . $particulNews['date'] . '</div>



    <div class="news_text">
      <div class="news_text_with_pict">




        <div class="news_text_frame"><div class="announce"> ' . $particulNews['announce'] . '</div><br>
          <div class="content">' . $particulNews['content'] . '</div>
        </div>
        <div class="image_news"> <img src="/src/images/' . $particulNews['image'] . '" class="image_style" ></div>
      </div>
    </div>


  </div>

  <div class="news_content_level_II">
    
    <a href="' . $prefix . 'group=' . $prevGroup .  '&newseg=' . $prevButton . '" class="button_link_style">
      <div class="open_news_button">
        <div class="arrow_form">&#8592</div>
        <div class="open_news_button_textcontent"> НАЗАД К НОВОСТЯМ </div>
      </div>
    </a>
    <div class = "footer_line"></div>
  </div>




  <footer class="footer_style">
    <p>&copy 2023-2412 <q>Галактический вестник</q></p>
  </footer>
</div>
</body>
</html>
';



}


}
