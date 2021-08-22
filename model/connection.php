<?php

class Connection {
   public $servername = 'localhost';
   public $username = 'root';
   public $dbname = 'deliveryfooddb';
   public $password = '';
   public $sql;


   function __construct()
   {
      try {
         $this->sql = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            
         } catch(PDOException $e) {
            echo "connection failde: " . $e->getMessage();
         }
   } 

//    --------------------------------------select

   function select($table)
   {
      $qry="select * from ".$table;
      return $this->sql->query($qry)->fetchAll(PDO::FETCH_ASSOC);
   }

//    --------------------------------------delete

   function delete($table,$idName,$id)
   {
      $qry="delete from ".$table." where ".$idName."=".$id;
      if($this->sql->query($qry)){
         return true;
     }
     return false;
   }

//    --------------------------------------insert
   
   function insert($table,$tabName, $tabValue)
   {
      $name="";
      $value="";
      $vrg=""; 
      for($i=0;$i<count($tabName);$i++)
      {
         if($i>0)
         {
            $vrg=",";
         }

         $name.=$vrg."`".$tabName[$i]."`";
      }
      
      $vrg="";
      for($i=0;$i<count($tabValue);$i++)
      {
         if($i>0)
         {
            $vrg=",";
         }
         $value.=$vrg."'".$tabValue[$i]."'";
      }
      $qry="INSERT INTO ".$table." (".$name.") VALUES (".$value.")";
      
      if($this->sql->query($qry)){
            return true;
        }
        return false;
   }

//    --------------------------------------update

   function update($table,$tabName,$tabValue,$id, $idName)
   {
      $name="";
      $value="";
      for($i=0;$i<count($tabName);$i++)
      {
         $vrg="";
         if($i>0)
         {
            $vrg=",";
         }
         $name.=$vrg."`".$tabName[$i]."`='".$tabValue[$i]."'";
      }
      
      $qry="UPDATE ".$table." SET ".$name." WHERE ".$idName."=".$id;
      // $this->sql->query($qry);
      if($this->sql->query($qry)){
         return true;
      }
      return false;
   }

//    --------------------------------------select

   // function edit($table,$id)
   // {
   //    $qry="select * from ".$table." where id=".$id;
   //    return $this->sql->query($qry)->fetchAll()[0];
   // }

   function selectById($table,$id)
   {
      $qry="select * from ".$table." where id=".$id;
      return $this->sql->query($qry)->fetchAll()[0];
   }
}



