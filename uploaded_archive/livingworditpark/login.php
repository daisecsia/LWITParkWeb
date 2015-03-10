<style>
	#login-box {
	    
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
</style>
<div id="dialog-overlay"></div>
<div id="login-box">
    <div class="dialog-content">
        <div id="dialog-message"></div>
        <a href="#" class="button">OK</a>
	</div>
</div>