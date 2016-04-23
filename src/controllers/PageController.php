<?php
namespace Acme\Controllers;
use Cocur\Slugify\Slugify;
use duncan3dc\Laravel\BladeInstance;
use Acme\Models\Page;

class PageController extends BaseController
{

    public function getShowHomePage()
    {

        //echo $this->twig->render('home.html');
        $_SESSION['test'] = "<strong> I hope this works </strong>s";
        echo $this->blade->render("home", ['test' => 'hello again']);
    }

    public function getShowPage(){

        $browser_title = "";
        $page_content = "";
        $page_id = 0;


        // extract page name from tge url
        $uri = explode("/", $_SERVER['REQUEST_URI']);
        $target = $uri[1];

        // find matching page in db
        $page = Page::where('slug', '=', $target)->get();

        // look up page content
        foreach($page as $item){
            $browser_title = $item->browser_title;
            $page_content = $item->page_content;
            $page_id = $item->id;
        }

        if(strlen($browser_title)== 0){
            header("HTTP/1.0 404 Not Found");
            header("Location: /page-not-found");
            exit();
        }

        // pass content to some blade template
        echo $this->blade->render('generic-page', [
            'browser_title' => $browser_title,
            'page_content' => $page_content,
            'page_id' => $page_id,
        ]);

    }

    public function getShow404()
    {
       echo $this->blade->render('page-not-found');

    }

    public function getSuccessMessage()
    {
        echo $this->blade->render('generic-page');
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
