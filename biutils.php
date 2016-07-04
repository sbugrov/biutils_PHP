<?php

function kmers($k, $text){
  /* Solve the String Composition Problem.
  Inputs: 
  k: A length of k-mers, an integer
  text: a sequence, a string.
  Output: An array of k-mers sorted in lexicographic order.
  */
  
  $kmers = array();
  
  for ($i = 0; $i < (strlen($text) - $k + 1); $i++){
    array_push($kmers,substr($text,$i,$k));
  }
  
  asort($kmers);
  
  return $kmers;

}

function genome_path($path){
  /* Reconstruct a string from its genome path.
  Input: A sequence of k-mers such that the last k - 1 symbols 
  of each k-meri are equal to the first k-1 symbols of kmeri+1.
  Output: A sequence of length k+n-1 built from overlapping k-mers.
  */
  
  $new_path = array();
  
  foreach ($path as &$value) {
    array_push($new_path,substr($value,0,1));
  }

  $new_path = implode('',$new_path);
  $new_path .= substr(end($path),1,strlen(end($path))-1);
  
  return $new_path;
}

?>
