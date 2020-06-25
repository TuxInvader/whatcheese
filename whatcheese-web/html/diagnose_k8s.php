<div id="mynetwork"></div>
<script type="text/javascript">
  // create a network
  var layoutMethod = "directed";
  var container = document.getElementById('mynetwork');
  <?php
    if ( $_SERVER['HTTP_XNIGN'] == "NGINX" ) {
      $ilabel = '"K8s Node\n';
    } else {
      $ilabel = '"F5 BigIP\n';
    }
    $dot = "'dinetwork {node[shape=box]; Client [color=#00ff00] ; ingress [label=" . $ilabel. $_SERVER['HTTP_HOST'] . '" color=#00ff00]; ';
    $nginx = gethostbynamel( 'nginx-ingress.nginx-ingress.svc.cluster.local' );
    $web = gethostbynamel( 'whatcheese-web.default.svc.cluster.local' );
    $web2 = gethostbynamel( 'whatcheese-web2.default.svc.cluster.local');
    foreach ( $nginx as &$node ) {
      $n_name = $node . '[label="NGiNX\n' . $node ;
      if ( $node == $_SERVER['REMOTE_ADDR'] ) {
         $n_name .= '", color=#00ff00]';
      } else {
         $n_name .= '"]';
      }
      $dot .= "$n_name ; ingress -> $node [color=blue]; ";
      foreach ( $web as &$ws ) {
        $s_name = $ws . '[label="App 1.0\n' . $ws;
        if ( $ws == $_SERVER['SERVER_ADDR'] ) {
           $s_name .= '", color=#00ff00]';
        } else {
           $s_name .= '"]';
        }
        $dot .= "$s_name ; $node -> $ws [color=blue]; ";
      }
      foreach ( $web2 as &$ws ) {
        $s_name = $ws . '[label="App 2.0\n' . $ws;
        if ( $ws == $_SERVER['SERVER_ADDR'] ) {
           $s_name .= '", color=#00ff00]';
        } else {
           $s_name .= '", color=orange]';
        }
        $dot .= "$s_name ; $node -> $ws [color=blue]; ";
      }
    }
    $dot .= "Client -> ingress [color=red] -> " . $_SERVER['REMOTE_ADDR'] . " [color=red] -> " . $_SERVER['SERVER_ADDR'] . " [color=red] }';";
    echo "   var dot = $dot";
  ?>
  var data = vis.network.convertDot(dot);
  var options = {
        layout: {
          hierarchical: {
            sortMethod: layoutMethod
          }
        },
        edges: {
          smooth: true,
          arrows: {to : true }
        }
      };
  var network = new vis.Network(container, data, options);
</script>
      <p>
        <table>
          <tr><th>Web Server Header or Information</th><th>Value</th></tr>
          <tr><td>Web Server</td><td><?php echo gethostname(); ?></td></tr>
          <tr><td>Host Header</td><td><?php echo $_SERVER['HTTP_HOST']; ?></td></tr>
          <tr><td>App Version</td><td><?php if ( strpos(gethostname(), "web2") !== False ) { echo "2.0"; } else { echo "1.0"; } ?></td></tr>
          <tr><td>Connection Info</td><td><?php echo $_SERVER['REMOTE_ADDR'] . ":" . $_SERVER['REMOTE_PORT'] . " <--> " . $_SERVER['SERVER_ADDR'] . ":" . $_SERVER['SERVER_PORT']; ?></td></tr>
          <!-- <tr><td>Headers</td><td> <?php 
            echo "\n";
            foreach ($_SERVER as $name => $value) {
              if (substr($name, 0, 5) == 'HTTP_') {
                $header =  str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))));
                echo " $header: $value <br>\n";
              }
            }
          ?> </td></tr> -->
        </table>
      </p>

    
