<?php

require_once(__DIR__ . "/Comment.php");

Class Tweet extends Model {

    public function comments() {
        return $this->hasMany('Comment');
    }
}
