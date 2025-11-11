<?php
$folder = "notes/";
if(!is_dir($folder)) mkdir($folder);

// CREATE
if(isset($_POST['create'])){
    $filename = $folder . $_POST['filename'] . ".txt";
    file_put_contents($filename, $_POST['content']);
}

// READ
$files = scandir($folder);
?>

<form method="post">
  <input type="text" name="filename" placeholder="Note name">
  <textarea name="content" placeholder="Write something..."></textarea>
  <button name="create">Save</button>
</form>

<ul>
<?php foreach($files as $file){
  if($file != '.' && $file != '..'){
    echo "<li>$file - " . filesize($folder.$file) . " bytes</li>";
  }
} ?>
</ul>
