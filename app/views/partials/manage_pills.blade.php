<?php
HTML::macro('pill_stat', function($_args){
    foreach ($_args as $key) {
        $active = URL::current() == $key[0] ? 'active':'';
        echo '<li class="'.$active.'"><a href="'.$key[0].'">'.$key[1].'</a></li>';
    }
});
?>
<ul class="nav nav-pills">
{{ HTML::pill_stat(array(
    array(URL::route('manage_hash', array($hash)), 'Details'), array(URL::route('manage_h_reponses', array($hash)), 'Responses'), array(URL::route('manage_h_doubts', array($hash)), 'Doubts'), array(URL::route('manage_edit', array($hash)), 'Edit')
    ))
}}
</ul>
