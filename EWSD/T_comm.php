<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="dist/simplePagination.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
    <script
      type="text/javascript"
      src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"
    ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="dist/jquery.simplePagination.js"></script>
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

      padding: 10;
    }
    /* #left-con {
      border-style: solid;
      border-color: red;
      border-width: 1px;
    }

    #right-con {
      border-style: solid;
      border-color: blue;
      border-width: 1px;
    } */
    /* th {
      font-size: 14px;
    }
    tr {
      font-size: 12px;
    } */
  </style>
  <body>
    <nav class="navbar navbar-inverse">
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
            <li><a href="T_dash.html">Dashboard</a></li>
            <li class="active"><a href="T_comm.html">Comment page</a></li>
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
    </nav>

    <div class="container">
     
      </div>

      <!-- <script>
        $(document).ready(function() {
          $("#example").DataTable({
            pagingType: "full_numbers"
          });
        });
      </script> -->
    </div>
  </body>
</html>
