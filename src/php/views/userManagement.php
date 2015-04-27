<?php include '../header.php';?>
<?php include '../../../mongo/db-init.php';?>
<?php include '../../../mongo/functions.php';?>
<div data-role="page" id="userManagement">
<body>
<div data-role="header"  id="navtop">
    <h1>Admin Panel</h1>
     <a href="logout.php" class="ui-btn ui-btn-inline ui-mini ui-corner-all ui-btn-icon-right ui-icon-action">Logout</a>
	 <b><label data-inline="true" style="position: absolute;
  top: .24em; right: .28em;" >Choose theme: 
    <a href="#" data-role="button" data-inline="true" data-theme="a" onclick="$.mobile.changeGlobalTheme('a');">Theme a</a>
    <a href="#" data-role="button" data-inline="true"  data-theme="b" onclick="$.mobile.changeGlobalTheme('b');">Theme b</a>
    <label></b>
	 <div data-role="navbar" data-grid="c">
    <ul>
        <li><a href="status.php">Status</a></li>
        <li><a href="userManagement.php" class="ui-btn-active">User Management</a></li>
        <li><a href="databaseManagement.php">Database Management</a></li>
        <li><a href="adminSettings.php">Admin Settings</a></li>
    </ul>
</div><!-- /navbar -->
</div>

<div id="container" data-role="main" class="ui-content">

<h1>User Management</h1>
<form>
    <input id="filterTable-input" data-type="search">
</form>
<table data-role="table" id="movie-table" data-filter="true" data-input="#filterTable-input" class="ui-responsive">
<thead>
	<tr>
		<th data-priority="1">Email</th>
		<th data-priority="2">ID</th>
		<th data-priority="3">Boards</th>
		<th data-priority="4">Delete User</th>
		<th data-priority="5">Change password</th>
	</tr>
</thead>
<tbody>

<?php 
$kayttajat = findAll($users);
$taulut = findAll($boards);

foreach ($kayttajat as $document) {
  echo "<tr>";
	$email = $document['email'];
		echo "<td><a href=''>$email</a></td>";
	$id = $document['_id'];
		echo "<td>$id</td>";
	$password = $document['password'];
	//echo "$password\n";
		
	
	echo "<td>";
		$laskuri = 0;
		foreach ($taulut as $document) {
			if ($id == $document['createdBy']) {
			$laskuri++; 
			}
			
		}
		echo "$laskuri";
	echo "</td>";
  
  echo "<td><a href='deleteUser.php?email=$email'><button data-icon='delete' data-iconpos='notext' style='margin-left:30px;'></button></a></td>";
	
echo "<td><a  href='#popupLogin' data-id='".$id."' data-email='".$email."' email='".$email."' id='".$id."'  data-rel='popup' data-overlay-theme='a' data-position-to='window' data-transition='slide' class='password ui-btn ui-corner-all ui-shadow ui-icon-alert ui-btn-icon-notext' style='margin-left:50px;'></a></td>";
  echo "</tr>";
 
}
	if (isset($_POST['submit'])) {
		if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z]{8,20}$/', $_POST['pass'])) {
			echo "<p style='color: #B22222;font-size: 11px;border-bottom: 1px solid #FFF;padding-bottom: 8px;'>Passwords must be at least 8 characters long. And it has to contain at least one letter and one number.</p>";
			header("Refresh: 5; url=userManagement.php");
		}
	else {
				update($users,$_POST['email'],"",$_POST['pass']);
					echo "<p style='color: #228B22;font-size: 11px;border-bottom: 1px solid #FFF;padding-bottom: 8px;'>Password Updated successfully</p>";
					header("Refresh: 5; url=userManagement.php");
				}
	}
echo "</tbody>";
echo "</table>";
		
?> 
<div data-role="popup" id="popupLogin"  class="ui-corner-all">

    <form method='POST' action='userManagement.php'>
        <div style="padding:10px 20px;">
            <h3>Please Enter a new password</h3>
			<label for="email_post" class="ui-hidden-accessible">Password:</label>
			 <input name="email" id="email_post" value="" readonly>
            <label for="pw" class="ui-hidden-accessible">Password:</label>
            <input name="pass" id="pw" value="" placeholder="New password" type="password" required >
			<button aria-disabled="false" class="ui-btn-hidden" type="submit" name="submit" value="submit" >Confirm</button>
		</div>
	</form>	
</div>


</div>
</body>

<script>
$(".password").click(function( event ){
 
	
	var $form = $(this),
	id = $form.data("id"),
	email = $form.data("email"),
	url = $form.attr("action");
	

	$('#popupLogin').attr('data-id' , id);
	$('#popupLogin').attr('data-email' , email);
	
	var elem = document.getElementById("email_post")
	elem.value = email;
	
	

		
});
$.mobile.changeGlobalTheme = function(theme)
{
    // These themes will be cleared, add more
    // swatch letters as needed.
    var themes = " a b";

    // Updates the theme for all elements that match the
    // CSS selector with the specified theme class.
    function setTheme(cssSelector, themeClass, theme)
    {
        $(cssSelector)
            .removeClass(themes.split(" ").join(" " + themeClass + "-"))
            .addClass(themeClass + "-" + theme)
            .attr("data-theme", theme);
    }

    // Add more selectors/theme classes as needed.
    setTheme(".ui-mobile-viewport", "ui-overlay", theme);
    setTheme("[data-role='page']", "ui-body", theme);
    setTheme("[data-role='main']", "ui-body", theme);
    setTheme("[data-role='header']", "ui-bar", theme);
    setTheme("[data-role='listview'] > li", "ui-bar", theme);
    setTheme(".ui-btn", "ui-btn-up", theme);
    setTheme(".ui-btn", "ui-btn-hover", theme);
};

</script>
