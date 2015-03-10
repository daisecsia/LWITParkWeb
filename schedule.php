<?php
$menu_id = "schedule";
$page = "schedule";
$page_title = "Schedule and Events";
include_once('util/base_inc.php');
include_once('header_page.php');
?>
<script>

	$(document).ready(function() {

		$('#calendar').fullCalendar({
			theme: true,
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			defaultDate: '2015-04-27',
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: [
				{
					title: 'All Day Event',
					start: '2014-12-01'
				},
				{
					title: 'Long Event',
					start: '2014-11-07',
					end: '2014-11-10'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2014-11-09T16:00:00'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2014-11-16T16:00:00'
				},
				{
					title: 'Conference',
					start: '2014-11-11',
					end: '2014-11-14'
				},
				{
					title: 'Meeting',
					start: '2014-11-12T10:30:00',
					end: '2014-11-12T12:30:00'
				},
				{
					title: 'Lunch',
					start: '2014-11-12T12:00:00'
				},
				{
					title: 'Meeting',
					start: '2014-11-12T14:30:00'
				},
				{
					title: 'Happy Hour',
					start: '2014-11-12T17:30:00'
				},
				{
					title: 'Dinner',
					start: '2014-11-12T20:00:00'
				},
				{
					title: 'Birthday Party',
					start: '2014-11-13T07:00:00'
				},
				{
					title: 'Click for Google',
					url: 'http://google.com/',
					start: '2014-11-28'
				}
			]
		});
		
	});

</script>
<style>
	
	.event_countdown_box{
		width: 60%;
		margin: 6px auto;
		padding: 3px 0px;
		border: 1px double #708189;
		background: rgba(232,232,232,1);
		background: -moz-linear-gradient(top, rgba(232,232,232,1) 0%, rgba(232,232,232,1) 2%, rgba(224,224,224,1) 55%, rgba(214,214,214,1) 75%, rgba(255,255,255,1) 100%);
		background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(232,232,232,1)), color-stop(2%, rgba(232,232,232,1)), color-stop(55%, rgba(224,224,224,1)), color-stop(75%, rgba(214,214,214,1)), color-stop(100%, rgba(255,255,255,1)));
		background: -webkit-linear-gradient(top, rgba(232,232,232,1) 0%, rgba(232,232,232,1) 2%, rgba(224,224,224,1) 55%, rgba(214,214,214,1) 75%, rgba(255,255,255,1) 100%);
		background: -o-linear-gradient(top, rgba(232,232,232,1) 0%, rgba(232,232,232,1) 2%, rgba(224,224,224,1) 55%, rgba(214,214,214,1) 75%, rgba(255,255,255,1) 100%);
		background: -ms-linear-gradient(top, rgba(232,232,232,1) 0%, rgba(232,232,232,1) 2%, rgba(224,224,224,1) 55%, rgba(214,214,214,1) 75%, rgba(255,255,255,1) 100%);
		background: linear-gradient(to bottom, rgba(232,232,232,1) 0%, rgba(232,232,232,1) 2%, rgba(224,224,224,1) 55%, rgba(214,214,214,1) 75%, rgba(255,255,255,1) 100%);
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e8e8e8', endColorstr='#ffffff', GradientType=0 );
		-webkit-box-shadow: 6px 4px 5px 0px rgba(36,56,94,1);
		-moz-box-shadow: 6px 4px 5px 0px rgba(36,56,94,1);
		box-shadow: 6px 4px 5px 0px rgba(36,56,94,1);
		float: left;
	}
	
	.event_description{
		float: left;
	}
	.event_title h2{
		color: #648d9f;
		font-size: 20px;
		margin: 3px;
		font-weight: bolder;
	}
	
	.list_counter_box{
		padding: 6px;
		font-size: 12px;
	}
	
	.event_countdown{
		width: inherit;
	}
	.counter_box{
		background: #358CB9;
		margin: 6px auto;
		float: left;
	}

</style>
<div class="page_wrapper">
		<div class = "event_countdown_box">
			<h3 style="margin: 7px;">Next Event:</h3>
			<?php
				$result = dbc_query_all("select * from events WHERE date_start > NOW() ORDER BY date_start LIMIT 1");
			?>
			<div class = "event_title"><h2><?php echo $result[0]['event_name'] . ($result[0]['event_theme'] != '' ? ": " .$result[0]['event_theme'] : ''); ?></h2></div>
			<div>
				<div class="counter_box">
					<div class="event_countdown">
						<div id="defaultCountdown"></div>
						<div class="event_details schedule"><?php echo $result[0]['venue']?> <br /> <?php echo date("M d, Y h:i A", strtotime($result[0]['date_start'])) ." - " .date("M d, Y h:i A", strtotime($result[0]['date_end'])); ?></div>
					</div>
				</div>
				<div class = "event_description">
					<ul class="list_counter_box">
						<li class="list_text">
							<span class="list_icon check"></span>
							<?php echo $result[0]['description']; ?>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div id='calendar'></div>
		<!-- <div class="divider"></div> -->
		<div id="events">
			<!-- <h1>EVENTS</h1> -->
			<div id="calendar">
			<?php
				include_once('calendar.php'); 
				$calendar = new Calendar();
				echo $calendar->show();
			?>
			</div>
			<div id="event_detail_wrapper">
			<?php
				echo $calendar->showEvent();
			?>
			</div>
		</div>
</div>
<?php
include_once('footer_page.php');
?>