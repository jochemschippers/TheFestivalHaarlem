const params = window.location.pathname.split("/");
document.addEventListener('DOMContentLoaded', async function () {
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
  //added await so scripts that require other scripts load in the correct order (e.g. for the page /admin/jazz you'd first require admin.js for jazz.js to work correctly)
  await setScript(parameter, parameter);
  if (params[2] != null) {
    await setScript(params[1], params[2]);
  }
});