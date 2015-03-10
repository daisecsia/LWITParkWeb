<?php 
class Calendar {  
     
    /**
     * Constructor
     */
    public function __construct()
    {     
        $this->naviHref = htmlentities($_SERVER['PHP_SELF']);
    }
     
    /********************* PROPERTY ********************/  
    //private $dayLabels = array("Mon","Tue","Wed","Thu","Fri","Sat","Sun");
    private $dayLabels = array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat");
    public $currentYear=0;
    public $currentMonth=0;
    private $currentDay=0;
    private $currentDate=null;
    private $daysInMonth=0;
    private $naviHref= null;
    /********************* PUBLIC **********************/  
        
    /**
    * print out the calendar
    */
    public function show()
    {
        $year  == null;
        $month == null;
        if(null==$year && isset($_GET['year']))
            $year = $_GET['year'];
        else if(null==$year)
            $year = date("Y",time());
         
        if(null==$month && isset($_GET['month']))
            $month = $_GET['month'];
        else if(null==$month)
            $month = date("m",time());
         
        $this->currentYear=$year;
        $this->currentMonth=$month;
		$this->currentDate=date("d",time());
        $this->daysInMonth=$this->_daysInMonth($month,$year);
        $content='<div id="calendar">'.
                        '<div class="box">'.
                        $this->_createNavi().
                        '</div>'.
                        '<div class="box-content">'.
                                '<ul class="label">'.$this->_createLabels().'</ul>';   
                                $content.='<div class="clear"></div>';     
                                $content.='<ul class="dates">';    
                                 
                                $weeksInMonth = $this->_weeksInMonth($month,$year);
								$first_day = date('N',strtotime($this->currentYear.'-'.$this->currentMonth.'-01'));
								if ($weeksInMonth == 5 && ($first_day >= 4 || $first_day <=6))
									$weeksInMonth += 1;
								
                                // Create weeks in a month
                                for( $i=0; $i<$weeksInMonth; $i++ )
                                {
                                    //Create days in a week
                                    for($j=1;$j<=7;$j++)
                                        $content.=$this->_showDay($i*7+$j);
                                }
                                $content.='</ul>';
                                $content.='<div class="clear"></div>';
                        $content.='</div>';
        $content.='</div>';
        return $content;   
    }
     
    /********************* PRIVATE **********************/ 
    /**
    * create the li element for ul
    */
    private function _showDay($cellNumber)
    {
        if($this->currentDay==0)
        {
            $firstDayOfTheWeek = date('N',strtotime($this->currentYear.'-'.$this->currentMonth.'-01'));
            if(intval($firstDayOfTheWeek)==7 || intval($cellNumber) == intval($firstDayOfTheWeek)+1)
                $this->currentDay=1;
        }
		
		if(($this->currentDay!=0) && ($this->currentDay<=$this->daysInMonth))
        {
            $this->currentDate = date('Y-m-d',strtotime($this->currentYear.'-'.$this->currentMonth.'-'.($this->currentDay)));
            $cellContent = $this->currentDay;
            $this->currentDay++;
        }
        else
        {
             
            $this->currentDate =null;
            $cellContent=null;
        }
		$has_event = $this->fetchEvent($this->currentDate);
		if ($has_event && $this->currentDate==date('Y-m-d',time()))
			$class_id = 'event_current';
		elseif (!$has_event &&  $this->currentDate==date('Y-m-d',time()))
			$class_id = 'current_date';
		elseif ($has_event && !( $this->currentDate==date('Y-m-d',time())))
			$class_id = 'event_date';
		else
			$class_id = 'li-'.$this->currentDate;
		
        return '<li id='.$class_id .' class="'.($cellNumber%7==1?'start':($cellNumber%7==0?'end':'')).
                ($cellContent==null?'mask':'').'">'.$cellContent.'</li>';
    }
     
    /**
    * create navigation
    */
    private function _createNavi()
    {
        $nextMonth = $this->currentMonth==12?1:intval($this->currentMonth)+1;
        $nextYear = $this->currentMonth==12?intval($this->currentYear)+1:$this->currentYear;
        $preMonth = $this->currentMonth==1?12:intval($this->currentMonth)-1;
        $preYear = $this->currentMonth==1?intval($this->currentYear)-1:$this->currentYear;
		
        return
            '<div class="header">'.
                '<a class="prev" href="'.$this->naviHref.'?month='.sprintf('%02d',$preMonth).'&year='.$preYear.'">Prev</a>'.
                    '<span class="title">'.date('Y M',strtotime($this->currentYear.'-'.$this->currentMonth.'-1')).'</span>'.
                '<a class="next" href="'.$this->naviHref.'?month='.sprintf("%02d", $nextMonth).'&year='.$nextYear.'">Next</a>'.
            '</div>';
    }
         
    /**
    * create calendar week labels
    */
    private function _createLabels()
    {
        $content='';
        foreach($this->dayLabels as $index=>$label)
            $content.='<li class="'.($label==6?'end title':'start title').' title">'.$label.'</li>';

        return $content;
    }
     
     
     
    /**
    * calculate number of weeks in a particular month
    */
    private function _weeksInMonth($month=null, $year=null)
    {
        if(null==($year))
            $year =  date("Y",time());
         
        if(null==($month))
            $month = date("m",time());
         
        // find number of days in this month
        $daysInMonths = $this->_daysInMonth($month, $year);
        $numOfweeks = ($daysInMonths%7==0?0:1) + intval($daysInMonths/7);
		//echo $numOfweeks;
        $monthEndingDay= date('N',strtotime($year.'-'.$month.'-'.$daysInMonths));
        $monthStartDay = date('N',strtotime($year.'-'.$month.'-01'));
		//echo $monthEndingDay ."vs" .$monthStartDay;
        if($monthEndingDay>$monthStartDay && $numOfweeks < 5)
            $numOfweeks++;
		
        return $numOfweeks;
    }
 
    /**
    * calculate number of days in a particular month
    */
    private function _daysInMonth($month=null, $year=null)
    {
        if(null==($year))
            $year =  date("Y",time()); 
 
        if(null==($month))
            $month = date("m",time());
             
        return date('t',strtotime($year.'-'.$month.'-01'));
    }
	
	public function showEvent(){
		$event_list = $this->fetchAllEvent($this->currentYear, $this->currentMonth);
		if($event_list)
		{
			foreach($event_list as $list)
			{
				$content.= "<div class='event_detail'>
						<div class='event_date'>"
							.strtoupper(date("M d", strtotime($list['date'])))
					  	."</div>
					  	<div class='event_name'>"
					  		.ucfirst($list ['event_name'])
					  	."</div>
					  </div>";
			}
		}
		return $content;
	}
	
	public function fetchEvent($date)
	{
		$event_count = dbc_query_one("SELECT event_id FROM events WHERE date = '{$date}'");
		return $event_count;
	}
	
	public function fetchAllEvent($year=null, $month=null)
	{
		$event_count = dbc_query_all("SELECT * FROM events WHERE YEAR(date) = '{$year}' AND  MONTH(date) = '{$month}'");
		return $event_count;
	}
}
?>