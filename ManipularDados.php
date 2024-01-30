<?php

use League\Csv\Reader;

$orders = 'orders.csv';

class ManipuladorDados
{
    private array $productsData;
    private array $ordersData;

    public function __construct()
    {
        $this->productsData = $this->lerCSV('products.csv');
        $this->ordersData = $this->lerCSV('orders.csv');
        
        // Agora você pode manipular os dados como quiser
        $this->mostrarDados();
    }

    private function lerCSV($orders)
    {
        $csv = Reader::createFromPath($orders, 'r');
        $csv->setHeaderOffset(0); // Pula a linha de cabeçalho

        return iterator_to_array($csv->getRecords());
    }

    private function mostrarDados()
    {
        echo "<h2>Produtos:</h2>";
        echo "<pre>";
        print_r($this->productsData);
        echo "</pre>";

        echo "<h2>Pedidos:</h2>";
        echo "<pre>";
        print_r($this->ordersData);
        echo "</pre>";
    }
}

// Exemplo de uso
new ManipuladorDados;
