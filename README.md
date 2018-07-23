## Ualg++ Eventos

This project was developed within the scope of the Parallel and Distributed Systems discipline and aims at the construction of a distributed model implemented in a free cloud, using the knowledge taught in the theoretical classes of the curricular unit.
It is intended to implement a portal about the events that occur or may occur at the University of Algarve, taking into account the concurrent access to the contents of the portal based on the solution of the problem Readers / Writers. When implementing the portal, a cloud computing infrastructure was used, making it possible to view the contents created in the portal globally.

[https://github.com/MiguelG28/Ualg-Eventos/tree/master/Examples/1-index.png|alt=screenshot 1]

![screenshot 2](https://github.com/MiguelG28/Ualg-Eventos/tree/master/Examples/9-edit_event.PNG "Main objective-An event is only edited by one person at a time")

[Click here for more Web App screenshots](https://github.com/MiguelG28/Ualg-Eventos/tree/master/Examples)

## Code Example
Some of the important functions that made this project perform with the required characteristics.

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
### Motivation

It is intended to implement a website that aims to disseminate or improve one of the aspects that affect the daily life of users of the University of Algarve. The theme chosen was the theme of the events, and the main objective of the portal is to present the events of the University of Algarve (Ualg ++ Eventos, 2017) to the users. Thus it is necessary to choose an infrastructure that supports the availability of the website, as well as to ensure that access and information are consistent.
In order for a website to be always available and functional, the portal must be within an infrastructure. We call this infrastructure the cloud. For the accomplishment of this practical work was proposed to choose a free implementation and the chosen implementation is the implementation of Microsoft that is called Azure.
## Concurrent access

Concurrent access happens when two or more users try to access the same resources available in shared memory. The above statement can be exemplified when two users attempt to edit the same event. To ensure that only one of the users can carry out this operation it was defined that the operations of insertion, change and removal of content were included in transactions, allowing, in case of failure, that the previous state is reset. However, this solution only includes the case where the data is inserted in the DB, so that two users with the same user account do not edit the same event, two more columns were placed in the microposts table, the locked column and the column locked_at. The locked column functions as a binary semaphore, preventing two users from accessing the same table row.

To solve the case where a writer infinitely utilizes the available resources by not allowing others to access this event, the time in which writing was triggered is recorded, giving 2 minutes for the change to be completed. If this time is exceeded, the lock is released. To also prevent the lock from being released while the user is still editing (if it takes more than 2 minutes to enter all the data), an AJAX function is used which each time the value is changed in one of the edit fields is also updated the locked_at column of this post for the current time. If you stay in edit mode without changing anything for more than 2 minutes, your session is automatically disconnected and a message appears asking you to re-enter your account if you want to edit.

## Authors

* **Miguel Guerreiro** - [My profile](https://github.com/MiguelG28)

See also the list of [contributors](https://github.com/MiguelG28/Ualg-Eventos/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details
