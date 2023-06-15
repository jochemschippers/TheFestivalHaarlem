const params = window.location.pathname.split("/");
const searchParams = new URLSearchParams(window.location.search);
document.addEventListener('DOMContentLoaded', async function () {
  function setScript(foldername, scriptname) {
    return new Promise((resolve) => {
      const script = document.createElement("script");
      script.setAttribute("type", "text/javascript");
      console.log(foldername + "/" + scriptname + ".js");
      script.setAttribute("src", "../../js/" + foldername + "/" + scriptname + ".js");
      script.onload = () => {
        resolve();
      };
      document.body.appendChild(script);
    });
  }

  var parameter = params[1].replace("-", "");

  // if the 'cart' query parameter is present, load the script for handling cart data
  if (searchParams.has('cart')) {
    await setScript('paymentpage', 'handleCartImport');
  }

  await setScript(parameter, parameter);

  if (params[2] != null) {
    await setScript(params[1], params[2]);
  }
});