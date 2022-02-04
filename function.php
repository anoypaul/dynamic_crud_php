<?php 
    class crudApp{
        private $conn;
        public function __construct()
        {
            $dbhost = 'localhost';
            $dbuser = 'root';
            $dbpass = "";
            $dbname = 'php_raw';

            $this->conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
            if (!$this->conn) {
                die("Database Connection Error!");
            }
        }
        public function add_data($data){
            $std_name = $data['std_name'];
            $std_roll = $data['std_roll'];
            $std_img = $_FILES['std_img']['name'];
            $tmp_name = $_FILES['std_img']['tmp_name'];
  
            $query = "INSERT INTO students(students_name, students_roll, students_image) VALUE('$std_name', $std_roll, '$std_img')";
            if (mysqli_query($this->conn, $query)) {
                move_uploaded_file($tmp_name, 'upload/'.$std_img);
                return "Information added Successfully";
            }
        }
        public function display_data(){
            $query = "SELECT * FROM students";
            if (mysqli_query($this->conn, $query)) {
                $returndata = mysqli_query($this->conn, $query);
                return $returndata;
            }
        }
        public function display_data_by_id($id){
            $query = "SELECT * FROM students WHERE students_id = $id";
            if (mysqli_query($this->conn, $query)) {
                $returndata = mysqli_query($this->conn, $query);
                $studentData = mysqli_fetch_assoc($returndata);
                return $studentData;
            }
        }
        public function update_data($data){
            $std_name = $data['u_std_name'];
            $std_roll = $data['u_std_roll'];
            $idno = $data['std_id'];
            $std_img = $_FILES['u_std_img']['name'];
            $tmp_name = $_FILES['u_std_img']['tmp_name'];
  
            $query = "UPDATE students SET students_name = '$std_name', students_roll = $std_roll, students_image =  '$std_img' WHERE students_id=$idno";
            if (mysqli_query($this->conn, $query)) {
                move_uploaded_file($tmp_name, 'upload/'.$std_img);
                return "Information Updated Successfully";
            }
        }
        public function delete_data($id){
            $catch_img = "SELECT * FROM students WHERE students_id=$id";
            $delete_std_info = mysqli_query($this->conn, $catch_img);
            $std_infoDle = mysqli_fetch_assoc($delete_std_info);
            $deleteImg_data = $std_infoDle['students_image'];
            $query = "DELETE FROM students WHERE students_id = $id";
            if (mysqli_query($this->conn, $query)) {
                // unlink('uplaod/'.$deleteImg_data);
                return "Deleted Successfully"; 
            }
        }
    }
?>