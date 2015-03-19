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

function update($collection,$emailOld,$emailNew,$passwordNew) {
  $result = $collection->find(array('email' => "$emailOld"));
  foreach ($result as $document) {
    $id = $document['_id'];
    $password = $document['password'];
    $email = $document['email'];
    echo "Updating user id: $id";
  }
  if ($emailNew === '') {
    $emailNew = $email;
  }
  if ($passwordNew === '') {
    $passwordNew = $password;
  }
  
  $collection->update(
    array('_id' => $id),
    array(
      'email' => "$emailNew",
      'password' => "$passwordNew"
    )
  );
}

function deleteUser($collection,$email) {
  echo "hoho";
}

?>