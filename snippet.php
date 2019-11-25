<?php
function snippet($query,$myurl)
{

$string = strip_tags(file_get_contents($myurl));
//$string = strip_tags(file_get_contents($myurl));
//$string = preg_replace('/windowperformance\w+/', '', $string);
$string = preg_replace('/"text|content|type|":|,|/', '', $string);
$string = preg_replace("/[^A-Za-z0-9.$#%&*\-\'\", ]/", '.', $string);
$string = preg_replace("/VideoObject/", '.', $string);


/*include_once 'parse.php';
$myurl = ''.$myurl.'';
$string = parse($myurl);
*/


//echo $string;
$searchlocation = $query;
$queryArr = explode(' ', $searchlocation);
$sentences = explode('.', $string);
$matched = array();
foreach($sentences as $sentence){
    $offset = stripos($sentence, $searchlocation);
    if($offset)
	{
	 $matched[] = $sentence;
	break;
 	}

}

if ($matched[0] == NULL){
	$matchedNoOrder = array();
	$sentences2 = $sentences;
		foreach($queryArr as $term)
		{
		$matchedNoOrder = [];
		  foreach($sentences2 as $sentence){
		
			$offset = NULL;
			$offset = stripos($sentence, $term);
			if($offset){$matchedNoOrder[] = $sentence;}
		   }
		   $sentences2 = $matchedNoOrder;
		}
	if($matchedNoOrder == NULL){	
		$sentences3 = $sentences;
		foreach($queryArr as $term)    
                {
		  
                  foreach($sentences3 as $sentence){
		        $offset = NULL;
                        $offset = stripos($sentence, $term);
                        if($offset){$singleMatch= $sentence; break;}
	        	return $sentence;
        	   }
			if($singleMatch == NULL){$answer= "none"; return $answer;}

                }
	}
	else{
		return $matchedNoOrder[0]; 
	}
}
else{
return $matched[0];
}
}
?>

