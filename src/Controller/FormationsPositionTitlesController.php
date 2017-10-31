<?php

namespace App\Controller;

use App\Controller\AppController;
 
class FormationsPositionTitlesController extends AppController {
    
    
    public function getByPositionTitle($positionTitleId = null) {
        $positionTitleId = $this->request->query('position_title_id');
        
        $formations = $this->FormationsPositionTitles->find('all', [
            'conditions' => ['FormationsPositionTitles.position_title_id' => $positionTitleId],
        ]);
        $this->set('formations', $formations);
    }
}

