<?php /** @noinspection ALL */


class TripController extends AppController
{
    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_EXTENSIONS = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';
    private $messages;

    public function create()
    {
        if($this->isPost() && is_uploaded_file($_FILES['photo']['tmp_name']) && $this->validate($_FILES['photo'])){
            move_uploaded_file(
                $_FILES['photo']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['photo']['name']
            );

            return $this->render('create');
        }





       /*
        $name = $_POST['name'];
        $where = $_POST['where'];
        $desc = $_POST['desc'];
        if(empty($name)) {
            return $this->render('create', ['messages'=>['Name is missing!']]);
        } elseif (empty($where)) {
            return $this->render('create', ['messages'=>['Destination is missing!']]);
        } elseif (empty($desc)) {
            return $this->render('create', ['messages'=>['Description is missing!']]);
        }*/

        return $this->render('create', ['messages' => $this->messages]);
    }

    private function validate(array $file): bool
    {
        if($file['size'] > self::MAX_FILE_SIZE) {
            $this->messages[] = 'File is too large';
            return false;
        }

        if(!isset($file['type']) && !in_array($file['type'], self::SUPPORTED_EXTENSIONS)) {
            $this->messages[] = 'unsupported file type';
            return false;
        }

        return true;
    }


}