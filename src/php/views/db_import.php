<?php include '../header.php';?>
<?php include '../../../mongo/db-init.php';?>
<?php include '../../../mongo/functions.php';?>
<?php include '../../../mongo/mongoundumper.php';?>

<div data-role="page">
<body>

<div data-role="header"  id="navtop">
    <h1>Admin Panel</h1>
  <a href="logout.php" class="ui-btn ui-btn-inline ui-mini ui-corner-all ui-btn-icon-right ui-icon-action">Logout</a>
  <b><label data-inline="true" style="position: absolute;
  top: .24em; right: .28em;" >Choose theme: 
    <a href="#" data-role="button" data-inline="true"  data-theme="a" onclick="$.mobile.changeGlobalTheme('a');">Theme a</a>
    <a href="#" data-role="button" data-inline="true" data-theme="b" onclick="$.mobile.changeGlobalTheme('b');">Theme b</a>
    <label></b>
	 <div data-role="navbar" data-grid="c" >
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
<h3>Pick exported zip file to import</h3>

  
  <form enctype="multipart/form-data" method="post" action="db_import.php">
    <input name="uploaded_file" type="file" size="50"><br>
    <input type="submit" value="Submit" name="backupped">
  </form>
  <?php
  
if(isset($_POST['backupped'])) {



$fileName = $_FILES["uploaded_file"]["name"];//the files name takes from the HTML form
$fileTmpLoc = $_FILES["uploaded_file"]["tmp_name"];//file in the PHP tmp folder
$fileType = $_FILES["uploaded_file"]["type"];//the type of file 
$fileSize = $_FILES["uploaded_file"]["size"];//file size in bytes
$fileErrorMsg = $FILES["uploaded_file"]["error"];//0 for false and 1 for true
$target_path = "uploads/" . basename( $_FILES["uploaded_file"]["name"]); 

echo "file name: $fileName </br> temp file location: $fileTmpLoc<br/> file type: $fileType<br/> file size: $fileSize<br/> file upload target: $target_path<br/> file error msg: $fileErrorMsg<br/>";

//START PHP Image Upload Error Handling---------------------------------------------------------------------------------------------------

    if(!$fileTmpLoc)//no file was chosen ie file = null
    {
        echo "ERROR: Please select a file before clicking submit button.";
        exit();
    }
    else
        if(!$fileSize > 16777215)//if file is > 16MB (Max size of MEDIUMBLOB)
        {
            echo "ERROR: Your file was larger than 16 Megabytes";

            unlink($fileTmpLoc);//remove the uploaded file from the PHP folder
            exit();
        }
        else
            if(!preg_match("/\.(gif|jpg|jpeg|png)$/i", $fileName))//this codition allows only the type of files listed to be uploaded
            {
                echo "ERROR: Your image was not .gif, .jpg, .jpeg or .png";
                unlink($fileTmpLoc);//remove the uploaded file from the PHP temp folder
                exit();
            }
            else
                if($fileErrorMsg == 1)//if file uploaded error key = 1 ie is true
                {
                    echo "ERROR: An error occured while processing the file. Please try again.";
                    exit();
                }


    //END PHP Image Upload Error Handling---------------------------------------------------------------------------------------------------------------------


    //Place it into your "uploads" folder using the move_uploaded_file() function
    $moveResult = move_uploaded_file($fileTmpLoc, $target_path);

    //Check to make sure the result is true before continuing
    if($moveResult != true)
    {
        echo "ERROR: File not uploaded. Please Try again.";
        unlink($fileTmpLoc);//remove the uploaded file from the PHP temp folder

    }
    else
    {
        //Display to the page so you see what is happening 
        echo "The file named <strong>$fileName</strong> uploaded successfully.<br/><br/>";
        echo "It is <strong>$fileSize</strong> bytes.<br/><br/>";
        echo "It is a <strong>$fileType</strong> type of file.<br/><br/>";
        echo "The Error Message output for this upload is: $fileErrorMsg";
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