<?php
namespace App\Model;

class Task
{
  protected $database;
  public function __construct(\PDO $database)
{
  $this->database = $database;
}
public function getTasks()
{
$statment =$this->database->prepare(
  'SELECT * FROM tasks ORDER BY id'
);
  $statment->execute();
  return $statment->fetchAll();
}


} //the end



 ?>
