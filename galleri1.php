<?php
        /*here attach database file */
  include "database.php";

?>

<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/stylesheet.css">
<link rel="stylesheet" href="css/stylsheetgalleri.css">


<body>
<?php include("view/header.php") ?>

          <br><br>
          <h2 style="text-align:center";>Galleri</h2>
          <br><hr>

                <!-- control the number of image using radio butiion -->

          <div>
            <form action="" method="get">
              <input type="radio" name="option" value="2"> 2
              <input type="radio" name="option" value="4"> 4
              <input type="radio" name="option" value="8"> 8
              <input type="radio" name="option" value="0"> All
              <input type="submit" name="submit" value="Show">
            </form>
          </div>



   <br><hr>


</h2>

             <!-- control show image number (using php code)  -->

    <?php
          if ($_GET['submit']) {
             $option = $_GET['option'];


             if ($option>0) {
                $sql = "SELECT * FROM roads limit 0,".$option;

             }else{
                $sql = "SELECT * FROM roads";
             }

          }else{
            $sql = "SELECT * FROM roads";
          }

         $result = $db->query($sql);    // query is executing here....

    ?>




    <div class="row">


                <!--  showing image id form Database  -->

      <?php
        while ($row = $result->fetchArray(SQLITE3_ASSOC)){
          echo '<div class="column">
                   <img src="galleriimg/i ('.$row['id'].').jpg" style="width:100%" onclick="openModal();currentSlide('.$row['id'].')" class="hover-shadow cursor">
               </div> ';


         }
      ?>

    </div>




    <div id="myModal" class="modal">
      <span class="close cursor" onclick="closeModal()">&times;</span>
      <div class="modal-content">

                                  <!-- onclick window image is showin here  -->
        <?php
            while ($row = $result->fetchArray(SQLITE3_ASSOC)){

              echo '<div class="mySlides">
                    <div class="numbertext">'.$row['id'].' / 4</div>
                  <center> <img src="galleriimg/i ('.$row['id'].').jpg" style="width:400px; height: 300px;" ></center>
                </div>';
           }
        ?>



        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>

        <div class="caption-container">
          <p id="caption"></p>
        </div>

                          <!--  here image is showing under slider  -->

        <?php
            while ($row = $result->fetchArray(SQLITE3_ASSOC)){

              echo '<div class="column">

                   <img class="demo cursor" src="imggalleri/i ('.$row['id'].').jpg" style="width:100%" onclick="currentSlide(1)" alt="'.$row['id'].'">
                </div>';
           }
        ?>


      </div>
    </div>

    <script>
    function openModal() {
      document.getElementById("myModal").style.display = "block";
    }

    function closeModal() {
      document.getElementById("myModal").style.display = "none";
    }

    var slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
      showSlides(slideIndex += n);
    }

    function currentSlide(n) {
      showSlides(slideIndex = n);
    }

    function showSlides(n) {
      var i;
      var slides = document.getElementsByClassName("mySlides");
      var dots = document.getElementsByClassName("demo");
      var captionText = document.getElementById("caption");
      if (n > slides.length) {slideIndex = 1}
      if (n < 1) {slideIndex = slides.length}
      for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";
      }
      for (i = 0; i < dots.length; i++) {
          dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex-1].style.display = "block";
      dots[slideIndex-1].className += " active";
      captionText.innerHTML = dots[slideIndex-1].alt;
    }
    </script>

</body>
</html>
