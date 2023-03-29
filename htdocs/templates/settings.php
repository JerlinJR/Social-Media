<?php

if(Session::isAuthenticated()){
    echo "Yes";
} else {
    echo "No";
}