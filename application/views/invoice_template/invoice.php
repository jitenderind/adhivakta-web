    <style>
body,
h1,
.h1,
h2,
.h2,
h3,
.h3,
h4,
.h4,
h5,
.h5,
h6,
.h6,
p,
.navbar,
.brand,
.btn-simple,
.alert,
a,
.td-name,
td,
button.close {
    -moz-osx-font-smoothing: grayscale;
    -webkit-font-smoothing: antialiased;
    font-family: 'Poppins', sans-serif;
    font-weight: 400;
}

body {
    overflow-x: hidden !important;
	
}

h1,
.h1,
h2,
.h2,
h3,
.h3,
h4,
.h4 {
    font-weight: 300;
    margin: 30px 0 15px;
}

h1,
.h1 {
    font-size: 3.25rem;
}

h2,
.h2 {
    font-size: 2.25rem;
}

h3,
.h3 {
    font-size: 1.75rem;
    margin: 20px 0 10px;
}

h4,
.h4 {
    font-size: 1.375rem;
    line-height: 30px;
}

h5,
.h5 {
    font-size: 1.125rem;
    margin-bottom: 15px;
}

h6,
.h6 {
    font-size: 0.875rem;
    font-weight: 600;
    text-transform: uppercase;
}

p {
    font-size: 1rem;
    line-height: 1.5;
}

h1 small,
h2 small,
h3 small,
h4 small,
h5 small,
h6 small,
.h1 small,
.h2 small,
.h3 small,
.h4 small,
.h5 small,
.h6 small,
h1 .small,
h2 .small,
h3 .small,
h4 .small,
h5 .small,
h6 .small,
.h1 .small,
.h2 .small,
.h3 .small,
.h4 .small,
.h5 .small,
.h6 .small {
    color: #9A9A9A;
    font-weight: 300;
    line-height: 1.5;
}

h1 small,
h2 small,
h3 small,
h1 .small,
h2 .small,
h3 .small {
    font-size: 60%;
}

h1 .subtitle {
    display: block;
    margin: 0 0 30px;
}

.text-muted {
    color: #9A9A9A;
}

.text-primary,
.text-primary:hover {
    color: #1D62F0 !important;
}

.text-info,
.text-info:hover {
    color: #23CCEF !important;
}

.text-success,
.text-success:hover {
    color: #87CB16 !important;
}

.text-warning,
.text-warning:hover {
    color: #FFA534 !important;
}

.text-danger,
.text-danger:hover {
    color: #FB404B !important;
}

.typo-line {
    padding-left: 140px;
    margin-bottom: 40px;
    position: relative;
}

.typo-line .category {
    transform: translateY(-50%);
    top: 50%;
    left: 0px;
    position: absolute;
    font-size: 14px;
    font-weight: 400;
    color: #888888;
    margin-bottom: 0px;
}

blockquote {
    padding: 10px 20px;
    margin: 0 0 20px;
    font-size: 17.5px;
    border-left: 5px solid #eee;
}

li {
    list-style: none;
}
.table {
    border-color: #e2e7eb;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    background: #fff
}

.table > thead > tr > th {
    color: #242a30;
    font-weight: 500;
}

.table th {
    font-size: 15px !important;
}

.table td {
    font-size: 14px !important;
}

table.table-bordered.dataTable {
    border-collapse: collapse !important;
}

div#data-table_wrapper thead th {
    font-size: 15px;
}

div#data-table_wrapper tbody td {
    font-size: 14px;
}

.dataTables_wrapper.container-fluid {
    padding-left: 0 !important;
    padding-right: 0 !important;
}

div.dt-autofill-list div.dt-autofill-question input[type=number] {
    width: 70px !important;
}

div.dataTables_wrapper div.dataTables_filter {
    display: inline-block;
    float: right;
}

table.dataTable tbody > tr.selected, table.dataTable tbody > tr > .selected {
    background-color: #9368E9 !important;
}

.fixed-table-container {
    border: 0px solid #dddddd !important;
}

.fixed-table-toolbar .columns label {
    padding: 0 !important;
    font-size: 14px !important;
}

.page-number.active a {
    color: #ffffff !important;
}

.table > caption + thead > tr:first-child > td, .table > caption + thead > tr:first-child > th, .table > colgroup + thead > tr:first-child > td, .table > colgroup + thead > tr:first-child > th, .table > thead:first-child > tr:first-child > td, .table > thead:first-child > tr:first-child > th {
    border-top: 0;
}

.table-condensed > tbody > tr > td,
.table-condensed > tbody > tr > th,
.table-condensed > tfoot > tr > td,
.table-condensed > tfoot > tr > th,
.table-condensed > thead > tr > td,
.table-condensed > thead > tr > th {
    padding: 7px 15px;
}

.table-extended {
    background: transparent !important;
}

.table-extended th {
    background: transparent !important;
    border: 0px !important;
}

