//this code exists so the jquery plugins and other scripts are only loaded on the admin pages
const head = document.getElementsByTagName('head')[0];


// Add DataTables JS
const script = document.createElement('script');
script.src = 'https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js';
script.type = 'text/javascript';
head.appendChild(script);

// Add DataTables CSS
const link = document.createElement('link');
link.href = 'https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css';
link.rel = 'stylesheet';
link.type = 'text/css';
head.appendChild(link);
