<?php

class felhasznalok {
    
    private $id;
    protected $tablaNev;


    // id listát ad vissza
    public function lista($conn) {
        $lista = array();
        $sql = "SELECT id FROM $this->tablaNev";
        if($result = $conn->query($sql)) {
            if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
                    $lista[] = $row['id'];
                }
            }
        }
        return $lista;
    }
}

?>