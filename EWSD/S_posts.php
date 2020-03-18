<?php
include "S_nav.php";
?>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="dist/jquery.simplePagination.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

  </head>
  <style>
    #top-nav a:hover {
      background-color: white;
      font-weight: bold;
      color: black;
    }

    #top-nav-r a:hover {
      background-color: white;
    }
    .container {
      border-style: solid;
      border-width: 1px;
      margin: auto;
      max-width: 50%;
      padding: 10;
    }

  </style>
  <body>
    <!-- <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <button
            type="button"
            class="navbar-toggle"
            data-toggle="collapse"
            data-target="#myNavbar"
          >
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">WebSiteName</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav" id="top-nav">
            <li><a href="S_dash.html">Dashboard</a></li>
            <li class="active"><a href="S_upload.html">Upload page</a></li>
            <li><a href="#">Page 2</a></li>
            <li><a href="#">Page 3</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right" id="top-nav-r">
            <li>
              <a style="color:dodgerblue;font-weight: bold;" href="#"
                ><span class="glyphicon glyphicon-user"></span> Profile</a
              >
            </li>
            <li>
              <a style="color:red;font-weight: bold;" href="#"
                ><span class="glyphicon glyphicon-log-in"></span> Logout</a
              >
            </li>
          </ul>
        </div>
      </div>
    </nav> -->


<div class="container">

    	<div class="row-LAC">
    	<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
  <script>
          tinymce.init({
              selector: "textarea",
              menu: {
                table: {title: 'Table', items: 'inserttable tableprops deletetable | cell row column'}
              },
              plugins: [
                  "advlist autolink lists link image charmap preview anchor",
                  "searchreplace visualblocks code fullscreen",
                  "insertdatetime media table contextmenu paste"
              ],
              toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
          });
  </script>




  <hr>

                <!-- the comment box -->
                <div class="well">
                    <h4><i class="fa fa-paper-plane-o"></i> Leave a Comment:</h4>
                    <form role="form">
                        <div class="form-group">
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" name="say" value="" class="btn btn-primary"><i class="fa fa-reply"></i> Submit</button>
                    </form>
                </div>
</script>
                <hr>

                <!-- the comments -->
                <h3><i class="fa fa-comment"></i> User One says:
                    <small> 9:41 PM on August 24, 2014</small>
                </h3>
                <p>Excellent post! Thank You the great article, it was useful!</p>

                <h3><i class="fa fa-comment"></i> User Two says:
                    <small> 9:47 PM on August 24, 2014</small>
                </h3>
                <p>Excellent post! Thank You the great article, it was useful!</p>

            </div>



	</div>

	</div>
</div>

    </div>
  </body>
</html>
