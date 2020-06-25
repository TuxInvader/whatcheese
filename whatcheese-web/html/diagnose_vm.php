      <p>
        <table>
          <tr><th>Web Server Header or Information</th><th>Value</th></tr>
          <tr><td>Web Server</td><td><?php echo gethostname(); ?></td></tr>
          <tr><td>Host Header</td><td><?php echo $_SERVER['HTTP_HOST']; ?></td></tr>
          <tr><td>Connection Info</td><td><?php echo $_SERVER['REMOTE_ADDR'] . ":" . $_SERVER['REMOTE_PORT'] . " <--> " . $_SERVER['SERVER_ADDR'] . ":" . $_SERVER['SERVER_PORT']; ?></td></tr>
        </table>
      </p>
      <p>
        <table>
          <tr><th>NGINX+ LB Header or Information</th><th>Value</th></tr>
	  <tr><td>X-Forwarded-For Header</td><td><?php echo $_SERVER['HTTP_X_FORWARDED_FOR']; ?></td></tr>
          <tr><td>X-Real-IP Header</td><td><?php echo $_SERVER['HTTP_X_REAL_IP']; ?></td></tr>
          <tr><td>Connection Info</td><td>__LB_CONNECTION__</td></tr>
        </table>
      </p>
