<?php
/**
 * Countries
 *
 * Get all the countries in the world and their languages.
 *
 * @author Jeroen Desloovere <jeroen@siesqo.be>
 * @date 20130724
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
	protected static function doCall($params = array('lang' => 'nl'))
	{
		// init results
		$results = array();

		// define items
		$items = json_decode(SpoonHTTP::getContent(API_URL, array(CURLOPT_POSTFIELDS => $params)), true);

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
	public static function getAll($language = 'nl')
	{
		// init results
		$results = array();

		// get items
		$items = self::doCall(array('lang' => (string) $language));

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
