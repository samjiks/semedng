<?php
		$month = isset($_GET['m']) ? $_GET['m'] : NULL;
		$year  = isset($_GET['y']) ? $_GET['y'] : NULL;
		if(Auth::instance()->logged_in("nhis"))
			$treatmentcycles=Model::factory('treatmentcyclemd')->SelectAll();
		elseif(Auth::instance()->logged_in("hmo"))
		{
			$hmouser=Model::factory('hmomd')->get_hmo_by_user($user->id);
			$treatmentcycles=Model::factory('treatmentcyclemd')->SelectAwaitingAuthCode($hmouser['hmid']);
		}
		else $treatmentcycles=array();
		
		$calendar = Calendar::factory($month, $year, array('show_days' => array(1, 1, 1, 1, 1, 1, 1)));
		 
/*		$event1 = $calendar->event()
			->condition('timestamp', strtotime(date('F').' 21, '.date('Y')))
			->title('Hello All')
			->output('<a href="#">Going to Google</a>');
			 
		$event2 = $calendar->event()
			->condition('timestamp', strtotime(date('F').' 21, '.date('Y')))
			->title('Something Awesome')
			->output('<a href="#">My Portfolio</a>');
		 
		$event = $calendar->event()
		->condition('current', TRUE)  // Event is in the current month
		->condition('month', 10)      // On the 11th month (November)
		->condition('day_of_week', 4) // On a Thursday
		->condition('occurrence', 4)  // The 4th Thursday of the month
		->title('NHIS')
		->output('NHIS Meeting');*/
	
		$calendar->standard('today')
			->standard('prev-next');
			//->standard('holidays')
			//->attach($event1)
			//->attach($event)
			//->attach($event2);
			
		if(count($treatmentcycles) >0): 
			foreach($treatmentcycles as $t):
				if(Model::factory('patientdiagnosismd')->IsCostAppended($t['id']))
					continue;
					
				$p=$t['formno'];
				if(!empty($t['proposedenddate']))
				{
					$dates=explode("-",$t['proposedenddate']); 
					$url="$site/patient/details?pid=".$t['patientid'];
					$style="";
				}
				else
				{
					$dates=explode("-",date("Y-m-d"));
					$url="$site/treatmentcycle/index/".$t['patientid'];
					$style="color:red; font-weight:bold";
				}
				
				if(count($dates)< 2)continue;
					
			$ev = $calendar->event()
			->condition('month', $dates[1])
			->condition('day',  $dates[2])
			->title($p)
			->output("<a href=\"$url\" style=\"$style\">".$p.'</a>');
			$calendar->attach($ev);
			endforeach; 
		endif;
	
?>

<table class="calendar table table-stripped">
    <thead>
        <tr class="navigation">
            <th class="prev-month"><a href="<?php echo htmlspecialchars($calendar->prev_month_url()) ?>"><?php echo $calendar->prev_month(0, '&laquo;') ?></a></th>
            <th colspan="5" class="current-month"><?php echo $calendar->month() ?> <?php echo $calendar->year ?></th>
            <th class="next-month"><a href="<?php echo htmlspecialchars($calendar->next_month_url()) ?>"><?php echo $calendar->next_month(0, '&raquo;') ?></a></th>
        </tr>
        <tr class="weekdays">
            <?php foreach ($calendar->days(1) as $day): ?>
                <th><?php echo $day ?></th>
            <?php endforeach ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($calendar->weeks() as $week): ?>
            <tr>
                <?php foreach ($week as $day): ?>
                    <?php
                    list($number, $current, $data) = $day;
                     
                    $classes = array();
                    $output  = '';
                     
                    if (is_array($data))
                    {
                        $classes = $data['classes'];
                        $title   = $data['title'];
                        $output  = empty($data['output']) ? '' : '<ul class="output"><li>'.implode('</li><li>', $data['output']).'</li></ul>';
                    }
                    ?>
                    <td class="day <?php echo implode(' ', $classes) ?>">
                        <span class="date" title="<?php echo implode(' / ', $title) ?>">
                            <?php if ( !empty($output)): ?>
                                <a href="<?php echo $site?>/patient/appointed?m=<?php echo $calendar->month."&y=".$calendar->year."&d=".$number ?>" class="view-events"><?php echo $number ?><br/><?php echo $output; ?></a>
                            <?php else: ?>
                                <?php echo $number ?>
                            <?php endif ?>
                        </span>
                    </td>
                <?php endforeach ?>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>