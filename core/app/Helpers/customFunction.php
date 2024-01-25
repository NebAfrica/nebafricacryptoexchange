<?php

/********************************
Kep your custom php functions here, alll functions added here would be
loadded and can be used in Blades, Models and Coontroller 
Usage: 


//this function prints the current date
if(!function_exists('printYear')){
	function printYear()
  {
      return date('Y', time());
  }
}

//calling function,
Blade: {{ printYear() }} or <?php echo printYear(); ?>

Models: printYear();

Controllers and helpers printYear();

**********************************************/