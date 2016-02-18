<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Calculation\Business\Model\Calculator;

use Generated\Shared\Transfer\OrderItemsTransfer;
use Generated\Shared\Transfer\TotalsTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Spryker\Zed\Calculation\Business\Model\CalculableInterface;
use Spryker\Zed\Calculation\Dependency\Plugin\TotalsCalculatorPluginInterface;

class SubtotalWithoutItemExpensesTotalsCalculator implements
    TotalsCalculatorPluginInterface
{

    /**
     * @param \Generated\Shared\Transfer\TotalsTransfer $totalsTransfer
     * @param \Spryker\Zed\Calculation\Business\Model\CalculableInterface $calculableContainer
     * @param \ArrayObject|\Generated\Shared\Transfer\OrderItemsTransfer|\Generated\Shared\Transfer\ItemTransfer[] $calculableItems
     *
     * @return void
     */
    public function recalculateTotals(
        TotalsTransfer $totalsTransfer,
        CalculableInterface $calculableContainer,
        $calculableItems
    ) {
        $expense = $this->calculateSubtotalWithoutItemExpense($calculableItems);
        $totalsTransfer->setSubtotalWithoutItemExpenses($expense);
    }

    /**
     * @param \ArrayObject|\Generated\Shared\Transfer\OrderItemsTransfer|\Generated\Shared\Transfer\ItemTransfer[] $calculableItems
     *
     * @return int
     */
    protected function calculateSubtotalWithoutItemExpense($calculableItems)
    {
        $subtotal = 0;
        foreach ($calculableItems as $itemTransfer) {
            $subtotal += $itemTransfer->getGrossPrice() * $itemTransfer->getQuantity();
            $subtotal += $this->sumOptions($itemTransfer);
        }

        return $subtotal;
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return int
     */
    protected function sumOptions(ItemTransfer $itemTransfer)
    {
        $optionsPrice = 0;
        foreach ($itemTransfer->getProductOptions() as $optionTransfer) {
            $optionsPrice += $optionTransfer->getGrossPrice() * $itemTransfer->getQuantity();
        }

        return $optionsPrice;
    }

}
