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
	// !! Update user toimii, mut password hashauksen tarvitsee, muuttaa kyllä salasanan kantaan.
	// Kirjautuminen ei onnistu ilman salasanan hashiä.
  $result = $collection->find(array('email' => "$emailOld"));
  foreach ($result as $document) {
    $id = $document['_id'];
    $password = $document['password'];
    $email = $document['email'];
    //echo "Updating user id: $id";
  }

  var_dump($id);
  var_dump($password);
  var_dump($passwordNew);
  var_dump($email);
  
  
  
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
  var_dump($collection->findOne(array('_id' => $id)));
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

function deleteAdmin($admins,$email) {
  /*
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
  */
  $admins->remove(array('email' => "$email"));
}

?>