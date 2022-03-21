<div>
<form method="post">
    <?php
    echo $error;
    ?>
    <select name="felhasznalo" class="select">
        <option value="0"> Select user </option>
        <?php
        $sql = "SELECT id, felhasznalonev FROM felhasznalok";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                echo "<option value=".$row['id'].">".$row['felhasznalonev']."</option>";
            }
        }
        ?>
    </select>
    <select name="permission" class="select">
        <option value="0"> Select permission </option>
        <option value="1">Moderator</option>
        <option value="2">Admin</option>
        <option value="3">Boss</option>
    </select>
    <input type="submit" class="submit" value="Add" name="admin">
</form>
</div>

<div>
<form method="post">
    <?php
    echo $error;
    ?>
    <select name="removeadmin" class="select">
        <option value="0"> Select user </option>
        <?php
        $sql = "SELECT id, felhasznalonev FROM felhasznalok WHERE id IN (SELECT id FROM adminok)";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                echo "<option value=".$row['id'].">".$row['felhasznalonev']."</option>";
            }
        }
        ?>
    </select>
    <input type="submit" class="submit" value="Delete" name="remove">
</form>
</div>