function write_menu() {
  var api = location.hostname.replace('www','api');
  var menu = '<a href="/">Home</a> '
  menu += '<a href="/news/">News</a> '
  menu += '<a href="/blog/">Blog</a>' 
  menu += '<a href="/forum/">Forum</a>' 
  menu += '<a href="/offers/">Offers</a>' 
  menu += '<a href="/diagnose.php">Diagnose</a>' 
  menu += '<a href="/admin/">Admin</a>' 
  menu += '<a href="https://' + api + '/v1/links">API</a>'
  document.getElementById("sidenav").innerHTML = menu;
}

function capfirst( mystring ) {
  return mystring.charAt(0).toUpperCase() + mystring.slice(1)
}

function process_item(type, data, outputElement) {
  var output = document.getElementById(outputElement)
  if ( data.result != "OK" ) {
    output.innerHTML = "<p>Failed to get " + capfirst(type) + " :-( <br/>The Errors was: " + data.details + "</p>"
    return
  }
  if ( data.items == 0 ) {
    output.innerHTML = "<p>Failed to get " + capfirst(type) + " :-( <br/>The Errors was: No Cheeses found </p>"
    return
  }
  var item = Math.floor(Math.random() * data.items);
  var htmlout =  "<p>";
  htmlout += capfirst(type) + " of the moment: <strong>" + data.results[item].name + "</strong><br/>"
  htmlout += "Country of Origin: " + data.results[item].country + "<br/>"
  htmlout += data.results[item].description + "</p>"
  output.innerHTML = htmlout;
}

function get_api_item(type, name, search, outputElement)
{
  var xmlhttp;
  var web = location.hostname.split('.')
  web[0] = 'api'
  var api_uri = "https://" + web.join('.') + "/v1/" + type
  if ( name != "" ) 
  {
    api_uri += "/" + name
  }
  if ( search != "" ) 
  {
    api_uri += "?search=" + search
  }
  if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  }
  else
  {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onload=function()
  {
    if (xmlhttp.status==200)
    {
      var data = JSON.parse(xmlhttp.response);
      process_item(type, data, outputElement);
    } else {
      var data = { "result": "ERROR", "details": xmlhttp.status + ": " + xmlhttp.statusText }
      console.log(xmlhttp);
      process_item(type, data, outputElement);
    }
  }
  xmlhttp.onerror=function()
  {
    var data = { "result": "ERROR", "details": xmlhttp.status + ": " + xmlhttp.statusText }
    process_item(type, data, outputElement);
  }
 
  xmlhttp.open("GET", api_uri, true );
  xmlhttp.send();
}

function post_api_item(formID, resultID) 
{
  var form = document.forms.namedItem(formID)
  form.addEventListener('submit', function(ev) {
    ev.preventDefault();
    var formdata = new FormData(form)
    var web = location.hostname.split('.')
    web[0] = 'api'
    var api_post = "https://" + web.join('.') + "/v1/add/" + formdata.get("type") + "?psk=" + formdata.get("psk")
    var output = document.getElementById(resultID)

    var object = {};
    formdata.forEach(function(value, key){
      object[key] = value;
    });
    var json = JSON.stringify(object);

    var xmlhttp;
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onload=function()
    {
      if (xmlhttp.status==200)
      {
        var data = JSON.parse(xmlhttp.response);
        output.textContent = JSON.stringify(data, undefined, 2);
      } else {
        output.innerHTML = "Error: " + xmlhttp.status
      }
    }
    xmlhttp.onerror=function()
    {
      output.innerHTML = "Error: " + xmlhttp.status
    }
    xmlhttp.open("POST", api_post, true );
    xmlhttp.send(json);
  }, false);
}

function write_article(id, theUrl, teaser)
{
  var xmlhttp;
  if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  }
  else
  {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function()
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      var html = xmlhttp.responseText.split("<!--teaser-->");
      if ( teaser ) {
        document.getElementById(id).innerHTML = html[0] + html[1];
      } else {
        document.getElementById(id).innerHTML = html[0] + html[2];
      }
    }
  }
  xmlhttp.open("GET", theUrl, true );
  xmlhttp.send();
}

