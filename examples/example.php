<?php
/**
 * Countries test
 *
 * Get all the countries in the world and their languages.
 *
 * @author Jeroen Desloovere <info@jeroendesloovere.be>
 */

require_once __DIR__ . '/../src/Countries.php';

use JeroenDesloovere\Countries\Countries;

// get items
$items = Countries::getAll();

// dump items
print_r($items);

// get languages for country
$items = Countries::getLanguages('BE');

// dump items
print_r($items);
