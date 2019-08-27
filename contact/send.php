<?php

require_once 'includes/bootstrap.php';

/**
 * Check the data passed to this file. If there is no data or the data
 * can't be decrypted using the key, redirect the user to the homepage.
 */
if ( ! $app->form()->canBeProcessed() ) {
    header('Location: index.php');
}

/**
 * Validate the data
 */
$app->form()->validate();

/**
 * Check the validation status
 */
if ( ! $app->form()->isDataValid() ) {
    
    /**
     * Show the validation errors page
     */
    $app->showValidationFailure();
    
} else {
    
    /**
     * Send the email
     */
    $app->sendEmail();
    
    /**
     * Check the send send status
     */
    if ( $app->isEmailSent() ) {
        
        /**
         * Show send conformation page
         */
        $app->showSendConformation();  
        
    } else {
        
        /**
         * Show send failure page
         */
        $app->showSendFailure();
        
    }   
    
}