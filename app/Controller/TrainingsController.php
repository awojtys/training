<?php

class TrainingsController extends AppController { 
    public $uses = array('Training', 'Activity');
    
    /**
     * Method for authorization
     * 
     * @param type $user
     * @return boolean Display logged or unlogged
     */
    public function isAuthorized($user) {
        // Admin can access every action
        if (isset($user['role']) && $user['role'] === 'admin') 
        {
            return true;
        }
    
       // Default deny
       return false;
    }
    
    /**
     * Default page
     */
    public function viewall()
    {
        
    }
    
    /**
     * Method return all of trainings
     * 
     * @return JSON Return all trainings
     */
    public function index()
    {
        $this->autoRender = false;
        $trainings = $this->Training->find('all');
        if($trainings != null)
        {
            foreach($trainings as $key => $value)
            {
                $data[$key] = $value['Training'];
                $data[$key]['Activity'] = $value['Activity'];
            }
            return json_encode($data);
        }
        else
        {
            exit;
        }
    }
    
    /**
     * Method to add new training to database
     */
    public function add()
    {
        $this->autoRender = false;
        $this->Training->create();
        $date = strtotime($this->request->data['start_date']);
        if($this->Training->save($this->request->data)){
            $this->Activity->saveAll(
                    array(
                        array(
                            'training_id' => $this->Training->id,
                            'availability' => 15,
                            'date' => date('Y-m-d', $date)
                        ), 
                        array(
                            'training_id' => $this->Training->id,
                            'availability' => 15,
                            'date' => date('Y-m-d', $date+86400)
                        ), 
                        array(
                            'training_id' => $this->Training->id,
                            'availability' => 15,
                            'date' => date('Y-m-d', $date+172800)
            )));
            return json_encode($this->Training->id);
        }
        else{
            exit;
        }
    }
    
    public function view($id)
    {
        $this->autoRender = false;
    }
    
    public function edit($id)
    {
        $this->autoRender = false;
        $training = $this->Training->findById($id);
        
        $this->Training->id = $id;
        if($this->Training->save($this->request->data)){
            return json_encode(true);
        }
        else{
            exit;
        }
        
        if (!$this->request->data) {
            $this->request->data = $training;
        }
    }
    
    public function delete($id)
    {
        $this->autoRender = false;
        if($this->Training->delete($id))
        {
            return json_encode(true);
        }
        else
        {
            return json_encode(false);
        }
    }
    
}

?>
