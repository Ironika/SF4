<?php

namespace App\Service;

class CartManager
{
	private $session;

	public function __construct($session)
	{
		$this->session = $session;
		$this->createIfNeeded();
	}

    /*
    	Retrieves an array of ids
    */
	public function getItems()
	{
		return $this->session->get('cart_items');
	}

	/*
		Adds an id
	*/
	public function addItem($id, $quantity)
	{
		$items = $this->getItems();

        $items[] = $id;

        $this->session->set('cart_items_number', $this->session->get('cart_items_number') + $quantity);
        
        $this->save($items);
	}

	/*
		Removes an id
	*/
    public function removeItem($id, $quantity)
    {
        $items = $this->getItems();

        foreach ($items as $key => $value) {
            if($value == $id)
                unset($items[$key]);
        }

        $this->session->set('cart_items_number', $this->session->get('cart_items_number') - $quantity);

        $this->save($items);
    }

    /*
    	Saves the new items
    */
    private function save($items)
    {
        $this->session->set('cart_items', $items);
    }

    /*
    	Creates a stack if not existing yet
    */
    private function createIfNeeded()
    {
    	$items = $this->session->get('cart_items');
    	if ($items == null){
    		$this->save(array());
    	}

        $quantity = $this->session->get('cart_items_number');
        if(!$quantity) {
            $this->session->set('cart_items_number', 0);
        }
    }

}