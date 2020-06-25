<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" href="../style.css" type="text/css" media="all"/>
</head>
<body>
<div class="header">
<img src="../what-cheese-logo.png" class="logo"/>
<p class="title">What Cheese On-Line</p>
</div>
<div class="body" >
  <script src="/utils.js"></script>
  <div id="sidenav">
    <script>write_menu();</script>
  </div>
  <div class="content">
    <h1 style="margin-left:30px;">Welcome Authenticated User</h1>
    <div class="item">
      <img src="/media/nginx-icon.svg"/ class="itemimg">
      <p>
        <table>
          <tr><th>Web Server Header or Information</th><th>Value</th></tr>
          <tr><td>Web Server</td><td><?php echo gethostname(); ?></td></tr>
          <tr><td>Host Header</td><td><?php echo $_SERVER['HTTP_HOST']; ?></td></tr>
          <tr><td>User ID Header</td><td><?php echo $_SERVER['HTTP_X_USER_ID']; ?></td></tr>
        </table>
      </p>
      <p>
        <table>
          <tr><th>NGINX+ LB Header or Information</th><th>Value</th></tr>
          <tr><td>JWT User ID</td><td>__LB_JWT_CLAIM_SUB__</td></tr>
          <tr><td>JWT Email</td><td>__LB_JWT_CLAIM_EMAIL__</td></tr>
          <tr><td>JWT Session</td><td>__LB_JWT_AUTH_TOKEN__</td></tr>
        </table>
      </p>
    </div>
    <div class="item">
      <p>
        <table>
          <tr>
            <th><a href="/dashboard.html">NGiNX+ Dashboard</a></th>
            <th><a href="/api/4">API</a></th>
            <th><a href="/api/4/http/keyvals/whatcheese_keys">Surrogate Keys</a></th>
          </tr>
            <th colspan="3"><a href="/logout">Logout</a></th>
          <tr>
          </tr>
        </table>
      </p>
    </div>
  </div>
  <div class="footer">
    Copyright 2019 - The master cheese makers guild - All rights reserved
  </div>
</div>
</body>
</html>
