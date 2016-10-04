<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Tempat Pengumpulan Tugas</title>

    <!-- Bootstrap -->
    <link href="<?=$url?>css/bootstrap.min.css" rel="stylesheet">

  </head>
  <body>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Tempat Pengumpulan Tugas</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-left">
            <li class="active"><a href="<?=$url?>">Upload</a></li>
            <li><a href="<?=$url?>lihat">Lihat</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Kelas <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="<?=$url?>lihat/X1">X1</a></li>
                <li><a href="<?=$url?>lihat/X2">X2</a></li>
                <li><a href="<?=$url?>lihat/X3">X3</a></li>
                <li><a href="<?=$url?>lihat/X4">X4</a></li>
                <li><a href="<?=$url?>lihat/X5">X5</a></li>
                <li><a href="<?=$url?>lihat/X6">X6</a></li>
                <li><a href="<?=$url?>lihat/X7">X7</a></li>
                <li><a href="<?=$url?>lihat/X8">X8</a></li>
                <li><a href="<?=$url?>lihat/X9">X9</a></li>
                <li><a href="<?=$url?>lihat/X10">X10</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="<?=$url?>lihat/XIA1">XIA1</a></li>
                <li><a href="<?=$url?>lihat/XIA2">XIA2</a></li>
                <li><a href="<?=$url?>lihat/XIA3">XIA3</a></li>
                <li><a href="<?=$url?>lihat/XIA4">XIA4</a></li>
                <li><a href="<?=$url?>lihat/XIS1">XIS1</a></li>
                <li><a href="<?=$url?>lihat/XIS2">XIS2</a></li>
                <li><a href="<?=$url?>lihat/XIS3">XIS3</a></li>
                <li><a href="<?=$url?>lihat/XIS4">XIS4</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="<?=$url?>lihat/XIIA1">XIIA1</a></li>
                <li><a href="<?=$url?>lihat/XIIA2">XIIA2</a></li>
                <li><a href="<?=$url?>lihat/XIIA3">XIIA3</a></li>
                <li><a href="<?=$url?>lihat/XIIA4">XIIA4</a></li>
                <li><a href="<?=$url?>lihat/XIIS1">XIIS1</a></li>
                <li><a href="<?=$url?>lihat/XIIS2">XIIS2</a></li>
                <li><a href="<?=$url?>lihat/XIIS3">XIIS3</a></li>
                <li><a href="<?=$url?>lihat/XIIS4">XIIS4</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-offset-4 col-md-4">
          <?=$flash_messages?>
        </div>
      </div>
      <div class="row">
        <div class="col-md-offset-4 col-md-4">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Form pengumpulan tugas</h3>
            </div>
            <div class="panel-body">
              <form class="form" method="post" action="<?=$url?>uploading" enctype="multipart/form-data">
                <div class="form-group">
                  <label>Nama 1 </label>
                  <input type="text" required="true" name="nama_1" class="form-control" placeholder="Masukkan Nama">
                </div>
                <div class="form-group">
                  <label>Nama 2 </label>
                  <input type="text" name="nama_2" class="form-control" placeholder="Masukkan Nama">
                </div>
                <div class="form-group">
                  <label>Kelas </label>
                  <select class="form-control" name="kelas">
                    <option value="X1">X1</option>
                    <option value="X2">X2</option>
                    <option value="X3">X3</option>
                    <option value="X4">X4</option>
                    <option value="X5">X5</option>
                    <option value="X6">X6</option>
                    <option value="X7">X7</option>
                    <option value="X8">X8</option>
                    <option value="X9">X9</option>
                    <option value="X10">X10</option>
                    <option disabled>──────────</option>
                    <option value="XIA1">XIA1</option>
                    <option value="XIA2">XIA2</option>
                    <option value="XIA3">XIA3</option>
                    <option value="XIA4">XIA4</option>
                    <option value="XIS1">XIS1</option>
                    <option value="XIS2">XIS2</option>
                    <option value="XIS3">XIS3</option>
                    <option value="XIS4">XIS4</option>
                    <option disabled>──────────</option>
                    <option value="XIIA1">XIIA1</option>
                    <option value="XIIA2">XIIA2</option>
                    <option value="XIIA3">XIIA3</option>
                    <option value="XIIA4">XIIA4</option>
                    <option value="XIIS1">XIIS1</option>
                    <option value="XIIS2">XIIS2</option>
                    <option value="XIIS3">XIIS3</option>
                    <option value="XIIS4">XIIS4</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>File input</label>
                  <input type="file" required="true" name="file_upload">
                </div>
                <button formenctype="multipart/form-data" type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
            <div class="panel-footer"> &nbsp </div>
          </div>
        </div>
      </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?=$url?>js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?=$url?>js/bootstrap.min.js"></script>
  </body>
</html>
