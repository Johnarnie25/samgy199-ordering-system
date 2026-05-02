<?php 
	session_start();
	require "admin/includes/functions.php";
	require "admin/includes/db.php";
	if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];
    
    }else{
        header("Location: index.php");
        exit();
    }
	
?>
<!Doctype html>

<html lang="en">

<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<meta name="description" content="" />

<meta name="keywords" content="" />

<head>
	
<title>SAMGYHAN 199 - GALLERY</title>

<link rel="stylesheet" href="css/main.css" />

<link rel="stylesheet" href="css/lightbox.min.css" />

<script src="js/jquery.min.js" ></script>

<script src="js/myscript.js"></script>
	
</head>

<body>
	
<?php require "includes/header.php"; ?>

<div class="parallax" onclick="remove_class()">
	
	<div class="parallax_head">
		
		<h2>Our</h2>
		<h3>Gallery</h3>
		
	</div>
	
</div>

<div class="content" onclick="remove_class()">
	
	<div class="inner_content on_parallax">
		
		<h2><span class="fresh">Valued Customers</span></h2>
		
		<div class="parallax_content">
			
			<div class="multicol">
				
				<div class="image_display">
				
					<a href="image/Gallery/1.jpg" data-lightbox="image-1"><img src="image/Gallery/1.jpg" alt="image/Gallery/1.jpg" width="100%" /></a>
					
				</div>
				
				<div class="image_display">
					
				<a href="image/Gallery/2.jpg" data-lightbox="image-1"><img src="image/Gallery/2.jpg" alt="image/Gallery/2.jpg" width="100%" /></a>
					
				</div>
				
				<div class="image_display">
					
					<a href="image/Gallery/3.jpg" data-lightbox="image-1"><img src="image/Gallery/3.jpg" alt="image/Gallery/3.jpg" width="100%" /></a>
					
				</div>
				
				<div class="image_display">
					
				<a href="image/Gallery/4.jpg" data-lightbox="image-1"><img src="image/Gallery/4.jpg" alt="image/Gallery/4.jpg" width="100%" /></a>
					
				</div>
				
				<div class="image_display">
					
				<a href="image/Gallery/5.jpg" data-lightbox="image-1"><img src="image/Gallery/5.jpg" alt="image/Gallery/5.jpg" width="100%" /></a>
					
				</div>
                    
                <div class="image_display">
					
				<a href="image/Gallery/6.jpg" data-lightbox="image-1"><img src="image/Gallery/6.jpg" alt="image/Gallery/6.jpg" width="100%" /></a>
					
				</div>
                    
                <div class="image_display">
					
				<a href="image/Gallery/7.jpg" data-lightbox="image-1"><img src="image/Gallery/7.jpg" alt="image/Gallery/7.jpg" width="100%" /></a>
					
				</div>

				<div class="image_display">
					
				<a href="image/Gallery/8.jpg" data-lightbox="image-1"><img src="image/Gallery/8.jpg" alt="image/Gallery/8.jpg" width="100%" /></a>
					
				</div>

				<div class="image_display">
					
				<a href="image/Gallery/9.jpg" data-lightbox="image-1"><img src="image/Gallery/9.jpg" alt="image/Gallery/9.jpg" width="100%" /></a>
					
				</div>

				<div class="image_display">
					
				<a href="image/Gallery/10.jpg" data-lightbox="image-1"><img src="image/Gallery/10.jpg" alt="image/Gallery/10.jpg" width="100%" /></a>
					
				</div>

				<div class="image_display">
					
				<a href="image/Gallery/11.jpg" data-lightbox="image-1"><img src="image/Gallery/11.jpg" alt="image/Gallery/11.jpg" width="100%" /></a>
					
				</div>

				<div class="image_display">
					
				<a href="image/Gallery/12.jpg" data-lightbox="image-1"><img src="image/Gallery/12.jpg" alt="image/Gallery/12.jpg" width="100%" /></a>
					
				</div>
				
			</div>
			
			<p class="clear"></p>
			
		</div>
		
	</div>
	
</div>

<div class="footer_parallax" onclick="remove_class()">
	
	<div class="on_footer_parallax">
		
		<p>&copy; <?php echo strftime("%Y", time()); ?> <span>SAMGYHAN 199</span>. All Rights Reserved</p>
		
	</div>
	
</div>
	
</body>

</html>

<script src="js/lightbox.min.js" ></script>