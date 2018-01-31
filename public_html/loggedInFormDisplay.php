<?php

if (!$loggedIn) {
    $formDisplay = 'block';
    $logOutButton = 'none';
} else {
    $formDisplay = 'none';
    $logOutButton = 'block';
}
