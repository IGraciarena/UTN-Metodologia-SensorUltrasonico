<?php require_once  "Config/Config.php"; ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="welcome.php">ARDUINO</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        
        <ul  class="mx-auto navbar-nav ml-auto">
            <li style="margin-left:200px;" class="nav-item">
            <?php if( isset($_SESSION['loggedUser'])){ ?>
                 <form action="processSearch.php" method="POST" class="form-inline">
                    <!-- SEARCH BY DATE STARTS HERE -->
                        <div class="btn-group mr-1" role="group" aria-label="Second group"> 
                            <input type="date" name="searchDate">
                        </div>
                        <button class="btn btn-outline-success my-2 my-sm-0 mr-2" type="submit"><i class="fas fa-search"></i> Buscar</button>
                    </form>
           
                    <!-- SEARCH BY DATE ENDS HERE -->
            </li>
            
           
            
        </ul>
        <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <div class="btn-group" role="group" aria-label="Fifth group">
                        
                        <a class="btn btn-danger" href="logout.php"  onclick="clicked(event)"><i class="fas fa-door-open"></i> </i> Logout</a>
                       
                    </div>

            </li>
            </ul>
            <?php } ?>
    </div>
</nav>