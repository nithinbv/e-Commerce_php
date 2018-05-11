<?php
function displayAlert($text, $type) {
echo "<div class=\"alert alert-".$type."\" role=\"alert\">
        <p>".$text."</p>
      </div>";
}
?>