<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CooCoupons Controller
 *
 * @property \App\Model\Table\CooCouponsTable $CooCoupons
 */
class CooCouponsController extends AppController
{
	public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['logout']);
		$member_name=$this->Auth->User('member_name');
		$this->set('member_name',$member_name);
		$this->loadComponent('RequestHandler');
		$this->response->type('ajax');
	}
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {	
		$this->viewBuilder()->layout('index_layout');
        $this->paginate = [
            'contain' => ['Companies']
        ];
        $cooCoupons = $this->paginate($this->CooCoupons);

        $this->set(compact('cooCoupons'));
        $this->set('_serialize', ['cooCoupons']);
    }

    /**
     * View method
     *
     * @param string|null $id Coo Coupon id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {	
		$this->viewBuilder()->layout('index_layout');
        $cooCoupon = $this->CooCoupons->get($id, [
            'contain' => ['Companies']
        ]);

        $this->set('cooCoupon', $cooCoupon);
        $this->set('_serialize', ['cooCoupon']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->viewBuilder()->layout('index_layout');
        $cooCoupon = $this->CooCoupons->newEntity();
       if ($this->request->is('post')) {
          
			$validfrom=$this->request->data['valid_from'];
			$valid_from=date('Y-m-d', strtotime($validfrom));
			$validto=$this->request->data['valid_to'];
			$valid_to=date('Y-m-d', strtotime($validto));
			$this->request->data['valid_from']=$valid_from;
			$this->request->data['valid_to']=$valid_to;
			$coupon_number=$this->request->data['coupon_number'];
			$company_id=$this->request->data['company_id'];
			
			
			for($i=0;$i<$coupon_number;$i++){
				
					$cooCoupon = $this->CooCoupons->newEntity();
					$cooCoupon = $this->CooCoupons->patchEntity($cooCoupon, $this->request->data);

					$data=$this->CooCoupons->save($cooCoupon);

					$coupon_code="ABCD".$company_id.$data->id;	
					$query = $this->CooCoupons->query();
					$query->update()
					->set(['coupon_code' => $coupon_code])
					->where(['id' => $data->id])
					->execute();

			}
			 return $this->redirect(['action' => 'index']);
			 $this->Flash->success(__('The  coo coupon has been saved.'));
        }
     
		$master_member=$this->CooCoupons->Companies->find()
		->where(['member_flag'=>1])
		->order(['Companies.company_organisation ASC'])
		->toArray();
		$this->set('master_member' ,$master_member);
        $this->set(compact('cooCoupon'));
        $this->set('_serialize', ['cooCoupon']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Coo Coupon id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cooCoupon = $this->CooCoupons->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cooCoupon = $this->CooCoupons->patchEntity($cooCoupon, $this->request->data);
            if ($this->CooCoupons->save($cooCoupon)) {
                $this->Flash->success(__('The coo coupon has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The coo coupon could not be saved. Please, try again.'));
            }
        }
        $companies = $this->CooCoupons->Companies->find('list', ['limit' => 200]);
        $this->set(compact('cooCoupon', 'companies'));
        $this->set('_serialize', ['cooCoupon']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Coo Coupon id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cooCoupon = $this->CooCoupons->get($id);
        if ($this->CooCoupons->delete($cooCoupon)) {
            $this->Flash->success(__('The coo coupon has been deleted.'));
        } else {
            $this->Flash->error(__('The coo coupon could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
