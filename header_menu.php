<div id="header">
    <!-- logo -->
    <a href="index.php" id="logo"><img src="images/lit_logo.png" title="go to Home"></a>
    <!-- extra top links -->
    <?php
    	//$basename = substr(strtolower(basename($_SERVER['PHP_SELF'])),0,strlen(basename($_SERVER['PHP_SELF']))-4);
    	if ($_SESSION['login'])
			echo "<div id='links'>Hello, {$_SESSION['login_user']}!
					<a href='index.php?logout=1'>Log-out</a>
				 </div>";
		else
		{
			echo "<div id='links'>"
        					."<a href='login.php'>Login</a>"
        					."<a href='signup.php?id=0'>I'm new!</a>"
    					."</div>";
		}
    ?>
    <!-- navigation menu -->
    <div id="navmenu">
        <nav id="menu">
            <ul>
                <li <?php echo $menu_id == 'home' ? "class='active'" : ""; ?>><a href="index.php">Home</a></li>
                <li <?php echo $menu_id == 'about' ? "class='active'" : ""; ?>><a title="know more about us">About Us</a>
                    <ul class="menu_about">
                        <li><a href="history.php" title="know our history"><span class="icon history"></span>History</a></li>
                        <li><a href="about.php" title="why we exist"><span class="icon faith_believe"></span>Who We Are</a></li>
                        <li style="display: none;"><a href="about.php#belief" title="statement of faith"><span class="icon faith_believe"></span>What We Believe</a></li>
                        <li style="display: none;"><a href=""><span class="icon leadership"></span>Leadership</a></li>
                        <li><a href="contact.php" title="get in touch with us"><span class="icon contact"></span>Contact Us</a></li>
                    </ul>
                </li>
                <li <?php echo $menu_id == 'schedule' ? "class='active'" : ""; ?>><a href="schedule.php">Events</a></li>
                <li <?php echo $menu_id == 'involve' ? "class='active'" : ""; ?>><a>Get Involved</a>
                    <ul class="menu_involve">
                        <li><a href="ministry.php" title="serve with us"><span class="icon ministry"></span>Ministry List</a></li>
                        <li><a href="small_group.php" title="grow with us"><span class="icon small_group"></span>Make Disciples Groups</a></li>
                        <li><a href="schedule.php"><span class="icon activities"></span>Activities</a></li>
                    </ul>
                </li>
                <li <?php echo $menu_id == 'resources' ? "class='active'" : ""; ?>><a href="#">Resources</a>
                    <ul>
                        <li><a href="download_sermon.php" title="listen or download recorded audio sermon"><span class="icon audio"></span>Audio Sermon</a></li>
                        <li><a href="#"><span class="icon handout"></span>Sermon Handouts</a></li>
                        <li><a href="article.php" title="supplementary materials for your growth"><span class="icon e_resource"></span>Pastoral Page</a></li>
                        <li><a href="#"><span class="icon lit"></span>LIT Express</a></li>
                        <li><a href="#"><span class="icon gallery"></span>Gallery</a></li>
                    </ul>
                </li>
                <?php
                //if($_SESSION['access_right']=='1')
				//{ ?>
                <li <?php echo $menu_id == 'admin' ? "class='active'" : ""; ?>><a href="#">Admin Pages</a>
                	<ul>
                        <li><a href="#"><span class="icon report"></span>Small Group Report</a></li>
                        <li><a href="#"><span class="icon announcement"></span>Announcement</a></li>
                        <li><a href="upload_sermon.php"><span class="icon audio_upload"></span>Upload Sermon</a></li>
                        <li><a href="#"><span class="icon feedback"></span>Suggestion Box</a></li>
                        <li><a href="#"><span class="icon schedule"></span>Calendar and Events</a></li>
                        <li><a href="#"><span class="icon elem0"></span>Extract Report</a></li>
                    </ul>
               </li>
               <?php //} ?>
            </ul>
        </nav>
        <!-- search form 
        <div id="search">
            <form role="search" method="get">
                <input type="text" placeholder="search..." name="s" value="" autocomplete="off" />
            </form>
        </div>-->
    </div>
</div>