.table-extended .form-check .form-check-label {
    line-height: 10px !important;
}

.table-extended .material-icons.align-middle {
    cursor: pointer;
}

@media (max-width: 767px) {
    .dt-buttons.btn-group {
        float: none;
        text-align: center;
        display: block;
        margin: 0 0 5px
    }

    .dt-buttons.btn-group > .btn {
        float: none;
        margin-bottom: 5px;
        -webkit-border-radius: 4px !important;
        -moz-border-radius: 4px !important;
        border-radius: 4px !important
    }

    .dt-buttons.btn-group > .btn + .btn {
        border-left: none;
        margin-left: 5px
    }

    .dataTables_length, div.dataTables_info {
        float: none;
        margin-right: 0
    }

    .ap-wrapper > .dataTables_wrapper div.dataTables_length label, .ap-wrapper > .table-responsive > .dataTables_wrapper div.dataTables_length label {
        margin: 20px 0 0
    }

    div.dataTables_wrapper div.dataTables_info {
        margin: 0;
        padding-top: 0 !important
    }

    div.dataTables_wrapper div.dataTables_paginate {
        margin: 10px 20px 0 !important;
        text-align: center
    }

    div.dataTables_wrapper div.dataTables_paginate .pagination {
        display: block;
        white-space: initial !important
    }

    div.dataTables_wrapper div.dataTables_paginate .pagination > li > a {
        float: left;
        margin-bottom: 5px;
        display: inline-block;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px
    }
}

.table-responsive {
    overflow: visible;
}
.table-responsive {
    display: block;
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    -ms-overflow-style: -ms-autohiding-scrollbar;
}

.table {
    border-color: #e2e7eb;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    background: #fff;
}
.table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 1rem;
    background-color: transparent;
}

.table > thead > tr > th {
    color: #242a30;
    font-weight: 500;
}

.table > caption + thead > tr:first-child > td, .table > caption + thead > tr:first-child > th, .table > colgroup + thead > tr:first-child > td, .table > colgroup + thead > tr:first-child > th, .table > thead:first-child > tr:first-child > td, .table > thead:first-child > tr:first-child > th {
    border-top: 0;
}

.table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #e9ecef;
}
.table th {
    font-size: 15px !important;
}

.table th, .table td {
    padding: 0.75rem;
    vertical-align: top;
    border-top: 1px solid #e9ecef;
}

th {
    text-align: inherit;
}







.invoice > div:not(.invoice-footer) {
    margin-bottom: 20px
}

.invoice {
    background: #fff;
    padding:0px;
	margin:0 auto;
}

.invoice-company {
    font-size: 30px;
	color:#5729ab;
}

.invoice-header {
    margin: 0 -10px 50px;
    background: url('/assets/img/invoice-bg.png');
    padding: 10px;
	display:table;
	width: 100% !important;
	
}

.invoice-from, .invoice-to {
    padding-right: 20px
}

.invoice-date .date, .invoice-from strong, .invoice-to strong {
    font-size: 16px;
    font-weight: 600
}

.invoice-date {
    text-align: right;
    padding-left: 20px
}

.invoice-price {
    border-top: 1px solid #e2d3ff;
    border-bottom: 1px solid #e2d3ff;
    display: table;
    width: 100%
}

.invoice-price .invoice-price-left, .invoice-price .invoice-price-right {
    display: table-cell;
    padding: 20px;
    font-size: 18px;
    font-weight: 300;
    width: 70%;
    position: relative;
    vertical-align: middle;
    border-left: 1px solid #e2d3ff;
	color:#9368E9;
}

.invoice-price .invoice-price-left .sub-price {
    display: table-cell;
    vertical-align: middle;
    padding: 0 20px
}

.invoice-price small {
    font-size: 12px;
    font-weight: 400;
    display: block;
	color:#333;
}

.invoice-price .invoice-price-row {
    display: table;
    float: left
}

.invoice-price .invoice-price-right {
	display: table-cell;
    width: 30%;
    border-left: 1px solid #e2d3ff;
    border-right: 1px solid #e2d3ff;
    font-size: 28px;
    text-align: right;
    vertical-align: middle !important;
    font-weight: 300;
}

.invoice-price .invoice-price-right small {
    opacity: .6;
    filter: alpha(opacity=60);
    position: absolute;
    top: 30px;
    right: 10px;
    font-size: 12px;
	color:#333;
}

.invoice-footer {
    border-top: 3px solid #5729ab;
	margin-top:25px;
    padding-top: 10px;
    font-size: 10px
}

.invoice-note {
    color: #999;
    margin-top: 80px;
    font-size: 85%
}




    .invoice-date, .invoice-from, .invoice-to {
        display: table-cell !important;
        padding: 0 !important;
    	width: 33.3333% !important;
    }

.pull-right {
	    float: right;
	position:absolute;top:-30px;
}

