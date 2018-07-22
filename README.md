## Ualg++ Eventos

This project was developed within the scope of the Parallel and Distributed Systems discipline and aims at the construction of a distributed model implemented in a free cloud, using the knowledge taught in the theoretical classes of the curricular unit.
It is intended to implement a portal about the events that occur or may occur at the University of Algarve, taking into account the concurrent access to the contents of the portal based on the solution of the problem Readers / Writers. When implementing the portal, a cloud computing infrastructure was used, making it possible to view the contents created in the portal globally.

![screenshot 1](https://github.com/MiguelG28/Ualg-Eventos/tree/master/Examples/1-index.PNG "Home screen")

![screenshot 2](https://github.com/MiguelG28/Ualg-Eventos/tree/master/Examples/9-edit_event.PNG "Main objective-An event is only edited by one person at a time")

[Click here for more Web App screenshots](https://github.com/MiguelG28/Ualg-Eventos/tree/master/Examples)

## Code Example
Some of the important functions that made this project perform the way that is was planned.

Function to set the editing of a post as locked, so it can only be eddited by on person at a time:
  ```PHP 
$cTime = date("Y-m-d H:i:s");   
 
$query4  = "UPDATE microposts SET microposts.locked = '1', microposts.locked_at = '$cTime' WHERE microposts.id = '$id_post' ";
  ```
Function to validade the maximum amount of time that a user can be idle on the editing page, so that he does not stay on the page for an indefinite time:
```PHP
$tuple = mysql_fetch_array($result3,MYSQL_ASSOC);
            
            $past = $tuple['locked_at'];
            $present = date("Y-m-d H:i:s");
            
            $lockedAt = strtotime($past);
            $today = strtotime($present);
            
            
            $minus = $today - $lockedAt;
            
            if($minus > 2 * 60){
                session_start();
                session_destroy();
                
                $query4  = "UPDATE microposts 
                            SET locked = '0'
                            WHERE id = '$id_post';";

                if(!($result4 = @ mysql_query($query4,$db ))){
                    showerror($db);
                }

                echo "<h5 style='color: red;'>Tempo de edição expirou, por favor volte à página inicial<p style='color: red;'>Terá de voltar a iniciar sessão</h5>
                       <button type='button' class='btn btn-default btn-icon' ><a href='index.php'> Go to index</button> ";
            }
 ```
## Motivation

A short description of the motivation behind the creation and maintenance of the project. This should explain **why** the project exists.

## Authors

* **Miguel Guerreiro** - [My profile](https://github.com/MiguelG28)

See also the list of [contributors](https://github.com/MiguelG28/Ualg-Eventos/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details
