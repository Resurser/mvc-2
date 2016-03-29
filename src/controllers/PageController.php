<?php
namespace Acme\Controllers;
use duncan3dc\Laravel\BladeInstance;

class PageController extends BaseController
{

    public function getShowHomePage()
    {

        //echo $this->twig->render('home.html');
        $_SESSION['test'] = "<strong> I hope this works </strong>s";
        echo $this->blade->render("home", ['test' => 'hello again']);
    }


}


//                                       THE HARD WAY FOR CONNECT TO DB
//  public function getTestDB(){
//      //include(__DIR__.'/../views/testdb.php');
//      try {
//          $conn = new PDO("pgsql:host=localhost dbname=test", "root", "secret");
//      } catch(PDOException $pe){
//          die("Connection error:". $pe->getMessage());
//      }
//
//      $sql = "SELECT * FROM users";
//      $stmt = $conn->prepare($sql);
//      $stmt->execute();
//
//      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
//
//      foreach($rows as $row){
//          echo 'Name: '.strtoupper($row['first_name']).' '.$row['last_name']."<br>";
//      }
//          echo 'It works!';
//  }
//
//}
