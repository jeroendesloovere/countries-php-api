<?php
/**
 * Countries test
 *
 * Get all the countries in the world and their languages.
 *
 * @author Jeroen Desloovere <jeroen@siesqo.be>
 */

// autoload files using Composer autoload
require_once __DIR__ . '/../vendor/autoload.php';

use JeroenDesloovere\Countries;

// get items
$items = Countries::getAll();

// dump items
print_r($items);

// get languages for country
$items = Countries::getLanguages('BE');

// dump items
print_r($items);
