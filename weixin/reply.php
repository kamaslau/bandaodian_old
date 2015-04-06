<?php
	if($msgtype == 'news'):
		$resultStr = sprintf($tplStart . $templates['news'] . $tplEnd , $msgtype , 1 , $content);
		
	else:
		$resultStr = sprintf($tplStart . $templates[$msgtype] . $tplEnd , $msgtype , $content);
	
	endif;
	
	echo $resultStr;