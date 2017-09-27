<?php

namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;
use Cake\Mailer\Email;

class ContactForm extends Form
{

    protected function _buildSchema(Schema $schema)
    {
        return $schema->addField('Firstname', 'string')
	    ->addField('Lastname', ['type' => 'string'])
            ->addField('Email', ['type' => 'string'])
            ->addField('Commentary', ['type' => 'text']);
    }

    protected function _buildValidator(Validator $validator)
    {
        return $validator->add('Firstname', 'length', [
                'rule' => ['minLength', 2],
                'message' => 'A firstname is required'
            ])->add('Lastname', 'length', [
                'rule' => ['minLength', 2],
                'message' => 'A lastname is required'
            ])->add('Email', 'format', [
                'rule' => 'email',
                'message' => 'A valid email is required',
            ]);
    }

    protected function _execute(array $data)
    {
        $email = new Email('default');
        $email->to('infolifelongapp@gmail.com')
                ->subject("Contact us")
                ->send("From : " . $data['Firstname'] . " " . $data['Lastname'] 
                        . "\n\nEmail : " . $data['Email'] . "\n\n" 
                        . $data['Commentary']);
        
        return true;
    }
}
