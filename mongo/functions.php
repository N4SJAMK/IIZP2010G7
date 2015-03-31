<?php

function findAll($collection) {
  //echo "Funtions initialized!<br>";
  $result = $collection->find();
  //echo "Find done!<br>";
  return $result;
}

function findByEmail($collection, $search) {
  //echo "Funtions initialized!<br>";
  $result = $collection->find(array('email' => "$search"));
  //echo "Find done!<br>";
  return $result;
}

function findBoardsById($collection, $search) {
  //echo "Funtions initialized!<br>";
  $result = $collection->find(array('createdBy' => "$search"));
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

function deleteUser($users,$email,$boards,$tickets) {

  $resultid = $users->find(array('email' => "$email"));
  foreach ($resultid as $userresult) {
    $userid = $userresult['_id'];

    $resultboards = $boards->find(array('createdBy' => new MongoID("$userid")));
    foreach ($resultboards as $boardresult) {
      $boardid = $boardresult['_id'];
      
      $tickets->remove(array('board' => new MongoID("$boardid")));
    }
  }
  $boards->remove(array('createdBy' => new MongoID("$userid")));
  $users->remove(array('_id' => new MongoID("$userid")));
}

?>