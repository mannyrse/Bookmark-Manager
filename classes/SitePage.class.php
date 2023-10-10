<?php

require_once("classes/Page.class.php");

class SitePage extends Page {

	function freezeTopSection() {
    $returnVal = "";
    $returnVal .= "<!doctype html>" . PHP_EOL;
    $returnVal .= "<html lang=\"" . $this->_lang . "\">" . PHP_EOL;
    $returnVal .= "<head>" . PHP_EOL;
    $returnVal .= "<title>";
    $returnVal .= $this->_title;
    $returnVal .= "</title>" . PHP_EOL;
    $returnVal .= '<meta name="viewport" content="width=device-width, initial-scale=1">' . PHP_EOL;
    $returnVal .= '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">'  . PHP_EOL;
    $returnVal .= '<link rel="stylesheet" href="css/styles.css">' . PHP_EOL;
    foreach ($this->_headElements as $elm) {
      $returnVal .= $elm;
    }
    $returnVal .= $this->_headSection;
    $returnVal .= "</head>" . PHP_EOL;
    $returnVal .= "<body>" . PHP_EOL;

    $this->_top = $returnVal;
    $this->setTopFrozen(true);

    }

    function freezeBottomSection() {
    $returnVal = "";
    foreach ($this->_bottomElements as $elm) {
      $returnVal .= $elm;
    }
    $returnVal .= '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>' . PHP_EOL; 
    $returnVal .= "</body>" . PHP_EOL;
    $returnVal .= "</html>" . PHP_EOL;

    $this->_bottom = $returnVal;
    $this->setBottomFrozen(true);

  } //end function freezeBottomSection

  function getTopSection() {
    if ($this->getTopFrozen() === false) {
      $this->freezeTopSection();
    }
    return $this->_top;
  }

}

