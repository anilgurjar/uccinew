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
            'contain' => ['Suppliers', 'PurchaseOrderRows']
        ]);
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
			
            if ($this->PurchaseOrders->save($purchaseOrder)) {
                $this->Flash->success(__('The purchase order has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The purchase order could not be saved. Please, try again.'));
            }
        }
        $suppliers = $this->PurchaseOrders->Suppliers->find('list', ['limit' => 200]);
        $this->set(compact('purchaseOrder', 'suppliers'));
        $this->set('_serialize', ['purchaseOrder']);
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
        $suppliers = $this->PurchaseOrders->Suppliers->find('list', ['limit' => 200]);
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
