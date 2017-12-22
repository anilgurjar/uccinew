<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PurchaseOrders Controller
 *
 * @property \App\Model\Table\PurchaseOrdersTable $PurchaseOrders
 */
class PurchaseOrdersController extends AppController
{

public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['logout']);
		$member_name=$this->Auth->User('member_name');
		$this->set('member_name',$member_name);
	}
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
		$this->viewBuilder()->layout('index_layout');
		$company_id=$this->Auth->User('company_id'); 
		
		$Companies=$this->PurchaseOrders->Companies->get($company_id);
		
		$role_id=$Companies->role_id;
		
		$user_id=$this->Auth->User('id');
		 $this->paginate = [
            'contain' => ['Suppliers']
        ];
        $purchaseOrders = $this->paginate($this->PurchaseOrders->find()->order(['purchase_order_no'=>'DESC']));

        $this->set(compact('purchaseOrders','role_id'));
        $this->set('_serialize', ['purchaseOrders']);
    }

	
	
	
	
	
	
	public function filterdata(){
		$supplier=$this->request->query['supplier']; 
		$purchase_order_no=$this->request->query['purchase_order_no'];
		$datefrom=$this->request->query['datefrom']; 
		$dateto=$this->request->query['dateto'];
		
		
		if(!empty($supplier)){
			$suppliers=$this->PurchaseOrders->Suppliers->find()->where(['name LIKE'=>'%'.$supplier.'%']);
			foreach($suppliers as $supplier){
				$condition['supplier_id']=$supplier['id'];
			}
			
			
		}
		 if( !empty($purchase_order_no)){
			//$Users=$this->PurchaseOrders->find()->where(['exporter'=>$exporter,'origin_no '=>$originno])->order(['PurchaseOrders.id'=>'DESC']);
			$condition['purchase_order_no']=$purchase_order_no;
		}
		
		if(!empty($datefrom) && !empty($dateto)){
			//$Users=$this->PurchaseOrders->find()->where(['PurchaseOrders.invoice_date BETWEEN :start AND :end'])
				///->bind(':start', $datefrom, 'date')
				//->bind(':end',   $dateto, 'date')
				//->order(['PurchaseOrders.id'=>'DESC']);
			$datefrom=date('y-m-d', strtotime($datefrom));
			$dateto=date('y-m-d', strtotime($dateto));
			$condition['date >=']=$datefrom;
			$condition['date <=']=$dateto;
		}
		
	
		$purchaseOrders=$this->PurchaseOrders->find()->where($condition)
						->contain(['Suppliers'])
						->order(['PurchaseOrders.id'=>'DESC']);
				
		
		$this->set(compact('purchaseOrders'));
		
	}
    /**
     * View method
     *
     * @param string|null $id Purchase Order id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$user_id=$this->Auth->User('id');
		$this->viewBuilder()->layout('index_layout');
        $purchaseOrder = $this->PurchaseOrders->get($id, [
            'contain' => ['Suppliers', 'PurchaseOrderRows','PurchaseOrderTaxs'=>['MasterTaxations'],'Suppliers'=>['MasterStates']]
        ]);
		//pr($purchaseOrder);exit;
		$MasterCompanies=$this->PurchaseOrders->MasterCompanies->find();
	
	
		$this->set('purchaseOrder', $purchaseOrder); 
       $this->set('MasterCompanies', $MasterCompanies);
        $this->set('_serialize', ['purchaseOrder']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$user_id=$this->Auth->User('id');
		$this->viewBuilder()->layout('index_layout');
        $purchaseOrder = $this->PurchaseOrders->newEntity();
        if ($this->request->is('post')) {
			
			$this->request->data['created_by']=$user_id;
			
			$fetch_member_receipt=$this->PurchaseOrders->find()->select(['purchase_order_no'])->order(['purchase_order_no' => 'DESC'])->limit(1)->toArray();
			if(!empty($fetch_member_receipt)){
				$purchase_order_no=$fetch_member_receipt[0]['purchase_order_no']+1;
			}else{
				$purchase_order_no='01';
			}
		
			$this->request->data['purchase_order_no']=$purchase_order_no;
			$this->request->data['date']=date('Y-m-d',strtotime($this->request->data['date']));
			
            $purchaseOrder = $this->PurchaseOrders->patchEntity($purchaseOrder, $this->request->data);
			//pr($purchaseOrder); exit;
            if ($this->PurchaseOrders->save($purchaseOrder)) {
                $this->Flash->success(__('The purchase order has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The purchase order could not be saved. Please, try again.'));
            }
        }
        $suppliers = $this->PurchaseOrders->Suppliers->find()->contain(['MasterStates']);
		 $this->set(compact('purchaseOrder', 'suppliers'));
        $this->set('_serialize', ['purchaseOrder']);
    }

	
	
	
	public function CalculateTaxPurchaseOrders()
  {
	  
	$this->viewBuilder()->layout('ajax_layout');
	$total_amount=$this->request->data['total_amount'];
	$state_id=$this->request->data['state_id']; 
	$total_tax=0;		
	$grand_total_amount = 0;
	$total_basic_amount = 0;
	$total_service_tax=0;
	
	$i=0;
	
	$taxation=$this->PurchaseOrders->MasterTaxations->find('all',array('fields' => array('tax_name','tax_id'),'conditions'=>array('tax_flag'=>1)))->toArray();
	foreach($taxation as $data)
	{  
		
		if($state_id==20){
			if($data['tax_name']!='IGST'){
				$taxation_rate = $this->PurchaseOrders->MasterTaxationRates->find('all',array('fields' => array('id','tax_percentage'),'conditions'=>array('master_taxation_id'=>$data['tax_id'],'tax_date <='=>date('Y-m-d')),'order'=>'tax_date DESC','limit'=>1))->toArray(); 
				
				foreach($taxation_rate as $tax_value)
				{
					
					$tax_amount=($total_amount*$tax_value['tax_percentage'])/100;
					$tax_amount=number_format($tax_amount, 4, '.', '');
					$total_tax+=$tax_amount; 
					$tax[$data['tax_id']][$data['tax_name']][(string) $tax_value['tax_percentage']][$i]=$tax_amount;
					$i++;
				}
			}
			
		}else{
			if($data['tax_name']=='IGST'){
				$taxation_rate = $this->PurchaseOrders->MasterTaxationRates->find('all',array('fields' => array('id','tax_percentage'),'conditions'=>array('master_taxation_id'=>$data['tax_id'],'tax_date <='=>date('Y-m-d')),'order'=>'tax_date DESC','limit'=>1))->toArray(); 
				foreach($taxation_rate as $tax_value)
				{
					
					$tax_amount=($total_amount*$tax_value['tax_percentage'])/100;
					$tax_amount=number_format($tax_amount, 4, '.', '');
					$total_tax+=$tax_amount; 
					$tax[$data['tax_id']][$data['tax_name']][(string) $tax_value['tax_percentage']][$i]=$tax_amount;
					$i++;
				}
			}
			
		}
	}
	
	$total_basic_amount = $total_amount; 
	$grand_total_amount = $total_amount + $total_tax;
	
	echo '<tr class="Tax">
	<td colspan="4" align="right">Basic Amount</td>
	<td><input type="hidden" name="basic_amount" class="grandvalue"  value="'.number_format($total_basic_amount,2, '.', '').'">'.number_format($total_basic_amount,2, '.', '').'</td>
	</tr>';
	$sr=0;
	foreach(@$tax as $tax_data1=>$tax_key11)
	{
		
		$tax_amounts_add=0;
		foreach($tax_key11 as $tax_data=>$tax_key)
		{
			
			
			foreach($tax_key as $tax_key1=>$tax_key2)
			{
				foreach($tax_key2 as $tax_amounts)
				{
					$tax_amounts_add+=$tax_amounts;
				}
			}
			echo '<tr class="Tax">
			<td colspan="4" align="right"><input type="hidden" name="purchase_order_taxs['.$sr.'][tax_id]" value="'.$tax_data1.'"><input type="hidden" name="purchase_order_taxs['.$sr.'][tax_percentage]" value="'.number_format($tax_key1, 2, '.', '').'">'.$tax_data.' @ '.number_format($tax_key1, 2, '.', '').'%</td><td><input type="hidden" name="purchase_order_taxs['.$sr.'][amount]" value="'.number_format($tax_amounts_add, 2, '.', '').'">'.number_format($tax_amounts_add, 2, '.', '').'</td></tr>';
			
		}
		$sr++;
	}
	echo '<tr class="Tax">
	<td colspan="4" align="right">Total Tax</td>
	<td><input type="hidden" name="taxamount" value="'.number_format($total_tax, 2, '.', '').'">'.number_format($total_tax, 2, '.', '').'</td>
	</tr>
		<tr>
		<td colspan="4" align="right">Total Amount</td>
		<td id="grand_total">'.number_format($grand_total_amount, 2, '.', '').'</td>
	</tr>
	
	<tr>
		<td colspan="4" align="right"><strong>Grant Total</strong></td>
		<td id="grand_total"><input type="hidden"  name="amount" value="'.number_format($grand_total_amount, 2, '.', '').'"><strong>'.number_format($grand_total_amount, 2, '.', '').'</strong></td>
	</tr>';
	exit;
  }
	
	
	
	
    /**
     * Edit method
     *
     * @param string|null $id Purchase Order id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$user_id=$this->Auth->User('id');
		$this->viewBuilder()->layout('index_layout');
        $purchaseOrder = $this->PurchaseOrders->get($id, [
            'contain' => ['PurchaseOrderRows']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
			
			$this->request->data['date']=date('Y-m-d',strtotime($this->request->data['date']));
			
			
            $purchaseOrder = $this->PurchaseOrders->patchEntity($purchaseOrder, $this->request->data);
			
            if ($this->PurchaseOrders->save($purchaseOrder)) {
                $this->Flash->success(__('The purchase order has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The purchase order could not be saved. Please, try again.'));
            }
        }
        $suppliers = $this->PurchaseOrders->Suppliers->find()->contain(['MasterStates']);
		$this->set(compact('purchaseOrder', 'suppliers'));
        $this->set('_serialize', ['purchaseOrder']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Purchase Order id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $purchaseOrder = $this->PurchaseOrders->get($id);
		//pr($purchaseOrder); exit;
        if ($this->PurchaseOrders->delete($purchaseOrder)) {
            $this->Flash->success(__('The purchase order has been deleted.'));
        } else {
            $this->Flash->error(__('The purchase order could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
