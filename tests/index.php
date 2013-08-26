<?php
/**
 * Countries test
 *
 * Get all the countries in the world and their languages.
 *
 * @author Jeroen Desloovere <jeroen@siesqo.be>
 * @date 20130724
 */

// require
require '../countries.php';

// get items
$items = Countries::getAll();

// dump items
print_r($items);
