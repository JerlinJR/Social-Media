<?php

${basename(__FILE__, '.php')} = function(){
    $result = [
        'sucess' => false,
        'message'=> 'Invalid Request'
    ];
    $this->response($this->json($result), 200);
};