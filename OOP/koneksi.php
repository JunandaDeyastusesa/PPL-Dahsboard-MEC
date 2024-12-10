<?php

class koneksi
{
  private $hostname = "localhost";
  private $username = "root";
  private $password = "";
  private $name = "db_bimbelonline";
  protected $koneksi;
  public function __construct()
  {
    $this->koneksi = new mysqli($this->hostname, $this->username, $this->password, $this->name);
    if ($this->koneksi == false) {
      die("Koneksi dengan database gagal: " . mysqli_connect_errno() . " - " . mysqli_connect_error());
    }
  }
}
