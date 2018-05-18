<?php
declare(strict_types=1);

namespace Yireo\EmailTester2\Test\Integration\Block\Adminhtml;

use Magento\TestFramework\TestCase\AbstractBackendController;

/**
 * @magentoAppArea adminhtml
 */
class OverviewTest extends AbstractBackendController
{
    /**
     * Setup method
     */
    public function setUp()
    {
        $this->resource = 'Yireo_EmailTester2::index';
        $this->uri = 'backend/emailtester/index/index';
        parent::setUp();
    }

    /**
     * Test whether the page contains valid body content
     *
     * @magentoAppArea adminhtml
     */
    public function testValidBodyContent()
    {
        $this->dispatch($this->uri);
        $body = $this->getResponse()->getBody();
        $this->assertContains('Send Email', $body);
        $this->assertContains('Preview Email', $body);
        $this->assertContains('Store View', $body);
        $this->assertContains('Customer Search', $body);
        $this->assertContains('Product Search', $body);
        $this->assertContains('Order Search', $body);
    }
}
