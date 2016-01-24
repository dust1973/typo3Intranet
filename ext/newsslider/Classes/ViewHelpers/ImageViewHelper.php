<?php
/*  Copyright notice
 *
 *  (c) 2014 Helmut Hackbarth <info@t3solution.de>
 *  All rights reserved
 *                                                                     *
 * This script is part of the TYPO3 project - inspiring people to share!  *
 *                                                                        *
 * TYPO3 is free software; you can redistribute it and/or modify it under *
 * the terms of the GNU General Public License version 2 as published by  *
 * the Free Software Foundation.                                          *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General      *
 * Public License for more details.                                       *
 *                                                                        */


class Tx_Newsslider_ViewHelpers_ImageViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper {

    /**
     * Configuration Manager
     *
     * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
     * @inject
     */
   	protected $configurationManager;

	/**
	 * @var string
	 */
	protected $tagName = 'img';

	/**
	 * @var \TYPO3\CMS\Extbase\Service\ImageService
	 * @inject
	 */
	protected $imageService;

	/**
	 * Initialize arguments.
	 *
	 * @return void
	 */
	public function initializeArguments() {

		$this->registerUniversalTagAttributes();
		$this->registerTagAttribute('alt', 'string', 'Specifies an alternate text for an image', FALSE);
		$this->registerTagAttribute('ismap', 'string', 'Specifies an image as a server-side image-map. Rarely used. Look at usemap instead', FALSE);
		$this->registerTagAttribute('longdesc', 'string', 'Specifies the URL to a document that contains a long description of an image', FALSE);
		$this->registerTagAttribute('usemap', 'string', 'Specifies an image as a client-side image-map', FALSE);
	}

	/**
	 * Resizes a given image (if required) and renders the respective img tag
	 *
	 * @see http://typo3.org/documentation/document-library/references/doc_core_tsref/4.2.0/view/1/5/#id4164427
	 * @param string $src a path to a file, a combined FAL identifier or an uid (integer). If $treatIdAsReference is set, the integer is considered the uid of the sys_file_reference record. If you already got a FAL object, consider using the $image parameter instead
	 * @param string $width width of the image. This can be a numeric value representing the fixed width of the image in pixels. But you can also perform simple calculations by adding "m" or "c" to the value. See imgResource.width for possible options.
	 * @param string $height height of the image. This can be a numeric value representing the fixed height of the image in pixels. But you can also perform simple calculations by adding "m" or "c" to the value. See imgResource.width for possible options.
	 * @param integer $minWidth minimum width of the image
	 * @param integer $minHeight minimum height of the image
	 * @param integer $maxWidth maximum width of the image
	 * @param integer $maxHeight maximum height of the image
	 * @param boolean $treatIdAsReference given src argument is a sys_file_reference record
	 * @param FileInterface|AbstractFileFolder $image a FAL object
	 *
	 * @throws \TYPO3\CMS\Fluid\Core\ViewHelper\Exception
	 * @return string Rendered tag
	 */
	public function render($src = NULL, $width = NULL, $height = NULL, $minWidth = NULL, $minHeight = NULL, $maxWidth = NULL, $maxHeight = NULL, $treatIdAsReference = FALSE, $image = NULL) {

		if (is_null($src) && is_null($image) || !is_null($src) && !is_null($image)) {
			throw new \TYPO3\CMS\Fluid\Core\ViewHelper\Exception('You must either specify a string src or a File object.', 1382284106);
		}
		$image = $this->imageService->getImage($src, $image, $treatIdAsReference);

		$processingInstructions = array(
			'width' => $width,
			'height' => $height,
			'minWidth' => $minWidth,
			'minHeight' => $minHeight,
			'maxWidth' => $maxWidth,
			'maxHeight' => $maxHeight,
		);
		$processedImage = $this->imageService->applyProcessingInstructions($image, $processingInstructions);
		$imageUri = $this->imageService->getImageUri($processedImage);

		$this->tag->addAttribute('src', $imageUri);
#		$this->tag->addAttribute('width', $processedImage->getProperty('width'));
#		$this->tag->addAttribute('height', $processedImage->getProperty('height'));

		$alt = $image->getProperty('alternative');
		$title = $image->getProperty('title');

		// The alt-attribute is mandatory to have valid html-code, therefore add it even if it is empty
		if (empty($this->arguments['alt'])) {
			$this->tag->addAttribute('alt', $alt);
		}
		if (empty($this->arguments['title']) && $title) {
			$this->tag->addAttribute('title', $title);
		}

		return $this->tag->render();
	}
}
