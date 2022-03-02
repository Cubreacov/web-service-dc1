<html>
<head>
<title>BTS  Web Service Demo</title>
<style>
      body {font-family:georgia;}

  .albums{
    border:1px solid #E77DC2;
    border-radius: 5px;
    padding: 5px;
    margin-bottom:5px;
    position:relative;   
  }
 
  .pic{
    position:absolute;
    right:10px;
    top:10px;
  }
  .pic{
    max-width:80px;
  }

</style>
<script src="https://code.jquery.com/jquery-latest.js" type="text/javascript"></script>

<script type="text/javascript">

 function btsTemplate(albums){
  return `<div class = "albums">
    <b> Album: </b> ${albums.Album} <br />
    <b> Title: </b>  ${albums.Title} <br />
    <b> Year: </b>  ${albums.Year} <br />
    <b> Language: </b>  ${albums.Language} <br />
    <b> Length: </b>  ${albums.Length} <br />
    <b> Genre: </b>  ${albums.Genre} <br />
    <b> Producers: </b>  ${albums.Producers} <br />
     <div class = "pic"> <img src ="thumbnails/${albums.Image}"/></div>

  </div>`;
}


$(document).ready(function() { 
 
 $('.category').click(function(e){
   e.preventDefault(); //stop default action of the link
   cat = $(this).attr("href");  //get category from URL
  
   
   var request = $.ajax({
     url: "api.php?cat=" + cat,
     method: "GET",
     dataType: "json"
   });
   request.done(function( data ) {
     console.log(data);
      //place the title on the page
     $("#albums").html(data.albums);
     //clear previous films
     $("#albums").html("");
      //load each film via template into div
     $.each(data.albums, function(key, value){
       let str = btsTemplate(value);
       $("<div></div>").html(str).appendTo("#albums");
      });

     });

     
     
    
   
  request.fail(function(xhr, status, error) {
               //Ajax request failed.
             var errorMessage = xhr.status + ': ' + xhr.statusText
             alert('Error - ' + errorMessage);
          });
  });
  });
  

  
</script>
</head>
	<body>
	<h1>BTS Albums Web Service</h1>
		<a href="year" class="category">BTS Albums By Year</a><br />
		<a href="length" class="category">BTS Albums By Length</a>
		<h3 id="albumstitle">Title Will Go Here</h3>
		<div id="albums">
			<p>Albums will go here</p>
		</div>

		<div id="output">Results go here</div>

    
	</body>
</html>