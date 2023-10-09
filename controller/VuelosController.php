<?php

class VuelosController {
    private $printer;
    private $VuelosModel;

    public function __construct($VuelosModel, $printer) {
        $this->VuelosModel = $VuelosModel;
        $this->printer = $printer;
    }

    public function execute() {
        $this->printer->generateView('vuelosView.html');
    }
}