<?php
	/**
	 * Use to generate a sitemap and write it on the disk easily.
	 */
	class Sitemap {
		private const SITEMAP_NAME = "sitemap.xml";
		private $result;

		function __construct() {
			$this->result = "<?xml version='1.0' encoding='UTF-8'?>\n";
		    $this->result .= "<urlset\n ";
		    $this->result .= "xmlns='http://www.sitemaps.org/schemas/sitemap/0.9'\n ";
		    $this->result .= "xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'\n ";
		    $this->result .= "xsi:schemaLocation='http://www.sitemaps.org/schemas/sitemap/0.9\n\t";
		    $this->result .= "http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd'>\n";
		}

		function add_entry($url, $frequency = "monthly") {
	        $this->add_entry_with_last_modification($url, null, $frequency);
		}

		function add_entry_with_last_modification($url, $last_mode, $frequency = "monthly") {
	        $this->result .= "<url>\n\t";
	        $this->result .= "<loc>$url</loc>\n\t";
	        if (isset($last_mode)) {
	        	$this->result .= "<lastmod>".$last_mode."</lastmod>\n\t";
	        }
	        $this->result .= "<changefreq>$frequency</changefreq>\n";
	        $this->result .= "</url>\n";
		}

		function end() {
	    	$this->result .= '</urlset>';
		}

		function write() {
		    $fp = fopen(ABSPATH . self::SITEMAP_NAME, 'w');
		    fwrite($fp, $this->result);
		    fclose($fp);
		}
	}
?>