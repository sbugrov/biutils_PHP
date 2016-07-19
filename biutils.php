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

function linearSpectrum($peptide) {
  $amino_acid_mass = array( 'G' => 57,  'A' => 71,  'S' => 87,  'P' => 97, 'V' => 99,  'T' => 101, 'C' => 103, 'I' => 113, 'L' => 113, 'N' => 114, 'D' => 115, 'K' => 128, 'Q' => 128, 'E' => 129,'M' => 131, 'H' => 137, 'F' => 147, 'R' => 156, 'Y' => 163, 'W' => 186 );
  $prefix_mass = array(0);
  
  for ($i = 1; $i <= strlen($peptide); $i++){
    array_push($prefix_mass, $prefix_mass[$i-1] + $amino_acid_mass[$peptide[$i-1]]);
  }
  
  for ($i = 1; $i <= strlen($peptide); $i++){
    for ($j = $i + 1; $j <= strlen($peptide); $j++){
      array_push($prefix_mass, $prefix_mass[$j] - $prefix_mass[$i]);
    }
  }
  
  asort($prefix_mass);
  
  return $prefix_mass;
}

function buildDeBruijnGraph($edges) {
  $ins = array();
  
  foreach ($edges as $edge) {
    array_push($ins, substr($edge,0,strlen($edge)-1));
  }
  
  $unque_ins = array_unique($ins);
  $de_bruijn_graph = array();
  
  foreach ($unque_ins as $unque_in) {
    foreach ($edges as $edge) {
      if (substr($edge,0,strlen($edge)-1) == $unque_in) {
        $de_bruijn_graph[$unque_in] = substr($edge,1,strlen($edge));
      }
    }
  }
  
  return $de_bruijn_graph;
}

?>
