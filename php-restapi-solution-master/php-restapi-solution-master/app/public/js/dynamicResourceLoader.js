const params = window.location.pathname.split("/");

function setStyle(foldername, styleName) {
  var style = document.createElement('link');
  style.setAttribute("rel", "stylesheet");
  style.setAttribute("type", "text/css");
  if (params[1] != "") {
    style.setAttribute("href", "../css/" + foldername + "/" + styleName + ".css");
  } else {
    style.setAttribute("href", "../css/home.css");
  }
  document.head.appendChild(style);
}
function setScript(foldername, scriptName) {
var script = document.createElement("script");
script.setAttribute("type", "text/javascript");
script.setAttribute("src", "../js/" + foldername + "/"+ scriptName + ".js");
document.body.appendChild(script);
}

var parameter = params[1].replace("-", "");
setStyle(parameter, parameter);
setScript(parameter, parameter);
if (params[2] != null) {
  setStyle(params[1], "detailPage")
  setStyle(params[1], params[2])
  setScript(params[1], params[2])
}