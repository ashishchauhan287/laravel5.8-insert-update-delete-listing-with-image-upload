<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MailController extends Controller
{
    public function basic_email() {
        $data = array('name'=>"Virat Gandhi");
     
        Mail::send(['text'=>'mail'], $data, function($message) {
           $message->to('ashish@paceinfonet.com', 'Laravel Basic Email')->subject
              ('Laravel Basic Testing Mail');
           $message->from('asish1073@gmail.com','asish');
        });
        echo "Basic Email Sent. Check your inbox.";
     }
     public function html_email() {
        $data = array('name'=>"Virat Gandhi");
        Mail::send('mail', $data, function($message) {
           $message->to('ashish@paceinfonet.com', 'Laravel html email')->subject
              ('Laravel HTML Testing Mail');
           $message->from('asish1073@gmail.com','asish');
        });
        echo "HTML Email Sent. Check your inbox.";
     }
     public function attachment_email() {
        $data = array('name'=>"Virat Gandhi");
        Mail::send('mail', $data, function($message) {
           $message->to('ashish@paceinfonet.com', 'Laravel email attachment')->subject
              ('Laravel Testing Mail with Attachment');
           $message->attach('C:\wamp64\www\laravel-sample\public\uploads\image.png');
           $message->attach('C:\wamp64\www\laravel-sample\public\uploads\test.txt');
           $message->from('asish1073@gmail.com','asish');
        });
        echo "Email Sent with attachment. Check your inbox.";
     }
}
