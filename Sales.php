<?php

class orders{
    private string $order_id;
    private string $product_id;
    private string $date;
    private string $quantity;

    public function __construct(string $order_id, string $product_id, string $date, int $quantity){
        $this->order_id = $order_id;
        $this->product_id = $product_id;
        $this->date = $date;
        $this->quantity = $quantity;
    }
    
    public function getOrderId(): string{
        return $this->order_id;
    }
    public function setOrderId(string $order_id){
        $this->order_id = $order_id;
    }

    public function getProductId(): string{
        return $this->product_id;
    }
    public function setProductId(string $product_id){
        $this->product_id = $product_id;
    }

    public function getDate(): string{
        return $this->date;
    }
    public function setDate(string $date){
        $this->date = $date;
    }

    public function getQuantity(): int{
        return $this->quantity;
    }
    public function setQuantity(int $quantity){
        $this->quantity = $quantity;
    }

}

class products{
    private string $id;
    private string $name;
    private float $price;

    public function __construct(string $id, string $name,float $price){
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }

    public function getId(): string{
        return $this->id;
    }
    public function setId(string $id){
        $this->id = $id;
    }
    
    public function getName(): string{
        return $this->name;
    }
    public function setName(string $name){
        $this->name = $name;
    }

    public function getPrice(): float{
        return $this->price;
    }
    public function setPrice(float $price){
        $this->price = $price;
    }

}
