<?php 
add_action( 'wp_ajax_nopriv_mortgage_cal', 'mortgage_cal' );
add_action( 'wp_ajax_user_mortgage_cal', 'mortgage_cal' );
function mortgage_cal() {
$principal = floatval($_POST['mortgage_amount']); //Mortgage Amount 
$interest_rate = floatval($_POST['interest_rate']); //Interest Rate %
//$down = floatval($_POST['lumpsum_amount'])*0.10; //10% down payment
$down = floatval(0)*0.10; //10% down payment
$years = $_POST['starting_mortgage_year'];
$months = (isset($_POST['starting_mortgage_month'])) ? $_POST['starting_mortgage_month'] : 0;
$compound = 2; //compound is always set to 2
$frequency = $_POST['payment_frequency']; //Number of months (Monthly (12), Semi-Monthly (24), Bi-Weekly(26) and Weekly(52) 

## Mortgage Type Text ##
$type_of_mortgage =	$_POST['type_of_mortgage'];
if($type_of_mortgage==0){
	$type_of_mortgage_txt = "Custom Rate";	
} else if($type_of_mortgage==1){
	$type_of_mortgage_txt = "6 month closed";
} else if($type_of_mortgage==2){
	$type_of_mortgage_txt = "6 month open";
} else if($type_of_mortgage==3){
	$type_of_mortgage_txt = "1 year open";
} else if($type_of_mortgage==4){
	$type_of_mortgage_txt = "1 year closed";
} else if($type_of_mortgage==5){
	$type_of_mortgage_txt = "2 year closed";
} else if($type_of_mortgage==6){
	$type_of_mortgage_txt = "3 year closed";
} else if($type_of_mortgage==7){
	$type_of_mortgage_txt = "4 year closed";
} else if($type_of_mortgage==8){
	$type_of_mortgage_txt = "5 year closed";
} else if($type_of_mortgage==9){
	$type_of_mortgage_txt = "7 year closed";
} else if($type_of_mortgage==10){
	$type_of_mortgage_txt = "10 year closed";
} else if($type_of_mortgage==11){
	$type_of_mortgage_txt = "5 year variable rate closed";
} else if($type_of_mortgage==12){
	$type_of_mortgage_txt = "5 year variable rate open";
} else if($type_of_mortgage==13){
	$type_of_mortgage_txt = "3 year ultimate variable rate";
}

if($months>0){
	if($months>1){ $str = "s"; }
	else { $str =""; }
	$payment_term = $years." years, ".$months." month".$str;
} else {
	$payment_term = $years." years";
}

if($frequency==12){ // Monthly Payment
	$pay_frequency_txt = "monthly";
} else if($frequency==24){ // Semi-Monthly Payment
	$pay_frequency_txt = "semi-monthly";
} else if($frequency==26){ // Bi-Weekly Payment
	$pay_frequency_txt = "bi-weekly";
} else if($frequency==52){ // Weekly Payment
	$pay_frequency_txt = "weekly";
}

## Frequency Wise Payment Calculation ##
function calcPay($MORTGAGE, $AMORTYEARS, $AMORTMONTHS, $INRATE, $COMPOUND, $FREQ, $DOWN){
	
	$MORTGAGE 	= $MORTGAGE - $DOWN;
	$compound 	= $COMPOUND/12;
	$monTime 	= ($AMORTYEARS * 12) + (1 * $AMORTMONTHS);
	$RATE 		= ($INRATE*1.0)/100;
	$yrRate 	= $RATE/$COMPOUND;
	$rdefine 	= pow((1.0 + $yrRate),$compound)-1.0;
	
	$PAYMENT 	= ($MORTGAGE*$rdefine * (pow((1.0 + $rdefine),$monTime))) / ((pow((1.0 + $rdefine),$monTime)) - 1.0);
	
	if($FREQ==12){ // Montly
		return $PAYMENT;
	}
	if($FREQ==26){ // Biweekly
		return $PAYMENT/2.0;
	}
	if($FREQ==52){ // Weekly
		return $PAYMENT/4.0;
	}
	if($FREQ==24){ // Semi Monthly
		$compound2 = $COMPOUND/$FREQ;
		$monTime2 = ($AMORTYEARS * $FREQ) + ($AMORTMONTHS * 2);
		$rdefine2 = pow((1.0 + $yrRate),$compound2)-1.0;
		
		$PAYMENT2 = ($MORTGAGE*$rdefine2 * (pow((1.0 + $rdefine2),$monTime2)))/  ((pow((1.0 + $rdefine2),$monTime2)) - 1.0);
		
		return $PAYMENT2;
	}
}


## Amortization Schedule Generation ##
function amortization($MORTGAGE, $AMORTYEARS, $AMORTMONTHS, $INRATE, $COMPOUND, $FREQ, $DOWN){
	
	#-----------------------------------------------------------------------------------------#
	
	$MORTGAGE 	= $MORTGAGE - $DOWN;
	$compound 	= $COMPOUND/12;
	
	$monTime 	= ($AMORTYEARS * 12) + (1 * $AMORTMONTHS);
	
	$RATE 		= ($INRATE*1.0)/100;
	$yrRate 	= $RATE/$COMPOUND;
	$rdefine 	= pow((1.0 + $yrRate),$compound)-1.0;
	
	$PAYMENT 	= ($MORTGAGE*$rdefine * (pow((1.0 + $rdefine),$monTime))) / ((pow((1.0 + $rdefine),$monTime)) - 1.0);
	
	if($FREQ==12){ // Montly
		$term_payment	=	$PAYMENT;
		$total_term 	= 	$monTime;
		
		$rate_factor 	= $rdefine;
	}
	if($FREQ==26){ // Biweekly
		$term_payment=$PAYMENT/2.0;
		$total_term=$monTime*2.0;
		
		$compound2 = $COMPOUND/$FREQ;
		$monTime2 = ($AMORTYEARS * $FREQ) + ($AMORTMONTHS * 2);
		$rdefine2 = pow((1.0 + $yrRate),$compound2)-1.0;
		
		$rate_factor = $rdefine2;	
		
	}
	if($FREQ==52){ // Weekly
		$term_payment=$PAYMENT/4.0;
		$total_term=$monTime*4.0;
		
		$compound2 = $COMPOUND/$FREQ;
		$monTime2 = ($AMORTYEARS * $FREQ) + ($AMORTMONTHS * 4);
		$rdefine2 = pow((1.0 + $yrRate),$compound2)-1.0;
		
		$rate_factor = $rdefine2;
		
	}
	if($FREQ==24){ // Semi Monthly
		$compound2 = $COMPOUND/$FREQ;
		$monTime2 = ($AMORTYEARS * $FREQ) + ($AMORTMONTHS * 2);
		$rdefine2 = pow((1.0 + $yrRate),$compound2)-1.0;
		
		$PAYMENT2 = ($MORTGAGE*$rdefine2 * (pow((1.0 + $rdefine2),$monTime2)))/  ((pow((1.0 + $rdefine2),$monTime2)) - 1.0);
		
		$term_payment=$PAYMENT2;
		$total_term=$monTime2;
		
		$rate_factor = $rdefine2;
	}
	
	// Table Generation
	$principal = $MORTGAGE;
	$schedule_arr = array();
	$this_year_interest_paid	= 0;
	$this_year_principal_paid	= 0;
	$total_spent_this_year		= 0;
	$total_remaining_balance	= 0;
	$current_term = 1;
	$current_year  = 1;
	$total_balence_left=0;
	
	$new_mortgage_year=0;
	$new_mortgage_month=0;
	
	$payments = array();
	
	
	//echo $total_term."\r\n"; 
	
	## Calculate Yearly Basis Amortization ##
	while ($current_term <= $total_term) {  	
		
		$interest_paid     	= 	$principal * $rate_factor;
		
		if($interest_paid > 0){
			$principal_paid    	= 	$term_payment - $interest_paid;
			$remaining_balance 	= 	$principal - $principal_paid;
		} else {
			$principal_paid    	= 0;
			$remaining_balance 	= 0;
		}
		
		$this_year_interest_paid 	= 	$this_year_interest_paid + $interest_paid;
		$this_year_principal_paid 	= 	$this_year_principal_paid + $principal_paid;
		$new_principle_paid	=0;
		
		if(($term_payment>$remaining_balance) && ($remaining_balance>0)){
			
			$new_principle_paid		=	$this_year_principal_paid+$remaining_balance;
			$total_spent_this_year	=	$this_year_interest_paid+$new_principle_paid;
			$remaining_balance		=	0;
			
			$schedule_arr[$current_year]['year'] 			= 	"Year ".$current_year;
			$schedule_arr[$current_year]['payment_made']	= 	$total_spent_this_year;
			$schedule_arr[$current_year]['interest_paid']	= 	$this_year_interest_paid;
			$schedule_arr[$current_year]['principle_paid']	= 	$new_principle_paid;
			$schedule_arr[$current_year]['mortgage_balance']= 	$remaining_balance;
			
			$current_term++;
			break;
			
		} else {
			
			if($current_term%$FREQ==0){
				
				$new_mortgage_year = $current_year;
				
				$total_spent_this_year		=	$this_year_interest_paid+$this_year_principal_paid;
				
				$schedule_arr[$current_year]['year'] 			= 	"Year ".$current_year;
				$schedule_arr[$current_year]['payment_made']	= 	$total_spent_this_year;
				$schedule_arr[$current_year]['interest_paid']	= 	$this_year_interest_paid;
				$schedule_arr[$current_year]['principle_paid']	= 	$this_year_principal_paid;
				$schedule_arr[$current_year]['mortgage_balance']= 	$remaining_balance;
				
				$this_year_interest_paid 	=	0;
				$this_year_principal_paid 	=	0;
				
				$current_year++;	
			}
		}
		
		$principal = $remaining_balance;
		$current_term++;	

		
	}
	
	## Mortgage New Length Calculation ##
	$term_emi_count = $current_term - ($new_mortgage_year * $FREQ);
	
	if($FREQ==12){
		$new_mortgage_month =  (int)($term_emi_count/1);
	} else if($FREQ==24){
		$new_mortgage_month = (int)($term_emi_count/2);
	} else if($FREQ==26){
		$new_mortgage_month = (int)($term_emi_count/2);
	} else if($FREQ==52){
		$new_mortgage_month = (int)($term_emi_count/4);
	}
	
	// Actual Mortgage Length in Days
	$AML_in_days = ($AMORTYEARS*365)+($AMORTMONTHS*30); 
	
	// New Mortgage Length in Days
	$NML_in_days = ($new_mortgage_year*365)+($new_mortgage_month*30); 
	
	/* echo $term_emi_count; 
	echo "\r\n";
	echo $AML_in_days; 
	echo "\r\n";
	echo $NML_in_days; 
	die; */
	
	$MNL_years = ($NML_in_days / 365) ; // Total no of Days / 365 days
	$MNL_years = floor($MNL_years); // Remove all decimals

	$MNL_month 	= ($NML_in_days % 365) / 30; // Total No of Days % 365 days / 30 
	$MNL_month 	= floor($MNL_month); // Remove all decimals
	
	$MNL_days 	= ($NML_in_days % 365) % 30; // the rest of days
	
	if($MNL_month==12){
		$MNL_years = $MNL_years+1;
		$MNL_month = 0; 
	} else {
		$MNL_years = $MNL_years;
		$MNL_month = $MNL_month; 
	}
	
	if($MNL_years>1){
		if($MNL_month==0){
			$new_year_txt	=	$MNL_years." years";
		} else {
			$new_year_txt	=	$MNL_years." years, ";
		}
	} else if($MNL_years != 0 || $MNL_years > 0){
		$new_year_txt	=	$MNL_years." year, ";
	} else {
		$new_year_txt	=	"";
	}
	
	if($MNL_month>1){
		$new_month_txt	=	$MNL_month." months";
	} else if($MNL_month !=0 || $MNL_month > 0){
		$new_month_txt	=	$MNL_month." month";
	} else {
		$new_month_txt	=	"";
	}
	
	// New Mortgage Length 
	$new_mortgage_length_txt = $new_year_txt.$new_month_txt;
	
	// Mortgage Length Faster in Days
	$ML_faster_in_days = $AML_in_days-$NML_in_days+$MNL_days; 
	
	$MNLF_years = 	($ML_faster_in_days / 365) ; // days / 365 days
	$MNLF_years = 	floor($MNLF_years); // Remove all decimals

	$MNLF_month = ($ML_faster_in_days % 365) / 30; // I choose 30.5 for Month (30,31) ;)
	$MNLF_month = floor($MNLF_month); // Remove all decimals

	if($MNLF_years>1){
		
		if($MNLF_month==0){
			$year_faster_txt	=	$MNLF_years." years Faster";
		} else {
			$year_faster_txt	=	$MNLF_years." years, ";
		}
		
	} else if($MNLF_years != 0 || $MNLF_years > 0) {
		if($MNLF_month==0){
			$year_faster_txt	=	$MNLF_years." year Faster";
		} else {
			$year_faster_txt	=	$MNLF_years." year, ";
		}
	} else {
		$year_faster_txt	=	"";
	}
	
	if($MNLF_month>1){
		$month_faster_txt	=	$MNLF_month." months Faster";
	} else if($MNLF_month !=0 || $MNLF_month > 0){
		$month_faster_txt	=	$MNLF_month." month Faster";
	} else {
		$month_faster_txt	=	"";
	}
	
	// New Mortgage Length Faster 
	$new_mortgage_length_faster_txt = $year_faster_txt.$month_faster_txt;
	
	
	// Create the Response Data Set
	$response_data = array(
							'amortization_schedule'	=>	$schedule_arr,
							'new_mortgage_length'	=>	$new_mortgage_length_txt,
							'new_mortgage_boosted'	=>	$new_mortgage_length_faster_txt
						);
	
	return $response_data; // Return the response data
	
}

## Get Amortization Schedule ##
$amortization_schedule = amortization($principal, $years, $months, $interest_rate, $compound, $frequency, $down);



## Create Amortization Schedule Graph => Remaining Balence() vs Year() ##
function createChart($principal, $amortization_schedule){
	
	# ------ Preaparing Amortization Schedule for Graph 
	$dataSet = array();
	foreach($amortization_schedule['amortization_schedule'] as $ds_key=>$ds_val){
		$dataSet[$ds_key] = number_format($ds_val['mortgage_balance'], 2, '.', '');
	}
	
	$values	=	$dataSet; // Graph Data Set
	
	$img_width=800;
	$img_height=400; 
	//$margins=20;
	$margins=50;

	# ---- Find the size of graph by substracting the size of borders
	$graph_width=$img_width - $margins * 2;
	$graph_height=$img_height - $margins * 2; 
	//$graph_height=$img_height - $margins; 
	$img=imagecreate($img_width,$img_height);

	$bar_width=20;
	$total_bars=count($values);
	$gap= ($graph_width- $total_bars * $bar_width ) / ($total_bars +1);

	# -------  Define Colors ----------------
	//$bar_color=imagecolorallocate($img,255,0,0);
	$bar_color=imagecolorallocate($img,234,49,49);
	$background_color=imagecolorallocate($img,237,237,237);
	$border_color=imagecolorallocate($img,255,255,255);
	$line_color=imagecolorallocate($img,0,0,0);
	//$line_color=imagecolorallocate($img,0,0,0);

	# ------ Create the border around the graph ------
	//imagefilledrectangle($img,1,1,$img_width-2,$img_height-2,$border_color);
	imagefilledrectangle($img,0,0,$img_width-0,$img_height-0,$border_color);
	imagefilledrectangle($img,$margins,$margins,$img_width-1-$margins,$img_height-1-$margins,$background_color);


	# ------- Max value is required to adjust the scale -------
	$max_value=max($values);
	
	if($max_value==0.00){ $MaxValue=1; }
	else { $MaxValue=$max_value;}
	
	$ratio= $graph_height/$MaxValue;
	
	//print_r($ratio); die;
	//print_r($amortization_schedule['amortization_schedule']); die;	

	# -------- Create scale and draw horizontal lines  --------
	
	$horizontal_lines=7;
	$horizontal_gap=$graph_height/$horizontal_lines;
	
	$yaxis_str_arr 	= 	array();
	$yaxis_val		=	0;
	$x=2;
	if($principal>0){
		$yaxis_str_arr[1] 	= "$0k";
		$yaxis_frac = $principal/($horizontal_lines-1);
		for($index=$principal;$index > 0;$index-=$yaxis_frac) {
			$yaxis_val 			=  	$yaxis_val+$yaxis_frac;
			$yaxis_str_arr[$x] 	=	"$".(float)number_format((round($yaxis_val)/1000),1)."k";
			$principal = $principal-$yaxis_frac;
			$x++;
		}
	}
	
	for($i=1;$i<=$horizontal_lines;$i++){
		$y=$img_height - $margins - $horizontal_gap * $i ;
		imageline($img,$margins,$y,$img_width-$margins,$y,$line_color);
		//$v=intval($horizontal_gap * $i /$ratio);
		$v = $yaxis_str_arr[$i];
		imagestring($img,4,5,$y-5,$v,$line_color);
	}

	# ----------- Draw the bars here ------
	for($i=0;$i< $total_bars; $i++){ 
		# ------ Extract key and value pair from the current pointer position
		list($key,$value)=each($values); 
		//$margins = 15;
		
		if($key==1 && $value==0){
			$GraphVal=1;
			$BarWidth=150;
			$x1=150 + $gap + $BarWidth;
			$x2=150;
			$ImgHeight=$img_height-40;
			$XAxisText=$img_width/2;
		} else {
			$GraphVal=$value;
			$BarWidth=$bar_width;
			$x1= $margins + $gap + $i * ($gap+$BarWidth) ;
			$x2= $x1 + $BarWidth;
			$ImgHeight=$img_height-40;
			$XAxisText=$x1+3;
		}
		
		/* $x1= $margins + $gap + $i * ($gap+$BarWidth) ;
		$x2= $x1 + $BarWidth;  */
		
		
		//echo $img_height-40; die;
		
		$y1=$margins +$graph_height- intval($GraphVal * $ratio) ;
		$y2=$img_height-$margins;
		//imagestring($img,0,$x1+3,$y1-10,$value,$bar_color);
		imagestring($img,3,$XAxisText,$ImgHeight,$key,$line_color);
		
		imagefilledrectangle($img,$x1,$y1,$x2,$y2,$bar_color);
	}
	
	$y=5;
	$x1= $margins + $gap + $i * ($gap+$BarWidth) ;
	imagestring($img,3,$y ,$img_height-40,"Year",$line_color);
	
	/* $save_img_path = 'amortization_chart/charts_'.time().'.png';
	imagepng($img, $save_img_path, 9); */
	
	$save_img_path = 'amortization_chart/charts_'.time().'.jpg';	
	imagejpeg($img, $save_img_path, 90);
	
	return $save_img_path;
	
}

## Get Frequency wise Payment Value ##
$payment = calcPay($principal, $years, $months, $interest_rate, $compound, $frequency, $down);

## Get Amortization Schedule ##
$amortization_schedule = amortization($principal, $years, $months, $interest_rate, $compound, $frequency, $down);

## Get Amortization Schedule ##
$amortization_chart = createChart($principal, $amortization_schedule);

## Genearate Personalized Mortgage Report PDF ##
function generateReport($principal,$payment_term,$interest_rate, $amortization_schedule, $payment, $frequency, $type_of_mortgage_txt, $amortization_chart,$env){
	include_once './third_party/tcpdf/tcpdf.php';
	
	## Payment as per Payment Frequency ##
	if($frequency==12){ // Monthly Payment
		$pay_frequency_txt = "monthly";
	} else if($frequency==24){ // Semi-Monthly Payment
		$pay_frequency_txt = "semi-monthly";
	} else if($frequency==26){ // Bi-Weekly Payment
		$pay_frequency_txt = "bi-weekly";
	} else if($frequency==52){ // Weekly Payment
		$pay_frequency_txt = "weekly";
	}
	
	// Report Date: Format-> January 20, 2020
	$report_date = date('F d, Y'); 
	
	## PDF Raw HTML ##
	$html='<html lang="en">
	<body style=" margin:0px; padding:0px; font-size:12px; color:#010101; line-height:18px; background:#FFFFFF; min-height:100%;">
	<!--header start-->
	<table>
		<tr>
			<td style="text-align: left;vertical-align:text-top;"><a href="#"><img src="assets/images/logo.png" alt="" style="width:160px;height:50px;"></a></td>
			<td style="text-align:right;vertical-align:text-top;"><img src="assets/images/user.png" alt="" width="60" height="65"></td>
		</tr>
		
		<tr style="vertical-align: bottom;">
			<td>
				<table style="width: 100%;text-align: left;border-bottom:0.5px solid #030303;">
					<tr style="font-size: 13px; margin: 0px;"><td>Personalized Mortgage Report</td></tr>
					<tr style="font-size: 10px; margin-bottom:20px; color:#717d7e;"><td>'.$report_date.'</td></tr>
				</table>
			</td>
			<td style="text-align: right;font-size: 9px;border-bottom:0.5px solid #030303;">
				<table style="width: 100%;color: #000000;">
					<tr><td><b>Phone:</b> <span style="color:#717d7e;">604.318.1292</span></td></tr>
					<tr><td><b>Website:</b> <span style="color:#717d7e;">bc-mortgage-broker.ca</span></td></tr>
				</table>
			</td>
		</tr>
	</table>	
	<!--header end-->';
	
	
	$html .='<main style="padding:20px 0px;">';
  
	$html .='<table style="width: 100%;">
		<tr><td>&nbsp;</td></tr>
		<tr style="font-size: 13px; margin: 0px; color:#2c3e50;"><td>Mortgage details</td></tr>
	</table>';
	
	$html .='<table style="width: 100%;">
		<tr><td>&nbsp;</td></tr>
		<tr style="font-size: 10px; margin: 0px; color:#707b7c;"><td>Payments</td></tr>
		<tr style="font-size: 12px; margin: 0px;"><td>$ '.number_format(round($payment))." ".$pay_frequency_txt.'</td></tr>
	</table>';
	
	$html .='<table style="width: 100%;">
		<tr><td>&nbsp;</td></tr>
		<tr style="font-size: 10px; margin: 0px; color:#707b7c;"><td>Mortgage amount</td></tr>
		<tr style="font-size: 12px; margin: 0px;"><td>$ '.number_format(round($principal)).'</td></tr>
	</table>';
	
	if(!empty($amortization_schedule['new_mortgage_boosted'])){
		$length_boosted ='   <label style="color:green; font-size:8px; border:1px solid green; text-align:center; font-weight:bold;">'.$amortization_schedule['new_mortgage_boosted'].'</label>';
	} else {
		$length_boosted ="";
	}
	
	$html .='<table style="width: 100%;">
				<tr><td>&nbsp;</td></tr>
				<tr style="font-size: 10px; margin: 0px; color:#707b7c;">
					<td>Final mortgage length</td>
				</tr>
				<tr style="font-size: 12px; margin: 0px;">
					<td>'.$amortization_schedule['new_mortgage_length'].$length_boosted.'</td>
				</tr>
			</table>';
	
	$html .='<table style="width: 100%;">
				<tr><td>&nbsp;</td></tr>
				<tr style="font-size: 10px; margin: 0px; color:#707b7c;"><td>Interest rate / Type of mortgage</td></tr>
				<tr style="font-size: 12px; margin: 0px;"><td>'.$interest_rate.'% / '.$type_of_mortgage_txt.'</td></tr>
			 </table>';	
	  
	$html .='<table style="width: 100%;">
				<tr><td>&nbsp;</td></tr>
				<tr style="font-size: 13px; margin: 0px; color:#2c3e50;"><td>Amortization graph</td></tr>
			</table>';
			
	$html .='<table style="width: 100%;">
				<tr><td><img src="'.$amortization_chart.'" style="width:550px; height:245px;" alt="amortization graph"></td></tr>
			</table>';	

	$html .='<table style="width: 100%;">
				<tr><td>&nbsp;</td></tr>
				<tr style="font-size: 13px; margin: 0px; color:#2c3e50;"><td>Amortization schedule</td></tr>
			</table>';	
	$html .='<table style="width: 100%;">
				<tr><td>&nbsp;</td></tr>
			</table>';	
			
	$html .='<table style="border-collapse: collapse; text-align: left; width: 100%;">
				<tr>
					<th style="font-size: 11px; padding-bottom: 15px; border-bottom: 0.5px solid #030303;">Years</th>
					<th style="font-size: 11px; padding-bottom: 15px; border-bottom: 0.5px solid #030303;">Payments made</th>
					<th style="font-size: 11px; padding-bottom: 15px; border-bottom: 0.5px solid #030303;">Interest paid</th>
					<th style="font-size: 11px; padding-bottom: 15px; border-bottom: 0.5px solid #030303;">Principal paid</th>
					<th style="font-size: 11px; padding-bottom: 15px; border-bottom: 0.5px solid #030303;">Balance</th> 
				</tr>
				<tr><td>&nbsp;</td></tr>';
	  
					if(!empty($amortization_schedule['amortization_schedule'])){ 
						$total_payment_made=0;
						$total_interest_paid=0;
						$total_principle_paid=0;

						foreach($amortization_schedule['amortization_schedule'] as $schedule){
						
							// Amortization Schedule Row(s)
							$html .= '<tr>
										<td style="text-align: left; font-size: 10px; padding: 15px 0px; color: #373737;">'.$schedule['year'].'</td>
										<td style="text-align: left; font-size: 10px; padding: 15px 0px; color: #373737;">$'.number_format($schedule['payment_made'], "2", ".", ",").'</td>
										<td style="text-align: left; font-size: 10px; padding: 15px 0px; color: #373737;">$'.number_format($schedule['interest_paid'], "2", ".", ",").'</td>
										<td style="text-align: left; font-size: 10px; padding: 15px 0px; color: #373737;">$'.number_format($schedule['principle_paid'], "2", ".", ",").'</td>
										<td style="text-align: left; font-size: 10px; padding: 15px 0px; color: #373737;">$'.number_format($schedule['mortgage_balance'], "2", ".", ",").'</td>
									</tr>';
							
							
							// Total Payment Sums
							$total_payment_made		=	$total_payment_made + $schedule['payment_made'];
							$total_interest_paid	=	$total_interest_paid + $schedule['interest_paid'];
							$total_principle_paid	=	$total_principle_paid + $schedule['principle_paid'];
						}
						
						// Total Sum Assured Row
						$html .= '<tr><td>&nbsp;</td></tr>
								<tr>
									<td style="font-size: 11px; padding-bottom: 15px; border-top: 0.5px solid #030303;">Totals</td>
									<td style="font-size: 11px; padding-bottom: 15px; border-top: 0.5px solid #030303;">$'.number_format($total_payment_made, "2", ".", ",").'</td>
									<td style="font-size: 11px; padding-bottom: 15px; border-top: 0.5px solid #030303;">$'.number_format($total_interest_paid, "2", ".", ",").'</td>
									<td style="font-size: 11px; padding-bottom: 15px; border-top: 0.5px solid #030303;">$'.number_format($total_principle_paid, "2", ".", ",").'</td>
									<td style="font-size: 11px; padding-bottom: 15px; border-top: 0.5px solid #030303;">$ 0</td> 
								</tr>';
								
								

					}
	  
		
	$html .= '</table></div></main></body></html>';

		
		
		// Intialize TCPDF and Generate the PDF
		$pdf_dir_path 	=  __DIR__ .'/amortization_report/Personalized_Mortgage_Report.pdf';
		
		if($env==1){ // Live
			$pdf_file_path	=  "http://hswebdevelopment.com/mortgage-calculator/amortization_report/Personalized_Mortgage_Report.pdf";
		} else if($env==2){ // Local
			$pdf_file_path	=  "http://localhost/mortgage-calculator/amortization_report/Personalized_Mortgage_Report.pdf";
		} else if($env==3){ // Test
			$pdf_file_path	=  "http://hswebdevelopment.com/mortgage-calculator/test/amortization_report/Personalized_Mortgage_Report.pdf";
		} 
		
		//http://hswebdevelopment.com/mortgage-calculator/
		if (file_exists($pdf_dir_path)){ unlink($pdf_dir_path); }
		$tcpdf = new TCPDF(); 
		$tcpdf->SetFont('times', '', 10);
		$tcpdf->SetPrintHeader(false);
		$tcpdf->SetPrintFooter(false);
		// reset font stretching
		//$tcpdf->setFontStretching(100);
		// reset font spacing
		$tcpdf->setFontSpacing(0);
		$tcpdf->AddPage('P','A4');
		//$tcpdf->writeHTML($html, true, 0, true, 0);
		$tcpdf->writeHTML($html, true, false, false, false, '');
		$tcpdf->lastPage();
		$tcpdf->Output($pdf_dir_path, 'F');
		
		return $pdf_file_path;
		
}

## Get the Amortization Report ##
$amortization_report = generateReport(
										$principal,
										$payment_term,
										$interest_rate, 
										$amortization_schedule, 
										$payment, 
										$frequency, 
										$type_of_mortgage_txt, 
										$amortization_chart,
										3
									);
									


## Get Amortization Schedule ##
$amortization_details = amortization($principal, $years, $months, $interest_rate, $compound, $frequency, $down);

## Response and Display Data ##
$response_data = array(
						'status'=>"success",
						'display_payment'=>'<i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<strong>'.number_format(round($payment)).' '.$pay_frequency_txt.'</strong>', 
						'display_mortgage_amount'=>'<i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<strong>'.number_format($principal).'</strong>', 
						'display_payment_term'=>'<strong>'.$amortization_details['new_mortgage_length'].'</strong>', 
						'display_payment_term_boost'=>$amortization_details['new_mortgage_boosted'], 
						'mortgage_report_path'=>$amortization_report
					);

echo json_encode($response_data);
	
}

?>