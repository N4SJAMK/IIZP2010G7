<?php include '../header.php';?>
<?php include '../../../mongo/db-init.php';?>
<?php include '../../../mongo/functions.php';?>

<div data-role="page" >
<body>

<div data-role="header" id="navtop">
    <h1>Admin Panel</h1>
  <a href="logout.php" class="ui-btn ui-btn-inline ui-mini ui-corner-all ui-btn-icon-right ui-icon-action">Logout</a>
   <b><label data-inline="true" style="position: absolute;
  top: .24em; right: .28em;" >Choose theme: 
    <a href="#" data-role="button" data-inline="true"  data-theme="a" onclick="$.mobile.changeGlobalTheme('a');">Theme a</a>
    <a href="#" data-role="button" data-inline="true" data-theme="b" onclick="$.mobile.changeGlobalTheme('b');">Theme b</a>
    <label></b>
	 <div data-role="navbar" data-grid="c">
    <ul>
        <li><a href="status.php" >Status</a></li>
        <li><a href="userManagement.php" >User Management</a></li>
        <li><a href="databaseManagement.php" class="ui-btn-active">Database Management</a></li>
        <li><a href="adminSettings.php">Admin Settings</a></li>
    </ul>
</div><!-- /navbar -->
</div>

<div id="container" data-role="main" class="ui-content">

<h1>Database Management</h1>
 <ul class="ui-listview ui-listview-inset ui-corner-all ui-shadow" data-role="listview" data-inset="true">
      <li class="ui-li-static ui-body-inherit ui-first-child" data-role="divider">Choose to proceed</li>
      <li class="ui-li-has-alt ui-li-has-thumb">
        <a class="ui-btn" href="db_export.php">
        <img src="../../Database_Upload.png">
        <h2>Export Data</h2>
        <p>Use this tool to export data from your current MongoDB</p>
        </a>
        <a title="Export Data" class="ui-btn ui-btn-icon-notext ui-icon-carat-r" href="db_export.php"></a>
      </li>
      <li class="ui-li-has-alt ui-li-has-thumb ui-last-child" style="background-color:#500000 ">
        <a class="ui-btn" href="db_import.php">
        <img src="../../Database_Import.png">
        <h2>Import Data</h2>
        <p>Use this tool to Import data from your computer to MongoDB</p>
        </a>
        <a title="Import Data" class="ui-btn ui-btn-icon-notext ui-icon-carat-r" href="db_import.php"></a>
      </li>
    </ul>
  
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