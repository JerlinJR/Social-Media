<?php

${basename(__FILE__, '.php')} = function(){
    $this->response($this->json(Post::getTotalPosts()[0]), 200);
};