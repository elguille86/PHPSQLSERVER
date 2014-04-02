 
$(document).ready(function () {
	var theme = 'energyblue';//getTheme();
    // Create jqxTree
    //$('#jqxTree').jqxTree({ allowDrag: true, allowDrop: true, theme: theme});
            // Create jqxExpander
    /*         
    $('#jqxExpander').jqxExpander({ 
    	theme: theme,
        showArrow: false,  
        toggleMode: 'none', 
        width: '250px', 
        height: 'auto' 
    });*/

    $(".numero").keydown(function(event) {
        if (
			event.keyCode == 46 || event.keyCode == 8 || 
			event.keyCode == 9 || event.keyCode == 37 || 
			event.keyCode == 38 || event.keyCode == 39 || 
			event.keyCode == 40
		) { }
        else {
            if (
				(event.keyCode < 48 || event.keyCode > 57) && 
				(event.keyCode < 96 || event.keyCode > 105)) 
			{
                event.preventDefault();
            }
        }
	});


	function checkDate(month, day, year) {
		var monthLength = new Array(31,28,31,30,31,30,31,31,30,31,30,31);
		if (!day || !month || !year) {
    		return false;
    	}
    	// check for bisestile year
    	if (year/4 == parseInt(year/4)) {
    		monthLength[1] = 29;
    	}
    	if (month < 1 || month > 12) {
    		return false;
		}
    	if (day > monthLength[month-1]) {
    		return false;
    	}
    	return true;
	}


	String.prototype.trim = function() {
		return this.replace(/^\s*|\s*$/g, '');
	}




});
