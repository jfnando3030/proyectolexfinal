<?php

	return array(
		/** set your paypal credential **/
		'client_id' =>'AQOOVJMX11dgfHwWph5lUbWiNhULS64IQXOl6Nknps2rLVBJ-T4pv2BG4ALb70dQzlCmIqau23Rc2uqn',
		'secret' => 'EMfmHC-uhsknxySA9RGg-oJm_l6JTvFsgifuxO3-KLfJKbw-kpp-UfRZ76GY58ykuajr94NzW_uwrFh5',
		/**
		* SDK configuration 
		*/
		'settings' => array(
			/**
			* Available option 'sandbox' or 'live'
			*/
			'mode' => 'live',
			/**
			* Specify the max request time in seconds
			*/
			'http.ConnectionTimeOut' => 1000,
			/**
			* Whether want to log to a file
			*/
			'log.LogEnabled' => true,
			/**
			* Specify the file that want to write on
			*/
			'log.FileName' => storage_path() . '/logs/paypal.log',
			/**
			* Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
			*
			* Logging is most verbose in the 'FINE' level and decreases as you
			* proceed towards ERROR
			*/
			'log.LogLevel' => 'FINE'
		),
	);

?>
