<style>
pre{
padding: 0px !important;
font-size: 14px;
background-color: white !important;
border: 0px !important;
font-family: 'LatoHairline' !important;
}
</style>
<div class="col-md-12">
  <!-- Horizontal Form -->
  <div class="box box-primary">
	<div class="box-header with-border">
	  <h3 class="box-title">View Business Visa</h3>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	
	<div class="box-body">
		<table class="vertical-table" style="width:100%;">
		 <tr>
            <td style="width:30%;">UCCI/VISA-41/R-9457/2016-17</td>
            <td style="text-align:right;"><?= h(date('jS F, Y',strtotime($businessVisa->date_current))) ?></td>
        </tr>
        <tr>
            <th colspan="2"><pre><br/><?= h($businessVisa->sender_address) ?></pre></th>
        </tr>
		 <tr>
            <td colspan="2"><br/>Sub:<?= h($businessVisa->subject) ?></td>
        </tr>
		 <tr>
            <td colspan="2"><br/>Dear Sir,</td>
        </tr>
		<tr>
            <td colspan="2"><br/><p>This is to inform you that M/s <?= h($businessVisa->company->company_organisation) ?>, <?= h($businessVisa->company->address) ?>, <?= h($businessVisa->company->city) ?> - <?= h($businessVisa->company->pincode) ?> is our member. The company is manufacturer of <?= h($businessVisa->company_manufacture) ?>.</p></td>
        </tr>
		<tr>
            <td colspan="2"><p>We hereby request you to issue Business Visa to <?= h($businessVisa->visitor_name) ?>, <?= h($businessVisa->visitor_designation) ?> of <?= h($businessVisa->company->company_organisation) ?> to visit <?= h($businessVisa->visit_country) ?> during the month of <?= date('M Y',strtotime('01-'.$businessVisa->visit_month)) ?> for <?= h($businessVisa->visit_reason) ?>. </p></td>
        </tr>
        <tr>
            <td colspan="2"><p>The particulars of his passport are given below: </p></td>
        </tr>
        <tr>
            <th scope="row" style="text-align:center;"><?= __('1. Passport No.') ?></th>
            <td><?= h($businessVisa->passport_no) ?></td>
        </tr>
        <tr>
            <th scope="row" style="text-align:center;"><br/><?= __('2. Date of Issue') ?></th>
            <td ><br/><?= h(date('d-m-Y',strtotime($businessVisa->issue_date))) ?></td>
        </tr>
        <tr>
            <th scope="row" style="text-align:center;"><br/><?= __('3. Place of Issue') ?></th>
            <td><br/><?= h($businessVisa->issue_place) ?></td>
        </tr>
        <tr>
            <th scope="row" style="text-align:center;"><br/><?= __('4. Date of Expiry') ?></th>
            <td><br/><?= h(date('d-m-Y',strtotime($businessVisa->expiry_date))) ?></td>
        </tr>
        <tr>
            <td colspan="2"><br/><p>We wish him all the success, as this visit be beneficial to both the countries.</p></td>
        </tr>
		<tr>
            <td colspan="2"><p>It is requested that Multiple Business Visa to visit <?= h($businessVisa->visit_country) ?> may kindly be issued.</p></td>
        </tr>
		<tr>
            <td colspan="2"><p>Thanking you in anticipation,</p></td>
        </tr>
		<tr>
            <td colspan="2"><p>Yours Sincerely,</p></td>
        </tr>
		<tr>
            <th colspan="2"><p>For Udaipur Chamber of Commerce & Industry,</p></th>
        </tr>
		<tr>
            <th colspan="2"><br/><br/><p>Authorised Signatory</p></th>
        </tr>
    </table>

	</div>
	  <!-- /.box-body -->
	  
	
  </div>
  <!-- /.box -->
         
           
             
</div>