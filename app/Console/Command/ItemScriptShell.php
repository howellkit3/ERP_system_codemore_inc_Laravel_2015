<?php 

class ItemScriptShell extends Shell
{
    public function main()
    {

    	$items = $this->loadModel('WareHouse.Item');

        $Item = ClassRegistry::init('Item');

        $GeneralItem = ClassRegistry::init('GeneralItem');

        $CorrugatedPaper = ClassRegistry::init('CorrugatedPaper');  

        $conditions = array(); //array('Event.status != deleted'); 

    	$items = $this->Item->find('all',array(
                'conditions' => $conditions,
                'limit' => 5

        ));

 
        //save
        $saveData = array();

        foreach ($items as $key => $item) {
            $saveData['id'] = '';       
            $saveData['uuid'] = time();
            $saveData['name'] = $item['Item']['name'];

            $saveData['manufacturer_id'] = $item['Item']['supplier'];

            switch ($item['Item']['category_type_id']) {
         
                case '2':
                $saveData['category_id'] = 48;
                default:
                
                $saveData['category_id'] = 35;

                break;
            }

            $saveData['created_by'] = $item['Item']['created_by'];
            $saveData['modified_by'] = $item['Item']['modified_by'];

            $saveData['width'] = $item['Item']['width'];
            $saveData['length'] = $item['Item']['length'];


           // exit();

           switch ($item['Item']['item_group']) {

                case 'CorrugatedPaper':
                    $model = $GeneralItem;
                    $save = 'Corrugated Paper';
                break;
                default:
                    $model =  $CorrugatedPaper;
                    $save = 'General Item';
                break;
            }

            if($model->save($saveData)) {

                $this->out('#id '.$item['Item']['id'].' Item '. $item['Item']['name'].' has been saved to '.$save);

            } else  {

                 $this->out('There\'s an error saving. id '.$item['Item']['id']);
            }

        }


        

    //     foreach ($Attendance as $key => $attnd) {
				//  $userData['id'] = $attnd['Attendance']['id'];

				// $userData['out'] = '';

				// if ($this->Attendance->save($userData)) {

				// 	$this->out('Successfully saved');

				// } else {

				// 	$this->out('There\'s an error saving the data');

				// }
    //     }

       

      
    }
}