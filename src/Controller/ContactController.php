<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Form\ContactForm;


class ContactController extends AppController
{
    public function index()
    {
        $contact = new ContactForm();
        if ($this->request->is('post')) {
            
            // validate the user-entered Captcha code
            $isHuman = captcha_validate($this->request->data['CaptchaCode']);

            // clear previous user input, since each Captcha code can only be validated once
            unset($this->request->data['CaptchaCode']);

            if ($isHuman) {
                if ($contact->execute($this->request->getData())) {
                $this->Flash->success('We will contact you soon');
                
                //Code redirect
                } else {
                    $this->Flash->error('Oops, there\'s a problem with your form');
                }
            } else {
                $this->Flash->error('Oops, there\'s a problem with the captcha!.');
            }
            
        }

        $this->set('contact', $contact);
    }
    
    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow(['index']);
    }
}

