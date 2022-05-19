<!DOCTYPE html>
<html lang="en">
<head>
<?php  
    include('layout/header.php'); 
?>

<style>
* {box-sizing: border-box}
 
/* Slides */
.mySlides {
  display: none;
  padding: 80px;
  text-align: center;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  margin-top: -30px;
  padding: 16px;
  color: #888;
  font-weight: bold;
  font-size: 20px;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.next {
  position: absolute;
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
  color: white;
}

/* The dot/bullet/indicator container */
.dot-container {
    text-align: center;
    padding: 20px;
    background: #fff;
}

/* The dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

/* Add a background color to the active dot/circle */
.active, .dot:hover {
/*  background-color: #717171; */
}

/* Add an italic font style to all quotes */
q {font-style: italic;}

/* Add a blue color to the author */
.author {color: cornflowerblue;}

b {border-bottom: 2px solid white;}
</style>
 
</head>
<body>
<?php  
    include('layout/menu.php'); 
    
    $lang = "c";
    $proj = "";
    $dtyp = "";
    
    if(isset($_REQUEST['lang'])){
        $lang = $_REQUEST['lang'];
    }
    
    if(isset($_REQUEST['proj'])){
        $proj = $_REQUEST['proj'];
    }
    
    if(isset($_REQUEST['dtyp'])){
        $lang = $_REQUEST['dtyp'];
    }

?>
        <!-- ======= Breadcrumbs ======= -->
        <div class="breadcrumbs">
          <div class="container" >
            <h2>Secondary Skills</h2>
            	<nav  id="navbar" class="navbar order-last order-lg-0">
        			<ul>
        			<?php 
        			     $dirs = glob("secondary_skills/".$lang."/*" , GLOB_ONLYDIR);
        			     for($i = 0; $i < count($dirs); $i++)
        			     {
        			         $arr = explode("/", $dirs[$i]);
        			         $pfdl = $arr[count($arr) - 1];
        			         echo "<li><a style='color: #fff;' href='secondary_skills.php?lang=$lang&proj=$pfdl'><b>".str_replace("_", " ", $pfdl)."</b></a></li>";
        			         if(!isset($_REQUEST['proj']) && $i == 0){
            			         $proj = $arr[count($arr) - 1];
        			         }
        			     }
        			?>
          			</ul>
          		</nav>
          </div>
        </div><!-- End Breadcrumbs -->
 
  	
  	<table style="width: 100%;">
  		<tr>
  			<td style="width:250px;" valign="top">
  				<section id="why-us" class="why-us">
  			    	<div class="content">
                        <a href="secondary_skills.php?lang=c" class="more-btn">C <i class="bx bx-chevron-right"></i></a><br/>
                        <a href="secondary_skills.php?lang=cpp" class="more-btn">C++ <i class="bx bx-chevron-right"></i></a><br/>
                        <a href="secondary_skills.php?lang=java" class="more-btn">Java <i class="bx bx-chevron-right"></i></a><br/>
                        <a href="secondary_skills.php?lang=react" class="more-btn">React.js <i class="bx bx-chevron-right"></i></a><br/>
                        <a href="secondary_skills.php?lang=node" class="more-btn">Node.js <i class="bx bx-chevron-right"></i></a><br/>
                        <a href="secondary_skills.php?lang=angular" class="more-btn">Angular.js <i class="bx bx-chevron-right"></i></a><br/>
            		</div>
            	</section>
  			</td>
  			<td valign="top">
  				<div class="dot-container">
                
                 <?php
                     $dirs = glob("secondary_skills/".$lang."/".$proj."/*", GLOB_ONLYDIR);
                    
                    for($i = 0; $i < count($dirs); $i++)
                    {
                        $arr = explode("/", $dirs[$i]);
                        if(!isset($_REQUEST['dtyp']) && $i == 0){
                            $dtyp = $arr[count($arr) - 1];
                        }
                    }
 
                    $dir = "secondary_skills/".$lang."/".$proj."/".$dtyp."/";
                    $j = 0;
                    $slider = "";
                    // Open a directory, and read its contents
                    if (is_dir($dir)){
                      if ($dh = opendir($dir)){
                        while (($file = readdir($dh)) !== false){
                            if(strlen($file) > 2){
                                $j++;
                                switch($dtyp){
                                    case 'Demo_Sources' :
                                        echo "<span title='$file' class='dot' onclick='currentSlide($j)'></span>\n";
                                        $slider .= "<div class='mySlides' data-aos='zoom-in' data-aos-delay='100'>";
                                        $slider .= "<object style='width:100%; height:500px;'  data='$dir$file'></object></div>\n";
                                        break;
                                    case 'Demo' :
                                    case 'Download' :
                                        include($dir.$file);
 
                                        break;
                                }

                            }
                        }
                        closedir($dh);
                      }
                    }
                    ?> 
                </div>
    
    			<div class="slideshow-container">
    		
    				<?php echo $slider; ?> 
        
                    <a class="prev" onclick="plusSlides(-1)">❮</a>
                    <a class="next" onclick="plusSlides(1)">❯</a>
            	</div>
  			</td>
  	</table>
 
	
 
 

<script>
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
  var dots = document.getElementsByClassName("dot");
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
}

 
</script>

<?php  
    include('layout/footer.php'); 
?>
</body>

</html>