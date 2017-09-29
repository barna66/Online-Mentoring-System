
<?php

class Context {
    private $book = NULL;
    private $bookTitleState = NULL;
    //bookList is not instantiated at construct time
    public function __construct($book_in) {
      $this->book = $book_in;
      $this->setTitleState(new BookTitleStateStars());
    }
    public function getBookTitle() {
      return $this->bookTitleState->showTitle($this);
    }
    public function getBook() {
      return $this->book;
    }
    public function setTitleState($titleState_in) {
      $this->bookTitleState = $titleState_in;
    }
}

interface StateInterface {
    public function showTitle($context_in);
}

class StateExclaim implements StateInterface {
    private $titleCount = 0;
    public function showTitle($context_in) {
      $title = $context_in->getBook()->getTitle();
      $this->titleCount++;
      $context_in->setTitleState(new BookTitleStateStars());
      return Str_replace(' ','!',$title);
    }
}

class StateStars implements StateInterface {
    private $titleCount = 0;
    public function showTitle($context_in) {
      $title = $context_in->getBook()->getTitle();
      $this->titleCount++;
      if (1 < $this->titleCount) {
        $context_in->setTitleState(new BookTitleStateExclaim);
      }
      return Str_replace(' ','*',$title);
    }
}

class logout {
    private $author;
    private $title;
    function __construct($title_in, $author_in) {
      $this->author = $author_in;
      $this->title  = $title_in;
    }
    function getAuthor() {return $this->author;}
    function getTitle() {return $this->title;}
    function getAuthorAndTitle() {
      return $this->getTitle() . ' by ' . $this->getAuthor();
    }
}


?>
