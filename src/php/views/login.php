<?php include '../../../mongo/db-init.php';?>
<?php include '../../../mongo/functions.php';?>
<head>
<link rel="stylesheet" type="text/css" href="../../css/mystyle.css">
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>  
</head>




<div data-role="page" >
<body>

<div data-role="header" id="navtop">
    <h1>Admin Panel</h1>
      <b><label data-inline="true" style="position: absolute;
  top:0; right: .28em;" >Choose theme: 
    <a href="#" data-role="button" data-inline="true" data-theme="a" onclick="$.mobile.changeGlobalTheme('a');">Theme a</a>
    <a href="#" data-role="button" data-inline="true" data-theme="b" onclick="$.mobile.changeGlobalTheme('b');">Theme b</a>
    <label></b>
</div>

<div id="container" data-role="main" class="ui-content">
<h1 style="text-align: center;">Login</h1>

  <form method='POST' action='login.php'>
    <div class ="loginform" style="text-align: center; max-width: 400px; margin-left: auto; margin-right: auto;">
      <input name="email" id="textinput-fc" type="text" value="" placeholder="Email" required>
      <input name="password" id="textinput-fc" type="password" value="" placeholder="Password" required>
      <input type="submit" value="Ok" name="submit">
    </div>
  </form>

<?php
session_start();

if (isset($_POST['submit'])) {
  $admins = findAll($admins);
  foreach ($admins as $admin) {
    if ($_POST['email'] == $admin['email'] && $_POST['password'] == $admin['password']) {
        $_SESSION['loggedIn'] = true;
		$_SESSION['email'] = $admin['email'];
        header('Location: status.php');
    }
	else {
		  echo "<p style='color: #B22222;font-size: 20px;border-bottom: 1px solid #FFF;padding-bottom: 8px;'>Invalid username or password!</p>";
		  header("Refresh: 5; url=userManagement.php");
	  }
    exit();
  }
}
?>
</div>
</div>
<script>
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
</body>

