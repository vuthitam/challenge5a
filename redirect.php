
<?php
function back() {
    echo '<script type="text/javascript"> 
    if(history.length != 0) {
        history.go(-1);
    }
    </script>';
}
function backback() {
    echo '<script type="text/javascript"> 
    if(history.length != 0) {
        history.go(-2);
    }
    </script>';
}
?>
