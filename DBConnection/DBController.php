  
<?php
class DBController
{
    private $user = "admin";
    Private $pass = "123456";
    public $DBController;
    public function __construct(){
        $user = $this->user;
        $pass = $this->pass;

        try {
            $this->DBController = new PDO('mysql:host=localhost;dbname=coffeeshop;charset=utf8', $user, $pass);
            return $this->DBController;
        } catch (PDOException $err) {
            echo "Error!: " . $err->getMessage() . "<br/>";
            die();
        }}

    public function DBClose(){
        $this->DBController = null;
    }
}
// <?php
// class DBController
// {
//     private $host = "localhost";
//     private $user = "admin";
//     private $password = "123456";
//     private $database = "coffeeshop";
//     private $connection;

//     function __construct()
//     {
//         $this->connection = $this->connectDB();
//     }

//     function connectDB()
//     {
//         $connection = mysqli_connect($this->host, $this->user, $this->password, $this->database);
//         return $connection;
//     }

//     function runQuery($query)
//     {
//         $result = mysqli_query($this->connection, $query);
//         while ($row = mysqli_fetch_assoc($result)) {
//             $results[] = $row;
//         }
//         if (!empty($results))
//             return $results;
//     }

//     function numRows($query)
//     {
//         $result = mysqli_query($this->connection, $query);
//         $rowcount = mysqli_num_rows($result);
//         return $rowcount;
//     }
// }
