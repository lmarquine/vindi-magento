<?php
/* @var $this \Magium\TestCaseConfiguration */

$this->capabilities = \Magium\TestCaseConfiguration::CAPABILITIES_CHROME;
//$this->capabilities = \Magium\TestCaseConfiguration::CAPABILITIES_FIREFOX;
//$this->capabilities = \Magium\TestCaseConfiguration::CAPABILITIES_PHANTOMJS;

$this->webDriverRemote = 'http://selenium:4444/wd/hub';