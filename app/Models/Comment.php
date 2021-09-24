<?php
require_once(__DIR__ . "/Tweet.php");

Class Comment extends Model {

    public function tweet() {
        return $this->hasOne('Tweet');
    }

} 
