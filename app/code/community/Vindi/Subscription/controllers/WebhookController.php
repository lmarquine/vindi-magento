<?php

class Vindi_Subscription_WebhookController extends Mage_Core_Controller_Front_Action
{
	use Vindi_Subscription_Trait_LogMessenger; 

	/**
	 * Seta a rota dos  Webhooks
	 */
	public function indexAction()
	{
		/** @var Vindi_Subscription_Helper_WebhookHandler $handler */
		$handler = Mage::helper('vindi_subscription/webhookHandler');

		if (! $this->validateRequest()) {
			$ip = Mage::helper('core/http')->getRemoteAddr();

			$this->logWebhook(sprintf('Invalid webhook attempt from IP %s', $ip), Zend_Log::WARN);
			$this->norouteAction();

			return false;
		}

		$body = file_get_contents('php://input');
		$this->logWebhook(sprintf("Novo evento dos webhooks!\n%s", $body));

		return $handler->handle($body);
	}

	/**
	 * Valida o token do Webhook por questões de segurança
	 *
	 * @return bool
	 */
	private function validateRequest()
	{
		$systemKey = Mage::helper('vindi_subscription')->getHashKey();
		$requestKey = $this->getRequest()->getParam('key');

		return $systemKey === $requestKey;
	}
}

