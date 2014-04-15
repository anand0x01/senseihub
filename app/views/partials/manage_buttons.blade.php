<?php
HTML::macro('manage_buttons', function($buttons){
    foreach ($buttons as $button) {
        if(array_key_exists('special', $button)) {
            echo '<h5 class="text-info">'.$button['messages'].'</h5></br>';
        } else {
            echo '<p><button class="btn btn-link" type="button">'.$button['bname'].'</button></p>';
        }
    }
});
?>
{{ HTML::manage_buttons($btns) }}
