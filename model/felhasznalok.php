<?php

class felhasznalok {
    
    private $id;
    private $felhasznalonev;
    private $jelszo;

    public function set_user($id, $conn) {
        // adatbázisból lekérdezzük
        $sql = "SELECT id, felhasznalonev, jelszo FROM felhasznalok";
        $sql .= " WHERE id = $id ";
        $result = $conn->query($sql);
        if ($conn->query($sql)) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $this->id = $row['id'];
                $this->felhasznalonev = $row['felhasznalonev'];
                $this->jelszo = $row['jelszo'];
                
            }
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    public function get_jelszo() {
        return $this->jelszo;
    }

    public function get_felhasznalonev() {
        return $this->felhasznalonev;
    }

    public function get_id() {
        return $this->id;
    }

    public function felhasznalokListaja($conn) {
        $lista = array();
        $sql = "SELECT id FROM felhasznalok";
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
