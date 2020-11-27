<?php


class TripController extends AppController
{

    public function create(){
        if(!$this->isPost()){
            return $this->render('create');
        }

        $name = $_POST['name'];
        $where = $_POST['where'];
        $desc = $_POST['desc'];

        if(empty($name)) {
            return $this->render('create', ['messages'=>['Name is missing!']]);
        } elseif (empty($where)) {
            return $this->render('create', ['messages'=>['Destination is missing!']]);
        } elseif (empty($desc)) {
            return $this->render('create', ['messages'=>['Description is missing!']]);
        }

        return $this->render('trips');
    }


}