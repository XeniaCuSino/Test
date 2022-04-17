<?php 

enum State{
    case ACTIVATION;
    case OVERLOAD;
    case ISOLATION;
    case EXTINCTION;
}
enum Status{
    case Dead;
    case Alive;
}

class Cell{
    public $State = State::EXTINCTION;
    public $Status;
    public $AliveNeighbor;
    public function __construct($Status){
        $this->Status = $Status;
    }
    function changeState(){
        if ($this->Status == Status::Dead && $this->AliveNeighbor==3){
            $this->State = State::ACTIVATION;
        }
        if ($this->Status == Status::Alive && $this->AliveNeighbor>=3){
            $this->State = State::OVERLOAD;
        }
        if ($this->Status == Status::Alive && $this->AliveNeighbor<=1){
            $this->State = State::ISOLATION;
        }
        if ($this->Status == Status::Alive && ($this->AliveNeighbor>1 && $this->AliveNeighbor<4)){
            $this->State = State::EXTINCTION;
        }
    }
    function changeStatus(){
        if ($this->State == State::OVERLOAD || $this->State == State::ISOLATION){
            $this->Status = Status::Dead;
        }
        if ($this->State == State::ACTIVATION){
            $this->Status = Status::Alive;
            $this->State = State::EXTINCTION;
        }
    }
}
function checkNeighbors($m, $n, $i, $k, $cells){
    $activeNeighbor=0;
    //проверка угловых соседей
    if ($i-1>=0 && $k-1>=0){
        if ($cells[$i-1][$k-1]->Status == Status::Alive){
            $activeNeighbor++;
        }
    }
    if ($i-1>=0 && $k+1<$n){
        if ($cells[$i-1][$k+1]->Status == Status::Alive){
            $activeNeighbor++;
        }
    }
    if ($i+1<$m && $k-1>=0){
        if ($cells[$i+1][$k-1]->Status == Status::Alive){
            $activeNeighbor++;
        }
    }
    if ($i+1<$m && $k+1<$n){
        if ($cells[$i+1][$k+1]->Status == Status::Alive){
            $activeNeighbor++;
        }
    }
    //проверка смежных соседей
    if ($i-1>=0){
        if ($cells[$i-1][$k]->Status == Status::Alive){
            $activeNeighbor++;
        }
    }
    if ($k-1>=0){
        if ($cells[$i][$k-1]->Status == Status::Alive){
            $activeNeighbor++;
        }
    }
    if ($i+1<$m){
        if ($cells[$i+1][$k]->Status == Status::Alive){
            $activeNeighbor++;
        }
    }
    if ($k+1<$n){
        if ($cells[$i][$k+1]->Status == Status::Alive){
            $activeNeighbor++;
        }
    }
    return $activeNeighbor;
}
function showCells($m,$n,$cells){
    echo '<div><table>';
    for ($i=0; $i<$m; $i++){
        echo '<tr>';
        for ($k=0; $k<$n; $k++){
            echo '<td>';
            if ($cells[$i][$k]->Status == Status::Alive){
                echo 'A';
            }
            else{
                echo 'D';
            }
            echo '</td>';
        } 
        echo '</tr>';
    }
    echo '</table></div><hr/>';
}
$cells=array();
$m=4;
$n=4;
$countAlive=0;
for ($i=0; $i<$m; $i++){
    for ($k=0; $k<$n; $k++){
        $cells[$i][$k] = new Cell(rand(0,1));
        if ($cells[$i][$k]->Status == 1){
            $cells[$i][$k]->Status = Status::Alive;
            $countAlive++;
        }
        else{
            $cells[$i][$k]->Status = Status::Dead;
        }
    }  
}
for ($i=0; $i<$m; $i++){
    for ($k=0; $k<$n; $k++){
        $cells[$i][$k]->AliveNeighbor = checkNeighbors($m, $n, $i, $k, $cells);
        $cells[$i][$k]->changeState();
    }  
}
showCells($m,$n,$cells);
while ($countAlive != 0){
    $countAlive=0;
    for ($i=0; $i<$m; $i++){
        for ($k=0; $k<$n; $k++){
            $cells[$i][$k]->changeStatus();
            if ($cells[$i][$k]->Status == Status::Alive) {
                $countAlive++;
            }  
        }  
    }
    for ($i=0; $i<$m; $i++){
        for ($k=0; $k<$n; $k++){
            $cells[$i][$k]->AliveNeighbor = checkNeighbors($m, $n, $i, $k, $cells);  
            $cells[$i][$k]->changeState();   
        }  
    }
    showCells($m,$n,$cells);
}

?>