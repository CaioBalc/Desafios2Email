<?php

class GenerateFiles {
    public static string $orders_csv_name = 'orders.csv';
    public static string $products_csv_name = 'products.csv';
    public static string $sales_csv_name = 'sales.csv';
    private array $products_id = [];

    public function __construct() {
        $this->generateProductsCsv();
        $this->generateOrdersCsv();
        $this->generateSalesCsv();
    }

    private function generateProductsCsv() {
        $file     = fopen(self::$products_csv_name, 'w');
        fputcsv($file, ['product_id', 'name', 'price']);

        $count = 20;

        for ($i=0; $i < $count; $i++) { 
            $id =  sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
                mt_rand( 0, 0xffff ),
                mt_rand( 0, 0x0fff ) | 0x4000,
                mt_rand( 0, 0x3fff ) | 0x8000,
                mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
            );

            $this->products_id[] = $id;
            $value = rand(1, 2000) / 100;  
            $price = number_format($value, 2);

            fputcsv($file, [$id, 'Product ' . $i, $price]);
        }

        fclose($file);
    }

    private function generateOrdersCsv() {
        $file = fopen(self::$orders_csv_name, 'w');
        fputcsv($file, ['order_id', 'product_id', 'date', 'quantity']);

        $last_id = '';
        $last_date = '';

        $count = 35;

        for ($i=0; $i < $count; $i++) { 
            $same = rand(0, 1);

            if ($same) {
                $id   = $last_id;
                $date = $last_date;
            } else {
                $randomYear = rand(2016, 2022);
                $randomMonth = rand(1, 12);
                $randomDay  = rand(1, 30);
                $randomHour = rand(0, 23);
                $randomMinute = rand(0, 59);

                if ($randomMonth == 2 && $randomDay > 28) {
                    $randomDay = 28;
                }

                $id =  sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                    mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
                    mt_rand( 0, 0xffff ),
                    mt_rand( 0, 0x0fff ) | 0x4000,
                    mt_rand( 0, 0x3fff ) | 0x8000,
                    mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
                );

                $last_id = $id;

                $date = (new DateTime("$randomYear-$randomMonth-$randomDay $randomHour:$randomMinute"))->format('Y-m-d H:i');
                $last_date = $date;
            }

            $product_id = $this->products_id[array_rand($this->products_id)];
            $quantity = rand(1, 50);

            if (!empty($id) && !empty($product_id) && !empty($date) && !empty($quantity)) {
                fputcsv($file, [$id, $product_id, $date, $quantity]);
            } else {
                $count++;
            }
        }

        fclose($file);
    }

    function generateSalesCsv(){
        /*
        $file = fopen(self::$sales_csv_name, 'w');
        fputcsv($file, ['product_id', 'unit_price', 'date_last_sale', 'total_quantity', 'total_price']);
        */

        /*
        $separator = ',';
        $archive1 = fopen("orders.csv", "r");
        $archive2 = fopen("products.csv", "r");
        #$archive3 = fopen("sales.csv", "w");
        
        
        $header = fgetcsv($archive1, 0, $separator);

        while(!feof($archive1)){
            $line = fgetcsv($archive1, 0, $separator);
            if(!$line){
                continue;
            }
            $register = array_combine($header, $line);
            $product_id = $register['product_id'];
            $product_name = $register['name'];
            $product_price = $register['price'];
            $product = new Products($product_id, $product_name, $product_price);
            $array_products[] = $product;
        }

        unset($archive1);
        return $array_products;
        

        
        $divisor1 = array();
        $divisor2 = array();

        if ($archive1 == TRUE && $archive2 == TRUE) {
            
            while (($data1 = fgetcsv($archive1, 1000, ",")) == TRUE) {
                $divisor1[] = $data1;
            }
            while (($data2 = fgetcsv($archive2, 1000, ",")) == TRUE) {
                $divisor2[] = $data2;
            }

            fclose($archive1);
            fclose($archive2);
            #fclose($archive3);

            print_r($divisor1);
            print_r($divisor2);
        }
        */
        
        # XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
        /*
        $archive1 = fopen("orders.csv", "r");
        $divisor1 = array();

        if ($archive1 == TRUE) {
            while (($data1 = fgetcsv($archive1, 1000, ",")) == TRUE) {
                $divisor1[] = $data1;
            }
            fclose($archive1);
        }

        // Inicialize um array vazio para armazenar os resultados
        $produtos = array();

        // Percorra cada venda
        foreach ($divisor1 as $venda) {
            // Obtenha o product_id, a data da venda e a quantidade
            $product_id = $venda[1];
            $date = $venda[2];
            $quantity = $venda[3];

            // Verifique se já temos uma venda para este produto
            if (isset($produtos[$product_id])) {
                // Se a data da venda atual é mais recente, atualize a data no array
                if (strtotime($date) > strtotime($produtos[$product_id]['date'])) {
                    $produtos[$product_id]['date'] = $date;
                }
                // Adicione a quantidade à quantidade total
                $produtos[$product_id]['quantity'] += $quantity;
            } else {
                // Se não temos uma venda para este produto, adicione ao array
                $produtos[$product_id] = array('date' => $date, 'quantity' => $quantity);
            }
        }

        // Agora, $produtos é um array onde a chave é o product_id e o valor é um array com a data da última venda e a quantidade total
        print_r($produtos);
        */

        # XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

        # Abre os arquivos CSV
        $archive1 = fopen("orders.csv", "r");
        $archive2 = fopen("products.csv", "r");
        $divider1 = array();
        $divider2 = array();
        
        # Verifica se os arquivos foram abertos, os divide e fecha-os
        if ($archive1 == TRUE && $archive2 == TRUE) {
            while (($data1 = fgetcsv($archive1, 1000, ",")) == TRUE) {
                $divider1[] = $data1;
            }
            while (($data2 = fgetcsv($archive2, 1000, ",")) == TRUE) {
                $divider2[] = $data2;
            }
            fclose($archive1);
            fclose($archive2);
        }
        
        $products = array();
        
        # Passa por cada venda e obtem os dados
        foreach ($divider1 as $sale) {
            $product_id = $sale[1];
            $date = $sale[2];
            $quantity = intval($sale[3]);
        
            # Verifica se o product_id é realmente um ID de produto e não um array diferente
            if ($product_id != 'product_id') {
                foreach ($divider2 as $product) {
                    if ($product[0] == $product_id) {
                        $price = floatval($product[2]);
                        # Verifica se o produto foi realmente vendido
                        if (isset($products[$product_id])) {
                            # Pega a data da venda mais atual
                            if (strtotime($date) > strtotime($products[$product_id]['date'])) {
                                $products[$product_id]['date'] = $date;
                            }
                            # Quantidade total
                            $products[$product_id]['quantity'] += $quantity;
                            # Valor total da venda
                            $products[$product_id]['total_price'] += $quantity * $price;
                        } else {
                            # Se não vendeu, adiciona ao array
                            $products[$product_id] = array('price' => $price, 'date' => $date, 'quantity' => $quantity, 'total_price' => $quantity * $price);
                        }
                    }
                }
            }
        }
        
        # Cria e escreve o arquivo CSV sales
        $archive3 = fopen("sales.csv", "w");
        fputcsv($archive3, array('product_id', 'price', 'date', 'quantity', 'total_price'));
        fputcsv($archive3,[""]);
        foreach ($products as $product_id => $product) {
            fputcsv($archive3, array_merge(array('product_id' => $product_id), $product));
        }
        fclose($archive3);
    }

}

new GenerateFiles;