<?php

${basename(__FILE__, '.php')} = function(){
    if($this->isAuthenticated()){
        
        $p = new Post(19);
        
        $this->response($this->json([
            'message' => $p->delete()
        ]), 200);

    } else {
        
        $this->response($this->json([
            'message' => 'bad request'
        ]), 400);

    }

};


