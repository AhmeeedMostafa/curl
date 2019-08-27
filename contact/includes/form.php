<?php

/**
 * NamodgApp - A beautiful ajax form
 * ========================
 * 
 * NamodgApp is customizable, configurable, ajax application which can be used
 * to recieve data from users. It's form is generated using Namodg which allows
 * developers to eaisly extend and change the functionality of NamodgApp.
 * 
 * @author Maher Sallam <admin@namodg.com>
 * @link http://namodg.com
 * @copyright Copyright (c) 2010-2011, Maher Sallam
 *
 * Dual licensed under the MIT and GPL licenses:
 *   @license http://www.opensource.org/licenses/mit-license.php
 *   @license http://www.gnu.org/licenses/gpl.html
 */

$app->form()
        
    /**
     * Add a text field
     */
    ->addTextField('Name', array(
        'required' => true,
        'id' => 'name',
        'label' => 'Sender Name :',
        'title' => 'Name Required'
    ))

    /**
     * Add an email field
     */
    ->addEmail('E-Mail', array(
        'required' => true,
        'id' => 'email',
        'label' => 'E-Mail :',
        'title' => 'Please use your E-mail , E-Mail Required'
    ))

    /**
     * Add a number field
     */
    ->addNumberField('Number', array(
        'required' => true,
        'id' => 'number',
        'label' => 'Number :',
        'title' => 'Your Private Number Always Available with you, Number Reuired'
    ))

    /**
     * Add a select dropdown
     */
    ->addSelect('Purpose', array(
        'required' => true,
        'id' => 'purpose',
        'options' => array('Public Contact', 'Report About Problem', 'Request Put Advertisement'),
        'default' => 'Choose Please',
        'label' => 'Purpose From Contact :',
        'title' => 'You Purpose From Contact Us, Purpose Required'
    ))

    /**
     * Add a captcha field
     */
    ->addCaptcha('Verification', array(
        'id' => 'captcha',
        'class' => 'captcha',
        'label' => 'Verification :',
        'title' => 'Please Enter The Right Result, The Result Required',
        'info' => 'We use this question to sure from the sender is human not robot'
    ))

    /**
     * Add a textarea
     */
    ->addTextarea('The Message', array(
        'required' => true,
        'id' => 'message',
        'label' => 'Message :',
        'title' => 'You Can Add Your Message here, Message Required'
    ))

    /**
     * Add a submit button
     */
    ->addSubmit('Send', 'Send Message');