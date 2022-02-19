<?php
  class Main {

    private $context = false;
    private $SPHINX;
    private $sphinxError = '';
    private $tableHead = [];
    private $tableBody = [];

    public function __construct($data)
    {
      if ((!empty($data)) and (isset($data['search']))) {
        $this->SPHINX = new SphinxClient();
        $this->searchSphinx($data['search']);
      }
    }

    public function invoke() {
      include 'views/header.php';
      include 'views/Main.php';
      include 'views/footer.php';
    }

    public function checkContext() {
      return $this->context;
    }

    public function searchSphinx($search) {
      $this->SPHINX->SetServer( "localhost", 9312 );
      $this->SPHINX->SetMatchMode( SPH_MATCH_ANY  );
      $result = $this->SPHINX->Query($search);
      if ($result === false) {
        $this->sphinxError = $this->SPHINX->GetLastError();
      }
      else {
        if (!empty($result["matches"])) {
          $searchIDs = array_keys($result["matches"]);
          $this->tableBody = DB::getRows("SELECT *
          FROM edupage e
          WHERE e.ID IN (".implode(",",$searchIDs).")");
          if (count($this->tableBody)>0) {
            $this->context = true;
            $this->tableHead = array_keys($this->tableBody[0]);
          }
        }
      }
    }

    public function getTableHead() {
      return $this->tableHead;
    }

    public function getTableBody() {
      return $this->tableBody;
    }

    public function getSphynxErrors() {
      return $this->sphinxError;
    }

  }
?>
