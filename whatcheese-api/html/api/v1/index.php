<?php

function str_begins($haystack, $needle) {
  return 0 === substr_compare($haystack, $needle, 0, strlen($needle));
}

function returnJSON($path, $data) {
  header('Content-type: application/json; charset=utf-8');
  #header('Access-Control-Allow-Origin: *');
  $data['result'] = "OK";
  $data['request'] = $path;
  echo json_encode($data);
}

function returnError($error) {
  header('Content-type: application/json; charset=utf-8');
  #header('Access-Control-Allow-Origin: *');
  $path = strtolower(urldecode($urlComponents['path']));
  $data = [];
  $data['result'] = "ERROR";
  $data['request'] = $path;
  $data['details'] = $error;
  echo json_encode($data);
  exit;
}

function getRows($connection, $table, $search) {
  if ( $search != NULL and strlen($search) > 0 ) {
    $query = "select * from $table where name like \"%$search%\" or country like \"%$search%\"";
  } else { 
    $query = "select * from $table";
  }
  $result = $connection->query($query) or returnError('I cannot select from the database because: ' . $connection->connect_error );
  return $result;
}

function getRow($connection, $table, $name) {
  $query = "select * from $table where name = \"$name\"";
  $result = $connection->query($query) or returnError('I cannot select from the database because: ' . $connection->connect_error );
  return $result;
}

function addRow($connection, $table, $name, $country, $description) {
  $name = addslashes($name);
  $country = addslashes($country);
  $description = addslashes($description);
  if ( $name == "" or $country == "" or $description == "" ) {
    returnError('You must provide JSON containing {name, country, description}');
  }
  $query = "insert into $table values(0, '$name', '$country', '$description')";
  $result = $connection->query($query) or returnError('I cannot select from the database because: ' . $connection->connect_error );
  return $result;
}

$user="whatcheese";
$password="moreCheeseLad";
$database="whatcheese";
$connection = new mysqli("whatcheese-db", $user, $password, $database, '3306');
if (!$connection) {
    returnError('Could not connect: ' . $connection->connect_error );
}
mysqli_set_charset($connection, "utf8");

$data = [];
$fields = [];
$urlComponents = parse_url($_SERVER['REQUEST_URI']);
$path = strtolower(urldecode($urlComponents['path']));
$host = $_SERVER['HTTP_HOST'];
if(isset($urlComponents['query'])) {
  parse_str($urlComponents['query'], $fields);
}
$segments = explode("/", $path);
$unit = gethostname();

$data['section'] = $segments[2];
if ( in_array($segments[2], array("cheese","pickle","beer","wine") ) ) {  
  $results = [];
  if ( count($segments) == 3 ) {
    $searchReq = '';
    if(isset($fields['search'])) {
      $searchReq = $fields['search'];
    }
    $mysql_result = getRows($connection, $segments[2], $searchReq);
  } else {
    $mysql_result = getRow($connection, $segments[2], $segments[3]);
  }
  if ( $mysql_result ) {
    $query = "SELECT FOUND_ROWS()";
    $found_rows_result = $connection->query($query) or returnError('I cannot select from the database because: ' . $connection->connect_error );
    $row = $found_rows_result->fetch_row();
    $data['items'] = intval($row[0]);
    while($row = $mysql_result->fetch_array()) {
      array_push(  $results, [ "id" => intval($row[0]), "name" => $row[1], 
                               "href" => "https://$host/v1/$segments[2]/$row[1]",
                               "country" => $row[2], "description" => $row[3] ]);
    }
  } else {  
    $data['items'] = 0;
  }
  if ( $segments[2] == "wine" ) {
    # sleep for 25ms on wine requests
    time_nanosleep(0,25000000);
  }
  $data['results'] = $results;
} else if ( ( $segments[2] == "add") and ( in_array($segments[3], array("cheese","pickle","beer","wine") ) ) ) {
  $data['section'] = $segments[3];
  $json = file_get_contents('php://input');
  $input_data = json_decode($json);
  $results = [];

  $insert = addRow($connection, $segments[3], $input_data->name, $input_data->country, $input_data->description);

  $mysql_result = getRow($connection, $segments[3], $input_data->name);
  if ( $mysql_result ) {
    $query = "SELECT FOUND_ROWS()";
    $found_rows_result = $connection->query($query) or returnError('I cannot select from the database because: ' . $connection->connect_error );
    $row = $found_rows_result->fetch_row();
    $data['items'] = intval($row[0]);
    while($row = $mysql_result->fetch_array()) {
      array_push($results, [ "id" => intval($row[0]), "name" => $row[1], "country" => $row[2], "description" => $row[3] ]);
    }
  } else {  
    $data['items'] = 0;
    $data['error'] = true;
  }
  $data['results'] = $results;
} else if ( $segments[2] == "links" ) {
  $data['items'] = 0;
  $data['results'] = [];
  $data['links'] = [ 
    'cheese' => [ 'href' => "https://$host/v1/cheese" ],
    'pickle' => [ 'href' => "https://$host/v1/pickle" ],
    'beer'   => [ 'href' => "https://$host/v1/beer" ],
    'wine'   => [ 'href' => "https://$host/v1/wine" ] ];
} else {
  $data['items'] = 0;
  $data['results'] = [];
}

returnJSON($path, $data);

?>

