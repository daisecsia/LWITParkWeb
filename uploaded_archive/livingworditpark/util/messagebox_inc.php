<style type="text/css">
	#dialog-box {
	    
	    /* css3 drop shadow */
	    -webkit-box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
	    -moz-box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
	    
	    /* css3 border radius */
	    -moz-border-radius: 5px;
	    -webkit-border-radius: 5px;
	    
	    background:#eee;
	    width:328px; 
	    
	    /* make sure it has the highest z-index */
	    position:absolute; 
	    z-index:5000; 
	    /* hide it by default */
	    display:none;
	}
	#dialog-box .dialog-content {
	    /* style the content */
	    text-align:left; 
	    padding:10px; 
	    margin:13px;
	    color:#666; 
	    font-family:arial;
	    font-size:12px; 
	}
	a.button {
	    /* styles for button */
	    margin:10px auto 0 auto;
	    text-align:center;
	    display: block;
	    width:50px;
	    padding: 5px 10px 6px;
	    color: #fff;
	    text-decoration: none;
	    font-weight: bold;
	    line-height: 1;
	    
	    /* button color */
	    background-color: #293342;
	    
	    /* css3 implementation :) */
	    /* rounded corner */
	    -moz-border-radius: 5px;
	    -webkit-border-radius: 5px;
	    
	    /* drop shadow */
	    -moz-box-shadow: 0 1px 3px rgba(0,0,0,0.5);
	    -webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.5);
	    
	    /* text shaow */
	    text-shadow: 0 -1px 1px rgba(0,0,0,0.25);
	    border-bottom: 1px solid rgba(0,0,0,0.25);
	    position: relative;
	    cursor: pointer;
	    
	}
	a.button:hover {
	    background-color: #FF7D4C;    
	}
	/* extra styling */
	#dialog-box .dialog-content p {
	    font-weight:700; margin:0;
	}
	#dialog-box .dialog-content ul {
	    margin:10px 0 10px 10px; 
	    padding:0; 
	    height:50px;
	}
	
	#dialog-message{
		font-size: 11px;
	}
</style>
<script type="text/javascript">
	$(document).ready(function () {
	    // if user clicked on button, the overlay layer or the dialogbox, close the dialog    
	    $('a.btn-ok, #dialog-overlay, #dialog-box').click(function () {        
	        $('#dialog-overlay, #dialog-box').hide();        
	        return false;
	    });
	    
	    // if user resize the window, call the same function again
	    // to make sure the overlay fills the screen and dialogbox aligned to center    
	    $(window).resize(function () {
	        
	        //only do it if the dialog box is not hidden
	        if (!$('#dialog-box').is(':hidden')) popup();        
	    }); 
	});
	//Popup dialog
	function popup(message) {
	    // get the screen height and width  
	    var maskHeight = $(document).height();  
	    var maskWidth = $(window).width();
	    
	    // calculate the values for center alignment
	    var dialogTop =  (maskHeight/3) - ($('#dialog-box').height());  
	    var dialogLeft = (maskWidth/2) - ($('#dialog-box').width()/2); 
	    
	    // assign values to the overlay and dialog box
	    $('#dialog-overlay').css({height:maskHeight, width:maskWidth}).show();
	    $('#dialog-box').css({top:dialogTop, left:dialogLeft}).show();
	    
	    // display the message
	    $('#dialog-message').html(message);
	            
	}
</script>

<div id="dialog-overlay"></div>
<div id="dialog-box">
    <div class="dialog-content">
        <div id="dialog-message"></div>
        <a href="#" class="button">OK</a>
    </div>
</div>