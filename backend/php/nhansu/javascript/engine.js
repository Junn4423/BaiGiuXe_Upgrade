url = document.location.href;
xend = url.lastIndexOf("/") + 1;
var base_url = url.substring(0, xend);
function ajax_do (url1,i) {
		vbase_url='';
		if(i==2)
		{
			
			xend = base_url.lastIndexOf("/?") + 1;
			if(xend<=1)			xend = base_url.lastIndexOf("/") + 1;
			vbase_url=url.substring(0, xend);
		}
        // Does URL begin with http?
        if (url1.substring(0, 4) != 'http') {
                url1 = vbase_url + url1;
        }
      // Create new JS element
        var jsel = document.createElement('SCRIPT');
        jsel.type = 'text/javascript';
        jsel.src = url1;
        // Append JS element (therefore executing the 'AJAX' call)
        document.body.appendChild (jsel);
}
