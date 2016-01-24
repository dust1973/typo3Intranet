<?php
namespace Woehrl\WoehrlAkademie\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * ViewHelper for Openstreetmap
 *
 * @author Oliver Thiele <mailYYYY@oliver-thiele.de>
 */
class OpenStreetMapViewHelper extends AbstractViewHelper{

	/**
	 * @todo Variable Locations aus den Orten, dazu tt_address ergänzen
	 *
	 * @param \Mittwald\MmEvents\Domain\Model\Location $address
	 * @return string $content HTML code
	 */
	public function render($address) {

		$postalcode = urlencode('90403');
		$street = urlencode('Ludwigsplatz 12');
		$city = urlencode('Nürnberg');
		$content2 = '<iframe width="600" height="400" src="http://nominatim.openstreetmap.org/search.php?street=' . $street . '&postalcode=' . $postalcode . '&city=' . $city . '&addressdetails=1&dedupe=1&viewbox=9.69%2C52.37%2C9.76%2C52.34"></iframe>';


		$path = str_replace('../', '/', \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('mm_events') . 'Resources/Public/OpenLayers/lib/OpenLayers.js');
		$content = '<div class="" id="demoMap" style="height:350px;background-color: #FFFFFF;border: 1px solid #DDDDDD;border-radius: 4px 4px 4px 4px;line-height: 1.42857;max-width: 100%;padding: 4px;transition: all 0.2s ease-in-out 0s;"></div>
			<script src="' . $path . '"></script>
			<script>
				var lon = 11.07075;
				var lat = 49.45060;
				var zoom = 18;
				var map, layer;

				map = new OpenLayers.Map("demoMap");
				map.addLayer(new OpenLayers.Layer.OSM());
				// map.addControl(new OpenLayers.Control.PanZoomBar());
				//	OpenLayers.ImgPath = "/resources/external/images/ol/";
				// 	map.zoomToMaxExtent();

				map.setCenter(
					new OpenLayers.LonLat(lon, lat).transform(
						new OpenLayers.Projection("EPSG:4326"),
						map.getProjectionObject()
					), zoom
				);
			</script>';

		return ($content);
	}
}