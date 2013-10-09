<?php

/**
 * Countries
 *
 * Get all the countries in the world and their languages.
 *
 * @author Jeroen Desloovere <jeroen@siesqo.be>
 */
class Countries
{
	/**
	 * API URL
	 */
	const API_URL = 'http://www.geonames.org/countryInfoJSON';

	/**
	 * Do call
	 *
	 * @param array[optional] $params
	 * @return array
	 */
	protected static function doCall($params)
	{
		// init results
		$results = array();

		// init default
		if(count($params) == 0) $params = array('lang' => 'nl');

		// init curl
		$curl = curl_init();

		// set options
		curl_setopt($curl, CURLOPT_URL, self::API_URL);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_TIMEOUT, 10);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $params);

		// execute
		$response = curl_exec($curl);

		// close
		curl_close($curl);

		// define items
		$items = json_decode($response, true);

		// loop items
		foreach($items['geonames'] as $item)
		{
			// add to results
			$results[$item['countryCode']] = $item;
		}

		// return results
		return $results;
	}

	/**
	 * Get all countries
	 *
	 * @param string[optional] $language
	 * @return countries 	Returns countryCode => countryName
	 */
	public static function getAll($language = null)
	{
		// init results
		$results = array();

		// define parameters
		$parameters = (!empty($language)) ? array() : array('lang' => (string) $language);

		// get items
		$items = self::doCall($parameters);

		// loop items
		foreach($items as $countryCode => $item)
		{
			// add to results
			$results[$countryCode] = $item['countryName'];
		}

		// return
		return $results;
	}

	/**
	 * Get languages for a country
	 *
	 * @param string $countryCode 	The country code where you want to get the languages for.
	 * @return array
	 */
	public static function getLanguages($countryCode = null)
	{
		// redefine countryCode
		$countryCode = (string) $countryCode;

		// get items
		$items = self::doCall();

		// error checking
		if(!isset($items[$countryCode])) throw new CountriesException('Country with code: "' . $countryCode . '" doesn\'t exists');

		// return languages
		return explode(',', $items[$countryCode]['languages']);
	}
}


/**
 * Countries Exception
 *
 * @author Jeroen Desloovere <jeroen@siesqo.be>
 */
class CountriesException extends Exception
{
}