small {
    font-size: 80%;
}
.no-border{
	border:0px !important;
	padding:3px !important;
}
.less-padding{
	padding:3px !important;
}
.purple{
	color:#9368E9;
}
</style>
  </head>
  <div class="invoice">
                                <div class="invoice-company">
                                    <span class="pull-right">
                                    <img src="assets/img/logo.png" style="width:150px;" />
                                    </span>
                                    Adhivakta Plus
                                </div>
                                <div class="invoice-header">
                                    <div class="invoice-from">
                                        <small>from</small>
                                        <address class="m-t-5 m-b-5">
                                            <strong>Adhivakta Plus,</strong><br>
                                            Street Address<br>
                                            City, Zip Code<br>
                                        </address>
                                    </div>
                                    <div class="invoice-to">
                                        <small>to</small>
                                        <address class="m-t-5 m-b-5">
                                            <strong><?php echo $data->first_name.' '.$data->last_name?></strong><br>
                                            <?php echo $data->email?><br>
                                            <?php echo $data->mobile?>
                                        </address>
                                    </div>
                                    <div class="invoice-date">
                                        <small>Invoice / Due </small>
                                        <div class="date m-t-5"><?php echo date('M d, Y', strtotime($data->invoiceDate))?></div>
                                        <div class="invoice-detail">
                                            #<?php echo $data->invoiceId?><br>
                                            Subscription Payment
                                        </div>
                                    </div>
                                </div>
                                <div class="invoice-content">
                                    <div class="table-responsive">
                                        <table class="table table-invoice">
                                            <thead>
                                            <tr>
                                                <th>DESCRIPTION</th>
                                                <th>RATE</th>
                                                <th>Discount</th>
                                                <th>TOTAL</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    Subscription for <?php echo $data->plan_type?> Membership Plan<br>
                                                    <small>1 year subscription for E-Diary services
                                                    </small>
                                                </td>
                                                <td><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span><?php echo $data->amount?></td>
                                                <td>NA</td>
                                                <td><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span><?php echo $data->amount?></td>
                                            </tr>
                                            <tr>
                                                <td class="less-padding">
                                                </td>
                                                <td class="less-padding"></td>
                                                <td class="less-padding">GST</td>
                                                <td class="less-padding"><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span><?php echo $data->gst;?></td>
                                            </tr>
                                            <tr>
                                                <td class="no-border">
                                                </td>
                                                <td class="no-border"></td>
                                                <td class="no-border"><b>Total</b></td>
                                                <td class="no-border"><b><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span><?php echo $data->payableAmount;?></b></td>
                                            </tr>
                                            <tr>
                                                <td class="no-border">
                                                </td>
                                                <td class="no-border"></td>
                                                <td class="no-border purple"><b>Amount Paid</b></td>
                                                <td class="no-border purple"><b><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span><?php echo ($data->status=="Pending")?0:$data->payableAmount;?></b></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="invoice-price">
                                        <div class="invoice-price-left">
                                            <div class="invoice-price-row">
                                            <?php if($data->status=="Pending"){?>
                                                <div class="sub-price">
                                                    <small>SUBTOTAL</small>
                                                    <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span><?php echo $data->amount?>
                                                </div>
                                                <div class="sub-price">
                                                    +
                                                </div>
                                                <div class="sub-price">
                                                    <small>GST (18%)</small>
                                                    <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span><?php echo $data->gst?>
                                                </div>
                                                <?php } else {?>
                                                <div class="sub-price">
                                                    <small>Paid</small>
                                                    <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span><?php echo $data->payableAmount?>
                                                </div>
                                                <div class="sub-price">
                                                    
                                                </div>
                                                <div class="sub-price">
                                                    <small>on</small>
                                                    <?php echo date('M d, Y',strtotime($data->paymentDate))?>
                                                </div>
                                                <?php }?>
                                            </div>
                                        </div>
                                        <div class="invoice-price-right">
                                            <small>TOTAL PAYABLE AMOUNT</small>
                                            <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span><?php echo ($data->status=="Pending")?$data->payableAmount:0?>
                                        </div>
                                    </div>
                                </div>
                                <div class="invoice-note">
                                    * Make all cheques payable to <b>Adhivakta Plus</b><br>
                                    * All prices are in INR<br>
                                    * Payment is due within 7 days<br>
                                    * If you have any questions concerning this invoice, contact at info@adhivaktaplus.com
                                </div>
                                <div class="invoice-footer text-muted">
                                    <p class="m-b-5">
                                        THANK YOU FOR YOUR ASSOCIATION WITH US
                                    </p>
                                    <p class="">
                                        <span class="m-r-10"><i class="fa fa-globe"></i> www.adhivaktaplus.com</span> | 
                                        <span class="m-r-10"><i class="fa fa-envelope"></i> info@adhivaktaplus.com</span>
                                    </p>
                                </div>
                            </div>