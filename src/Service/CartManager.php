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
	public function addItem($id)
	{
		$items = $this->getItems();

        if (!array_key_exists($id, $items)){
            $items[$id] = 1;
        } else {
            $items[$id] += 1;
        }
        
        $this->save($items);
	}

	/*
		Removes an id
	*/
    public function removeItem($id)
    {
        $items = $this->getItems();

        if (array_key_exists($id, $items)){
            unset($items[$id]);
        }

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
    }

}