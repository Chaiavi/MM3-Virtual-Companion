<?php
include "link.php";
?>
<!doctype html>
<html>
<head>
  <style>
	.map-responsive{
      overflow:hidden;
      padding-bottom:55%;
      position:relative;
      height:0;
	}
    
	.map-responsive iframe{
      left:0;
      top:10px;
      height:75%;
      width:100%;
      position:absolute;
	}
  </style>
  
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<title>Notes</title>
</head>

<body>
	<div id="page-wrapper" >
      <!--	map-->
      <div class="container ">
        <div class="map-responsive">
        	<iframe src="notes/" title="Maps" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
      </div>
	</div>
</body>
</html>