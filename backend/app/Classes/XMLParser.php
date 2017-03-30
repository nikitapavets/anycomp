<?php

namespace App\Classes;

class XMLParser
{
	const SITEMAP_FILENAME = 'sitemap.xml';
	const XML_CHANGE_FREQ = ['always', 'hourly', 'daily', 'weekly', 'monthly', 'yearly', 'never'];

	private $_xmlFileName = '';
	private $_xmlPriority = 0.0;
	private $_xmlChangeFreq = '';

	/**
	 * XMLParser constructor.
	 * @param string $fileName
	 */
	public function __construct($fileName)
	{
		$this->_xmlFileName = $fileName;
		$this->_xmlPriority = 0.8;
		$this->_xmlChangeFreq = self::XML_CHANGE_FREQ[3];
	}

	/**
	 * @param string $fileName
	 */
	public function setFileName($fileName)
	{
		$this->_xmlFileName = $fileName;
	}

	/**
	 * @return string
	 */
	public function getFileName()
	{
		return $this->_xmlFileName;
	}

	public function addPageToSitemap($pageUrl)
	{
		$xml=simplexml_load_file($this->_xmlFileName);

		$xmlPage=$xml->addChild('url');
		$xmlPage->addChild('loc', $pageUrl);
		$xmlPage->addChild('priority', $this->_xmlPriority);
		$xmlPage->addChild('changefreq', $this->_xmlChangeFreq);

		$xml->asXML($this->_xmlFileName);
	}
}