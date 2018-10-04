<?php

namespace Vindi\Actions\Checkout\Steps;

use Vindi\AbstractMagentoTestCase;
use Vindi\Actions\Checkout\AbstractCheckout;
use Vindi\Themes\OnePageCheckout\AbstractThemeConfiguration;
use Magium\WebDriver\WebDriver;

class TermsAndConditions implements StepInterface
{
    const ACTION = 'Checkout\Steps\TermsAndConditions';

    protected $webdriver;
    protected $theme;
    protected $testCase;

    protected $checkboxText;
    
    public function __construct(
        WebDriver                   $webdriver,
        AbstractThemeConfiguration  $theme,
        AbstractMagentoTestCase     $testCase
    ) {
        $this->webdriver        = $webdriver;
        $this->theme            = $theme;
        $this->testCase         = $testCase;
    }

    public function setCheckboxText($text)
    {
        $this->checkboxText = $text;
    }

    public function configureCheckout(AbstractCheckout $checkout, $before = 'Vindi\Actions\Checkout\Steps\PlaceOrder')
    {
        if ($before) {
            $before = $this->testCase->get($before);
        }
        $checkout->addStep($this, $before);
    }

    public function execute()
    {
        if ($this->checkboxText) {
            $xpath = $this->theme->getTermsAndConditionsSelectorXpath($this->checkboxText);
            $element = $this->webdriver->byXpath($xpath);
            $element->click();
        }

        return true;
    }

    public function nextAction()
    {
        return true;
    }
}