<script type="text/javascript" src="http://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
<script src="./qrcode.js"></script>
<?php
//开启一个会话
session_start();

require_once '../../connectvars.php';
?>

<?php

session_start();

echo "<script>";
echo "var str = '1|" . $_SESSION['InvoiceNum'] . "|" . $_SESSION['PurchaserName'] . "|" .$_SESSION['SellerName'] . "|" . $_SESSION['AmountInFiguers']
	. "|" . $_SESSION['InvoiceDate'] . "|" . $_SESSION['InvoiceCode'] . "|" . $_SESSION['SellerAddress'] . "|" . $_SESSION['SellerRegisterNum'] ."';";
echo "</script>";

?>

<html lang="zh">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../css/bootstrap/favicon.ico">

    <title>二维码生成</title>

    <!-- Bootstrap core CSS -->
    <link href="../../css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <!-- <link href="./css/dashboard.css" rel="stylesheet"> -->
  </head>

  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand" href="../../features.php">
        <img class="rounded-circle" src="../../img/home.jpeg"  width="25" height="25">
        Home
      </a>
      <!-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> -->
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="../../userState.php">
            <img class="rounded-circle" src="../../img/login.ico"  width="25" height="25">
          </a>
        </li>
     </ul>
    </nav>

    

    <div class="container-fluid">
          <div class="text-center">
            <h2>二维码生成</h2>
			<input class="form-control" type="text" id="newtext"/><br />

      <center>
        <div id="qrcodeshow"></div>
      </center>

			<input class="btn btn-primary btn-lg btn-block" type="button" id="make" value="创建" style="display:none"/>
			<input class="btn btn-primary btn-lg btn-block" type="button" id="save" value="保存"/>
			
		</div>
    </div>


	<script type="text/javascript" src="http://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script type="text/javascript" src="qrcode.js"></script>
	<script>

	//alert(str);
	document.getElementById('newtext').value = str;
	

	var qrcode = new QRCode(document.getElementById("qrcodeshow"), {
		width : 256,
		height : 256
	});
	// 綁定按鈕動作 - 生成二維碼
	document.getElementById('make').addEventListener('click', makeCode);
	document.getElementById('save').addEventListener('click', saveCode);
	// 綁定文本動作 - 迴車生成
	document.getElementById('newtext').addEventListener("keydown", function (e) {
		if (e.keyCode == 13) {
			makeCode();
		}
	});

	function makeCode() {		
		console.log("doMakeCode");	
		var elText = document.getElementById("newtext");
		if (!elText.value) {
			alert("Input a text");
			elText.focus();
			return;
		}
		qrcode.makeCode(elText.value);
	}
	
	makeCode();

	var _fixType = function(type) {
		type = type.toLowerCase().replace(/jpg/i, 'jpeg');
		var r = type.match(/png|jpeg|bmp|gif/)[0];
		return 'image/' + r;
	};

	var saveFile = function(data, filename){
		var save_link = document.createElementNS('http://www.w3.org/1999/xhtml', 'a');
		save_link.href = data;
		save_link.download = filename;
	   
		var event = document.createEvent('MouseEvents');
		event.initMouseEvent('click', true, false, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
		save_link.dispatchEvent(event);
	};

	function saveCode() {
		console.log("doSaveCode");
		canvas = document.getElementById("qrcodeshow").getElementsByTagName("canvas")[0];

		var type = 'png';
		var imgData = canvas.toDataURL(type);

		imgData = imgData.replace(_fixType(type),'image/octet-stream');

		// 下载后的问题名
		var filename = 'qrcode_' + (new Date()).getTime() + '.' + type;
		// download
		saveFile(imgData,filename);
	}
	</script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../css/bootstrap/assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../css/bootstrap/assets/js/vendor/popper.min.js"></script>
    <script src="../../css/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>

    <!-- Graphs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script>
      var ctx = document.getElementById("myChart");
      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
          datasets: [{
            data: [15339, 21345, 18483, 24003, 23489, 24092, 12034],
            lineTension: 0,
            backgroundColor: 'transparent',
            borderColor: '#007bff',
            borderWidth: 4,
            pointBackgroundColor: '#007bff'
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: false
              }
            }]
          },
          legend: {
            display: false,
          }
        }
      });
    </script>
  </body>


</html>
