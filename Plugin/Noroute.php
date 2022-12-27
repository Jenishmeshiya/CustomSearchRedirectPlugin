<?php

/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 * @package  Czargroup_CustomSearchRedirectPlugin
 * @author
 */
namespace Czargroup\CustomSearchRedirectPlugin\Plugin;

class Noroute
{
    /**
     * @var UrlInterface _urlManager
     */
    protected $_urlManager;

    /**
     * @var ResponseFactory _responseFactory
     */
    protected $_responseFactory;
	
	/**
     * @var Czargroup\CustomSearchRedirectPlugin\Helper\Data $_helperdata
     */
    protected $_helperData;

    /**
     * @param Magento\Framework\UrlInterface $urlManager
     * @param Magento\Framework\App\ResponseFactory $responseFactory
	 * @param Czargroup\CustomSearchRedirectPlugin\Helper\Data $helperData
     */
    public function __construct(
        \Magento\Framework\UrlInterface $urlManager,
        \Magento\Framework\App\ResponseFactory $responseFactory,
		\Czargroup\CustomSearchRedirectPlugin\Helper\Data $helperData
    )
    {
        $this->_urlManager = $urlManager;
        $this->_responseFactory = $responseFactory;
		$this->_helperData = $helperData;
    }

    /**
     * Render search page
     * 
     * @return Magento\Framework\App\ResponseFactory
     */
    public function beforeExecute()
    {
		$confirm = $this->_helperData->getConfirmation();
		if ($confirm) {
			$currentUrl = $this->_urlManager->getCurrentUrl();
			$baseUrl = $this->_urlManager->getBaseUrl();
			$scr = ltrim($currentUrl,$baseUrl);
			$a = explode('.',$scr);
			$url = $this->_urlManager->getUrl('catalogsearch/result/?q='.$a[0]);
			$url = rtrim($url, '/');
			$this->_responseFactory->create()->setRedirect($url)->sendResponse();
			exit;
		}
    }
}