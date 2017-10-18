<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Form\ContactForm;

//allo
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
                $this->Flash->success('Nous vous contacterons bientôt.');
                
                //Code redirect
                } else {
                    $this->Flash->error('Il y a eu un problème lors de l\'envoi du formulaire.');
                }
            } else {
                $this->Flash->error('Il y a eu un problème avec le captcha!.');
            }
            
        }

        $this->set('contact', $contact);
    }
    
    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow(['index']);
    }
}

