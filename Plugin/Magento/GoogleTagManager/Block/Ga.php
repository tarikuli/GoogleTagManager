<?php
declare(strict_types=1);

namespace Studio3Marketing\GoogleTagManager\Plugin\Magento\GoogleTagManager\Block;

use Magento\Sales\Api\OrderRepositoryInterface;

class Ga
{
    /**
     * @var OrderRepositoryInterface
     */
    private $orderRepository;

    /**
     * @param OrderRepositoryInterface $orderRepository
     */
    public function __construct(
        OrderRepositoryInterface $orderRepository
    ) {
        $this->orderRepository = $orderRepository;
    }

    /**
     * @param \Magento\GoogleTagManager\Block\Ga $subject
     * @param \Closure $proceed
     * @return array
     */
    public function aroundGetOrdersDataArray(
        \Magento\GoogleTagManager\Block\Ga $subject,
        \Closure $proceed
    ) {
        $result = [];
        $orderIds = $subject->getOrderIds();
        if (empty($orderIds) || !is_array($orderIds)) {
            return $result;
        }
        $orders = [];
        foreach ($orderIds as $orderId) {
            $orders[] = $this->orderRepository->get($orderId);
        }

        foreach ($orders as $order) {
            $orderData = [
                'transaction_id' => $order->getIncrementId(),
                'affiliation' => $order->getStoreName(),
                'value' => $order->getBaseGrandTotal(),
                'currency' => $order->getBaseCurrencyCode(),
                'tax' => $order->getBaseTaxAmount(),
                'shipping' => $order->getBaseShippingAmount(),
                'coupon' => (string)$order->getCouponCode()
            ];

            $products = [];
            /** @var \Magento\Sales\Model\Order\Item $item */
            foreach ($order->getAllVisibleItems() as $item) {
                $products[] = [
                    'id' => $item->getSku(),
                    'name' => $item->getName(),
                    'price' => $item->getBasePrice(),
                    'quantity' => $item->getQtyOrdered(),
                    'weight' => $item->getWeight()
                ];
            }

            $result[] = [
                'event' => 'purchase',
                'ecommerce' => [
                    'purchase' => [
                        'actionField' => $orderData,
                        'products' => $products
                    ],
                    'currencyCode' => $subject->getStoreCurrencyCode()
                ]
            ];
        }
        return $result;
    }
}
