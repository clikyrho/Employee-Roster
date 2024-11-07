<?php

class PieceWorker extends Employee {
    private $itemsProduced;
    private $wagePerItem;

    public function __construct($itemsProduced, $wagePerItem) {
        $this->itemsProduced = $itemsProduced;
        $this->wagePerItem = $wagePerItem;
    }
}