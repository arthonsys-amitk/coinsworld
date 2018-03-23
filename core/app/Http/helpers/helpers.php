<?php
use App\Gsetting;
use Illuminate\Support\Facades\Log;

if (! function_exists('send_email')) {
    
    function send_email( $to, $name, $subject, $message)
    {
        $settings = Gsetting::first();
        $template = $settings->emailMessage;
        $from = $settings->emailSender;
		if($settings->emailNotify == 1)
		{

			$headers = "From: $settings->webTitle <$from> \r\n";
			$headers .= "Reply-To: $settings->webTitle <$from> \r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

			$mm = str_replace("{{name}}",$name,$template);     
			//$message = str_replace("{{message}}",$message,$mm); 

			if (mail($to, $subject, $message, $headers)) {
			  // echo 'Your message has been sent.';
			  Log::info("Your email message has been sent to: $to");
			} else {
			 //echo 'There was a problem sending the email.';
			 Log::info("Your email message COULD NOT be sent to: $to due to some error");
			}

		}

    }
}

if (! function_exists('send_sms')) 
{
    
    function send_sms( $to, $message)
    {
        $settings = Gsetting::first();
		if($settings->smsNotify == 1)
		{

			$sendtext = urlencode("$message");
		    $appi = $settings->smsApi;
			$appi = str_replace("{{number}}",$to,$appi);     
			$appi = str_replace("{{message}}",$sendtext,$appi); 
			$result = file_get_contents($appi);
		}

    }
}

if (! function_exists('convert_to_timezone')) 
{    
    function convert_to_timezone( $datetime, $new_timezone )
    {
        $oldtmz = date_default_timezone_get();
		$date = new DateTime($datetime, new DateTimeZone($oldtmz));
		$date->setTimezone(new DateTimeZone($new_timezone));
		$local_time = $date->format('Y-m-d H:i:s');
		return $local_time;
    }
}