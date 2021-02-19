<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Admin Panel</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#">Categories</a>
      </li>
      <li class="nav-item">
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Product Tags
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <table class="table text-center">
                <?php
                  $conn = mysqli_connect("localhost", "root", "", "newbase");
                  $tag_query = "select * from tags";
                  $result = mysqli_query($conn, $tag_query);
                  if(mysqli_num_rows($result)>0){
                    $elem = 0;
                    $numCols = 6;
                    while($row = mysqli_fetch_assoc($result)){
                      $tag_id = $row['tag_id'];
                      $tag = $row['tag'];
                      if($elem%$numCols==0) print('<tr><td><a href="#" class="nav-link">'.$tag.'</a></td>');
                      else if($elem%$numCols==$numCols-1) print('<td><a href="#" class="nav-link">'.$tag.'</a></td></tr>');
                      else print('<td><a href="#" class="nav-link">'.$tag.'</a></td>');
                      $elem++;
                    }
                  }
                  ?>
                </table>
          </div>
        </div>
      </li>
    </ul>
  </div>
</nav>
        