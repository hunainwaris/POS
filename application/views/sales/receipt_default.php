<div id="receipt_wrapper" style="font-size:<?php echo $this->config->item('receipt_font_size');?>px">

    <table>
        <thead>

        <div id="receipt_header">
            <?php
            if($this->config->item('company_logo') != '')
            {
                ?>

                <tr>
                    <td>
                        <div id="company_name" style="text-align: initial !important;">
                            <img id="image" src="<?php echo base_url('uploads/' . $this->config->item('company_logo')); ?>" alt="company_logo" />
                        </div>
                    </td>
                </tr>
                <?php
            }
            ?>

            <?php
            if($this->config->item('receipt_show_company_name'))
            {
                ?>
                <tr>
                    <td>
                        <div id="company_name" style="text-align: initial !important;"><?php echo $this->config->item('company'); ?></div></td>
                </tr>

                <?php
            }
            ?>
            <tr>
                <td>
                    <div id="company_address" style="text-align: initial !important;"><?php echo nl2br($this->config->item('address')); ?></div>
                </td>
            </tr>
            <tr>
                <td>
                    <div id="company_phone" style="text-align: initial !important;"><?php echo $this->config->item('phone'); ?></div>
                </td>
            </tr>
            <tr><td>

                </td></tr>
        </div>
        </thead>
    </table>
    <!--            <div id="sale_receipt" style="text-align: center">--><?php //echo $this->lang->line('sales_receipt'); ?><!--</div>-->
    <!--            <div id="sale_time" style="text-align: right">Date & Time :--><?php //echo $transaction_time ?><!--</div>-->
    <!--    <div id="sale_id" style="text-align: right"> --><?php //echo $this->lang->line('sales_id').": ".$sale_id; ?><!--</div>-->
    <!---->
    <!--    --><?php
    //    if(!empty($invoice_number))
    //    {
    //        ?>
    <!--        <div id="invoice_number" style="text-align: right">--><?php //echo $this->lang->line('sales_invoice_number').": ".$invoice_number; ?><!--</div>-->
    <!--        --><?php
    //    }
    //    ?>

    <?php
    ?>
    <div id="receipt_general_info">
        <?php
        if(isset($customer) or isset($customer_address) or isset($customer_phone))
        {
            ?>
            <div  id="rectangle" style=" border-radius: 25px;border: 2px solid #000000;padding: 10px;width: 140px;height: 70px; ">
                <div id="customer"><?php echo $this->lang->line('customers_customer').": ".$customer; ?></div>
                <div id="customer_address"><?php echo $this->lang->line('customer_address').": ".$customer_address; ?></div>
                <div id="customer_phone_number"><?php echo $this->lang->line('customer_phone').": ".$customer_phone; ?></div>
            </div>
            <?php
        }
        ?>
        <div>
            <div id="sale_time" style="text-align: right">Date & Time :<?php echo $transaction_time ?></div>
            <div id="sale_id" style="text-align: right"> <?php echo $this->lang->line('sales_id').": ".$sale_id; ?></div>

            <?php
            if(!empty($invoice_number))
            {
                ?>
                <div id="invoice_number" style="text-align: right"><?php echo $this->lang->line('sales_invoice_number').": ".$invoice_number; ?></div>
                <?php
            }
            ?>
        </div>
        <!--		<div id="sale_id">--><?php //echo $this->lang->line('sales_id').": ".$sale_id; ?><!--</div>-->
        <!---->
        <!--		--><?php
        //		if(!empty($invoice_number))
        //		{
        //		?>
        <!--			<div id="invoice_number">--><?php //echo $this->lang->line('sales_invoice_number').": ".$invoice_number; ?><!--</div>-->
        <!--		--><?php
        //		}
        //		?>

        <!--		<div id="employee">--><?php //echo $this->lang->line('employees_employee').": ".$employee; ?><!--</div>-->
    </div>

    <table id="receipt_items" style="border: 1px solid black">
        <tr style="border: 1px solid black">
            <th style="width:10%; border: 1px solid black; text-align: center">Sr.No.</th>
            <th style="width:40%; border: 1px solid black; text-align: center"><?php echo $this->lang->line('sales_description_abbrv'); ?></th>
            <th style="width:20%; border: 1px solid black; text-align: center"><?php echo $this->lang->line('sales_price'); ?></th>
            <th style="width:20%; border: 1px solid black; text-align: center"><?php echo $this->lang->line('sales_quantity'); ?></th>
            <th style="width:20%; border: 1px solid black; text-align: center" class="total-value"><?php echo $this->lang->line('sales_total'); ?></th>
            <?php
            if($this->config->item('receipt_show_tax_ind'))
            {
                ?>
                <th style="width:20%; border: 1px solid black"></th>
                <?php
            }
            ?>
        </tr>
        <?php
        $sr_no=0;
        foreach($cart as $line=>$item)
        {
            if($item['print_option'] == PRINT_YES)
            {
                ?>
                <tr style="border: 1px solid black">
                    <!--					<td>--><?php //var_dump($sr_no+=1); ?><!--</td>-->
                    <td style="border: 1px solid black; text-align: center"><?php echo $sr_no+=1; ?></td>
                    <td style="border: 1px solid black; text-align: center"><?php echo ucfirst($item['name'] . ' ' . $item['attribute_values']); ?></td>
                    <td style="border: 1px solid black; text-align: center"><?php echo to_currency($item['price']); ?></td>
                    <td style="border: 1px solid black; text-align: center"><?php echo to_quantity_decimals($item['quantity']); ?></td>
                    <td class="total-value" style="border: 1px solid black; text-align: center"><?php echo to_currency($item[($this->config->item('receipt_show_total_discount') ? 'total' : 'discounted_total')]); ?></td>
                    <?php
                    if($this->config->item('receipt_show_tax_ind'))
                    {
                        ?>
                        <td style="border: 1px solid black"><?php echo $item['taxed_flag'] ?></td>
                        <?php
                    }
                    ?>
                </tr>
                <tr class="hide" style="border: 1px solid black">
                    <?php
                    if($this->config->item('receipt_show_description'))
                    {
                        ?>
                        <td colspan="2"><?php echo $item['description']; ?></td>
                        <?php
                    }

                    if($this->config->item('receipt_show_serialnumber'))
                    {
                        ?>
                        <td><?php echo $item['serialnumber']; ?></td>
                        <?php
                    }
                    ?>
                </tr>
                <?php
                if($item['discount'] > 0)
                {
                    ?>
                    <!--					<tr>-->
                    <!--						--><?php
//						if($item['discount_type'] == FIXED)
//						{
//						?>
                    <!--                            <td></td>-->
                    <!--                            <td></td>-->
                    <!--							<td colspan="2" class="discount">--><?php //echo to_currency($item['discount']) . " " . $this->lang->line("sales_discount") ?><!--</td>-->
                    <!--						--><?php
//						}
//						elseif($item['discount_type'] == PERCENT)
//						{
//						?>
                    <!--                            <td></td>-->
                    <!--                            <td></td>-->
                    <!--							<td colspan="2" class="discount">--><?php //echo number_format($item['discount'], 0) . " " . $this->lang->line("sales_discount_included") ?><!--</td>-->
                    <!--						--><?php
//						}
//						?>
                    <!--						<td class="total-value">--><?php //echo to_currency($item['discounted_total']); ?><!--</td>-->
                    <!--					</tr>-->
                    <?php
                }
            }
        }
        ?>

        <?php
        if($this->config->item('receipt_show_total_discount') && $discount > 0)
        {
            ?>
            <tr>
                <td colspan="4" style='text-align:right;border-top:2px solid #000000;'><?php echo $this->lang->line('sales_sub_total'); ?></td>
                <td style='text-align:right;border-top:2px solid #000000;'><?php echo to_currency($prediscount_subtotal); ?></td>
            </tr>
            <tr>
                <td colspan="4" class="total-value"><?php echo $this->lang->line('sales_customer_discount'); ?>:</td>
                <td class="total-value"><?php echo to_currency($discount * -1); ?></td>
            </tr>
            <?php
        }
        ?>

        <?php
        if($this->config->item('receipt_show_taxes'))
        {
            ?>
            <tr class="hide">
                <td colspan="4" style='text-align:right;border-top:2px solid #000000;'><?php echo $this->lang->line('sales_sub_total'); ?></td>
                <td style='text-align:right;border-top:2px solid #000000;'><?php echo to_currency($subtotal); ?></td>
            </tr>
            <?php
            foreach($taxes as $tax_group_index=>$tax)
            {
                ?>
                <tr>
                    <td colspan="4" class="total-value"><?php echo (float)$tax['tax_rate'] . '% ' . $tax['tax_group']; ?>:</td>
                    <td class="total-value"><?php echo to_currency_tax($tax['sale_tax_amount']); ?></td>
                </tr>
                <?php
            }
            ?>
            <?php
        }
        ?>

        <tr>
        </tr>

        <?php $border = (!$this->config->item('receipt_show_taxes') && !($this->config->item('receipt_show_total_discount') && $discount > 0)); ?>
        <tr>
            <td colspan="4" style="text-align:right;<?php echo $border? 'border-top: 2px solid black;' :''; ?>"><?php echo $this->lang->line('sales_total'); ?></td>
            <td style="text-align:right;<?php echo $border? 'border-top: 2px solid black;' :''; ?>"><?php echo to_currency($total); ?></td>
        </tr>

        <!--		<tr>-->
        <!--			<td colspan="4">&nbsp;</td>-->
        <!--		</tr>-->

        <?php
        $only_sale_check = FALSE;
        $show_giftcard_remainder = FALSE;
        foreach($payments as $payment_id=>$payment)
        {
            $only_sale_check |= $payment['payment_type'] == $this->lang->line('sales_check');
            $splitpayment = explode(':', $payment['payment_type']);
            $show_giftcard_remainder |= $splitpayment[0] == $this->lang->line('sales_giftcard');
            ?>
            <tr>
                <td colspan="4" style="text-align:right;"><?php echo $splitpayment[0]; ?> </td>
                <td class="total-value"><?php echo to_currency( $payment['payment_amount'] * -1 ); ?></td>
            </tr>
            <?php
        }
        ?>

        <tr class="hide">
            <td colspan="4">&nbsp;</td>
        </tr>

        <?php
        if(isset($cur_giftcard_value) && $show_giftcard_remainder)
        {
            ?>
            <tr>
                <td colspan="4" style="text-align:right;"><?php echo $this->lang->line('sales_giftcard_balance'); ?></td>
                <td class="total-value"><?php echo to_currency($cur_giftcard_value); ?></td>
            </tr>
            <?php
        }
        ?>
        <tr>
            <td colspan="4" style="text-align:right;"> <?php echo $this->lang->line($amount_change >= 0 ? ($only_sale_check ? 'sales_check_balance' : 'sales_change_due') : 'sales_amount_due') ; ?> </td>
            <td class="total-value"><?php echo to_currency($amount_change); ?></td>
        </tr>
    </table>
    <div id="employee"><strong> <?php echo $this->lang->line('employees_employee').": ".$employee; ?></strong></div>
    <div id="sale_return_policy">
        <?php echo nl2br($this->config->item('return_policy')); ?>
    </div>

    <!--    <table>-->
    <!--    <tfoot class="report-footer" style="position: fixed">-->
    <!--    <tr>-->
    <!--        <td>-->
    <!--            <div class="footer-info">-->
    <!--                Powered By TecnoTronix.co-->
    <!--            </div>-->
    <!--        </td>-->
    <!--    </tr>-->
    <!--    </tfoot>-->
    <!--    </table>-->
    <!--	<div id="barcode">-->
    <!--		<img src='data:image/png;base64,--><?php //echo $barcode; ?><!--' /><br>-->
    <!--		--><?php //echo $sale_id; ?>
    <!--	</div>-->
</div>
<table>
    <tfoot class="report-footer" style="position: fixed;bottom: 0">
    <tr>
        <td colspan="4">
            <div class="footer-info">
                DAWLANCE - HAIER - ORIENT - SAMSUNG - PEL - TCL - PANASONIC<br>
                MITSUBISHI - KENWOOD - ANEX - BRAUN - PHILIPS - BLACK &amp; DECKER - WESTPOINT etc.<br>
                Powered By TecnoTronix.co
            </div>
        </td>
        <td colspan="4">
            <div style="text-align: right">
            </div>

        </td>
        <td colspan="4">
            <div style="text-align: right">
                Signature ___________________
            </div>

        </td>
    </tr>
    </tfoot>
</table>