<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MailController extends Controller {
   public function show(){
      return view('Form_To_template');
   }

   //New Function send to e-mail
   public function Send_mail(Request $request) {
      $Username_1 = $request->input('Name');
      $email_1    = $request->input('Email');
      $Message_1 = $request->input('Messager');
      $Subjects = $request->input('Subjects');
      $data = array(
         'name'=>$Username_1,
         'messager'=>$Message_1
      );
      Mail::send('Form_To_email', $data, function($message) use($request) 
      {
         $message->to($request->input('Email'), $request->input('Name'))->subject($request->input('Subjects'));
         $message->from('5910110216@psu.ac.th','Pasit Thanadamkerng');

      });
      //echo "Basic Email Sent. Check your inbox.";
      return back()->with('sucess');
      }
      
   //การทดลอง : CHECKPOINT 
   //https://www.tutorialspoint.com/laravel/laravel_sending_email.htm
   public function basic_email() {
         $data = array('name'=>"Virat Gandhi");
      
         Mail::send(['text'=>'mail'], $data, function($message) {
            $message->to('abc@gmail.com', 'Tutorials Point')->subject
               ('Laravel Basic Testing Mail');
            $message->from('xyz@gmail.com','Virat Gandhi');
         });
         echo "Basic Email Sent. Check your inbox.";
      }
   public function html_email() {
      $data = array('name'=>"Virat Gandhi");
      Mail::send('mail', $data, function($message) {
         $message->to('5910110216@psu.ac.th', 'Tutorials Point')->subject
            ('Laravel HTML Testing Mail');
         $message->from('5910110216@psu.ac.th','Virat Gandhi');
      });
      echo "HTML Email Sent. Check your inbox.";
   }
   public function attachment_email() {
      $data = array('name'=>"Virat Gandhi");
      Mail::send('mail', $data, function($message) {
         $message->to('abc@gmail.com', 'Tutorials Point')->subject
            ('Laravel Testing Mail with Attachment');
         $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
         $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
         $message->from('5910110216@psu.ac.th','Virat Gandhi');
      });
      echo "Email Sent with attachment. Check your inbox.";
   }
}