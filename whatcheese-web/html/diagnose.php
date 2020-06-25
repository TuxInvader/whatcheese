<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" href="style.css" type="text/css" media="all"/>
  <script type="text/javascript" src="/vis-network.min.js"></script>
  <link href="/vis-network.min.css" rel="stylesheet" type="text/css" />
  </style>
</head>
<body>
<div class="header">
<img src="what-cheese-logo.png" class="logo"/>
<p class="title">What Cheese On-Line</p>
</div>
<div class="body" >
  <script src="/utils.js"></script>
  <div id="sidenav">
    <script>write_menu();</script>
  </div>
  <div class="content">
    <h1 style="margin-left:30px;">Connection Diagnostics</h1>
    <div class="item">
      <img src="/media/nginx-icon.svg"/ class="itemimg">
      <?php 
 
         if ( substr_compare($_SERVER['HTTP_HOST'], 'k8s', -3, 3, true) == 0 ) {
            include 'diagnose_k8s.php';
         } else {
            include 'diagnose_vm.php';
         }
      ?>
    </div>
  </div>
  <div class="footer">
    Copyright 2019 - The master cheese makers guild - All rights reserved
  </div>
</div>
</body>
</html>
