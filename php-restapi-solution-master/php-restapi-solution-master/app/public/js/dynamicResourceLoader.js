const params = window.location.pathname.split("/");
document.addEventListener('DOMContentLoaded', async function () {
function setStyle(foldername, styleName) {
  var style = document.createElement('link');
  style.setAttribute("rel", "preload"); 
  style.setAttribute("as", "style");
  style.setAttribute("type", "text/css");
  if (params[1] != "") {
    style.setAttribute("href", "../css/" + foldername + "/" + styleName + ".css");
  } else {
    style.setAttribute("href", "../css/home.css");
  }
  style.onload = function () {
    this.rel = 'stylesheet';
  };

  document.head.appendChild(style);
}
function setScript(foldername, scriptname) {
  return new Promise((resolve) => {
    const script = document.createElement("script");
    script.setAttribute("type", "text/javascript");
    script.setAttribute("src", "../../js/" + foldername + "/" + scriptname + ".js");
    script.onload = () => {
      resolve();
    };
    document.body.appendChild(script);
  });}

  var parameter = params[1].replace("-", "");
  setStyle(parameter, parameter);
  //added await so scripts that require other scripts load in the correct order (e.g. for the page /admin/jazz you'd first require admin.js for jazz.js to work correctly)
  await setScript(parameter, parameter);
  if (params[2] != null) {
    setStyle(params[1], "detailPage");
    setStyle(params[1], params[2]);
    await setScript(params[1], params[2]);
  }
});