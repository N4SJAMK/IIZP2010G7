<?php

function findAll($collection) {
  //echo "Funtions initialized!<br>";
  $result = $collection->find();
  //echo "Find done!<br>";
  return $result;
}

function find($collection, $search) {
  //echo "Funtions initialized!<br>";
  $result = $collection->find(array('email' => "$search"));
  //echo "Find done!<br>";
  return $result;
}

function insert($collection,$email,$password) {
  $collection->insert(array(
    'email' => $email,
    'password' => $password
    // !!! Password tarvitsee hashauksen, pitää kysyä minkä
  ));
}

function update($collection,$emailOld,$passwordOld,$emailNew,$passwordNew) {
  $result = collection->find(array('email' => "$emailOld"));
  foreach ($result as $document) {
    $id = $document['_id'];
  }
  $collection->update(
    array('_id' => $id),
    array(
      'email' => "$emailNew",
      'password' => "$passwordNew"
    )
  );
}

?>